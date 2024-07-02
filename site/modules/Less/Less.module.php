<?php namespace ProcessWire;

/**
 * LESS parser module for ProcessWire
 * 
 * Usage
 * ~~~~~
 * // compile 2 less files to a css file
 * $less = $modules->get('Less');
 * $less->setOption('compress', true);
 * $less->addFile('/path/to/file1.less');
 * $less->addFile('/path/to/file2.less'); 
 * $less->saveCss('/path/to/file.min.css'); 
 * 
 * // access wikimedia less parser directly (it has many methods)
 * $parser = $less->parser();
 * $parser->parseFile('/path/to/file.less');
 * $css = $parser->getCss();
 * ~~~~~
 * 
 * @property bool|int $useCache
 * 
 */

class Less extends WireData implements Module, ConfigurableModule {

	public static function getModuleInfo() {
		return array(
			'title' => 'Less',
			'version' => 5,
			'summary' => 'Less CSS preprocessor for ProcessWire using Wikimedia Less.',
			'author' => 'Bernhard Baumrock, Ryan Cramer',
			'icon' => 'css3',
			'singular' => false,
			'requires' => 'ProcessWire>=3.0.179, PHP>=7.4.0',
		);
	}

	/**
	 * @var \Less_Parser|null
	 * 
	 */
	protected $parser = null;

	/**
	 * @var array
	 * 
	 */
	protected $defaults = array(
		'compress' => false,
	);

	/**
	 * @var array
	 * 
	 */
	protected $options = array();

	/**
	 * @var array
	 * 
	 */
	protected $importDirs = array();

	/**
	 * @var array
	 * 
	 */
	protected $parseFiles = array();

	/**
	 * Has getCss() been called?
	 * 
	 * @var bool
	 * 
	 */
	protected $gotCss = false;

	/**
	 * Have there been any addStr() or parse() calls?
	 * 
	 * @var bool
	 * 
	 */
	protected $parseStr = false;

	/**
	 * Construct
	 * 
	 */
	public function __construct() {
		$this->set('useCache', false);
		$this->options = $this->defaults;
		parent::__construct();
	}

	/**
	 * Init
	 * 
	 */
	public function init() { }
	
	/**
	 * Reset all added less strings/files and options, start fresh
	 *
	 * @return self
	 *
	 */
	public function reset() {
		$this->parser = null;
		$this->options = $this->defaults;
		$this->gotCss = false;
		$this->importDirs = array();
		$this->parseFiles = array();
		$this->parseStr = false;
		return $this;
	}

	/**
	 * Set one or more options from associative array
	 * 
	 * @param array $options
	 * @param bool $reset Remove previously set options rather than merging them?
	 * @return $this
	 * 
	 */
	public function setOptions(array $options, $reset = false) {
		$this->options = $reset ? $options : array_merge($this->options, $options);
		if($this->parser) $this->parser->SetOptions($options);
		return $this;
	}

	/**
	 * Set one option
	 * 
	 * @param string $name
	 * @param mixed $value
	 * @return self
	 * 
	 */
	public function setOption($name, $value) {
		if($this->parser) $this->parser->SetOption($name, $value);
		$this->options[$name] = $value;
		return $this;
	}

	/**
	 * Get currently set options
	 * 
	 * @return array
	 * 
	 */
	public function getOptions() {
		return $this->options;
	}

	/**
	 * Get all LESS variables from string/files added 
	 * 
	 * @return array
	 * @throws \Exception
	 * 
	 */
	public function getVariables() {
		if(!$this->parser) return array();
		if(!$this->gotCss) $this->getCss(); // required before getVariables call
		return $this->parser->getVariables();
	}

	/**
	 * Add an @import directory (if different from file passed to addFile)
	 * 
	 * @param string $path Disk path to import dir
	 * @param string $url URL to import dir
	 * @return $this
	 * 
	 */
	public function addImportDir($path, $url) {
		$this->importDirs[$path] = $url;
		return $this;
	}
	
	/**
	 * Add a LESS string to parse 
	 *
	 * @param string $str
	 * @param string $url Optional root URL of the file for image references
	 * @return self
	 *
	 */
	public function addStr($str, $url = '') {
		return $this->parse($str, $url);
	}

	/**
	 * Add a LESS file to parse
	 *
	 * @param string $file
	 * @param string $url Optional root URL of the file for image references
	 * @return self
	 * @throws \Less_Exception_Parser
	 *
	 */
	public function addFile($file, $url = '') {
		return $this->parseFile($file, $url);
	}

	/**
	 * Add multiple LESS files to parse
	 * 
	 * Note: use individual addFile() method calls if you need the $url argument. 
	 *
	 * @param array $files
	 * @return self
	 * @throws \Less_Exception_Parser
	 *
	 */
	public function addFiles(array $files) {
		foreach($files as $file) {
			$this->addFile($file);
		}
		return $this;
	}

	/**
	 * Get compiled CSS from all added less strings/files
	 * 
	 * @return string
	 * @throws \Exception
	 * 
	 */
	public function getCss() {
		// if(!$this->parser && count($this->parseFiles)) return $this->getCssCache($this->parseFiles);
		$this->gotCss = true;
		if(count($this->importDirs)) $this->parser()->SetImportDirs($this->importDirs);
		return $this->parser()->getCss();
	}

	/**
	 * Save all added less strings and files to compiled CSS file
	 * 
	 * @param string $file
	 * @param array $options
	 *  - `css` (string|null): CSS to save or omit to save CSS compiled from added .less files.
	 *  - `replacements` (array): Associative array of [ 'find' => 'replace' ] for saved CSS. 
	 * @return int|bool Number of bytes written or boolean false on file_put_contents() error
	 * @throws \Exception|WireException
	 * 
	 */
	public function saveCss($file, array $options = array()) {
		
		$defaults = array(
			'css' => null, 
			'replacements' => array(),
		);
		
		$options = array_merge($defaults, $options);
		$files = $this->wire()->files;
		$file = $files->unixFileName($file);
		$path = dirname($file);
		$css = $options['css'];
		
		if(is_file($file) && !is_writable($file)) throw new WireException("File not writable: $file"); 
		if(!is_dir($path)) throw new WireException("Path does not exist: $path");
		if(!is_writable($path)) throw new WireException("Path not writeable: $path");
	
		if(empty($css)) $css = $this->getCss();
		if(empty($css)) $css = '/* no output from LESS parser */';
		
		if(!empty($options['replacements'])) {
			$a = $options['replacements'];
			$css = str_replace(array_keys($a), array_values($a), $css);
		}
		
		return $files->filePutContents($file, $css);
	}

	/**
	 * Returns LESS parser compatible with lessphp API (https://github.com/leafo/lessphp)
	 * 
	 * Note: this returns a new instance on every call. Whatever you do with lessc is 
	 * separate from the methods in this module, so if using lessc you should only use the
	 * returned lessc instance and not the API of this module. 
	 * 
	 * @return \lessc
	 * 
	 */
	public function lessc() {
		if(!class_exists('\lessc')) {
			require_once(__DIR__ . '/wikimedia/less.php/lessc.inc.php'); 
		}
		return new \lessc();
	}
	
	
	/****************************************************************
	 * BASE METHODS
	 * 
	 */
	
	/**
	 * Get instance of less parser
	 *
	 * This returns the same instance every time unless you $reset
	 *
	 * @param array|bool $options Options array or boolean true to reset parser instance (only)
	 * @return \Less_Parser
	 *
	 */
	public function parser($options = array()) {
		
		if(is_array($options)) {
			if(count($options)) $this->setOptions($options);
		} else if($options === true) {
			$this->parser = null;
		}
		
		if($this->parser) return $this->parser;
		
		if(!class_exists('\Less_Parser', false)) {
			require_once(__DIR__ . '/wikimedia/less.php/lib/Less/Autoloader.php');
			\Less_Autoloader::register();
		}
		
		$options = $this->options;
		$useCache = (int) $this->useCache;
		if($useCache) $options['cache_dir'] = $this->cachePath();
		
		$this->parser = new \Less_Parser($options);
		
		if(count($this->parseFiles)) {
			foreach($this->parseFiles as $file => $url) {
				$this->parser->parsefile($file, $url);
			}
			$this->parseFiles = array();
		}
		
		return $this->parser;
	}

	/**
	 * Add a LESS string to parse (alias of addStr method)
	 *
	 * @param string $str
	 * @param string $url Optional root URL of the file for image references
	 * @return self
	 *
	 */
	public function parse($str, $url = '') {
		$this->parser()->parse($str, $url);
		$this->gotCss = false;
		$this->parseStr = true;
		return $this;
	}

	/**
	 * Add a LESS file to parse (alias of addFile method)
	 *
	 * @param string $file
	 * @param string $url Optional root URL of the file for image references
	 * @return self
	 * @throws \Less_Exception_Parser
	 *
	 */
	public function parseFile($file, $url = '') {
		if($this->parser) {
			$this->parser->parsefile($file, $url);
		} else {
			$this->parseFiles[$file] = $url;
		}
		$this->gotCss = false;
		return $this;
	}

	/**
	 * Get cache path
	 * 
	 * @param bool $create
	 * @return string
	 * @throws WireException
	 * 
	 */
	protected function cachePath($create = true) {
		$cachePath = $this->wire()->config->paths->cache . $this->className() . '/';
		if($create && !is_dir($cachePath)) $this->wire()->files->mkdir($cachePath);
		return $cachePath;
	}

	/**
	 * Clear any cache files
	 * 
	 */
	public function clearCache() {
		$cachePath = $this->cachePath(false);
		if(is_dir($cachePath)) $this->wire()->files->rmdir($cachePath, true);
	}

	/**
	private function getCssCache(array $lessFiles) {
		$config = $this->wire()->config;
		$files = $this->wire()->files;
		$cachePath = $config->paths->cache . 'Less/';
		if(!is_dir($cachePath)) $files->mkdir($cachePath);
		$options = array('cache_dir' => $cachePath);
		$cssFile = \Less_Cache::Get($lessFiles, $options);
		return $cssFile ? file_get_contents($cssFile) : '';
	}
	 */
	
	public function ___install() {
		$this->cachePath();
	}
	
	public function ___uninstall() {
		$this->clearCache();
	}

	/**
	 * Module config
	 * 
	 * @param InputfieldWrapper $inputfields
	 *
	 */
	public function getModuleConfigInputfields(InputfieldWrapper $inputfields) {
		$modules = $this->wire()->modules;
		$files = $this->wire()->files;
		$input = $this->wire()->input;
		
		/** @var InputfieldToggle $f */
		$f = $modules->get('InputfieldToggle');
		$f->attr('name', 'useCache');
		$f->label = $this->_('Allow use of file system cache? (/site/assets/cache/Less)'); 
		$f->description = $this->_('This can help with the performance of parsing LESS files into CSS files.'); 
		$f->val((int) $this->useCache);
		$inputfields->add($f);

		$cachePath = $this->cachePath(false);
		$numFiles = is_dir($cachePath) ? count($files->find($cachePath)) : 0; 
		
		if($input->post('_clearCache') || ($numFiles && !$this->useCache)) {
			if($numFiles) $this->clearCache();
			$this->message(sprintf($this->_('Cleared %d file(s) from cache'), $numFiles));
		}

		if($numFiles) {
			/** @var InputfieldCheckbox $f */
			$f = $modules->get('InputfieldCheckbox');
			$f->attr('name', '_clearCache');
			$f->label =
				$this->_('Clear cache?') . ' ' .
				sprintf($this->_n('(%d file)', '(%d files)', $numFiles), $numFiles);
			$f->showIf = 'useCache=1';
			$inputfields->add($f);
		}
	}

}
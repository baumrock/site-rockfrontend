<?php
/**
 * @private
 */
class Less_Tree_Attribute extends Less_Tree implements Less_Tree_HasValueProperty {

	public $key;
	public $op;
	public $value;

	public function __construct( $key, $op, $value ) {
		$this->key = $key;
		$this->op = $op;
		$this->value = $value;
	}

	public function compile( $env ) {
		$key_obj = is_object( $this->key );
		$val_obj = is_object( $this->value );

		if ( !$key_obj && !$val_obj ) {
			return $this;
		}

		return new self(
			$key_obj ? $this->key->compile( $env ) : $this->key,
			$this->op,
			$val_obj ? $this->value->compile( $env ) : $this->value );
	}

	/**
	 * @see Less_Tree::genCSS
	 */
	public function genCSS( $output ) {
		$output->add( $this->toCSS() );
	}

	public function toCSS() {
		$value = $this->key;

		if ( $this->op ) {
			$value .= $this->op;
			$value .= ( is_object( $this->value ) ? $this->value->toCSS() : $this->value );
		}

		return '[' . $value . ']';
	}
}

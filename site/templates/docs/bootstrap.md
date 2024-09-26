# Bootstrap

Bootstrap is a popular CSS framework that can be used to design and style your web pages. If you prefer to use Bootstrap or any other CSS framework, you can easily integrate it into your project.

Here is what you have to do to use Bootstrap (or any other framework) instead of UIkit:

- Download Bootstrap to a folder like `/site/templates/bootstrap`.
- Go to `/site/templates/_init.php` and remove all scripts and styles related to UIkit.
- Add all necessary assets from Bootstrap instead.

You can now use Boostrap along RockFrontend. Note that I didn't test if Bootstrap's less files are compatible with PHP based Less parsing. If not, just use other parsers.

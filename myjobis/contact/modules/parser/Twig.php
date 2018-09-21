<?php
include(MODULES_DIR.'/vendor/Twig/Autoloader.php');
class Parser_Twig {

	var $twig;
	var $context;

	public function __construct() {
		$this->init();
	}

	public function init() {

		Twig_Autoloader::register();

		$loader = new Twig_Loader_Filesystem(MODULES_DIR.'/tpl/');

		$options = array('cache' => false, 'debug' => false);
		$this->twig = new Twig_Environment($loader, $options);

		// エスケープ処理させる
		$escaper = new Twig_Extension_Escaper(true);
		$this->twig->addExtension($escaper);
	}

	public function set($name, $value) {
		$this->context[$name] = $value;
	}

	public function display($file) {
		$template = $this->twig->loadTemplate($file);
		$template->display($this->context);
		exit();
	}
}
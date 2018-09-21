<?php

// プラグインの登録
$this->registerPlugins('before','smartyanytime_plugins_siteclose','start',1);

class smartyanytime_plugins_siteclose extends smartyanytime_plugins {
	function start( ) {
		if( $this->smartyanytime['site']['standby'] == 0 ) return;
		if(!$_COOKIE['CakeCookie']['alc'] || !$_COOKIE['CakeCookie']['alc']==1) {

			$standby_file = 'standby.html';

			if($this->smartyanytime['info']['mobile'] && !$this->smartyanytime['info']['smartphone']) {
				$standby_file = 'mb_standby.html';
			}
			else {
				$standby_file = 'standby.html';
			}
			$standby_file = $this->smartyanytime['info']['wwwroot_path'].'/'.$standby_file;

			if(!file_exists($standby_file)) die('close...');
			include($standby_file);
			exit();
		}
	}
}
?>
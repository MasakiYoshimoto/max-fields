<?php

$this->registerPlugins('after','smartyanytime_plugins_entities','start',10000);

class smartyanytime_plugins_entities extends smartyanytime_plugins {

	function start( ) {
		$value = $this->smarty->_tpl_vars;
		$value = smartyanytime_util::htmlentitiesExtend( $value , 'utf-8' );
		$value = smartyanytime_util::replaceExtend( "\\\\" , "￥" ,$value );
		$this->smarty->_tpl_vars = $value;
	}

}
?>
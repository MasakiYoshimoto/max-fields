<?php

$this->smarty->register_block('contents_replace', 'replaceContents',false);
$this->smarty->register_function('contents_include', 'includeContents', false);
$this->smarty->register_function('wwwroot', 'wwwroot', false);

class smartyanytime_plugins_basic extends smartyanytime_plugins {
	function start( ) {}
}

function replaceContents($params, $content, &$smarty, &$repeat) {

	$obj = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplepages'];

	if(!$repeat){ // 終了タグのみ
		if (isset($content)) {

			$parts_id = $params['parts'];

			if(isset($parts_id)===true) {

				$parts = $obj->_getPartsByID ( $parts_id );

				return $smarty->fetch('real:' . $parts ,'parts_'.htmlentities($parts_id),'parts_'.htmlentities($parts_id));

			}
			else {
				// 各値の基本値を設定
				$file = ($params['file'])?($params['file']):('');

				$file_path = PARTS_TEMPLATE_DIR .'/'. $file;

				if( $file && file_exists($file_path) ) {
					// 出力
					return $smarty->fetch('file:' . $file_path ,'parts_'.htmlentities($file),'parts_'.htmlentities($file));
				}
				else {
					return '';
				}
			}
		}
	}
}

// インクルード用
function includeContents($params, &$smarty) {

	$obj = $smarty->smartyanytime['plugins']['smartyanytime_plugins_simplepages'];

	$parts_id = $params['parts'];

	if(isset($parts_id)===true) {
		$parts = $obj->_getPartsByID ( $parts_id );

		$smarty->display('real:' . $parts ,'parts_'.htmlentities($parts_id),'parts_'.htmlentities($parts_id));
	}
	else {

		// 各値の基本値を設定
		$file = ($params['file'])?($params['file']):('');

		$file_path = PARTS_TEMPLATE_DIR .'/'. $file;

		if( $file && file_exists($file_path) ) {
			// 出力
			$smarty->display('file:' . $file_path ,'parts_'.htmlentities($file),'parts_'.htmlentities($file));
		}
	}
}

// WWWROOTを出力する
function wwwroot($params, &$smarty) {

	if($params['ssl']==='auto') {
		if($smarty->smartyanytime['info']['ssl']) {
			$protocol = 'https://';
		}
		else {
			$protocol = 'http://';
		}
	}
	elseif($params['ssl']) {
		$protocol = 'https://';
	}
	else {
		$protocol = 'http://';
	}
	$host = $smarty->smartyanytime['info']['host'];
	$wwwroot = ($smarty->smartyanytime['info']['wwwroot']=='/')?(''):($smarty->smartyanytime['info']['wwwroot']);

	return $protocol.$host.$wwwroot;
}
?>
<?php
/* SVN FILE: $Id: smarty.php 33 2012-12-04 02:33:58Z arms $ */
/**
 * Smarty設定
 *
 * @filesource
 * @copyright		Copyright (c) 2007, Catchup
 * @link			http://www.e-catchup.jp
 * @version      1.0.0
 * @package		cake
 * @subpackage		cake.app.config
 * @since			CakePHP v 1.1.19.6305
 * @version		$Revision: 33 $
 * @modifiedby		$LastChangedBy: arms $
 * @lastmodified	$Date: 2012-12-04 11:33:58 +0900 (火, 04 12 2012) $
 * @license		http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * デリミター
 */
define('SMARTY_LEFT_DELIMITER','{{');
define('SMARTY_RIGHT_DELIMITER','}}');echo "here";
/**
 * プラグインディレクトリ
 */
define('SMARTY_PLUGINS_DIR',VIEWS.'smarty_plugins'.DS);
/**
 * コンパイルディレクトリ
 */
define('SMARTY_COMPILE_DIR',TMP.'smarty'.DS.'compile'.DS);
/**
 * キャッシュディレクトリ
 */
define('SMARTY_CACHE_DIR',TMP.'smarty'.DS.'cache'.DS);
/**
 * テンプレートディレクトリ
 */
define('SMARTY_TEMPLATE_DIR',ROOT . DS . APP_DIR . DS . 'views/');
/**
 * 設定ファイルディレクトリ
 */
define('SMARTY_CONFIG_DIR',ROOT . DS . APP_DIR . DS . 'config/smarty');
/**
 * テンプレート拡張子
 */
define('SMARTY_EXT','.html');
/**
 * サブディレクトリ
 *
 * viewディレクトリ内の各ディレクトリの中にsmarty用のディレクトリ
 * を作る場合は、ディレクトリ名称を指定
 */
define('SMARTY_SUB_DIR','');
/**
 * 出力文字コード
 *
 * SJIS / EUC-JP / UTF-8
 */
define('SMARTY_OUTPUT_ENCODING','UTF-8');
/**
 * WEBサイト全体用設定ファイル
 *
 * 利用する場合は、設定ファイルディレクトリに site.conf を設置する。全てのページで読み込まれる。
 *
 * true / false
 */
define('SMARTY_SITE_CONF',false);
/**
 * Pages用設定ファイル
 *
 * 利用する場合は、設定ファイルディレクトリに pages.conf を設置する。
 * 拡張子を除くファイル名までのパスをセクションとして設定するとそのファイルより読み込る。
 * （例）[directory/pagename]複数階層の場合はディレクトリ名を全てスラッシュで区切る事。
 *
 * true / false
 */
define('SMARTY_PAGES_CONF',false);
?>

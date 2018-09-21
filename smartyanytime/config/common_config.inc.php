<?php
/////////////////////////////////////////////
// ディレクトリ設定
////////////////////////////////////////////
define('CONF_DIR' , SMARTYANYTIME_DIR.'/config' );
define('PLUGIN_DIR' , SMARTYANYTIME_DIR.'/plugins' );
define('PARTS_TEMPLATE_DIR' , WWWROOT.'/parts' );

/////////////////////////////////////////////
// DBの設定
////////////////////////////////////////////
define('USE_DB'            , true );
define('DB_HOST_ADDRESS'   , 'mysql5016.xserver.jp' );
define('DB_PORT'           , '3306' );
define('DB_ID'             , 'joblive_maxfield' );
define('DB_PASS'           , 'maxlogin' );
define('DB_NAME'           , 'joblive_maxfields' );
define('DB_ENCODING'       , 'utf8');
define('DB_PREFIX'            , 'cms_');

//////////////////////////////
// smartyの設定
//////////////////////////////
define('SMARTY_DIR' , SMARTYANYTIME_DIR . '/tools/smarty/' );
define('SMARTY_COMPILE_DIR'   , SMARTYANYTIME_DIR . '/templates_c/');
define('SMARTY_CONFIG_DIR'   , SMARTY_DIR . 'configs/');
define('SMARTY_CACHE_DIR'   , SMARTY_DIR . 'cache/');

//////////////////////////////
// .phpの.html変換
// TRUEにすると.phpのアクセスが.htmlと同じになります。
//////////////////////////////
define('TRANSFER_HTML_EXT', false );

//////////////////////////////
// 404エラーの設定
// TRUEにすると存在しないページの場合
// 404ページへリダイレクトされます。（404ヘッダは出力されません。）
//////////////////////////////
define('REDIRECT404', true );
?>

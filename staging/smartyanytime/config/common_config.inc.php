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
define('DB_HOST_ADDRESS'   , 'localhost' );
define('DB_PORT'           , '3306' );
define('DB_ID'             , 'evolve-max' );
define('DB_PASS'           , 'JT72WuLt' );
define('DB_NAME'           , 'cms' );
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

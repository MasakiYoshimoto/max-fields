<?php

// クリアするテンポラリディレクトリ
define ( 'CLEAR_CACHE_PATH' , str_replace(APP_DIR.'/','',WWW_ROOT).'cms_contents'.DS.'cache'.DS);

// クリアする日数
define ( 'CLEAR_DAYS' , 1 );
?>
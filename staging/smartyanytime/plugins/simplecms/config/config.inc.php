<?php

	//////////////////////////////
	// テンプレート設定
	//////////////////////////////

	define('DEFAULT_SC_TEMPLATE_DIR' , SMARTYANYTIME_DIR.'/plugins/simplecms/tpl' );
	define('DEFAULT_LIST_TEMPLATE' , DEFAULT_SC_TEMPLATE_DIR.'/default_list.html' );
	define('DEFAULT_PAGELIST_TEMPLATE' , DEFAULT_SC_TEMPLATE_DIR.'/default_pagelist.html' );
	define('DEFAULT_IMAGELIST_TEMPLATE' , DEFAULT_SC_TEMPLATE_DIR.'/default_imagelist.html' );
	define('DEFAULT_FILELIST_TEMPLATE' , DEFAULT_SC_TEMPLATE_DIR.'/default_filelist.html' );
	define('DEFAULT_ARCHIVES_TEMPLATE' , DEFAULT_SC_TEMPLATE_DIR.'/default_archivelist.html' );
	define('DEFAULT_CATEGORIES_TEMPLATE' , DEFAULT_SC_TEMPLATE_DIR.'/default_categorieslist.html' );
	define('DEFAULT_ARCHIVES_PAGELIST_TEMPLATE' , DEFAULT_SC_TEMPLATE_DIR.'/default_archives_pagelist.html' );
	define('DEFAULT_CATEGORIES_PAGELIST_TEMPLATE' , DEFAULT_SC_TEMPLATE_DIR.'/default_categories_pagelist.html' );

	//////////////////////////////
	// ディレクトリ設定
	//////////////////////////////
	define('CONTENTS_DIR','/cms_contents');
	define('IMAGE_DIR',CONTENTS_DIR.'/images');
	define('FILE_DIR',CONTENTS_DIR.'/files');

	/////////////////////////////////////////////
	// アイテムタイプの設定
	////////////////////////////////////////////
	define('ITEM_TYPE_TEXT'       , 1 ); // 一行テキスト
	define('ITEM_TYPE_TEXTAREA'   , 2 ); // テキストエリア
	define('ITEM_TYPE_IMAGE'      , 3 ); // 画像ファイル
	define('ITEM_TYPE_APPENDFILE' , 4 ); // 添付ファイル
	define('ITEM_TYPE_RADIO'      , 5 ); // ラジオボタン
	define('ITEM_TYPE_SELECT'     , 6 ); // セレクト
	define('ITEM_TYPE_CHECK'      , 7 ); // チェックボックス
	define('ITEM_TYPE_DATE'       , 8 ); // 日付
	define('ITEM_TYPE_DATETIME'   , 9 ); // 日時

	//////////////////////////////
	// TinyMCE利用
	// ブログ形式の場合はここをfalse
	//////////////////////////////
	define('USE_TINYMCE',true);
?>
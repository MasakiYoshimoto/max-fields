<?php

// コンパネ設置場所サブディレクトリ
define('SUB_DIR' ,'/');
define('SITE_TOP_URL' , $_SERVER['SERVER_NAME'] . SUB_DIR );
define('DOCUMENT_ROOT',$_SERVER['DOCUMENT_ROOT']);
define('CMS_WWW_ROOT' , DOCUMENT_ROOT .SUB_DIR );

// アップロード先
define('CONTENTS_DIR_NAME'  , 'cms_contents/' ); // アップロード先ディレクトリ名
define('CONTENTS_URL'  , SUB_DIR . CONTENTS_DIR_NAME ); // アップロード格納先URL
define('CONTENTS_DIR'  , CMS_WWW_ROOT . CONTENTS_DIR_NAME ); // アップロード格納先

// 画像アップロード設定
define('IMAGE_DIR_NAME'  , 'images/' ); // 画像ディレクトリ名
define('IMAGE_URL'  , CONTENTS_URL . IMAGE_DIR_NAME ); // 画像ディレクトリURL
define('IMAGE_DIR'  , CONTENTS_DIR . IMAGE_DIR_NAME ); // 画像ディレクトリ

// 添付ファイルアップロード設定
define('APPEND_DIR_NAME'  , 'files/' ); // 添付ファイルディレクトリ名
define('APPEND_URL'  , CONTENTS_URL . APPEND_DIR_NAME ); // 添付ファイルディレクトリURL
define('APPEND_DIR'  , CONTENTS_DIR . APPEND_DIR_NAME ); // 添付ファイルディレクトリ

// テンポラリ設定
define('FILE_TEMP_DIR_NAME' , 'temp/' ); // テンポラリディレクトリ名
define('FILE_TEMP_DIR'     , CMS_WWW_ROOT . 'control/' . FILE_TEMP_DIR_NAME ); // テンポラリディレクトリ
define('FILE_TEMP_URL'     , SUB_DIR . 'control/' . FILE_TEMP_DIR_NAME ); // テンポラリディレクトリURL
define('DELETE_DAYS'     , 1 ); // 一日たったら削除

// ログイン失敗可能数
define('LOGIN_FAULT_MAX' ,5);

// ファイルアップロードのサイズ上限
define('MAX_FILE_SIZE'     , 2097152 ); // 2M

// リスト最大表示件数
define('LIST_MAX'  , 30 );

// 基本機能の使用
define('USE_DEFAULT_FUNCTION',true); // falseにすると基本機能のインフォメーション更新とか使用できなくなります

// 基本機能CMSカテゴリーの利用レベル
define('CMS_CATEGORY_ALLOW_LEVEL',99); // 設定したレベル以上で使用可能

// 基本機能CMSカテゴリーで選択しないを使用する
define('CMS_CATEGORY_USE_NOSELECT',false);

// CRYPT_BLOWFISHの利用
define('USE_CRYPT_BLOWFISH',true); // 通常はTRUE

// CRYPT_BLOWFISHの利用時のKEY
define('SECRET_KEYWORD','ARMS_CMS_DEV_9RU56TCS'); // 設置毎に変更する
define('SECRET_KEYWORD2','ARMS_CMS_DEV_8F6VQXNXLH2ZRQZZ');

// TinyMCEの利用
define('USE_TINYMCE',true);

// プレビュー画像のサイズ
define('PREVIEW_W',150); // 横
define('PREVIEW_H',150); // 縦

// 画像ファイルの最大サイズ
define('ALLOW_MAX_IMGSIZE', 2000);

// ファイルアップロードの許可指定
define('ALLOW_FILES','xls,xlsx,doc,docx,ppt,pptx,pdf,zip,flv');

// アイテムタイプ
define('ITEM_TYPE_TEXT'       , 1 ); // 一行テキスト
define('ITEM_TYPE_TEXTAREA'   , 2 ); // テキストエリア(WYSIWYG)
define('ITEM_TYPE_IMAGE'      , 3 ); // 画像ファイル
define('ITEM_TYPE_APPENDFILE' , 4 ); // 添付ファイル
define('ITEM_TYPE_RADIO'      , 5 ); // ラジオボタン
define('ITEM_TYPE_SELECT'     , 6 ); // セレクト
define('ITEM_TYPE_CHECK'      , 7 ); // チェックボックス
define('ITEM_TYPE_DATE'       , 8 ); // 日付
define('ITEM_TYPE_DATETIME'   , 9 ); // 日時
//define('ITEM_TYPE_NUMERIC'    , 10 ); // 一行テキスト(数字)
define('ITEM_TYPE_NORMALTEXTAREA' , '10'); // テキストエリア
?>
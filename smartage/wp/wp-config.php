<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link http://wpdocs.osdn.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define('DB_NAME', 'cms');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'smartage');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', 'tt84g9v6awze09');

/** MySQL のホスト名 */
define('DB_HOST', '');

/** データベースのテーブルを作成する際のデータベースの文字セット */
define('DB_CHARSET', 'utf8');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '~6O {(sz)XB~uP$l2?w$WP+@a77#7Enw;j;/UfVA]1AkGg$#?8_Y;c X3SyCBx]}');
define('SECURE_AUTH_KEY',  'G1E8y&PA[=>P?J6Y1r]#_5=Ay8LK-)5_nz9fnYl4FjFVT0+Ak!_wi e.Y-(K 1fT');
define('LOGGED_IN_KEY',    '[hHIdhB$5Q![^[Kd*j>/%Dt6$LZ4]YhC$__W(IVvF.vV@_o;T9ohuIVZ1[_:3@%k');
define('NONCE_KEY',        'e3&2`bqfieE[TaqCT}>VJ;!2Y-#mi2mbr@W+b=`Xqj~y#!)F%;^KwU$MoE@J&jQw');
define('AUTH_SALT',        '=k.2 hvC]4[p(AJP9Xv/_ky3{5[U7f&fz4.M8Ora)S|BK`pf^L1{D:H5`&sI%Jp{');
define('SECURE_AUTH_SALT', 'w^cVqX{-~VLW,0,dr*SHq?M=@axB3Pcx(O@)xyXEC;wqElo~[h~U9%8M8a~WTp@v');
define('LOGGED_IN_SALT',   'C|P2(441gs%p.F$O<B {w&*SxLRVZMs^e28,>;t,=3A0iuG2p&(_k^tew+C9AsmF');
define('NONCE_SALT',       'y3cIdWN l;qtaacalM/eGNGPsTj1&@(@NH~,Dl,EXBy5W8-]_8{u?`eP^SY]xF=@');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix  = 'smartage_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数については Codex をご覧ください。
 *
 * @link http://wpdocs.osdn.jp/WordPress%E3%81%A7%E3%81%AE%E3%83%87%E3%83%90%E3%83%83%E3%82%B0
 */
define('WP_DEBUG', false);

/* 編集が必要なのはここまでです ! WordPress でブログをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

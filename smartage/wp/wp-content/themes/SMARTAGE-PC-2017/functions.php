<?php
/*
██████  ███████ ███████ ██ ███    ██ ███████
██   ██ ██      ██      ██ ████   ██ ██
██   ██ █████   █████   ██ ██ ██  ██ █████
██   ██ ██      ██      ██ ██  ██ ██ ██
██████  ███████ ██      ██ ██   ████ ███████
*/
/*━━━━━━━━━━━━━━━
定数・共通変数
━━━━━━━━━━━━━━━*/
define('H_URL',home_url('/'));                       //ホームURL
define('T_URL',get_template_directory_uri() . '/');  //テーマディレクトリ
define('T_PATH',get_template_directory() . '/');     //テーマディレクトリ　サーバーパス
define('A_URL',get_theme_root_uri() . '/assets/');   //共用ファイルテーマディレクトリ　不要な場合はコメントアウト
define('A_PATH',get_theme_root() . '/assets/');      //共用ファイルテーマディレクトリ　サーバーパス　不要な場合はコメントアウト
define('U_URL',content_url() . '/uploads/');         //メディアアップロードディレクトリ

define('MQ_PC','min-width:737px');	//PCブレークポイント
define('MQ_TA','');					//タブレットブレークポイント
define('MQ_SP','max-width:736px');	//SPブレークポイント
define('SNS_TWIT','//twitter.com/');	//公式Twitter
define('SNS_FACE','//ja-jp.facebook.com/');	//公式Facebook
define('SNS_INST','//www.instagram.com/');	//公式INSTAGRAM
if(is_admin()){
	define('CONCATENATE_SCRIPTS',false);	//JS統合無効化
	define('COMPRESS_SCRIPTS',false);		//JS圧縮無効化
}

/*
██ ███    ███  ██████
██ ████  ████ ██
██ ██ ████ ██ ██   ███
██ ██  ██  ██ ██    ██
██ ██      ██  ██████
*/
/*━━━━━━━━━━━━━━━
画像サイズ
━━━━━━━━━━━━━━━*/
add_theme_support('post-thumbnails');	//アイキャッチ有効化
add_image_size('side-thumbnail',90,60,array('center','center'));
//独自画像サイズ定義　トリミング（左右,上下）
//add_image_size('サイズ名',横幅,縦幅,false);

/*
 ██████ ██    ██ ███████       ██████   ██████  ███████ ████████
██      ██    ██ ██            ██   ██ ██    ██ ██         ██
██      ██    ██ ███████ █████ ██████  ██    ██ ███████    ██
██      ██    ██      ██       ██      ██    ██      ██    ██
 ██████  ██████  ███████       ██       ██████  ███████    ██
*/

/*━━━━━━━━━━━━━━━
カスタム投稿
━━━━━━━━━━━━━━━*/
//new add_custompost('postname','表示名',array(array('tax','分類')),エディタ,アイキャッチ,アーカイブ);
//new add_custompost('postname','表示名',array(array('tax','分類')),FALSE,FALSE,FALSE);
new add_custompost('voice','お客様の声',array(false),true,FALSE,FALSE);

class add_custompost{
	public $post;		//投稿スラッグ
	public $postname;	//投稿名
	public $editor;		//エディタ有無
	public $thumbnail;	//アイキャッチ有無
	public $tax;		//タクソノミー
	public $supports;	//設定格納用
	public function __construct($post,$postname,$tax=FALSE,$editor=FALSE,$thumbnail=FALSE,$archive=TRUE){
		$this->post      = $post;
		$this->postname  = $postname;
		$this->editor    = $editor;
		$this->thumbnail = $thumbnail;
		$this->tax       = $tax;
		$this->archive   = $archive;

		$this->supports = array('title','page-attributes');
		if($this->editor){
			$this->supports[] = 'editor';	//エディタON
		}
		if($this->thumbnail){
			$this->supports[] = 'thumbnail';	//アイキャッチON
		}
		add_action('init',array($this,'create_custompost'));
	}
	public function create_custompost(){
		$labels = array(	//ラベル設定
			'name'               => _x($this->postname,'post type general name'),
			'singular_name'      => _x($this->postname,'post type singular name'),
			'add_new'            => _x('新規追加',$this->post),
			'add_new_item'       => __('新規追加'),
			'edit_item'          => __('編集'),
			'new_item'           => __($this->postname),
			'view_item'          => __($this->postname . 'を見る'),
			'search_items'       => __($this->postname . 'を探す'),
			'not_found'          => __($this->postname . 'はありません'),
			'not_found_in_trash' => __($this->postname . 'はありません'),
			'parent_item_colon'  => "",
		);
		$args = array(	//投稿設定
			'labels'             => $labels,	//ラベル設定を反映
			'public'             => true,		//ラベル設定
			'publicly_queryable' => true,
			'show_ui'            => true,
			'query_var'          => true,
			'rewrite'            => true,
			'capability_type'    => 'post',
			'hierarchical'       => false,
			'rewrite'            => array(
				'with_front'         => false,
			),
			'menu_position'      => 5,
			'supports'           => $this->supports,	//エディタやアイキャッチの有無
			'has_archive'        => $this->archive,	//アーカイブ
		);
		register_post_type($this->post,$args);
		if($this->tax){
			foreach((array)$this->tax as $tax){	//配列の数だけタクソノミー定義
				register_taxonomy(
					$tax[0],	//スラッグ
					$this->post,	//適用するカスタム投稿
					array(
						'hierarchical'          => true,	//階層設定
						'update_count_callback' => '_update_post_term_count',
						'label'                 => $tax[1],
						'singular_label'        => $tax[1],
						'public'                => true,
						'show_ui'               => true,
					)
				);
			}
		}
	}
}

/*
███████  ██████ ███████
██      ██      ██
███████ ██      █████
     ██ ██      ██
███████  ██████ ██
*/

/*━━━━━━━━━━━━━━━
Smart Custom Fields
━━━━━━━━━━━━━━━*/
// add_action( 'admin_enqueue_scripts','CSF_RemovePageEditor');	//指定固定ページの本文エディタ削除
// function CSF_RemovePageEditor() {
// 	$slug = get_post(get_the_ID())->post_name;
// 	if($slug === 'part-topbnr' || $slug === 'part-grid'){	//本文エディタを削除するページ
// 		remove_post_type_support( 'page', 'editor' );
// 	}
// }
add_action('admin_enqueue_scripts','SCF_CSSPlus');	//入力改善用のCSS/JS追記
function SCF_CSSPlus(){
	echo '
	<style>
	.smart-cf-meta-box-table tr th{
		width:auto;
	}
	.mce-edit-area iframe{
		height:600px!important;
	}
	.smart-cf-meta-box .smart-cf-upload-image img, .smart-cf-meta-box .smart-cf-upload-file img{
		max-width:30%;
	}
	.smart-cf-meta-box .smart-cf-meta-box-table .smart-cf-relation-right
	,.smart-cf-meta-box .smart-cf-meta-box-table .smart-cf-relation-left {
	    height: 300px;
	}
	.smart-cf-meta-box .smart-cf-meta-box-table .smart-cf-relation-left .smart-cf-relation-children-select{
		height:260px;
	}
	.smart-cf-meta-box .smart-cf-meta-box-table .smart-cf-relation-right ul{counter-reset:count-number;}
	.smart-cf-meta-box .smart-cf-meta-box-table .smart-cf-relation-right ul li:before {
	  counter-increment: count-number;
	  content: counters(count-number,".") " ";
	  display: inline-block;
	}
	</style>
	';
}

function scf_meta_box($settings,$post_type,$post_id ) {
	$slug = get_post($post_id)->post_name;	//スラッグ取得
	if (in_array($post_type, array('page'))){	//メタボックスを追加する投稿タイプ
		$Setting = SCF::add_setting( 'meta_', 'カスタムフィールド' );
//		$Setting->add_group( 'ユニークなID', 繰り返し可能か, カスタムフィールドの配列 );
		$Setting->add_group( 'group_1', false, array(
			array('type'      => 'text', //テキスト
				'name'        => 'h1',
				'instruction' => 'H1', //説明文
				'label'       => '', //ラベル
				'notes'       => '', //注意書き
				'default'     => '',	//初期値
			),
		));
		$settings[] = $Setting;
	}
	return $settings;
}
add_filter('smart-cf-register-fields','scf_meta_box',10,3);

//オプションページ
// SCF::add_options_page( 'ページタイトル', 'メニュータイトル', 'manage_options', 'theme-options' );

/*
██████   ██████  ███████ ████████
██   ██ ██    ██ ██         ██
██████  ██    ██ ███████    ██
██      ██    ██      ██    ██
██       ██████  ███████    ██
*/

/*━━━━━━━━━━━━━━━
投稿ページ
━━━━━━━━━━━━━━━*/
/*==============================
記事タイトルプレースホルダー
==============================*/
function title_placeholder($title){	//記事タイトル入力欄のプレースホルダーを変更
	$screen = get_current_screen();
	if($screen -> post_type == 'post'){
		$title = 'ここにタイトルを入力';
	}elseif($screen -> post_type == '＜カスタム投稿名＞'){
		$title = 'ここにタイトルを入力';
	}
	return $title;
}
add_filter('enter_title_here','title_placeholder');

/*==============================
カテゴリーバリデーション
==============================*/
/*
function post_validation(){	//カテゴリーバリデーション
	global $post_type;
	if($post_type == 'post')://投稿タイプ指定
		$term = 'category';//タクソノミー名 ?>
		<script type="text/javascript">
		jQuery("#post").attr("onsubmit","return check_category();");
		function check_category(){
			var catall = jQuery("#<?php echo $term; ?>checklist input:checked").length;	//選択総カテゴリー数
			var catchild = jQuery(".children input:checked").length;	//選択子カテゴリー数
			if(catchild){
				var catparent = total_check_num - child_check_num;	//選択親カテゴリー数
			}else{
				var catparent = catall;	//選択親カテゴリー数
			}
			if(catall <= 0){
				alert("カテゴリーが選択されていません。");
				jQuery("#ajax-loading").css("visibility","hidden");
				jQuery("#publish").removeClass("button-primary-disabled");
				jQuery(".spinner").removeClass("is-active");
				jQuery("#publish").removeClass("disabled");
				return false;
			}else{
				return true;	//内容更新を許可
			}
		}
		</script>
	<?php endif;
}
add_action('admin_footer-post.php','post_validation');
add_action('admin_footer-post-new.php','post_validation');
*/

/*==============================
カテゴリー入力ラジオボタン化
==============================*/
//new cat_change_radio('投稿名','カテゴリースラッグ');
class cat_change_radio{
	public $postname;
	public $taxname;
	public function __construct($post,$term){
		$this->postname = $post;
		$this->taxname  = $term;
		add_action('admin_print_footer_scripts',array($this,'cat_radio'),21);
	}
	public function cat_radio(){//カテゴリー入力をラジオボタン化
		global $post_type;
		if($post_type == $this->postname){
			echo '<script type="text/javascript">
			jQuery(function($){
				$("#' . $this->taxname . 'checklist input[type=checkbox],.' . $this->taxname . '-checklist input[type=checkbox]").each(function(){
					$(this).replaceWith($(this).clone().attr("type","radio"));
				});
				$("#posts-filter").each(function(){	//投稿一覧ならクイック編集用の処理を追加
					if(inlineEditPost && inlineEditPost.edit){
						var _Edit = inlineEditPost.edit;//元のeditの処理を取り出しておく
						inlineEditPost.edit = function(id){//edit関数を書き換える
							_Edit.apply(inlineEditPost,arguments);//元のeditの処理を行う
							var t = this,rowData,editRow;
							if(typeof(id) === "object"){
								id = this.getId(id);
							}
							editRow = $("#edit-"+id);//編集エリアは既にcloneされているものを取得
							rowData = $("#inline_"+id);
							$(".post_category",rowData).each(function(){//hierarchicaltaxonomies
								var $t = $(this),taxname,term_ids = $t.text();
								if(term_ids){
									taxname = $t.attr("id").replace("_"+id,"");
									$("ul."+taxname+"-checklist :radio",editRow).val(term_ids.split(","));//カテゴリーのラジオボタンにチェック
								}
							});
							return false;
						};
					}
				});
			});
			</script>';
		}
	}
}

/*==============================
エディタ
==============================*/
add_editor_style('style.css');//エディタのスタイル設定
function editor_class($initArray){
	$initArray['body_class'] = 'wp-post visual-editor';
//	$initArray['body_class'] = 'l-wppost t-blue';
	return $initArray;
}
add_filter('tiny_mce_before_init','editor_class');

/*------------------------------
指定投稿タイプのビジュアルエディタ無効化
------------------------------*/
function disable_visual_editor(){
	global $typenow;
	if($typenow == 'page' || $typenow == 'mw-wp-form'){//固定ページとMW WP Formで無効化
		add_filter('user_can_richedit','disable_visual_editor_filter');
	}
}
function disable_visual_editor_filter(){
	return false;
}
add_action('load-post.php','disable_visual_editor');
add_action('load-post-new.php','disable_visual_editor');

/*------------------------------
ビジュアルエディタの見出し1,2調整
------------------------------*/
function custom_editor_settings($initArray){
	$initArray['block_formats'] = "見出し1=h3; 見出し2=h4; 見出し3=h5; 段落=p; グループ=div;";
	return $initArray;
}
add_filter('tiny_mce_before_init','custom_editor_settings');

/*==============================
デフォルト投稿のカスタマイズ
==============================*/
$post_option = new post_option();
$post_option->post_rename('トピックス');//投稿名を変える
//$post_option->post_remove();//エディタ、タグ、カテゴリーを消す
// $post_option->post_remove(FALSE,TRUE,TRUE);//エディタ、タグ、カテゴリーを消す
//$post_option->post_permalink('スラッグ');

class post_option{
	public $link;
	public $newname;
	public function post_rename($name){
		$this->newname = $name;
		add_action('admin_menu',array($this,'revcon_change_post_label'));
		add_action('init',array($this,'revcon_change_post_object'));
	}
	public function revcon_change_post_label(){
		global $menu;
		global $submenu;
		$menu[5][0] = $this->newname;
		$submenu['edit.php'][5][0] = $this->newname;
		$submenu['edit.php'][10][0] = $this->newname . 'を書く';
		$submenu['edit.php'][16][0] = 'タグ';
		echo '';
	}
	public function revcon_change_post_object(){
		global $wp_post_types;
		$labels = &$wp_post_types['post']->labels;
		$labels->name = $this->newname;
		$labels->singular_name = $this->newname;
		$labels->add_new = $this->newname . 'を書く';
		$labels->add_new_item = $this->newname . 'を書く';
		$labels->edit_item = $this->newname . 'の編集';
		$labels->new_item = $this->newname;
		$labels->view_item = $this->newname . 'を見る';
		$labels->search_items = $this->newname . 'を探す';
		$labels->not_found = $this->newname . 'はありません';
		$labels->not_found_in_trash = $this->newname . 'はありません';
		$labels->all_items = '全ての' . $this->newname;
		$labels->menu_name = $this->newname;
		$labels->name_admin_bar = $this->newname;
	}
	public function post_permalink($link){
		$this->link = $link;
		add_filter('post_rewrite_rules',array($this,'custom_post_rewrite_rules')); //アクセスされた際に条件を判定する
		add_filter('pre_post_link',array($this,'custom_post_rewrite_structure'),10,2); //リンクを出力する時
	}
	function custom_post_rewrite_rules($post_rewrite){
		if($post_rewrite){
			$custom_rules = array();
			$prefix = $this->link . '/';
			foreach($post_rewrite as $key => $post_rule){
				$custom_rules[ $prefix . $key ] = $post_rule;
			}
			$post_rewrite = $custom_rules;//カスタマイズしたリンクをリターン
		}
		return $post_rewrite;//カスタマイズしたリンクを出力する
	}
	function custom_post_rewrite_structure($permalink,$post){
		if($permalink && $post->post_type == 'post'){ //$postはpostのインスタンス
			$permalink = '/' . $this->link . $permalink; //判定するリンクのカスタマイズ
		}
		return $permalink;
	}
	public function post_remove($editor=FALSE,$cat=FALSE,$tag=FALSE){
		if($editor){
			add_action('init',array($this,'remove_post_editor'));
		}
		if($cat){
			add_action('init',array($this,'remove_post_category'));
		}
		if($tag){
			add_action('init',array($this,'remove_post_tag'));
		}
	}
	public function remove_post_editor(){
		remove_post_type_support('post','editor');
	}
	public function remove_post_category(){
		unregister_taxonomy_for_object_type('category','post');
	}
	public function remove_post_tag(){
		unregister_taxonomy_for_object_type('post_tag','post');
	}
}

/*==============================
クイックタグ
==============================*/
function default_quicktags($qtInit){	//ボタン削除
	$qtInit['buttons'] = '　';	//指定しなかったIDのデフォルトボタンを削除
	return $qtInit;
}
add_filter('quicktags_settings','default_quicktags',10,1);

if(!function_exists('add_quicktags_to_text_editor')):
function add_quicktags_to_text_editor(){	//ボタン追加
	//スクリプトキューにquicktagsが保存されているかチェック
	if(wp_script_is('quicktags')): ?>
	<script>
	QTags.addButton('qt-bold','b','<b>','</b>');
	QTags.addButton('qt-uline','u','<span class="te-uline">','</span>');
	QTags.addButton('qt-p','p','<p>','</p>');
	QTags.addButton('qt-div','div','<div class="">','</div>');
	QTags.addButton('qt-br','br','<br>','');
	QTags.addButton('qt-h2','h2','<h2>','</h2>\n');
	QTags.addButton('qt-h3','h3','<h3>','</h3>\n');
	QTags.addButton('qt-h4','h4','<h4>','</h4>\n');
	QTags.addButton('qt-ol','ol','<ol class="">\n','</ol>\n');
	QTags.addButton('qt-ul','ul','<ul class="">\n','</ul>\n');
	QTags.addButton('qt-li','li','<li>','</li>');
	QTags.addButton('qt-table','table','<table>\n<thead>\n</thead>\n<tbody>\n','</tbody>\n</table>\n');
	QTags.addButton('qt-tr','tr','<tr>','</tr>');
	QTags.addButton('qt-th','th','<th>','</th>');
	QTags.addButton('qt-td','td','<td>','</td>');
	</script>
	<?php endif;
}
endif;
add_action('admin_print_footer_scripts','add_quicktags_to_text_editor');

/*==============================
デフォルトの編集エリアを非表示
==============================*/
add_action( 'init' , 'my_remove_post_editor_support' );
function my_remove_post_editor_support() {
  // remove_post_type_support( 'page', 'editor' ); // 「投稿」の編集エリアの場合はpageをpostに
}

/*
██   ██ ███████  █████  ██████  ███████ ██████
██   ██ ██      ██   ██ ██   ██ ██      ██   ██
███████ █████   ███████ ██   ██ █████   ██████
██   ██ ██      ██   ██ ██   ██ ██      ██   ██
██   ██ ███████ ██   ██ ██████  ███████ ██   ██
*/

/*━━━━━━━━━━━━━━━
ヘッダー
━━━━━━━━━━━━━━━*/
/*==============================
コード削減
==============================*/
//通常ページ絵文字
remove_action('wp_head','print_emoji_detection_script',7);
remove_action('wp_print_styles','print_emoji_styles');

//管理画面絵文字
remove_action('admin_print_scripts','print_emoji_detection_script');
remove_action('admin_print_styles','print_emoji_styles');

//RSS絵文字
remove_action('the_content_feed','wp_staticize_emoji');
remove_action('comment_text_rss','wp_staticize_emoji');

//バージョン情報
remove_action('wp_head','wp_generator');

/*━━━━━━━━━━━━━━━
検索
━━━━━━━━━━━━━━━*/
function search_for_title($search){//本文をキーワード検索対象から外す
	return preg_replace("/ OR \([^\(\.]+.post_content LIKE '%.+%'\)/u","",$search);
}
//add_filter('posts_search','search_for_title');//キーワード検索対象をタイトルだけにする
//remove_filter('posts_search','search_for_title');//キーワード検索対象を通常に戻す

function search_for_post($query){//検索対象の投稿タイプを限定する
	if($query->is_search){
		$query->set('post_type',array('post','page'));
	}
	return $query;
}
//add_filter('pre_get_posts','search_for_post');


/*
 █████  ██████  ███    ███ ██ ███    ██
██   ██ ██   ██ ████  ████ ██ ████   ██
███████ ██   ██ ██ ████ ██ ██ ██ ██  ██
██   ██ ██   ██ ██  ██  ██ ██ ██  ██ ██
██   ██ ██████  ██      ██ ██ ██   ████
*/

/*━━━━━━━━━━━━━━━
管理画面
━━━━━━━━━━━━━━━*/
/*------------------------------
ヘッド追加処理
------------------------------*/
function AdminPlus(){	//CSS/JS追記
	echo '
	<style>
	button,input,select,textarea,textarea.wp-editor-area{
		font-family:"游ゴシック体","Yu Gothic",YuGothic,"Hiragino Kaku Gothic ProN","ヒラギノ角ゴ ProN W3","Meiryo","メイリオ","sans-serif";
	}
	</style>
	';
//if(get_post_type() === 'post'){}
	echo '

	';
}
add_action('admin_enqueue_scripts','AdminPlus');


/*==============================
投稿一覧カラム
==============================*/
function add_page_columns_name($columns){//固定ページ一覧にスラッグ欄を追加
	$columns['slug'] = "スラッグ";
	return $columns;
}
function add_page_column($column_name,$post_id){
	if($column_name == 'slug'){
		$post = get_post($post_id);
		$slug = $post->post_name;
		echo attribute_escape($slug);
	}
}
add_filter('manage_pages_columns','add_page_columns_name');
add_action('manage_pages_custom_column','add_page_column',10,2);

/*==============================
管理バー
==============================*/
add_theme_support('admin-bar',array('callback' => '__return_false'));//管理バーの高さをレイアウトに影響させない

//アイテム削除
add_action('admin_bar_menu','admin_bar_remove_item',1000);
function admin_bar_remove_item($wp_admin_bar){//管理バーの不要項目削除
	$wp_admin_bar->remove_node('wp-logo');//WPロゴ
	$wp_admin_bar->remove_node('customize');//カスタマイズ
	$wp_admin_bar->remove_node('updates');//更新通知
	$wp_admin_bar->remove_node('comments');//コメント
//	$wp_admin_bar->remove_node('new-content');//新規
	$wp_admin_bar->remove_node('new-media');//新規メディア
	$wp_admin_bar->remove_node('new-user');//新規ユーザー
//	$wp_admin_bar->remove_node('user-info');//ユーザー情報
//	$wp_admin_bar->remove_node('edit-profile');//プロフィール編集
	$wp_admin_bar->remove_node('search');//検索
}

//アイテム追加
add_action('admin_bar_menu','admin_bar_add_item', 9999);
function admin_bar_add_item($wp_admin_bar){
	$url = get_the_permalink($post_id);
	$url = preg_replace('!' . home_url('/') . '!im','',$url);
	$phplink  = '&lt;?php echo home_url(\'/\'); ?&gt;' . $url;
	$wplink .= '[h_url]' . $url;
	if(is_page() || is_single()){
		$wp_admin_bar->add_menu(array(	//リンク用アイテム
			'id'    => 'link-code',
			'meta'  => array(),
			'title' => 'Link Code',
			'href'  => ''
		));
		$wp_admin_bar->add_menu(array(	//リンク用アイテム
			'parent' => 'link-code',
			'id'     => 'link-code-php',
			'meta'   => array(),
			'title'  => $phplink,
			'href'   => ''
		));
		$wp_admin_bar->add_menu(array(	//リンク用アイテム
			'parent' => 'link-code',
			'id'     => 'link-code-wp',
			'meta'   => array(),
			'title'  => $wplink,
			'href'   => ''
		));
	}
}

/*==============================
左メニュー削除
==============================*/
// function remove_menu(){
// 	remove_menu_page('edit-comments.php');//コメント
// }
// add_action('admin_menu','remove_menu');

/*==============================
左メニュー並び替え
==============================*/
// function custom_menu_order($menu_ord){
// 	if(!$menu_ord) return true;
// 	return array(
// 		'index.php',//ダッシュボード
// 		'edit.php',//投稿
// 		'edit.php?post_type=',//カスタム投稿
// 		'edit.php?post_type=page',//固定ページ
// 		'upload.php',//メディア
// 		'edit-comments.php',//コメント
// 		'separator2',//仕切り
// 		'themes.php',//外観
// 		'plugins.php',//プラグイン
// 		'users.php',//ユーザー
// 		'admin.php?page=all-in-one-seo-pack/aioseop_class.php',//All in One SEO Pack
// 		'tools.php',//ツール
// 		'options-general.php',//設定
// 		'separator-last',//仕切り
// 	);
// }
// add_filter('custom_menu_order','custom_menu_order');
// add_filter('menu_order','custom_menu_order');



/*==============================
テーマ編集にJS追加
==============================*/
add_filter('wp_theme_editor_filetypes', function ($default_types) {
	$default_types[] = 'js';
	return $default_types;
});

/*==============================
フッター変更
==============================*/
function custom_admin_footer(){
	echo '';
}
add_filter('admin_footer_text','custom_admin_footer');

/*==============================
【管理画面】投稿メニューを非表示
==============================*/
// function remove_menus () {
// global $menu;
// remove_menu_page( 'edit.php' ); // 投稿を非表示
// }
// add_action('admin_menu', 'remove_menus');

/*━━━━━━━━━━━━━━━
汎用関数
━━━━━━━━━━━━━━━*/
/*==============================
ページ判定
==============================*/
function is_top($paged = TURE){//TOPページならTRUE PagedにFALSEを入れた場合、TOPの2ページ以降は除外
	$flag = FALSE;
	if((is_home() || is_front_page()) &&($paged || !is_paged())){
		$flag = TRUE;
	}
	return $flag;
}
function is_root($slug){//指定スラッグのルートページ、もしくはその子孫ならTRUE
	global $post;
	$flag = FALSE;
	$root = $post;
	if(is_page()){
		while($root->post_parent != 0){
			$root = get_post($root->post_parent);
		}
		foreach((array)$slug as $val){
			if($root->post_name === $val){
				$flag = TRUE;
				break;
			}
		}
	}
	return $flag;
}

/*==============================
テキストをリスト化
==============================*/
function brlist($lines){	//テキストを改行単位でリスト化
	$lines = explode("\n",$lines);
	foreach((array)$lines as $line){
		$text .= '<li>' . $line . '</li>';
	}
	return $text;
}

/*==============================
チェックボックス出力
==============================*/
function get_the_checkbox($name,$value,$wrap=NULL){	//チェックボックス生成
	if(!empty($wrap)){
		return '<label><input name="' . $name . '[]" value="' . $value . '" type="checkbox"><' . $wrap . '>' . $value . '</' . $wrap . '></label>';
	}else{
		return '<label><input name="' . $name . '[]" value="' . $value . '" type="checkbox">' . $value . '</label>';
	}
}

/*
███████ ██      ███████ ██   ██     ██████   █████   ██████  ███████ ██████
██      ██      ██       ██ ██      ██   ██ ██   ██ ██       ██      ██   ██
█████   ██      █████     ███       ██████  ███████ ██   ███ █████   ██████
██      ██      ██       ██ ██      ██      ██   ██ ██    ██ ██      ██   ██
██      ███████ ███████ ██   ██     ██      ██   ██  ██████  ███████ ██   ██
*/

/*==============================
Flex Pager Var2016-11-25
==============================*/
function flex_pager($args = ''){
	global $wp_query;
	$text = '';
	$default = array(
		'query'          => $wp_query,							//使用クエリー
		'range'          => 3,									//カレントからのページボタン数　指定数*2+1が総数
		'current_format' => '<span class="current">%d</span>',	//カレントボタンのレイアウト
		'prev_next'      => true,								//戻る/進むボタン
		'edge_pn'        => false,								//ページ末端側の戻る/進むボタンを表示するか
		'prev_label'     => '&lt;',								//戻るボタンテキスト
		'next_label'     => '&gt;',								//進むボタンテキスト
		'first_last'     => true,								//最初/最後ボタン
		'edge_fl'        => false,								//ページ末端側の最初/最後ボタンを表示するか
		'first_label'    => '&laquo;',							//最初ボタンテキスト
		'last_label'     => '&raquo;',							//最後ボタンテキスト
		'op_left'        => '',									//左側オプション　%d（現ページ）%d（総ページ）
		'op_right'       => '',									//右側オプション　%d（現ページ）%d（総ページ）
		'navi_class'     => 'page_navi',						//ナビのクラス スペース区切りで複数指定
		'navi_id'        => '',									//ナビのID
		'child_class'    => '',									//子要素のクラス
		'navi_type'      => 'div',								//ナビのタイプ
		'child_wrap'     => '',									//子要素を括る要素
		'cw_class'       => '',									//child_wrapのクラス
		'cw_cu_class'    => '',									//child_wrapのカレントボタンクラス
		'off_class'      => 'off',								//edgeオプションで表示している要素のクラス wrap有効時はそちらに付加
		'echo'           => true,								//出力するか、値で返すか
	);
	$args = wp_parse_args($args,$default);	//パラメータとデフォルト値をマージ

	$now = get_query_var('paged');	//現在のページ
	if($now < 1) $now = 1;
	$max = $args['query']->max_num_pages;	//総ページ数
	if(!$max) $max = 1;

	if(1 >= $max){	//総ページが1ページなら終了
		return FALSE;
	}

	$cw_st = '';
	$cw_st_cu = '';
	$cw_st_off = '';
	$cw_en = '';
	if($args['child_wrap'] != ''){	//子要素を括る要素を決定
		$cw_st = '<'  . $args['child_wrap'] . ' class="' . $args['cw_class'] . '">';
		$cw_st_cu = '<'  . $args['child_wrap'] . ' class="' . $args['cw_class'] . ' ' . $args['cw_cu_class'] . '">';
		$cw_st_off = '<'  . $args['child_wrap'] . ' class="' . $args['cw_class'] . ' ' . $args['off_class'] . '">';
		$cw_en = '</' . $args['child_wrap'] . '>';
	}

	$text .= '<' . $args['navi_type'] . ' id="' . $args['navi_id'] . '" class="' . $args['navi_class'] . '">';	//ページャータグ

	$text .= $cw_st . sprintf($args['op_left'],$now,$max) . $cw_en;	//左オプション

	if($args['first_last']){	//最初
		if($now == 1 && $args['edge_fl']){	//必要ないが、それでも表示する設定
			if($cw_st_off){
				$text .= $cw_st_off . '<span class="move max first ' . $args['child_class'] . '">' . $args['first_label'] . '</span>' . $cw_en;
			}else{
				$text .= $cw_st_off . '<span class="move max first ' . $args['off_class'] . ' ' . $args['child_class'] . '">' . $args['first_label'] . '</span>' . $cw_en;
			}
		}elseif($now >= 2){	//戻り先がある
			$text .= $cw_st . '<a class="move max first ' . $args['child_class'] . '" href="' . get_pagenum_link(1) . '">' . $args['first_label'] . '</a>' . $cw_en;
		}
	}

	if($args['prev_next']){	//戻る
		if($now == 1 && $args['edge_pn']){	//戻り先がないが、それでも表示する設定
			if($cw_st_off){
				$text .= $cw_st_off . '<span class="move min prev ' . $args['child_class'] . '">' . $args['prev_label'] . '</span>' . $cw_en;
			}else{
				$text .= $cw_st_off . '<span class="move min prev ' . $args['off_class'] . ' ' . $args['child_class'] . '">' . $args['prev_label'] . '</span>' . $cw_en;
			}
		}elseif($now >= 2){	//戻り先がある
			$text .= $cw_st . '<a class="move min prev ' . $args['child_class'] . '" href="' . get_pagenum_link($now - 1) . '">' . $args['prev_label'] . '</a>' . $cw_en;
		}
	}

	$prev_volume = $now - 1;		//戻れる数
	$next_volume = $max - $now;		//進める数
	$prev_lange = $args['range'];	//進む数
	$next_lange = $args['range'];	//進む数
	if($prev_volume < $args['range']){
		$next_lange += $args['range'] - $prev_volume;
	}
	if($next_volume < $args['range']){
		$prev_lange += $args['range'] - $next_volume;
	}
	for($i = $now - $prev_lange;$i < $now;$i++){
		if($i >= 1){
			$text .= $cw_st . '<a href="' . get_pagenum_link($i) . '" class="page ' . $args['child_class'] . '">' . $i . '</a>' . $cw_en;
		}
	}
	$text .= $cw_st_cu . sprintf($args['current_format'],$now) . $cw_en;	//カレントページ
	for($i = $now + 1;$i <= $now + $next_lange;$i++){
		if($i <= $max){
			$text .= $cw_st . '<a href="' . get_pagenum_link($i) . '" class="page ' . $args['child_class'] . '">' . $i . '</a>' . $cw_en;
		}
	}

	if($args['prev_next']){	//進む
		if($now == $max && $args['edge_pn']){	//進み先がないが、それでも表示する設定
			if($cw_st_off){
				$text .= $cw_st_off . '<span class="move min next ' . $args['child_class'] . '">' . $args['next_label'] . '</span>' . $cw_en;
			}else{
				$text .= $cw_st_off . '<span class="move min next ' . $args['off_class'] . ' ' . $args['child_class'] . '">' . $args['next_label'] . '</span>' . $cw_en;
			}
		}elseif($now <= $max - 1){	//進み先がある
			$text .= $cw_st . '<a class="move min next ' . $args['child_class'] . '" href="' . get_pagenum_link($now + 1) . '">' . $args['next_label'] . '</a>' . $cw_en;
		}
	}

	if($args['first_last']){	//最後
		if($now == $max && $args['edge_fl']){	//必要ないが、それでも表示する設定
			if($cw_st_off){
				$text .= $cw_st_off . '<span class="move max last ' . $args['child_class'] . '">' . $args['last_label'] . '</span>' . $cw_en;
			}else{
				$text .= $cw_st_off . '<span class="move max last ' . $args['off_class'] . ' ' . $args['child_class'] . '">' . $args['last_label'] . '</span>' . $cw_en;
			}
		}elseif($now <= $max - 1){	//進み先がある
			$text .= $cw_st . '<a class="move max last ' . $args['child_class'] . '" href="' . get_pagenum_link($max) . '">' . $args['last_label'] . '</a>' . $cw_en;
		}
	}

	$text .= $cw_st . sprintf($args['op_right'],$now,$max) . $cw_en;	//右オプション
	$text .= '</' . $args['navi_type'] . '>';
	$text = wp_kses_post($text);	//HTMLサニタイズ

	if($args['echo']){
		echo $text;
	}
	return $text;
}

/*==============================
アーカイブタクソノミー
==============================*/
//$ac_term = get_archive_term();	//アーカイブページのタクソノミー情報取得
//echo $ac_term->name;	//タクソノミー名
//echo $ac_term->slug;	//タクソノミースラッグ
//echo $ac_term->count;	//タクソノミー投稿数
//echo $ac_term->description;	//アーカイブタクソノミー説明文
//echo $ac_term->term_id;	//アーカイブタクソノミーID
//echo echo $cat_root = get_term($ac_term->parent,'c_cat', $args )->slug;	//親タクソノミースラッグ

function get_archive_term(){	//アーカイブページのタクソノミー情報取得
	$id;
	$tax_slug;
	if(is_category()){
		$tax_slug = 'category';
		$id = get_query_var('cat');
	}elseif(is_tag()){
		$tax_slug = 'post_tag';
		$id = get_query_var('tag_id');
	}elseif(is_tax()){
		$tax_slug = get_query_var('taxonomy');
		$term_slug = get_query_var('term');
		$term = get_term_by('slug',$term_slug,$tax_slug);
		$id = $term->term_id;
	}
	return get_term($id,$tax_slug);
}

/*━━━━━━━━━━━━━━━
後方互換
━━━━━━━━━━━━━━━*/
if(!function_exists("get_the_permalink")){//「get_the_permalink」が未定義なら定義する
	function get_the_permalink(){
		return get_permalink();
	}
}


/*
███████ ██   ██  ██████  ██████  ████████  ██████  ██████  ██████  ███████
██      ██   ██ ██    ██ ██   ██    ██    ██      ██    ██ ██   ██ ██
███████ ███████ ██    ██ ██████     ██    ██      ██    ██ ██   ██ █████
     ██ ██   ██ ██    ██ ██   ██    ██    ██      ██    ██ ██   ██ ██
███████ ██   ██  ██████  ██   ██    ██     ██████  ██████  ██████  ███████
*/

/*━━━━━━━━━━━━━━━
ショートコード
━━━━━━━━━━━━━━━*/
/*==============================
URL
==============================*/
function HomeURL(){//ホームURLショートコード
	return home_url('/','relative');
}
add_shortcode('h_url','HomeURL');//使用例：[h_url]contact/

function ThemeURL(){//テーマURLショートコード
	return get_template_directory_uri() . '/';
}
add_shortcode('t_url','ThemeURL');//使用例：[t_url]assets/

function UploadsURL(){//アップロードURLショートコード
	return content_url() . '/uploads/';
}
add_shortcode('u_url','UploadsURL');//使用例：[u_url]2015/

/*==============================
データ
==============================*/
function UserData($atts){//訪問者の関連データ出力
	extract(
		shortcode_atts(array(
			'type' => 'IP',	//フィールドタイプ（任意）
		),$atts)
	);
	if($type === "IP"){
		$text = $_SERVER['REMOTE_ADDR'];
	}elseif($type === "HOST"){
		$text = getHostByAddr($_SERVER['REMOTE_ADDR']);
	}elseif($type === "Browser"){
		$text = $_SERVER["HTTP_USER_AGENT"];
	}elseif($type === "now"){
		date_default_timezone_set('Asia/Tokyo');
		$text = date('Y-m-d H:i:s');
	}
	return $text;
}
add_shortcode('user_data','UserData');//使用例：[user_data type="IP"]

/*==============================
モジュール
==============================*/
function Breadcrumbs(){//パンくずリスト
	ob_start();
		if(function_exists('bcn_display')) bcn_display();
	$text = ob_get_clean();
	return $text;
}
add_shortcode('bread','Breadcrumbs');//使用例：[bread]

/*==============================
テキスト出力
==============================*/
function pagename_class($classes = '') {
	global $post;
	if(get_post_ancestors($post->ID)){//親ページあり
		$text = 'l-' . get_page_uri($post->post_parent) . '-' . get_post(get_the_ID())->post_name;//l-親-現在地
		$text = preg_replace('!/!','-',$text);//置換
	}else{//親ページなし
		$text = 'l-' . get_post(get_the_ID())->post_name;//l-現在地
	}
	$classes[] = $text;
	return $classes;
}
add_filter('body_class', 'pagename_class');


function PageContent($atts){//指定した固定ページのテキスト系フィールドを出力
	extract(
		shortcode_atts(array(
			'slug' => '',	//ページスラッグ（必須）
			'field' => '',	//カスタムフィールド（任意）
			'type' => 'text',	//フィールドタイプ（任意）
			'pbr' => false,	//<p><br>自動整形（任意）
		),$atts)
	);
	$page = get_page_by_path($slug);//固定ページのデータ取得

	if(!empty($page) && !empty($field)){//指定がある場合はカスタムフィールドを読み込む
		$data = get_post_meta($page->ID,$field,true);
		if($type === 'text'){	//テキスト
			$text = nl2br(do_shortcode($data));
		}elseif($type === 'url'){	//ファイルURL
			$text = wp_get_attachment_url($data);
		}elseif($type === 'img'){	//IMGタグ
			$text = wp_get_attachment_image($data,'full',true);
		}
	}elseif(!empty($page)){//スラッグのみなら本文を読み込む
		$text = do_shortcode($page->post_content);
	}
	if($pbr){//自動整形
		$text = apply_filters('the_content',$text);
	}
	return $text;
}
add_shortcode('p_content','PageContent');//使用例　[p_content slug="footer-diary" field="sp" type="" pbr=true]

function get_the_rootslug(){//現在位置のルートページのスラッグを返す
	global $post;
	$root = $post;
	while($root->post_parent != 0){
		$root = get_post($root->post_parent);
	}
	return $root->post_name;
}
add_shortcode('rootslug','get_the_rootslug');//使用例：[rootslug]


/*━━━━━━━━━━━━━━━
PHP読み込み
━━━━━━━━━━━━━━━*/
function LoadPHP($atts){
	extract(
		shortcode_atts(array(
			'file' => '',	//ページスラッグ（必須）
			'assets' => false,	//assetsテーマから呼び出す
		),$atts)
	);
	ob_start();
	if($assets){
		$path = A_PATH;
	}else{
		$path = T_PATH;
	}
	include($path . $file);
	$text = ob_get_clean();
	return $text;
}
add_shortcode('include','LoadPHP');//使用例：[include file=""]

/*==============================
WPQuery
==============================*/
function SearchQuery($atts){
	extract(
		shortcode_atts(array(
			'cat' => '',
			'tax' => '',
			'meta' => '',
			'volume' => '5',
			'device' => 'pc',
			'type' => 'pc',
		),$atts)
	);
	$query = array(
		'post_type' => $type,					//投稿タイプ指定
		'post_status' => 'publish',				//公開済みの記事
		'posts_per_page' => $volume,			//出力数
		'paged' => get_query_var('paged'),		//ページ番号を考慮
	);
	if(!empty($cat)){
		$query['category_name'] = $cat;		//カテゴリースラッグ
	}
	if(!empty($tax)){
		$query['tax_query'] = array(			//タクソノミー
			array(
				'taxonomy' => 'cat-',	//タクソノミー名
				'field' => 'slug',				//スラッグで指定
				'terms' => $tax,				//スラッグ
			),
		);
	}
	if(!empty($meta)){
		$query['meta_query'] = array(					//カスタムフィールド
			'relation' => 'AND',				//AND検索かOR検索か
			array(
				'key' => '',					//フィールド名
				'value' => '',					//値
				'compare' => '',				//valueを右側に置いた評価式
			),
		);
	}

	$query = new WP_Query($query);
	$text = '';
	if($query -> have_posts())://検索結果があった時、冒頭の処理
		$text .= '<ul class="l-posts">';
		while($query -> have_posts()): $query -> the_post();//ループ処理
			$text .= '<li class="post">';
				$text .= '<div class="tagarea">';
				$text .= '</div>';
			$text .= '</li>';
		endwhile;//検索結果があった時、最後の処理
			$text .= '</ul>';
	else://検索結果がなかった時の処理
		$text .= '<p>準備中です。</p>';
	endif; wp_reset_postdata();//処理終了
	return $text;
}
//add_shortcode('','SearchCertified');//使用例　[q_certified cat="" device="sp"]

/*━━━━━━━━━━━━━━━
MW WP Form
━━━━━━━━━━━━━━━*/
/*==============================
エラーメッセージ変更
==============================*/
function my_validation_rule($Validation,$data,$Data){
	$Validation->set_rule('user1','noEmpty',array('message' => '※'));
	$Validation->set_rule('user2','noEmpty',array('message' => '※'));
	$Validation->set_rule('email1','mail',array('message' => '※'));
	$Validation->set_rule('email1','noEmpty',array('message' => '※'));
	$Validation->set_rule('text','noEmpty',array('message' => '※'));
	return $Validation;
}
//add_filter('mwform_validation_mw-wp-form-000','my_validation_rule',10,3);

/*==============================
内容分岐
==============================*/
function autoback_my_mail($Mail_raw,$values,$Data){
	if($Data->get('hoge') == ''){	//指定の項目を選んでいた場合
//		$Mail_raw->from    = ''; //送信元メールアドレスを変更
//		$Mail_raw->sender  = ''; //送信者名を変更
//		$Mail_raw->subject = ''; //件名を変更
//		$Mail_raw->body    = ''; //本文を変更
	}
	return $Mail_raw;
}
//add_filter('mwform_auto_mail_raw_mw-wp-form-000','autoback_my_mail',10,3);

/*==============================
問い合わせ　用件　初期値設定
==============================*/
function my_mwform_value( $value, $name ) {
    // $_GET['hoge']があったら、name属性がhogeの項目の初期値に設定
    if ( $name === 'user_matter' && !empty( $_GET['type'] ) && !is_array( $_GET['type'] ) ) {
			if($_GET['type'] == 'q'){
				return '質問を行う';
			}elseif($_GET['type'] == 'p'){
				return '料金お問い合わせ';
			}
    }
}
// 管理画面で作成したフォームの場合、フック名の後のフォーム識別子は「mw-wp-form-xxx」
add_filter( 'mwform_value_mw-wp-form-4', 'my_mwform_value', 10, 2 );

/*
███████ ███████ ██
██      ██      ██
███████ ███████ ██
     ██      ██ ██
███████ ███████ ███████
*/

/*━━━━━━━━━━━━━━━
SSL
━━━━━━━━━━━━━━━*/
/*==============================
さくらサーバーSSL対策
==============================*/
if(isset($_SERVER['HTTP_X_SAKURA_FORWARDED_FOR'])){
	$ssl_domain = 'example.com';
	$_SERVER['HTTPS']       = 'on';
	$_ENV['HTTPS']          = 'on';
	$_SERVER['HTTP_HOST']   = $ssl_domain;
	$_SERVER['SERVER_NAME'] = $ssl_domain;
	$_ENV['HTTP_HOST']      = $ssl_domain;
	$_ENV['SERVER_NAME']    = $ssl_domain;
}
/*==============================
混在コンテンツ対策+URL文字数削減
==============================*/
class URL_Optimize{
	public function __construct(){//get_headerの呼び出しに合わせて開始、wp_footerの終了に合わせて終了
		add_action('get_header',array(&$this,'get_header'),1);
		add_action('wp_footer',array(&$this,'wp_footer'),99999);
	}
	protected function Replace_URL($content){
		$top_url = get_home_url('/');
		$top_url = preg_replace('!^(https?:\/\/.+?)\/(.*)$!','$1',$top_url);//ホームURLをドメイン部分だけに絞る

		//内部URLはルート相対パス化
		$content = preg_replace('!(<a .*href=[\'"])' . $top_url . '!im','$1',$content);
		$content = preg_replace('!(<link .*rel=[\'"]stylesheet[\'"] .*?href=[\'"])' . $top_url . '!im','$1',$content);
		$content = preg_replace('!(<script .*src=[\'"])' . $top_url . ':!im','$1',$content);
		$content = preg_replace('!(<img .*src=[\'"])' . $top_url . ':!im','$1',$content);

		//外部リソースはスキーム削除
		$content = preg_replace('!(<link .*rel=[\'"]stylesheet[\'"] .*?href=[\'"])https?:!im','$1',$content);
		$content = preg_replace('!(<script .*?src=[\'"])https?:!im','$1',$content);
		$content = preg_replace('!(<img .*?src=[\'"])https?:!im','$1',$content);
		return $content;
	}
	public function get_header(){
		ob_start(array(&$this,'Replace_URL'));
	}
	public function wp_footer(){
		ob_end_flush();
	}
}
new URL_Optimize();

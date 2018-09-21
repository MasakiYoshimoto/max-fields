<?php
class CmsdocumentsController extends AppController
{
	var $name = "Cmsdocuments";
	var $uses = array("Cmscategory","Cmsitem","Cmsdocument","Cmsitemdata","Cmsdoccategory");
	var $components = array("obAuth","MySecurity","Arms");
	var $helpers = array("Paginator");
	var $layout = false;

	function beforeFilter(){
		$this->obAuth->startup($this);
		if(!$this->obAuth->lock(array())) $this->redirect('/');

		if(!USE_DEFAULT_FUNCTION) $this->redirect('/');

		$this->set('image_url', IMAGE_URL);
		$this->set('append_url', APPEND_URL);
		$this->set('max_file_size', MAX_FILE_SIZE);
		parent::beforeFilter();

		$this->set('use_tinymce',USE_TINYMCE);
	}

	function index() {

		// URLからの値をセット
		if( !isset($this->data['Cmscategory']['c_id']) && isset( $this->params[named]['cc'] ) ) {
			$this->data['Cmscategory']['c_id'] = $this->params[named]['cc'];
			$this->params[named]['page'] = 1;
		}
		if( isset( $this->params[named]['page'] ) ) {
			$this->data['Cmscategory']['page'] = $this->params[named]['page'];
		}
		elseif ($this->Session->check("documents_pages")) {
			$this->data['Cmscategory']['page'] = $this->Session->read("documents_pages");
		}
		else {
			$this->data['Cmscategory']['page'] = 1;
		}

		// カテゴリー検索
		if($this->data['Cmsdocument']['category']) {
			$search_category = $this->data['Cmsdocument']['category'];
			$search_category = ($search_category ==999999) ? ('') : ($search_category);
		}
		elseif ($this->Session->check("search_category") && !$this->params[named]['cc']) {
			$search_category = $this->Session->read("search_category");
		}
		else {
			$search_category = "";
		}
		$this->set('search_category', $search_category);
		$this->Session->write("search_category",$search_category);

		// バリデート
		$this->Cmscategory->setValidation('index');
		$this->Cmscategory->create($this->data['Cmscategory']);

		if(!$this->Cmscategory->validates()) {
			$this->redirect('/tops');
		}

		$c_id = isset($this->data['Cmscategory']['c_id'])?($this->data['Cmscategory']['c_id']):("");
		$page = isset($this->data['Cmscategory']['page'])?($this->data['Cmscategory']['page']):(1);

		if( $c_id == "" ) {
			// セッションがあるか
			if ( !$this->Session->check("documents_c_id") ) {
				$this->redirect('/tops');
			}
			else {
				$c_id = $this->Session->read("documents_c_id");
			}
		}
		else {
			// もしカテゴリIDがあったら新規なので検索カテゴリーは削除
			$this->Session->del("search_category");
		}

		// カテゴリーを取得
		$options['conditions'] = array('Cmscategory.c_id = '=>$c_id,'Cmscategory.delete_flag = '=>'0');
		$ca_data = $this->Cmscategory->find('first',$options);
		if( $this->Cmscategory->sqlerror == false ) {
			$this->redirect('/tops');
		}
		$this->set('category_name', $ca_data['Cmscategory']['name']);
		$this->set('use_category', $ca_data['Cmscategory']['use_category']);

		// ドキュメントカテゴリーを取得
		if( $ca_data['Cmscategory']['use_category'] ) {
			$options=array();
			$options['conditions'] = array('Cmsdoccategory.c_id = '=>$c_id,'Cmsdoccategory.delete_flag = '=>'0');
			$options['order'] = array('Cmsdoccategory.sort'=>'asc');
			$doccategory_data = $this->Cmsdoccategory->find('all',$options);
			if( $doccategory_data === false || $this->Cmsdoccategory->sqlerror === false ) {
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}
		}
		else {
			$doccategory_data = array();
		}

		$doccategory_list=array('999999'=>'すべて');
		for($i=0;$i<count($doccategory_data);$i++) {
			$doccategory_list[$doccategory_data[$i]['Cmsdoccategory']['id']]=$doccategory_data[$i]['Cmsdoccategory']['name'];
		}

		$this->set('doccategory_list', $doccategory_list);

		// ドキュメントの取得
		$options=array();
		$options['conditions'] = array('Cmsdocument.c_id = '=>$c_id,'Cmsdocument.delete_flag = '=>'0');
		if($search_category) $options['conditions'] += array('Cmsdocument.category = ' => $search_category);
		$order = array('Cmsdocument.sort'=>'desc');
		$this->paginate=array( 'limit'=>LIST_MAX , 'page'=> $this->data['Cmscategory']['page'] , 'order'=>$order );

		$result = $this->paginate('Cmsdocument',$options['conditions']);
		if( $result === false ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		for ( $i=0;$i<count( $result );$i++ ) {
			// セルの色決め
			$result[$i]['Cmsdocument']['color_mode'] = 0;
			if( $result[$i]['Cmsdocument']['period_flag'] == 1 ) {

				$start_date = ( $result[$i]['Cmsdocument']['start_date'] == "0000-00-00 00:00:00" || $result[$i]['Cmsdocument']['start_date'] == "" ) ? (""):($result[$i]['Cmsdocument']['start_date']);
				$end_date = ( $result[$i]['Cmsdocument']['end_date'] == "0000-00-00 00:00:00" || $result[$i]['Cmsdocument']['end_date'] == "" ) ? (""):($result[$i]['Cmsdocument']['end_date']);

				if( $start_date == "" && $end_date != "" ) {
					if( strtotime( $end_date ) < time() ) $result[$i]['Cmsdocument']['color_mode'] = 2; // すでに予定が過ぎ去った
				}
				elseif( $start_date != "" && $end_date == "" ) {
					if( strtotime( $start_date ) > time() ) $result[$i]['Cmsdocument']['color_mode'] = 1; // まだ予定が来ていない
				}
				elseif( $start_date != "" && $end_date != "" ) {
					if( strtotime( $start_date ) > time() && strtotime( $end_date ) > time() ) $result[$i]['Cmsdocument']['color_mode'] = 1; // まだ予定が来ていない
					if( strtotime( $start_date ) < time() && strtotime( $end_date ) < time() ) $result[$i]['Cmsdocument']['color_mode'] = 2; // すでに予定が過ぎ去った
				}
			}

			if( $result[$i]['Cmsdocument']['disable'] == 1 ) $result[$i]['Cmsdocument']['color_mode'] = 3; // 非公開

		}

		// ページング
		if( $this->params['paging']['Cmsdocument']['pageCount'] != 0 ) {
			$page_max = $this->params['paging']['Cmsdocument']['pageCount'];

			$page = ( $page > $page_max ) ? ( $page_max ) : ( $page );

			$end_page = $page_max;
			if( $page_max > 5 ) {
				if( ($page+2) > 5 ) {
					$end_page = $page + 2;
				}
				else {
					$end_page = 5;
				}
			}
		}
		else {
			$page_max = 0;
			$end_page =0;
		}

		$end_page = ( $end_page > $page_max ) ? ( $page_max ) : ( $end_page );
		$start_page = $end_page - (5 -1 );
		$start_page = ( $start_page < 1 ) ? ( 1 ) : ( $start_page );

		// ページの作成
		for($i=$start_page;$i<=$end_page;$i++) {
			$pagelist[]['page'] = $i;
		}

		// トークン設定
		$this->MySecurity->settoken();

		$this->set('c_id', $c_id);
		$this->set('list', $result);
		$this->Session->write("documents_c_id",$c_id);
		$this->Session->write("documents_pages",$this->data['Cmscategory']['page']);
		$this->set('pagelist', $pagelist);
	}

	function add() {

		// セッションがあるか
		if ( !$this->Session->check("documents_c_id") ) {
			$this->redirect('/tops');
		}
		else {
			$c_id = $this->Session->read("documents_c_id");
		}

		$this->set('c_id', $c_id);

		// カテゴリ情報取得
		$options['conditions'] = array('Cmscategory.c_id = '=>$c_id,'Cmscategory.delete_flag = '=>'0');
		$ca_data = $this->Cmscategory->find('first',$options);
		if( $this->Cmscategory->sqlerror == false || empty($ca_data) ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}
		$this->set('category_name', $ca_data['Cmscategory']['name']);
		$this->set('use_rss', $ca_data['Cmscategory']['use_rss']);
		$this->set('use_period', $ca_data['Cmscategory']['use_period']);
		$this->set('title_max', $ca_data['Cmscategory']['title_max']);
		$this->set('use_category', $ca_data['Cmscategory']['use_category']);
		$this->set('use_link', $ca_data['Cmscategory']['use_link']);
		$this->set('use_fulledit', $ca_data['Cmscategory']['use_fulledit']);
		$this->set('use_filemanager', $ca_data['Cmscategory']['use_filemanager']);
		$this->set('preview_page', $ca_data['Cmscategory']['preview_page']);

		// ドキュメントカテゴリーを取得
		if( $ca_data['Cmscategory']['use_category'] ) {
			$options['conditions'] = array('Cmsdoccategory.c_id = '=>$c_id,'Cmsdoccategory.delete_flag = '=>'0');
			$options['order'] = array('Cmsdoccategory.sort'=>'asc');
			$doccategory_data = $this->Cmsdoccategory->find('all',$options);
			if( $doccategory_data === false || $this->Cmsdoccategory->sqlerror === false ) {
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			if(CMS_CATEGORY_USE_NOSELECT) {
				array_unshift( $doccategory_data ,array('Cmsdoccategory'=>array('name'=>'選択しない','id'=>0)));
			}
		}
		else {
			$doccategory_data = array();
		}

		$doccategory_list=array();
		for($i=0;$i<count($doccategory_data);$i++) {
			$doccategory_list[$doccategory_data[$i]['Cmsdoccategory']['id']]=$doccategory_data[$i]['Cmsdoccategory']['name'];
		}

		$this->set('doccategory_list', $doccategory_list);

		// アイテムを取得
		$options = array();
		$options['conditions'] = array('Cmsitem.c_id = '=>$c_id,'Cmsitem.delete_flag = '=>'0');
		$options['order'] = array('Cmsitem.sort ASC');
		$result = $this->Cmsitem->find('all',$options);
		if( $this->Cmsitem->sqlerror == false ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		// デフォルトの選択
		for($i=0;$i<count($result);$i++) {
			if( $result[$i]['Cmsitem']['type'] == 5 && strpos($result[$i]['Cmsitem']['values_string'],'#') ) {
				$tmp = explode('#',$result[$i]['Cmsitem']['values_string']);
				$result[$i]['Cmsitem']['values_string'] = $tmp[0];
				$result[$i]['Cmsitem']['input_value'] = $tmp[1];
			}
		}

		$this->set('list', $result);

	}

	function adddo() {

		// セッションがあるか
		if ( !$this->Session->check("documents_c_id") ) {
			$this->redirect('/tops');
		}
		else {
			$c_id = $this->Session->read("documents_c_id");
		}

		$this->set('c_id', $c_id);

		// カテゴリ情報取得
		$options['conditions'] = array('Cmscategory.c_id = '=>$c_id,'Cmscategory.delete_flag = '=>'0');
		$ca_data = $this->Cmscategory->find('first',$options);
		if( $this->Cmscategory->sqlerror == false || empty($ca_data) ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}
		$this->set('category_name', $ca_data['Cmscategory']['name']);
		$this->set('use_rss', $ca_data['Cmscategory']['use_rss']);
		$this->set('use_period', $ca_data['Cmscategory']['use_period']);
		$this->set('title_max', $ca_data['Cmscategory']['title_max']);
		$this->set('use_category', $ca_data['Cmscategory']['use_category']);
		$this->set('use_link', $ca_data['Cmscategory']['use_link']);
		$this->set('use_fulledit', $ca_data['Cmscategory']['use_fulledit']);
		$this->set('use_filemanager', $ca_data['Cmscategory']['use_filemanager']);
		$this->set('preview_page', $ca_data['Cmscategory']['preview_page']);

		// ドキュメントカテゴリーを取得
		if( $ca_data['Cmscategory']['use_category'] ) {
			$options['conditions'] = array('Cmsdoccategory.c_id = '=>$c_id,'Cmsdoccategory.delete_flag = '=>'0');
			$options['order'] = array('Cmsdoccategory.sort'=>'asc');
			$doccategory_data = $this->Cmsdoccategory->find('all',$options);
			if( $doccategory_data === false || $this->Cmsdoccategory->sqlerror === false ) {
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			if(CMS_CATEGORY_USE_NOSELECT) {
				array_unshift( $doccategory_data ,array('Cmsdoccategory'=>array('name'=>'選択しない','id'=>0)));
			}
		}
		else {
			$doccategory_data = array();
		}

		$doccategory_list=array();
		for($i=0;$i<count($doccategory_data);$i++) {
			$doccategory_list[$doccategory_data[$i]['Cmsdoccategory']['id']]=$doccategory_data[$i]['Cmsdoccategory']['name'];
		}

		$this->set('doccategory_list', $doccategory_list);

		// アイテム取得
		$options = array();
		$options['conditions'] = array('Cmsitem.c_id = '=>$c_id,'Cmsitem.delete_flag = '=>'0');
		$options['order'] = array('Cmsitem.sort ASC');
		$result = $this->Cmsitem->find('all',$options);
		if( $this->Cmsitem->sqlerror == false ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$this->Cmsdocument->setValidation('default');
		$this->Cmsdocument->setValidationbyitems('Cmsitem',$result,'add',$ca_data['Cmscategory']['use_filemanager']);
		$this->Cmsdocument->validate['title']['rule1']['rule'] = array("checkmaxLength",$ca_data['Cmscategory']['title_max']);
		$this->Cmsdocument->validate['title']['rule1']['message'] = "タイトルは" . $ca_data['Cmscategory']['title_max'] . "文字以下で入力して下さい";

		// 公開設定が設定されていなかったら開始日と終了日を消す
		if(!$this->data['Cmsdocument']['period']) {
			$this->data['Cmsdocument']['start_date'] = "";
			$this->data['Cmsdocument']['end_date'] = "";
		}

		// モード未設定対応
		if( !isset($this->data['Cmsdocument']['mode']) ) $this->data['Cmsdocument']['mode'] = "";

		if( $this->data['Cmsdocument']['mode'] == 'confirm' ) {

			// 値のセット
			$this->data['Cmsdocument']['c_end_date'] = $this->data['Cmsdocument']['end_date'];

			// カテゴリー未選択が不許可の場合ははカテゴリーが無いとエラー
			if($ca_data['Cmscategory']['use_category'] && !CMS_CATEGORY_USE_NOSELECT) {
				if(isset($this->data['Cmsdocument']['category'])===false) {

					// 色々戻す
					$input = $this->data['Cmsdocument'];
					for($i=0;$i<count($result);$i++) {
						if( $result[$i]['Cmsitem']['type'] == ITEM_TYPE_CHECK ) { // チェックボックス
							if(is_array($this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']])) {
								$result[$i]['Cmsitem']['input_value'] = implode(",",$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]);
							}
							else {
								$result[$i]['Cmsitem']['input_value'] = "";
							}
						}
						else if( $result[$i]['Cmsitem']['type'] == ITEM_TYPE_RADIO && strpos($result[$i]['Cmsitem']['values_string'],'#') ) { // ラジオ
							$tmp = explode('#',$result[$i]['Cmsitem']['values_string']);
							$result[$i]['Cmsitem']['values_string'] = $tmp[0];
						}
						else {
							$result[$i]['Cmsitem']['input_value'] = $this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']];
						}
					}

					$this->set('input', $input);
					$this->set('list', $result);
					$this->set('error', array('カテゴリーの登録を行って下さい'));
					$this->render('add');
					return false;

				}
			}

			// バリデート
			$this->Cmsdocument->create($this->data['Cmsdocument']);

			// ファイルマネージャーを使用していた時にはファイルチェックを外す
			if($ca_data['Cmscategory']['use_filemanager']) {
				$this->Cmsdocument->validate['directlink2']['rule1'] = array(
					"rule"=>array("custom","@^".CONTENTS_URL."fm/files/.+@"),
					"on"=>null,
					'last' => true,
					'allowEmpty' => true,
					"message"=>"ダイレクトリンク（ファイル）は/(スラッシュ)から始まるパスを入力して下さい"
				);
				$this->Cmsdocument->validate['directlink2']['rule2'] = array(
					"rule"=>array("checkexists"),
					"on"=>null,
					'last' => true,
					'allowEmpty' => true,
					"message"=>"ダイレクトリンク（ファイル）に正しいファイルを入力・選択して下さい"
				);
				$this->Cmsdocument->validate['directlink2']['rule3'] = array(
					"rule"=>array("checkmaxLength",100),
					"on"=>null,
					'last' => true,
					"message"=>"ダイレクトリンク（ファイル）は100文字以下で入力して下さい"
				);
			}
			if(!$this->Cmsdocument->validates()) {

				// 色々戻す
				$input = $this->data['Cmsdocument'];
				for($i=0;$i<count($result);$i++) {
					if( $result[$i]['Cmsitem']['type'] == ITEM_TYPE_CHECK ) { // チェックボックス
						if(is_array($this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']])) {
							$result[$i]['Cmsitem']['input_value'] = implode(",",$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]);
						}
						else {
							$result[$i]['Cmsitem']['input_value'] = "";
						}
					}
					else if( $result[$i]['Cmsitem']['type'] == ITEM_TYPE_RADIO && strpos($result[$i]['Cmsitem']['values_string'],'#') ) { // ラジオ
						$tmp = explode('#',$result[$i]['Cmsitem']['values_string']);
						$result[$i]['Cmsitem']['values_string'] = $tmp[0];
					}
					else {
						$result[$i]['Cmsitem']['input_value'] = $this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']];
					}
				}

				$this->set('input', $input);
				$this->set('list', $result);
				$this->set('error', $this->Cmsdocument->invalidFields());
				$this->render('add');
				return false;
			}

			// もし簡単な説明が入力されていなかったらタイトルを入力
			if( $this->data['Cmsdocument']['explanation'] == "" ) $this->data['Cmsdocument']['explanation'] = $this->data['Cmsdocument']['title'];

			// 直接リンクが設定されていたら
			if($ca_data['Cmscategory']['use_link']) {

				if(!$this->data['Cmsdocument']['directlink']) { // URLが未入力だったら

					if(!$ca_data['Cmscategory']['use_filemanager']) { // ファイルマネージャーが使用されていなかったら

						if( $this->data['Cmsdocument']['directlink2']['error'] == UPLOAD_ERR_OK ) { // ファイルがアップされたら

							// 拡張子を取得
							$data = pathinfo($this->data['Cmsdocument']['directlink2']['name']);
							$extension = strtolower($data['extension']);

							// テンポラリに移動させる
							$temp_filename = uniqid("",1) . "-directlink." . $extension;
							move_uploaded_file($this->data['Cmsdocument']['directlink2']['tmp_name'] , FILE_TEMP_DIR . $temp_filename );

							// テンポラリファイル名をセット
							$this->data['Cmsdocument']['directlink']['tmp_file_name'] = $temp_filename;

							// 値を突っ込んでしまう
							$this->data['Cmsdocument']['directlink']['input_value'] = $temp_filename;
							$this->data['Cmsdocument']['directlink']['input_value2'] = FILE_TEMP_URL.$temp_filename;

							$this->data['Cmsdocument']['directlink_flag'] = "file";
						}
						else {
							$this->data['Cmsdocument']['directlink_flag'] = "";
							$this->data['Cmsdocument']['directlink']['input_value'] = '';
							$this->data['Cmsdocument']['directlink']['input_value2'] = '';
						}
					}
					elseif($this->data['Cmsdocument']['directlink2']) {
						$this->data['Cmsdocument']['directlink_flag'] = "file";
						$this->data['Cmsdocument']['directlink']['input_value'] = '';
						$this->data['Cmsdocument']['directlink']['input_value2'] = '';
					}
					else {
						$this->data['Cmsdocument']['directlink_flag'] = "";
						$this->data['Cmsdocument']['directlink']['input_value'] = '';
						$this->data['Cmsdocument']['directlink']['input_value2'] = '';
					}
				}
				elseif($this->data['Cmsdocument']['directlink']) {
					$this->data['Cmsdocument']['directlink_flag'] = "url";
					$this->data['Cmsdocument']['directlink_url'] = (preg_match('@^https?://@',$this->data['Cmsdocument']['directlink']))?($this->data['Cmsdocument']['directlink']):($this->site['site_url'].$this->data['Cmsdocument']['directlink']); // 表示用
				}
				else {
					$this->data['Cmsdocument']['directlink_flag'] = "";
					$this->data['Cmsdocument']['directlink'] = "";
				}

			}

			// 各アイテム毎に処理
			for($i=0;$i<count($result);$i++) {
				switch($result[$i]['Cmsitem']['type']){
					case ITEM_TYPE_TEXTAREA: // テキストエリア

						if(USE_TINYMCE && !$ca_data['Cmscategory']['use_fulledit'] ) {
							// 値を突っ込んでしまう
							$result[$i]['Cmsitem']['input_value'] = str_replace("</p><p>","<br/><br/>",$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]);
							$result[$i]['Cmsitem']['input_value'] = str_replace("<p>","",$result[$i]['Cmsitem']['input_value']);
							$result[$i]['Cmsitem']['input_value'] = str_replace("</p>","",$result[$i]['Cmsitem']['input_value']);
							$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']] = $result[$i]['Cmsitem']['input_value'];

							$output = preg_replace( '@<a(.+?)href="([^"]+?)">@is' , '<a $1 href="$2" target="_blank">' , $result[$i]['Cmsitem']['input_value'] );
							$output = preg_replace( '@<a(.+?)href="([^"]+?)" target="_self">@is' , '<a $1 href="$2" target="_blank">' , $output );
							$result[$i]['Cmsitem']['outputtext'] = $output;
						}
						else {
							// 値を突っ込んでしまう
							$result[$i]['Cmsitem']['input_value'] = $this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']];
							$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']] = $this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']];
							$result[$i]['Cmsitem']['outputtext'] = $this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']];
						}
						break;
					case ITEM_TYPE_IMAGE: // 画像
						if(!$ca_data['Cmscategory']['use_filemanager']) {
							if( $this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['error'] == UPLOAD_ERR_OK ) { // 画像がアップされたら

								// 拡張子を取得
								$img_info = getimagesize($this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['tmp_name']);

								if( $img_info[2] == IMAGETYPE_GIF ) {
									$extension = '.gif';
								}
								else if( $img_info[2] == IMAGETYPE_JPEG ) {
									$extension = '.jpg';
								}
								else if($img_info[2] == IMAGETYPE_PNG) {
									$extension = '.png';
								}
								else {
									$this->set('error', array('エラーが発生しました。'));
									$this->render('error');
									return false;
								}
								// テンポラリに移動させる
								$temp_filename = uniqid("",1) . "-" . strtolower($result[$i]['Cmsitem']['variable_name']) . $extension;
								move_uploaded_file($this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['tmp_name'] , FILE_TEMP_DIR . $temp_filename );

								// テンポラリファイル名をセット
								$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['tmp_file_name'] = $temp_filename;

								// 値を突っ込んでしまう
								$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['input_value'] = $temp_filename;
								$result[$i]['Cmsitem']['input_value'] = FILE_TEMP_URL.$temp_filename;

								// 縦横サイズを取得・セット
								$preview_size = $this->_getWH(FILE_TEMP_DIR.$temp_filename,PREVIEW_W,PREVIEW_H);
								if(!$preview_size) {
									$this->set('error', array('エラーが発生しました。'));
									$this->render('error');
									return false;
								}
								$result[$i]['Cmsitem']['w'] = $preview_size['w'];
								$result[$i]['Cmsitem']['h'] = $preview_size['h'];
							}
							else {
								$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['input_value'] = '';
								$result[$i]['Cmsitem']['input_value'] = '';
							}
						}
						else {
							$result[$i]['Cmsitem']['input_value'] = $this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']];

							if($result[$i]['Cmsitem']['input_value']) {
								// 縦横サイズを取得・セット
								$preview_size = $this->_getWH(DOCUMENT_ROOT.$result[$i]['Cmsitem']['input_value'],PREVIEW_W,PREVIEW_H);
								if($preview_size) {
									$result[$i]['Cmsitem']['w'] = $preview_size['w'];
									$result[$i]['Cmsitem']['h'] = $preview_size['h'];
								}
							}
						}
						break;
					case ITEM_TYPE_APPENDFILE: // ファイル
						if(!$ca_data['Cmscategory']['use_filemanager']) {
							if( $this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['error'] == UPLOAD_ERR_OK ) { // 画像がアップされたら

								// 拡張子を取得
								$data = pathinfo($this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['name']);
								$extension = strtolower($data['extension']);

								// テンポラリに移動させる
								$temp_filename = uniqid("",1) . "-" . strtolower($result[$i]['Cmsitem']['variable_name']) . "." . $extension;
								move_uploaded_file($this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['tmp_name'] , FILE_TEMP_DIR . $temp_filename );

								// テンポラリファイル名をセット
								$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['tmp_file_name'] = $temp_filename;

								// 値を突っ込んでしまう
								$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['input_value'] = $temp_filename;
								$result[$i]['Cmsitem']['input_value'] = FILE_TEMP_URL.$temp_filename;

							}
							else {
								$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['input_value'] = '';
								$result[$i]['Cmsitem']['input_value'] = '';
							}
						}
						else {
							$result[$i]['Cmsitem']['input_value'] = $this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']];
						}
						break;
					case ITEM_TYPE_CHECK: // チェックボックス

						// 値を突っ込んでしまう
						if(empty($this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']])) {
							$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['input_value'] = '';
							$result[$i]['Cmsitem']['input_value'] = '';
						}
						else {
							$result[$i]['Cmsitem']['input_value'] = implode(",",$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]);
							$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['input_value'] = implode(",",$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]);
						}
						break;
					default:
						// 値を突っ込んでしまう
						$result[$i]['Cmsitem']['input_value'] = $this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']];
						break;
				}

			}

			// セッションにセット
			$this->Session->write( 'documents_data' , $this->data );

			// ドキュメントカテゴリーを取得
			if( $ca_data['Cmscategory']['use_category'] ) {
				if( $this->data['Cmsdocument']['category'] == 0 ) {
					$this->data['Cmsdocument']['category_string'] = '選択しない';
				}
				else {
					$options = array();
					$options['conditions'] = array('Cmsdoccategory.c_id = '=>$c_id,'Cmsdoccategory.id = '=>$this->data['Cmsdocument']['category'],'Cmsdoccategory.delete_flag = '=>'0');
					$doccategory = $this->Cmsdoccategory->find('first',$options);
					if( $doccategory === false || $this->Cmsdoccategory->sqlerror === false || empty($doccategory) ) {
						$this->set('error', array('エラーが発生しました。'));
						$this->render('error');
						return false;
					}

					$this->data['Cmsdocument']['category_string'] = $doccategory['Cmsdoccategory']['name'];
				}
			}

			// 確認画面用に値セット
			$this->set('input', $this->data['Cmsdocument']);
			$this->set('itemdata', $result);

			// トークン設定
			$this->MySecurity->settoken();

			$this->render('add_conf');
		}
		else if( $this->data['Cmsdocument']['mode'] == 'add' ) {

			if(!$this->MySecurity->checktoken('Cmsdocument')) {
				$this->MySecurity->settoken();
				$this->redirect('/cmsdocuments');
				return false;
			}

			// セッションがあるか
			if ( !$this->Session->check("documents_data") ) {
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			$data = $this->Session->read("documents_data");
			$this->Session->del("documents_data");

			// 文字コード変換
//			mb_convert_variables('EUC-JP','UTF-8',$data);

			// データの整理
			$now = date('Y-m-d H:i:s');
			$add_data['c_id'] = $c_id;
			$add_data['title'] = $data['Cmsdocument']['title'];
			$add_data['explanation'] = $data['Cmsdocument']['explanation'];
			$add_data['period_flag'] = $data['Cmsdocument']['period'];
			$add_data['start_date'] = $data['Cmsdocument']['start_date'];
			$add_data['end_date'] = ($data['Cmsdocument']['end_date']!="")?(date('Y-m-d 23:59:59',strtotime($data['Cmsdocument']['end_date']))):('');
			$add_data['c_end_date'] = $data['Cmsdocument']['end_date'];
			$add_data['release_date'] = ($data['Cmsdocument']['period_flag']==1)?($data['Cmsdocument']['start_date']):($now);
			$add_data['create_date'] = $now;
			$add_data['edit_date'] = $now;
			$add_data['disable'] = $data['Cmsdocument']['disable'];
			$add_data['category'] = $data['Cmsdocument']['category'];
			$add_data['directlink'] = ($data['Cmsdocument']['directlink_flag']=='url')?($data['Cmsdocument']['directlink']):('');
			$add_data['directlink_type'] = $data['Cmsdocument']['directlink_flag'];

			// ファイルマネージャーが使用されていた時はファイルパスを入れ直す
			if($ca_data['Cmscategory']['use_filemanager'] && $data['Cmsdocument']['directlink_flag']!='url' && $data['Cmsdocument']['directlink2'] ) {
				$add_data['directlink'] = $data['Cmsdocument']['directlink2'];
			}

			// 登録処理
			$this->Cmsdocument->create();

			if(mysql_client_encoding()=="ujis") mb_convert_variables('EUCJP-win','UTF-8',$add_data);

			$add_data['c_id'] = mysql_real_escape_string($add_data['c_id']);
			$add_data['title'] = mysql_real_escape_string($add_data['title']);
			$add_data['explanation'] = mysql_real_escape_string($add_data['explanation']);
			$add_data['period_flag'] = mysql_real_escape_string($add_data['period_flag']);
			$add_data['start_date'] = mysql_real_escape_string($add_data['start_date']);
			$add_data['end_date'] = mysql_real_escape_string($add_data['end_date']);
			$add_data['release_date'] = mysql_real_escape_string($add_data['release_date']);
			$add_data['create_date'] = mysql_real_escape_string($add_data['create_date']);
			$add_data['edit_date'] = mysql_real_escape_string($add_data['edit_date']);
			$add_data['disable'] = mysql_real_escape_string($add_data['disable']);
			$add_data['category'] = mysql_real_escape_string($add_data['category']);
			$add_data['directlink'] = mysql_real_escape_string($add_data['directlink']);
			$add_data['directlink_type'] = mysql_real_escape_string($add_data['directlink_type']);

			if(mysql_client_encoding()=="ujis") mb_convert_variables('UTF-8','EUCJP-win',$add_data);

			$prefix = $this->_getPrefix('Cmsdocument');

			$sql = "INSERT INTO ".$prefix."cmsdocuments (c_id,title,explanation,period_flag,start_date,end_date,release_date,create_date,edit_date,disable,category,directlink,directlink_type,sort) ";
			$sql .= " SELECT ";
			$sql .= "\"" . $add_data['c_id'] . "\" , " .
				"\"" . $add_data['title'] . "\" , " .
				"\"" . $add_data['explanation'] . "\" , " .
				"\"" . $add_data['period_flag'] . "\" , " .
				"\"" . $add_data['start_date'] . "\" , " .
				"\"" . $add_data['end_date'] . "\" , " .
				"\"" . $add_data['release_date'] . "\" , " .
				"\"" . $add_data['create_date'] . "\" , " .
				"\"" . $add_data['edit_date'] . "\" , " .
				"\"" . $add_data['disable'] . "\" , " .
				"\"" . $add_data['category'] . "\" , " .
				"\"" . $add_data['directlink'] . "\" , " .
				"\"" . $add_data['directlink_type'] . "\" , " .
				"max(sort)+1 "; // ソート番号
			$sql .= " FROM ".$prefix."cmsdocuments where c_id=\"" . $c_id . "\";";

			$this->Cmsdocument->query($sql);

			if( $this->Cmsdocument->sqlerror == false ) {
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

//			$d_id = $this->Cmsdocument->getInsertID();
			$d_id = mysql_insert_id();

			// 直接リンクが設定されていたら
			if($ca_data['Cmscategory']['use_link'] && $data['Cmsdocument']['directlink_flag']=='file' && !$ca_data['Cmscategory']['use_filemanager'] ) {
				// アップされたか
				if( $data['Cmsdocument']['directlink']['input_value'] !="" ) {
					// ファイルの移動
					$filedata = pathinfo($data['Cmsdocument']['directlink']['input_value']);
					$temp_src = FILE_TEMP_DIR . $filedata['basename'];
					$file_name = sprintf("%08s", dechex($d_id));
					$src = APPEND_DIR . "dl" . $file_name . "." . $filedata['extension'];

					// ファイルがあるか
					if( file_exists( $temp_src ) == FALSE ) {
						$this->set('error', array('登録に失敗しました。'));
						$this->render('error');
						return false;
					}

					// ファイルコピー
					if ( @copy( $temp_src , $src ) == FALSE ) {
						$this->set('error', array('登録に失敗しました。'));
						$this->render('error');
						return false;
					}

					// ファイル削除
					if ( @unlink( $temp_src ) == FALSE ) {
						$this->set('error', array('登録に失敗しました。'));
						$this->render('error');
						return false;
					}

					$data['Cmsdocument']['directlink']['input_value'] = "dl" . $file_name . "." . $filedata['extension'];
				}

				// 登録処理
				$up_data=array();
				$up_data['d_id'] = $d_id;
				$up_data['directlink'] = $data['Cmsdocument']['directlink']['input_value'];

				$this->Cmsdocument->create();
				$lists=array('directlink');
				if(!$this->Cmsdocument->save($up_data,false,$lists)){
					$this->set('error', array('エラーが発生しました。'));
					$this->render('error');
					return false;
				}

			}

			for($i=0;$i<count($result);$i++){

				// データの整理
				$add_data=array();
				$add_data['c_id'] = $c_id;
				$add_data['d_id'] = $d_id;
				$add_data['i_id'] = $result[$i]['Cmsitem']['i_id'];
				if( !$ca_data['Cmscategory']['use_filemanager'] && ($result[$i]['Cmsitem']['type'] == ITEM_TYPE_IMAGE || $result[$i]['Cmsitem']['type'] == ITEM_TYPE_APPENDFILE) ) {
					$add_data['value'] = $data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['input_value'];

					// アップされたか
					if( $data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['input_value'] !="" ) {
						// ファイルの移動
						$filedata = pathinfo($data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['input_value']);
						$temp_src = FILE_TEMP_DIR . $filedata['basename'];
						$file_name = sprintf("%08s", dechex($d_id)) . sprintf("%03d", $result[$i]['Cmsitem']['i_id']);
						$src = ($result[$i]['Cmsitem']['type'] == ITEM_TYPE_IMAGE)?(IMAGE_DIR . $file_name ):(APPEND_DIR . "files" . $file_name);
						$src .= "." . $filedata['extension'];

						// 新しいファイル名に入れ直す
						$add_data['value'] = basename($src);

						// 添付ファイルがあるか
						if( file_exists( $temp_src ) == FALSE ) {
							$this->set('error', array('登録に失敗しました。'));
							$this->render('error');
							return false;
						}

						// ファイルコピー
						if ( @copy( $temp_src , $src ) == FALSE ) {
							$this->set('error', array('登録に失敗しました。'));
							$this->render('error');
							return false;
						}

						// ファイル削除
						if ( @unlink( $temp_src ) == FALSE ) {
							$this->set('error', array('登録に失敗しました。'));
							$this->render('error');
							return false;
						}
					}
				}
				elseif( $result[$i]['Cmsitem']['type'] == ITEM_TYPE_CHECK ) { // チェックボックス
					$add_data['value'] = $data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['input_value'];
				}
				else {
					$add_data['value'] = $data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']];
				}

				// 登録処理
				$this->Cmsitemdata->create();
				$lists=array('c_id','d_id','i_id','value');
				if(!$this->Cmsitemdata->save($add_data,false,$lists)){
					$this->set('error', array('エラーが発生しました。'));
					$this->render('error');
					return false;
				}

			}

			// フック処理
			$this->_runHook('doc_add_after', array('d_id'=>$d_id));

			$this->render('add_complete');

		}
		else if( $this->data['Cmsdocument']['mode'] == 'edit' ) {

			// セッションがあるか
			if ( !$this->Session->check("documents_c_id") ) {
				$this->redirect('/tops');
			}
			else {
				$c_id = $this->Session->read("documents_c_id");
			}
			if ( !$this->Session->check("documents_data") ) {
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			$data = $this->Session->read("documents_data");



			for($i=0;$i<count($result);$i++) {

				switch($result[$i]['Cmsitem']['type']){
					case ITEM_TYPE_CHECK: // チェックボックス
						if(!empty($data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']])) {
							$result[$i]['Cmsitem']['input_value'] = implode(',',$data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]);;
						}
						break;
					case ITEM_TYPE_RADIO: // ラジオ
						if( strpos($result[$i]['Cmsitem']['values_string'],'#') ) {
							$tmp = explode('#',$result[$i]['Cmsitem']['values_string']);
							$result[$i]['Cmsitem']['values_string'] = $tmp[0];
						}
						$result[$i]['Cmsitem']['input_value'] = $data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']];
						break;
					default:
						$result[$i]['Cmsitem']['input_value'] = $data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']];
						break;
				}
			}

			// ドキュメントカテゴリーを取得
			if( $ca_data['Cmscategory']['use_category'] ) {
				$options['conditions'] = array('Cmsdoccategory.c_id = '=>$c_id,'Cmsdoccategory.delete_flag = '=>'0');
				$options['order'] = array('Cmsdoccategory.sort'=>'asc');
				$doccategory_data = $this->Cmsdoccategory->find('all',$options);
				if( $doccategory_data === false || $this->Cmsdoccategory->sqlerror === false ) {
					$this->set('error', array('エラーが発生しました。'));
					$this->render('error');
					return false;
				}

				if(CMS_CATEGORY_USE_NOSELECT) {
					array_unshift( $doccategory_data ,array('Cmsdoccategory'=>array('name'=>'選択しない','id'=>0)));
				}
			}
			else {
				$doccategory_data = array();
			}

			$doccategory_list=array();
			for($i=0;$i<count($doccategory_data);$i++) {
				$doccategory_list[$doccategory_data[$i]['Cmsdoccategory']['id']]=$doccategory_data[$i]['Cmsdoccategory']['name'];
			}

			$this->set('doccategory_list', $doccategory_list);

			$data['Cmsdocument']['disable'] = ($data['Cmsdocument']['disable']==1)?("true"):("false");
			$data['Cmsdocument']['period'] = ($data['Cmsdocument']['period']==1)?("true"):("false");

			$this->set('input', $data['Cmsdocument']);
			$this->set('list', $result);

			$this->render('add');
		}
		else {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}


	}

	function edit() {

		// バリデート
		$this->Cmsdocument->setValidation('edit');
		$this->Cmsdocument->create($this->data['Cmsdocument']);
		if(!$this->Cmsdocument->validates()) {
			$this->redirect('/tops');
		}

		// セッションがあるか
		if ( !$this->Session->check("documents_c_id") ) {
			$this->redirect('/tops');
		}
		else {
			$c_id = $this->Session->read("documents_c_id");
		}

		$d_id = isset($this->data['Cmsdocument']['d_id'])?($this->data['Cmsdocument']['d_id']):("");

		if( $d_id == "" ) {
			// セッションがあるか
			if ( !$this->Session->check("documents_d_id") ) {
				$this->redirect('/tops');
			}
			else {
				$d_id = $this->Session->read("documents_d_id");
			}
		}

		$this->set('c_id', $c_id);
		$this->set('d_id', $d_id);

		// カテゴリ情報取得
		$options['conditions'] = array('Cmscategory.c_id = '=>$c_id,'Cmscategory.delete_flag = '=>'0');
		$ca_data = $this->Cmscategory->find('first',$options);
		if( $this->Cmscategory->sqlerror == false || empty($ca_data) ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}
		$this->set('category_name', $ca_data['Cmscategory']['name']);
		$this->set('use_rss', $ca_data['Cmscategory']['use_rss']);
		$this->set('use_period', $ca_data['Cmscategory']['use_period']);
		$this->set('title_max', $ca_data['Cmscategory']['title_max']);
		$this->set('use_category', $ca_data['Cmscategory']['use_category']);
		$this->set('use_link', $ca_data['Cmscategory']['use_link']);
		$this->set('use_fulledit', $ca_data['Cmscategory']['use_fulledit']);
		$this->set('use_filemanager', $ca_data['Cmscategory']['use_filemanager']);
		$this->set('preview_page', $ca_data['Cmscategory']['preview_page']);

		// ドキュメントカテゴリーを取得
		if( $ca_data['Cmscategory']['use_category'] ) {
			$options['conditions'] = array('Cmsdoccategory.c_id = '=>$c_id,'Cmsdoccategory.delete_flag = '=>'0');
			$options['order'] = array('Cmsdoccategory.sort'=>'asc');
			$doccategory_data = $this->Cmsdoccategory->find('all',$options);
			if( $doccategory_data === false || $this->Cmsdoccategory->sqlerror === false ) {
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			if(CMS_CATEGORY_USE_NOSELECT) {
				array_unshift( $doccategory_data ,array('Cmsdoccategory'=>array('name'=>'選択しない','id'=>0)));
			}
		}
		else {
			$doccategory_data = array();
		}

		$doccategory_list=array();
		for($i=0;$i<count($doccategory_data);$i++) {
			$doccategory_list[$doccategory_data[$i]['Cmsdoccategory']['id']]=$doccategory_data[$i]['Cmsdoccategory']['name'];
		}

		$this->set('doccategory_list', $doccategory_list);

		// アイテムを取得
		$options = array();
		$options['conditions'] = array('Cmsdocument.c_id = '=>$c_id,'Cmsdocument.d_id = '=>$d_id,'Cmsdocument.delete_flag = '=>'0');
		$result = $this->Cmsdocument->find('first',$options);
		if( $this->Cmsdocument->sqlerror == false ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$options = array();
		$options['conditions'] = array('Cmsitem.c_id = '=>$c_id,'Cmsitem.delete_flag = '=>'0');
		$options['order'] = array('Cmsitem.sort ASC');
		$result2 = $this->Cmsitem->find('all',$options);
		if( $this->Cmsitem->sqlerror == false ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$items = array();
		for($i=0;$i<count($result2);$i++) {
			$items[$i]="";
			for($d=0;$d<count($result['Cmsitemdata']);$d++){
				if( $result2[$i]['Cmsitem']['i_id']==$result['Cmsitemdata'][$d]['i_id']) {
					if($result2[$i]['Cmsitem']['type'] == ITEM_TYPE_RADIO && strpos($result2[$i]['Cmsitem']['values_string'],'#') ) {
						$tmp = explode('#',$result2[$i]['Cmsitem']['values_string']);
						$items[$i] = array('value'=>$result['Cmsitemdata'][$d]['value']);
						$items[$i] += array('Cmsitem'=>$result2[$i]['Cmsitem']);
						$items[$i]['Cmsitem']['values_string'] = $tmp[0];
					}
					else {
						$items[$i] = array('value'=>$result['Cmsitemdata'][$d]['value']);
						$items[$i] += array('Cmsitem'=>$result2[$i]['Cmsitem']);
					}

					break;
				}
			}
			if($items[$i]=="") {
				$items[$i] = array('value'=>'');
				$items[$i] += array('Cmsitem'=>$result2[$i]['Cmsitem']);
			}
		}

		$result['Cmsdocument']['disable'] = ($result['Cmsdocument']['disable']==1)?("true"):("false");
		$result['Cmsdocument']['period'] = ($result['Cmsdocument']['period_flag']==1)?("true"):("false");

		// 開始日と終了日を整形
		$result['Cmsdocument']['start_date'] = ($result['Cmsdocument']['start_date']!="0000-00-00 00:00:00" && $result['Cmsdocument']['start_date']!="" )?(date('Y/m/d',strtotime($result['Cmsdocument']['start_date']))):("");
		$result['Cmsdocument']['end_date']   = ($result['Cmsdocument']['end_date']!="0000-00-00 00:00:00" && $result['Cmsdocument']['end_date']!="")?(date('Y/m/d',strtotime($result['Cmsdocument']['end_date']))):("");

		// 作成日を分割
		$create_date = strtotime($result['Cmsdocument']['create_date']);
		$result['Cmsdocument']['create_date'] = date('Y/m/d' , $create_date );
		$result['Cmsdocument']['create_h'] = date('H' , $create_date ) * 1;
		$result['Cmsdocument']['create_m'] = date('i' , $create_date ) * 1;
		$result['Cmsdocument']['create_s'] = date('s' , $create_date ) * 1;

		// 直接リンク
		if($result['Cmsdocument']['directlink_type']=='file') {
			$result['Cmsdocument']['directlink2'] = $result['Cmsdocument']['directlink'];
			$result['Cmsdocument']['directlink'] = '';
		}

		$this->set('input', $result['Cmsdocument']);
		$this->set('list', $items);

		$this->Session->write("documents_d_id",$d_id);

	}

	function editdo() {
		// セッションがあるか
		if ( !$this->Session->check("documents_c_id") ) {
			$this->redirect('/tops');
		}
		else {
			$c_id = $this->Session->read("documents_c_id");
		}

		$d_id = isset($this->data['Cmsdocument']['d_id'])?($this->data['Cmsdocument']['d_id']):("");

		if( $d_id == "" ) {
			// セッションがあるか
			if ( !$this->Session->check("documents_d_id") ) {
				$this->redirect('/tops');
			}
			else {
				$d_id = $this->Session->read("documents_d_id");
			}
		}

		$this->set('c_id', $c_id);
		$this->set('d_id', $d_id);

		// カテゴリ情報取得
		$options = array();
		$options['conditions'] = array('Cmscategory.c_id = '=>$c_id,'Cmscategory.delete_flag = '=>'0');
		$ca_data = $this->Cmscategory->find('first',$options);
		if( $this->Cmscategory->sqlerror == false || empty($ca_data) ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}
		$this->set('category_name', $ca_data['Cmscategory']['name']);
		$this->set('use_rss', $ca_data['Cmscategory']['use_rss']);
		$this->set('use_period', $ca_data['Cmscategory']['use_period']);
		$this->set('title_max', $ca_data['Cmscategory']['title_max']);
		$this->set('use_category', $ca_data['Cmscategory']['use_category']);
		$this->set('use_link', $ca_data['Cmscategory']['use_link']);
		$this->set('use_fulledit', $ca_data['Cmscategory']['use_fulledit']);
		$this->set('use_filemanager', $ca_data['Cmscategory']['use_filemanager']);
		$this->set('preview_page', $ca_data['Cmscategory']['preview_page']);

		// ドキュメントカテゴリーを取得
		if( $ca_data['Cmscategory']['use_category'] ) {
			$options['conditions'] = array('Cmsdoccategory.c_id = '=>$c_id,'Cmsdoccategory.delete_flag = '=>'0');
			$options['order'] = array('Cmsdoccategory.sort'=>'asc');
			$doccategory_data = $this->Cmsdoccategory->find('all',$options);
			if( $doccategory_data === false || $this->Cmsdoccategory->sqlerror === false ) {
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			if(CMS_CATEGORY_USE_NOSELECT) {
				array_unshift( $doccategory_data ,array('Cmsdoccategory'=>array('name'=>'選択しない','id'=>0)));
			}
		}
		else {
			$doccategory_data = array();
		}

		$doccategory_list=array();
		for($i=0;$i<count($doccategory_data);$i++) {
			$doccategory_list[$doccategory_data[$i]['Cmsdoccategory']['id']]=$doccategory_data[$i]['Cmsdoccategory']['name'];
		}

		$this->set('doccategory_list', $doccategory_list);

		// アイテム取得
		$options = array();
		$options['conditions'] = array('Cmsitem.c_id = '=>$c_id,'Cmsitem.delete_flag = '=>'0');
		$options['order'] = array('Cmsitem.sort ASC');
		$result = $this->Cmsitem->find('all',$options);
		if( $this->Cmsitem->sqlerror == false ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$this->Cmsdocument->setValidation('default');
		$this->Cmsdocument->setValidationbyitems('Cmsitem',$result,'edit',$ca_data['Cmscategory']['use_filemanager']);
		$this->Cmsdocument->validate['title']['rule1']['rule'] = array("checkmaxLength",$ca_data['Cmscategory']['title_max']);
		$this->Cmsdocument->validate['title']['rule1']['message'] = "タイトルは" . $ca_data['Cmscategory']['title_max'] . "文字以下で入力して下さい";

		// 公開設定が設定されていなかったら開始日と終了日を消す
		if(!$this->data['Cmsdocument']['period']) {
			$this->data['Cmsdocument']['start_date'] = "";
			$this->data['Cmsdocument']['end_date'] = "";
		}

		// モード未設定対応
		if( !isset($this->data['Cmsdocument']['mode']) ) $this->data['Cmsdocument']['mode'] = "";

		if( $this->data['Cmsdocument']['mode'] == 'confirm' ) {

			// 登録済みデータを取得
			$options=array();
			$options['conditions'] = array('Cmsdocument.c_id = '=>$c_id,'Cmsdocument.d_id = '=>$d_id,'Cmsdocument.delete_flag = '=>'0');
			$original_data = $this->Cmsdocument->find('first',$options);
			if( $this->Cmsdocument->sqlerror == false || empty($original_data) ) {
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			// 値のセット
			$this->data['Cmsdocument']['c_end_date'] = $this->data['Cmsdocument']['end_date'];

			// バリデート
			$this->Cmsdocument->create($this->data['Cmsdocument']);

			// ファイルマネージャーを使用していた時にはファイルチェックを外す
			if($ca_data['Cmscategory']['use_filemanager']) {
				$this->Cmsdocument->validate['directlink2']['rule1'] = array(
					"rule"=>array("custom","@^".CONTENTS_URL."fm/files/.+@"),
					"on"=>null,
					'last' => true,
					'allowEmpty' => true,
					"message"=>"ダイレクトリンク（ファイル）は/(スラッシュ)から始まるパスを入力して下さい"
				);
				$this->Cmsdocument->validate['directlink2']['rule2'] = array(
					"rule"=>array("checkexists"),
					"on"=>null,
					'last' => true,
					'allowEmpty' => true,
					"message"=>"ダイレクトリンク（ファイル）に正しいファイルを入力・選択して下さい"
				);
				$this->Cmsdocument->validate['directlink2']['rule3'] = array(
					"rule"=>array("checkmaxLength",100),
					"on"=>null,
					'last' => true,
					"message"=>"ダイレクトリンク（ファイル）は100文字以下で入力して下さい"
				);
			}

			if(!$this->Cmsdocument->validates()) {

				// 確認用画像を戻す
				$input = $this->data['Cmsdocument'];
				$input['directlink_type'] = $original_data['Cmsdocument']['directlink_type'];
				if(!$ca_data['Cmscategory']['use_filemanager'] && $input['directlink_type']=='file') $input['directlink2'] = $original_data['Cmsdocument']['directlink'];
				for($i=0;$i<count($result);$i++) {
					// ファイルの場合
					if(!$ca_data['Cmscategory']['use_filemanager'] && ($result[$i]['Cmsitem']['type'] == ITEM_TYPE_IMAGE || $result[$i]['Cmsitem']['type'] == ITEM_TYPE_APPENDFILE) ) {
						// 以前登録したデータを取得してファイルが登録済みかチェック
						$options=array();
						$options['conditions'] = array('Cmsitemdata.c_id = '=>$c_id,'Cmsitemdata.d_id = '=>$d_id,'Cmsitemdata.i_id = '=>$result[$i]['Cmsitem']['i_id'],'Cmsitemdata.delete_flag = '=>'0');
						$items = $this->Cmsitemdata->find('first',$options);
						if( $this->Cmsitemdata->sqlerror == false ) {
							$this->set('error', array('エラーが発生しました。'));
							$this->render('error');
							return false;
						}

						if( count($items['Cmsitemdata']) != 0 && $items['Cmsitemdata']['value'] != "" ) {
							$result[$i]['value'] = $items['Cmsitemdata']['value'];
						}
						else {
							$result[$i]['value'] = "";
						}
					}
					else if( $result[$i]['Cmsitem']['type'] == ITEM_TYPE_CHECK ) { // チェックボックス
						$result[$i]['value'] = implode(",",$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]);
					}
					else if( $result[$i]['Cmsitem']['type'] == ITEM_TYPE_RADIO && strpos($result[$i]['Cmsitem']['values_string'],'#') ) { // ラジオ
						$tmp = explode('#',$result[$i]['Cmsitem']['values_string']);
						$result[$i]['Cmsitem']['values_string'] = $tmp[0];
					}
					else {
						$result[$i]['value'] = $this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']];
					}
				}

				$this->set('input', $input);
				$this->set('list', $result);
				$this->set('error', $this->Cmsdocument->invalidFields());
				$this->render('edit');
				return false;
			}

			// もし簡単な説明が入力されていなかったらタイトルを入力
			if( $this->data['Cmsdocument']['explanation'] == "" ) $this->data['Cmsdocument']['explanation'] = $this->data['Cmsdocument']['title'];

			// 直接リンクが設定されていたら
			if($ca_data['Cmscategory']['use_link']) {

				if(!$ca_data['Cmscategory']['use_filemanager']) { // ファイルマネージャーを使用してなかったら

					// 変更無くファイルの削除ではなかったら
					if(!$this->data['Cmsdocument']['directlink'] && $this->data['Cmsdocument']['directlink2']['error'] != UPLOAD_ERR_OK && $original_data['Cmsdocument']['directlink_type']=="file" && !$this->data['Cmsdocument']['del_directlink'] ) {
						$this->data['Cmsdocument']['directlink_flag'] = $original_data['Cmsdocument']['directlink_type'];

						// 値を突っ込んでしまう
						$this->data['Cmsdocument']['directlink']['input_value'] = $original_data['Cmsdocument']['directlink'];
						$this->data['Cmsdocument']['directlink']['input_value2'] = CONTENTS_URL . APPEND_DIR_NAME . $original_data['Cmsdocument']['directlink'];

						$this->data['Cmsdocument']['directlink_up'] = false;
					}
					elseif($this->data['Cmsdocument']['directlink']) {
						$this->data['Cmsdocument']['directlink_flag'] = "url";
						$this->data['Cmsdocument']['directlink_up'] = false;
						$this->data['Cmsdocument']['directlink_url'] = (preg_match('@^https?://@',$this->data['Cmsdocument']['directlink']))?($this->data['Cmsdocument']['directlink']):($this->site['site_url'].$this->data['Cmsdocument']['directlink']); // 表示用
					}
					else if(!$this->data['Cmsdocument']['directlink']) { // URLが未入力だったら
						if( $this->data['Cmsdocument']['directlink2']['error'] == UPLOAD_ERR_OK ) { // ファイルがアップされたら

							// 拡張子を取得
							$data = pathinfo($this->data['Cmsdocument']['directlink2']['name']);
							$extension = strtolower($data['extension']);

							// テンポラリに移動させる
							$temp_filename = uniqid("",1) . "-directlink." . $extension;
							move_uploaded_file($this->data['Cmsdocument']['directlink2']['tmp_name'] , FILE_TEMP_DIR . $temp_filename );

							// テンポラリファイル名をセット
							$this->data['Cmsdocument']['directlink']['tmp_file_name'] = $temp_filename;

							// 値を突っ込んでしまう
							$this->data['Cmsdocument']['directlink']['input_value'] = $temp_filename;
							$this->data['Cmsdocument']['directlink']['input_value2'] = FILE_TEMP_URL.$temp_filename;

							$this->data['Cmsdocument']['directlink_flag'] = "file";
							$this->data['Cmsdocument']['directlink_up'] = true;
						}
						else {
							$this->data['Cmsdocument']['directlink_flag'] = "";
							$this->data['Cmsdocument']['directlink'] = '';
							$this->data['Cmsdocument']['directlink_up'] = false;
						}
					}
					else {
						$this->data['Cmsdocument']['directlink_flag'] = "";
						$this->data['Cmsdocument']['directlink'] = "";
						$this->data['Cmsdocument']['directlink_up'] = false;
					}
				}
				else { // ファイルマネージャーを使用していたら

					// URLが指定されていたら
					if($this->data['Cmsdocument']['directlink']) {
						$this->data['Cmsdocument']['directlink_flag'] = "url";
						$this->data['Cmsdocument']['directlink_up'] = false;
						$this->data['Cmsdocument']['directlink_url'] = (preg_match('@^https?://@',$this->data['Cmsdocument']['directlink']))?($this->data['Cmsdocument']['directlink']):($this->site['site_url'].$this->data['Cmsdocument']['directlink']); // 表示用
					}
					elseif($this->data['Cmsdocument']['directlink2']) {
						$this->data['Cmsdocument']['directlink_flag'] = "file";
						$this->data['Cmsdocument']['directlink'] = $this->data['Cmsdocument']['directlink2'];
						$this->data['Cmsdocument']['directlink_up'] = false;
					}
					else {
						$this->data['Cmsdocument']['directlink_flag'] = "";
						$this->data['Cmsdocument']['directlink'] = "";
						$this->data['Cmsdocument']['directlink_up'] = false;
					}

				}
			}

			// 各アイテム毎に処理
			for($i=0;$i<count($result);$i++) {
				switch($result[$i]['Cmsitem']['type']){
					case ITEM_TYPE_TEXTAREA: // テキストエリア

						if(USE_TINYMCE && !$ca_data['Cmscategory']['use_fulledit'] ) {
							// 値を突っ込んでしまう
							$result[$i]['Cmsitem']['input_value'] = $this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']];
							$result[$i]['Cmsitem']['input_value'] = str_replace("</p><p>","<br/><br/>",$result[$i]['Cmsitem']['input_value']);
							$result[$i]['Cmsitem']['input_value'] = str_replace("<p>","",$result[$i]['Cmsitem']['input_value']);
							$result[$i]['Cmsitem']['input_value'] = str_replace("</p>","",$result[$i]['Cmsitem']['input_value']);
							$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']] = $result[$i]['Cmsitem']['input_value'];

							$output = preg_replace( '@<a(.+?)href="([^"]+?)">@is' , '<a $1 href="$2" target="_blank">' , $result[$i]['Cmsitem']['input_value'] );
							$output = preg_replace( '@<a(.+?)href="([^"]+?)" target="_self">@is' , '<a $1 href="$2" target="_blank">' , $output );
							$result[$i]['Cmsitem']['outputtext'] = $output;
						}
						else {
							// 値を突っ込んでしまう
							$result[$i]['Cmsitem']['input_value'] = $this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']];
							$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']] = $this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']];
							$result[$i]['Cmsitem']['outputtext'] = $this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']];
						}
						break;
					case ITEM_TYPE_IMAGE: // 画像
						if(!$ca_data['Cmscategory']['use_filemanager']) { // ファイルマネージャーが使用されていなかったら
							if( $this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['error'] == UPLOAD_ERR_OK ) { // 画像がアップされたら

								// 拡張子を取得
								$img_info = getimagesize($this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['tmp_name']);

								if( $img_info[2] == IMAGETYPE_GIF ) {
									$extension = '.gif';
								}
								else if( $img_info[2] == IMAGETYPE_JPEG ) {
									$extension = '.jpg';
								}
								else if($img_info[2] == IMAGETYPE_PNG) {
									$extension = '.png';
								}
								else {
									$this->set('error', array('エラーが発生しました。'));
									$this->render('error');
									return false;
								}
								// テンポラリに移動させる
								$temp_filename = uniqid("",1) . "-" . strtolower($result[$i]['Cmsitem']['variable_name']) . $extension;
								move_uploaded_file($this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['tmp_name'] , FILE_TEMP_DIR . $temp_filename );

								// テンポラリファイル名をセット
								$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['tmp_file_name'] = $temp_filename;

								// 値を突っ込んでしまう
								$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['input_value'] = $temp_filename;
								$result[$i]['Cmsitem']['input_value'] = FILE_TEMP_URL.$temp_filename;

								// 縦横サイズを取得・セット
								$preview_size = $this->_getWH(FILE_TEMP_DIR.$temp_filename,PREVIEW_W,PREVIEW_H);
								if(!$preview_size) {
									$this->set('error', array('エラーが発生しました。'));
									$this->render('error');
									return false;
								}
								$result[$i]['Cmsitem']['w'] = $preview_size['w'];
								$result[$i]['Cmsitem']['h'] = $preview_size['h'];


							}
							else {
								// 以前登録したデータを取得してファイルが登録済みかチェック
								$options['conditions'] = array('Cmsitemdata.c_id = '=>$c_id,'Cmsitemdata.d_id = '=>$d_id,'Cmsitemdata.i_id = '=>$result[$i]['Cmsitem']['i_id'],'Cmsitemdata.delete_flag = '=>'0');
								$items = $this->Cmsitemdata->find('first',$options);
								if( $this->Cmsitemdata->sqlerror == false ) {
									$this->set('error', array('エラーが発生しました。'));
									$this->render('error');
									return false;
								}
								// チェックしてあったらそれを表示、但し削除フラグが無い場合
								if( $this->data['Cmsdocument']['del_'.$result[$i]['Cmsitem']['variable_name']] != 1 && count($items['Cmsitemdata']) != 0 && $items['Cmsitemdata']['value'] != "" ) {
									$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['input_value'] = '';
									$result[$i]['Cmsitem']['input_value'] = CONTENTS_URL . IMAGE_DIR_NAME .$items['Cmsitemdata']['value'];

									// 縦横サイズを取得・セット
									$preview_size = $this->_getWH(IMAGE_DIR.$items['Cmsitemdata']['value'],PREVIEW_W,PREVIEW_H);
									if(!$preview_size) {
										$this->set('error', array('エラーが発生しました。'));
										$this->render('error');
										return false;
									}
									$result[$i]['Cmsitem']['w'] = $preview_size['w'];
									$result[$i]['Cmsitem']['h'] = $preview_size['h'];

								}
								else {
									$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['input_value'] = '';
									$result[$i]['Cmsitem']['input_value'] = '';
								}
							}
						}
						else { // ファイルマネージャーが使用されていたら
							$result[$i]['Cmsitem']['input_value'] = $this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']];

							if($result[$i]['Cmsitem']['input_value']) {
								// 縦横サイズを取得・セット
								$preview_size = $this->_getWH(DOCUMENT_ROOT.$result[$i]['Cmsitem']['input_value'],PREVIEW_W,PREVIEW_H);
								if($preview_size) {
									$result[$i]['Cmsitem']['w'] = $preview_size['w'];
									$result[$i]['Cmsitem']['h'] = $preview_size['h'];
								}
							}
						}
						break;
					case ITEM_TYPE_APPENDFILE: // ファイル
						if(!$ca_data['Cmscategory']['use_filemanager']) { // ファイルマネージャーが使用されていなかったら
							if( $this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['error'] == UPLOAD_ERR_OK ) { // 画像がアップされたら

								// 拡張子を取得
								$data = pathinfo($this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['name']);
								$extension = strtolower($data['extension']);

								// テンポラリに移動させる
								$temp_filename = uniqid("",1) . "-" . strtolower($result[$i]['Cmsitem']['variable_name']) . '.' . $extension;
								move_uploaded_file($this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['tmp_name'] , FILE_TEMP_DIR . $temp_filename );

								// テンポラリファイル名をセット
								$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['tmp_file_name'] = $temp_filename;

								// 値を突っ込んでしまう
								$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['input_value'] = $temp_filename;
								$result[$i]['Cmsitem']['input_value'] = FILE_TEMP_URL.$temp_filename;

							}
							else {
								// 以前登録したデータを取得してファイルが登録済みかチェック
								$options['conditions'] = array('Cmsitemdata.c_id = '=>$c_id,'Cmsitemdata.d_id = '=>$d_id,'Cmsitemdata.i_id = '=>$result[$i]['Cmsitem']['i_id'],'Cmsitemdata.delete_flag = '=>'0');
								$items = $this->Cmsitemdata->find('first',$options);
								if( $this->Cmsitemdata->sqlerror == false ) {
									$this->set('error', array('エラーが発生しました。'));
									$this->render('error');
									return false;
								}
								// チェックしてあったらそれを表示、但し削除フラグが無い場合
								if( $this->data['Cmsdocument']['del_'.$result[$i]['Cmsitem']['variable_name']] != 1 && count($items['Cmsitemdata']) != 0 && $items['Cmsitemdata']['value'] != "" ) {
									$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['input_value'] = '';
									$result[$i]['Cmsitem']['input_value'] = CONTENTS_URL . APPEND_DIR_NAME .$items['Cmsitemdata']['value'];
								}
								else {
									$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['input_value'] = '';
									$result[$i]['Cmsitem']['input_value'] = '';
								}
							}
						}
						else { // ファイルマネージャーが使用されていたら
							$result[$i]['Cmsitem']['input_value'] = $this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']];
						}
						break;
					case ITEM_TYPE_CHECK: // チェックボックス

						// 値を突っ込んでしまう
						if(empty($this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']])) {
							$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['input_value'] = '';
							$result[$i]['Cmsitem']['input_value'] = '';
						}
						else {
							$result[$i]['Cmsitem']['input_value'] = implode(",",$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]);
							$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['input_value'] = implode(",",$this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]);
						}

						break;
					default:
						// 値を突っ込んでしまう
						$result[$i]['Cmsitem']['input_value'] = $this->data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']];
						break;
				}

			}

			// セッションにセット
			$this->Session->write( 'documents_data' , $this->data );

			// ドキュメントカテゴリーを取得
			if( $ca_data['Cmscategory']['use_category'] ) {
				if( $this->data['Cmsdocument']['category'] == 0 ) {
					$this->data['Cmsdocument']['category_string'] = '選択しない';
				}
				else {
					$options = array();
					$options['conditions'] = array('Cmsdoccategory.c_id = '=>$c_id,'Cmsdoccategory.id = '=>$this->data['Cmsdocument']['category'],'Cmsdoccategory.delete_flag = '=>'0');
					$doccategory = $this->Cmsdoccategory->find('first',$options);
					if( $doccategory === false || $this->Cmsdoccategory->sqlerror === false || empty($doccategory) ) {
						$this->set('error', array('エラーが発生しました。'));
						$this->render('error');
						return false;
					}

					$this->data['Cmsdocument']['category_string'] = $doccategory['Cmsdoccategory']['name'];
				}
			}

			// 確認画面用に値セット
			$this->set('input', $this->data['Cmsdocument']);
			$this->set('itemdata', $result);

			// トークン設定
			$this->MySecurity->settoken();

			$this->render('edit_conf');
		}
		else if( $this->data['Cmsdocument']['mode'] == 'add' ) {

			// 登録済みデータを取得
			$options=array();
			$options['conditions'] = array('Cmsdocument.c_id = '=>$c_id,'Cmsdocument.d_id = '=>$d_id,'Cmsdocument.delete_flag = '=>'0');
			$original_data = $this->Cmsdocument->find('first',$options);
			if( $this->Cmsdocument->sqlerror == false || empty($original_data) ) {
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			if(!$this->MySecurity->checktoken('Cmsdocument')) {
				$this->MySecurity->settoken();
				$this->redirect('/cmsdocuments');
				return false;
			}

			// セッションがあるか
			if ( !$this->Session->check("documents_data") ) {
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			$data = $this->Session->read("documents_data");
			$this->Session->del("documents_data");

			// 直接リンクが設定されていたら
			if($ca_data['Cmscategory']['use_link'] ) {
				// アップされたか
				if( $data['Cmsdocument']['directlink_up'] ) {

					// ファイル削除
					if($original_data['Cmsdocument']['directlink'] && $original_data['Cmsdocument']['directlink_type']!='url' && file_exists(APPEND_DIR.$original_data['Cmsdocument']['directlink'])) {
						if ( @unlink( APPEND_DIR.$original_data['Cmsdocument']['directlink'] ) == false ) {
							$this->set('error', array('登録に失敗しました。'));
							$this->render('error');
							return false;
						}
					}

					// ファイルの移動
					$filedata = pathinfo($data['Cmsdocument']['directlink']['input_value']);
					$temp_src = FILE_TEMP_DIR . $filedata['basename'];
					$file_name = sprintf("%08s", dechex($d_id));
					$src = APPEND_DIR . "dl" . $file_name . "." . $filedata['extension'];

					// ファイルがあるか
					if( file_exists( $temp_src ) == FALSE ) {
						$this->set('error', array('登録に失敗しました。'));
						$this->render('error');
						return false;
					}

					// ファイルコピー
					if ( @copy( $temp_src , $src ) == FALSE ) {
						$this->set('error', array('登録に失敗しました。'));
						$this->render('error');
						return false;
					}

					// ファイル削除
					if ( @unlink( $temp_src ) == FALSE ) {
						$this->set('error', array('登録に失敗しました。'));
						$this->render('error');
						return false;
					}

					$data['Cmsdocument']['directlink'] = basename($src);
				}
				elseif(!$ca_data['Cmscategory']['use_filemanager'] && ($data['Cmsdocument']['del_directlink'] || $data['Cmsdocument']['directlink_flag']=='url') && $original_data['Cmsdocument']['directlink'] && file_exists(APPEND_DIR.$original_data['Cmsdocument']['directlink']) ) { // 削除されたら
					// ファイル削除
					if ( @unlink( APPEND_DIR.$original_data['Cmsdocument']['directlink'] ) == false ) {
						$this->set('error', array('登録に失敗しました。'));
						$this->render('error');
						return false;
					}
				}
				elseif($original_data['Cmsdocument']['directlink'] && !$data['Cmsdocument']['directlink']) {
					$data['Cmsdocument']['directlink'] = '';
					$data['Cmsdocument']['directlink_flag'] = '';
				}
				elseif($data['Cmsdocument']['directlink_flag']!='url'&&!$data['Cmsdocument']['del_directlink']&&$original_data['Cmsdocument']['directlink']) {
					$data['Cmsdocument']['directlink'] = $original_data['Cmsdocument']['directlink'];
				}

			}

			// データの整理
			$now = date('Y-m-d H:i:s');
			$create_date = date('Y-m-d H:i:s' , strtotime($data['Cmsdocument']['createdate'] . " " . $data['Cmsdocument']['create_h'] . ":" . $data['Cmsdocument']['create_m'] .":". $data['Cmsdocument']['create_s'] ));
			$add_data['c_id'] = $c_id;
			$add_data['d_id'] = $d_id;
			$add_data['title'] = $data['Cmsdocument']['title'];
			$add_data['explanation'] = $data['Cmsdocument']['explanation'];
			$add_data['period_flag'] = $data['Cmsdocument']['period'];
			$add_data['start_date'] = $data['Cmsdocument']['start_date'];
			$add_data['end_date'] = ($data['Cmsdocument']['end_date']!="")?(date('Y-m-d 23:59:59',strtotime($data['Cmsdocument']['end_date']))):('');
			$add_data['c_end_date'] = $data['Cmsdocument']['end_date'];
			$add_data['release_date'] = ($data['Cmsdocument']['period_flag']==1)?($data['Cmsdocument']['start_date']):($create_date);
			$add_data['create_date'] = $create_date;
			$add_data['edit_date'] = $now;
			$add_data['disable'] = $data['Cmsdocument']['disable'];
			$add_data['createdate'] = $data['Cmsdocument']['createdate'];
			$add_data['create_h'] = $data['Cmsdocument']['create_h'];
			$add_data['create_m'] = $data['Cmsdocument']['create_m'];
			$add_data['create_s'] = $data['Cmsdocument']['create_s'];
			$add_data['category'] = (!$ca_data['Cmscategory']['use_category'])?('0'):($data['Cmsdocument']['category']);
			$add_data['directlink'] = $data['Cmsdocument']['directlink'];
			$add_data['directlink_type'] = $data['Cmsdocument']['directlink_flag'];

			// 登録処理
			$this->Cmsdocument->create();
			$lists=array('c_id','d_id','title','explanation','period_flag','start_date','end_date','release_date','create_date','edit_date','disable','category','directlink','directlink_type');
			if(!$this->Cmsdocument->save($add_data,false,$lists)||$this->Cmsdocument->sqlerror==false){

				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			for($i=0;$i<count($result);$i++){

				// 各アイテムのIDを取得
				$options['conditions'] = array('Cmsitemdata.c_id = '=>$c_id,'Cmsitemdata.d_id = '=>$d_id,'Cmsitemdata.i_id = '=>$result[$i]['Cmsitem']['i_id'],'Cmsitemdata.delete_flag = '=>'0');
				$items = $this->Cmsitemdata->find('first',$options);
				if( $this->Cmsitemdata->sqlerror == false ) {
					$this->set('error', array('エラーが発生しました。'));
					$this->render('error');
					return false;
				}

				// データの整理
				$add_data=array();
				$add_data['c_id'] = $c_id;
				$add_data['d_id'] = $d_id;
				$add_data['i_id'] = $result[$i]['Cmsitem']['i_id'];
				$add_data['id'] = (isset($items['Cmsitemdata']['id']))?($items['Cmsitemdata']['id']):('');

				if(!$ca_data['Cmscategory']['use_filemanager'] && ($result[$i]['Cmsitem']['type'] == ITEM_TYPE_IMAGE || $result[$i]['Cmsitem']['type'] == ITEM_TYPE_APPENDFILE) ) {
					$add_data['value'] = $data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['input_value'];

					// アップされたか
					if( $data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['input_value'] !="" ) {
						// ファイルの移動
						$filedata = pathinfo($data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['input_value']);
						$temp_src = FILE_TEMP_DIR . $filedata['basename'];
						$file_name = sprintf("%08s", dechex($d_id)) . sprintf("%03d", $result[$i]['Cmsitem']['i_id']);
						$src = ($result[$i]['Cmsitem']['type'] == ITEM_TYPE_IMAGE)?(IMAGE_DIR . $file_name ):(APPEND_DIR . "files" . $file_name);
						$src .= "." . $filedata['extension'];

						// 以前のファイルを削除する
						if( $this->_deletefile($file_name,$result[$i]['Cmsitem']['type']) == FALSE ) {
							$this->set('error', array('登録に失敗しました。'));
							$this->render('error');
							return false;
						}

						// 新しいファイル名に入れ直す
						$add_data['value'] = basename($src);

						// 添付ファイルがあるか
						if( file_exists( $temp_src ) == FALSE ) {
							$this->set('error', array('登録に失敗しました。'));
							$this->render('error');
							return false;
						}

						// ファイルコピー
						if ( @copy( $temp_src , $src ) == FALSE ) {
							$this->set('error', array('登録に失敗しました。'));
							$this->render('error');
							return false;
						}

						// ファイル削除
						if ( @unlink( $temp_src ) == FALSE ) {
							$this->set('error', array('登録に失敗しました。'));
							$this->render('error');
							return false;
						}
					}
					else {
						// チェックしてあったらそれを登録、但し削除フラグが無い場合
						if( $data['Cmsdocument']['del_'.$result[$i]['Cmsitem']['variable_name']] != 1 && count($items['Cmsitemdata']) != 0 && $items['Cmsitemdata']['value'] != "" ) {
							$add_data['value'] = $items['Cmsitemdata']['value'];
						}
						else if( $data['Cmsdocument']['del_'.$result[$i]['Cmsitem']['variable_name']] == 1 ) {
							$src =  $items['Cmsitemdata']['value'];
							$src = ($result[$i]['Cmsitem']['type'] == ITEM_TYPE_IMAGE)?(IMAGE_DIR . $src ):(APPEND_DIR . $src );

							// ファイルがあるか
							if( !is_dir($src) && file_exists( $src ) != FALSE ) {
								// ファイル削除
								if ( @unlink( $src ) == FALSE ) {
									$this->set('error', array('ファイル削除に失敗しました。'));
									$this->render('error');
									return false;
								}
							}

							$add_data['value'] = '';
						}
					}
				}
				elseif( $result[$i]['Cmsitem']['type'] == ITEM_TYPE_CHECK ) { // チェックボックス
					$add_data['value'] = $data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['input_value'];
				}
				else {
					$add_data['value'] = $data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']];
				}

				// 登録処理
				$this->Cmsdocument->unbindModel(array('belongsTo'=>array('Cmsitem')));
				$this->Cmsitemdata->create();
				if( $add_data['id'] == '' ) unset($add_data['id']);
				$lists=array('id','c_id','d_id','i_id','value');
				if(!$this->Cmsitemdata->save($add_data,false,$lists)){
					$this->set('error', array('エラーが発生しました。'));
					$this->render('error');
					return false;
				}

			}

			// フック処理
			$this->_runHook('doc_edit_after', array('d_id'=>$d_id));

			$this->render('edit_complete');

		}
		else if( $this->data['Cmsdocument']['mode'] == 'edit' ) {

			// セッションがあるか
			if ( !$this->Session->check("documents_c_id") ) {
				$this->redirect('/tops');
			}
			else {
				$c_id = $this->Session->read("documents_c_id");
			}
			if ( !$this->Session->check("documents_data") ) {
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			$data = $this->Session->read("documents_data");

			// 登録済みデータを取得
			$options=array();
			$options['conditions'] = array('Cmsdocument.c_id = '=>$c_id,'Cmsdocument.d_id = '=>$d_id,'Cmsdocument.delete_flag = '=>'0');
			$original_data = $this->Cmsdocument->find('first',$options);
			if( $this->Cmsdocument->sqlerror == false || empty($original_data) ) {
				$this->set('error', array('エラーが発生しました。'));
				$this->render('error');
				return false;
			}

			for($i=0;$i<count($result);$i++) {

				switch($result[$i]['Cmsitem']['type']){
					case ITEM_TYPE_CHECK: // チェックボックス
						if(!empty($data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']])) {
							$result[$i]['Cmsitem']['input_value'] = implode(',',$data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]);
						}
						break;
					default:
						$result[$i]['Cmsitem']['input_value'] = $data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']];
						break;
				}
			}

			// 再表示用に値を入れ直す
			$output['Cmsitemdata'] = array();
			for($i=0;$i<count($result);$i++) {
				$output['Cmsitemdata'][$i]['value'] = $data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']];
				$output['Cmsitemdata'][$i]['Cmsitem'] = $result[$i]['Cmsitem'];
				if( isset($data['Cmsdocument']['del_' . $result[$i]['Cmsitem']['variable_name']]) && $data['Cmsdocument']['del_' . $result[$i]['Cmsitem']['variable_name']] == 1 ) {
					$output['Cmsitemdata'][$i]['del'] = "true";
				}
				// ファイルの場合
				if( !$ca_data['Cmscategory']['use_filemanager'] && ($result[$i]['Cmsitem']['type'] == ITEM_TYPE_IMAGE || $result[$i]['Cmsitem']['type'] == ITEM_TYPE_APPENDFILE) ) {
					// 以前登録したデータを取得してファイルが登録済みかチェック
					$options = array();
					$options['conditions'] = array('Cmsitemdata.c_id = '=>$c_id,'Cmsitemdata.d_id = '=>$d_id,'Cmsitemdata.i_id = '=>$result[$i]['Cmsitem']['i_id'],'Cmsitemdata.delete_flag = '=>'0');
					$items = $this->Cmsitemdata->find('first',$options);
					if( $this->Cmsitemdata->sqlerror == false ) {
						$this->set('error', array('エラーが発生しました。'));
						$this->render('error');
						return false;
					}
					if( count($items['Cmsitemdata']) != 0 && $items['Cmsitemdata']['value'] != "" ) {
						$output['Cmsitemdata'][$i]['value'] = $items['Cmsitemdata']['value'];
					}
					else {
						$output['Cmsitemdata'][$i]['value'] = "";
					}
				}
				if( $result[$i]['Cmsitem']['type'] == ITEM_TYPE_CHECK ) {
					$output['Cmsitemdata'][$i]['value'] = $data['Cmsdocument'][$result[$i]['Cmsitem']['variable_name']]['input_value'];
				}
				if($result[$i]['Cmsitem']['type'] == ITEM_TYPE_RADIO && strpos($result[$i]['Cmsitem']['values_string'],'#') ) {
					$tmp = explode('#',$result[$i]['Cmsitem']['values_string']);
					$output['Cmsitemdata'][$i]['Cmsitem']['values_string']  = $tmp[0];
				}
			}

			// ドキュメントカテゴリーを取得
			if( $ca_data['Cmscategory']['use_category'] ) {
				$options['conditions'] = array('Cmsdoccategory.c_id = '=>$c_id,'Cmsdoccategory.delete_flag = '=>'0');
				$options['order'] = array('Cmsdoccategory.sort'=>'asc');
				$doccategory_data = $this->Cmsdoccategory->find('all',$options);
				if( $doccategory_data === false || $this->Cmsdoccategory->sqlerror === false ) {
					$this->set('error', array('エラーが発生しました。'));
					$this->render('error');
					return false;
				}

				if(CMS_CATEGORY_USE_NOSELECT) {
					array_unshift( $doccategory_data ,array('Cmsdoccategory'=>array('name'=>'選択しない','id'=>0)));
				}
			}
			else {
				$doccategory_data = array();
			}

			$doccategory_list=array();
			for($i=0;$i<count($doccategory_data);$i++) {
				$doccategory_list[$doccategory_data[$i]['Cmsdoccategory']['id']]=$doccategory_data[$i]['Cmsdoccategory']['name'];
			}

			$this->set('doccategory_list', $doccategory_list);

			$data['Cmsdocument']['disable'] = ($data['Cmsdocument']['disable']==1)?("true"):("false");
			$data['Cmsdocument']['period'] = ($data['Cmsdocument']['period']==1)?("true"):("false");
			$data['Cmsdocument']['del_directlink'] = ($data['Cmsdocument']['del_directlink']==1)?("true"):("false");

			$data['Cmsdocument']['create_date'] = $data['Cmsdocument']['createdate'];

			// 直接リンク
			if(!$ca_data['Cmscategory']['use_filemanager'] && $original_data['Cmsdocument']['directlink_type']=='file') {
				$data['Cmsdocument']['directlink_type'] = $original_data['Cmsdocument']['directlink_type'];
				$data['Cmsdocument']['directlink2'] = $original_data['Cmsdocument']['directlink'];
			}
			elseif($ca_data['Cmscategory']['use_filemanager'] && $data['Cmsdocument']['directlink_flag']=='file') {
				$data['Cmsdocument']['directlink_type'] = 'file';
				$data['Cmsdocument']['directlink'] = '';
			}
			elseif($ca_data['Cmscategory']['use_filemanager'] && $data['Cmsdocument']['directlink_flag']=='url') {
				$data['Cmsdocument']['directlink_type'] = 'url';
				$data['Cmsdocument']['directlink'] = $data['Cmsdocument']['directlink_url'];
			}

			$this->set('input', $data['Cmsdocument']);
			$this->set('list', $output['Cmsitemdata']);

			$this->render('edit');
		}
		else {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}
	}

	function del() {

		if(!$this->MySecurity->checktoken('Cmsdocument')) {
			$this->MySecurity->settoken();
			$this->redirect('/tops');
			return false;
		}

		// セッションがあるか
		if ( !$this->Session->check("documents_c_id") ) {
			$this->redirect('/tops');
		}
		else {
			$c_id = $this->Session->read("documents_c_id");
		}

		// バリデート
		$this->Cmsdocument->setValidation('del');

		$this->Cmsdocument->create($this->data['Cmsdocument']);

		if(!$this->Cmsdocument->validates()) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		// 情報取得
		$options['conditions'] = array('Cmsdocument.c_id = '=>$c_id,'Cmsdocument.d_id = '=>$this->data['Cmsdocument']['del_d_id'],'Cmsdocument.delete_flag = '=>'0');
		$options['recursive'] = 2;
		$item_result = $this->Cmsdocument->find('first',$options);
		if( $this->Cmsdocument->sqlerror == false || empty($item_result) ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		// フック処理
		$this->_runHook('doc_del_before', array('d_id'=>$this->data['Cmsdocument']['del_d_id']));

		// データの整理
		$del_data['d_id'] = $this->data['Cmsdocument']['del_d_id'];
		$del_data['delete_flag'] = 1;

		$up_list = array('delete_flag');
		$this->Cmsdocument->create();
		if(!$this->Cmsdocument->save($del_data,false,$up_list)) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$prefix = $this->_getPrefix('Cmsdocument');

		$this->Cmsdocument->query('update '.$prefix.'cmsitemdatas set delete_flag = 1 where d_id = "' . mysql_real_escape_string($this->data['Cmsdocument']['del_d_id']) . '";');
		if(mysql_errno!=0) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		// ダイレクトリンク用ファイル削除
		if($item_result['Cmsdocument']['directlink_type']!='url') {
			$link_file = APPEND_DIR . $item_result['Cmsdocument']['directlink'];
			if( !is_dir($link_file) && file_exists( $link_file ) != FALSE ) {
				if ( @unlink( $link_file ) == FALSE ) {
					$this->set('error', array('ファイル削除に失敗しました。'));
					$this->render('error');
					return false;
				}
			}
		}

		// ファイル関係削除
		for( $i=0;$i<count($item_result['Cmsitemdata']);$i++) {
			if( $item_result['Cmsitemdata'][$i]['Cmsitem']['type'] == ITEM_TYPE_IMAGE || $item_result['Cmsitemdata'][$i]['Cmsitem']['type'] == ITEM_TYPE_APPENDFILE ) {
				if( $item_result['Cmsitemdata'][$i]['value'] == "" ) continue;
				$src =  $item_result['Cmsitemdata'][$i]['value'];
				$src = ($item_result['Cmsitemdata'][$i]['Cmsitem']['type'] == ITEM_TYPE_IMAGE)?(IMAGE_DIR . $src ):(APPEND_DIR . $src );

				// ファイルがあるか
				if( !is_dir($src) && file_exists( $src ) != FALSE ) {
					// ファイル削除
					if ( @unlink( $src ) == FALSE ) {
						$this->set('error', array('ファイル削除に失敗しました。'));
						$this->render('error');
						return false;
					}
				}
			}
		}

		// フック処理
		$this->_runHook('doc_del_after', array('d_id'=>$this->data['Cmsdocument']['del_d_id']));

		$this->render('del');

	}

	function sort() {

		// バリデート
		$this->Cmsdocument->setValidation('sort');
		$this->Cmsdocument->create($this->data['Cmsdocument']);
		if(!$this->Cmsdocument->validates()) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$d_id = $this->data['Cmsdocument']['d_id'];
		$sort_flag = $this->data['Cmsdocument']['sort_flag'];

		// セッションがあるか
		if ( !$this->Session->check("documents_c_id") ) {
			$this->redirect('/tops');
		}
		else {
			$c_id = $this->Session->read("documents_c_id");
		}

		// セッションがあるか
		if ( !$this->Session->check("search_category") ) {
			$search_category='';
		}
		else {
			$search_category = $this->Session->read("search_category");
		}

		$options=array();
		$options['conditions'] = array('Cmsdocument.c_id = '=>$c_id,'Cmsdocument.d_id = '=>$d_id,'Cmsdocument.delete_flag = '=>'0');
		$result = $this->Cmsdocument->find('first',$options);
		if( $this->Cmsdocument->sqlerror == false || empty($result) ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$options=array();
		$options['conditions'] = array('Cmsdocument.c_id = '=>$c_id,'Cmsdocument.delete_flag = '=>'0');
		if($search_category) $options['conditions'] += array('Cmsdocument.category = ' => $search_category);
		$options['fields'] = 'Cmsdocument.d_id,Cmsdocument.sort';
		$options['field']  = 'Cmsdocument.sort';
		$options['value']  =  $result['Cmsdocument']['sort'];

		$result2 = $this->Cmsdocument->find('neighbors',$options);
		if( $this->Cmsdocument->sqlerror == false || empty($result2) ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		if( $sort_flag == 1 ) {
			if($result2['next']['Cmsdocument']['d_id'] ) {
				$change_data = array('d_id'=>$result2['next']['Cmsdocument']['d_id'],'sort'=>$result2['next']['Cmsdocument']['sort']);
			}
			else {
				$this->redirect('/cmsdocuments');
				return false;
			}
		}
		elseif($sort_flag == 2) {
			if($result2['prev']['Cmsdocument']['d_id'] ) {
				$change_data = array('d_id'=>$result2['prev']['Cmsdocument']['d_id'],'sort'=>$result2['prev']['Cmsdocument']['sort']);
			}
			else {
				$this->redirect('/cmsdocuments');
				return false;
			}
		}
		else {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		// データの整理
		$add_data['d_id'] = $d_id;
		$add_data['sort'] = $change_data['sort'];

		// 登録処理
		$this->Cmsdocument->create();
		$lists=array('d_id','sort');
		if(!$this->Cmsdocument->save($add_data,false,$lists)){
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		// データの整理
		$add_data2['d_id'] = $change_data['d_id'];
		$add_data2['sort'] = $result['Cmsdocument']['sort'];

		// 登録処理
		$this->Cmsdocument->create();
		$lists=array('d_id','sort');
		if(!$this->Cmsdocument->save($add_data2,false,$lists)){
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		// フック処理
		$this->_runHook('doc_sort_after', array('d_id'=>$d_id, 'sort_flag'=>$sort_flag, 'change_id'=>$change_data['d_id']));

		$this->redirect('/cmsdocuments');
	}

	function valueslist() {

		// 許可されたユーザグループ以外は表示させない
		if(!$this->obAuth->lock(array(2,99))) exit();

		$this->data['Cmsdocument']['id'] = $this->params[named]['id'];

		// バリデート
		$this->Cmsdocument->setValidation('id');
		$this->Cmsdocument->create($this->data['Cmsdocument']);
		if(!$this->Cmscategory->validates()) {
			exit();
		}

		$id = $this->data['Cmsdocument']['id'];

		// カテゴリ情報取得
		$options = array();
		$options['conditions'] = array('Cmscategory.c_id = '=>$id,'Cmscategory.delete_flag = '=>'0');
		$ca_data = $this->Cmscategory->find('first',$options);
		if( $this->Cmscategory->sqlerror == false || empty($ca_data) ) {
			exit();
		}
		$this->set('category_name', $ca_data['Cmscategory']['name']);

		// 一覧取得
		$options = array();
		$options['conditions'] = array('Cmsitem.c_id = '=>$id,'Cmsitem.delete_flag = '=>'0');
		$options['order'] = array('Cmsitem.sort ASC');
		$result = $this->Cmsitem->find('all',$options);
		if( $this->Cmsitem->sqlerror == false ) {
			exit();
		}

		$this->set('list', $result);
	}

	function preview() {

		// 引数から変数名取得
		if( isset( $this->params[named]['n'] ) ) {
			$name = $this->params[named]['n'];
		}
		else {
			exit();
		}

		// セッションから登録内容取得
		if ( $this->Session->check("documents_data") ) {
			$data = $this->Session->read("documents_data");
			$contents = $data['Cmsdocument'][$name];
		}
		else {
			$contents = "";
		}

		$this->set('contents', $contents);
	}

	/**
	 *  ファイルを削除する
	 *  
	 *  @author H.Kobayashi
	 *  @access public
	 *  @return bool 処理結果
	 */
	function _deletefile($name,$flag) {

		if($flag==ITEM_TYPE_IMAGE) {
			$dir_path = IMAGE_DIR;
		}
		else if( $flag==ITEM_TYPE_APPENDFILE ) {
			$dir_path = APPEND_DIR;
			$name = "files" . $name;
		}
		else {
			return false;
		}

		// ディレクトリを開く
		$dir = opendir($dir_path);
		if ($dir!==FALSE) {
			$dir = dir($dir_path);

			while ( $file = $dir->read() ){
				if ( is_dir ( $dir_path . $file ) == FALSE ) {
					if(preg_match("@^" . $name . "\.@",$file)==1) {
						// 経過していたら削除
						if(unlink( $dir_path . $file) === FALSE) {
							return false;
						}
					}
				}
			}
			$dir->close();
		}
		else {
			$dir->close();
			return false;
		}
		return true;
	}

}
?>

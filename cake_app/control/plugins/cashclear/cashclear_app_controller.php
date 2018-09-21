<?php
	class CashclearAppController extends AppController {

		var $uses = array("Cmscategory","Cmsitem","Cmsdocument","Cmsitemdata","Cmsdoccategory");

		/**
		 *  キャッシュ内の古いファイルを削除する
		 *
		 *  @author H.Kobayashi
		 *  @access public
		 *  @return bool 処理結果
		 */
		function _clear() {

			// ディレクトリを開く
			$dir = opendir(CLEAR_CACHE_PATH);
			if ($dir!==false) {
				$dir = dir(CLEAR_CACHE_PATH);

				while ( $file = $dir->read() ){
					if ( is_dir ( CLEAR_CACHE_PATH . $file ) == false ) {
						if(filemtime(CLEAR_CACHE_PATH . $file) <= mktime(23,59,59,date('m'),date('d')-CLEAR_DAYS,date('Y'))) {
							// 経過していたら削除
							if(unlink( CLEAR_CACHE_PATH . $file) === false) {
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

		/**
		 *  対象の記事に含まれる画像ファイルキャッシュを削除
		 *
		 *  @author H.Kobayashi
		 *  @access public
		 *  @return bool 処理結果
		 */
		function _delImageCache($params) {

			// ID取得
			if(!$params['d_id']) return false;
			$d_id = $params['d_id'];

			//モデル取得
			App::import('Model','Cmsdocument');
			$Cmsdocument = new Cmsdocument;

			App::import('Model','Cmsitem');
			$Cmsitem = new Cmsitem;

			// アイテムを取得
			$options = array();
			$options['conditions'] = array('Cmsdocument.d_id = '=>$d_id,'Cmsdocument.delete_flag = '=>'0');
			$result = $Cmsdocument->find('first',$options);
			if( $Cmsdocument->sqlerror == false && empty($result) ) return false;

			$c_id = $result['Cmsdocument']['c_id'];

			$options = array();
			$options['conditions'] = array('Cmsitem.c_id = '=>$c_id,'Cmsitem.delete_flag = '=>'0');
			$options['order'] = array('Cmsitem.sort ASC');
			$result2 = $Cmsitem->find('all',$options);
			if( $Cmsitem->sqlerror == false && empty($result2) ) return false;

			for($i=0;$i<count($result2);$i++) {
				for($d=0;$d<count($result['Cmsitemdata']);$d++){
					if( $result2[$i]['Cmsitem']['i_id']==$result['Cmsitemdata'][$d]['i_id']) {
						if( $result2[$i]['Cmsitem']['type'] == ITEM_TYPE_IMAGE && $result['Cmsitemdata'][$d]['value'] != "" ) { //画像だったら
							$this->_delCache($result['Cmsitemdata'][$d]['value']);
						}
					}
				}
			}

		}

		/**
		 *  対象の画像のキャッシュを削除
		 *
		 *  @author H.Kobayashi
		 *  @access public
		 *  @return bool 処理結果
		 */
		function _delCache($target) {
			if(!$target) return false;
			$target = explode('.',basename($target));
			if(count($target) < 2 ) return false;// 拡張子がないので終了
			$extension = end($target);
			array_pop($target); // 拡張子部分を除去
			$target = implode('',$target);

			return rm(CLEAR_CACHE_PATH . $target.'_*');

		}
	}
?>
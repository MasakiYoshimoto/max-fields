<?php

// 設定を取得
	require_once(PLUGIN_DIR.'/img2/config/config.inc.php');

	require_once(SMARTYANYTIME_DIR.'/lib/class.img2thumb.php');

// プログラム実行ページの登録
	$this->registerPrograms(IMG2_DEFAULT_PATH,'smartyanytime_plugins_img2','start');

	class smartyanytime_plugins_img2 extends smartyanytime_plugins {


		function start() {

			$server = $this->smartyanytime['info']['document_root'];

			if( !isset($_GET['filename']) ) exit();
			if( isset($_GET['newxsize']) && (!is_numeric($_GET['newxsize']) || is_float( $_GET['newxsize'] )) ) exit();
			if( isset($_GET['newysize']) && (!is_numeric($_GET['newysize']) || is_float( $_GET['newysize'] )) ) exit();
			if( !isset($_GET['newxsize']) && !isset($_GET['newysize'])) exit();
			if( isset($_GET['cache'])===true && $_GET['cache']!=0 && $_GET['cache']!=1 ) exit();
			if( isset($_GET['trim'])===true && $_GET['trim']!=0 && $_GET['trim']!=1 ) exit();

			// 他のサイトを指定しようとしたらストップ
			if(preg_match('@^https?://@',$_GET['filename'])==1) exit();
			if(preg_match('@^ftp://@',$_GET['filename'])==1) exit();

			// オリジナルファイルがあるか
			if ( file_exists($server.$_GET['filename']) == false ) exit();

			if(strpos($_GET['filename'], '..') !== false) exit();
			$check = @getimagesize($server.$_GET['filename']);
			if(!$check) {
				exit();
			}

			// リサイズタイプの取得
			if($_GET['newxsize'] && $_GET['newysize']) {
				$resizeType = 1;
			}
			else {
				$resizeType = 2;
			}

			// ファイルパス
			$path = $server.$_GET['filename'];

			// サイズ計算
			$img_size = $this->_getSize($path, $_GET['newxsize'], $_GET['newysize'], $resizeType, $_GET['trim']);

			// テンポラリ作成用サイズ
			if($resizeType==1 && $_GET['trim']) {
				$cacheSizeX = ($_GET['newxsize'])?($_GET['newxsize']):($img_size['width']);
				$cacheSizeY = ($_GET['newysize'])?($_GET['newysize']):($img_size['height']);
			}
			else {
				$cacheSizeX = $img_size['width'];
				$cacheSizeY = $img_size['height'];
			}

			// テンポラリファイルがあるか
			$cache_flag=false;
			$trim_string = ($_GET['trim'])?('t'):('');
			if($_GET['cache']==1) {
				$filename = explode('.',basename($_GET['filename']));
				if(count($filename) < 2 ) exit();// 拡張子がないので終了
				$extension = end($filename);
				array_pop($filename); // 拡張子部分を除去
				$cache_file = $this->smartyanytime['info']['wwwroot_path'].IMG2_CACHE_PATH.implode('',$filename).'_'.$cacheSizeX.'x'.$cacheSizeY.$trim_string.'.'.$extension;

				if(file_exists($cache_file)) {
					if(filemtime($server.$_GET['filename']) > filemtime($cache_file) ) {
						$cache_flag=true;
					}
					else {

						// Last-Modifiedの送信
						//$mod = $this->outputLastModified($cache_file);

						// 更新されていない場合は304を返す
						//$this->checkNotModified($mod);

						$img_status = getimagesize($cache_file);
						if( ( $f = fopen( $cache_file , "r" ) ) ==false ) exit();
						if( ( $src = fread( $f , filesize( $cache_file ) ) ) ==false ) exit();
						if( fclose( $f ) == false ) exit();

						switch( $img_status[2] ) {
							case 1:
								header ("Content-type: image/gif");
								break;
							case 2:
								header ("Content-type: image/jpeg");
								break;
							case 3:
								header ("Content-type: image/png");
								break;
						}

						print $src;
						exit();
					}
				}
				else {
					$cache_flag=true;
				}
			}

			// キャッシュする場合は既存の物を削除
			if($cache_flag) $this->_clear($this->smartyanytime['info']['wwwroot_path'].IMG2_CACHE_PATH, implode('',$filename).'_'.$cacheSizeX.'x'.$cacheSizeY.$trim_string);

			// Last-Modifiedの送信
			$mod = $this->outputLastModified($server.$_GET['filename']);

			// 更新されていない場合は304を返す
			$this->checkNotModified($mod);

			// 画像サイズ計算
			if( $resizeType == 1 && $img_size['original']['width'] <= $_GET['newxsize'] && $img_size['original']['height'] <= $_GET['newysize']) {

				if(($f = fopen($server.$_GET['filename'] , "r")) ==false) exit();
				if(($src = fread($f , filesize( $server.$_GET['filename']))) == false) exit();
				if(fclose($f) == false ) exit();

				switch($img_size['kind']) {
					case 1:
						header ("Content-type: image/gif");
						break;
					case 2:
						header ("Content-type: image/jpeg");
						break;
					case 3:
						header ("Content-type: image/png");
						break;
				}

				print $src;
				exit();
			}

			$width_new = $img_size['width'];
			$height_new = $img_size['height'];
			$point_x = $img_size['point_x'];
			$point_y = $img_size['point_y'];
			$width_old = $img_size['original']['width'];
			$height_old = $img_size['original']['height'];
			$kind = $img_size['kind'];

			if($resizeType==1 && $_GET['trim']) {
				$output_size_x = $_GET['newxsize'];
				$output_size_y = $_GET['newysize'];
			}
			else {
				$output_size_x = $width_new;
				$output_size_y = $height_new;
			}

			if($output_size_x > $img_size['width']) {
				$output_size_x = $img_size['width'];
			}

			if($output_size_y > $img_size['height']) {
				$output_size_y = $img_size['height'];
			}

			if( $point_x < 0 || $point_y < 0 ) exit();

			switch($kind) {
				case IMAGETYPE_GIF:
					header ("Content-type: image/gif");
					$src = imagecreatefromgif($path);
					break;
				case IMAGETYPE_JPEG:
					header ("Content-type: image/jpeg");
					$src = imagecreatefromjpeg($path);
					break;
				case IMAGETYPE_PNG:
					header ("Content-type: image/png");
					$src = imagecreatefrompng($path);
					break;
				default:
					exit();
					break;
			}

			if( $width_new <= 0 ) $width_new = 1;
			if( $height_new <= 0 ) $height_new = 1;

			$img_new = imagecreatetruecolor($width_new, $height_new);
			$img_new2 = imagecreatetruecolor($output_size_x, $output_size_y);
			imagecopyresampled($img_new,$src,0,0,0,0,$width_new,$height_new,$width_old,$height_old);

			ImageCopy($img_new2, $img_new, 0, 0, $point_x, $point_y, $output_size_x, $output_size_y);

			switch($kind) {
				case IMAGETYPE_GIF:
					imagegif($img_new2);
					if($cache_flag) imagegif($img_new2,$cache_file);
					break;
				case IMAGETYPE_JPEG:
					imagejpeg($img_new2, null , 100);
					if($cache_flag) imagejpeg($img_new2,$cache_file , 100);
					break;
				case IMAGETYPE_PNG:
					imagepng($img_new2, null , 9);
					if($cache_flag) imagepng($img_new2,$cache_file , 9);
					break;
				default:
					exit();
					break;
			}

			ImageDestroy($src);
			ImageDestroy($img_new);
			ImageDestroy($img_new2);

			exit();
		}

		function _getSize($path, $width_new, $height_new, $type, $trim) {
			$img_status = getimagesize($path);
			if( $type == 1 && $img_status[0] < $width_new && $img_status[1] < $height_new) {
				if(($f = fopen($path, "r")) ==false ) exit();
				if(($src = fread($f, filesize($path))) ==false ) exit();
				if(fclose( $f ) == false) exit();

				return array('width'=>$img_status[0], 'height'=>$img_status[1], 'kind'=>$img_status[2], 'original'=>array('width'=>$img_status[0], 'height'=>$img_status[1]));
			}
			else {
				$filename = $path;
				$width = $width_new;
				$height = $height_new;
				$point_x = 0;
				$point_y = 0;
				$wper = 0;
				$hper = 0;

				$width_old = $img_status[0];
				$height_old = $img_status[1];

				if($type==1) {
					if( $width >= $width_old && $height >= $height_old ) {
						$width_new = $width_old;
						$height_new = $height_old;
					}
					else {

						$wper = $width / $width_old;
						$hper = $height / $height_old;

						if($trim) {
							if($wper > 1) {
								$per = $hper;
							}
							elseif($hper > 1) {
								$per = $wper;
							}
							else {
								$per = ( $wper >= $hper ) ? ($wper) : ( $hper );
							}
						}
						else {
							if($wper > 1) {
								$per = $hper;
							}
							elseif($hper > 1) {
								$per = $wper;
							}
							else {
								$per = ( $wper <= $hper ) ? ($wper) : ( $hper );
							}
						}

						$wper = ($wper > 1) ? (0) : ($wper);
						$hper = ($hper > 1) ? (0) : ($hper);

						if($hper==0 && $wper==0) {
							$width_new = $width_old;
							$height_new = $height_old;
						}
						else {
							$width_new = round($width_old * $per);
							$height_new = round($height_old * $per);
						}
					}

					if($hper==0 || $wper==0) {
						$width = $width_new;
						$height = $height_new;
					}

					if( $width_new > $width || $height_new > $height ) {
						$point_x = floor($width_new / 2) - floor($width / 2);
						$point_y = floor($height_new / 2) - floor($height / 2);
					}

					return array('width'=>$width_new, 'height'=>$height_new, 'point_x'=>$point_x, 'point_y'=>$point_y, 'kind'=>$img_status[2], 'original'=>array('width'=>$img_status[0], 'height'=>$img_status[1]));
				}
				elseif($type==2 && $width) {
					if($width >= $width_old) {
						$width_new = $width_old;
						$height_new = $height_old;
					}
					else {
						$wper = $width / $width_old;
						$wper = ($wper > 1) ? (0) : ($wper);
						$per = $wper;

						if($wper==0) {
							$width_new = $width_old;
							$height_new = $height_old;
						}
						else {
							$width_new = round($width_old * $per);
							$height_new = round($height_old * $per);
						}
					}

					$height = $height_new;

					if($wper==0) {
						$width = $width_new;
					}

					return array('width'=>$width_new, 'height'=>$height_new, 'point_x'=>$point_x, 'point_y'=>$point_y, 'kind'=>$img_status[2], 'original'=>array('width'=>$img_status[0], 'height'=>$img_status[1]));
				}
				elseif($type==2 && $height) {
					if( $height >= $height_old ) {
						$width_new = $width_old;
						$height_new = $height_old;
					}
					else {
						$hper = $height / $height_old;
						$hper = ($hper > 1) ? (0) : ($hper);
						$per = $hper;

						if($hper==0) {
							$width_new = $width_old;
							$height_new = $height_old;
						}
						else {
							$width_new = round($width_old * $per);
							$height_new = round($height_old * $per);
						}
					}

					$width = $width_new;

					if($hper==0) {
						$height = $height_new;
					}

					return array('width'=>$width_new, 'height'=>$height_new, 'point_x'=>$point_x, 'point_y'=>$point_y, 'kind'=>$img_status[2], 'original'=>array('width'=>$img_status[0], 'height'=>$img_status[1]));
				}
			}
		}

		/**
		 *  古いファイルを削除する
		 *
		 *  @author H.Kobayashi
		 *  @access public
		 *  @param string $target_dir
		 *  @param string $target_file
		 *  @return bool 処理結果
		 */
		function _clear($target_dir, $target_file) {

			return rm($target_dir, $target_file.'.*');
		}

		/**
		 * Last-Modifiedの送信
		 *
		 * @param $file
		 * @return bool|int
		 */
		function outputLastModified($file) {

			$mod = filemtime($file);

			if($mod && is_numeric($mod)){
				// 最終更新時刻送付
				header('Last-Modified: '.gmdate('D, d M Y H:i:s', $mod).' GMT');

				return $mod;
			} else {
				header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');

				return false;
			}
		}

		/**
		 * HTTP_IF_MODIFIED_SINCEを取得
		 *
		 * @return int
		 */
		function getIfModifiedSince() {
			if(isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])){
				$if_mod_sin = stripslashes($_SERVER['HTTP_IF_MODIFIED_SINCE']);
				if(strpos($if_mod_sin, ' GMT') === false) {
					$if_mod_sin .= ' GMT';
				}
				$since = strtotime($if_mod_sin);
				if($since !== false) {
					return $since;
				}
			}
			return 0;
		}

		/**
		 * 更新の確認
		 *
		 * @param mixed $mod
		 */
		function checkNotModified($mod = false) {
			$since = $this->getIfModifiedSince();
			if($mod && is_numeric($mod) && ($since >= $mod)){
				header('HTTP/1.1 304 Not Modified');
				exit();
			}
		}
	}
?>
<?php

// プラグインの登録
	$this->registerPlugins('before','smartyanytime_plugins_job','start');

// Smartyプラグインの登録
	$this->smarty->register_function('job_list', array('smartyanytime_plugins_job','job_list'), false);
	$this->smarty->register_function('job_detail', array('smartyanytime_plugins_job','job_detail'), false);
	$this->smarty->register_function('new_job_list', array('smartyanytime_plugins_job','new_job_list'), false);

	class smartyanytime_plugins_job extends smartyanytime_plugins {

		var $res;

		function start() {
			global $res;

			$this->res = $res;

			if( ! empty($_GET['area']) && ! is_array($_GET['area']))
			{
				$this->assign('search_area', explode(',', $_GET['area']));
			}
			elseif(is_array($_GET['area']))
			{
				$this->assign('search_area', $_GET['area']);
			}
			else
			{
				$this->assign('search_area', array());
			}

			if( ! empty($_GET['job']) && ! is_array($_GET['job']))
			{
				$this->assign('search_job', explode(',', $_GET['job']));
			}
			elseif(is_array($_GET['job']))
			{
				$this->assign('search_job', $_GET['job']);
			}
			else
			{
				$this->assign('search_job', array());
			}
		}

		function job_list($params, &$smarty) {
			define('USE_MYSQLI', false);
			$wwwroot = $smarty->smartyanytime['info']['wwwroot'];
			$wwwroot = ($wwwroot=='/') ? (''):($wwwroot);

			$cms = $smarty->smartyanytime['plugins']['smartyanytime_plugins_job'];

			// 各値の基本値を設定
			$job = ($params['job'])?($params['job']):('');
			$search_area = ($params['area'])?($params['area']):('');
			$max = ($params['max'])?($params['max']):(10);
			$search_null = (isset($params['search_null'])!==false)?($params['search_null']):(false);
			$move = (isset($params['move'])!==false)?($params['move']):(true);

			// categoryチェック
			$category = array();
			require(realpath(SMARTYANYTIME_DIR.'/../cake_app/category.php'));

			$category_tmp= array();
			foreach($category as $value) {
				$category_tmp += $value;
			}
			$category = $category_tmp;


			if($job) {
				if(!is_array($job)) {
					$job = explode(',', $job);
				}

				foreach($job as $key=>$value) {
					if(!$category[$value]) unset($job[$key]);
				}
			}

			if($job) {
				if(is_array($job)) {
					$job = implode(',', $job);
				}
			}
			else {
				$job = '';
			}

			// areaチェック
			$area = array();
			require(realpath(SMARTYANYTIME_DIR.'/../cake_app/area.php'));

			if($search_area) {
				if(!is_array($search_area)) {
					$search_area = explode(',', $search_area);
				}

				foreach($search_area as $key=>$value) {
					if(!$area[$value]) unset($search_area[$key]);
				}
			}

			if($search_area) {
				if(is_array($search_area)) {
					$search_area = implode(',', $search_area);
				}
			}
			else {
				$search_area = '';
			}

			// ページ遷移をしない場合はpageを1へ
			if(!$move) $_GET['p'] = 1;

			// リストを設定
			$cms->setJobList($job, $search_area, $max, $search_null);

		}

		function new_job_list($params, &$smarty) {
			define('USE_MYSQLI', false);
			$wwwroot = $smarty->smartyanytime['info']['wwwroot'];
			$wwwroot = ($wwwroot=='/') ? (''):($wwwroot);

			$cms = $smarty->smartyanytime['plugins']['smartyanytime_plugins_job'];

			// 各値の基本値を設定
			$max = ($params['max'])?($params['max']):(6);

			// リストを設定
			$cms->setNewJobList($max);

		}

		function job_detail($params, &$smarty) {
			define('USE_MYSQLI', false);
			$dummy=array();
			$cms = $smarty->smartyanytime['plugins']['smartyanytime_plugins_job'];

			// リストを設定
			$cms->setDetail();

			print '';
		}

		function setJobList ($search_job, $search_area, $listmax=10, $search_null) {
			$output = array();
			$pagelist = array();
			$pagelist_max = 5;

			if(!$search_job && !$search_area) {
				$this->assign('initialize' , true);
			}
			else {
				$this->assign('initialize' , false);
			}

			// 検索条件のnullを許さない場合、検索条件がnullだった場合は空を返す
			if(!$search_null && !$search_job && !$search_area) {
				$this->assign('job' , array());

				return array();
			}

			////////////////////////////////////////////////
			// リスト表示処理
			///////////////////////////////////////////////

			// ページを受け取る
			$page = ( isset( $_GET['p'] ) !== true ) ? ( 1 ) : ( $_GET['p'] );


			// ドキュメント数を取得
			$max = $this->getJobNam($search_job, $search_area, $search_null);
			if($max === false) {
				$this->redirectTop();
			}

			// 最大ページ数取得
			$page_max = ceil($max / $listmax);
			if($page_max == 0) $page_max = 1;

			// 現在ページの調整
			$page = ($page > $page_max) ? ($page_max) : ($page);

			// 前後ページ
			$prev_page = (($page - 1) < 1) ? (1) : ($page - 1);
			$next_page = (($page + 1) > $page_max) ? ($page_max) : ($page + 1);

			///////////////////////////
			// リストでも作ってみる
			//////////////////////////

			if($max != 0) {
				$page_max = ceil($max / $listmax);

				$page = ($page > $page_max) ? ($page_max) : ($page);

				$end_page = $page_max;
				if($page_max > $pagelist_max) {
					if(($page + 2) > $pagelist_max) {
						$end_page = $page + 2;
					}
					else {
						$end_page = $pagelist_max;
					}
				}
			}
			else {
				$page_max = 0;
				$end_page = 0;
			}

			$end_page   = ($end_page > $page_max) ? ($page_max) : ($end_page);
			$start_page = $end_page - ($pagelist_max - 1);
			$start_page = ($start_page < 1) ? (1) : ($start_page);

			// リスト制作
			for ($i = $start_page; $i <= $end_page; $i++) {
				$pagelist[] = $i;
			}

			// オフセット設定
			$start = (($page * $listmax) - $listmax);
			$end   = $listmax;

			// データを取得
			$data = $this->getJobData($search_job, $search_area, $search_null, $start, $end);
			if($data === false) $this->redirectTop();

			// 件数取得
			$maxcount = count($data);

			// カテゴリーのセット
			$category = array();
			require(realpath(SMARTYANYTIME_DIR.'/../cake_app/category.php'));

			// エリアのセット
			$area = array();
			require(realpath(SMARTYANYTIME_DIR.'/../cake_app/area.php'));

			foreach($data as $key=>$value) {
				$job_cat = explode(',', $value['category']);
				$a_job_cat = array();
				foreach($job_cat as $value2) {
					$a_job_cat[] = $category[$value2];
				}

//				$job_area = explode(',', $value['location']);
//				$a_job_area = array();
//				foreach($job_area as $value2) {
//					$a_job_area[] = $area[$value2];
//				}

				$data[$key]['category'] = implode(',', $a_job_cat);
//				$data[$key]['location'] = implode(',', $a_job_area);
			}

			$search_query = '';
			if($search_job) {
				$a_job = explode(',', $search_job);
				$search_query .= '&job='.urlencode(implode(',', $a_job));
			}
			if($search_area) {
				$a_area = explode(',', $search_area);
				$search_query .= '&area='.urlencode(implode(',', $a_area));
			}

			if($page == 1)
			{
				$start_count = 1;
				$end_count = count($data);
			}
			else
			{
				$start_count = ($page - 1) * $listmax + 1;
				$end_count = $start_count + count($data) - 1;
			}

			$outlist['count'] = $max;
			$outlist['search_query'] = $search_query;
			$outlist['page_list'] = $pagelist;
			$outlist['page'] = $page;
			$outlist['maxpage'] = $end_page;
			$outlist['list'] = $data;
			$outlist['start'] = $start_count;
			$outlist['end'] = $end_count;

			$this->assign('job' , $outlist);
			$this->assign('area_list', $area);
			$this->assign('wwwroot_path', htmlentities($this->smartyanytime['info']['wwwroot_path'], ENT_QUOTES));

			return $output;
		}

		function setNewJobList($listmax=6) {
			$output = array();

			////////////////////////////////////////////////
			// リスト表示処理
			///////////////////////////////////////////////

			// データを取得
			$data = $this->getNewJobData($listmax);
			if($data === false) $this->redirectTop();

			// カテゴリーのセット
			$category = array();
			$cat = array();
			require(realpath(SMARTYANYTIME_DIR.'/../cake_app/category.php'));
			foreach($category as $key=>$value)
			{
				$cat = $cat + $value;
			}
			$category = $cat;

			// エリアのセット
			$area = array();
			require(realpath(SMARTYANYTIME_DIR.'/../cake_app/area.php'));

			foreach($data as $key=>$value) {
				$job_cat = explode(',', $value['category']);
				$a_job_cat = array();
				foreach($job_cat as $value2) {
					$a_job_cat[] = $category[$value2];
				}
				$data[$key]['category'] = implode(',', $a_job_cat);
			}

			$outlist['list'] = $data;
			$outlist['count'] = count($data);

			$this->assign('job' , $outlist);
			$this->assign('area_list', $area);
			$this->assign('wwwroot_path', htmlentities($this->smartyanytime['info']['wwwroot_path'], ENT_QUOTES));

			return $output;
		}

		function setDetail() {

			$id = isset($_GET['d']) ? ($_GET['d']) : (0);
			if(!is_numeric($id) || !is_int($id * 1)) $this->redirectTop();
			if((string)$id !== (string)(int)$id) $this->redirectTop();


			$data = $this->getJobDetailData($id);
			if ($data === false)  $this->redirectTop();

			// カテゴリーのセット
			$category = array();
			require(realpath(SMARTYANYTIME_DIR.'/../cake_app/category.php'));

			// エリアのセット
			$area = array();
			require(realpath(SMARTYANYTIME_DIR.'/../cake_app/area.php'));

			$job_cat = explode(',', $data['category']);
			$a_job_cat = array();
			foreach($job_cat as $value2) {
				$a_job_cat[] = $category[$value2];
			}

			$data['category'] = implode(',', $a_job_cat);
			$data['location_string'] = $area[$data['location']];

			$this->assign('data', $data);
			$this->assign('wwwroot_path', htmlentities($this->smartyanytime['info']['wwwroot_path'], ENT_QUOTES));

			return $data;
		}

		function getJobNam ($job, $area, $job_null) {

			$res = $this->res;

			// エスケープ
			if(USE_MYSQLI) {
				$job = $res->real_escape_string($job);
				$area = $res->real_escape_string($area);
			}
			else{
				$job = mysql_real_escape_string($job);
				$area = mysql_real_escape_string($area);
			}

			// カテゴリー
			$job_sql = '';
			$a_job_sql = array();
			if($job) {
				if(!is_array($job)) {
					$job = explode(',', $job);
				}

				foreach($job as $value) {
					$a_job_sql[] = 'category LIKE "%'.$value.'%"';
				}

				$job_sql = ' AND ('.implode(' OR ', $a_job_sql).') ';
			}

			// エリア
			$area_sql = '';
			$a_area_sql = array();
			if($area) {
				if(!is_array($area)) {
					$area = explode(',', $area);
				}

				foreach($area as $value) {
					$a_area_sql[] = 'location LIKE "%'.$value.'%"';
				}

				$area_sql = ' AND ('.implode(' OR ', $a_area_sql).') ';
			}

			if(!$job_null && !$job_sql && !$area_sql) {
				return false;
			}

			// 今を取得
			$now_date = date('Y-m-d');

			$sql = 'SELECT * FROM '.DB_PREFIX.'job_offers WHERE disable = 0 AND deleted = 0 '.$job_sql;
			$sql .= $area_sql;
			$sql .= ' AND ';
			$sql .= '(open_date <= "'.$now_date.'" OR !DAYOFMONTH(open_date)) AND ';
			$sql .= '(end_date >= "'.$now_date.'" OR !DAYOFMONTH(end_date)) ';

			if(USE_MYSQLI) {
				$results = $res->query($sql);
				if(!$results) {
					return false;
				}

				$row = $results->num_rows;
				$results->free();
				return $row;
			}
			else {
				$query = @mysql_query ( $sql );
				if ( mysql_errno ( ) != 0 ) return false;

				return mysql_num_rows ( $query );
			}
		}

		function getJobData ($job, $area, $job_null, $start, $end) {

			$res = $this->res;

			$data = array();

			$random_sql = '';

			// エスケープ
			if(USE_MYSQLI) {
				$job = $res->real_escape_string($job);
				$area = $res->real_escape_string($area);
				$start = $res->real_escape_string($start);
				$end = $res->real_escape_string($end);
			}
			else{
				$job = mysql_real_escape_string($job);
				$area = mysql_real_escape_string($area);
				$start = mysql_real_escape_string($start);
				$end = mysql_real_escape_string($end);
			}

			// ソート順
			$sort_sql = 'ORDER BY reg_date DESC, modified DESC';

			// カテゴリー
			$job_sql = '';
			$a_job_sql = array();
			if($job) {
				if(!is_array($job)) {
					$job = explode(',', $job);
				}

				foreach($job as $value) {
					$a_job_sql[] = ' category LIKE "%'.$value.'%" ';
				}

				$job_sql = ' AND ('.implode(' OR ', $a_job_sql).') ';
			}

			// エリア
			$area_sql = '';
			$a_area_sql = array();
			if($area) {
				if(!is_array($area)) {
					$area = explode(',', $area);
				}

				foreach($area as $value) {
					$a_area_sql[] = 'location LIKE "%'.$value.'%"';
				}

				$area_sql = ' AND ('.implode(' OR ', $a_area_sql).') ';
			}

			if(!$job_null && !$job_sql && !$area_sql) {
				return false;
			}

			// 今を取得
			$now_date = date('Y-m-d');

			$sql = 'SELECT * FROM '.DB_PREFIX.'job_offers WHERE disable = 0 AND deleted = 0 '.$job_sql;
			$sql .= $area_sql;
			$sql .= ' AND ';
			$sql .= '(open_date <= "'.$now_date.'" OR !DAYOFMONTH(open_date)) AND ';
			$sql .= '(end_date >= "'.$now_date.'" OR !DAYOFMONTH(end_date)) ';
			$sql .= $sort_sql;
			$sql .= " LIMIT " . $start . " , " . $end;

			if(USE_MYSQLI) {
				$results = $res->query($sql);
				if(!$results) {
					return false;
				}
				if($results->num_rows == 0) {
					$results->free();
					return array();
				}
				while ($fetch = $results->fetch_assoc()) $data[] = $fetch;
				$results->free();
			}
			else {
				$query = @mysql_query ( $sql );
				if ( mysql_errno ( ) != 0 ) return false;
				if ( mysql_num_rows ( $query ) == 0 ) return array();

				while ( $fetch = mysql_fetch_assoc ( $query ) ) $data[] = $fetch;
			}

			return $data;
		}

		function getNewJobData ($limit) {

			$res = $this->res;

			$data = array();

			// エスケープ
			if(USE_MYSQLI) {
				$limit = $res->real_escape_string($limit);
			}
			else{
				$limit = mysql_real_escape_string($limit);
			}

			// ソート順
			$sort_sql = 'ORDER BY reg_date DESC, modified DESC';

			// 今を取得
			$now_date = date('Y-m-d');

			$sql = 'SELECT * FROM '.DB_PREFIX.'job_offers WHERE disable = 0 AND deleted = 0 ';
			$sql .= ' AND ';
			$sql .= '(open_date <= "'.$now_date.'" OR !DAYOFMONTH(open_date)) AND ';
			$sql .= '(end_date >= "'.$now_date.'" OR !DAYOFMONTH(end_date)) ';
			$sql .= $sort_sql;
			$sql .= " LIMIT ".$limit;

			if(USE_MYSQLI) {
				$results = $res->query($sql);
				if(!$results) {
					return false;
				}
				if($results->num_rows == 0) {
					$results->free();
					return array();
				}
				while ($fetch = $results->fetch_assoc()) $data[] = $fetch;
				$results->free();
			}
			else {
				$query = @mysql_query ( $sql );
				if ( mysql_errno ( ) != 0 ) return false;
				if ( mysql_num_rows ( $query ) == 0 ) return array();

				while ( $fetch = mysql_fetch_assoc ( $query ) ) $data[] = $fetch;
			}

			return $data;
		}

		function getJobDetailData ($id) {

			$res = $this->res;

			$data = array();

			$random_sql = '';

			// エスケープ
			if(USE_MYSQLI) {
				$id = $res->real_escape_string($id);
			}
			else{
				$id = mysql_real_escape_string($id);
			}

			// 今を取得
			$now_date = date('Y-m-d');

			$sql = 'SELECT * FROM '.DB_PREFIX.'job_offers WHERE id="'.$id.'" AND ';
			$sql .= '(open_date <= "'.$now_date.'" OR !DAYOFMONTH(open_date)) AND ';
			$sql .= '(end_date >= "'.$now_date.'" OR !DAYOFMONTH(end_date)) AND ';
			$sql .= "disable = 0 AND ";
			$sql .= "deleted = 0;";

			if(USE_MYSQLI) {
				$results = $res->query($sql);
				if(!$results) {
					return false;
				}
				if($results->num_rows == 0) {
					$results->free();
					return false;
				}
				$data = $results->fetch_assoc();
				$results->free();
			}
			else {
				$query = @mysql_query ( $sql );
				if ( mysql_errno ( ) != 0 ) return false;
				if ( mysql_num_rows ( $query ) == 0 ) return false;

				$data = mysql_fetch_assoc($query);
			}

			return $data;
		}

		function getRate () {

			$res = $this->res;

			$data = array();

			$sql = 'SELECT * FROM '.DB_PREFIX.'job_closeds WHERE id="1";';

			if(USE_MYSQLI) {
				$results = $res->query($sql);
				if(!$results) {
					return false;
				}
				if($results->num_rows == 0) {
					$results->free();
					return false;
				}
				$data = $results->fetch_assoc();
				$results->free();
			}
			else {
				$query = @mysql_query ( $sql );
				if ( mysql_errno ( ) != 0 ) return false;
				if ( mysql_num_rows ( $query ) == 0 ) return false;

				$data = mysql_fetch_assoc($query);
			}

			return $data;
		}

		/**
		 *  サイトのトップへリダイレクト
		 *
		 *  @author H.Kobayashi
		 *  @access public
		 */
		function redirectTop() {
			$wwwroot = $this->smartyanytime['info']['wwwroot'];
			$wwwroot = ($wwwroot=='/') ? (''):($wwwroot);

			header('Location: '.$wwwroot.'/');
			exit();
		}

		/**
		 *  Smartyへアサイン
		 *
		 *  @author H.Kobayashi
		 *  @param string $name アサイン名
		 *  @param mix $value アサイン値
		 *  @param bool $flag エンティティ処理フラグ
		 *  @return bool 処理結果
		 */
		function assign($name,$value,$flag=true ) {
			if( $flag==true ) {
				$value = smartyanytime_util::htmlentitiesExtend( $value , 'utf-8' );
				$value = smartyanytime_util::replaceExtend( "\\\\" , "￥" ,$value );
			}

			// 携帯だったらSJIS変換
			if($this->smartyanytime['info']['mobile'] && !$this->smartyanytime['info']['smartphone']) mb_convert_variables( 'SJIS-win' , 'utf-8' , $value );

			$this->smarty->assign($name,$value);
		}
	}

?>
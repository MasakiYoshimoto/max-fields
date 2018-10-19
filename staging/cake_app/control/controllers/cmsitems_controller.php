<?php
class CmsitemsController extends AppController
{
	var $name = "Cmsitems";
	var $uses = array("Cmsitem","Cmscategory","Cmsitemdata");
	var $components = array("obAuth","MySecurity","Arms");
	var $layout = false;

	function beforeFilter(){
		$this->obAuth->startup($this);
		if(!$this->obAuth->lock(array(99))) $this->redirect('/');
		parent::beforeFilter();
	}

	function index() {
		// バリデート
		$this->Cmsitem->setValidation('index');
		$this->Cmsitem->create($this->data['Cmsitem']);

		if(!$this->Cmsitem->validates()) {
			$this->redirect('/tops');
		}

		$c_id = isset($this->data['Cmscategory']['edit_c_id'])?($this->data['Cmscategory']['edit_c_id']):("");

		if( $c_id == "" ) {
			// セッションがあるか
			if ( !$this->Session->check("items_c_id") ) {
				$this->redirect('/tops');
			}
			else {
				$c_id = $this->Session->read("items_c_id");
			}
		}

		$this->set('c_id', $c_id);
		$this->Session->write("items_c_id",$c_id);

		$this->_setvalues( $c_id );

		// トークン設定
		$this->MySecurity->settoken();

	}

	function up() {

		if(!$this->MySecurity->checktoken('Cmsitem')) {
			$this->MySecurity->settoken();
			return $this->redirect('/tops');
		}

		// バリデート
		$this->Cmsitem->setValidation('up');

		$this->Cmsitem->create($this->data['Cmsitem']);

		if(!$this->Cmsitem->validates()) {
			$this->MySecurity->settoken();
			$this->set('error', $this->Cmsitem->invalidFields());
			$this->_return_index();
			return false;
		}

		// データの整理
		$add_data['i_id'] = $this->data['Cmsitem']['up_i_id'];
		$add_data['name'] = $this->data['Cmsitem']['up_item_name'];
		$add_data['values_string'] = $this->data['Cmsitem']['up_values'];
		$add_data['max'] = $this->data['Cmsitem']['up_max'];
		$add_data['unit'] = $this->data['Cmsitem']['up_unit'];
		$add_data['variable_name'] = strtoupper($this->data['Cmsitem']['up_variable_name']);
		$add_data['explanation'] = $this->data['Cmsitem']['up_explanation'];
		$add_data['required'] = $this->data['Cmsitem']['up_required'];

		$up_list = array('i_id','name','values_string','max','unit','variable_name','explanation','required');
		$this->Cmsitem->create();
		if(!$this->Cmsitem->save($add_data,false,$up_list)) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$this->render('up');

	}

	function add() {

		if(!$this->MySecurity->checktoken('Cmsitem')) {
			$this->MySecurity->settoken();
			$this->redirect('/tops');
		}

		// バリデート
		$this->Cmsitem->setValidation('add');

		$this->Cmsitem->create($this->data['Cmsitem']);

		if(!$this->Cmsitem->validates()) {
			$this->MySecurity->settoken();
			$this->set('error', $this->Cmsitem->invalidFields());
			$this->_return_index();
			return false;
		}

		// データの整理
		$add_data['c_id'] = $this->data['Cmsitem']['c_id'];
		$add_data['type'] = $this->data['Cmsitem']['type'];
		$add_data['name'] = $this->data['Cmsitem']['item_name'];
		$add_data['values_string'] = $this->data['Cmsitem']['values'];
		$add_data['max'] = $this->data['Cmsitem']['max'];
		$add_data['unit'] = $this->data['Cmsitem']['unit'];
		$add_data['variable_name'] = strtoupper($this->data['Cmsitem']['variable_name']);
		$add_data['explanation'] = $this->data['Cmsitem']['explanation'];
		$add_data['required'] = $this->data['Cmsitem']['required'];

//		$this->Cmsitem->create();
//		$up_list = array('c_id','type','name','values_string','variable_name','explanation','required');
//		if(!$this->Cmsitem->save($add_data,false,$up_list)){
//			$this->set('error', array('エラーが発生しました。'));
//			$this->render('error');
//			return false;
//		}

		$add_data['c_id'] = mysql_real_escape_string($add_data['c_id']);
		$add_data['type'] = mysql_real_escape_string($add_data['type']);
		$add_data['name'] = mysql_real_escape_string($add_data['name']);
		$add_data['values_string'] = mysql_real_escape_string($add_data['values_string']);
		$add_data['max'] = mysql_real_escape_string($add_data['max']);
		$add_data['unit'] = mysql_real_escape_string($add_data['unit']);
		$add_data['variable_name'] = mysql_real_escape_string($add_data['variable_name']);
		$add_data['explanation'] = mysql_real_escape_string($add_data['explanation']);
		$add_data['required'] = mysql_real_escape_string($add_data['required']);

		$prefix = $this->_getPrefix('Cmsitem');

		$sql = "INSERT INTO ".$prefix."cmsitems (c_id,type,name,values_string,max,unit,variable_name,explanation,required,sort) ";
		$sql .= " SELECT ";
		$sql .= "\"" . $add_data['c_id'] . "\" , " .
			"\"" . $add_data['type'] . "\" , " .
			"\"" . $add_data['name'] . "\" , " .
			"\"" . $add_data['values_string'] . "\" , " .
			"\"" . $add_data['unit'] . "\" , " .
			"\"" . $add_data['max'] . "\" , " .
			"\"" . $add_data['variable_name'] . "\" , " .
			"\"" . $add_data['explanation'] . "\" , " .
			"\"" . $add_data['required'] . "\" , " .
			"max(sort)+1 "; // ソート番号
		$sql .= " FROM ".$prefix."cmsitems where c_id=\"" . $add_data['c_id'] . "\";";

		$this->Cmsitem->query($sql);
		if( mysql_errno() !=0 ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->_return_index();
			return false;
		}

		$this->render('add');

	}

	function del() {

		if(!$this->MySecurity->checktoken('Cmsitem')) {
			$this->MySecurity->settoken();
			return $this->redirect('/tops');
		}

		// バリデート
		$this->Cmsitem->setValidation('del');

		$this->Cmsitem->create($this->data['Cmsitem']);

		if(!$this->Cmsitem->validates()) {
			$this->MySecurity->settoken();
			$this->set('error', $this->Cmsitem->invalidFields());
			$this->_return_index();
			return false;
		}

		// データの整理
		$del_data['i_id'] = $this->data['Cmsitem']['del_i_id'];
		$del_data['delete_flag'] = 1;

		$up_list = array('delete_flag');
		$this->Cmsitem->create();
		if(!$this->Cmsitem->save($del_data,false,$up_list)) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$prefix = $this->_getPrefix('Cmsitemdata');

		$this->Cmsitemdata->query('update '.$prefix.'cmsitemdatas set delete_flag = 1 where i_id = "' . mysql_real_escape_string($this->data['Cmsitem']['del_i_id']) . '";');

		$this->render('del');

	}

	function sort() {

		// バリデート
		$this->Cmsitem->setValidation('sort');
		$this->Cmsitem->create($this->data['Cmsitem']);

		if(!$this->Cmsitem->validates()) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$c_id = $this->data['Cmsitem']['c_id'];
		$i_id = $this->data['Cmsitem']['i_id'];
		$sort_flag = $this->data['Cmsitem']['sort_flag'];

		$options['conditions'] = array('Cmsitem.c_id = '=>$c_id,'Cmsitem.i_id = '=>$i_id,'Cmsitem.delete_flag = '=>'0');
		$result = $this->Cmsitem->find('first',$options);
		if( $this->Cmsitem->sqlerror == false || empty($result) ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$options = array();
		$options['conditions'] = array('Cmsitem.c_id = '=>$c_id,'Cmsitem.delete_flag = '=>'0');
		$options['fields'] = 'Cmsitem.i_id,Cmsitem.sort';
		$options['field']  = 'Cmsitem.sort';
		$options['value']  =  $result['Cmsitem']['sort'];

		$result2 = $this->Cmsitem->find('neighbors',$options);
		if( $this->Cmsitem->sqlerror == false || empty($result2) ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		if( $sort_flag == 2 ) {
			if($result2['next']['Cmsitem']['i_id'] ) {
				$change_data = array('i_id'=>$result2['next']['Cmsitem']['i_id'],'sort'=>$result2['next']['Cmsitem']['sort']);
			}
			else {
				$this->redirect('/cmsitems');
				return false;
			}
		}
		elseif($sort_flag == 1) {
			if($result2['prev']['Cmsitem']['i_id'] ) {
				$change_data = array('i_id'=>$result2['prev']['Cmsitem']['i_id'],'sort'=>$result2['prev']['Cmsitem']['sort']);
			}
			else {
				$this->redirect('/cmsitems');
				return false;
			}
		}
		else {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		// データの整理
		$add_data['i_id'] = $i_id;
		$add_data['sort'] = $change_data['sort'];

		// 登録処理
		$this->Cmsitem->create();
		$lists=array('sort');
		if(!$this->Cmsitem->save($add_data,false,$lists)){
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		// データの整理
		$add_data2['i_id'] = $change_data['i_id'];
		$add_data2['sort'] = $result['Cmsitem']['sort'];

		// 登録処理
		$this->Cmsitem->create();
		$lists=array('sort');
		if(!$this->Cmsitem->save($add_data2,false,$lists)){
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}

		$this->redirect('/cmsitems');
	}

	function _return_index( ) {

		// セッションがあるか
		if ( !$this->Session->check("items_c_id") ) {
			$this->redirect('/tops');
		}
		else {
			$c_id = $this->Session->read("items_c_id");
		}

		$this->_setvalues( $c_id );

		$this->render('index');
		return false;
	}

	function _setvalues( $c_id ) {

		// リスト表示
		$options['conditions'] = array('Cmsitem.c_id = '=>$c_id,'Cmsitem.delete_flag = '=>'0');
		$options['order'] = array('Cmsitem.sort asc');
		$result = $this->Cmsitem->find('all',$options);
		if( $this->Cmsitem->sqlerror == false ) {
			$this->set('error', array('エラーが発生しました。'));
			$this->render('error');
			return false;
		}
		$this->set('list', $result);

		// カテゴリー名表示
		$name = $this->Cmscategory->read(null,$c_id);
		$this->set('name', $name['Cmscategory']['name']);

		// プルダウン表示
		$lists = array();
		$lists += array(1=>"１行テキスト");
		$lists += array(2=>"テキストエリア");
		$lists += array(3=>"画像");
		$lists += array(4=>"添付ファイル");
		$lists += array(5=>"ラジオボタン");
		$lists += array(6=>"セレクト");
		$lists += array(7=>"チェックボックス");
//		$lists += array(8=>"日付");
//		$lists += array(9=>"日時");
		$lists += array(10=>"テキストエリア(ノーマル)");

		$this->set('lists', $lists);
		$this->set('c_id', $c_id);

	}


}
?>

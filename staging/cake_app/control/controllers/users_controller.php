<?php
	class UsersController extends AppController
	{
		var $name = "Users";
		var $components = array('obAuth','Cookie', 'MySecurity');
		var $layout = false;

		function beforeFilter(){
			$this->obAuth->startup($this);
			if($this->params['action'] != 'login' && $this->params['action'] != 'logout') {
				if(!$this->obAuth->lock(array())) $this->redirect('/');
			}
		}

		function login()
		{

			// トークンのチェック
			if(!$this->MySecurity->checktoken('User', true, 'Pages')) {
				$this->redirect('/');
				return false;
			}

			if(isset($this->data['User']))
			{

				if(!defined('SECRET_KEYWORD')===true || !defined('SECRET_KEYWORD2')===true) {
					return $this->render('error');
				}

				$checkUser = $this->User->find('first', array('conditions' => array('User.username = '=>$this->data['User']['username'], 'User.active = '=>1)));
				$chekcDate = strtotime("-1 hour"); // 1時間前
				if($checkUser['User']['id'] && $checkUser['User']['fault_cnt'] >= LOGIN_FAULT_MAX && $chekcDate > strtotime($checkUser['User']['lock_time'])) {
					$upData = array();
					$upData['id']         =  $checkUser['User']['id'];
					$upData['fault_cnt']  =  0;
					$upData['lock_time']  =  '0000-00-00 00:00:00';
					$this->User->save($upData);
				}
				elseif($checkUser['User']['id'] && $checkUser['User']['fault_cnt'] >= LOGIN_FAULT_MAX) {
					$this->render('lock');
					return;
				}

				if($this->obAuth->login($this->data['User']))
				{
					if( $this->data['User']['save'] == 1 ) {

						if(USE_CRYPT_BLOWFISH) {
							App::import('Vendor', 'Crypt_Blowfish', array('file' => 'Crypt' . DS . 'Blowfish.php'));
							$key = SECRET_KEYWORD;
							$key2 = SECRET_KEYWORD2;
							$blowfish =& new Crypt_Blowfish($key);
							$blowfish2 =& new Crypt_Blowfish($key2);
							$password = $this->data['User']['username'] . '<|<>|>' . $this->obAuth->user['User']['id'];
							$encrypt= base64_encode($blowfish->encrypt($password));

							if(!$this->obAuth->user['User']['password2']) {
								$upData = array();
								$upData['id']         =  $this->obAuth->user['User']['id'];
								$upData['password2'] =  base64_encode($blowfish2->encrypt($this->data['User']['password']));
								$this->User->save($upData);
							}
						}
						else {
							$encrypt = md5($this->data['User']['username']) . md5($this->data['User']['password']);
						}
						$settime = 100 * 24 * 3600;
						$this->Cookie->write('mlup',$encrypt,false,$settime); // 100日間保存
					}
					else {
						$this->Cookie->write('mlup','',false,time()-3600); // 削除
					}

					session_regenerate_id(true);

					$this->Cookie->write('alc','1',false);

					$this->Session->write('loginUserAgent', sha1($_SERVER['HTTP_USER_AGENT']));
					$this->Cookie->write('alc',sha1(session_id()),false);

					if($this->obAuth->user['User']['fault_cnt'] > 0) {
						$upData = array();
						$upData['id']         =  $this->obAuth->user['User']['id'];
						$upData['fault_cnt']  =  0;
						$upData['lock_time']  =  '0000-00-00 00:00:00';
						$this->User->save($upData);
					}

					$this->redirect('/tops');
				}
				else {
					$loginUser = $this->User->find('first', array('conditions' => array('User.username = '=>$this->data['User']['username'], 'User.active = '=>1)));
					if($loginUser['User']['id'] && $loginUser['User']['fault_cnt'] <= LOGIN_FAULT_MAX) {
						$upData = array();
						$upData['id']         =  $loginUser['User']['id'];
						$upData['fault_cnt']  =  $loginUser['User']['fault_cnt'] + 1;
						$this->User->save($upData);
					}

					$loginUser = $this->User->find('first', array('conditions' => array('User.username = '=>$this->data['User']['username'], 'User.active = '=>1,)));
					if($loginUser['User']['id'] && $loginUser['User']['fault_cnt'] >= LOGIN_FAULT_MAX) {

						$upData = array();
						$upData['id']         =  $loginUser['User']['id'];
						$upData['lock_time']  =  date('Y-m-d H:i:s');
						$this->User->save($upData);

						$this->render('lock');
						return;
					}

					$this->render('error');
//				$this->flash("Username/Password is incorrect","/" , 1000);
				}
			}
		}
		function logout()
		{

			$this->obAuth->lock();
			$this->obAuth->logout('logout');

			$this->Cookie->write('alc','',false,time()-3600); // 削除
		}

		function index() {

		}
	}
?>

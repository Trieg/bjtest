<?php
namespace App\Controller;
use Core\Controller;

class ControllerAdmin extends Controller
{
	
	public function _login()
	{
		$adminConfig     = $this->app->config->get('app:admin');
		
		if($this->isPost()) {
			$response      = [
				'errors'   => [],
				'status'   => 'ok',
			];
			
			$adminLogin  = $this->getPost('admin_login');
			$adminPwd    = $this->getPost('admin_pwd');
			
			if( (md5($adminPwd) != $adminConfig['pwd']) || ($adminLogin != $adminConfig['login']) ) {
				$response['errors']['admin_login'] = 'Вы ввели не верные данные!';
				$response['errors']['admin_pwd'] = 'Вы ввели не верные данные!';
			}
			if(empty($adminLogin)) {
				$response['errors']['admin_login'] = 'Поле обязательно для заполнения!';
			}
			if(empty($adminPwd)) {
				$response['errors']['admin_pwd'] = 'Поле обязательно для заполнения!';
			}
			
			if(count($response['errors'])) {
				$response['status'] = 'error';
			} 
			else {
				$this->setSession('admin-login', true);
			}
			
			return $this->jsonResponse($response);
		}
		
		return $this->app->view->show('layer', [
			'title'           => 'Авторизация администратора',
			'main-template'   => 'admin-login',
		]);
	}
	
	public function _logout()
	{
		$this->setSession('admin-login', false);
		
		$this->redirect();
	}
	
}


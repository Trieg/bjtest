<?php
namespace Core;
use Core\App;

class Controller
{
	protected $app;
	
	public function __construct(App $app)
	{
		$this->app = $app;
		
		$this->app->view->addGlobal('admin-login', $this->getSession('admin-login', false));
		
		$this->app->view->addGlobal('root-url', SITE_URL_PREFIX);
		$this->app->view->addGlobal('public-url', SITE_PUBLIC_URL);
	}
	
	public function isPost()
	{
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			return true;
		}
		
		return false;
	}
	
	public function getPost(string $key)
	{
		if(isset($_POST[ $key ])) {
			return $_POST[ $key ];
		}
		
		return false;
	}
	
	public function jsonResponse($response)
	{
		echo json_encode($response);
		
		return;
	}
	
	public function redirectBack() 
	{
		$ref = $_SERVER['HTTP_REFERER'] ?? null;
		
        if ($ref != null) {
            header("Location: {$ref}");
        }
    }
	
	public function redirect(string $url = '/') 
	{
		header("Location: {$url}");
		
		die();
    }
	
	public function setSession(string $key, $value) 
	{
		$_SESSION[ $key ] = $value;
		
        return $this;
    }
	
	public function getSession(string $key, $default = null) 
	{
		return ($_SESSION[ $key ] ?? $default);
    }
	
}

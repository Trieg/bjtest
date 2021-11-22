<?php
namespace Core;

class App
{
	public $config;
	public $db;
	public $view;
	
	public function __construct()
	{
		$this->config = new \Core\Config('app');
		
		$dbConfig     = $this->config->get('app:database');
		$this->db     = new \Core\Database($dbConfig['dsn'], $dbConfig['user'], $dbConfig['password']);
		unset($dbConfig);
		
		$this->view   = new \Core\View('app/view');
	}
	
	public function model(string $name)
	{
		$modelClass = "\\App\\Model\\Model{$name}";
		
		if(!class_exists($modelClass)) {
			throw new Exception("Model class '{$modelClass}' not found!");
		}
		
		$modelObject = new $modelClass($this->db);
		
		return $modelObject;
	}
	
}

<?php

const APP_DIR   = __DIR__;
const CORE_DIR  = 'system';

chdir($_SERVER['DOCUMENT_ROOT']);

session_start();

date_default_timezone_set('UTC');
mb_regex_encoding('UTF8');
mb_internal_encoding('UTF8');
ini_set('memory_limit', '512M');

spl_autoload_register(function(?string $className = null) {
	$classFile       = '';
	$className       = str_replace('\\', '/', $className);
	
	if(stripos($className, 'Core/') === 0) {
		$classFile   = CORE_DIR . '/' . substr($className, 5) . '.php';
	}
	elseif(stripos($className, 'App/') === 0) {
		$classFile   = APP_DIR . '/' . substr($className, 4) . '.php';
	}
	
	if(!empty($classFile) && file_exists($classFile)) {
		require_once $classFile;
	}
	
}, true, true);

$app = new \Core\App();

\Core\Router::route(SITE_ENTRY_POINT . '/(\d+)?', function($pageId = null) use($app) {
	$controller = new \App\Controller\ControllerTask($app);
	$controller->_main($pageId);
});

\Core\Router::route(SITE_ENTRY_POINT . '/task/add', function() use($app) {
	$controller = new \App\Controller\ControllerTask($app);
	$controller->_add();
});

\Core\Router::route(SITE_ENTRY_POINT . '/task/sort/(\w+)/(\w+)', function($dbField = null, $sort = null) use($app) {
	$controller = new \App\Controller\ControllerTask($app);
	$controller->_setTaskSort($dbField, $sort);
});


\Core\Router::route(SITE_ENTRY_POINT . '/task/edit/(\d+)', function($taskId = null) use($app) {
	$controller = new \App\Controller\ControllerTask($app);
	$controller->_edit($taskId);
});

\Core\Router::route(SITE_ENTRY_POINT . '/admin/login', function() use($app) {
	$controller = new \App\Controller\ControllerAdmin($app);
	$controller->_login();
});

\Core\Router::route(SITE_ENTRY_POINT . '/admin/logout', function() use($app) {
	$controller = new \App\Controller\ControllerAdmin($app);
	$controller->_logout();
});

\Core\Router::execute(($_SERVER['REQUEST_URI'] ?? '/'));


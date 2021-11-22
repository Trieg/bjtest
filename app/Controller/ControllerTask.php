<?php
namespace App\Controller;
use Core\Controller;

class ControllerTask extends Controller
{
	
	public function _main($pageId = 1)
	{
		$model                       = $this->app->model('Task');
		
		$taskListPagination          = $model->pagination('task', $pageId, 3, 3);
		$taskListSort                = $this->getSession('task_sort', [ 'task_id', 'asc' ]);
		
		$taskList                    = $model->getTaskList($taskListPagination['offset'], $taskListPagination['rowsperpage'], $taskListSort);
		
		return $this->app->view->show('layer', [
			'title'           => 'Список задач',
			'main-template'   => 'task-list',
			'task-list'       => $taskList,
			'task-pagination' => $taskListPagination,
			'task-list-sort'  => $taskListSort,
			'task-model'      => $model
		]);
	}
	
	public function _edit(int $taskId)
	{
		if(!$this->getSession('admin-login', false)) {
			$this->redirect();
		}
		
		$model       = $this->app->model('Task');
		$taskCurrent = $model->getTaskById($taskId);
		
		if(!$taskCurrent) {
			$this->redirect();
		}
		
		if($this->isPost()) {
			$response      = [
				'errors'   => [],
				'status'   => 'ok',
			];
			
			$taskText           = $this->getPost('task_text');
			$taskStatusDone     = $this->getPost('status_done');
			
			$statusEdited       = $taskText == $taskCurrent['task_text'] ? 1 : 2;
			
			if(empty($taskText)) {
				$response['errors']['task_text'] = 'Поле обязательно для заполнения!';
			}
			
			if(count($response['errors'])) {
				$response['status'] = 'error';
			} 
			else {
				$model->editTask($taskId, $taskText, $taskStatusDone, $statusEdited);
			}
			
			return $this->jsonResponse($response);
		}
		
		
		return $this->app->view->show('layer', [
			'title'         => 'Редактировать задачу',
			'main-template' => 'task-edit',
			'task-current'  => $taskCurrent,
			
		]);
	}
	
	public function _add()
	{
		$model      = $this->app->model('Task');
		
		if($this->isPost()) {
			$response      = [
				'errors'   => [],
				'status'   => 'ok',
			];
			
			$taskUsername = $this->getPost('task_username');
			$taskEmail    = $this->getPost('task_email');
			$taskText     = $this->getPost('task_text');
			
			if(empty($taskUsername)) {
				$response['errors']['task_username'] = 'Поле обязательно для заполнения!';
			}
			
			if(!filter_var($taskEmail, FILTER_VALIDATE_EMAIL)) {
				$response['errors']['task_email'] = 'Введите корректный формат email адреса!';
			}
			if(empty($taskEmail)) {
				$response['errors']['task_email'] = 'Поле обязательно для заполнения!';
			}
			
			if(empty($taskText)) {
				$response['errors']['task_text'] = 'Поле обязательно для заполнения!';
			}
			
			if(count($response['errors'])) {
				$response['status'] = 'error';
			} 
			else {
				$model->addTask($taskUsername, $taskEmail, $taskText);
			}
			
			return $this->jsonResponse($response);
		}
		
		
		return $this->app->view->show('layer', [
			'title'         => 'Создать новую задачу',
			'main-template' => 'task-add',
		]);
	}
	
	public function _setTaskSort($dbField = '', $sort = '')
	{
		$this->setSession('task_sort', [ $dbField, $sort ]);
		
		$this->redirectBack();
	}
	
}


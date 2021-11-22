<?php
namespace App\Model;
use Core\Model;

class ModelTask extends Model
{
	protected $listOrder  = [
		'task_id',
		'task_username', 
		'task_email',
		'task_text',
		'task_status',
	];
	
	protected $taskStatus  = [
		1   => 'Новая',
		2   => 'Выполнено',
	];
	
	public function convertTaskStatusIdToText($value)
	{
		return $this->taskStatus[ $value ] ?? $value;
	}
	
	public function getTaskById(int $id)
	{
		$id                = (int) $id;
		$data              = $this->pdo->query("SELECT * FROM task WHERE task_id={$id}")->fetch();
		
		return $data;
	}
	
	public function getTaskList($offset = 0, $rows = 3, $taskListSort = null)
	{
		$offset    = (int) $offset;
		$rows      = (int) $rows;
		
		$orderCol  = in_array($taskListSort[0], $this->listOrder) ? $taskListSort[0] : 'task_id';
		$orderDir  = in_array($taskListSort[1], ['desc', 'asc']) ? $taskListSort[1] : 'asc';
		
		$data   = $this->pdo->query("SELECT * FROM task ORDER BY {$orderCol} {$orderDir} LIMIT {$offset}, {$rows}")->fetchAll();
		
		return $data;
	}
	
	public function addTask($username, $email, $text)
	{
		$username = $this->quoteString($username);
		$email    = $this->quoteString($email);
		$text     = $this->quoteString($text);
		
		
		$this->pdo->exec("INSERT INTO task (task_username, task_email, task_text) VALUES ({$username}, {$email}, {$text})");
	}
	
	public function editTask(int $id, $text, $statusDone = false, int $statusEdited = 1)
	{
		$id        = (int) $id;
		$text      = $this->quoteString($text);
		
		$statusId      = $statusDone ? 2 : 1 ;
		$statusSqlCode = ", task_status={$statusId}";
		
		$this->pdo->exec("UPDATE task SET task_text={$text}, task_edited={$statusEdited} {$statusSqlCode} WHERE task_id={$id}");
	}
	
}


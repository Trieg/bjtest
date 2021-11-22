<?php
namespace Core;
use PDO;

class Database
{
	protected $pdo;
	
	public function __construct($dsn, $user, $password, $options = [])
	{
		$this->pdo         = new PDO($dsn, $user, $password, $options);
	}
	
	public function getPdoObject()
	{
		return $this->pdo;
	}
	
	public function quoteString($string)
	{
		return $this->pdo->quote($string, PDO::PARAM_STR);
	}
	
}

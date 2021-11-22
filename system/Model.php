<?php
namespace Core;
use Core\Database,
	PDO;

class Model
{
	protected $db;
	protected $pdo;
	
	public function __construct(Database $db)
	{
		$this->db    = $db;
		$this->pdo   = $this->db->getPdoObject();
	}
	
	public function quoteString($string)
	{
		return $this->db->quoteString($string);
	}
	
	public function pagination(string $tableName, $currentPage, $rowsperpage = 3, $range = 3)
	{
		$return            = [
			'first'        => '',
			'last'         => '',
			'back'         => '',
			'next'         => '',
			'pages'        => [],
			'offset'       => '',
			'rowsperpage'  => $rowsperpage,
		];
		
		$numrows           = $this->pdo->query("SELECT COUNT(*) FROM {$tableName}")->fetch();
		$numrows           = $numrows[0];
		$totalpages        = ceil($numrows / $rowsperpage);
		
		if(isset($currentPage) && is_numeric($currentPage)) {
			$currentpage   = (int) $currentPage;
		}
		else {
			$currentpage   = 1;
		}
		
		if($currentpage > $totalpages) {
			$currentpage   = $totalpages;
		}
		
		if($currentpage < 1) {
			$currentpage   = 1;
		}
		
		$offset            = ($currentpage - 1) * $rowsperpage;
		
		$return['offset']  = $offset;
		
		if($currentpage > 1) {
			$prevpage        = $currentpage - 1;
			
			$return['first'] = 1;
			$return['back']  = $prevpage;
		}
		
		for($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
			if(($x > 0) && ($x <= $totalpages)) {
				if($x == $currentpage) {
					$return['pages'][] = [
						'current' => true,
						'number'  => $x,
					];
				} 
				else {
					$return['pages'][] = [
						'current' => false,
						'number'  => $x,
					];
				}
		   }
		}
		
		if($currentpage != $totalpages) {
			$nextpage         = $currentpage + 1;
			$return['next']   = $nextpage;
			$return['last']   = $totalpages;
		}
		
		return $return;
	}
	
}

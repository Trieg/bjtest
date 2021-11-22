<?php
namespace Core;

class View
{
	protected $templatePath = 'app/view';
	protected $data         = [];
	
	public function __construct(string $templatePath)
	{
		$this->templatePath = $templatePath;
	}
	
	public function sanitize($value)
	{
		return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
	}
	
	public function addGlobal(string $key, $value)
	{
		$this->data[ $key ] = $value;
	}
	
	public function get(string $key, $default = false)
	{
		$result = isset($this->data[ $key ]) ? $this->data[ $key ] : $default;
		
		return $result;
	}
	
	public function show(string $templateName, ?array $data = null)
	{
		$templateFile = "{$this->templatePath}/{$templateName}.php";
		
		if(!file_exists($templateFile)) {
			throw new Exception("Tempalte file '{$templateFile}' not found!");
		}
		
		if($data) {
			$this->data = array_merge($this->data, $data);
		}
		
		include $templateFile;
	}
	
}

<?php
namespace Core;
use Exception;

class Config
{
	protected $filePattern   = '%s/config/%s.php';
	protected $dir           = '';
	protected $loadedConfig  = [];
	
	public function __construct(string $dir = '', ?string $filePattern = null)
	{
		$this->dir             = $dir;
		
		if($filePattern) {
			$this->filePattern = $filePattern;
		}
	}
	
	public function get(string $key, $default = null)
	{
		$keys                  = explode(':', $key, 2);
		
		if(count($keys) !== 2) {
			throw new Exception('Config key error!');
		}
		
		list($fileKey, $arrayKey) = $keys;
		
		$configFile            = sprintf($this->filePattern, $this->dir, $fileKey);
		
		if(!isset($this->loadedConfig[ $fileKey ])) {
			if(!file_exists($configFile)) {
				throw new Exception("Config file '{$configFile}' not found!");
			}
			
			$this->loadedConfig[ $fileKey ] = require_once $configFile;
		}
		
		if(isset($this->loadedConfig[ $fileKey ][ $arrayKey ])) {
			return $this->loadedConfig[ $fileKey ][ $arrayKey ];
		}
		
		return $default;
	}
	
}

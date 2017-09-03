<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 8/28/2017
 * Time: 5:53 PM
 */

namespace pocketbungee;


use pocketbungee\commands\Commands;
use pocketbungee\tools\Logger;

/**
 * Class Bungee
 * @package pocketbungee
 */
class Bungee {

	public $logger;
	private $path;
	public $settings;
	public $commandSystem;
	public $loader;
	public $host;
	public $defaultServer;
	public static $instance;
    
    /**
     * Bungee constructor.
     * @param $path
     * @param $loader
     */
	public function __construct($path, $loader){
		$this->path = $path;
		$this->loader = $loader;
		self::$instance = $this;
		$this->int();
	}

	/**
	 * @return Bungee
	 */
	public static function getInstance() : Bungee{
		return self::$instance;
	}

	public function int(){
		$this->logger = new Logger();
		$this->commandSystem = new Commands($this);

		$file = file_get_contents($this->getDataFolder() . "config.json");
		$this->settings = json_decode($file, true);

		$default = null;
		foreach($this->getSettings()['Servers'] as $name => $value){
			if($value['isDefault']){
				$this->defaultServer = $name;
				$default = $name;
				break;
			}
		}
		if($default == null){
			$this->getLogger()->critical("We didn't detect a Default server. PocketBungee may not work as expected.");
		}
		$this->host = $this->getSettings()['Host'];

	}

	/**
	 * @return Logger
	 */
	public function getLogger() : Logger{
		return $this->logger;
	}

	/**
	 * @return Commands
	 */
	public function getCommandSystem() : Commands{
		return $this->commandSystem;
	}

	public function getDataFolder(){
		return $this->path;
	}

	/**
	 * @param $name
	 * @return bool|string
	 */
	public function getResource($name){
		return file_get_contents(\pocketbungee\DATA . "src" . DIRECTORY_SEPARATOR . "pocketbungee" . DIRECTORY_SEPARATOR . "resources" . DIRECTORY_SEPARATOR . $name);
	}

	public function getLoader(){
		return $this->logger;
	}

	public function getHost(){
		return $this->host;
	}

	public function reload(){
		$file = file_get_contents($this->getDataFolder() . "config.json");
		$this->settings = json_decode($file, true);
	}

	public function getSettings(){
		return $this->settings;
	}

	/**
	 * @return bool|int|string
	 */
	public function getDefaultServer() : string{

		return $this->defaultServer;
	}
}
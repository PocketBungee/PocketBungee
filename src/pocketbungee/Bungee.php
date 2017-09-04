<?php
declare(strict_types=1);

namespace pocketbungee;


use pocketbungee\commands\Commands;
use pocketbungee\tools\Console;
use pocketbungee\tools\Logger;

class Bungee {

	//TODO: Actually fix this.
	public $hasStarted = false;
	/** @var Bungee */
	private static $instance;
	/** @var Logger */
	private $logger;
	/** @var string */
	private $dataFolder;
	/** @var array */
	private $settings;
	/** @var Commands */
	private $commandSystem;
	/** @var string */
	private $loader;
	/** @var string */
	private $host;
	/** @var string */
	private $defaultServer;

	/**
	 * Bungee constructor.
	 *
	 * @param string $dataFolder
	 * @param        $loader
	 */
	public function __construct(string $dataFolder, $loader){
		$this->dataFolder = $dataFolder;
		$this->loader = $loader;
		self::$instance = $this;
		$this->int();
	}

	public function int(){
		$this->logger = new Logger();
		if($this->hasStarted === true){
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
	}

	/**
	 * Stores the path to PocketBungee
	 *
	 * @return string
	 */
	public function getDataFolder() : string{
		return $this->dataFolder;
	}

	/**
	 * Stores the proxy settings
	 *
	 * @return array
	 */
	public function getSettings() : array{
		return $this->settings;
	}

	/**
	 * Stores the Logger class instance
	 *
	 * @return Logger
	 */
	public function getLogger() : Logger{
		return $this->logger;
	}

	/**
	 * Bungee self instance
	 *
	 * @return Bungee
	 */
	public static function getInstance() : Bungee{
		return self::$instance;
	}

	/**
	 * Stores the CommandSystem class instnace
	 *
	 * @return Commands
	 */
	public function getCommandSystem() : Commands{
		return $this->commandSystem;
	}

	/**
	 * @param string $name
	 *
	 * @return bool|string
	 */
	public function getResource(string $name){
		return file_get_contents(\pocketbungee\DATA . "src" . DIRECTORY_SEPARATOR . "pocketbungee" . DIRECTORY_SEPARATOR . "resources" . DIRECTORY_SEPARATOR . $name);
	}

	/**
	 * The host ip from config.json
	 *
	 * @return string
	 */
	public function getHost() : string{
		return $this->host;
	}

	public function reload(){
		$file = file_get_contents($this->getDataFolder() . "config.json");
		$this->settings = json_decode($file, true);
	}

	/**
	 * The default proxy server
	 *
	 * @return string
	 */
	public function getDefaultServer() : string{
		return $this->defaultServer;
	}
}

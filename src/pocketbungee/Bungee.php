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

class Bungee {

	public $logger;
	private $path;
	public $commandSystem;

	public function __construct($path){
		$this->path = $path;
		$this->int();
	}

	public function int(){
		$this->logger = new Logger();
		$this->commandSystem = new Commands($this);
	}

	public function getLogger() : Logger{
		return $this->logger;
	}

	public function getCommandSystem() : Commands{
		return $this->commandSystem;
	}

	public function getDataFolder() {
		return $this->path;
	}

	public function getResource($name){
		return file_get_contents(\pocketbungee\DATA."src" . DIRECTORY_SEPARATOR . "pocketbungee" . DIRECTORY_SEPARATOR . "resources".DIRECTORY_SEPARATOR. $name);
	}
}
<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 8/28/2017
 * Time: 5:14 PM
 */

namespace pocketbungee\commands;


use pocketbungee\Bungee;
use pocketbungee\tools\Logger;
use pocketbungee\tools\TextFormat;

/**
 * Class Commands
 * @package pocketbungee\commands
 */
class Commands {

	/** Stores Bungee class instance */
	public $bungee;
	/** Contains a list of registered commands */
	public $commands = [];

	/**
	 * Commands constructor.
	 * @param Bungee $bungee
	 */
	public function __construct(Bungee $bungee){
		$this->bungee = $bungee;;
		$this->int();
	}

	public function int(){
		$deject = json_decode($this->bungee->getResource("commands.json"), true);

		foreach($deject as $name){
			$this->commands[$name] = $name;
		}
	}

	/**
	 * @param $command
	 */
	public function handle($command){

		switch($command){

			case 'exit':
				exit;
				break;

			case "help":
			case "?":

			$list = "";
			$d = 0;
			foreach($this->getCommands() as $name){
				$list .= $name . ",";
			}
			$list = substr($list, 0, -1);

				$this->bungee->getLogger()->info("List of commands: ".$list);
				break;

			case "servers":

				$list = "";
				$d = 0;
				foreach($this->bungee->getSettings()['Servers'] as $name => $data){
					$list .= $name . ",";
				}
				$list = substr($list, 0, -1);
				$this->bungee->getLogger()->info("List of servers: ".$list);
				break;

			case "reload":
				$this->bungee->reload();
				$this->bungee->getLogger()->info("All configurations has been reloaded!");
				break;

			case "ping":
				$this->bungee->getLogger()->info("PONG!");
				break;
		}
	}

	/**
	 * @param $command
	 * @return bool
	 */
	public  function commandExist($command){

		if(in_array($command, $this->commands)){
			return true;
		} else {
			return false;
		}
	}

	/**
	 * @return array
	 */
	public function getCommands(){

		return $this->commands;
	}

	/**
	 * @param $command
	 */
	public function unRegisterCommand($command){

		if(isset($this->commands[$command])){
			unset($this->commands[$command]);
		} else {
			$this->bungee->getLogger()->critical("Error while trying to unregistered a command that does not exist \ . Command: ".$command);
		}
	}
}
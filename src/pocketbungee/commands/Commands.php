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

class Commands {

	public $bungee;

	public function __construct(Bungee $bungee){
		$this->bungee = $bungee;;
	}

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
				$file = file_get_contents(\pocketbungee\PATH . "config.json");
				$deject = json_decode($file, JSON_PRETTY_PRINT);

				$list = "";
				$d = 0;
				foreach($deject['Servers'] as $name => $data){
					$list .= $name . ",";
				}
				$list = substr($list, 0, -1);
				$this->bungee->getLogger()->info("List of servers: ".$list);
				break;

			case "reload":
				$this->bungee->getLogger()->info("All configurations has been reloaded!");
				break;
		}
	}

	public  function commandExist($command){

		if(in_array($command, ['help','?','servers','exit','reload'])){
			return true;
		} else {
			return false;
		}
	}

	public function getCommands(){

		return ['help','?','servers','exit','reload'];
	}
}
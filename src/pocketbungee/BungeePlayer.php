<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 8/29/2017
 * Time: 3:59 PM
 */

namespace pocketbungee;


class BungeePlayer {

	const DEFAULT_SERVER = "__DEFAULT__";

	public $bungee;
	public $server;
	public $ip;
	public $port;
	public $username;

	public function __construct(Bungee $bungee, $server = "__DEFAULT__", $ip, $port, $username){
		$this->bungee = $bungee;
		$this->server = $server;
		$this->ip = $ip;
		$this->port = $port;
		$this->username = $username;
	}

	public function getName() : string{
		return $this->username;
	}

	public function getAddress(){
		return $this->ip;
	}

	public function getPort(){
		return $this->port;
	}

	public function getServer(){
		if($this->server == self::DEFAULT_SERVER){
			return $this->bungee->getDefaultServer();
		}else{
			return $this->server;
		}
	}

	public function transfer($server) : bool{
		// Use this to send player to another server.
		return true;
	}

	public function sendMessage($message){
		// Use this to send a player a message, that are connected within PocketBungee
	}
}
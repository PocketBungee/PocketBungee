<?php
declare(strict_types=1);

namespace pocketbungee;

class BungeePlayer {

	const DEFAULT_SERVER = "__DEFAULT__";

	/** @var Bungee */
	public $bungee;
	/** @var string */
	public $server;
	/** @var int */
	public $ip;
	/** @var int */
	public $port;
	/** @var string */
	public $username;

	/**
	 * BungeePlayer constructor.
	 *
	 * @param Bungee $bungee
	 * @param string $server
	 * @param        $ip
	 * @param        $port
	 * @param        $username
	 */
	public function __construct(Bungee $bungee, string $server = BungeePlayer::DEFAULT_SERVER, int $ip, int $port, string $username){
		$this->bungee = $bungee;
		$this->server = $server;
		$this->ip = $ip;
		$this->port = $port;
		$this->username = $username;
	}

	/**
	 * @return string
	 */
	public function getName() : string{
		return $this->username;
	}

	/**
	 * The player's IP address
	 *
	 * @return int
	 */
	public function getAddress() : int{
		return $this->ip;
	}

	/**
	 * @return int
	 */
	public function getPort() : int{
		return $this->port;
	}

	/**
	 * @return string
	 */
	public function getServer() : string{
		if($this->server == self::DEFAULT_SERVER){
			return $this->bungee->getDefaultServer();
		}else{
			return $this->server;
		}
	}

	/**
	 * @param $server
	 *
	 * @return bool
	 */
	public function transfer($server) : bool{
		// Use this to send player to another server.
		return true;
	}

	/**
	 * @param $message
	 */
	public function sendMessage($message){
		// Use this to send a player a message, that are connected within PocketBungee
	}
}
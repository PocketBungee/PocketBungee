<?php
declare(strict_types=1);

namespace pocketbungee\tools;

use pocketbungee\Bungee;
use pocketbungee\network\Version;

class Console {

	public $pre;
	private $bungee;
	private $load;

	/**
	 * Console constructor.
	 *
	 * @param Bungee $bungee
	 */
	public function __construct(Bungee $bungee){
		$this->bungee = $bungee;
		$this->showConsole();
	}

	public function showConsole(){
		$this->load = microtime(true);

		if(!file_exists($this->bungee->getDataFolder() . "config.json")){
			$this->bungee->getLogger()->info("Setting up " . TextFormat::AQUA . "PocketBungee" . TextFormat::YELLOW . " for the first time..");
			$this->firstUse();
		}else{
			$this->ready();
		}

		$this->bungee->hasStarted = true;
	}

	public function firstUse(){
		file_put_contents(\pocketbungee\PATH . "config.json", json_encode(json_decode($this->bungee->getResource("config.json"), true), JSON_PRETTY_PRINT));
		$this->bungee->getLogger()->info("All done!");
		$this->ready();
	}

	public function ready(){
		$date = date("D, F d, Y, H:i T");
		$file = file_get_contents(\pocketbungee\PATH . "config.json");
		$deject = json_decode($file, true);
		$servers = count($deject['Servers']);
		$version = [];
		$version['VERSION'] = Version::VERSION;;
		$version['CODENAME'] = Version::CODENAME;
		$load = (microtime(true) - $this->load);

		$this->bungee->getLogger()->clean("
§6┌─────────────────────────────────────────────────────────────────────────┐
§6│		                                                                  
§6│		                                                                  
§6│§e   _____           _        _   ____                                     Listening on: §b{$deject['Host']}
§6│§e  |  __ \         | |      | | |  _ \                                    Registered Server(s): §b{$servers}
§6│§e  | |__) |__   ___| | _____| |_| |_) |_   _ _ __   __ _  ___  ___        MOTD: §b{$deject['MOTD']}
§6│§e  |  ___/ _ \ / __| |/ / _ \ __|  _ <| | | | '_ \ / _` |/ _ \/ _ \       Version: §b{$version['VERSION']}
§6│§e  | |  | (_) | (__|   <  __/ |_| |_) | |_| | | | | (_| |  __/  __/       Code Name: §b{$version['CODENAME']}
§6│§e  |_|   \___/ \___|_|\_\___|\__|____/ \__,_|_| |_|\__, |\___|\___|       Date: §b{$date}
§6│§e		                                      __/ |  │            GitHub: §bhttps://github.com/PocketBungee/PocketBungee
§6│§e		                                      |_____/             Loaded in: §b{$load}'s seconds!
§6│§e
§6└─────────────────────────────────────────────────────────────────────────┘");


		while(true){
			$command = trim(fgets(STDIN));

			if(!$this->bungee->getCommandSystem()->commandExist($command)){
				$this->bungee->getLogger()->info("Such command '{$command}' does not exist! '?' or 'help' for list of commands!");
			}else{
				$this->bungee->getCommandSystem()->handle($command);
			}
		}
	}
}

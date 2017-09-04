<?php
declare(strict_types=1);

namespace pocketbungee {


	use pocketbungee\tools\Console;
	use pocketbungee\tools\TextFormat;

	basicCheck();
	TextFormat::init();

	$autoloader = new \BaseClassLoader();
	$autoloader->addPath(\pocketbungee\PATH . "src");
	$autoloader->addPath(\pocketbungee\PATH . "src" . DIRECTORY_SEPARATOR . "spl");
	$autoloader->register(true);

	$bb = new Bungee(\pocketbungee\PATH, $autoloader);
	$console = new Console($bb);
	$console->showConsole();

	function basicCheck(){

		if(version_compare("7.0", PHP_VERSION) > 0 or version_compare("7.1", PHP_VERSION) <= 0){
			echo TextFormat::CRITICAL . "PocketBungee only supports PHP version 7.0";
			exit();
		}

		if(!extension_loaded("pthreads")){ //TODO: revert hack
			echo TextFormat::CRITICAL . "PocketBungee requires pthreads to be installed";
			exit();
		}

		$opts = getopt("", ["data:", "plugins:", "no-wizard", "enable-profiler"]);
		define('pocketbungee\DATA', isset($opts["data"]) ? $opts["data"] . DIRECTORY_SEPARATOR : \getcwd() . DIRECTORY_SEPARATOR);

		if(\Phar::running(true) !== ""){
			define('pocketbungee\PATH', \Phar::running(true) . "/");
		}else{
			define('pocketbungee\PATH', realpath(getcwd()) . DIRECTORY_SEPARATOR);
		}


		require_once(\pocketbungee\PATH . "src/spl/ClassLoader.php");
		require_once(\pocketbungee\PATH . "src/spl/BaseClassLoader.php");

		$autoloader = new \BaseClassLoader();
		$autoloader->addPath(\pocketbungee\PATH . "src");
		$autoloader->addPath(\pocketbungee\PATH . "src" . DIRECTORY_SEPARATOR . "spl");
		$autoloader->register(true);
	}
}

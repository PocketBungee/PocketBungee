<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 8/27/2017
 * Time: 8:08 PM
 */

namespace pocketbungee {


	use pocketbungee\tools\Console;
	use pocketbungee\tools\Logger;
	use pocketbungee\tools\TextFormat;
	use raklib\RakLib;


	basicCheck();
	TextFormat::init();
	$bb = new Bungee(\pocketbungee\PATH);
	$console = new Console($bb);
	$console->showConsole();

	function basicCheck(){

		if(version_compare("7.0", PHP_VERSION) > 0){
			echo TextFormat::CRITICAL . "pocketbungee only supports PHP version 7.0 and higher";
			exit();
		}
		if(!extension_loaded("pthreads")){ //todo: revert hack
			echo TextFormat::CRITICAL . "pocketbungee requires pthreads to be installed";
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
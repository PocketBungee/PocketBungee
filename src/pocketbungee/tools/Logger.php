<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 8/28/2017
 * Time: 4:54 PM
 */

namespace pocketbungee\tools;


/**
 * Class Logger
 * @package pocketbungee\tools
 */
class Logger {

	/**
	 * @param $value
	 */
	public function info($value){

		$edit = TextFormat::YELLOW . "[INFO] " . TextFormat::RESET . TextFormat::toANSI($value) . PHP_EOL;
		echo PHP_EOL . TextFormat::toANSI($edit);
		self::default();
	}

	/**
	 * @param $value
	 */
	public function emergency($value){

		$edit = TextFormat::YELLOW . "[INFO] " . TextFormat::RESET . TextFormat::toANSI($value) . PHP_EOL;
		echo PHP_EOL . TextFormat::toANSI($edit);
		self::default();
	}

	/**
	 * @param $value
	 */
	public function alert($value){

		$edit = TextFormat::YELLOW . "[INFO] " . TextFormat::RESET . TextFormat::toANSI($value) . PHP_EOL;
		echo PHP_EOL . TextFormat::toANSI($edit);
		self::default();
	}

	/**
	 * @param $value
	 */
	public function critical($value){

		$edit = TextFormat::YELLOW . "[INFO] " . TextFormat::RESET . TextFormat::toANSI($value) . PHP_EOL;
		echo PHP_EOL . TextFormat::toANSI($edit);
		self::default();
	}

	/**
	 * @param $value
	 */
	public function error($value){

		$edit = TextFormat::YELLOW . "[INFO] " . TextFormat::RESET . TextFormat::toANSI($value) . PHP_EOL;
		echo PHP_EOL . TextFormat::toANSI($edit);
		self::default();
	}

	/**
	 * @param $value
	 */
	public function warning($value){

		$edit = TextFormat::YELLOW . "[INFO] " . TextFormat::RESET . TextFormat::toANSI($value) . PHP_EOL;
		echo PHP_EOL . TextFormat::toANSI($edit);
		self::default();
	}

	/**
	 * @param $value
	 */
	public function notice($value){

		$edit = TextFormat::YELLOW . "[INFO] " . TextFormat::RESET . TextFormat::toANSI($value) . PHP_EOL;
		echo PHP_EOL . TextFormat::toANSI($edit);
		self::default();
	}

	/**
	 * @param $value
	 */
	public function debug($value){

		$edit = TextFormat::YELLOW . "[INFO] " . TextFormat::RESET . TextFormat::toANSI($value) . PHP_EOL;
		echo PHP_EOL . TextFormat::toANSI($edit);
		self::default();
	}

	/**
	 * @param $value
	 */
	public function log($value){

		$edit = TextFormat::YELLOW . "[INFO] " . TextFormat::RESET . TextFormat::toANSI($value) . PHP_EOL;
		echo PHP_EOL . TextFormat::toANSI($edit);
		self::default();
	}

	public static function default(){
		echo PHP_EOL . TextFormat::toANSI(TextFormat::RED . "PocketBungee> " . TextFormat::BLUE);
	}


	/**
	 * @param $value
	 */
	public function clean($value){

		echo PHP_EOL . TextFormat::toANSI($value) . PHP_EOL;
		self::default();
	}
}
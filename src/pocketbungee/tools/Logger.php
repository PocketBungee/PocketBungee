<?php
declare(strict_types=1);

namespace pocketbungee\tools;

class Logger {

	/**
	 * @param $value
	 */
	public function info(string $value){

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
	public function emergency(string $value){

		$edit = TextFormat::YELLOW . "[INFO] " . TextFormat::RESET . TextFormat::toANSI($value) . PHP_EOL;
		echo PHP_EOL . TextFormat::toANSI($edit);
		self::default();
	}

	/**
	 * @param $value
	 */
	public function alert(string $value){

		$edit = TextFormat::YELLOW . "[INFO] " . TextFormat::RESET . TextFormat::toANSI($value) . PHP_EOL;
		echo PHP_EOL . TextFormat::toANSI($edit);
		self::default();
	}

	/**
	 * @param $value
	 */
	public function critical(string $value){

		$edit = TextFormat::YELLOW . "[INFO] " . TextFormat::RESET . TextFormat::toANSI($value) . PHP_EOL;
		echo PHP_EOL . TextFormat::toANSI($edit);
		self::default();
	}

	/**
	 * @param $value
	 */
	public function error(string $value){

		$edit = TextFormat::YELLOW . "[INFO] " . TextFormat::RESET . TextFormat::toANSI($value) . PHP_EOL;
		echo PHP_EOL . TextFormat::toANSI($edit);
		self::default();
	}

	/**
	 * @param $value
	 */
	public function warning(string $value){

		$edit = TextFormat::YELLOW . "[INFO] " . TextFormat::RESET . TextFormat::toANSI($value) . PHP_EOL;
		echo PHP_EOL . TextFormat::toANSI($edit);
		self::default();
	}

	/**
	 * @param $value
	 */
	public function notice(string $value){

		$edit = TextFormat::YELLOW . "[INFO] " . TextFormat::RESET . TextFormat::toANSI($value) . PHP_EOL;
		echo PHP_EOL . TextFormat::toANSI($edit);
		self::default();
	}

	/**
	 * @param $value
	 */
	public function debug(string $value){

		$edit = TextFormat::YELLOW . "[INFO] " . TextFormat::RESET . TextFormat::toANSI($value) . PHP_EOL;
		echo PHP_EOL . TextFormat::toANSI($edit);
		self::default();
	}

	/**
	 * @param $value
	 */
	public function log(string $value){

		$edit = TextFormat::YELLOW . "[INFO] " . TextFormat::RESET . TextFormat::toANSI($value) . PHP_EOL;
		echo PHP_EOL . TextFormat::toANSI($edit);
		self::default();
	}

	/**
	 * @param $value
	 */
	public function clean(string $value){

		echo PHP_EOL . TextFormat::toANSI($value) . PHP_EOL;
		self::default();
	}
}
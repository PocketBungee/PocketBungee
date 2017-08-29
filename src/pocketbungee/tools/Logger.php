<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 8/28/2017
 * Time: 4:54 PM
 */

namespace pocketbungee\tools;


class Logger {

	public function info($value){

		$edit = TextFormat::YELLOW . "[INFO] " . TextFormat::RESET . TextFormat::toANSI($value) . PHP_EOL;
		echo TextFormat::toANSI($edit);
		self::default();
	}

	public function clean($value){

		echo TextFormat::toANSI($value) . PHP_EOL;
		self::default();
	}

	public static function default(){
		echo PHP_EOL;
		echo TextFormat::toANSI(TextFormat::RED. "PocketBungee> " . TextFormat::BLUE);
	}
}
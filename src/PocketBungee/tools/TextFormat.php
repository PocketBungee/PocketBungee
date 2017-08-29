<?php

namespace pocketbungee\tools;


/**
 * Class TextFormat
 * @package pocketbungee\tools
 */
class TextFormat {

	const ESCAPE = "\xc2\xa7";

	const INFO = "[".\LogLevel::INFO."]";
	const ALERT = "[".\LogLevel::ALERT."]";
	const ERROR = "[".\LogLevel::ERROR."]";
	const CRITICAL = "[".\LogLevel::CRITICAL."]";
	const DEBUG = "[".\LogLevel::DEBUG."]";
	const EMERGENCY = "[".\LogLevel::EMERGENCY."]";
	const NOTICE = "[".\LogLevel::NOTICE."]";
	const WARNING = "[".\LogLevel::WARNING."]";
	const BLACK = TextFormat::ESCAPE . "0";
	const DARK_BLUE = TextFormat::ESCAPE . "1";
	const DARK_GREEN = TextFormat::ESCAPE . "2";
	const DARK_AQUA = TextFormat::ESCAPE . "3";
	const DARK_RED = TextFormat::ESCAPE . "4";
	const DARK_PURPLE = TextFormat::ESCAPE . "5";
	const GOLD = TextFormat::ESCAPE . "6";
	const GRAY = TextFormat::ESCAPE . "7";
	const DARK_GRAY = TextFormat::ESCAPE . "8";
	const BLUE = TextFormat::ESCAPE . "9";
	const GREEN = TextFormat::ESCAPE . "a";
	const AQUA = TextFormat::ESCAPE . "b";
	const RED = TextFormat::ESCAPE . "c";
	const LIGHT_PURPLE = TextFormat::ESCAPE . "d";
	const YELLOW = TextFormat::ESCAPE . "e";
	const WHITE = TextFormat::ESCAPE . "f";
	const OBFUSCATED = TextFormat::ESCAPE . "k";
	const BOLD = TextFormat::ESCAPE . "l";
	const STRIKETHROUGH = TextFormat::ESCAPE . "m";
	const UNDERLINE = TextFormat::ESCAPE . "n";
	const ITALIC = TextFormat::ESCAPE . "o";
	const RESET = TextFormat::ESCAPE . "r";

	/*
	 * Terminal related
	 */

	public static $FORMAT_BOLD = "";
	public static $FORMAT_OBFUSCATED = "";
	public static $FORMAT_ITALIC = "";
	public static $FORMAT_UNDERLINE = "";
	public static $FORMAT_STRIKETHROUGH = "";
	public static $FORMAT_RESET = "";
	public static $COLOR_BLACK = "";
	public static $COLOR_DARK_BLUE = "";
	public static $COLOR_DARK_GREEN = "";
	public static $COLOR_DARK_AQUA = "";
	public static $COLOR_DARK_RED = "";
	public static $COLOR_PURPLE = "";
	public static $COLOR_GOLD = "";
	public static $COLOR_GRAY = "";
	public static $COLOR_DARK_GRAY = "";
	public static $COLOR_BLUE = "";
	public static $COLOR_GREEN = "";
	public static $COLOR_AQUA = "";
	public static $COLOR_RED = "";
	public static $COLOR_LIGHT_PURPLE = "";
	public static $COLOR_YELLOW = "";
	public static $COLOR_WHITE = "";
	private static $formattingCodes = null;

	/**
	 * @param string $string
	 * @return array
	 */
	public static function tokenize(string $string) : array{
		return preg_split("/(" . TextFormat::ESCAPE . "[0123456789abcdefklmnor])/", $string, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
	}

	/**
	 * @return bool|null
	 */
	public static function hasFormattingCodes(){
		if(self::$formattingCodes === null){
			$opts = getopt("", ["enable-ansi", "disable-ansi"]);
			if(isset($opts["disable-ansi"])){
				self::$formattingCodes = false;
			}else{
				self::$formattingCodes = ((Utils::getOS() !== "win" and getenv("TERM") != "" and (!function_exists("posix_ttyname") or !defined("STDOUT") or posix_ttyname(STDOUT) !== false)) or isset($opts["enable-ansi"]));
			}
		}
		return self::$formattingCodes;
	}

	/**
	 * @param $string
	 * @return string
	 */
	public static function toANSI($string) : string{
		if(!is_array($string)){
			$string = self::tokenize($string);
		}
		$newString = "";
		foreach($string as $token){
			switch($token){
				case TextFormat::BOLD:
					$newString .= self::$FORMAT_BOLD;
					break;
				case TextFormat::OBFUSCATED:
					$newString .= self::$FORMAT_OBFUSCATED;
					break;
				case TextFormat::ITALIC:
					$newString .= self::$FORMAT_ITALIC;
					break;
				case TextFormat::UNDERLINE:
					$newString .= self::$FORMAT_UNDERLINE;
					break;
				case TextFormat::STRIKETHROUGH:
					$newString .= self::$FORMAT_STRIKETHROUGH;
					break;
				case TextFormat::RESET:
					$newString .= self::$FORMAT_RESET;
					break;
				//Colors
				case TextFormat::BLACK:
					$newString .= self::$COLOR_BLACK;
					break;
				case TextFormat::DARK_BLUE:
					$newString .= self::$COLOR_DARK_BLUE;
					break;
				case TextFormat::DARK_GREEN:
					$newString .= self::$COLOR_DARK_GREEN;
					break;
				case TextFormat::DARK_AQUA:
					$newString .= self::$COLOR_DARK_AQUA;
					break;
				case TextFormat::DARK_RED:
					$newString .= self::$COLOR_DARK_RED;
					break;
				case TextFormat::DARK_PURPLE:
					$newString .= self::$COLOR_PURPLE;
					break;
				case TextFormat::GOLD:
					$newString .= self::$COLOR_GOLD;
					break;
				case TextFormat::GRAY:
					$newString .= self::$COLOR_GRAY;
					break;
				case TextFormat::DARK_GRAY:
					$newString .= self::$COLOR_DARK_GRAY;
					break;
				case TextFormat::BLUE:
					$newString .= self::$COLOR_BLUE;
					break;
				case TextFormat::GREEN:
					$newString .= self::$COLOR_GREEN;
					break;
				case TextFormat::AQUA:
					$newString .= self::$COLOR_AQUA;
					break;
				case TextFormat::RED:
					$newString .= self::$COLOR_RED;
					break;
				case TextFormat::LIGHT_PURPLE:
					$newString .= self::$COLOR_LIGHT_PURPLE;
					break;
				case TextFormat::YELLOW:
					$newString .= self::$COLOR_YELLOW;
					break;
				case TextFormat::WHITE:
					$newString .= self::$COLOR_WHITE;
					break;
				default:
					$newString .= $token;
					break;
			}
		}
		return $newString;
	}

	protected static function getFallbackEscapeCodes(){
		self::$FORMAT_BOLD = "\x1b[1m";
		self::$FORMAT_OBFUSCATED = "";
		self::$FORMAT_ITALIC = "\x1b[3m";
		self::$FORMAT_UNDERLINE = "\x1b[4m";
		self::$FORMAT_STRIKETHROUGH = "\x1b[9m";
		self::$FORMAT_RESET = "\x1b[m";
		self::$COLOR_BLACK = "\x1b[38;5;16m";
		self::$COLOR_DARK_BLUE = "\x1b[38;5;19m";
		self::$COLOR_DARK_GREEN = "\x1b[38;5;34m";
		self::$COLOR_DARK_AQUA = "\x1b[38;5;37m";
		self::$COLOR_DARK_RED = "\x1b[38;5;124m";
		self::$COLOR_PURPLE = "\x1b[38;5;127m";
		self::$COLOR_GOLD = "\x1b[38;5;214m";
		self::$COLOR_GRAY = "\x1b[38;5;145m";
		self::$COLOR_DARK_GRAY = "\x1b[38;5;59m";
		self::$COLOR_BLUE = "\x1b[38;5;63m";
		self::$COLOR_GREEN = "\x1b[38;5;83m";
		self::$COLOR_AQUA = "\x1b[38;5;87m";
		self::$COLOR_RED = "\x1b[38;5;203m";
		self::$COLOR_LIGHT_PURPLE = "\x1b[38;5;207m";
		self::$COLOR_YELLOW = "\x1b[38;5;227m";
		self::$COLOR_WHITE = "\x1b[38;5;231m";
	}
	protected static function getEscapeCodes(){
		self::$FORMAT_BOLD = `tput bold`;
		self::$FORMAT_OBFUSCATED = `tput smacs`;
		self::$FORMAT_ITALIC = `tput sitm`;
		self::$FORMAT_UNDERLINE = `tput smul`;
		self::$FORMAT_STRIKETHROUGH = "\x1b[9m"; //`tput `;
		self::$FORMAT_RESET = `tput sgr0`;
		$colors = (int) `tput colors`;
		if($colors > 8){
			self::$COLOR_BLACK = $colors >= 256 ? `tput setaf 16` : `tput setaf 0`;
			self::$COLOR_DARK_BLUE = $colors >= 256 ? `tput setaf 19` : `tput setaf 4`;
			self::$COLOR_DARK_GREEN = $colors >= 256 ? `tput setaf 34` : `tput setaf 2`;
			self::$COLOR_DARK_AQUA = $colors >= 256 ? `tput setaf 37` : `tput setaf 6`;
			self::$COLOR_DARK_RED = $colors >= 256 ? `tput setaf 124` : `tput setaf 1`;
			self::$COLOR_PURPLE = $colors >= 256 ? `tput setaf 127` : `tput setaf 5`;
			self::$COLOR_GOLD = $colors >= 256 ? `tput setaf 214` : `tput setaf 3`;
			self::$COLOR_GRAY = $colors >= 256 ? `tput setaf 145` : `tput setaf 7`;
			self::$COLOR_DARK_GRAY = $colors >= 256 ? `tput setaf 59` : `tput setaf 8`;
			self::$COLOR_BLUE = $colors >= 256 ? `tput setaf 63` : `tput setaf 12`;
			self::$COLOR_GREEN = $colors >= 256 ? `tput setaf 83` : `tput setaf 10`;
			self::$COLOR_AQUA = $colors >= 256 ? `tput setaf 87` : `tput setaf 14`;
			self::$COLOR_RED = $colors >= 256 ? `tput setaf 203` : `tput setaf 9`;
			self::$COLOR_LIGHT_PURPLE = $colors >= 256 ? `tput setaf 207` : `tput setaf 13`;
			self::$COLOR_YELLOW = $colors >= 256 ? `tput setaf 227` : `tput setaf 11`;
			self::$COLOR_WHITE = $colors >= 256 ? `tput setaf 231` : `tput setaf 15`;
		}else{
			self::$COLOR_BLACK = self::$COLOR_DARK_GRAY = `tput setaf 0`;
			self::$COLOR_RED = self::$COLOR_DARK_RED = `tput setaf 1`;
			self::$COLOR_GREEN = self::$COLOR_DARK_GREEN = `tput setaf 2`;
			self::$COLOR_YELLOW = self::$COLOR_GOLD = `tput setaf 3`;
			self::$COLOR_BLUE = self::$COLOR_DARK_BLUE = `tput setaf 4`;
			self::$COLOR_LIGHT_PURPLE = self::$COLOR_PURPLE = `tput setaf 5`;
			self::$COLOR_AQUA = self::$COLOR_DARK_AQUA = `tput setaf 6`;
			self::$COLOR_GRAY = self::$COLOR_WHITE = `tput setaf 7`;
		}
	}

	public static function init(){
		if(!self::hasFormattingCodes()){
			return;
		}
		switch(Utils::getOS()){
			case "linux":
			case "mac":
			case "bsd":
				self::getEscapeCodes();
				return;
			case "win":
			case "android":
				self::getFallbackEscapeCodes();
				return;
		}
		//TODO: iOS
	}
}
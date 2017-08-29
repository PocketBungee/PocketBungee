<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 8/28/2017
 * Time: 5:23 PM
 */

namespace pocketbungee\tools;


class Utils {

	public static $os;

	public static function getOS(bool $recalculate = false) : string{
		if(self::$os === null or $recalculate){
			$uname = php_uname("s");
			if(stripos($uname, "Darwin") !== false){
				if(strpos(php_uname("m"), "iP") === 0){
					self::$os = "ios";
				}else{
					self::$os = "mac";
				}
			}elseif(stripos($uname, "Win") !== false or $uname === "Msys"){
				self::$os = "win";
			}elseif(stripos($uname, "Linux") !== false){
				if(@file_exists("/system/build.prop")){
					self::$os = "android";
				}else{
					self::$os = "linux";
				}
			}elseif(stripos($uname, "BSD") !== false or $uname === "DragonFly"){
				self::$os = "bsd";
			}else{
				self::$os = "other";
			}
		}
		return self::$os;
	}
}
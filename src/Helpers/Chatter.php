<?php

class Chatter {
	
	public static function stringToColorCode($str) {
		$code = dechex(crc32($str));
		$code = substr($code, 0, 6);
		return $code;
	}

}
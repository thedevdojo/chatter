<?php

class Chatter {
	
	public static function stringToColorCode($str) {
		$code = dechex(crc32($str));
		$code = substr($code, 0, 6);
		return $code;
	}

	public static function getUserLink($user){
		$relative_url = Config::get('chatter.user.relative_url_to_profile');
		if($relative_url){
			$beginning_del = strpos($relative_url, '{');
			$end_del = strpos($relative_url, '}');
			
			$field = substr($relative_url, $beginning_del, ($end_del+1) - $beginning_del);
			$url_without_field = str_replace($field, '', $relative_url);
			
			$field = str_replace('{', '', str_replace('}', '', $field));
			$field_value = $user->{$field};

			return $url_without_field . $field_value;
		} else {
			return '/#_';
		}
	}

}
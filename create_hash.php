<?php
	function create_hash($len){
		$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
		$hash = "";
		for($i = 0; $i < $len; $i++){
			$hash .= $chars[rand(0, strlen($chars)-1)];
		}
		return $hash;
	}
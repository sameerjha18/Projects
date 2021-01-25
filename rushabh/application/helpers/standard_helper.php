<?php
if(!function_exists('pre')){
	function pre($data){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}
}
if(!function_exists('message')){
	function message($mobile,$msg,$campaign){
	
	$ch = curl_init("http://login.smsatcw.com/api/sendhttp.php?");  
		curl_setopt($ch, CURLOPT_POST, True);
		curl_setopt($ch, CURLOPT_POSTFIELDS,"authkey=324666A97tR8Jjq3rz5e7b4efaP1&mobiles=$mobile&message=$msg&sender=HIRAFM&route=4&country=0&campaign=HIRAGA"); 
		
		curl_setopt($ch, CURLOPT_TIMEOUT,60);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);
		$contents = curl_exec ($ch);
		//var_dump(curl_getinfo($ch));
		curl_close ($ch);
	}
}
?>
<?php 
	
	function createToken(){
		
		$curl = curl_init();
		$url = 'https://api.petfinder.com/v2/oauth2/token';

		$auth_data = array(
			'client_id' => 'nHVlAYbtuuA5fPyERQzUDubsnWA0WZnvq1IIwaGVvKOUnLDqBB',
			'client_secret' => 'cXWIL2kkNo0Z4Z7JUdCbWLayRu3DRRkuq8Jam6uO',
			'grant_type' => 'client_credentials',
		);

		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $auth_data);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		$result = curl_exec($curl);
		if(!$result){die("Connection Failure");}
		curl_close($curl);
		$token = json_decode($result);
		setcookie("API_TOKEN", $token->access_token, time()+3600);
	}

 ?>
<?php
	include "config.php";
	
	/**
	  * Function to get profanity words from the text
	  * 
	  * param $inputtext, $profwords (separated by space)
	  * return void
	  */
	function get_profanity_words($inputtext, $profwords) {
		// clean up the words and return clean words
		$profwords = clean_mystring($profwords);
		$inputtext = clean_mystring($inputtext);
		
		$array_prof = explode("-", strtolower($profwords));
		$temp_array_input = explode("-", strtolower($inputtext));
		$array_result = array();
		
		foreach (array_values($temp_array_input) as $ai) {
			$array_input[$ai] = 1;
		}
		
		foreach ($array_prof as $ap) {
			if (isset($array_input[$ap])) $array_result[] = $ap;
		}
		
		return $array_result;
	}
	
	/**
	  * Function to clean the string 
	  *
	  * param $text to clear
	  * return void
	  */
	function clean_mystring($text) {
		// replace all spaces with hyphens
		$text = str_replace(' ', '-', $text);
		
		// remove special char and number
		$text = preg_replace('/[^A-Za-z\-]/', '', $text);

		// replace multi hyphens with single hyphens
		$result = preg_replace('/-+/', '-', $text);
		
		return $result;
	}
	
	/**
	  * Function to call API with GET method
	  *
	  * param $url, $header
	  * return json
	  */
	function call_api($url, $header=null) {
		$ch = curl_init();  
	 
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		if ($header != null) {
			curl_setopt($ch,CURLOPT_HTTPHEADER, $header); 
		}
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$output=curl_exec($ch);
	 
		curl_close($ch);
		return $output;
	}
	
	/**
	  * Function to get current weather through API
	  *
	  * API openweather
	  * return void
	  */
	function get_weather_from_api($city) {
		$api_key = OPENWEATHERMAP_APIKEY;
		
		$api_url = sprintf("http://api.openweathermap.org/data/2.5/weather?q=%s&APPID=%s", $city, $api_key);
		
		$result = call_api($api_url);
		
		$myresult = json_decode($result);
		
		return $myresult;
	}
	
	/**
	  * Function to get all current exchange rate to USD
	  *
	  * API openexchangerate
	  * updated per hour
	  * return void
	  */
	function get_exchangerate_from_api() {
		$api_key = OPENEXCHANGERATES_APIKEY;
		
		$api_url = sprintf("http://openexchangerates.org/api/latest.json?app_id=%s", $api_key);
		
		$result = call_api($api_url);
		
		$myresult = json_decode($result);
		
		return $myresult;
	}
	
	/**
	  * Function to get all country information
	  * API restcountries
	  * param countrycode
	  * return void
	  */
	function get_country_info_from_countrycode($countrycode) {
		$api_url = sprintf("https://restcountries-v1.p.mashape.com/alpha/%s", $countrycode);
		
		$result = call_api($api_url, array("X-Mashape-Key : " . RESTCOUNTRIES_APIKEY, "Accept : application/json"));
		
		$myresult = json_decode($result);
		
		return $myresult;
			
	}
	
	/**
	  * Function to get photos from flickr
	  *
	  * return void
	  */
	function get_photos_from_flickr() {
		
	}
?>

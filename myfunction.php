<?php
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
?>
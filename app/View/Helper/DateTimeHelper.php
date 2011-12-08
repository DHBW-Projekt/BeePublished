<?php
class DateTimeHelper extends Helper {
    	
    // get time with seconds
	function time_hms($date) {
		return date('H:i:s', strtotime($date));
	}
	
	// get time without seconds
	function time_hm($date) {
		return date('H:i', strtotime($date));
	}
	
	// get German date without time
	function date_de($date) {
		return date('d.m.Y', strtotime($date));
	}
}
?>


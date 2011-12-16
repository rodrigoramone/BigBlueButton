<?php
require_once('Bigbluebutton.php');
class BBB extends Bigbluebutton {
	
	public function __construct(){
		print self::$create_meeting;
	}
	
}

$teste = new BBB;
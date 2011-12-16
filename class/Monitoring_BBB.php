<?php

class Monitoring_BBB extends Bigbluebutton{
	
	/*
	 *  @var string -- the url to get all running meeting's
	 */
	protected static $get_meetings     = '/bigbluebutton/api/getMeetings?';
	
	
	/*
	 * @var string -- the url to see informations about de specified meeting
	 */
	protected static $get_meeting_info = '/bigbluebutton/api/getMeetingInfo?';
	
	
	/*
	 * @var string -- the url to check if the meeting it's running
	 */
	protected static $meeting_running  = '/bigbluebutton/api/isMeetingRunning?';
	
	
	/*
	 * Get all meeting's running
	 *  
	 */
	public function getMeetings(){
	
		$this->params = 'random=' . rand() * 1000; 
		$this->sum    = sha1("getMeetings" . $this->params . $this->salt);
		$this->url    = $this->server . self::$get_meetings . $this->params . "&checksum=" . $this->sum;
		
		return parent::response($this->url);
	
	}
	
	
	/*
	 * Get all info from an especific meeting;
	 * 
	 * @param params array('meetingID' => $meetingID, 'password' => $moderatorPW ) 
	 */
	public function getMeetingInfo($params){
		
		$this->params = http_build_query($params);
		$this->sum = sha1('getMeetingInfo' . $this->params . $this->salt);
		$this->url = $this->server . self::$get_meeting_info . $this->params . "&checksum=" . $this->sum;
		
		return parent::response($this->url);
		
	} 
	
	
	/*
	 * Get status from an especific meeting
	 * 
	 * @param params array('meetingID' => $meetingID);
	 */
	public function isMeetingRunning($params){
		
		$this->params = http_build_query($params);
		$this->sum = sha1("isMeetingRunning" . $this->params . $this->salt);
		$this->url = $this->server . self::$meeting_running . $this->params . "&checksum=" . $this->sum;

		return parent::response($this->url);
	
	}
	
}
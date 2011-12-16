<?php
class Recording_BBB extends Bigbluebutton{
	
	/*
	 * @var string protected 
	 */
	protected static $get_recordings = '/bigbluebutton/api/getRecordings?';
	
	
	/*
	 * @var string protected 
	 * 
	 */
	protected static $publish_recordings = '/bigbluebutton/api/publishRecordings?';
	
	/*
	 * @var string protected 
	 * 
	 */
	protected static $delete_recordings = '/bigbluebutton/api/deleteRecordings?';
	
	
	public function getRecordings($params){
			
		$this->params = http_build_query($params);
		$this->sum = sha1('getRecordings' . $this->params .  $this->salt);
		$this->url = $this->server . self::$get_recordings . $this->params . '&checksum=' . $this->sum;
		
		return parent::response($this->url);
		
	}
	
	public function publishRecordings($params){
	
		$this->params = http_build_query($params);
		$this->sum = sha1('publishRecordings' . $this->params . $this->salt);
		$this->url = $this->server . self::$publish_recordings . $this->params . '&checksum=' . $this->sum;
		
		return parent::response($this->url);
		
	}
	
	public function deleteRecordings($params){
		
		$this->params = http_build_query($params);
		$this->sum   = sha1('deleteRecordings' . $this->params . $this->salt);
		$this->url = $this->server . self::$delete_recordings . $this->params . '&checksum=' . $this->sum;

		return parent::response($this->url);
	}
	
}
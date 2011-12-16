<?php

class Administration_BBB extends Bigbluebutton {
	
	
	/*
	 * @var string  -- the url to create a meeting
	 */
	protected static $create_meeting   = '/bigbluebutton/api/create?';
	
	
	/*
	 * @var string -- the url to join in a meeting
	 */
	protected static $join_meeting     = '/bigbluebutton/api/join?';
	
	
	/*
	 * @var string -- the url to end a meeting
	 */
	protected static $end_meeting      = '/bigbluebutton/api/end?';
    
	
	
	public function createMeeting($params, $file = null){
		
		$this->file = $file;
        $this->url = http_build_query($params);
        $this->sum = sha1('create' . $this->url . $this->salt);
        $this->url = $this->server . self::$create_meeting . $this->url . '&checksum=' . $this->sum;
        
        if(!empty($this->file)){

        	return self::postURL( $this->url, $this->file );
        
        } else {

        	return parent::response( $this->url );
        
        }
		
	}
	
	
	public function joinMeeting($params){
	
		$this->construct = http_build_query($params);
        $this->sum = sha1('join' . $this->construct . $this->salt);
        return $this->url = $this->server . self::$join_meeting . $this->construct . '&checksum=' . $this->sum;
				
	}
	
	
	
	
	public function endMeeting($params){
			
		$this->construct = http_build_query($params);
		$this->sum = sha1('end' . $this->construct . $this->salt);
		$this->url = $this->server . self::$end_meeting . $this->construct . '&checksum=' . $this->sum;
		
		return parent::response($this->url);
		
	}
	
	
	protected function postURL($create_url, $file){
		
		$this->construct = $create_url;
		$this->file 	 = $file;

		$xml  = "<?xml version='1.0' encoding='UTF-8'?>";
		$xml .= "<modules><module name='presentation'>";
		
		foreach($this->file as $files){

			$xml .= "<document url='{$files}'/>";
		
		}
		
		$xml .= "</module></modules>";
		
		
		$this->context = array(
						'http' => array(
							"method"  => "POST",
							"header"  => "Content-type: text/xml"  . "\r\n". 
										 "Content-Language: en-US" . "\r\n" . 
										 "Content-Length: " . strlen($xml) . "\r\n",
								         "content" => $xml . "\r\n\r\n"	
					    			)
						);
	
	   	return file_get_contents($this->construct, false, stream_context_create($this->context));
	
	}

}


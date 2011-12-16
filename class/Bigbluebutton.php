<?php
/*
 * Versions:
 * 1.0 -- Initial version written by Rodrigo
 * (email: rodrigo@rodrigojobs.net)
  */

abstract class Bigbluebutton {
	
	
	/*
	 * @var string -- the host to the bigbluebutton server
	 */
    	protected $server;
    
    
    	/*
     	* @var string -- the security salt to the bigbluebutton server 
     	*/
    	protected $salt;
    
    
    	public function __construct($server, $salt, $tipo = "url"){

		$this->server = $server;
		$this->salt   = $salt;
		$this->tipo   = $tipo;

	}
	
		
	protected function response($url){
		
		if( $this->tipo == "xml" ){
			
			return $this->url = simplexml_load_file($this->url); 
		
		} else {

			return $this->url;			
		
		}
	}
	
}




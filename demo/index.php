<?php

require_once '../class/Bigbluebutton.php';
require_once '../class/Monitoring_BBB.php';
require_once '../class/Administration_BBB.php';
require_once '../class/Recording_BBB.php';


$id              = "TEST";
$salt            = "15af621a351bee350999ec3475ada864";
$server          = "http://10.131.1.200";
$tipo            = "url"; // can be array or url(@default)
$name            = $id;
$meetingID       = $id;
$attendeePW      = $id;
$moderatorPW     = $id;
$welcome         = "Test Api";
$logoutURL       = "http://bigbluebutton.org";
$maxParticipants = "10";
$voiceBridge     = "70001";
$file = array(
		"http://www.apricot.net/apricot2006/slides/tutorial/tuesday/Jonny_Martin-Asterisk.pdf",
		"http://samplepdf.com/sample.pdf"
	     );
$record          = "true";
$duration        = 0;

		print "<pre>";
		print "<h1>Admin Options</h1>";
		print "<h3>Test createMeeting</h3>";
		
		$app = new Administration_BBB($server, $salt, $tipo);
		$params = array(
				'name'           => $name,
        			'meetingID'      => $meetingID,
        			'attendeePW'     => $attendeePW,
        			'moderatorPW'    => $moderatorPW,
        			'welcome'        => $welcome,
        			'logoutURL'      => $logoutURL,
        			'maxParticipants'=> $maxParticipants,
       				'voiceBridge'    => $voiceBridge,
				'duration'       => $duration,
				'record'         => $record
				);
		
		print $app->createMeeting($params, $file);
		
		print "<hr/>";
		
		print "<h3>Test joinMeeting</h3>";
		$app = new Administration_BBB($server, $salt, $tipo);
		$params = array(
        			'fullName'  => $name,
        			'meetingID' => $meetingID,
        			'password'  => $moderatorPW
        			);
        
		print $app->joinMeeting($params);
				
		print "<hr/>";
		
		print"<h3>Test endMeeting</h3>";
		$app = new Administration_BBB($server, $salt, $tipo);
		$params = array(
				'meetingID' => $meetingID,
				'password'  => $moderatorPW
			        );
		
		print $app->endMeeting($params);
		
		print "<h1>Monitoring Options</h1>";
		print "<h3>Test getMeetings</h3>";
		$app = new Monitoring_BBB($server, $salt, $tipo);
		print $app->getMeetings();

		print "<hr/>";
		
		print "<h3>Test isMeetingRunning</h3>";
		$app = new Monitoring_BBB($server, $salt, $tipo);
		print $app->isMeetingRunning(array('meetingID' => $meetingID));
		
		print "<hr/>";
		
		print "<h3>Test getMeetingInfo</h3>";
		$app = new Monitoring_BBB($server, $salt, $tipo);
		print $app->getMeetingInfo(array('meetingID' => $meetingID, 'password' => $moderatorPW));
	
		print "<hr/>";

		print "<h1>Recording Options</h1>";
		print "<h3>Test getRecordings</h3>";
		$app = new Recording_BBB($server, $salt, $tipo);
		print $app->getRecordings(array('meetingID' => $meetingID)); //you can define one or many metting number with comas =D
		
		print "<hr/>";
		
		print "<h3>Test publishRecordings</h3>";
		$recordID = "984816fd329622876e14907634264e6f332e9fb3-1324048762357";
		$app = new Recording_BBB($server, $salt, $tipo);
		print $app->publishRecordings(array('recordID' => $recordID, 'publish' => 'true')); //you can define onde or many record to publish with comas =D
		
		print "<hr/>";
		print "<h3>Test deleteRecordings</h3>";
		$recordID = "984816fd329622876e14907634264e6f332e9fb3-1324048762357";
		$app = new Recording_BBB($server, $salt, $tipo);
		$recordID = "984816fd329622876e14907634264e6f332e9fb3-1324048762357";
		print $app->deleteRecordings(array('recordID' => $recordID));
<?php

$method = $_SERVER['REQUEST_METHOD'];


//process only when method id post

if($method == 'POST')
{
	
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	$text = $json->queryResult->parameters->text;
	$text=strtoupper($text);
	
	
	if ($text=='HANA')
	{
		$speech="SAP HANA is an in-memory, column-oriented, relational database management system";
		
	}
	else if($text == 'MySQL')
	{
		
		$speech="MySQL is an open-source relational database management system (RDBMS).";
	}
	else if($text == 'DATABASE')
	{
		$username    = "SANYAM_K";
    		$password    = "Welcome@123";
    		$json_url    = "http://74.201.240.43:8000/ChatBot/Sample_chatbot/hana_demo.xsjs";
		$ch      = curl_init( $json_url );
    		$options = array(
        	CURLOPT_SSL_VERIFYPEER => false,
        	CURLOPT_RETURNTRANSFER => true,
        	CURLOPT_USERPWD        => "{$username}:{$password}",
        	CURLOPT_HTTPHEADER     => array( "Accept: application/json" ),
    		);
    		curl_setopt_array( $ch, $options );
		$json = curl_exec( $ch );
		$someArray = json_decode($json, true);
		$database=  $someArray[0]["DATABASE_NAME"];
		$speech = " Database name is $database" ;
	}
	
	else
	{
		$speech = "Input something else";
	}
		
		$com = $json->queryResult->parameters->command;
		$com = strtolower($com);
		$room = $json->queryResult->parameters->rooms;
		
	
	if ($com == 'locality')
	{
		
		$username    = "SANYAM_K";
    		$password    = "Welcome@123";
    		$json_url    = "http://74.201.240.43:8000/ChatBot/Sample_chatbot/HADS_2013.xsjs?cmd=$com&getRooms=$room";
		$ch      = curl_init( $json_url );
    		$options = array(
        	CURLOPT_SSL_VERIFYPEER => false,
        	CURLOPT_RETURNTRANSFER => true,
        	CURLOPT_USERPWD        => "{$username}:{$password}",
        	CURLOPT_HTTPHEADER     => array( "Accept: application/json" ),
    		);
    		curl_setopt_array( $ch, $options );
		$json = curl_exec( $ch );
		$someArray = json_decode($json, true);
		$response=  $someArray[0]["results"];
		$speech = "$room bedroom houses are available in metro areas $response" ;
	}
	$response = new \stdClass();
    	$response->fulfillmentText = $speech;
    	$response->source = "webhook";
	echo json_encode($response);

}
else
{
	echo "Method not allowed";
}

?>


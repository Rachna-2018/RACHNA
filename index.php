<?php

$method = $_SERVER['REQUEST_METHOD'];


//process only when method id post

if($method == 'POST')
{
	
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	$text = $json->queryResult->parameters->text;
	if ($text=='hana' || $text=='HANA' || $text == 'Hana')
	{
		$speech="SAP HANA is an in-memory, column-oriented, relational database management system";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, "http://74.201.240.43:8000/ChatBot/chatbot/hana_demo.xsjs");
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$json = curl_exec($ch);
		curl_close($ch);
		
		//$json = file_get_contents('http://74.201.240.43:8000/ChatBot/chatbot/hana_demo.xsjs');
		$file = json_decode($json);
		$database = $file->DATABASE_NAME;
		$speech = "Database name is $database" ;
	
		
		/*$json = file_get_contents('url_here');
		$obj = json_decode($json);
		echo $obj->access_token;*/	
		
		
		
		
	}
	else if($text=='mysql' || $text == 'MySQL' || $text == 'MySql')
	{
		
		$speech="MySQL is an open-source relational database management system (RDBMS).";
	}
	else
	{
		$speech = "Input something else";
	}
	$response = new \stdClass();
    	$response->fulfillmentText = $speech;
    	$response->source = "webhook";
	//$response->displayText= "";
    	echo json_encode($response);

}
else
{
	echo "Method not allowed";
}

?>


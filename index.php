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
		
//method1
		/*$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, "http://74.201.240.43:8000/ChatBot/chatbot/hana_demo.xsjs");
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$json = curl_exec($ch);
		curl_close($ch);*/
		
//method2
		/*$username='SANYAM_K';
		$password='Welcome@123';
		$URL='http://74.201.240.43:8000/ChatBot/chatbot/hana_demo.xsjs';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$URL);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
		$json=curl_exec ($ch);
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
		curl_close ($ch);*/
		
		
//method3
		/*$postData = array(
   		 'login' => 'SANYAM_K',
    		'pwd' => 'Welcome@123',
    		'redirect_to' => 'http://74.201.240.43:8000/ChatBot/chatbot/hana_demo.xsjs',
    		'testcookie' => '1'
		);

		curl_setopt_array($ch, array(
		    CURLOPT_URL => 'http://74.201.240.43:8000/ChatBot/chatbot/hana_demo.xsjs',
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_POST => true,
		    CURLOPT_POSTFIELDS => $postData,
		    CURLOPT_FOLLOWLOCATION => true
		));
		$json = curl_exec($ch);*/
//method4
	/*	$username='SANYAM_K';
		$password='Welcome@123';
		$URL='http://74.201.240.43:8000/ChatBot/chatbot/hana_demo.xsjs';
		$ch = curl_init($URL);
		curl_setopt($ch, CURLOPT_URL,$URL);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
		$json=curl_exec ($ch);
		//$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
		curl_close ($ch);*/
//method5
		$username = "SANYAM_K";
		$password = "Welcome@123";
		$remote_url = 'http://74.201.240.43:8000/ChatBot/chatbot/hana_demo.xsjs';

		// Create a stream
		$opts = array(
		  'http'=>array(
  			  'method'=>"GET",
  			  'header' => "Authorization: Basic " . base64_encode("$username:$password")                 
 			 ));
		$context = stream_context_create($opts);

		// Open the file using the HTTP headers set above
		$json = file_get_contents($remote_url, false, $context);
		
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


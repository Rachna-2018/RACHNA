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
		curl_setopt($ch, CURLOPT_URL, "http://74.201.240.43:8000/ChatBot/Sample_chatbot/hana_demo.xsjs");
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$json = curl_exec($ch);
		curl_close($ch);*/
		
//method2
		/*$username='SANYAM_K';
		$password='Welcome@123';
		$URL='http://74.201.240.43:8000/ChatBot/Sample_chatbot/hana_demo.xsjs';

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
    		'redirect_to' => 'http://74.201.240.43:8000/ChatBot/Sample_chatbot/hana_demo.xsjs',
    		'testcookie' => '1'
		);

		curl_setopt_array($ch, array(
		    CURLOPT_URL => 'http://74.201.240.43:8000/ChatBot/Sample_chatbot/hana_demo.xsjs',
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_POST => true,
		    CURLOPT_POSTFIELDS => $postData,
		    CURLOPT_FOLLOWLOCATION => true
		));
		$json = curl_exec($ch);*/
//method4
		/*$username='SANYAM_K';
		$password='Welcome@123';
		$URL='http://74.201.240.43:8000/ChatBot/Sample_chatbot/hana_demo.xsjs';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$URL);
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
		$json=curl_exec ($ch);
		//print "curl response is:" . $json;
		//$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
		curl_close ($ch);*/
//method5
		/*$username = "SANYAM_K";
		$password = "Welcome@123";
		$remote_url = 'http://74.201.240.43:8000/ChatBot/Sample_chatbot/hana_demo.xsjs';

		// Create a stream
		$context = stream_context_create(array(
    		'http' => array(
     		   'header'  => "Authentication: Basic " . base64_encode("$username:$password")
   		 )
		));
				
		// Open the file using the HTTP headers set above
		$json = file_get_contents($remote_url, false, $context);*/
		
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

//method6
		//The username or email address of the account.
/*define('USERNAME', 'SANYAM_K');

//The password of the account.
define('PASSWORD', 'Welcome@123');

//Set a user agent. This basically tells the server that we are using Chrome ;)
define('USER_AGENT', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.2309.372 Safari/537.36');

//Where our cookie information will be stored (needed for authentication).
define('COOKIE_FILE', 'cookie.txt');

//URL of the login form.
define('LOGIN_FORM_URL', 'http://10.70.177.14:8000/sap/hana/xs/formLogin/login.html?x-sap-origin-location=%2FChatBot%2FSample_chatbot%2Fhana_demo.xsjs');

//Login action URL. Sometimes, this is the same URL as the login form.
define('LOGIN_ACTION_URL', 'http://10.70.177.14:8000/sap/hana/xs/formLogin/login.html?x-sap-origin-location=%2FChatBot%2FSample_chatbot%2Fhana_demo.xsjs');


//An associative array that represents the required form fields.
//You will need to change the keys / index names to match the name of the form
//fields.
$postValues = array(
    'username' => USERNAME,
    'password' => PASSWORD
);

//Initiate cURL.
$curl = curl_init();

//Set the URL that we want to send our POST request to. In this
//case, it's the action URL of the login form.
curl_setopt($curl, CURLOPT_URL, LOGIN_ACTION_URL);

//Tell cURL that we want to carry out a POST request.
curl_setopt($curl, CURLOPT_POST, true);

		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
//Set our post fields / date (from the array above).
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postValues));

//We don't want any HTTPS errors.
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

//Where our cookie details are saved. This is typically required
//for authentication, as the session ID is usually saved in the cookie file.
curl_setopt($curl, CURLOPT_COOKIEJAR, COOKIE_FILE);

//Sets the user agent. Some websites will attempt to block bot user agents.
//Hence the reason I gave it a Chrome user agent.
curl_setopt($curl, CURLOPT_USERAGENT, USER_AGENT);

//Tells cURL to return the output once the request has been executed.
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//Allows us to set the referer header. In this particular case, we are 
//fooling the server into thinking that we were referred by the login form.
curl_setopt($curl, CURLOPT_REFERER, LOGIN_FORM_URL);

//Do we want to follow any redirects?
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);

//Execute the login request.
curl_exec($curl);

//Check for errors!
if(curl_errno($curl)){
    throw new Exception(curl_error($curl));
}
		
//We should be logged in by now. Let's attempt to access a password protected page
curl_setopt($curl, CURLOPT_URL, 'http://74.201.240.43:8000/ChatBot/Sample_chatbot/hana_demo.xsjs');

//Use the same cookie file.
curl_setopt($curl, CURLOPT_COOKIEJAR, COOKIE_FILE);

//Use the same user agent, just in case it is used by the server for session validation.
curl_setopt($curl, CURLOPT_USERAGENT, USER_AGENT);

//We don't want any HTTPS / SSL errors.
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

//Execute the GET request and print out the result.
$json= curl_exec($curl);*/
		//---------------------------//
		$file = json_decode($json);
		$database = $file->DATABASE_NAME;
		$speech .= " Database name is $database" ;
	
		
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
	echo json_encode($response);

}
else
{
	echo "Method not allowed";
}

?>


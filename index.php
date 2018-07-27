<?php

$method = $_SERVER['REQUEST_METHOD'];
//$method = 'POST';
$speech="";
//$text='hana';
//process only when method id post

if($method == 'POST')
{
	
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	$text = $json->queryResult->parameters->text;
	if ($text=='hana' || $text=='HANA' || $text == 'Hana')
	{
		$speech="SAP HANA is an in-memory, column-oriented, relational database management system";
		//$driver = 'HDBODBC';
		// Host
		//
		//$host = "74.201.240.43:8000";
		// Default name of your hana instance
		//$db_name = "CH1";
		// Username
		$username = 'SANYAM_K';
		// Password
		$password = "Welcome@123";
		// Try to connect
		$odbc="chatbot";
		$conn = odbc_connect($odbc,$username,$password, SQL_CUR_USE_ODBC);
		    $speech += " ";
		    $speech += "connection done";
    		odbc_close($conn);
		
		
		
		
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


<?php


$method = $_SERVER['REQUEST_METHOD'];
$speech="";
//process only when method id post
if($method == 'POST')
{
	
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	$text = $json->queryResult->parameters->text;
	/*if ($text=='hana' || $text=='HANA' || $text == 'Hana')
	{
		$speech="SAP HANA is an in-memory, column-oriented, relational database management system";
		/*		$driver = 'HDBODBC';

		// Host
		//
		$host = "10.70.177.14:30015";

		// Default name of your hana instance
		$db_name = "CH1";

		// Username
		$username = 'SANYAM_K';

		// Password
		$password = "Welcome@123";

		// Try to connect
		$conn = odbc_connect("Driver=$driver;ServerNode=$host;Database=$db_name;", $username, $password, SQL_CUR_USE_ODBC);

		if (!$conn)
		{
    		// Try to get a meaningful error if the connection fails
    		echo "Connection failed.\n";
    		echo "ODBC error code: " . odbc_error() . ". Message: " . odbc_errormsg();

   
		}	
		else
		{
    		// Do a basic select from DUMMY with is basically a synonym for SYS.DUMMY
    		$sql = 'SELECT * FROM DUMMY';
    		$result = odbc_exec($conn, $sql);
    		if (!$result)
    		{
		        echo "Error while sending SQL statement to the database server.\n";
        		echo "ODBC error code: " . odbc_error() . ". Message: " . odbc_errormsg();
    		}
    		else
    		{
        		while ($row = odbc_fetch_object($result))
        		{
            			// Should output one row containing the string 'X'
            			var_dump($row);
        		}
		}
    		odbc_close($conn);
		
		
	}
	else if($text=='mysql' || $text == 'MySQL' || $text == 'MySql')
	{
		
		$speech="MySQL is an open-source relational database management system (RDBMS).";
	}*/
	if (strlen($text) > 1){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://www.google.com/search?q=$show");
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_exec($ch);
	curl_close($ch);			
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

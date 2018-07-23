<?php


$method = $_SERVER['REQUEST_METHOD'];
$speech="";
//process only when method id post
if($method == 'POST'){
	
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	$text = $json->queryResult->parameters->text;
	if ($text=='hana')
	{
		$speech="SAP HANA is an in-memory, column-oriented, relational database management system";
	}
	else
	{
		$speech="Input something else";
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

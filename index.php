<?php


$method = $_SERVER['REQUEST_METHOD'];
$speech="";
//process only when method id post
if($method == 'POST'){
	
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	$text = $json->result->parameters->text;
	if ($text==1)
	{
		$speech="SAP HANA is an in-memory, column-oriented, relational database management system";
	}
	else
	{
		$speech="Input anything else";
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

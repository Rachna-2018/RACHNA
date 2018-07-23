<?php


$method = $_SERVER['REQUEST_METHOD'];
$speech="";
//process only when method id post
if($method == 'POST'){
	
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	$text = $json->result->parameters->text;
	if ($text=='hi')
	{
		$speech="Hi, Nice to meet you";
	}
	elseif ($text=='bye')
	{
		$speech="Bye, good night";
	}
	elseif($text=='anything')
	{
		$speech="Sorry, I didnot get that.";
	}
	else
	{
		$speech="something else";
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

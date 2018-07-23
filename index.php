<?php


$method = $_SERVER['REQUEST_METHOD'];
<form name="form1" method="POST" action="chatBot">
//process only when method id post
if($method == 'POST'){
	
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	$text = $json->result->parameters->text;
	switch($text){
		case 'hi':
		$speech = "Hi, Nice to meet you";
		break;
		
		case 'bye':
		$speech = "Bye, good night";
		break;

		case 'anything':
		$speech = "Sorry, I didnot get that.";
		break;
	
	}
$response = new \stdClass();
    $response->fulfillmentText = $speech;
    $response->source = "webhook";
	$response->displaytext= "";
    echo json_encode($response);

}
else
{
	echo "Method not allowed";
}
</form>
?>

<?php

$method = $_SERVER['REQUEST_METHOD'];

//Process only when method is POST
if ($method == "POST"){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);

	$text = $json->result->parameters->text;

	switch ($text){
		case 'que opinas de mi esposo eduardo':
			$speech = "Que es un gran chico, y que desde hace tiempo, ha decidido y desea terminar su vida a tu lado. El te ama!";
		break;
		case 'bye':
			$speech = "Bye, good night";
		break;
		case 'anything':
			$speech = "Yes, you can type anything here.";
		break;
		default:
			$speech = "Sorry, I didn't get that. Please as me something else.";
		break;
	}

	$response = new stdClass();
	$response->speech = $speech;
	$response->displayText = $speech;
	$response->source = "webhook";
	echo json_encode($response);

}
else{
	echo "Method not allowed";
}

?>
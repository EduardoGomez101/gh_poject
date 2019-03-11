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
		case 'lights on':
			$speech = "Turning the lights on, now.";
		break;
		case 'Hey Google':
			$speech = "Hi Eduardo, glad to hear you again.";
		break;
		case 'Lights off':
			$speech = "Turning the lights off.";
		break;
		case 'anything':
			$speech = "Yes, you can type anything here.";
		break;
		default:
			$speech = "Aún no aprendo eso que me dices, pero te aseguro que pronto lo haré.";
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
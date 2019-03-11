<?php

$method = $_SERVER['REQUEST_METHOD'];

//Process only when method is POST
if ($method == "POST"){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);

	$text = $json->result->parameters->text;

	switch ($text){
		case 'temperature to 70':
			$speech = "OK, I will change temperature to 70";
			$displayText = "FFFF00160000000000000000FFFFFF9300000000074242494E434F00FFA3000200000000000000000065FF83000E000000000000000000650000000000003F02BC000000FF83000E000000000000000000650000000000003F02BC000000FF83000E000000000000000000650000000000003F02BC000000";
		break;
		case 'temperature to 72':
			$speech = "OK, I will change temperature to 72";
			$displayText = "FFFF00160000000000000000FFFFFF9300000000074242494E434F00FFA3000200000000000000000065FF83000E000000000000000000650000000000003F02D0000000FF83000E000000000000000000650000000000003F02D0000000FF83000E000000000000000000650000000000003F02D0000000";
		break;
		case 'lights on':
			$speech = "Turning the lights on, now.";
			$displayText = "Turning the lights on, now.";
		break;
		case 'hey Google':
			$speech = "Hi Eduardo, glad to hear you again.";
			$displayText = "Hi Eduardo, glad to hear you again.";
		break;
		case 'lights off':
			$speech = "Turning the lights off.";
			$displayText = "Turning the lights off.";
		break;
		default:
			$speech = "I'm still a virtual kid, but soon I will grow up!";
			$displayText = "I'm still a virtual kid, but soon I will grow up!";
		break;
	}

	$response = new stdClass();
	$response->speech = $speech;
	$response->displayText = $displayText;
	$response->source = "webhook";
	echo json_encode($response);

}
else{
	echo "Method not allowed";
}

?>
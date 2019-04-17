<?php

$method = $_SERVER['REQUEST_METHOD'];

//Process only when method is POST
if ($method == "POST"){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);

	$text = strtolower($json->result->parameters->text);

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
			$speech = "Turning the lights on, now";
			$displayText = "Turning the lights on, now";
		break;
		case 'hey google':
			$speech = "Hi Eduardo, glad to hear you again";
			$displayText = "Hi Eduardo, glad to hear you again";
		break;
		case 'lights off':
			$speech = "Turning the lights off";
			$displayText = "Turning the lights off";
		break;
		case 'open the drapes':
			$speech = "Opening drapes";
			$displayText = "Opening drapes";
		break;
		case 'close the drapes':
			$speech = "Closing drapes";
			$displayText = "Closing drapes";
		break;
		case 'high speed':
			//$speech = "Ok, max speed 2! (https://inncom.com/images/TechnicalDocs/E528_-Product-Guide_Rev8.0_20MAR17.pdf "Aqui")";
			$speech = "Hi. The link is https://inncom.com/images/TechnicalDocs/E528_-Product-Guide_Rev8.0_20MAR17.pdf";
			$displayText = "Ok, max speed!";
		break;
		case 'medium speed':
			$speech = "Medium speed, alright";
			$displayText = "Medium speed, alright";
		break;
		case 'low speed':
			$speech = "For sure, fan in low speed";
			$displayText = "For sure, fan in low speed";
		break;
		case 'how is the office moving going in niantic':
			$speech = "Going well but we have to keep QA environments down hahaha";
			$displayText = "123456789_123456789_123456789_123456789_";
		break;
		default:
			$speech = "I'm still a virtual kid, but soon I will grow up!";
			$displayText = "I'm still a virtual kid, but soon I will grow up!";
		break;
	}


//{
//  "payload": {
//    "google": {
//      "expectUserResponse": true,
//      "richResponse": {
//        "items": [
//          {
//            "simpleResponse": {
//              "textToSpeech": "Howdy, this is GeekNum. I can tell you fun facts about almost any number, my favorite is 42. What number do you have in mind?",
//              "displayText": "Howdy! I can tell you fun facts about almost any number. What do you have in mind?"
//            }
//          }
//        ]
//      }
//    }
//  }
//}
//
//
//$response = new stdClass();
//$response->payload->google->expectUserResponse = true;
//$response->payload->google->richResponse->items->simpleResponse->textToSpeech = "texto a ser hablado";
//$response->payload->google->richResponse->items->simpleResponse->displayText = "texto a ser mostrado";
//echo json_encode($response);

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
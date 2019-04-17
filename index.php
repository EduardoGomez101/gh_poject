<?php

$method = $_SERVER['REQUEST_METHOD'];

//Process only when method is POST
if ($method == "POST"){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);

	$text = strtolower($json->queryResult->parameters->text);

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


//PRUEBA INICIAL
//PENDIENTE, EN DONDE SOLO SE MANDA UN "SIMPLE RESPONSE"







//VA AVANZANDO---




//"fulfillmentMessages": [
//    {
//      "card": {
//        "title": "card title",
//        "subtitle": "card text",
//        "imageUri": "https://assistant.google.com/static/images/molecule/Molecule-Formation-stop.png",
//        "buttons": [
//          {
//            "text": "button text",
//            "postback": "https://assistant.google.com/"
//          }
//        ]
//      }
//    }
//  ],





//$marker = array(
//        'type' => 'Feature',
//        'properties' => array(
//            'title' => $programme->title,
//            'url' => $programme->url,
//            'summary' => $programme->programme_summary,
//            'image' => $programme->programme_venue_image->url
//        ),
//        'geometry' => array(
//            'type' => 'Point',
//            'coordinates' => array(
//                $programme->programme_location->lng,
//                $programme->programme_location->lat
//            )
//        )
//    );


$response = new stdClass();
$response->fulfillmentText = "This is a text response";

$response->fulfillmentMessages = array(card->title => "card title");


//$response->fulfillmentMessages->array(card->title = "card title";
//$response->fulfillmentMessages->array(card->subtitle = "card text";
//$response->fulfillmentMessages->array(card->imageUri = "https://assistant.google.com/static/images/molecule/Molecule-Formation-stop.png";
//$response->fulfillmentMessages->array(card->buttons->text = "button text";
//$response->fulfillmentMessages->array(card->buttons->postback = "https://assistant.google.com/";
$response->source = "example.com";
//$response->payload->google->expectUserResponse = true;
//$response->payload->google->richResponse->items->simpleResponse->textToSpeech = "This is a simple response";
//$response->payload->facebook->text = "Hello, Facebook";
//$response->payload->slack->text = "This is a text response for Slack";
//$response->outputContexts->name = "projects/${PROJECT_ID}/agent/sessions/${SESSION_ID}/contexts/context name";
//$response->outputContexts->lifespanCount = 5;
//$response->outputContexts->parameters->param = "param value";
//$response->followupEventInput->name = "event name";
//$response->followupEventInput->languageCode = "es";
//$response->followupEventInput->parameters->param = "param value";
echo json_encode($response);

//************************************SEGUNDA OPCION
//{
//  "expectUserResponse": true,
//  "expectedInputs": [
//    {
//      "possibleIntents": [
//        {
//          "intent": "actions.intent.TEXT"
//        }
//      ],
//      "inputPrompt": {
//        "richInitialPrompt": {
//          "items": [
//            {
//              "simpleResponse": {
//                "textToSpeech": "Howdy, this is GeekNum. I can tell you fun facts about almost any number, my favorite is 42. What number do you have in mind?",
//                "displayText": "Howdy! I can tell you fun facts about almost any number. What do you have in mind?"
//              }
//            }
//          ]
//        }
//      }
//    }
//  ]
//}

//$response = new stdClass();
//$response->expectUserResponse = true;
//$response->expectedInputs->possibleIntents->intent = "actions.intent.TEXT";
//$response->expectedInputs->inputPrompt->richInitialPrompt->items->simpleResponse->speech = "texto de textToSpeech";
//$response->expectedInputs->inputPrompt->richInitialPrompt->items->simpleResponse->displayText = "texto de displayText";
//echo json_encode($response);


//********************************** TERCER INTENTO
//"fulfillment": {
//      "messages":
//        {
//          "type": "simple_response",
//          "platform": "google",
//          "textToSpeech": "Prueba de audio",
//          "displayText": "Salida de texto"
//        },
//        {
//          "type": 0,
//          "speech": ""
//        }
//    }

//$response = new stdClass();
//$response->fulfillment->messages->type = "simple_response";
//$response->fulfillment->messages->platform = "google";
//$response->fulfillment->messages->textToSpeech = "Prueba de speech";
//$response->fulfillment->messages->displayText = "prueba de display";
//$response->fulfillment->messages->type = "0";
//$response->fulfillment->messages->speech = "";
//echo json_encode($response);



//******************* EL QUE FUNCIONA BIEN ES EL SIGUIENTE:

//	$response = new stdClass();
//	$response->speech = $speech;
//	$response->displayText = $displayText;
//	$response->source = "webhook";
//	echo json_encode($response);

}
else{
	echo "Method not allowed";
}

?>
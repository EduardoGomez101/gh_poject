<?php

$method = $_SERVER['REQUEST_METHOD'];

//Process only when method is POST
if ($method == "POST"){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);

	//$acciones = strtolower($json->queryResult->parameters->acciones);
	//$termostatos = strtolower($json->queryResult->parameters->termostatos);
  $Contrasenia = strtolower($json->queryResult->parameters->Contrasenia);
  $PersonalAutorizado = strtolower($json->queryResult->parameters->PersonalAutorizado);

  if ($Contrasenia == "" && $PersonalAutorizado == ""){
    $prueba = '{
      "fulfillmentText": "Bienvenid@ a la Inteligencia Artificial de Hospitality Solutions para México y LATAM.",
      "payload": {
        "google": {
          "expectUserResponse": true,
          "richResponse": {
            "items": [
              {
                "simpleResponse": {
                  "textToSpeech": "Bienvenid@ a la Inteligencia Artificial de Hospitality Solutions para México y LATAM."
                }
              },
              {
                "basicCard": {
                  "title": "Hospitality Solutions - IA",
                  "subtitle": "México y LATAM",
                  "formattedText": "",
                  "image": {
                    "url": "https://www.innspire.com/wp-content/uploads/2014/10/Inncom-1.png",
                    "accessibilityText": "Hospitality Solutions - IA"
                  },
                  "buttons": [
                    {
                      "title": "",
                      "openUrlAction": {
                        "url": ""
                      }
                    }
                  ],
                  "imageDisplayOptions": "CROPPED"
                }
              }
            ]
          }
        }
      }
    }';
  } else{
    if ($Contrasenia == 12345 && $PersonalAutorizado == "eduardo gomez"){
      $prueba = '{
        "fulfillmentText": "Buen día Sr. '.$json->queryResult->parameters->PersonalAutorizado.', cuál es su duda en específico?",
        "payload": {
          "google": {
            "expectUserResponse": true,
            "richResponse": {
              "items": [
                {
                  "simpleResponse": {
                    "textToSpeech": "Buen día Sr. '.$json->queryResult->parameters->PersonalAutorizado.', cuál es su duda en específico?"
                  }
                },
                {
                  "basicCard": {
                    "title": "Bienvenid@",
                    "subtitle": "Hospitality Solutions - IA",
                    "formattedText": "Cuál es su duda en específico?",
                    "image": {
                      "url": "",
                      "accessibilityText": "Termostato E528"
                    },
                    "buttons": [
                      {
                        "title": "",
                        "openUrlAction": {
                          "url": ""
                        }
                      }
                    ],
                    "imageDisplayOptions": "CROPPED"
                  }
                }
              ]
            }
          }
        }
      }';
    } else{
      $prueba = '{
        "fulfillmentText": "Para acceder al service mode de un Termostato E528, siga los siguientes pasos:\n1. Presione y mantenga presionado el botón °F/°C\n2. Presione el botón DISPLAY\n3. Presione el botón OFF/AUTO\n4. Libere el botón °F/°C",
        "payload": {
          "google": {
            "expectUserResponse": true,
            "richResponse": {
              "items": [
                {
                  "simpleResponse": {
                    "textToSpeech": "Incorrecto - Como acceder al Service Mode de un Termostato E528"
                  }
                },
                {
                  "basicCard": {
                    "title": "E528",
                    "subtitle": "Termostato",
                    "formattedText": "Para acceder al service mode de un **Termostato E528**, siga los siguientes pasos:\n1. Presione y mantenga presionado el botón __°F/°C__\n2. Presione el botón __DISPLAY__\n3. Presione el botón __OFF/AUTO__\n4. Libere el botón __°F/°C__",
                    "image": {
                      "url": "https://sc01.alicdn.com/kf/HTB1f9srKpXXXXXsXXXXq6xXFXXXo/e4-Smart-Digital-Thermostat-E528.jpg_350x350.jpg",
                      "accessibilityText": "Termostato E528"
                    },
                    "buttons": [
                      {
                        "title": "Descargar",
                        "openUrlAction": {
                          "url": "https://inncom.com/images/TechnicalDocs/E528_-Product-Guide_Rev8.0_20MAR17.pdf"
                        }
                      }
                    ],
                    "imageDisplayOptions": "CROPPED"
                  }
                }
              ]
            }
          }
        }
      }';
    }
  }


    

	$deco = json_decode($prueba);
	echo json_encode($deco);

}
else{ echo "Method not allowed"; }
?>
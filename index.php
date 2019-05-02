<?php

$method = $_SERVER['REQUEST_METHOD'];

//Process only when method is POST
if ($method == "POST"){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);

  //Listado de variables a emplear
  $Accion = "";
  $Variable = "";
  $Objeto = "";
  $Escena = "";
  $number = "";

  $mensajeRespuesta = "";
  
  if (isset($json->queryResult->parameters->Accion)) $Accion = strtolower($json->queryResult->parameters->Accion);
  if (isset($json->queryResult->parameters->Variable)) $Variable = strtolower($json->queryResult->parameters->Variable);
  if (isset($json->queryResult->parameters->Objeto)) $Objeto = strtolower($json->queryResult->parameters->Objeto);
  if (isset($json->queryResult->parameters->Escena)) $Escena = strtolower($json->queryResult->parameters->Escena);
  $number = $json->queryResult->parameters->number;

  switch ($Accion){
    case "subir":
      if ($Objeto == "cortinas" || $Objeto == "persianas"){
        $mensajeRespuesta = "Perfecto, estoy abriendo las ".$Objeto;
      }
      if ($Variable == "temperatura"){
        $mensajeRespuesta = "Muy bien! Subiendo temperatura a ".$number." grados";
      }
    break;
    case "apagar":
      switch($Objeto){
        case "television": $mensajeRespuesta = "Por supuesto, television apagada."; break;
        case "luz de baño": $mensajeRespuesta = "Apagando luz de baño. Si detecto presencia, encendere nuevamente ésta luz."; break;
        case "todo": $mensajeRespuesta = "Muy bien! Apagando toda la habitación."; break;
      }
    break;
    case "prender":
      switch($Objeto){
        case "television": $mensajeRespuesta = "Claro! Encendiendo la televisión."; break;
        case "luz principal": $mensajeRespuesta = "Muy bien, luz principal encendida."; break;
        case "luz del baño": $mensajeRespuesta = "Encendiendo luz de baño."; break;
      }
    break;
    case "escena":
      if ($Escena == "dormir") $mensajeRespuesta = "Muy bien, definiendo escena para que puedas dormir tranquilamente. Que descanses. Buenas noches.";
    break;
  }

  $prueba = '{
            "fulfillmentText": "'.$mensajeRespuesta.'",
            "payload": {
              "google": {
                "expectUserResponse": true,
                "richResponse": {
                  "items": [
                    {
                      "simpleResponse": {
                        "textToSpeech": "'.$mensajeRespuesta.'"
                      }
                    },
                    {
                      "basicCard": {
                        "title": "",
                        "subtitle": "Prueba",
                        "formattedText": "",
                        "image": {
                          "url": "",
                          "accessibilityText": ""
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


  //if ($Contrasenia == "" && $PersonalAutorizado == ""){
  //  $prueba = '{
  //    "fulfillmentText": "Bienvenid@ a la Inteligencia Artificial de Hospitality Solutions para México y LATAM.",
  //    "payload": {
  //      "google": {
  //        "expectUserResponse": true,
  //        "richResponse": {
  //          "items": [
  //            {
  //              "simpleResponse": {
  //                "textToSpeech": "Bienvenid@ a la Inteligencia Artificial de Hospitality Solutions para México y LATAM."
  //              }
  //            },
  //            {
  //              "basicCard": {
  //                "title": "Hospitality Solutions - IA",
  //                "subtitle": "México y LATAM",
  //                "formattedText": "",
  //                "image": {
  //                  "url": "https://www.innspire.com/wp-content/uploads/2014/10/Inncom-1.png",
  //                  "accessibilityText": "Hospitality Solutions - IA"
  //                },
  //                "buttons": [
  //                  {
  //                    "title": "",
  //                    "openUrlAction": {
  //                      "url": ""
  //                    }
  //                  }
  //                ],
  //                "imageDisplayOptions": "CROPPED"
  //              }
  //            }
  //          ]
  //        }
  //      }
  //    }
  //  }';
  //} else{
  //  if ($Contrasenia == 12345 && $PersonalAutorizado == "eduardo gomez"){
  //    $prueba = '{
  //      "fulfillmentText": "Buen día Sr. '.$json->queryResult->parameters->PersonalAutorizado.', cuál es su duda en específico?",
  //      "payload": {
  //        "google": {
  //          "expectUserResponse": true,
  //          "richResponse": {
  //            "items": [
  //              {
  //                "simpleResponse": {
  //                  "textToSpeech": "Buen día Sr. '.$json->queryResult->parameters->PersonalAutorizado.', cuál es su duda en específico?"
  //                }
  //              },
  //              {
  //                "basicCard": {
  //                  "title": "",
  //                  "subtitle": "Hospitality Solutions - IA",
  //                  "formattedText": "",
  //                  "image": {
  //                    "url": "",
  //                    "accessibilityText": "Termostato E528"
  //                  },
  //                  "buttons": [
  //                    {
  //                      "title": "",
  //                      "openUrlAction": {
  //                        "url": ""
  //                      }
  //                    }
  //                  ],
  //                  "imageDisplayOptions": "CROPPED"
  //                }
  //              }
  //            ]
  //          }
  //        }
  //      }
  //    }';
  //  } else{
  //    $prueba = '{
  //      "fulfillmentText": "Para acceder al service mode de un Termostato E528, siga los siguientes pasos:\n1. Presione y mantenga presionado el botón °F/°C\n2. Presione el botón DISPLAY\n3. Presione el botón OFF/AUTO\n4. Libere el botón °F/°C",
  //      "payload": {
  //        "google": {
  //          "expectUserResponse": true,
  //          "richResponse": {
  //            "items": [
  //              {
  //                "simpleResponse": {
  //                  "textToSpeech": "Incorrecto - Como acceder al Service Mode de un Termostato E528"
  //                }
  //              },
  //              {
  //                "basicCard": {
  //                  "title": "E528",
  //                  "subtitle": "Termostato",
  //                  "formattedText": "Para acceder al service mode de un **Termostato E528**, siga los siguientes pasos:\n1. Presione y mantenga presionado el botón __°F/°C__\n2. Presione el botón __DISPLAY__\n3. Presione el botón __OFF/AUTO__\n4. Libere el botón __°F/°C__",
  //                  "image": {
  //                    "url": "https://sc01.alicdn.com/kf/HTB1f9srKpXXXXXsXXXXq6xXFXXXo/e4-Smart-Digital-Thermostat-E528.jpg_350x350.jpg",
  //                    "accessibilityText": "Termostato E528"
  //                  },
  //                  "buttons": [
  //                    {
  //                      "title": "Descargar",
  //                      "openUrlAction": {
  //                        "url": "https://inncom.com/images/TechnicalDocs/E528_-Product-Guide_Rev8.0_20MAR17.pdf"
  //                      }
  //                    }
  //                  ],
  //                  "imageDisplayOptions": "CROPPED"
  //                }
  //              }
  //            ]
  //          }
  //        }
  //      }
  //    }';
  //  }
  //}


    

	$deco = json_decode($prueba);
	echo json_encode($deco);

}
else{ echo "Method not allowed"; }
?>
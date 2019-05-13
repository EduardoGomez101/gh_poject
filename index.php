<?php

$method = $_SERVER['REQUEST_METHOD'];

//Process only when method is POST
if ($method == "POST"){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);

  //LISTADO DE FUNCIONES QUE SE PUEDEN PRESENTAR COMO EJEMPLO
  //1. Temperatura (Subir a temp definida, Bajar a temp definida, Cambiar temperatura a condiciones especificas, como: frio=18.5°C, fresco=20°C, Templado=22°C, Caliente=25°C)
  //2. Iluminacion (Encender por zona, encender luminaria en específico, encender todo, apagar todo, dimear una luz a un porcentaje, dimear una luz con un nivel humano)
  //3. Escenas (Definir una escena)
  //4. Persianas (Abrir todo, cerrar todo, abrir un poco, cerrar un poco, modo ahorro de energia "cerrando las persianas mientras sea un horario especifico")
  //5. Opciones adicionales, como encendido de cafetera por medio de una salida de X47

  //Listado de variables a emplear
  $Accion = "";
  $Variable = "";
  $Objeto = "";
  $Escena = "";
  $number = "";

  $mensajeRespuesta = "";
  $mensajeComando = "";
  
  if (isset($json->queryResult->parameters->Accion)) $Accion = strtolower($json->queryResult->parameters->Accion);
  if (isset($json->queryResult->parameters->Variable)) $Variable = strtolower($json->queryResult->parameters->Variable);
  if (isset($json->queryResult->parameters->Objeto)) $Objeto = strtolower($json->queryResult->parameters->Objeto);
  if (isset($json->queryResult->parameters->Escena)) $Escena = strtolower($json->queryResult->parameters->Escena);
  $number = $json->queryResult->parameters->number;

  switch ($Accion){
    case "habitacion fria":
      $mensajeRespuesta = "Por supuesto! Colocaré el Set Point a 18.5 grados centígrados.";
    break;
    case "habitacion fresca":
      $mensajeRespuesta = "Muy bien! Definiendo temperatura a 20 grados centígrados.";
    break;
    case "habitacion templada":
      $mensajeRespuesta = "Por supuerto! Cambiando la temperatura a 22 grados centígrados.";
    break;
    case "habitacion calida":
      $mensajeRespuesta = "Vale! Temperatura a 25 grados centígrados.";
    break;
    case "subir":
      if ($Objeto == "cortinas" || $Objeto == "persianas"){
        $mensajeRespuesta = "Perfecto, estoy abriendo las ".$Objeto;
      }
      if ($Variable == "temperatura"){
        $mensajeRespuesta = "Muy bien! Subiendo temperatura a ".$number." grados";
        $mensajeComando = "FA00E3";
      }
    break;
    case "bajar":
      if ($Objeto == "cortinas" || $Objeto == "persianas"){
        $mensajeRespuesta = "Cerrando las ".$Objeto;
      }
      if ($Variable == "temperatura"){
        $mensajeRespuesta = "Claro! Bajando temperatura a ".$number." grados";
      }
    break;
    case "persianas en modo de ahorro de energia":
      $mensajeRespuesta = "Muchas gracias! Con tu ayuda, podemos ahorrar energía y con ello ayudar al planeta!. Activando modo de ahorro de energía.";
    break;
    case "desactivar ahorro de energia":
      $mensajeRespuesta = "Por supuesto! Desactivando modo de ahorro de energía.";
    break;
    case "encendido especial":
      $mensajeRespuesta = "Claro que si! Encendiendo ".$Objeto.".";
    break;
    case "prender":
      switch($Objeto){
        case "television": $mensajeRespuesta = "Claro! Encendiendo la televisión."; break;
        case "luz principal": $mensajeRespuesta = "Muy bien, luz principal encendida."; break;
        case "luz de baño": $mensajeRespuesta = "Encendiendo luz de baño."; break;
        case "zona de vestidor": $mensajeRespuesta = "Encendiendo luces de la zona de vestidor."; break;
        case "zona de escritorio": $mensajeRespuesta = "Encendiendo luces del escritorio."; break;
        case "todo": $mensajeRespuesta = "Claro que si! Encendiendo todas las luces."; break;
        case "luz de cama": $mensajeRespuesta = "Tal como lo pidas. Encendiendo la luz de cama."; break;
        case "luces de forma calida": $mensajeRespuesta = "Muy bien! Ajustando iluminación en modo: Cálido."; break;
      }
    break;
    case "apagar":
      switch($Objeto){
        case "television": $mensajeRespuesta = "Por supuesto, television apagada."; break;
        case "luz de baño": $mensajeRespuesta = "Apagando luz de baño. Si detecto presencia, encenderé nuevamente ésta luz."; break;
        case "todo": $mensajeRespuesta = "Muy bien! Apagando toda la habitación."; break;
        case "zona de vestidor": $mensajeRespuesta = "Apagando luces de vestidor."; break;
        case "zona de escritorio": $mensajeRespuesta = "Apagando luces de la zona de escritorio."; break;
        case "todo": $mensajeRespuesta = "Perfecto! Apagando todas las luces."; break;
      }
    break;
    case "escena":
      if ($Escena == "dormir") $mensajeRespuesta = "Muy bien, definiendo escena para que puedas dormir tranquilamente. Que descanses. Buenas noches.";
      if ($Escena == "trabajar") $mensajeRespuesta = "Muy bien, definiendo escena para que puedas trabajar sin interrupciones. Apagando televisión y encendiendo luces de escritorio.";
    break;
  }

  $prueba = '{
            "fulfillment": {
      "speech": "Text defined in Dialogflow console for the intent that was matched",
      "messages": [
        {
          "type": 0,
          "speech": "Text defined in Dialogflow console for the intent that was matched"
        }
      ]
    },
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

	$deco = json_decode($prueba);
	echo json_encode($deco);

}
else{ echo "Method not allowed"; }
?>
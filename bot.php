<?php

//Token que tiene nuestro bot
$token = '6263150732:AAHfCCDp8ZAKUqm0SjLqlvoIcuqvZio7Y2A';
//Link de la API de Telegram + el token que tiene nuestro bot
$website = 'https://api.telegram.org/bot' . $token;
//Leemos los datos que se envian
$input = file_get_contents('php://input');
$update = json_decode($input, TRUE);
//Identificamos el ID del chat
$chatId = $update['message']['chat']['id'];
//Identificamos el texto del mensaje
$message = $update['message']['text'];

//Con esta funcion vemos cada valor posible para el mensaje
switch ($message){
    //Si el mensaje es /start, el bot respondera con un mensaje indicando que se ha iniciado
    case '/start':
        $response = 'Me has iniciado';
        senMessage($chatId, $response);
        break;
    //Si el mensaje es /info, el bot respondera con un mensaje indicando sus datos    
    case '/info':
        $response = 'Me llamo acm0041_Bot';
        senMessage($chatId, $response);
        break;
    //Si el mensaje es otro que no sea ninguno de los anteriores, el bot indicara que no le ha entendido
    default:
        $response = 'No te he entendido';
        senMessage($chatId, $response);
        break;
}
//La funcion crea la url con el link de la API de Telegram, ademas del token y le añade algunos parametros mas para poder enviar el mensaje. Le añade el ID del chat, pone el modo en HTML y la respuesta. Por ultimo, devuelve los datos leidos en la url. 
function sendMessage($chatId, $response){
    $url = $GLOBALS['website'].'/sendMessage?chat_id='.$chatId.'&parse_mode=HTML&text='.urlencode($response);
    file_get_contents($url);
}

?>
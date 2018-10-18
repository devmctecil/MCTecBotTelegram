<?php

$botToken = "653915315:AAEIaPHH4qU4dh5WkkvcK32_6khC2DJHzVE";
$website = "https://api.telegram.org/bot".$botToken;

$update = file_get_contents('php://input');
$update = json_decode($update, TRUE);

$chatId = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];
$lastname = $update["message"]["from"]["last_name"];

switch($message)
{
	case "ID":
		funcionid($chatId);
		break;
	case "Soporte":
		funcionsoporte($chatId);
		break;	
	default:
		menuprincipal($chatId);
		break;
}

function enviarmensaje($chatId,$mensaje)
{
	
	$url = "$GLOBALS[website]/sendmessage?chat_id=$chatId&parse_mode=HTML&text=$mensaje";
	file_get_contents($url);
}

function funcionid($chatId)
{
	$mensaje="Tu <b>Chat_ID</b> es:%0A<b>".$chatId."</b>";
	enviarmensaje($chatId,$mensaje);
}

function funcionsoporte($chatId)
{
	$mensaje = "Atencion a Clientes:%0Aatencionaclientes@mctec-il.com";
	enviarmensaje($chatId,$mensaje);
}

function noentiendo($chatId)
{
	$mensaje = "No te entiendo, puedes repetirlo?";
	enviarmensaje($chatId,$mensaje);
}

function menuprincipal($chatId)
{
	$message = "Hola, soy <b>El Asistente de MCTEC-IL</b> y te puedo indicar tu ID%0ALo necesitas para que te pueda enviar alertas.";
	$tecladoprincipal = '&reply_markup={"keyboard":[["ID"],["Soporte"]],"resize_keyboard":true}';
	$url = $GLOBALS[website].'/sendmessage?chat_id='.$chatId.'&parse_mode=HTML&text='.$message.$tecladoprincipal;
	file_get_contents($url);
}

?>

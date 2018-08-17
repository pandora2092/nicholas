<?php

$mail = "kartoteka.nikolskogo@yandex.ru"; 
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$text = htmlspecialchars($_POST['text']);

$msg = "Пользователь ".$name." оставил свои данные для связи - ".$email.'. '.'Текст сообщения: '.$text;

$subject = "Новое сообщение с сайта";

$headers = "Content-type:text/html; сharset=utf-8\r\n";
$headers .= "From: webmaster@example.com\r\n";
$headers .= "Reply-To: webmaster@example.com\r\n";

mail($mail, $subject, $msg, $headers);?>
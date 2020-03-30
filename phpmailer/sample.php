<?php
	include 'phpmailer.php';
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	
	$content = '<strong>wooe</strong>';
	$MailParam = array(
		'EmailTo' => 'her0satr@gmail.com',
		'EmailFrom' => 'no-reply@duniakarir.com',
		'EmailFromName' => 'Dunia Karir',
		'EmailSubject' => 'Test Cooe',
		'EmailBody' => $content,
		'Attachment' => array(
			'/home/shoperin/public_html/duniadb.com/_temp/image_01.jpg',
			'/home/shoperin/public_html/duniadb.com/_temp/image_02.jpg'
		)
	);
	$result = SmtpMailer($MailParam);
	print_r($result);
?>
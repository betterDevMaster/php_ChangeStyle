<?php
$to='developergreat11@gmail.com,shahyan@shahyan.com';
$subject='Testing Email';
$message ="Hello";
$from = "illbuy<alert@illbuy.it>";
$headers="MIME-Version:1.0\r\n";
$headers.="Content-Type:text/html;charset=iso-8859-1\r\n";
$headers.="Content-Transfer-Encoding: 7bit\r\n";
$headers.= "From:" . $from;
$mail=mail($to,$subject,$message,$headers);
if($mail)
echo "Mail Sent";
else
echo "Not Fine";

?>
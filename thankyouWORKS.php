<?php
	session_start();
	
	$_SESSION['data'] = $_GET['data'];//* This if condition will remove after checkout page will come
	include('db.php');
	session_start();
	//print_r($_SESSION);
	$_SESSION['transaction_id'] = "0";
	/** Commented Due to remove checkout.
//	if($_GET['checkout_id'] == $_SESSION['transaction_id'])
//	{
	 *
	 */

	/**
	 * This if condition will remove after checkout page will come
	 */
	if(isset($_GET['data']) && !empty($_GET['data'])){
		$price = intval(str_replace(",","",str_replace("$","",$_SESSION['data']['price'])));
		$comments = mysql_escape_string($_SESSION['data']['comments']);
		mysql_query("INSERT INTO listings (make,model,fromYear,toYear,price,comments,firstName,lastName,phoneNumber,email,checkout_id,zip_code)
		VALUES ('".mysql_escape_string($_SESSION['data']['make'])."','".mysql_escape_string($_SESSION['data']['model'])."','".mysql_escape_string($_SESSION['data']['fromYear'])."','".mysql_escape_string($_SESSION['data']['toYear'])."'".
		",'".mysql_escape_string($price)."','".$comments."','".mysql_escape_string($_SESSION['data']['firstName'])."','".mysql_escape_string($_SESSION['data']['lastName'])."'".
		",'".mysql_escape_string($_SESSION['data']['phoneNumber'])."','".mysql_escape_string($_SESSION['data']['email'])."','".mysql_escape_string($_SESSION['transaction_id'])."','".mysql_escape_string($_SESSION['data']['zip_code'])."')");


		


		$_SESSION['transaction_id'] = 0;
		


$from = "alert@illbuy.it";
$to = $_SESSION['data']['email'];
$subject = 'Your illbuyit submission for '.$_SESSION['data']['make'].' '.$_SESSION['data']['model'];
$body = 'Hey '.$_SESSION['data']['firstName'].'!<br><br>

First and foremost, thank you for using illbuy.it! We are a startup company based out of Santa Monica, CA and we operate within Edmunds.com. My name is Sheezan Jivani and I am the founder of illbuy.it. I wanted to touch base with you and let you know that we are currently looking for your (Make and Model of car) and will be in touch soon!
<br><br>
Regards,<br><br><table border="0" cellspacing="5" cellpadding="5" align="left" style="font-family:Verdana,Arial,Helvetica,sans-serif">
<tbody><tr><td><img src="http://www.illbuy.it/create/images/left.jpg" alt=""></td><td colspan="2"><b><font color="#6aa84f">SALIM JIVANI</font>&nbsp;</b><b><font color="#20124d">| COO</font></b><br>

<span style="color:rgb(102,102,102)"><a href="mailto:Salim@illbuy.it" style="color:rgb(17,85,204)" target="_blank">Salim@illbuy.it</a><br><a value="+12142887765" style="color:rgb(17,85,204)">469.831.3893</a><br><a href="http://illbuy.it/" style="color:rgb(17,85,204)" target="_blank">www.illbuy.it</a></span></td>

</tr><tr><td colspan="3"><img src="http://www.illbuy.it/create/images/bottom.jpg" alt=""></td></tr></tbody></table>';

$host = "ssl://smtp.googlemail.com";
$port = "465";
$username = "alert@illbuy.it";
$password = 'TgTzasBZ';

//$headers = array ('From' => $from,
//  'To' => $to,
//  'Subject' => $subject);

//$smtp =& Mail::factory('smtp',
//  array ('host' => $host,
//    'port' => $port,
//    'auth' => true,
//    'username' => $username,
//    'password' => $password));
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <'.$from.'>' . "\r\n";
$headers .= 'Cc: shahyan@illbuy.it,salim@illbuy.it' . "\r\n";

mail($to,$subject,$body,$headers);
$_SESSION['data'] = '';
//require_once "Mail.php";


//$mail = $smtp->send($recipients, $headers, $body);




		exit;
	}// * This if condition will remove after checkout page will come


	/** Commented Due to remove checkout.
//	}
	 * 
	 */
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" type="text/css" href="style/main.css" />
		<link rel="stylesheet" type="text/css" href="fonts/gothic/gothic.css" />
		<link rel="stylesheet" type="text/css" href="fonts/gothicb/gothicb.css" />
		<link rel="stylesheet" type="text/css" href="fonts/gothicbi/gothicbi.css" />
		<link rel="stylesheet" type="text/css" href="fonts/gothici/gothici.css" />
	</head>
	<body>
		<div id="thanksSection" class="questionContainer" style="display: block; opacity: 1.0;">
			<div class="questionHeaderContainer">
				<div class="questionHeader">
					<div class="questionLogo">
						<img src="images/logo.jpg" />
					</div>
					
					<div class="questions">
						<div class="question">
							<div class="questionName">MAKE</div>
							<div class="makeChoosen questionAnswer"><?=$_SESSION['data']['make']?></div>
						</div>
						<div class="question">
							<div class="questionName">MODEL</div>
							<div class="modelChoosen questionAnswer"><?=$_SESSION['data']['model']?></div>
						</div>
						<div class="question">
							<div class="questionName">YEAR</div>
							<div class="choosenYear questionAnswer"><?=$_SESSION['data']['fromYear']?>-<?=$_SESSION['data']['toYear']?></div>
						</div>
						<div class="question">
							<div class="questionName">PRICE</div>
							<div class="choosenPrice questionAnswer"><?=$_SESSION['data']['price']?></div>
						</div>
						<div class="question">
						</div>
					</div>
				</div>
			</div>
			
			<div class="lblQuestionContainer">
				<div class="lblQuestion" style="font-size: 35pt;">
					<span style="color: rgb(96, 188, 88);">THANK YOU!</span>
					</br>
					</br>
					TIME TO SIT BACK AND LET US FIND YOUR CAR FOR YOU. 
				</div>
			</div>
			
			<div id="greenCarContainer">
				<div id="greenCar">
					<img src="images/greencar.png" />
				</div>
			</div>
			
			<div id="finalMessage">
				WE AIM TO HELP YOU AS MUCH AS WE</br>
				CAN. IF YOU NEED ANY HELP, EMAIL US AT:</br>
				<span style="color: rgb(96, 188, 88);">SUPPORT@ILLBUY.IT</span>
			</div>
			
		</div>
		
		<div id="footerContainer">
			<div id="footer">© 2014 illbuy.it LLC. All Rights Reserved.</div>
		</div>
	</body>
</html>
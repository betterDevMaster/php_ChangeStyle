<?php
	session_start();
	include 'phpmailer/phpmailer.php';
	
	$_SESSION['data'] = $_GET['data'];//* This if condition will remove after checkout page will come
	include('db.php');
	$_SESSION['transaction_id'] = "0";
	
	if (isset($_GET['data']) && !empty($_GET['data'])) {
		$make = (isset($_GET['make'])) ? $_GET['make'] : $_SESSION['data']['make'];
		$model = (isset($_GET['model'])) ? $_GET['model'] : $_SESSION['data']['model'];
		$firstName = (isset($_GET['firstName'])) ? $_GET['firstName'] : $_SESSION['data']['firstName'];
		
		$price = intval(str_replace(",","",str_replace("$","",$_SESSION['data']['price'])));
		$comments = mysql_escape_string($_SESSION['data']['comments']);
		mysql_query("INSERT INTO listings (make,model,fromYear,toYear,price,comments,firstName,lastName,phoneNumber,email,checkout_id,zip_code,contactMethod)
		VALUES ('".mysql_escape_string($make)."','".mysql_escape_string($model)."','".mysql_escape_string($_SESSION['data']['fromYear'])."','".mysql_escape_string($_SESSION['data']['toYear'])."'".
		",'".mysql_escape_string($price)."','".$comments."','".mysql_escape_string($firstName)."','".mysql_escape_string($_SESSION['data']['lastName'])."'".
		",'".mysql_escape_string($_SESSION['data']['phoneNumber'])."','".mysql_escape_string($_SESSION['data']['email'])."','".mysql_escape_string($_SESSION['transaction_id'])."','".mysql_escape_string($_SESSION['data']['zip_code'])."','".mysql_escape_string($_SESSION['data']['contactMethod'])."')");
		
		$_SESSION['transaction_id'] = 0;
		
		$from = "alert@illbuy.it";
		$to = $_SESSION['data']['email'];
		$subject = 'Your illbuyit submission for '.$make.' '.$model;
		$body = 'Hey '.$firstName.'!<br><br>

First and foremost, thank you for using illbuy.it! We are a startup company based out of Santa Monica, CA and we operate within Edmunds.com. My name is Sheezan Jivani and I am the founder of illbuy.it. I wanted to touch base with you and let you know that we are currently looking for your '.$make.' '.$model.' and will be in touch soon!
<br><br>
Regards,<br><br><table border="0" cellspacing="5" cellpadding="5" align="left" style="font-family:Verdana,Arial,Helvetica,sans-serif">
<tbody><tr><td><img src="http://www.illbuy.it/create/images/left.jpg" alt=""></td><td colspan="2"><b><font color="#6aa84f">SALIM JIVANI</font>&nbsp;</b><b><font color="#20124d">| COO</font></b><br>

<span style="color:rgb(102,102,102)"><a href="mailto:Salim@illbuy.it" style="color:rgb(17,85,204)" target="_blank">Salim@illbuy.it</a><br><a value="+12142887765" style="color:rgb(17,85,204)">469.831.3893</a><br><a href="http://illbuy.it/" style="color:rgb(17,85,204)" target="_blank">www.illbuy.it</a></span></td>

</tr><tr><td colspan="3"><img src="http://www.illbuy.it/create/images/bottom.jpg" alt=""></td></tr></tbody></table>';
		
		// testing
//		$to = 'her0satr@gmail.com';
		
		// email config
		$username = "alert@illbuy.it";
		$password = 'TgTzasBZ';
		$title_replay = 'ill buy it';
		$email_replay = 'alert@illbuy.it';
		
		
		$method = 'smtp';
		if ($method == 'smtp') {
			$host = "smtp.gmail.com";
			$port = "465";
			
			$mail             = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host       = "illbuy.it";			// SMTP server
			$mail->SMTPDebug  = 1;                     	// enables SMTP debug information (for testing)
														// 1 = errors and messages
														// 2 = messages only
			$mail->SMTPAuth   = true;                  	// enable SMTP authentication
			$mail->SMTPSecure = "ssl";                 	// sets the prefix to the servier
			$mail->Host       = $host;      			// sets GMAIL as the SMTP server
			$mail->Port       = $port;                  // set the SMTP port for the GMAIL server
			$mail->Username   = $username;  			// GMAIL username
			$mail->Password   = $password;            	// GMAIL password
			
			$mail->SetFrom($email_replay, $title_replay);
			$mail->AddReplyTo($email_replay, $title_replay);
			$mail->Subject    = $subject;
			$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
			$mail->MsgHTML($body);
			$mail->AddAddress($to, '');
			if (!$mail->Send()) {
				echo "Mailer Error: " . $mail->ErrorInfo;
				exit;
			} else {
				echo "Message sent!";
			}
		}
		else if ($method == 'mail_curl') {
			$param['subject'] = $subject;
			$param['content'] = $body;
			$param['host'] = 'illbuy.it';
			$param['username'] = $username;
			$param['password'] = $password;
			$param['email_to_name'] = $to;
			$param['email_to_address'] = $to;
			$param['email_from_name'] = $title_replay;
			$param['email_from_address'] = $email_replay;
			$result = mail_curl($param);
		}
		else {
			$headers  = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// More headers
			$headers .= 'From: <'.$from.'>' . "\r\n";
			$headers .= 'Cc: shahyan@illbuy.it; salim@illbuy.it' . "\r\n";
			$result = mail($to, $subject, $body, $headers);
			$_SESSION['data'] = '';
		}
		
		echo 'mail it.';
		exit;
	}
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
						<img src="images/logo.jpg" width="134px"/>
					</div>
					
					<div class="questions">
						<div class="question">
							<div class="questionName">MAKE</div>
							<div class="makeChoosen questionAnswer"><?=$make?></div>
						</div>
						<div class="question">
							<div class="questionName">MODEL</div>
							<div class="modelChoosen questionAnswer"><?=$model?></div>
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
				<div class="lblQuestion" style="font-size: 31pt;">
					<span style="color: rgb(96, 188, 88);">THANK YOU!</span>
					</br>
					</br>
					TIME TO SIT BACK AND LET US FIND YOUR CAR FOR YOU.
					</br>
					SELLERS WILL NOW COMPLETE FOR YOUR BUSINESS AND CONTACT YOU AS SOON AS THEY HAVE A MATCH.
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
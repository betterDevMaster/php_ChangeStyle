<?php
	include("db.php");

	// get page data
	$page_data = array( 'set_data' => false );
	$array_link = explode('/', $_SERVER['REQUEST_URI']);
	if (count($array_link) >= 4) {
		$page_data['set_data'] = true;
		$page_data['make'] = urldecode($array_link[2]);
		$page_data['model'] = urldecode($array_link[3]);
		$page_data['zip'] = $array_link[4];
	}

	$result = mysql_query("SELECT * FROM listing_cost") or die(mysql_error());

	$row = mysql_fetch_array( $result );
	$cost = $row[0];
?>
<!DOCTYPE html>
<html>
	<head>
		<base href="/create/" />

		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="style/normalize.css" />
		<link rel="stylesheet" type="text/css" href="style/main.css" />
		<link rel="stylesheet" type="text/css" href="fonts/gothic/gothic.css" />
		<link rel="stylesheet" type="text/css" href="fonts/gothicb/gothicb.css" />
		<link rel="stylesheet" type="text/css" href="fonts/gothicbi/gothicbi.css" />
		<link rel="stylesheet" type="text/css" href="fonts/gothici/gothici.css" />
		<script type="text/javascript" src="https://www.wepay.com/js/iframe.wepay.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="scripts/jquery.scrollTo.min.js"></script>
		<script type="text/javascript" src="scripts/jquery.validate.min.js"></script>
		<script type="text/javascript" src="scripts/main.js"></script>
	</head>
	<body>
		<div style="display: none;">
			<div class="cnt-data"><?php echo json_encode($page_data); ?></div>
		</div>

		<div id="headerContainer">
			<div id="header">
				<div id="logo">
					<img src="images/logo.jpg" style="width: 140px;" />
				</div>
				<div id="poweredBy">
					<img src="images/poweredby.jpg" />
				</div>
				<div id="menuItems">
					<div class="menuItem">HOME</div>

					<div class="menuItem">VIDEO</div>


					<div class="menuItem">OUR PROCESS</div>


					<div class="menuItem">ABOUT US</div>

					<div class="menuItem">CONTACT US</div>

					<div class="menuItem">LOGIN</div>
				</div>
			</div>
		</div>

		<div id="subHeaderContainer">
		        <input type="hidden" id="default_model" value="<?php echo $_GET['model']?>" >
			<input type="hidden" id="default_make" value="<?php echo $_GET['make']?>" >
			<input type="hidden" id="default_zip_code" value="<?php echo $_GET['zip_code']?>" >
			<div id="subHeader">
				WELCOME TO ILLBUY.IT!
				</br>
				OUR BEST FRIEND, EDMUNDS.COM JUST TOLD US YOU
				</br>
				NEEDED SOME HELP FINDING A CAR. THIS IS WHAT WE <span style="color: #61B946;">DO</span>.
			</div>
		</div>

		<div id="thirdHeaderContainer">
			<div id="thirdHeader">
				<!--
				<div id="thirdHeaderSubSlogan">
					LET US FIND YOUR PERFECT CAR AT YOUR PERFECT PRICE IN <span style="color: #60BC58;">7</span> DAYS.
				</div>
				<div id="thirdHeaderSubText">&nbsp;</div>
				-->
				
				<div id="steps">
					<div id="step1">
						<div id="lblStep1"><span style="color: rgb(255, 255, 255); font-size: 19pt; margin-right: 10px;">Step 1</span> Describe Your Perfect Car</div>
						<div id="step1Desc">
							<div id="carImg">
								<img src="images/car.png" />
							</div>
							<div id="lblStep1Desc">
							Tell us exactly what you're looking for in your ideal car and how much you want to pay.
							</div>
						</div>
					</div>
					<div id="step2">
						<div id="lblStep2"><span style="color: rgb(255, 255, 255); font-size: 19pt; margin-right: 80px;">Step 2</span> Get An Alert</div>
						<div id="step2Desc">
							<div id="phoneImg">
								<img src="images/phone.png" />
							</div>
							<div id="lblStep2Desc">
							Verified sellers by sending you offers for vehicles that meet your criteria.
							</div>
						</div>
					</div>
					<div id="step3">
						<div id="lblStep3"><span style="color: rgb(255, 255, 255); font-size: 19pt; margin-right: 61px;">Step 3</span> Drive Home Happy</div>
						<div id="step3Desc">
							<div id="keyImg">
								<img src="images/key.png" />
							</div>
							<div id="lblStep3Desc">
							Meet up for a test drive. If everything checks out, you just got a new ride at a great price, without the migraines
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="makeContainer">
			<div id="make">
				<div id="lblMake">THE <span style="color: #60BC58;">MAKE</span> OF YOUR CAR IS...</div>
				<div id="makeOptionItems">
					<div class="makeOption">
						ACURA
					</div>
					<div class="makeOption">
						DODGE
					</div>
					<div class="makeOption">
						JAGUAR
					</div>
					<div class="makeOption">
						MERCEDES
					</div>
					<div class="makeOption">
						SMART
					</div>

					<div class="makeOption">
						AUDI
					</div>
					<div class="makeOption">
						FIAT
					</div>
					<div class="makeOption">
						JEEP
					</div>
					<div class="makeOption">
						MINI
					</div>
					<div class="makeOption">
						SUBARU
					</div>

					<div class="makeOption">
						BMW
					</div>
					<div class="makeOption">
						FORD
					</div>
					<div class="makeOption">
						KIA
					</div>
					<div class="makeOption">
						MITSUBISHI
					</div>
					<div class="makeOption">
						SUZUKI
					</div>

					<div class="makeOption">
						BUICK
					</div>
					<div class="makeOption">
						GMC
					</div>
					<div class="makeOption">
						LAND ROVER
					</div>
					<div class="makeOption">
						NISSAN
					</div>
					<div class="makeOption">
						TESLA
					</div>

					<div class="makeOption">
						CADILLAC
					</div>
					<div class="makeOption">
						HONDA
					</div>
					<div class="makeOption">
						LEXUS
					</div>
					<div class="makeOption">
						PORCHE
					</div>
					<div class="makeOption">
						TOYOTA
					</div>

					<div class="makeOption">
						CHEVROLET
					</div>
					<div class="makeOption">
						HYUNDAI
					</div>
					<div class="makeOption">
						LINCOLN
					</div>
					<div class="makeOption">
						RAM
					</div>
					<div class="makeOption">
						VOLKSWAGEN
					</div>

					<div class="makeOption">
						CHRYLER
					</div>
					<div class="makeOption">
						INFINITI
					</div>
					<div class="makeOption">
						MAZDA
					</div>
					<div class="makeOption">
						SCION
					</div>
					<div class="makeOption">
						VOLVO
					</div>
				</div>
			</div>
		</div>

		<div id="modelSection" class="questionContainer">
			<div class="questionHeaderContainer">
				<div class="questionHeader">
					<div class="questionLogo">
						<img src="images/logo.jpg" />
					</div>

					<div class="questions">
						<div class="question">
							<div class="questionName">MAKE</div>
							<div class="makeChoosen questionAnswer">ACURA</div>
						</div>
						<div class="question">
							<div class="questionName">MODEL</div>
							<div class="questionAnswer"></div>
						</div>
						<div class="question">
							<div class="questionName">YEAR</div>
							<div class="questionAnswer"></div>
						</div>
						<div class="question">
							<div class="questionName">PRICE</div>
							<div class="questionAnswer"></div>
						</div>
						<div class="question">
						</div>
					</div>
				</div>
			</div>

			<div class="lblQuestionContainer">
				<div class="lblQuestion">
					GOT IT.  WHAT KIND OF <span class="makeChoosen">ACURA</span> DO YOU WANT?
				</div>
			</div>

			<div id="modelOptions">
				<div class="modelContainer">
					<div class="model">CL</div>
					<div class="model">LEGEND</div>
					<div class="model">RDX</div>
					<div class="model">RSX</div>
					<div class="model">ILX</div>
					<div class="model">MDX</div>
					<div class="model">RL</div>
					<div class="model">TL</div>
					<div class="model">INTEGRA</div>
					<div class="model">NSX</div>
					<div class="model">RLX</div>
					<div class="model">TSX</div>
				</div>
			</div>

			<div class="btnGoBackContainer">
				<div class="btnGoBack">
					<img src="images/btn_goback.png" />
				</div>
			</div>
		</div>

		<div id="yearSection" class="questionContainer">
			<div class="questionHeaderContainer">
				<div class="questionHeader">
					<div class="questionLogo">
						<img src="images/logo.jpg" />
					</div>

					<div class="questions">
						<div class="question">
							<div class="questionName">MAKE</div>
							<div class="makeChoosen questionAnswer">ACURA</div>
						</div>
						<div class="question">
							<div class="questionName">MODEL</div>
							<div class="modelChoosen questionAnswer">TL</div>
						</div>
						<div class="question">
							<div class="questionName">YEAR</div>
							<div class="questionAnswer"></div>
						</div>
						<div class="question">
							<div class="questionName">PRICE</div>
							<div class="questionAnswer"></div>
						</div>
						<div class="question">
						</div>
					</div>
				</div>
			</div>

			<div class="lblQuestionContainer">
				<div class="lblQuestion">
					<span style="font-size: 33pt;">GREAT CHOICE.  WHAT YEAR <span class="makeChoosen">ACURA</span> <span class="modelChoosen">TL</span> DO YOU WANT?</span>
				</div>
			</div>

			<div id="yearContainer">
				<div id="year">
					<div class="yearContainer">
						<div class="lblYear">BEGINNING YEAR</div>
						<div class="yearValueContainer">
							<div id="fromYearValue" class="yearValue">
								2004
							</div>
							<div class="yearArrow">
								<img src="images/year_arrow.png" />
							</div>
							<div id="fromYearOptions" class="yearOptions">
								<div class="yearOption">2004</div>
								<div class="yearOption">2004</div>
								<div class="yearOption">2004</div>
								<div class="yearOption">2004</div>
								<div class="yearOption">2004</div>
								<div class="yearOption">2004</div>
							</div>
						</div>
					</div>
					<div id="lblTo">
						TO
					</div>
					<div class="yearContainer">
						<div class="lblYear">ENDING YEAR</div>
						<div class="yearValueContainer">
							<div id="toYearValue" class="yearValue">
								2008
							</div>
							<div class="yearArrow">
								<img src="images/year_arrow.png" />
							</div>
							<div id="toYearOptions" class="yearOptions">
								<div class="yearOption">2004</div>
								<div class="yearOption">2004</div>
								<div class="yearOption">2004</div>
								<div class="yearOption">2004</div>
								<div class="yearOption">2004</div>
								<div class="yearOption">2004</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div id="btnYearNextContainer">
				<div id="btnYearNext">
					NEXT
				</div>
			</div>

			<div class="btnGoBackContainer" style="margin-top: 100px;">
				<div class="btnGoBack">
					<img src="images/btn_goback.png" />
				</div>
			</div>
		</div>

		<div id="priceSection" class="questionContainer">
			<div class="questionHeaderContainer">
				<div class="questionHeader">
					<div class="questionLogo">
						<img src="images/logo.jpg" />
					</div>

					<div class="questions">
						<div class="question">
							<div class="questionName">MAKE</div>
							<div class="makeChoosen questionAnswer">ACURA</div>
						</div>
						<div class="question">
							<div class="questionName">MODEL</div>
							<div class="modelChoosen questionAnswer">TL</div>
						</div>
						<div class="question">
							<div class="questionName">YEAR</div>
							<div class="choosenYear questionAnswer">2004-2008</div>
						</div>
						<div class="question">
							<div class="questionName">PRICE</div>
							<div class="questionAnswer"></div>
						</div>
						<div class="question">
						</div>
					</div>
				</div>
			</div>

			<div class="lblQuestionContainer">
				<div class="lblQuestion">
					AWESOME. HOW MUCH WOULD <span style="color: #61BA46;">YOU</span> LIKE TO PAY FOR YOUR <span class="choosenYear">2004-2007</span> <span class="makeChoosen">ACURA</span> <span class="modelChoosen">TL</span>?
				</div>
			</div>

			<div id="priceContainer">
				<div id="price">
					<div id="lblMaxPrice">MAXIMUM PRICE</div>
					<div id="priceValueContainer">
						<form id="priceForm">
							<div id="priceValue"><input type="text" value="" required /></div>
						</form>
					</div>
					<div id="btnPriceNext">NEXT</div>
				</div>
			</div>

			<div id="edmundPriceContainer">
				<div id="edmundPrice">
					<div id="lblHelp">WANT SOME HELP? HERE'S THE EDMUNDS TRUE MARKET VALUE FOR YOUR CAR</div>
					<div id="priceTable">
						<div class="edmundPriceItem edmundPriceItemActive">YEAR</div>
						<div id="tmvYear1" class="edmundPriceItem edmundPriceItemActive"></div>
						<div id="tmvYear2" class="edmundPriceItem edmundPriceItemActive"></div>
						<div id="tmvYear3" class="edmundPriceItem edmundPriceItemActive"></div>
						<div id="tmvYear4" class="edmundPriceItem edmundPriceItemActive"></div>
						<div class="edmundPriceItem edmundPriceItemActive">TRADE IN</div>
						<div id="tmvTradeIn1" class="edmundPriceItem"></div>
						<div id="tmvTradeIn2" class="edmundPriceItem"></div>
						<div id="tmvTradeIn3" class="edmundPriceItem"></div>
						<div id="tmvTradeIn4" class="edmundPriceItem"></div>
						<div class="edmundPriceItem edmundPriceItemActive">PRIVATE PARTY</div>
						<div id="tmvPrivateParty1" class="edmundPriceItem "></div>
						<div id="tmvPrivateParty2"  class="edmundPriceItem"></div>
						<div id="tmvPrivateParty3"  class="edmundPriceItem"></div>
						<div id="tmvPrivateParty4"  class="edmundPriceItem"></div>
						<div class="edmundPriceItem edmundPriceItemActive">DEALER RETAIL</div>
						<div id="tmvDealerRetail1" class="edmundPriceItem"></div>
						<div id="tmvDealerRetail2" class="edmundPriceItem"></div>
						<div id="tmvDealerRetail3" class="edmundPriceItem"></div>
						<div id="tmvDealerRetail4" class="edmundPriceItem"></div>
					</div>
				</div>
			</div>

			<div class="btnGoBackContainer">
				<div class="btnGoBack">
					<img src="images/btn_goback.png" />
				</div>
			</div>
		</div>

		<div id="anythingElseSection" class="questionContainer">
			<div class="questionHeaderContainer">
				<div class="questionHeader">
					<div class="questionLogo">
						<img src="images/logo.jpg" />
					</div>

					<div class="questions">
						<div class="question">
							<div class="questionName">MAKE</div>
							<div class="makeChoosen questionAnswer">ACURA</div>
						</div>
						<div class="question">
							<div class="questionName">MODEL</div>
							<div class="modelChoosen questionAnswer">TL</div>
						</div>
						<div class="question">
							<div class="questionName">YEAR</div>
							<div class="choosenYear questionAnswer">2004-2008</div>
						</div>
						<div class="question">
							<div class="questionName">PRICE</div>
							<div class="choosenPrice questionAnswer">$12,000</div>
						</div>
						<div class="question">
						</div>
					</div>
				</div>
			</div>

			<div class="lblQuestionContainer">
				<div class="lblQuestion" style="text-align: left;">
					GREAT! ANYTHING ELSE WE SHOULD KNOW?
					</br>
					<span style="color: rgb(96, 188, 88); font-size: 21pt;">(I.E. EXTERIOR COLOR, NAVIGATION SYSTEM, ETC.)</span>
				</div>
				<div id="anythingElseContainer">
					<div id="anythingElseBox">
						<textarea></textarea>
					</div>
					<div id="anythingElseNext">NEXT</div>
				</div>

			</div>


			<div class="btnGoBackContainer">
				<div class="btnGoBack">
					<img src="images/btn_goback.png" />
				</div>
			</div>
		</div>

		<div id="contactSection" class="questionContainer">
			<div class="questionHeaderContainer">
				<div class="questionHeader">
					<div class="questionLogo">
						<img src="images/logo.jpg" />
					</div>

					<div class="questions">
						<div class="question">
							<div class="questionName">MAKE</div>
							<div class="makeChoosen questionAnswer">ACURA</div>
						</div>
						<div class="question">
							<div class="questionName">MODEL</div>
							<div class="modelChoosen questionAnswer">TL</div>
						</div>
						<div class="question">
							<div class="questionName">YEAR</div>
							<div class="choosenYear questionAnswer">2004-2008</div>
						</div>
						<div class="question">
							<div class="questionName">PRICE</div>
							<div class="choosenPrice questionAnswer">$12,000</div>
						</div>
						<div class="question">
						</div>
					</div>
				</div>
			</div>

			<div class="lblQuestionContainer">
				<div class="lblQuestion" style="font-size: 26pt;">
					YOU MAKE GREAT DECISIONS. WE CAN'T WAIT TO GET STARTED.
					</br>
					</br>
					WHEN WE FIND YOUR <span style="color: rgb(96, 188, 88);">PERFECT</span> CAR, HOW SHOULD WE CONTACT YOU?
				</div>
			</div>

			<div id="contactFormContainer">
				<div id="contactForm">
					<form id="cForm">
						<div class="fieldContainer">
							<div class="fieldLabel">FIRST NAME</div>
							<div class="fieldInput">
								<input id="txtFN" type="text" required />
							</div>
						</div>

						<div class="fieldContainer">
							<div class="fieldLabel">LAST NAME</div>
							<div class="fieldInput">
								<input id="txtLN" type="text" required />
							</div>
						</div>

						<div class="fieldContainer">
							<div class="fieldLabel">PHONE NUMBER</div>
							<div class="fieldInput">
								<input id="txtPhone" type="text" required />
							</div>
						</div>
						<div class="fieldContainer">
							<div class="fieldLabel">EMAIL ADDRESS</div>
							<div class="fieldInput">
								<input id="txtEmail" type="email" required />
							</div>
						</div>
						<div class="fieldContainer">
							<div class="fieldLabel">ZIP CODE</div>
							<div class="fieldInput">
								<input id="txtZipCode" type="zip_code" required />
							</div>
						</div>

						<div id="doneButtonContainer">
							<div id="doneButton">NEXT</div>
						</div>
					</form>
				</div>
			</div>

			<div class="btnGoBackContainer">
				<div class="btnGoBack">
					<img src="images/btn_goback.png" />
				</div>
			</div>
		</div>
		<div id="paymentSection" class="questionContainer">
			<div class="questionHeaderContainer">
				<div class="questionHeader">
					<div class="questionLogo">
						<img src="images/logo.jpg" />
					</div>

					<div class="questions">
						<div class="question">
							<div class="questionName">MAKE</div>
							<div class="makeChoosen questionAnswer">ACURA</div>
						</div>
						<div class="question">
							<div class="questionName">MODEL</div>
							<div class="modelChoosen questionAnswer">TL</div>
						</div>
						<div class="question">
							<div class="questionName">YEAR</div>
							<div class="choosenYear questionAnswer">2004-2008</div>
						</div>
						<div class="question">
							<div class="questionName">PRICE</div>
							<div class="choosenPrice questionAnswer">$12,000</div>
						</div>
						<div class="question">
						</div>
					</div>
				</div>
			</div>

			<div id="paymentContainer">
				<iframe id="paymentFrame">
				</iframe>
			</div>


		</div>

		<div id="thanksSection" class="questionContainer">
			<div class="questionHeaderContainer">
				<div class="questionHeader">
					<div class="questionLogo">
						<img src="images/logo.jpg" />
					</div>

					<div class="questions">
						<div class="question">
							<div class="questionName">MAKE</div>
							<div class="makeChoosen questionAnswer">ACURA</div>
						</div>
						<div class="question">
							<div class="questionName">MODEL</div>
							<div class="modelChoosen questionAnswer">TL</div>
						</div>
						<div class="question">
							<div class="questionName">YEAR</div>
							<div class="choosenYear questionAnswer">2004-2008</div>
						</div>
						<div class="question">
							<div class="questionName">PRICE</div>
							<div class="choosenPrice questionAnswer">$12,000</div>
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
<?php
	include("db.php");
	
	$result = mysql_query("SELECT * FROM listing_cost") or die(mysql_error());  
	
	$row = mysql_fetch_array( $result );
	$cost = $row[0];
	
	session_start();
	
	$_SESSION['transaction_id'] = 
	
	include('wepay.php');
	
	 // application settings
    $account_id = 1392523817 ; // your app's account_id
    $client_id = 16851;
    $client_secret = "37629e9d30";
    $access_token = "STAGE_4ddcca455efa7086f92a50c6fe076b4db7381c035f9fca6366403e9fc40cb7cc"; // your app's access_token

    // change to useProduction for live environments
    Wepay::useStaging($client_id, $client_secret);

    $wepay = new WePay($access_token);

	$wepay->production = false;
    // create the checkout
	
	
    $response = $wepay->request('checkout/create',array(
        'account_id'        => $account_id,
        'amount'            => $cost,
        'short_description' => 'Service to find good car for customer',
        'type'              => 'SERVICE',
		'mode'				=> 'iframe',
		'redirect_uri'		=> 'http://illbuy.it/create/thankyou.php',
		'fee_payer'			=> 'payee'
    ));
	

    // display the response
    //print_r($response);

	$_SESSION['transaction_id'] = $response->checkout_id;
	$_SESSION['data'] = $_GET['data'];
	
	echo $response->checkout_uri;
?>
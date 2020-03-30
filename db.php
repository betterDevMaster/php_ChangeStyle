<?php
	//database connection adn schema constants
	define('DB_HOST', 'localhost');
	define('DB_USER', 'illbuyit_prodadm');
	define('DB_PASSWORD', 'Cn;!!r$ZSVhg');
	define('DB_SCHEMA', 'illbuyit_prod_ads');

	//establish a connection to the database server

	$dbconnect = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die('Unable to Connect.');

	mysql_select_db(DB_SCHEMA, $dbconnect) or die(mysql_error($dbconnect));
?>
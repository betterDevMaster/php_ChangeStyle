<?php
$api_key = "r2ch7gdgj28pa4j7dpkrc94g";
error_reporting(E_ALL);
ini_set('display_errors','On');
	
	if(isset($_GET['get_makes']))
	{
		$url = "https://api.edmunds.com/api/vehicle/v2/makes?fmt=json&api_key=".$api_key;
		print_r(get($url));
	}
	else if(isset($_GET['get_tmv']))
	{
		$results = array();
		$years = explode(',',$_GET['years']);
		$years = array_slice($years, 0, 4);
		foreach($years as $year)
		{
			if(!empty($year))
			{
				$url = "https://api.edmunds.com/api/vehicle/v2/{$_GET['make']}/{$_GET['model']}/{$year}?fmt=json&api_key=".$api_key;
				$styles = get($url);
				/*echo "</br>";
				echo "</br>";
				echo $styles;
				echo "</br>";
				echo "</br>";*/
				$styles = json_decode($styles);
				if(property_exists($styles,'styles'))
				{
					$styleId = $styles->styles[0]->id;
					$url = "https://api.edmunds.com/v1/api/tmv/tmvservice/calculateusedtmv?styleid={$styleId}&condition=Clean&mileage=30000&zip=90034&fmt=json&api_key=".$api_key;
					$result = json_decode(get($url));
					$results[$year] = $result;
					usleep(0.8 * 1000000);
				}
			}
		}
		
		print_r(json_encode($results));
	}
	
	
	function get($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$result = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		return $result;
	}

?>
<?php
//Require twitter oauth
require_once('config.php');

//Work out the number of keys and requests per second
if (!isset($tokens) && count($tokens) == 0) {
	die("No tokens specified");
}
$requestSleepTime = (int)(3600 / (count($tokens) * 5000));

//Create the adapter
require('Adapter/' . $adapterClass . '.php');
$adapterClass = 'Adapter_' . $adapterClass;
$adapter = new $adapterClass;

//Setup
$adapter->setup();

//Try
try {

	//Last request time
	$lastEvent = 0;
	
	//Loop until the cursor is 0
	while(true) {
		
		//Send to the DataSift API and return the hash
		$url = 'https://api.github.com/events?page=1&per_page=100&rand=' . rand(0, 100000);
		
		//Add access token
		$url .= '&access_token' . $tokens[array_rand($tokens)];

		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,  true);
		curl_setopt($ch,CURLOPT_URL,             $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
		//execute post
		$result = curl_exec($ch);

		//close connection
		curl_close($ch);

		//Convert json response
		$json = json_decode($result, true);

		//Lowest time
		$lowestTime = 0;
		
		//Loop through each event in reverse and push to the adapter
		for($i=count($json)-1; $i>=0; $i--) {
			//Get the event
			$event = $json[$i];
			$eventTime = strtotime($event['created_at']);
			
			//Process if the event is new
			if ($eventTime > $lastEvent) {
				$adapter->push($event);
			}
			
			//Get the lowest time from the request
			if ($lowestTime < $eventTime) {
				$lowestTime = $eventTime;
			}
			
		}
		
		//Set the last event
		$lastEvent = $lowestTime;
		
		//Sleep
		echo "Sleeping\n";
		usleep($requestSleepTime * 1000000);
		
	}
	
} catch (Exception $e) {
	//Finished
	$adapter->setup();
}


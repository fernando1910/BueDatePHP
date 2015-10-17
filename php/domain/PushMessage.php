<?php

	require_once 'vendor/autoload.php';
	use Endroid\Gcm\Client;
		
	class PushMessage{
		
	
		function enviarNotificacao($title,$message, $deviceIds){
			$apiKey = 'AIzaSyA6zRqDYctHHthxLbJVpKOrnuZj5VNUlgk';
			$client = new Client($apiKey);
			$registrationIds = array(
'clG3NHiLw9Y:APA91bEDc4QHzj3ErrNQ3cLjuczEyZLKjq0NQLuwIKUNivVLklTvFfdBMInOEKp4OWshZKNyiV2aAfNRoFiPVlvv9qNmVqNe780-TEu46T4RF6QgI13VfKtJvlM0zCFTpV9STgVFmWdF'
			);
			
			$data = array(
				'title' => $title,
				'message' => $message,
			);
			
			$client->send($data, $registrationIds);		
			$responses = $client->getResponses();
			return var_dump($responses); 
			
		}
	
	}
	
?>
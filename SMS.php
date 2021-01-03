<?php

$basic  = new \Nexmo\Client\Credentials\Basic('faee239e', 'Song4cr0UOe7oBsx');
$client = new \Nexmo\Client($basic);

$message = $client->message()->send([
    'to' => '16194319439',
    'from' => '17202219439',
    'text' => 'Hello from Vonage'
]);

?>
<?php
// require firebase library
require_once 'firebase/firebaseLib.php';

// create a firebase instance
$firebase = new Firebase('https://vskype.firebaseio.com/btc_usd','bcwy4lyI7bwI8J1IpWhJxR1hsFQjNEkfEtPYWK34');

// $url = 'https://localbitcoins.com/bitcoinaverage/ticker-all-currencies/';
$url = 'https://blockchain.info/ticker';
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$response = json_decode(curl_exec($curl));
// print_r($response->USD->last);exit;
$firebase->set('price', $response->USD->last);

curl_close($curl);
?>

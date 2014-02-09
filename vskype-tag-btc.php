<?php
// require firebase library
require_once 'firebase/firebaseLib.php';

// create a firebase instance
$firebase = new Firebase('https://vskype.firebaseio.com/tag_btc','bcwy4lyI7bwI8J1IpWhJxR1hsFQjNEkfEtPYWK34');

$url = 'http://www.cryptocoincharts.info/v2/api/tradingPair/TAG_BTC';
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$response = json_decode(curl_exec($curl));
$firebase->set('price', $response->price);

curl_close($curl);
?>
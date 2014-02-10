<?php
// require firebase library
require_once 'firebase/firebaseLib.php';

// create a firebase instance
$firebase = new Firebase('https://vskype.firebaseio.com/usd_currency/','bcwy4lyI7bwI8J1IpWhJxR1hsFQjNEkfEtPYWK34');

$url = 'http://openexchangerates.org/api/latest.json?app_id=94a3503931494c4381bc59a7bd89cde3';
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$response = json_decode(curl_exec($curl));

foreach($response->rates as $key=>$value){
    $arr[]=array('currency_code'=>$key, 'rate'=>$value);
}

$count = count($arr);
for($i=0; $i<$count; $i++){
    $firebase = new Firebase('https://vskype.firebaseio.com/usd_currency/data/'.$i);
    $firebase->set('currency_code', $arr[$i]['currency_code']);
    $firebase->set('rate', $arr[$i]['rate']);
}

curl_close($curl);
?>

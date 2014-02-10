<?php
// require firebase library
require_once 'firebase/firebaseLib.php';

$url = 'http://openexchangerates.org/api/currencies.json?app_id=94a3503931494c4381bc59a7bd89cde3';
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$response = json_decode(curl_exec($curl));

foreach($response as $key=>$value){
    $arr[]=array('currency_code'=>$key, 'currency_name'=>$value);
}

$count = count($arr);
for($i=0; $i<$count; $i++){
    $firebase = new Firebase('https://vskype.firebaseio.com/currencies/data/'.$i);
    $firebase->set('currency_name', $arr[$i]['currency_name']);
    $firebase->set('currency_code', $arr[$i]['currency_code']);
}

curl_close($curl);
?>

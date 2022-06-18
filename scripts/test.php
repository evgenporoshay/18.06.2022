<?php


$url = 'http://trainer.rdl-telecom.com/api/auth';
$data = array("login" => 'e.poroshay@rdl-telecom.com',"password" => 'ecb6f21a9849256d');
$postdata = json_encode($data);

$ch = curl_init($url); 
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, '/home/bitrix/www/scripts/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, '/home/bitrix/www/scripts/cookie.txt');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
$result = curl_exec($ch);

curl_close($ch);
print_r ($result);
?>
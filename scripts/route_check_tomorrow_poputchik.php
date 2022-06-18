<?php

set_time_limit(600);

$db_host='localhost'; // ваш хост
$db_name='sitemanager'; // ваша бд
$db_user='bitrix0'; // пользователь бд
$db_pass='MDiyWby(sfjfi_FRplwd'; // пароль к бд
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);// включаем сообщения об ошибках
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name); // коннект с сервером бд
$mysqli->set_charset("utf8mb4"); // задаем кодировку


$Date = date("Y-m-d H:i:s");


$result = $mysqli->query("SELECT STR_TO_DATE(depart, '%Y-%m-%dT%H:%i:%s') AS date FROM select_table 
WHERE depart >'$Date' + interval 1 day 
AND type = 'SPECIAL'"); // запрос на выборку
$count = mysqli_num_rows($result); // количество строк в запросе

$mysqli->close();

$t = intval($count);
echo $t;

$token='1223485972:AAEzNc9_JevZungd2XPFbdYjbRYHJRx1788';
$chat_id='-1001336320068';
$telegram_bad = array("Рейсы на завтра не выгружены " . "@Dimanche912" . " " . "@RDL_Telecom");
$telegram_good = array("Рейсы на завтра выгружены успешно");
$text = $telegram_bad[0];
$text2 = $telegram_good[0];


$ch=curl_init();
curl_setopt($ch, CURLOPT_URL,'https://api.telegram.org/bot'.$token.'/sendMessage');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS,'chat_id='.$chat_id.'&text='.urlencode($text));
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);

$ch1=curl_init();
curl_setopt($ch1, CURLOPT_URL,'https://api.telegram.org/bot'.$token.'/sendMessage');
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch1, CURLOPT_HEADER, false);
curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch1, CURLOPT_POST, true);
curl_setopt($ch1, CURLOPT_POSTFIELDS,'chat_id='.$chat_id.'&text='.urlencode($text2));
curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, 60);


if ($t > 30) {
   
$result1=curl_exec($ch1);

} else  $result2=curl_exec($ch); 


curl_close($ch);
curl_close($ch1);


?>
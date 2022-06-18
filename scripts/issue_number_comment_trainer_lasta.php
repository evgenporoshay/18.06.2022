<?php

// подключение к базе данных
$host = 'localhost'; // ваш хост
$user = 'bitrix0'; // пользователь бд
$pass = 'VwAR1{2[(?1[{iRLqCLz'; // пароль к бд
$db_name = 'sitemanager'; // ваша бд
$link = mysqli_connect($host, $user, $pass, $db_name); // Соединяемся с базой

// Ругаемся, если соединение установить не удалось
if (!$link) {
    echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
    exit;
}


$query4 = mysqli_query($link, "SELECT bcd.ID
    FROM b_crm_deal bcd
    WHERE bcd.STAGE_ID = 'C35:NEW' /* Тут мы делаем запрос на стадии новой заявки СТП */
    AND bcd.DATE_CREATE >= DATE_SUB(NOW(), INTERVAL 21605 SECOND);");

while($row4 = $query4->fetch_assoc())

$deal_id .= $row4['ID'];


$query6 = mysqli_query($link, "SELECT title FROM b_crm_deal WHERE id = '$deal_id'");

while($row6 = $query6->fetch_assoc())

$title .= $row6['title'];//тут мы получили год постройки вагона $carriage


$query7 = mysqli_query($link, "SELECT UF_CRM_1610721066423 FROM b_uts_crm_deal WHERE VALUE_ID = '$deal_id'");

while($row7 = $query7->fetch_assoc())

$route .= $row7['UF_CRM_1610721066423'];

$s_title = '"' . $title . '"';

$i_route = (int) $route;





$url2 = 'http://trainer.rdl-telecom.com/api/add_comment';
$data2 = array("route_id" => $i_route,"comment" => $title);
$postdata2 = json_encode($data2);

$ch2 = curl_init($url2); 
curl_setopt($ch2, CURLOPT_POST, 1);
curl_setopt($ch2, CURLOPT_POSTFIELDS, $postdata2);
curl_setopt($ch2, CURLOPT_COOKIEFILE, '/home/bitrix/www/scripts/cookie.txt');
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
$result2 = curl_exec($ch2);

curl_close($ch2);
print_r ($result);
mysqli_close($link);

?>

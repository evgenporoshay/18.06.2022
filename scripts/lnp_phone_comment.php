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


$query1 = mysqli_query($link, "SELECT bcd.ID
   FROM b_crm_deal bcd
    WHERE bcd.STAGE_ID = 'C34:NEW' /* Тут мы делаем запрос на стадии новой заявки СТП */
   AND bcd.DATE_CREATE >= DATE_SUB(NOW(), INTERVAL 21610 SECOND);");

while($row = $query1->fetch_assoc())

$deal_id .= $row['ID'];

 $query2 = mysqli_query($link, "SELECT UF_CRM_1610721027831 FROM b_uts_crm_deal WHERE VALUE_ID = '$deal_id' ");

while($row2 = $query2->fetch_assoc())


$date .= $row2['UF_CRM_1610721027831'];



/* получаем номер вагона из вновь созданной заявки (возможно уменьшить до 1 секунды?)*/
$query3 = mysqli_query($link, "

   SELECT UF_CRM_1594368335083
    FROM b_uts_crm_deal bucr
    JOIN b_crm_deal bcm ON 
    bcm.id = bucr.VALUE_ID 
    WHERE bcm.STAGE_ID = 'C34:NEW' /* Тут мы делаем запрос на стадии новой заявки СТП */
    AND bcm.DATE_CREATE >= DATE_SUB(NOW(), INTERVAL 21610 SECOND);");

while($row3 = $query3->fetch_assoc())

$carriage .= $row3['UF_CRM_1594368335083']; //тут мы получили номер вагона и поместили его в переменную $carriage
    //echo $carriage;




$url = 'https://sumrv.rdl-telecom.com/api/sumrv-1/routes/test_journal/' . $date;

$handle = curl_init($url);
// Will return the response, if false it prints the response
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($handle, CURLOPT_URL,$url);
// Execute the session and store the contents in $result

$Json = file_get_contents($url);
$myarray = json_decode($Json, true);

$t = $myarray['routes'];

$id = $carriage;

foreach ($t as $item) {

	if ($item['head_carriage'] == $id) {

		$el = $item;

		break;

	}

}


$title =  'По данным из СУМРВ от ' . $el['lnp_data_update'] . ' ЛНП: ' . $el['lnp_full_name'] . ' ' . $el['lnp_phone'];









$query7 = mysqli_query($link, "SELECT UF_CRM_1610721066423 FROM b_uts_crm_deal WHERE VALUE_ID = '$deal_id'");

while($row7 = $query7->fetch_assoc())

$route .= $row7['UF_CRM_1610721066423'];


$u = $el['lnp_phone'];

$o = (string)$u;

$i_route = (int) $route;



if (!empty($o)) {



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





$query4 = mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_5EE5F20A2719A = '$title' WHERE VALUE_ID = '$deal_id' LIMIT 1 ");

    } else {
        $query8 = mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_5EE5F20A2719A = 'Нет данных в СУМРВ' WHERE VALUE_ID = '$deal_id' LIMIT 1 ");
    }






curl_close($ch2);

mysqli_close($link);

?>



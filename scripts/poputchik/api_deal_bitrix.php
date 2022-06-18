<?php

define('SECRET_CODE', 'h899tjypxvkv2iae'); # секретный код вебхука uemssigq7winpix1

define('PORTAL', 'http://bitrix.rdl-telecom.ru'); # адрес  CRM

define('USER_ID', 96); # ID администратора портала и владельца вебхука 310

define('ASSIGNED_BY_ID', 96); # ID ответсвенного

define('STAGE_ID', 'C14:NEW'); # Стадия сделки "СТП"

define('CATEGORY_ID', '14'); # Воронка Попутчик

define('UF_CRM_1650004861312', 26); # Выставляем классификацию "Портал "Попутчик""

define('UF_CRM_1650007980763', 34); #Выставляем стандартный приоритет

$fileds = [

	'route' => 'UF_CRM_1650006598799', // рейс UF_CRM_1610720954927

	'route_id' => 'UF_CRM_1650004947115', // id рейса UF_CRM_1610721066423

	'train' => 'UF_CRM_1650003076612', // Штабной вагон № UF_CRM_1594368335083

	'vpn_ip' => 'UF_CRM_1650006659710', // ip passline UF_CRM_1610720982799

	'equipment' => 'UF_CRM_1650040674815', // Оборудование UF_CRM_1610721010343

	'station_of_departure' => 'UF_CRM_1650006678598', // Станция отправления UF_CRM_1610720884862

	'depart' => 'UF_CRM_1650006700934', // Время отправления UF_CRM_1610721027831

	'station_of_arrival' => 'UF_CRM_1650006719974', // Станция прибытия UF_CRM_1610720933389

	'arrive' => 'UF_CRM_1650006738038', // Время прибытия UF_CRM_1610721048895

	

];

#$arr = json_decode(file_get_contents('http://trainer.rdl-telecom.com/select_table'), true);

$id = intval($_GET['id']);
if (empty($id)) {
	exit;
}



// подключение к базе данных
$host = 'localhost'; // ваш хост
$user = 'bitrix0'; // пользователь бд
$pass = 'MDiyWby(sfjfi_FRplwd'; // пароль к бд
$db_name = 'sitemanager'; // ваша бд
$link = mysqli_connect($host, $user, $pass, $db_name); // Соединяемся с базой

// Ругаемся, если соединение установить не удалось
if (!$link) {
    echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
    exit;
}


$q1 = mysqli_query($link, "SELECT id FROM select_table WHERE id = '$id'");
while($row = $q1->fetch_assoc())
$route .= $row['id'];


$q2 = mysqli_query($link, "SELECT train FROM select_table WHERE id = '$id'");
while($row = $q2->fetch_assoc())
$train .= $row['train'];


$q3 = mysqli_query($link, "SELECT vpn_ip FROM select_table WHERE id = '$id'");
while($row = $q3->fetch_assoc())
$vpn_ip .= $row['vpn_ip'];


$q4 = mysqli_query($link, "SELECT equipment FROM select_table WHERE id = '$id'");
while($row = $q4->fetch_assoc())
$equipment .= $row['equipment'];

$q5 = mysqli_query($link, "SELECT station_of_departure FROM select_table WHERE id = '$id'");
while($row = $q5->fetch_assoc())
$station_of_departure .= $row['station_of_departure'];

$q6 = mysqli_query($link, "SELECT depart FROM select_table WHERE id = '$id'");
while($row = $q6->fetch_assoc())
$depart .= $row['depart'];

$q7 = mysqli_query($link, "SELECT station_of_arrival FROM select_table WHERE id = '$id'");
while($row = $q7->fetch_assoc())
$station_of_arrival .= $row['station_of_arrival'];

$q8 = mysqli_query($link, "SELECT arrive FROM select_table WHERE id = '$id'");
while($row = $q8->fetch_assoc())
$arrive .= $row['arrive'];

$q9 = mysqli_query($link, "SELECT route FROM select_table WHERE id = '$id'");
while($row = $q9->fetch_assoc())
$route_name .= $row['route'];


$title = 'ФПК ' . $train . '/' . $equipment . '/(' . $vpn_ip . ') Рейс: ' . $route_name . ', Прибывает: ' . $arrive . ' в ' . $station_of_arrival. '';

#$title = 'ФПК ' . $el['train'] . '/' . $el['equipment'] . '/(' . $el['vpn_ip'] . ') Рейс: ' . $el['route'] . ', Прибывает: ' . $el['arrive'] . ' в ' . $el['station_of_arrival']. '';

$params_bx24 = [

	'fields' => [

		'TITLE' => $title,

		'STAGE_ID' => STAGE_ID,
		
		'ASSIGNED_BY_ID' => ASSIGNED_BY_ID,

		'CATEGORY_ID' => CATEGORY_ID,

		'UF_CRM_1650007980763' => UF_CRM_1650007980763,

		   'UF_CRM_1650004861312' => UF_CRM_1650004861312,
		   


		$fileds['route'] => $route_name,

		$fileds['route_id'] => $id,

		$fileds['train'] => $train,

		$fileds['vpn_ip'] => $vpn_ip,

		$fileds['equipment'] => $equipment,

		$fileds['station_of_departure'] => $station_of_departure,

		$fileds['depart'] => $depart,

		$fileds['station_of_arrival'] => $station_of_arrival,

		$fileds['arrive'] => $arrive,

		
	]
];

$add_task = bx24($params_bx24, 'crm.deal.add');



function bx24($params_bx24, $type) {

	$queryUrl = PORTAL . '/rest/' . USER_ID . '/' . SECRET_CODE . '/' . $type;

	$queryData = http_build_query(

		$params_bx24

	);

	

	$curl = curl_init();

	curl_setopt_array($curl, array(

		CURLOPT_SSL_VERIFYPEER => 0,

		CURLOPT_POST => 1,

		CURLOPT_HEADER => 0,

		CURLOPT_FOLLOWLOCATION => 0,

		CURLOPT_RETURNTRANSFER => 0,

		CURLOPT_URL => $queryUrl,

		CURLOPT_POSTFIELDS => $queryData,

	));





	$result = curl_exec($curl);

	curl_close($curl);


}



/* получаем номер вагона из вновь созданной заявки (возможно уменьшить до 1 секунды?)*/
$query1 = mysqli_query($link, "

    SELECT bcd.ID
    FROM b_crm_deal bcd
    WHERE bcd.STAGE_ID = 'C14:NEW' /* Тут мы делаем запрос на стадии новой заявки СТП */
    AND bcd.DATE_CREATE >= DATE_SUB(NOW(), INTERVAL 10 SECOND);");

while($row = $query1->fetch_assoc())

$deal_id .= $row['ID'];

$query2 = mysqli_query($link, "

    UPDATE b_uts_crm_deal set UF_CRM_1650006738038 = STR_TO_DATE(UF_CRM_1650006738038, '%Y-%m-%dT%H:%i:%s') where VALUE_ID = '$deal_id' limit 1");


/*$query6 = mysqli_query($link, "SELECT STR_TO_DATE(UF_CRM_1610721048895, '%Y-%m-%dT%H:%i:%s') AS date FROM b_uts_crm_deal WHERE VALUE_ID = '$deal_id'");

while($row6 = $query6->fetch_assoc())

$date_of_repair .= $row6['date'];



$query7 = mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1638820849485 = '$date_of_repair' where VALUE_ID = '$deal_id' ");

$query8 = mysqli_query($link, "UPDATE b_uts_crm_deal SET `UF_CRM_1611413941886` = ADDDATE(`UF_CRM_1638820849485`, INTERVAL 4 HOUR)
WHERE VALUE_ID = '$deal_id' ");*/

header("Location: https://bitrix.rdl-telecom.ru/crm/deal/details/$deal_id/");
mysqli_close($link);

//require_once '/home/bitrix/www/scripts/poputchik/header.php';

?>
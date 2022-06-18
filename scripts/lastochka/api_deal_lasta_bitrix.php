<?php

define('SECRET_CODE', 'h899tjypxvkv2iae'); # секретный код вебхука hdm0h95xstcrn8sk

define('PORTAL', 'https://bitrix.rdl-telecom.ru'); # адрес  CRM

define('USER_ID', 96); # ID администратора портала и владельца вебхука 310

define('ASSIGNED_BY_ID', 96); # ID ответсвенного

define('STAGE_ID', 'C15:NEW'); # Стадия сделки "СТП"

define('CATEGORY_ID', '15'); # Воронка Ласточка

define('UF_CRM_1613688412817', "Заявка заведена по скрипту"); #Оставляем LastComment



$fileds = [

	'route' => 'UF_CRM_1650006598799', 

	'route_id' => 'UF_CRM_1650004947115', 

	'train' => 'UF_CRM_1650017062861', // Номер состава № UF_CRM_1611906935280

	'station_of_departure' => 'UF_CRM_1650006678598', // Станция отправления UF_CRM_1610720884862

	'depart' => 'UF_CRM_1650006700934', // Время отправления UF_CRM_1610721027831

	'station_of_arrival' => 'UF_CRM_1650006719974', // Станция прибытия UF_CRM_1610720933389

	'arrive' => 'UF_CRM_1650006738038', // Время прибытия UF_CRM_1610721048895

	'auth_count' => 'UF_CRM_1650018509156', // Авторизованных пользователей UF_CRM_1635595990592
	
	'net_traffic_auth' => 'UF_CRM_1650018582581', // Авторизованный трафик UF_CRM_1635596006021

	'net_users' => 'UF_CRM_1650018461564', // Авторизованных пользователей UF_CRM_1635595990592
	
	'net_traffic' => 'UF_CRM_1650018540438', // Авторизованный трафик UF_CRM_1635596006021

	'carrier' => 'UF_CRM_1650017418593', // Принадлежность рейса

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

$q10 = mysqli_query($link, "SELECT net_traffic_auth FROM select_table WHERE id = '$id'");
while($row = $q10->fetch_assoc())
$net_traffic_auth .= $row['net_traffic_auth'];

$q11 = mysqli_query($link, "SELECT auth_count FROM select_table WHERE id = '$id'");
while($row = $q11->fetch_assoc())
$auth_count .= $row['auth_count'];

$q12 = mysqli_query($link, "SELECT net_users FROM select_table WHERE id = '$id'");
while($row = $q12->fetch_assoc())
$net_users .= $row['net_users'];

$q13 = mysqli_query($link, "SELECT net_traffic FROM select_table WHERE id = '$id'");
while($row = $q13->fetch_assoc())
$net_traffic .= $row['net_traffic'];

$q14 = mysqli_query($link, "SELECT carrier FROM select_table WHERE id = '$id'");
while($row = $q14->fetch_assoc())
$carrier .= $row['carrier'];

$title = 'ЛАСТОЧКИ' . '  '. $train . ' ' . ' Рейс: ' . $route_name . ', Прибывает: ' . $arrive . ' в ' . $station_of_arrival. '';

#$title = 'ЛАСТОЧКИ' . '  '. $el['train'] . ' ' . ' Рейс: ' . $el['route'] . ', Прибывает: ' . $el['arrive'] . ' в ' . $el['station_of_arrival']. '';

$marshroot = $station_of_departure . '-' . $station_of_arrival;


$params_bx24 = [

	'fields' => [

		'TITLE' => $title,

		'STAGE_ID' => STAGE_ID,
		
		'ASSIGNED_BY_ID' => ASSIGNED_BY_ID,

		'CATEGORY_ID' => CATEGORY_ID,


	      'UF_CRM_1650017273518' => $marshroot,
	      
	      


		$fileds['route'] => $route_name,

		$fileds['route_id'] => $id,

		$fileds['train'] => $train,

		$fileds['station_of_departure'] => $station_of_departure,

		$fileds['depart'] => $depart,

		$fileds['station_of_arrival'] => $station_of_arrival,

		$fileds['arrive'] => $arrive,

		$fileds['auth_count'] => $auth_count,

		$fileds['net_traffic_auth'] => $net_traffic_auth,

		$fileds['net_users'] => $net_users,

		$fileds['net_traffic'] => $net_traffic,

		$fileds['carrier'] => $carrier,


	],
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
    WHERE bcd.STAGE_ID = 'C15:NEW' /* Тут мы делаем запрос на стадии новой заявки СТП */
    AND bcd.DATE_CREATE >= DATE_SUB(NOW(), INTERVAL 10 SECOND);");

while($row = $query1->fetch_assoc())

$deal_id .= $row['ID'];

header("Location: https://bitrix.rdl-telecom.ru/crm/deal/details/$deal_id/");


mysqli_close($link);
//require_once '/home/bitrix/www/scripts/lastochka/header.php';

?>
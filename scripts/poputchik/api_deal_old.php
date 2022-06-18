<?php

define('SECRET_CODE', 'hdm0h95xstcrn8sk'); # секретный код вебхука hdm0h95xstcrn8sk

define('PORTAL', 'https://bitrix.rdl-telecom.com'); # адрес  CRM

define('USER_ID', 291); # ID администратора портала и владельца вебхука 310

define('ASSIGNED_BY_ID', 291); # ID ответсвенного

define('STAGE_ID', 'C34:NEW'); # Стадия сделки "СТП"

define('CATEGORY_ID', '34'); # Воронка Попутчик

define('UF_CRM_1600528308', 3635); # Выставляем классификацию "Портал "Попутчик""

define('UF_CRM_1611866060129', "false"); # (Сделка отклонена?)

define('UF_CRM_1611865891850', "false"); # (Сделка закрыта) 

define('UF_CRM_1613688412817', "Заявка заведена по скрипту"); #Оставляем LastComment

define('UF_CRM_1611864420209', "true"); # (Сделка в Попутчике)

define('UF_CRM_1610614286', 24007); #Выставляем стандартный приоритет

$fileds = [

	'route' => 'UF_CRM_1610720954927', // рейс UF_CRM_1610720954927

	'route_id' => 'UF_CRM_1610721066423', // id рейса UF_CRM_1610721066423

	'train' => 'UF_CRM_1594368335083', // Штабной вагон № UF_CRM_1594368335083

	'vpn_ip' => 'UF_CRM_1610720982799', // ip passline UF_CRM_1610720982799

	'equipment' => 'UF_CRM_1610721010343', // Оборудование UF_CRM_1610721010343

	'station_of_departure' => 'UF_CRM_1610720884862', // Станция отправления UF_CRM_1610720884862

	'depart' => 'UF_CRM_1610721027831', // Время отправления UF_CRM_1610721027831

	'station_of_arrival' => 'UF_CRM_1610720933389', // Станция прибытия UF_CRM_1610720933389

	'arrive' => 'UF_CRM_1610721048895', // Время прибытия UF_CRM_1610721048895

	

];

$arr = json_decode(file_get_contents('http://trainer.rdl-telecom.com/select_table'), true);

$id = intval($_GET['id']);
if (empty($id)) {
	exit;
}

foreach ($arr as $item) {

	if ($item['id'] == $id) {

		$el = $item;

		break;

	}

}

# ФПК train/equipment(vpn_ip)Рейс:route,Прибывает: arrive в station_of_arrival :

# ФПК 061-17170/incarnet 411(192.168.218.246)Рейс:702Н,Прибывает: 2020-09-26 06:38:00 в АСТРАХАНЬ 1 :

$title = 'ФПК ' . $el['train'] . '/' . $el['equipment'] . '/(' . $el['vpn_ip'] . ') Рейс: ' . $el['route'] . ', Прибывает: ' . $el['arrive'] . ' в ' . $el['station_of_arrival']. '';

$params_bx24 = [

	'fields' => [

		'TITLE' => $title,

		'STAGE_ID' => STAGE_ID,
		
		'ASSIGNED_BY_ID' => ASSIGNED_BY_ID,

		'CATEGORY_ID' => CATEGORY_ID,

		'UF_CRM_1600528308' => UF_CRM_1600528308,

	     'UF_CRM_1611866060129' => UF_CRM_1611866060129,

	      'UF_CRM_1611865891850' => UF_CRM_1611865891850,

	      'UF_CRM_1611864420209' => UF_CRM_1611864420209,

		   'UF_CRM_1610614286' => UF_CRM_1610614286,

		   'UF_CRM_1613688412817' => UF_CRM_1613688412817,	


		$fileds['route'] => $el['route'],

		$fileds['route_id'] => $el['id'],

		$fileds['train'] => $el['train'],

		$fileds['vpn_ip'] => $el['vpn_ip'],

		$fileds['equipment'] => $el['equipment'],

		$fileds['station_of_departure'] => $el['station_of_departure'],

		$fileds['depart'] => $el['depart'],

		$fileds['station_of_arrival'] => $el['station_of_arrival'],

		$fileds['arrive'] => $el['arrive'],

		
	],
];

$add_task = bx24($params_bx24, 'crm.deal.add');

if (!empty($add_task['result']['task']['id'])) {

	$response = [

		'status' => 'success',

		'id' => $add_task['result']['task']['id'],

];

	header('Content-Type: text/html; charset=utf-8');
	header('Content-Type: application/json');
	print json_encode($response, JSON_PRETTY_PRINT);
}

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

		CURLOPT_RETURNTRANSFER => 0,

		CURLOPT_URL => $queryUrl,

		CURLOPT_POSTFIELDS => $queryData,

	));



 

	$result = curl_exec($curl);

	curl_close($curl);


}

header("Location: https://bitrix.rdl-telecom.com/crm/deal/category/34/");

?>
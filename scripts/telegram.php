<?php


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

# Гнатовский (Попутчик)
$result = $link->query(
    "SELECT 
VALUE_ID,
b_crm_deal.TITLE,
UF_CRM_1611413941886

FROM b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '17' AND CLOSED = 'N' AND STAGE_ID != 'WON' AND STAGE_ID != 'LOSE'
#AND CATEGORY_ID = '24' #ТОИТ
AND CATEGORY_ID = '34' #Попутчик
#AND CATEGORY_ID = '35'  #Ласточки
ORDER BY UF_CRM_1611413941886 ASC"
); // запрос на выборку


while($row = $result->fetch_assoc())// получаем все строки в цикле по одной
{
	$message .= 'Заявка '  . $row['VALUE_ID'] . "\n" . $row['TITLE'] . "\n" .  'Крайний срок:' .
		$row['UF_CRM_1611413941886'] .  "\n" . 'Ссылка: http://bitrix.rdl-telecom.com/crm/deal/details/'  . $row['VALUE_ID'] . '/' . "\n" . "\n"  ;
}
$dt = date('d/m/Y');
$telegram =array("
Заявки по проекту Попутчик
Ответственный: Гнатовский Андрей


$message         
");


#$telegram[0];
// Токен бота и идентификатор чата
$token='1223485972:AAEzNc9_JevZungd2XPFbdYjbRYHJRx1788';
$chat_id='268453774';

// Текст сообщения
$text= $telegram[0];
// Отправить сообщение
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL,
    'https://api.telegram.org/bot'.$token.'/sendMessage');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS,
    'chat_id='.$chat_id.'&text='.urlencode($text));
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);


// Отправить сообщение
$result=curl_exec($ch);
curl_close($ch);
?>

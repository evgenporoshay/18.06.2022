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
    "SELECT b_crm_deal.id, b_crm_timeline.CREATED, b_user.NAME AS 'NAME', b_user.LAST_NAME AS 'LAST_NAME', b_crm_timeline.COMMENT AS 'COMMENT', b_crm_deal.TITLE, UF_CRM_1611413941886, b_crm_deal.STAGE_ID, b_crm_deal.ASSIGNED_BY_ID
FROM b_crm_timeline
JOIN b_crm_timeline_bind ON
b_crm_timeline_bind.owner_id = b_crm_timeline.id
JOIN b_crm_deal ON
b_crm_timeline_bind.ENTITY_ID = b_crm_deal.ID
JOIN b_uts_crm_deal ON
b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
JOIN b_user ON
b_crm_timeline.AUTHOR_ID = b_user.ID
AND b_crm_deal.ASSIGNED_BY_ID = '27'
AND b_crm_timeline.CREATED >= DATE_SUB(NOW(), INTERVAL 21605 SECOND)
LIMIT 1

"
); // запрос на выборку

$count = mysqli_num_rows($result); // количество строк в запросе


while($row = $result->fetch_assoc())// получаем все строки в цикле по одной
{
  $message .= 'заявка '  . $row['id'] . "\n" .  "\n" . $row['TITLE'] . "\n" . "\n" .
  'Ссылка: http://bitrix.rdl-telecom.com/crm/deal/details/'  . $row['id'] . '/' . "\n" . "\n"  ;
}
$dt = date('d/m/Y');
$telegram =array("
На вас назначена $message
");


#$telegram[0];
// Токен бота и идентификатор чата
$token='1223485972:AAEzNc9_JevZungd2XPFbdYjbRYHJRx1788';
$chat_id='525847319';

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


if ($count) {

  // Отправить сообщение
$result=curl_exec($ch);
curl_close($ch);
}

else {

  die;
}
mysqli_close($link);

?>

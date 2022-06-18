<?php


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

# Гнатовский (Попутчик)
$result = $link->query(
    "SELECT
         UF_CRM_1650018274186 as 'id',
         UF_CRM_1653046364364  as 'nakl_vozvr',
         UF_CRM_1653068385110 as 'neispr'
 from b_uts_crm_deal bucd
 join b_crm_deal bcd on bcd.id = bucd.VALUE_ID 
WHERE bcd.STAGE_ID = 'C3:PREPAYMENT_INVOICE'
AND bcd.DATE_MODIFY >= DATE_SUB(NOW(), INTERVAL 15 SECOND)"); // запрос на выборку

$count = mysqli_num_rows($result); // количество строк в запросе


while($row = $result->fetch_assoc())// получаем все строки в цикле по одной
{
  $message .= 'по заявке '  . $row['id'] . "\n" .  "\n" . 'Описание неисправности: ' . $row['neispr'] . "\n" . "\n" .
   'Заявка: http://bitrix.rdl-telecom.ru/crm/deal/details/'  . $row['id'] . '/' .
   " " . 'Отслеживание: https://www.cse.ru/mow/track/?numbers='  . $row['nakl_vozvr'] . '/' . "\n" . "\n"  ;
}
$dt = date('d/m/Y');
$telegram =array("
Отправлено оборудование из СЦ $message
");


#$telegram[0];
// Токен бота и идентификатор чата
$token='1223485972:AAEzNc9_JevZungd2XPFbdYjbRYHJRx1788';
$chat_id='77399845';
//$chat_id='928161028';

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

<?php



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


$query1 = mysqli_query($link, "SELECT bcd.ID
   FROM b_crm_deal bcd
    WHERE bcd.STAGE_ID = 'C15:NEW' /* Тут мы делаем запрос на стадии новой заявки СТП */
   AND bcd.DATE_CREATE >= DATE_SUB(NOW(), INTERVAL 30 SECOND);");

while($row = $query1->fetch_assoc())

$deal_id .= $row['ID'];


$query2 = mysqli_query($link, "
SELECT min(id) as `id_zap` from b_crm_event where EVENT_TEXT_1 = 'Заявка заведена по скрипту' and DATE_CREATE >= DATE_SUB(NOW(), INTERVAL 40 SECOND)");

while($row2 = $query2->fetch_assoc())

$id_zap .= $row2['id_zap'];

$query3 = mysqli_query($link, "
SELECT CREATED_BY_ID
FROM b_crm_event bce 
WHERE id > '$id_zap'
ORDER BY id ASC
LIMIT 1");

while($row3 = $query3->fetch_assoc())

$id_user .= $row3['CREATED_BY_ID'];


$query4 = mysqli_query($link, "
SELECT CONCAT(bu.NAME,' ',bu.LAST_NAME) as `name`
from b_user bu 
where id = '$id_user'");

while($row4 = $query4->fetch_assoc())

$id_name .= $row4['name'];


$query5 = mysqli_query($link, "
UPDATE b_uts_crm_deal bucd
  SET bucd.UF_CRM_1650018642999 = (select CONCAT(bu.NAME,' ',bu.LAST_NAME) 
from b_user bu 
where id = '$id_user') where bucd.VALUE_ID = '$deal_id'
limit 1");


mysqli_close($link);
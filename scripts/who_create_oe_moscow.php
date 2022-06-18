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
    WHERE bcd.STAGE_ID = 'C35:1' /* Тут мы делаем запрос на стадии новой заявки СТП */
   AND bcd.DATE_MODIFY >= DATE_SUB(NOW(), INTERVAL 21610 SECOND);");

while($row = $query1->fetch_assoc())

$deal_id .= $row['ID'];

$query2 = mysqli_query($link, "
UPDATE b_uts_crm_deal bucd
  SET bucd.UF_CRM_1639247756423 = (SELECT CONCAT(bu.NAME,' ',bu.LAST_NAME) AS 'created'
FROM b_crm_timeline bct
JOIN b_user bu ON bu.id = bct.AUTHOR_ID 
WHERE bct.ASSOCIATED_ENTITY_ID = '$deal_id'
ORDER BY bct.id asc 
LIMIT 1,1) WHERE bucd.VALUE_ID = '$deal_id'
LIMIT 1");

mysqli_close($link);
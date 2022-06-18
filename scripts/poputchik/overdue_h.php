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

/* получаем номер вагона из вновь созданной заявки (возможно уменьшить до 1 секунды?)*/
$query1 = mysqli_query($link, "

    SELECT bcd.ID
    FROM b_crm_deal bcd
    JOIN b_uts_crm_deal bucd ON bucd.VALUE_ID = bcd.ID 
    WHERE bcd.STAGE_ID = 'C34:WON' /* Тут мы делаем запрос на стадии новой заявки СТП */
    AND bucd.UF_CRM_1611909185274 >= DATE_SUB(NOW(), INTERVAL 60 SECOND);");

while($row = $query1->fetch_assoc())

$deal_id .= $row['ID'];




$query2 = mysqli_query($link, "
	SELECT HOUR(TIMEDIFF(bucd.UF_CRM_1611413941886, UF_CRM_1611909185274)) as 'overdue_h'
FROM b_uts_crm_deal bucd
WHERE VALUE_ID = '$deal_id'");

while($row2 = $query2->fetch_assoc())

$overdue_h .= $row2['overdue_h'];


$query6 = mysqli_query($link, "
    SELECT MINUTE(TIMEDIFF(bucd.UF_CRM_1611413941886, UF_CRM_1611909185274)) as 'overdue_m'
FROM b_uts_crm_deal bucd
WHERE VALUE_ID = '$deal_id'");

while($row6 = $query6->fetch_assoc())

$overdue_m .= $row6['overdue_m'];



$query7 = mysqli_query($link, "
    SELECT bucd.UF_CRM_1611413941886
FROM b_uts_crm_deal bucd
WHERE VALUE_ID = '$deal_id'");

while($row7 = $query7->fetch_assoc())

$krsrok .= $row7['UF_CRM_1611413941886'];


$query8 = mysqli_query($link, "
    SELECT bucd.UF_CRM_1611909185274
FROM b_uts_crm_deal bucd
WHERE VALUE_ID = '$deal_id'");

while($row8 = $query8->fetch_assoc())

$datazakr .= $row8['UF_CRM_1611909185274'];


if($datazakr > $krsrok) {

    $query3 = mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1639136597022 = '$overdue_h' where VALUE_ID = '$deal_id' ");

$query4 = mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1639136614460 = '$overdue_m' where VALUE_ID = '$deal_id' ");
}

echo $krsrok;

echo $datazakr;

mysqli_close($link);

?>
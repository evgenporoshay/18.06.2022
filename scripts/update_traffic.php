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

$query = mysqli_query($link, "SELECT bcd.ID
    FROM b_crm_deal bcd
    WHERE bcd.STAGE_ID = 'C15:WON'
    AND bcd.DATE_MODIFY >= DATE_SUB(NOW(), INTERVAL 30 SECOND);");

while($row = $query->fetch_assoc())

$deal_id .= $row['ID'];


$query1 = mysqli_query($link, "SELECT bucd.UF_CRM_1650004947115 /* получаем id рейса*/
    FROM b_uts_crm_deal bucd
 WHERE bucd.VALUE_ID = '$deal_id'");

while($row1 = $query1->fetch_assoc())

$route_id .= $row1['UF_CRM_1650004947115'];


$query2 = mysqli_query($link, "SELECT STR_TO_DATE(UF_CRM_1650006738038, '%Y-%m-%dT%H:%i:%s') AS arrive 
    FROM b_uts_crm_deal bucd
 WHERE bucd.VALUE_ID = '$deal_id'");

while($row2 = $query2->fetch_assoc())

$arrive .= $row2['arrive'];

$arrive_date = strtotime($arrive); // переводит из строки в дату
$arrive_date2 = date("Y-m-d H:i:s", $arrive_date); // переводит в новый формат


$query3 = mysqli_query($link, " SELECT UF_CRM_1650006738038 AS arrive_t
 FROM b_uts_crm_deal bucd
 WHERE bucd.VALUE_ID = '$deal_id'");

while($row3 = $query3->fetch_assoc())

$arrive_t .= $row3['arrive_t'];


$currentTime = date("Y-m-d H:i:s");

$date_timestamp_1 = strtotime($arrive);
$date_timestamp_2 = strtotime($currentTime);

if ($date_timestamp_1 < $date_timestamp_2) {
    

mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1650018509156 = (SELECT auth_store FROM select_table_ar WHERE route_id = '$route_id' and arrive = '$arrive_t') WHERE b_uts_crm_deal.VALUE_ID = '$deal_id'
LIMIT 1");

mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1650018582581 = (SELECT net_traffic_auth FROM select_table_ar WHERE route_id = '$route_id' and arrive = '$arrive_t') WHERE b_uts_crm_deal.VALUE_ID = '$deal_id'
LIMIT 1");

mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1650018461564 = (SELECT net_users FROM select_table_ar WHERE route_id = '$route_id' and arrive = '$arrive_t') WHERE b_uts_crm_deal.VALUE_ID = '$deal_id'
LIMIT 1");

mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1650018540438 = (SELECT net_traffic FROM select_table_ar WHERE route_id = '$route_id' and arrive = '$arrive_t') WHERE b_uts_crm_deal.VALUE_ID = '$deal_id'
LIMIT 1");

}
else {

    mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1650018509156 = (SELECT auth_store FROM select_table WHERE route_id = '$route_id' and arrive = '$arrive_t') WHERE b_uts_crm_deal.VALUE_ID = '$deal_id'
LIMIT 1");

mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1650018582581 = (SELECT net_traffic_auth FROM select_table WHERE route_id = '$route_id' and arrive = '$arrive_t') WHERE b_uts_crm_deal.VALUE_ID = '$deal_id'
LIMIT 1");

mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1650018461564 = (SELECT net_users FROM select_table WHERE route_id = '$route_id' and arrive = '$arrive_t') WHERE b_uts_crm_deal.VALUE_ID = '$deal_id'
LIMIT 1");

mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1650018540438 = (SELECT net_traffic FROM select_table WHERE route_id = '$route_id' and arrive = '$arrive_t') WHERE b_uts_crm_deal.VALUE_ID = '$deal_id'
LIMIT 1");
}

mysqli_close($link);

?>
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
# Всего в работе
$res_open_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:NEW'
OR STAGE_ID = 'C34:PREPARATION'
OR STAGE_ID = 'C34:1'
OR STAGE_ID = 'C34:3'
OR STAGE_ID = 'C34:2'
OR STAGE_ID = 'C34:4'
");
$row_open_sum = $res_open_sum->fetch_row();
$count_open_sum = $row_open_sum[0];

# Всего просроченные
$res_dline_sum = $link->query("SELECT COUNT(*) 
FROM b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE STAGE_ID = 'C34:NEW' AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP()
OR STAGE_ID = 'C34:PREPARATION' AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP()
OR STAGE_ID = 'C34:1' AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP()
OR STAGE_ID = 'C34:2' AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP()
OR STAGE_ID = 'C34:3' AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP()");
$row_dline_sum = $res_dline_sum->fetch_row();
$count_dline_sum = $row_dline_sum[0];

# СТП в работе
$res_stpwork_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:NEW'");
$row_stpwork_sum = $res_stpwork_sum->fetch_row();
$count_stpwork_sum = $row_stpwork_sum[0];

# СТП просроченные
$res_dlinestp_sum = $link->query("SELECT COUNT(*) from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP() AND b_crm_deal.STAGE_ID = 'C34:NEW'");
$row_dlinestp_sum = $res_dlinestp_sum->fetch_row();
$count_dlinestp_sum = $row_dlinestp_sum[0];

# Сисадмины в работе
$res_sawork_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:PREPARATION'");
$row_sawork_sum = $res_sawork_sum->fetch_row();
$count_sawork_sum = $row_sawork_sum[0];

# Сисадмины просроченные
$res_sadwork_sum = $link->query("SELECT COUNT(*) from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP() AND b_crm_deal.STAGE_ID = 'C34:PREPARATION'");
$row_sadwork_sum = $res_sadwork_sum->fetch_row();
$count_sadwork_sum = $row_sadwork_sum[0];

# ОРПО в работе
$res_orpo_work_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:1'");
$row_orpo_work_sum = $res_orpo_work_sum->fetch_row();
$count_orpo_work_sum = $row_orpo_work_sum[0];

# ОРПО просроченные
$res_orpo_dwork_sum = $link->query("SELECT COUNT(*) from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP() AND b_crm_deal.STAGE_ID = 'C34:1' ");
$row_orpo_dwork_sum = $res_orpo_dwork_sum->fetch_row();
$count_orpo_dwork_sum = $row_orpo_dwork_sum[0];

# Продукты в работе
$res_prod_work_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:3'");
$row_prod_work_sum = $res_prod_work_sum->fetch_row();
$count_prod_work_sum = $row_prod_work_sum[0];

# Продукты просроченные
$res_prod_dwork_sum = $link->query("SELECT COUNT(*) from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP() AND b_crm_deal.STAGE_ID = 'C34:3'");
$row_prod_dwork_sum = $res_prod_dwork_sum->fetch_row();
$count_prod_dwork_sum = $row_prod_dwork_sum[0];

# Андрей Гнатовский в работе
$res_moskva_work_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:2'AND ASSIGNED_BY_ID = '17'");
$row_moskva_work_sum = $res_moskva_work_sum->fetch_row();
$count_moskva_work_sum = $row_moskva_work_sum[0];

# Ожидание ответа от клиента
$res_ozhid_sum = $link->query(" SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:4'");
$row_ozhid_sum = $res_ozhid_sum->fetch_row();
$count_ozhid_sum = $row_ozhid_sum[0];

# Андрей Гнатовский просроченные
$res_moskva_dwork_sum = $link->query("SELECT COUNT(*) from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '17'
AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP() AND b_crm_deal.STAGE_ID = 'C34:2'");
$row_moskva_dwork_sum = $res_moskva_dwork_sum->fetch_row();
$count_moskva_dwork_sum = $row_moskva_dwork_sum[0];

# Николай Дубель в работе
$res_vsib_work_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:2' 
  AND ASSIGNED_BY_ID = '156' ");
$row_vsib_work_sum = $res_vsib_work_sum->fetch_row();
$count_vsib_work_sum = $row_vsib_work_sum[0];

# Николай Дубель просроченные
$res_vsib_dwork_sum = $link->query("SELECT COUNT(*) from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '156'
AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP() AND b_crm_deal.STAGE_ID = 'C34:2' ");
$row_vsib_dwork_sum = $res_vsib_dwork_sum->fetch_row();
$count_vsib_dwork_sum = $row_vsib_dwork_sum[0];

# Кирилл Коротков в работе
$res_gork_work_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:2'
  AND ASSIGNED_BY_ID = '143' ");
$row_gork_work_sum = $res_gork_work_sum->fetch_row();
$count_gork_work_sum = $row_gork_work_sum[0];

# Кирилл Коротков  просроченные
$res_gork_dwork_sum = $link->query("SELECT COUNT(*) from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '143'
AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP() AND b_crm_deal.STAGE_ID = 'C34:2'");
$row_gork_dwork_sum = $res_gork_dwork_sum->fetch_row();
$count_gork_dwork_sum = $row_gork_dwork_sum[0];

# Павел Гришко в работе
$res_dvost_work_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:2'
  AND ASSIGNED_BY_ID = '167' ");
$row_dvost_work_sum = $res_dvost_work_sum->fetch_row();
$count_dvost_work_sum = $row_dvost_work_sum[0];

# Павел Гришко просроченные
$res_dvost_dwork_sum = $link->query("SELECT COUNT(*) from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '167'
AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP() AND b_crm_deal.STAGE_ID = 'C34:2'");
$row_dvost_dwork_sum = $res_dvost_dwork_sum->fetch_row();
$count_dvost_dwork_sum = $row_dvost_dwork_sum[0];


# Тимофей Енин в работе
$res_kbsh_work_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:2'
  AND ASSIGNED_BY_ID = '107' ");
$row_kbsh_work_sum = $res_kbsh_work_sum->fetch_row();
$count_kbsh_work_sum = $row_kbsh_work_sum[0];

# Тимофей Енин просроченные
$res_kbsh_dwork_sum = $link->query("SELECT COUNT(*) from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '107'
AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP() AND b_crm_deal.STAGE_ID = 'C34:2'");
$row_kbsh_dwork_sum = $res_kbsh_dwork_sum->fetch_row();
$count_kbsh_dwork_sum = $row_kbsh_dwork_sum[0];

# Дмитрий Силкин в работе
$res_priv_work_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:2'
  AND ASSIGNED_BY_ID = '99'");
$row_priv_work_sum = $res_priv_work_sum->fetch_row();
$count_priv_work_sum = $row_priv_work_sum[0];

# Дмитрий Силкин просроченные
$res_priv_dwork_sum = $link->query("SELECT COUNT(*) from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '99'
AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP() AND b_crm_deal.STAGE_ID = 'C34:2'");
$row_priv_dwork_sum = $res_priv_dwork_sum->fetch_row();
$count_priv_dwork_sum = $row_priv_dwork_sum[0];

# Андрей Вишняков в работе
$res_sev_work_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:2'
  AND ASSIGNED_BY_ID = '133'");
$row_sev_work_sum = $res_sev_work_sum->fetch_row();
$count_sev_work_sum = $row_sev_work_sum[0];

# Андрей Вишняков просроченные
$res_sev_dwork_sum = $link->query("SELECT COUNT(*) from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '133'
AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP() AND b_crm_deal.STAGE_ID = 'C34:2'");
$row_sev_dwork_sum = $res_sev_dwork_sum->fetch_row();
$count_sev_dwork_sum = $row_sev_dwork_sum[0];

# Роман Гельвельчук в работе
$res_skav_work_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:2'
  AND ASSIGNED_BY_ID = '137'");
$row_skav_work_sum = $res_skav_work_sum->fetch_row();
$count_skav_work_sum = $row_skav_work_sum[0];

# Роман Гельвельчук просроченные
$res_skav_dwork_sum = $link->query("SELECT COUNT(*) from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '137'
AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP() AND b_crm_deal.STAGE_ID = 'C34:2'");
$row_skav_dwork_sum = $res_skav_dwork_sum->fetch_row();
$count_skav_dwork_sum = $row_skav_dwork_sum[0];

# Андрей Рынков в работе
$res_ural_work_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:2'
  AND ASSIGNED_BY_ID = '27'");
$row_ural_work_sum = $res_ural_work_sum->fetch_row();
$count_ural_work_sum = $row_ural_work_sum[0];

# Андрей Рынков просроченные
$res_ural_dwork_sum = $link->query("SELECT COUNT(*) FROM b_uts_crm_deal
JOIN b_crm_deal ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '27'
AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP() AND b_crm_deal.STAGE_ID = 'C34:2'");
$row_ural_dwork_sum = $res_ural_dwork_sum->fetch_row();
$count_ural_dwork_sum = $row_ural_dwork_sum[0];


# Крайний срок сегодня:
$result = $link->query(
    "SELECT VALUE_ID FROM b_uts_crm_deal WHERE UF_CRM_1611864420209 = 'true' AND UF_CRM_1611867292691 = 'В работе' AND UF_CRM_1611413941886 BETWEEN CURRENT_TIMESTAMP() AND DATE_ADD(CURDATE(), INTERVAL 1 DAY)"
); // запрос на выборку


while ($row = $result->fetch_assoc())// получаем все строки в цикле по одной
{
  $message .= '' . $row['VALUE_ID'].' '.   "  "  ;// выводим данные

}
/* Просроченые:
$result2 = $link->query(
    "SELECT VALUE_ID
FROM b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE STAGE_ID = 'C34:NEW' AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP()
OR STAGE_ID = 'C34:PREPARATION' AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP()
OR STAGE_ID = 'C34:1' AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP()
OR STAGE_ID = 'C34:2' AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP()
OR STAGE_ID = 'C34:3' AND UF_CRM_1611413941886  < CURDATE()"); // запрос на выборку


while ($row2 = $result2->fetch_assoc())// получаем все строки в цикле по одной
{
  $message2 .=  $row2['VALUE_ID']. ' '.   "  "  ;// выводим данные

}
*/
#-----------------Просроченные заявки-------------------------------

$overdue_stp = $link->query(
    "SELECT VALUE_ID from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP() AND b_crm_deal.STAGE_ID = 'C34:NEW'"); // запрос на выборку


while ($od_stp = $overdue_stp->fetch_assoc())// получаем все строки в цикле по одной
{
  $overdue_stp_message .=  $od_stp['VALUE_ID']. ' '.   "  "  ;// выводим данные

}

$overdue_sa = $link->query(
    "SELECT VALUE_ID from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP() AND b_crm_deal.STAGE_ID = 'C34:PREPARATION'"); // запрос на выборку


while ($od_sa = $overdue_sa->fetch_assoc())// получаем все строки в цикле по одной
{
  $overdue_sa_message .=  $od_sa['VALUE_ID']. ' '.   "  "  ;// выводим данные

}

# Просроченые ОТДЕЛ РАЗРАБОТКИ ПО:
$overdue_orpo = $link->query(
    "SELECT VALUE_ID from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP() AND b_crm_deal.STAGE_ID = 'C34:1'"); // запрос на выборку


while ($od_orpo = $overdue_orpo->fetch_assoc())// получаем все строки в цикле по одной
{
  $overdue_orpo_message .=  $od_orpo['VALUE_ID']. ' '.   "  "  ;// выводим данные

}

# Просроченые ПРОДУКТЫ:
$overdue_prod = $link->query(
    "SELECT VALUE_ID from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP() AND b_crm_deal.STAGE_ID = 'C34:3'"); // запрос на выборку


while ($od_prod = $overdue_prod->fetch_assoc())// получаем все строки в цикле по одной
{
  $overdue_prod_message .=  $od_prod['VALUE_ID']. ' '.   "  "  ;// выводим данные

}

# Просроченые Андрей Гнатовский:
$overdue_moskva = $link->query(
    "SELECT VALUE_ID from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '17'
AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP() AND b_crm_deal.STAGE_ID = 'C34:2'"); // запрос на выборку


while ($od_moskva = $overdue_moskva->fetch_assoc())// получаем все строки в цикле по одной
{
  $overdue_moskva_message .=  $od_moskva['VALUE_ID']. ' '.   "  "  ;// выводим данные

}

# Просроченые Николай Дубель:
$overdue_vsib = $link->query(
    "SELECT VALUE_ID from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '156'
AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP() AND b_crm_deal.STAGE_ID = 'C34:2'"); // запрос на выборку


while ($od_vsib = $overdue_vsib->fetch_assoc())// получаем все строки в цикле по одной
{
  $overdue_vsib_message .=  $od_vsib['VALUE_ID']. ' '.   "  "  ;// выводим данные

}


# Просроченые Кирилл Коротков:
$overdue_gork = $link->query(
    "SELECT VALUE_ID from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '143'
AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP() AND b_crm_deal.STAGE_ID = 'C34:2'"); // запрос на выборку


while ($od_gork = $overdue_gork->fetch_assoc())// получаем все строки в цикле по одной
{
  $overdue_gork_message .=  $od_gork['VALUE_ID']. ' '.   "  "  ;// выводим данные

}

# Просроченые Павел Гришко:
$overdue_dvost = $link->query(
    "SELECT VALUE_ID from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '167'
AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP() AND b_crm_deal.STAGE_ID = 'C34:2'"); // запрос на выборку


while ($od_dvost = $overdue_dvost->fetch_assoc())// получаем все строки в цикле по одной
{
  $overdue_dvost_message .=  $od_dvost['VALUE_ID']. ' '.   "  "  ;// выводим данные

}


# Просроченые Тимофей Енин:
$overdue_kbs = $link->query(
    "SELECT VALUE_ID from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '107'
AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP() AND b_crm_deal.STAGE_ID = 'C34:2'"); // запрос на выборку


while ($od_kbs = $overdue_kbs->fetch_assoc())// получаем все строки в цикле по одной
{
  $overdue_kbs_message .=  $od_kbs['VALUE_ID']. ' '.   "  "  ;// выводим данные

}

# Просроченые Дмитрий Силкин:
$overdue_priv = $link->query(
    "SELECT VALUE_ID from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '99'
AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP() AND b_crm_deal.STAGE_ID = 'C34:2'"); // запрос на выборку


while ($od_priv = $overdue_priv->fetch_assoc())// получаем все строки в цикле по одной
{
  $overdue_priv_message .=  $od_priv['VALUE_ID']. ' '.   "  "  ;// выводим данные

}

# Просроченые Андрей Вишняков:
$overdue_sev = $link->query(
    "SELECT VALUE_ID from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '133'
AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP() AND b_crm_deal.STAGE_ID = 'C34:2'"); // запрос на выборку


while ($od_sev = $overdue_sev->fetch_assoc())// получаем все строки в цикле по одной
{
  $overdue_sev_message .=  $od_sev['VALUE_ID']. ' '.   "  "  ;// выводим данные

}


# Просроченые Роман Гельвельчук:
$overdue_skav = $link->query(
    "SELECT VALUE_ID from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '137'
AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP() AND b_crm_deal.STAGE_ID = 'C34:2'"); // запрос на выборку


while ($od_skav = $overdue_skav->fetch_assoc())// получаем все строки в цикле по одной
{
  $overdue_skav_message .=  $od_skav['VALUE_ID']. ' '.   "  "  ;// выводим данные

}

# Просроченые Андрей Рынков:
$overdue_ural = $link->query(
    "SELECT VALUE_ID from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '27'
AND UF_CRM_1611413941886  < CURRENT_TIMESTAMP() AND b_crm_deal.STAGE_ID = 'C34:2'"); // запрос на выборку


while ($od_ural = $overdue_ural->fetch_assoc())// получаем все строки в цикле по одной
{
  $overdue_ural_message .=  $od_ural['VALUE_ID']. ' '.   "  "  ;// выводим данные

}

/*

$vrabote_stp = $link->query(
    "SELECT VALUE_ID 
from b_crm_deal
JOIN b_uts_crm_deal on 
b_uts_crm_deal.VALUE_ID = b_crm_deal.id
where STAGE_ID = 'C34:NEW'"); // запрос на выборку


while ($vr_stp = $vrabote_stp->fetch_assoc())// получаем все строки в цикле по одной
{
  $vrabote_stp_message .=  $vr_ural['VALUE_ID']. ' '.   "  "  ;// выводим данные

}
*/

$dt = date('d/m/Y');
$telegram = array("
 ОТЧЁТ ПО ЗАЯВКАМ ПОПУТЧИК НА 
 $dt
Открытые заявки: ($count_open_sum)
Просроченные заявки: ($count_dline_sum)
Ожидание ответа от клиента: ($count_ozhid_sum)

В работе / Просроченные:
СТП: $count_stpwork_sum / $count_dlinestp_sum 
Просроченные: $overdue_stp_message

СИСТЕМНЫЕ АДМИНИСТРАТОРЫ: $count_sawork_sum / $count_sadwork_sum 
Просроченные: $overdue_sa_message

ОТДЕЛ РАЗРАБОТКИ ПО: $count_orpo_work_sum / $count_orpo_dwork_sum
Просроченные: $overdue_orpo_message

ПРОДУКТЫ: $count_prod_work_sum / $count_prod_dwork_sum
Просроченные: $overdue_prod_message

Андрей Гнатовский: $count_moskva_work_sum / $count_moskva_dwork_sum
Просроченные: $overdue_moskva_message

Николай Дубель: $count_vsib_work_sum / $count_vsib_dwork_sum
Просроченные: $overdue_vsib_message

Кирилл Коротков: $count_gork_work_sum / $count_gork_dwork_sum
Просроченные: $overdue_gork_message

Павел Гришко: $count_dvost_work_sum / $count_dvost_dwork_sum
Просроченные: $overdue_dvost_message

Тимофей Енин: $count_kbsh_work_sum / $count_kbsh_dwork_sum
Просроченные: $overdue_kbs_message

Дмитрий Силкин: $count_priv_work_sum / $count_priv_dwork_sum
Просроченные: $overdue_priv_message

Андрей Вишняков: $count_sev_work_sum / $count_sev_dwork_sum
Просроченные: $overdue_sev_message

Роман Гельвельчук: $count_skav_work_sum / $count_skav_dwork_sum
Просроченные: $overdue_skav_message

Андрей Рынков: $count_ural_work_sum / $count_ural_dwork_sum
Просроченные: $overdue_ural_message

Крайний срок сегодня: $message    ");


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


// Отправить сообщение
$result=curl_exec($ch);
curl_close($ch);
mysqli_close($link);
    ?>
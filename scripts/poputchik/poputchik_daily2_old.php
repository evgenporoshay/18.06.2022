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
WHERE STAGE_ID = 'C34:NEW' AND UF_CRM_1611413941886  < CURDATE()
OR STAGE_ID = 'C34:PREPARATION' AND UF_CRM_1611413941886  < CURDATE()
OR STAGE_ID = 'C34:1' AND UF_CRM_1611413941886  < CURDATE()
OR STAGE_ID = 'C34:2' AND UF_CRM_1611413941886  < CURDATE()
OR STAGE_ID = 'C34:3' AND UF_CRM_1611413941886  < CURDATE()");
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
AND UF_CRM_1611413941886  < CURDATE() AND b_crm_deal.STAGE_ID = 'C34:NEW'");
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
AND UF_CRM_1611413941886  < CURDATE() AND b_crm_deal.STAGE_ID = 'C34:PREPARATION'");
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
AND UF_CRM_1611413941886  < CURDATE() AND b_crm_deal.STAGE_ID = 'C34:1' ");
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
AND UF_CRM_1611413941886  < CURDATE() AND b_crm_deal.STAGE_ID = 'C34:3'");
$row_prod_dwork_sum = $res_prod_dwork_sum->fetch_row();
$count_prod_dwork_sum = $row_prod_dwork_sum[0];

# ОЭ Москва в работе
$res_moskva_work_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:2'AND ASSIGNED_BY_ID = '17'");
$row_moskva_work_sum = $res_moskva_work_sum->fetch_row();
$count_moskva_work_sum = $row_moskva_work_sum[0];

# Ожидание ответа от клиента
$res_ozhid_sum = $link->query(" SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:4'");
$row_ozhid_sum = $res_ozhid_sum->fetch_row();
$count_ozhid_sum = $row_ozhid_sum[0];

# ОЭ Москва просроченные
$res_moskva_dwork_sum = $link->query("SELECT COUNT(*) from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '17'
AND UF_CRM_1611413941886  < CURDATE() AND b_crm_deal.STAGE_ID = 'C34:2'");
$row_moskva_dwork_sum = $res_moskva_dwork_sum->fetch_row();
$count_moskva_dwork_sum = $row_moskva_dwork_sum[0];

# ОЭ ВСИБ в работе
$res_vsib_work_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:2' 
  AND ASSIGNED_BY_ID = '138' ");
$row_vsib_work_sum = $res_vsib_work_sum->fetch_row();
$count_vsib_work_sum = $row_vsib_work_sum[0];

# ОЭ ВСИБ просроченные
$res_vsib_dwork_sum = $link->query("SELECT COUNT(*) from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '138'
AND UF_CRM_1611413941886  < CURDATE() AND b_crm_deal.STAGE_ID = 'C34:2' ");
$row_vsib_dwork_sum = $res_vsib_dwork_sum->fetch_row();
$count_vsib_dwork_sum = $row_vsib_dwork_sum[0];

# ОЭ ГОРЬК в работе
$res_gork_work_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:2'
  AND ASSIGNED_BY_ID = '143' ");
$row_gork_work_sum = $res_gork_work_sum->fetch_row();
$count_gork_work_sum = $row_gork_work_sum[0];

# ОЭ ГОРЬК просроченные
$res_gork_dwork_sum = $link->query("SELECT COUNT(*) from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '143'
AND UF_CRM_1611413941886  < CURDATE() AND b_crm_deal.STAGE_ID = 'C34:2'");
$row_gork_dwork_sum = $res_gork_dwork_sum->fetch_row();
$count_gork_dwork_sum = $row_gork_dwork_sum[0];

# ОЭ ДВОСТ в работе
$res_dvost_work_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:2'
  AND ASSIGNED_BY_ID = '167' ");
$row_dvost_work_sum = $res_dvost_work_sum->fetch_row();
$count_dvost_work_sum = $row_dvost_work_sum[0];

# ОЭ ДВОСТ просроченные
$res_dvost_dwork_sum = $link->query("SELECT COUNT(*) from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '167'
AND UF_CRM_1611413941886  < CURDATE() AND b_crm_deal.STAGE_ID = 'C34:2'");
$row_dvost_dwork_sum = $res_dvost_dwork_sum->fetch_row();
$count_dvost_dwork_sum = $row_dvost_dwork_sum[0];

# ОЭ ЕН в работе
$res_en_work_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:2'
  AND ASSIGNED_BY_ID = '138' ");
$row_en_work_sum = $res_en_work_sum->fetch_row();
$count_en_work_sum = $row_en_work_sum[0];

# ОЭ ЕН просроченные
$res_en_dwork_sum = $link->query("SELECT COUNT(*) from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '138'
AND UF_CRM_1611413941886  < CURDATE() AND b_crm_deal.STAGE_ID = 'C34:2'");
$row_en_dwork_sum = $res_en_dwork_sum->fetch_row();
$count_en_dwork_sum = $row_en_dwork_sum[0];

# ОЭ ЗБК в работе
$res_zbk_work_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:2'
  AND ASSIGNED_BY_ID = '25' ");
$row_zbk_work_sum = $res_zbk_work_sum->fetch_row();
$count_zbk_work_sum = $row_zbk_work_sum[0];

# ОЭ ЗБК просроченные
$res_zbk_dwork_sum = $link->query("SELECT COUNT(*) from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '25'
AND UF_CRM_1611413941886  < CURDATE() AND b_crm_deal.STAGE_ID = 'C34:2'");
$row_zbk_dwork_sum = $res_zbk_dwork_sum->fetch_row();
$count_zbk_dwork_sum = $row_zbk_dwork_sum[0];

# ОЭ ЗСИБ в работе
$res_zsib_work_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:2'
  AND ASSIGNED_BY_ID = '156' ");
$row_zsib_work_sum = $res_zsib_work_sum->fetch_row();
$count_zsib_work_sum = $row_zsib_work_sum[0];

# ОЭ ЗСИБ просроченные
$res_zsib_dwork_sum = $link->query("SELECT COUNT(*) from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '156'
AND UF_CRM_1611413941886  < CURDATE() AND b_crm_deal.STAGE_ID = 'C34:2'");
$row_zsib_dwork_sum = $res_zsib_dwork_sum->fetch_row();
$count_zsib_dwork_sum = $row_zsib_dwork_sum[0];

# ОЭ КБШ в работе
$res_kbsh_work_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:2'
  AND ASSIGNED_BY_ID = '107' ");
$row_kbsh_work_sum = $res_kbsh_work_sum->fetch_row();
$count_kbsh_work_sum = $row_kbsh_work_sum[0];

# ОЭ КБШ просроченные
$res_kbsh_dwork_sum = $link->query("SELECT COUNT(*) from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '107'
AND UF_CRM_1611413941886  < CURDATE() AND b_crm_deal.STAGE_ID = 'C34:2'");
$row_kbsh_dwork_sum = $res_kbsh_dwork_sum->fetch_row();
$count_kbsh_dwork_sum = $row_kbsh_dwork_sum[0];

# ОЭ ПРИВ в работе
$res_priv_work_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:2'
  AND ASSIGNED_BY_ID = '99'");
$row_priv_work_sum = $res_priv_work_sum->fetch_row();
$count_priv_work_sum = $row_priv_work_sum[0];

# ОЭ ПРИВ просроченные
$res_priv_dwork_sum = $link->query("SELECT COUNT(*) from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '99'
AND UF_CRM_1611413941886  < CURDATE() AND b_crm_deal.STAGE_ID = 'C34:2'");
$row_priv_dwork_sum = $res_priv_dwork_sum->fetch_row();
$count_priv_dwork_sum = $row_priv_dwork_sum[0];

# ОЭ СЕВ в работе
$res_sev_work_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:2'
  AND ASSIGNED_BY_ID = '133'");
$row_sev_work_sum = $res_sev_work_sum->fetch_row();
$count_sev_work_sum = $row_sev_work_sum[0];

# ОЭ СЕВ просроченные
$res_sev_dwork_sum = $link->query("SELECT COUNT(*) from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '133'
AND UF_CRM_1611413941886  < CURDATE() AND b_crm_deal.STAGE_ID = 'C34:2'");
$row_sev_dwork_sum = $res_sev_dwork_sum->fetch_row();
$count_sev_dwork_sum = $row_sev_dwork_sum[0];

# ОЭ СЗАП в работе
$res_szap_work_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:2'
  AND ASSIGNED_BY_ID = '136'");
$row_szap_work_sum = $res_szap_work_sum->fetch_row();
$count_szap_work_sum = $row_szap_work_sum[0];

# ОЭ СЗАП просроченные
$res_szap_dwork_sum = $link->query("SELECT COUNT(*) from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '136'
AND UF_CRM_1611413941886  < CURDATE() AND b_crm_deal.STAGE_ID = 'C34:2'");
$row_szap_dwork_sum = $res_szap_dwork_sum->fetch_row();
$count_szap_dwork_sum = $row_szap_dwork_sum[0];

# ОЭ СКАВ в работе
$res_skav_work_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:2'
  AND ASSIGNED_BY_ID = '137'");
$row_skav_work_sum = $res_skav_work_sum->fetch_row();
$count_skav_work_sum = $row_skav_work_sum[0];

# ОЭ СКАВ просроченные
$res_skav_dwork_sum = $link->query("SELECT COUNT(*) from b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE ASSIGNED_BY_ID = '137'
AND UF_CRM_1611413941886  < CURDATE() AND b_crm_deal.STAGE_ID = 'C34:2'");
$row_skav_dwork_sum = $res_skav_dwork_sum->fetch_row();
$count_skav_dwork_sum = $row_skav_dwork_sum[0];

# ОЭ УРАЛ в работе
$res_ural_work_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C34:2'
  AND ASSIGNED_BY_ID = '27'");
$row_ural_work_sum = $res_ural_work_sum->fetch_row();
$count_ural_work_sum = $row_ural_work_sum[0];

# ОЭ УРАЛ просроченные
$res_ural_dwork_sum = $link->query("SELECT COUNT(*) FROM b_uts_crm_deal
JOIN b_crm_deal ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
where STAGE_ID = 'C34:2'  
AND ASSIGNED_BY_ID = '27' AND UF_CRM_1611413941886  < CURDATE()");
$row_ural_dwork_sum = $res_ural_dwork_sum->fetch_row();
$count_ural_dwork_sum = $row_ural_dwork_sum[0];


# Крайний срок сегодня:
$result = $link->query(
    "SELECT VALUE_ID FROM b_uts_crm_deal WHERE UF_CRM_1611864420209 = 'true' AND UF_CRM_1611867292691 = 'В работе' AND UF_CRM_1611413941886 BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 DAY)"
); // запрос на выборку


while ($row = $result->fetch_assoc())// получаем все строки в цикле по одной
{
	$message .= '' . $row['VALUE_ID'].','.   "  "  ;// выводим данные

}
# Просроченые:
$result2 = $link->query(
    "SELECT VALUE_ID
FROM b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE STAGE_ID = 'C34:NEW' AND UF_CRM_1611413941886  < CURDATE()
OR STAGE_ID = 'C34:PREPARATION' AND UF_CRM_1611413941886  < CURDATE()
OR STAGE_ID = 'C34:1' AND UF_CRM_1611413941886  < CURDATE()
OR STAGE_ID = 'C34:2' AND UF_CRM_1611413941886  < CURDATE()
OR STAGE_ID = 'C34:3' AND UF_CRM_1611413941886  < CURDATE()"); // запрос на выборку


while ($row2 = $result2->fetch_assoc())// получаем все строки в цикле по одной
{
	$message2 .=  $row2['VALUE_ID']. ','.   "  "  ;// выводим данные

}


$dt = date('d/m/Y');
$telegram = array("
 ОТЧЁТ ПО ЗАЯВКАМ ПОПУТЧИК НА 
 $dt
Открытые заявки: ($count_open_sum)
Просроченные заявки: ($count_dline_sum)
Ожидание ответа от клиента: ($count_ozhid_sum)

В работе / Просроченные:
СТП: $count_stpwork_sum / $count_dlinestp_sum 
СИСТЕМНЫЕ АДМИНИСТРАТОРЫ: $count_sawork_sum / $count_sadwork_sum 
ОТДЕЛ РАЗРАБОТКИ ПО: $count_orpo_work_sum / $count_orpo_dwork_sum
ПРОДУКТЫ: $count_prod_work_sum / $count_prod_dwork_sum
ОЭ МОСКВА: $count_moskva_work_sum / $count_moskva_dwork_sum
ОЭ ВСИБ: $count_vsib_work_sum / $count_vsib_dwork_sum
ОЭ ГОРЬК: $count_gork_work_sum / $count_gork_dwork_sum
ОЭ ДВОСТ: $count_dvost_work_sum / $count_dvost_dwork_sum
ОЭ ЕН: $count_en_work_sum / $count_en_dwork_sum
ОЭ ЗБК: $count_zbk_work_sum / $count_zbk_dwork_sum
ОЭ ЗСИБ: $count_zsib_work_sum / $count_zsib_dwork_sum
ОЭ КБШ: $count_kbsh_work_sum / $count_kbsh_dwork_sum
ОЭ ПРИВ: $count_priv_work_sum / $count_priv_dwork_sum
ОЭ СЕВ: $count_sev_work_sum / $count_sev_dwork_sum
ОЭ СЗАП: $count_szap_work_sum / $count_szap_dwork_sum
ОЭ СКАВ: $count_skav_work_sum / $count_skav_dwork_sum
ОЭ УРАЛ: $count_ural_work_sum / $count_ural_dwork_sum
Крайний срок сегодня: $message   
Просрочены: $message2  ");


 #$telegram[0];
// Токен бота и идентификатор чата
$token='1223485972:AAEzNc9_JevZungd2XPFbdYjbRYHJRx1788';
$chat_id='-477095494';

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
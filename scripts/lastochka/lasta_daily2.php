<?php
/* ОТЧЁТ ПО ЗАЯВКАМ ЛАСТОЧКИ НА 07/02/2021
Открытые заявки: (23)
Просроченные: (12)

В работе / Просроченные:

СТП: 12/4
Системные администраторы: 10/0
Отдел разработки ПО: 3/1
Продукты: 0/0
ОЭ СЗАП: 4/0
ОЭ МОСКВА: 1/0
ОЭ ЮГ: 12/9
*/

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
# Всего в работе
$res_open_sum = $link->query("SELECT COUNT(*) from b_crm_deal where STAGE_ID = 'C15:NEW'
OR STAGE_ID = 'C15:PREPARATION'
OR STAGE_ID = 'C15:PREPAYMENT_INVOIC'
OR STAGE_ID = 'C15:EXECUTING'
OR STAGE_ID = 'C15:FINAL_INVOICE'
OR STAGE_ID = 'C15:UC_7XGF12'
OR STAGE_ID = 'C15:UC_7926HF'");
$row_open_sum = $res_open_sum->fetch_row();
$count_open_sum = $row_open_sum[0];

# Всего просроченные
$res_dline_sum = $link->query("SELECT COUNT(*) from b_crm_deal bcd
join b_uts_crm_deal bucd on bucd.VALUE_ID = bcd.id
where STAGE_ID = 'C15:NEW' AND UF_CRM_1650004583854  < CURRENT_TIMESTAMP()
OR STAGE_ID = 'C15:PREPARATION' AND UF_CRM_1650004583854  < CURRENT_TIMESTAMP()
OR STAGE_ID = 'C15:PREPAYMENT_INVOIC' AND UF_CRM_1650004583854  < CURRENT_TIMESTAMP()
OR STAGE_ID = 'C15:EXECUTING' AND UF_CRM_1650004583854  < CURRENT_TIMESTAMP()
OR STAGE_ID = 'C15:FINAL_INVOICE' AND UF_CRM_1650004583854  < CURRENT_TIMESTAMP()
OR STAGE_ID = 'C15:UC_7XGF12' AND UF_CRM_1650004583854  < CURRENT_TIMESTAMP()
OR STAGE_ID = 'C15:UC_7926HF' AND UF_CRM_1650004583854  < CURRENT_TIMESTAMP()");
$row_dline_sum = $res_dline_sum->fetch_row();
$count_dline_sum = $row_dline_sum[0];

# СТП в работе
$res_stpwork_sum = $link->query("SELECT count(*) FROM b_uts_crm_deal bucd
JOIN b_crm_deal bcd ON bcd.id = bucd.VALUE_ID 
WHERE bcd.STAGE_ID = 'C15:NEW'");
$row_stpwork_sum = $res_stpwork_sum->fetch_row();
$count_stpwork_sum = $row_stpwork_sum[0];

# СТП просроченные
$res_dlinestp_sum = $link->query("SELECT COUNT(*) from b_crm_deal bcd
join b_uts_crm_deal bucd on bucd.VALUE_ID = bcd.id
where STAGE_ID = 'C15:NEW' AND UF_CRM_1650004583854  < CURRENT_TIMESTAMP()");
$row_dlinestp_sum = $res_dlinestp_sum->fetch_row();
$count_dlinestp_sum = $row_dlinestp_sum[0];

# Сисадмины в работе
$res_sawork_sum = $link->query("SELECT count(*) FROM b_uts_crm_deal bucd
JOIN b_crm_deal bcd ON bcd.id = bucd.VALUE_ID 
WHERE bcd.STAGE_ID = 'C15:PREPARATION'");
$row_sawork_sum = $res_sawork_sum->fetch_row();
$count_sawork_sum = $row_sawork_sum[0];

# Сисадмины просроченные
$res_sadwork_sum = $link->query("SELECT COUNT(*) from b_crm_deal bcd
join b_uts_crm_deal bucd on bucd.VALUE_ID = bcd.id
where STAGE_ID = 'C15:PREPARATION' AND UF_CRM_1650004583854  < CURRENT_TIMESTAMP()");
$row_sadwork_sum = $res_sadwork_sum->fetch_row();
$count_sadwork_sum = $row_sadwork_sum[0];

# ОРПО в работе
$res_orpo_work_sum = $link->query("SELECT count(*) FROM b_uts_crm_deal bucd
JOIN b_crm_deal bcd ON bcd.id = bucd.VALUE_ID 
WHERE bcd.STAGE_ID = 'C15:PREPAYMENT_INVOIC'");
$row_orpo_work_sum = $res_orpo_work_sum->fetch_row();
$count_orpo_work_sum = $row_orpo_work_sum[0];

# ОРПО просроченные
$res_orpo_dwork_sum = $link->query("SELECT COUNT(*) from b_crm_deal bcd
join b_uts_crm_deal bucd on bucd.VALUE_ID = bcd.id
where STAGE_ID = 'C15:PREPAYMENT_INVOIC' AND UF_CRM_1650004583854  < CURRENT_TIMESTAMP()");
$row_orpo_dwork_sum = $res_orpo_dwork_sum->fetch_row();
$count_orpo_dwork_sum = $row_orpo_dwork_sum[0];

# Продукты в работе
$res_prod_work_sum = $link->query("SELECT count(*) FROM b_uts_crm_deal bucd
JOIN b_crm_deal bcd ON bcd.id = bucd.VALUE_ID 
WHERE bcd.STAGE_ID = 'C15:EXECUTING'");
$row_prod_work_sum = $res_prod_work_sum->fetch_row();
$count_prod_work_sum = $row_prod_work_sum[0];

# Продукты просроченные
$res_prod_dwork_sum = $link->query("SELECT COUNT(*) from b_crm_deal bcd
join b_uts_crm_deal bucd on bucd.VALUE_ID = bcd.id
where STAGE_ID = 'C15:EXECUTING' AND UF_CRM_1650004583854  < CURRENT_TIMESTAMP()");
$row_prod_dwork_sum = $res_prod_dwork_sum->fetch_row();
$count_prod_dwork_sum = $row_prod_dwork_sum[0];

# ОЭ СЗАП в работе
$res_szap_work_sum = $link->query("SELECT count(*) FROM b_uts_crm_deal bucd
JOIN b_crm_deal bcd ON bcd.id = bucd.VALUE_ID 
WHERE bcd.STAGE_ID = 'C15:FINAL_INVOICE'");
$row_szap_work_sum = $res_szap_work_sum->fetch_row();
$count_szap_work_sum = $row_szap_work_sum[0];

# ОЭ СЗАП просроченные
$res_szap_dwork_sum = $link->query("SELECT COUNT(*) from b_crm_deal bcd
join b_uts_crm_deal bucd on bucd.VALUE_ID = bcd.id
where STAGE_ID = 'C15:FINAL_INVOICE' AND UF_CRM_1650004583854  < CURRENT_TIMESTAMP()");
$row_szap_dwork_sum = $res_szap_dwork_sum->fetch_row();
$count_szap_dwork_sum = $row_szap_dwork_sum[0];

# ОЭ Москва в работе
$res_moskva_work_sum = $link->query("SELECT count(*) FROM b_uts_crm_deal bucd
JOIN b_crm_deal bcd ON bcd.id = bucd.VALUE_ID 
WHERE bcd.STAGE_ID = 'C15:UC_7XGF12'");
$row_moskva_work_sum = $res_moskva_work_sum->fetch_row();
$count_moskva_work_sum = $row_moskva_work_sum[0];

# ОЭ Москва просроченные
$res_moskva_dwork_sum = $link->query("SELECT COUNT(*) from b_crm_deal bcd
join b_uts_crm_deal bucd on bucd.VALUE_ID = bcd.id
where STAGE_ID = 'C15:UC_7XGF12' AND UF_CRM_1650004583854  < CURRENT_TIMESTAMP()");
$row_moskva_dwork_sum = $res_moskva_dwork_sum->fetch_row();
$count_moskva_dwork_sum = $row_moskva_dwork_sum[0];

# ОЭ ЮГ в работе
$res_yug_work_sum = $link->query("SELECT count(*) FROM b_uts_crm_deal bucd
JOIN b_crm_deal bcd ON bcd.id = bucd.VALUE_ID 
WHERE bcd.STAGE_ID = 'C15:UC_7926HF'");
$row_yug_work_sum = $res_yug_work_sum->fetch_row();
$count_yug_work_sum = $row_yug_work_sum[0];

# ОЭ ЮГ просроченные
$res_yug_dwork_sum = $link->query("SELECT COUNT(*) from b_crm_deal bcd
join b_uts_crm_deal bucd on bucd.VALUE_ID = bcd.id
where STAGE_ID = 'C15:UC_7926HF' AND UF_CRM_1650004583854  < CURRENT_TIMESTAMP()");
$row_yug_dwork_sum = $res_yug_dwork_sum->fetch_row();
$count_yug_dwork_sum = $row_yug_dwork_sum[0];

$dt = date('d/m/Y');
$telegram =array("
ОТЧЁТ ПО ЗАЯВКАМ ЛАСТОЧКИ НА
$dt

Открытые заявки: ($count_open_sum)
Просроченные заявки: ($count_dline_sum)

В работе / Просроченные:
СТП: $count_stpwork_sum / $count_dlinestp_sum
СИСТЕМНЫЕ АДМИНИСТРАТОРЫ: $count_sawork_sum / $count_sadwork_sum
ОТДЕЛ РАЗРАБОТКИ ПО: $count_orpo_work_sum / $count_orpo_dwork_sum
ПРОДУКТЫ: $count_prod_work_sum / $count_prod_dwork_sum
ОЭ СЗАП: $count_szap_work_sum / $count_szap_dwork_sum
ОЭ МОСКВА: $count_moskva_work_sum / $count_moskva_dwork_sum
ОЭ ЮГ: $count_yug_work_sum / $count_yug_dwork_sum
");


#$telegram[0];
// Токен бота и идентификатор чата
$token='1223485972:AAEzNc9_JevZungd2XPFbdYjbRYHJRx1788';
#$chat_id='1223485972';
$chat_id='-1001737074659';


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

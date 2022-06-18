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


mysqli_query($link, "CREATE TEMPORARY TABLE status_toprof 
as  (
   SELECT bcd.id, bucd.UF_CRM_1650003076612, t.status, t.data_provedeniya, t.engeneer, t.telephone, t.gorod_provedenia_toprof 
FROM toprof t JOIN
(SELECT carriage , max(id) as mtime FROM toprof GROUP BY carriage) as t1
ON t.carriage = t1.carriage AND t.id = t1.mtime
join b_uts_crm_deal bucd on bucd.UF_CRM_1650003076612 = t.carriage 
join b_crm_deal bcd on bcd.ID = bucd.VALUE_ID 
where bcd.CATEGORY_ID = 22
)");



mysqli_query($link, "UPDATE b_crm_deal bcd
join b_uts_crm_deal bucd on 
bucd.VALUE_ID = bcd.id
join status_toprof st on st.id = bcd.id
set bcd.ADDITIONAL_INFO = st.status
where st.id = bcd.ID and bcd.STAGE_ID ='C22:UC_5TMTDV' or bcd.STAGE_ID = 'C22:PREPARATION' or bcd.STAGE_ID = 'C22:NEW' or bcd.STAGE_ID = 'C22:LOSE'");



mysqli_query($link, "UPDATE b_crm_deal bcd
join b_uts_crm_deal bucd on 
bucd.VALUE_ID = bcd.id
join status_toprof st on st.id = bcd.id
set bcd.ADDITIONAL_INFO = st.status
where st.id = bcd.ID and bcd.STAGE_ID ='C22:UC_5TMTDV' or bcd.STAGE_ID = 'C22:PREPARATION' or bcd.STAGE_ID = 'C22:NEW' or bcd.STAGE_ID = 'C22:LOSE'");


mysqli_query($link, "UPDATE b_crm_deal bcd
join b_uts_crm_deal bucd on 
bucd.VALUE_ID = bcd.id
join status_toprof st on st.id = bcd.id
set bucd.UF_CRM_1654068975186 = st.data_provedeniya
where st.id = bcd.ID and bcd.STAGE_ID ='C22:UC_5TMTDV' or bcd.STAGE_ID = 'C22:PREPARATION' or bcd.STAGE_ID = 'C22:NEW' or bcd.STAGE_ID = 'C22:LOSE'");


mysqli_query($link, "UPDATE b_crm_deal bcd
join b_uts_crm_deal bucd on 
bucd.VALUE_ID = bcd.id
join status_toprof st on st.id = bcd.id
set bucd.UF_CRM_1654068360080 = st.engeneer
where st.id = bcd.ID and bcd.STAGE_ID ='C22:UC_5TMTDV' or bcd.STAGE_ID = 'C22:PREPARATION' or bcd.STAGE_ID = 'C22:NEW' or bcd.STAGE_ID = 'C22:LOSE'");


mysqli_query($link, "UPDATE b_crm_deal bcd
join b_uts_crm_deal bucd on 
bucd.VALUE_ID = bcd.id
join status_toprof st on st.id = bcd.id
set bucd.UF_CRM_1654077567877 = st.telephone
where st.id = bcd.ID and bcd.STAGE_ID ='C22:UC_5TMTDV' or bcd.STAGE_ID = 'C22:PREPARATION' or bcd.STAGE_ID = 'C22:NEW' or bcd.STAGE_ID = 'C22:LOSE'");



mysqli_query($link, "UPDATE b_crm_deal bcd set bcd.STAGE_ID = 'C22:UC_5TMTDV' where bcd.ADDITIONAL_INFO = 'В работе' and bcd.STAGE_ID ='C22:UC_5TMTDV' or bcd.STAGE_ID = 'C22:PREPARATION' or bcd.STAGE_ID = 'C22:NEW' or bcd.STAGE_ID = 'C22:LOSE'");


mysqli_query($link, "UPDATE b_crm_deal bcd set bcd.STAGE_ID = 'C22:PREPARATION' where bcd.ADDITIONAL_INFO = 'На согласовании' and bcd.STAGE_ID ='C22:UC_5TMTDV' or bcd.STAGE_ID = 'C22:PREPARATION' or bcd.STAGE_ID = 'C22:NEW' or bcd.STAGE_ID = 'C22:LOSE'");


mysqli_query($link, "UPDATE b_crm_deal bcd set bcd.STAGE_ID = 'C22:WON' where bcd.ADDITIONAL_INFO = 'В ожидании акта' and bcd.STAGE_ID ='C22:UC_5TMTDV' or bcd.STAGE_ID = 'C22:PREPARATION' or bcd.STAGE_ID = 'C22:NEW' or bcd.STAGE_ID = 'C22:LOSE'");


mysqli_query($link, "UPDATE b_crm_deal bcd set bcd.STAGE_ID = 'C22:LOSE' where bcd.ADDITIONAL_INFO = 'Отклонён' and bcd.STAGE_ID ='C22:UC_5TMTDV' or bcd.STAGE_ID = 'C22:PREPARATION' or bcd.STAGE_ID = 'C22:NEW' or bcd.STAGE_ID = 'C22:LOSE'");



mysqli_query($link, "DROP TABLE status_toprof");


mysqli_close($link);
?>


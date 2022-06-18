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

/* получаем номер вагона из вновь созданной заявки (возможно уменьшить до 1 секунды?)*/
$query1 = mysqli_query($link, "

    SELECT UF_CRM_1650003076612
    FROM b_uts_crm_deal bucr
    JOIN b_crm_deal bcm ON 
    bcm.id = bucr.VALUE_ID 
    WHERE bcm.STAGE_ID = 'C14:NEW' /* Тут мы делаем запрос на стадии новой заявки СТП */
    AND bcm.DATE_CREATE >= DATE_SUB(NOW(), INTERVAL 10 SECOND);");

while($row = $query1->fetch_assoc())

$carriage .= $row['UF_CRM_1650003076612']; //тут мы получили номер вагона и поместили его в переменную $carriage
    //echo $carriage;

//Преобразуем $carriage в формат string
$carriage_new = str_replace("-", "", $carriage);

/* вычисляем депо для выбранного вагона и помещаем депо в переменную $depot */
$query2 = mysqli_query($link, "
    SELECT md
    FROM cars c 
    WHERE carriage LIKE '$carriage_new' ");

while($row2 = $query2->fetch_assoc())

$depot .= $row2['md']; //тут мы получили депо вагона $carriage

//echo $depot;

/* вычисляем филиал для выбранного вагона и помещаем депо в переменную $filial */

$query3 = mysqli_query($link, "SELECT filial
FROM cars c 
WHERE carriage LIKE '$carriage_new' ");

while($row3 = $query3->fetch_assoc())

$filial .= $row3['filial'];//тут мы получили филиал вагона $carriage

 
//echo $filial;

$query4 = mysqli_query($link, "SELECT bcd.ID
    FROM b_crm_deal bcd
    WHERE bcd.STAGE_ID = 'C14:NEW' /* Тут мы делаем запрос на стадии новой заявки СТП */
    AND bcd.DATE_CREATE >= DATE_SUB(NOW(), INTERVAL 10 SECOND);");

while($row4 = $query4->fetch_assoc())

$deal_id .= $row4['ID'];


$query5 = mysqli_query($link, "SELECT date_of_construction
FROM cars c 
WHERE carriage LIKE '$carriage_new' ");

while($row5 = $query5->fetch_assoc())

$date_of_construction .= $row5['date_of_construction'];//тут мы получили год постройки вагона $carriage


mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1650180115527 = $date_of_construction WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");


switch ($filial) {
      case 'С-ЗАП':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET UF_CRM_1650180313032 = 73 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'С-КВ': 
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET UF_CRM_1650180313032 = 74  WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'КБШ': 
          mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET UF_CRM_1650180313032 = 75  WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'З-СИБ':
          mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET UF_CRM_1650180313032 = 76  WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'УРАЛ':
             mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET UF_CRM_1650180313032 = 77  WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'МОСК':
            mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET UF_CRM_1650180313032 = 78  WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'СЕВ':
            mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET UF_CRM_1650180313032 = 79  WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ДВОСТ':
             mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET UF_CRM_1650180313032 = 80  WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ГОР':
             mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET UF_CRM_1650180313032 = 81  WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'В-СИБ':
             mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET UF_CRM_1650180313032 = 82  WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ПРИВ':
             mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET UF_CRM_1650180313032 = 83  WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;    
      case 'ЗБК':
             mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET UF_CRM_1650180313032 = 84  WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
       case 'ЕН':
             mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET UF_CRM_1650180313032 = 85  WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
       
   }


   switch ($depot) {
      case 'ЛВЧД-МОСКВА_ОКТ ОКТ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 105, b_uts_crm_deal.UF_CRM_1650190066101 = 170 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");
      break;
      case 'ЛВЧ-РО С-КВ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 86, b_uts_crm_deal.UF_CRM_1650190066101 = 153 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");
      break;
      
      case 'ЛВЧ-СПБ_МОСК ОКТ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 135, b_uts_crm_deal.UF_CRM_1650190066101 = 195 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");
      break;
      case 'ЛВЧ-АДЛЕР С-КВ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 86, b_uts_crm_deal.UF_CRM_1650190066101 = 153 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧД-7 КБШ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 134, b_uts_crm_deal.UF_CRM_1650190066101 = 194 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧД14 С-КВ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 123, b_uts_crm_deal.UF_CRM_1650190066101 = 183 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ-7 З-СИБ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 124, b_uts_crm_deal.UF_CRM_1650190066101 = 184 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧД-КАЛИНИНГР ОКТ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 117, b_uts_crm_deal.UF_CRM_1650190066101 = 179 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧД-СПБ_МОСК ОКТ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 136, b_uts_crm_deal.UF_CRM_1650190066101 = 195 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ-ПСКОВ ОКТ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 132, b_uts_crm_deal.UF_CRM_1650190066101 = 192 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ-ПЕТРОЗАВОД ОКТ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 131, b_uts_crm_deal.UF_CRM_1650190066101 = 191 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧД24 С-КВ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 93, b_uts_crm_deal.UF_CRM_1650190066101 = 160 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ВЧ-ЕКБ СВРД':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 99, b_uts_crm_deal.UF_CRM_1650190066101 = 165 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧД04 МСК':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 119, b_uts_crm_deal.UF_CRM_1650190066101 = 179 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ-АРХАНГЕЛЬСК ОКТ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 87, b_uts_crm_deal.UF_CRM_1650190066101 = 154 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧД15 МСК':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 118, b_uts_crm_deal.UF_CRM_1650190066101 = 179 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ-3 МСК':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 116, b_uts_crm_deal.UF_CRM_1650190066101 = 179 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ-1 Д-В':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 148, b_uts_crm_deal.UF_CRM_1650190066101 = 207 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ-ИЖЕВСК ГОР':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 102, b_uts_crm_deal.UF_CRM_1650190066101 = 167 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧД-КИРОВ ГОР':
        mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 107, b_uts_crm_deal.UF_CRM_1650190066101 = 172 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ-14 КБШ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 147, b_uts_crm_deal.UF_CRM_1650190066101 = 206 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ВЧ-П СВРД':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 130, b_uts_crm_deal.UF_CRM_1650190066101 = 190 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ-КОТЛАС_ ОКТ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 110, b_uts_crm_deal.UF_CRM_1650190066101 = 175 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ-ЯРОСЛАВЛЬ ОКТ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 152, b_uts_crm_deal.UF_CRM_1650190066101 = 211 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧД-8 МСК':
        mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 126, b_uts_crm_deal.UF_CRM_1650190066101 = 186 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");
      break;
      case 'ЛВЧ-СЫКТЫВКАР ОКТ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 87, b_uts_crm_deal.UF_CRM_1650190066101 = 154 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ-ВОЛОГДА_ ОКТ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 95, b_uts_crm_deal.UF_CRM_1650190066101 = 162 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ-КАЗАНЬ ГОР':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 104, b_uts_crm_deal.UF_CRM_1650190066101 = 169 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧД-ГОРЬКИЙ-М ГОР':
        mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 120, b_uts_crm_deal.UF_CRM_1650190066101 = 180 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧД-ИРКУТСК В-СИБ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 103, b_uts_crm_deal.UF_CRM_1650190066101 = 168 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");
         

      break;
      case 'ЛВЧ-13 З-СИБ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 88, b_uts_crm_deal.UF_CRM_1650190066101 = 155 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧД-Ч СВРД':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 149, b_uts_crm_deal.UF_CRM_1650190066101 = 208 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ-1 МСК':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 114, b_uts_crm_deal.UF_CRM_1650190066101 = 179 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ-15 МСК':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 139, b_uts_crm_deal.UF_CRM_1650190066101 = 198 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ-5 КБШ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 129, b_uts_crm_deal.UF_CRM_1650190066101 = 189 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ВЧ-ТЮМ СВРД':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 145, b_uts_crm_deal.UF_CRM_1650190066101 = 204 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧД13 МСК':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 139, b_uts_crm_deal.UF_CRM_1650190066101 = 198 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧД-8_ВОРОНЕЖ ПРИВ':
        mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 96, b_uts_crm_deal.UF_CRM_1650190066101 = 163 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧД-3 Д-В':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 92, b_uts_crm_deal.UF_CRM_1650190066101 = 159 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ-2 Д-В':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 144, b_uts_crm_deal.UF_CRM_1650190066101 = 203 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧД-1 З-СИБ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 125, b_uts_crm_deal.UF_CRM_1650190066101 = 185 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ-ГР С-КВ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 97, b_uts_crm_deal.UF_CRM_1650190066101 = 164 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ-МХ С-КВ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 112, b_uts_crm_deal.UF_CRM_1650190066101 = 177 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ВЧОРСК СВРД':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 128, b_uts_crm_deal.UF_CRM_1650190066101 = 188 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧД-О СВРД':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 127, b_uts_crm_deal.UF_CRM_1650190066101 = 187 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ_ВОЛГОГРАД ПРИВ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 94, b_uts_crm_deal.UF_CRM_1650190066101 = 161 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ_САРАТОВ ПРИВ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 137, b_uts_crm_deal.UF_CRM_1650190066101 = 196 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ-1 КБШ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 129, b_uts_crm_deal.UF_CRM_1650190066101 = 189 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ-26 З-СИБ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 122, b_uts_crm_deal.UF_CRM_1650190066101 = 182 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ-20 З-СИБ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 143, b_uts_crm_deal.UF_CRM_1650190066101 = 202 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧД-КРАСНОЯРСК В-СИБ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 111, b_uts_crm_deal.UF_CRM_1650190066101 = 176 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ПФ-КОСТРОМА_ ОКТ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 109, b_uts_crm_deal.UF_CRM_1650190066101 = 174 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ-ВОЛОГДА_ ОКТ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 95, b_uts_crm_deal.UF_CRM_1650190066101 = 162 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧД-ИРКУТСК В-СИБ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 103, b_uts_crm_deal.UF_CRM_1650190066101 = 168 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ-13 З-СИБ':
        mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 88, b_uts_crm_deal.UF_CRM_1650190066101 = 155 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ПФ-ЧЕРЕПОВЕЦ ОКТ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 150, b_uts_crm_deal.UF_CRM_1650190066101 = 209 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧД-8_ВОРОНЕЖ ПРИВ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 96, b_uts_crm_deal.UF_CRM_1650190066101 = 163 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ-ЯРОСЛАВЛЬ ОКТ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 152, b_uts_crm_deal.UF_CRM_1650190066101 = 211 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ПУ-БЕЛГОРОД ПРИВ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 89, b_uts_crm_deal.UF_CRM_1650190066101 = 156 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      case 'ЛВЧ_САРАТОВ ПРИВ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 137, b_uts_crm_deal.UF_CRM_1650190066101 = 196 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");


      case 'ЛВЧ-26 З-СИБ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 122, b_uts_crm_deal.UF_CRM_1650190066101 = 182 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");


      break;
      case 'ЛВЧ-СБ В-СИБ':
         mysqli_query($link, "UPDATE b_crm_deal, b_uts_crm_deal SET b_uts_crm_deal.UF_CRM_1650181008843 = 138, b_uts_crm_deal.UF_CRM_1650190066101 = 197 WHERE b_crm_deal.ID = b_uts_crm_deal.VALUE_ID AND b_crm_deal.ID = '$deal_id'");

      break;
      }

    





mysqli_close($link);

?>
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

    SELECT UF_CRM_1594368335083
    FROM b_uts_crm_deal bucr
    JOIN b_crm_deal bcm ON 
    bcm.id = bucr.VALUE_ID 
    WHERE bcm.STAGE_ID = 'C34:NEW' /* Тут мы делаем запрос на стадии новой заявки СТП */
    AND bcm.DATE_CREATE >= DATE_SUB(NOW(), INTERVAL 21605 SECOND);");

while($row = $query1->fetch_assoc())

$carriage .= $row['UF_CRM_1594368335083']; //тут мы получили номер вагона и поместили его в переменную $carriage
    //echo $carriage;


$carriage_new = str_replace("-", "", $carriage);




/* вычисляем депо для выбранного вагона и помещаем депо в переменную $depot */
$query2 = mysqli_query($link, "
    SELECT depot
    FROM carriages c 
    WHERE carriage LIKE '$carriage_new' ");

while($row2 = $query2->fetch_assoc())

$depot .= $row2['depot']; //тут мы получили депо вагона $carriage

//echo $depot;

/* вычисляем филиал для выбранного вагона и помещаем депо в переменную $filial */

$query3 = mysqli_query($link, "SELECT filial
FROM carriages c 
WHERE carriage LIKE '$carriage_new' ");

while($row3 = $query3->fetch_assoc())

$filial .= $row3['filial'];//тут мы получили филиал вагона $carriage

echo $filial;

$query4 = mysqli_query($link, "SELECT bcd.ID
    FROM b_crm_deal bcd
    WHERE bcd.STAGE_ID = 'C34:NEW' /* Тут мы делаем запрос на стадии новой заявки СТП */
    AND bcd.DATE_CREATE >= DATE_SUB(NOW(), INTERVAL 21602 SECOND);");

while($row4 = $query4->fetch_assoc())

$deal_id .= $row4['ID'];

//echo $deal_id;

switch ($filial) {
      case 'С-ЗАП':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_5F18402F944CF = 261 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'С-КВ': 
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_5F18402F944CF = 262 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'КБШ': 
          mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_5F18402F944CF = 257 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'З-СИБ':
          mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_5F18402F944CF = 255 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'УРАЛ':
             mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_5F18402F944CF = 263 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'МОСК':
            mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_5F18402F944CF = 258 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'СЕВ':
            mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_5F18402F944CF = 260 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ДВОСТ':
             mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_5F18402F944CF = 253 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ГОР':
             mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_5F18402F944CF = 252 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'В-СИБ':
             mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_5F18402F944CF = 251 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ПРИВ':
             mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_5F18402F944CF = 259 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;    
      case 'ЗБК':
             mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_5F18402F944CF = 256 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
       case 'ЕН':
             mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_5F18402F944CF = 254 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
       
   }


   switch ($depot) {
      case 'ЛВЧД-МОСКВА_ОКТ ОКТ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3725, UF_CRM_1594568849232 = 158 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-РО С-КВ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3741, UF_CRM_1594568849232 = 172 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      
      case 'ЛВЧ-СПБ_МОСК ОКТ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3743, UF_CRM_1594568849232 = 174 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-АДЛЕР С-КВ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3695, UF_CRM_1594568849232 = 132 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧД-7 КБШ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3742, UF_CRM_1594568849232 = 173 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧД14 С-КВ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3731, UF_CRM_1594568849232 = 162 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-7 З-СИБ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3732, UF_CRM_1594568849232 = 163 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧД-КАЛИНИНГР ОКТ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3713, UF_CRM_1594568849232 = 149 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧД-СПБ_МОСК ОКТ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3744, UF_CRM_1594568849232 = 174 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-ПСКОВ ОКТ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3740, UF_CRM_1594568849232 = 171 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-ПЕТРОЗАВОД ОКТ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3739, UF_CRM_1594568849232 = 170 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧД24 С-КВ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3721, UF_CRM_1594568849232 = 157 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ВЧ-ЕКБ СВРД':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3707, UF_CRM_1594568849232 = 144 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧД04 МСК':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3727, UF_CRM_1594568849232 = 158 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-АРХАНГ СЕВ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3696, UF_CRM_1594568849232 = 133 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧД15 МСК':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3726, UF_CRM_1594568849232 = 158 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-3 МСК':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3724, UF_CRM_1594568849232 = 158 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-1 Д-В':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3756, UF_CRM_1594568849232 = 186 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-ИЖЕВСК ГОР':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3710, UF_CRM_1594568849232 = 146 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧД-КИРОВ ГОР':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 =  3715, UF_CRM_1594568849232 =151 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-14 КБШ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3755, UF_CRM_1594568849232 = 185 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ВЧ-П СВРД':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3738, UF_CRM_1594568849232 = 169 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-КОТЛАС СЕВ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3718, UF_CRM_1594568849232 = 154 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-ЯРОСЛ СЕВ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3717, UF_CRM_1594568849232 = 153 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧД-8 МСК':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3734, UF_CRM_1594568849232 = 167 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-СЫКТЫВК СЕВ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3749, UF_CRM_1594568849232 = 179 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛЧУ-6 СЕВ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3704, UF_CRM_1594568849232 = 141 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-ВОЛОГДА СЕВ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3704, UF_CRM_1594568849232 = 141 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-КАЗАНЬ ГОР':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3712, UF_CRM_1594568849232 = 148 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧД-ГОРЬКИЙ-М ГОР':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3728, UF_CRM_1594568849232 = 160  WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧД-И В-СИБ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3711, UF_CRM_1594568849232 = 147 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-13 З-СИБ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3697, UF_CRM_1594568849232 = 134 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧД-Ч СВРД':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3757, UF_CRM_1594568849232 = 187 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-1 МСК':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3722, UF_CRM_1594568849232 = 158 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-15 МСК':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3700, UF_CRM_1594568849232 = 137 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-5 КБШ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3754, UF_CRM_1594568849232 = 184 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ВЧ-ТЮМ СВРД':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3753, UF_CRM_1594568849232 = 183 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧД13 МСК':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3747, UF_CRM_1594568849232 = 177 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧД-8_ВОРОНЕЖ ПРИВ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3705, UF_CRM_1594568849232 = 142 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧД-3 Д-В':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3701, UF_CRM_1594568849232 = 138 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-2 Д-В':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3752, UF_CRM_1594568849232 = 182 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-1 ЗБК':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3759, UF_CRM_1594568849232 = 189 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧД-1 З-СИБ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3733, UF_CRM_1594568849232 = 164 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-ГР С-КВ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3706, UF_CRM_1594568849232 = 143 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-МХ С-КВ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3720, UF_CRM_1594568849232 = 156 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ВЧОРСК СВРД':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3736, UF_CRM_1594568849232 = 166 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧД-О СВРД':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3735, UF_CRM_1594568849232 = 165 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ_ВОЛГОГРАД ПРИВ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3703, UF_CRM_1594568849232 = 140 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ_САРАТОВ ПРИВ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3745, UF_CRM_1594568849232 = 175 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-1 КБШ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3737, UF_CRM_1594568849232 = 168 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-26 З-СИБ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3730, UF_CRM_1594568849232 = 161 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-20 З-СИБ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3751, UF_CRM_1594568849232 = 181 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧД-К КРАС':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3719, UF_CRM_1594568849232 = 155 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ПФ-КОСТРОМА СЕВ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3717, UF_CRM_1594568849232 = 153 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-ВОЛОГДА СЕВ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3704, UF_CRM_1594568849232 = 141 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧД-И В-СИБ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3711, UF_CRM_1594568849232 = 147 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-13 З-СИБ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3697, UF_CRM_1594568849232 = 134 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ПФ-ЧЕРЕПОВ СЕВ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3758, UF_CRM_1594568849232 = 188 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧД-8_ВОРОНЕЖ ПРИВ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3705, UF_CRM_1594568849232 = 142 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-ЯРОСЛ СЕВ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3760, UF_CRM_1594568849232 = 190 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ПУ-БЕЛГОРОД ПРИВ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3698, UF_CRM_1594568849232 = 135 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ_САРАТОВ ПРИВ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3745, UF_CRM_1594568849232 = 175 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ПУ-ТАМБОВ ПРИВ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3750, UF_CRM_1594568849232 = 180 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ЛВЧ-26 З-СИБ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3730, UF_CRM_1594568849232 = 161 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      case 'ПФ-СБ В-СИБ':
         mysqli_query($link, "UPDATE b_uts_crm_deal SET UF_CRM_1596453903 = 3746, UF_CRM_1594568849232 = 176 WHERE b_uts_crm_deal.VALUE_ID = '$deal_id' ");
      break;
      }

mysqli_close($link);

?>
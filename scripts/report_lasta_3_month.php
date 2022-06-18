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

$query1 = mysqli_query($link, "SELECT 
  VALUE_ID, # ID
  UF_CRM_1650004947115, #ID рейса
  UF_CRM_1650006576943, # статус заявки
  UF_CRM_1650006598799, # рейс
  UF_CRM_1650017418593, # принадлежность рейса
  bufe2.VALUE as 'V1', # источник заявки
  UF_CRM_1650017273518, # название рейса
  UF_CRM_1650017062861, # номер состава
  bufe1.VALUE, # дирекция
  DATE_CREATE,
  UF_CRM_1650006492290,
  TITLE, # название
  UF_CRM_1650006329, # описание
  UF_CRM_1650006426063, # Решение\Причина отклонения
  bufe.value as 'V2',  /*Классификация*/
  UF_CRM_1650018461564,  /*Пользователей в сети*/
  UF_CRM_1650018509156,  /*Авторизованных пользователей*/
   UF_CRM_1650018540438, /*Трафик, байт*/
   UF_CRM_1650018582581, /*Авторизованный трафик, байт*/
  UF_CRM_1650017950598,
  UF_CRM_1650018642999,/*Замечания по чек-листу*/
  bcs.NAME
 FROM b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
left join b_crm_status bcs on bcs.STATUS_ID = b_crm_deal.STAGE_ID 
left join b_user_field_enum bufe on bufe.id = b_uts_crm_deal.UF_CRM_1650016954190
left join b_user_field_enum bufe1 on bufe1.id = b_uts_crm_deal.UF_CRM_1650017183826
join b_user_field_enum bufe2 on bufe2.id = b_uts_crm_deal.UF_CRM_1650017784178
 WHERE b_crm_deal.CATEGORY_ID = 15
AND DATE_CREATE > NOW() - INTERVAL 3 month
order by DATE_CREATE asc");


require_once 'PHPExcel/Classes/PHPExcel.php';

  $phpexcel = new PHPExcel(); 
  $page = $phpexcel->setActiveSheetIndex(0); 
  $page->setCellValue("A1", "ID"); 
  $page->setCellValue("B1", "ID рейса"); 
  $page->setCellValue("C1", "Статус заявки");
  $page->setCellValue("D1", "Рейс");
  $page->setCellValue("E1", "Рейс ФПК/ДОСС");
  $page->setCellValue("F1", "Источник заявки");
  $page->setCellValue("G1", "Название рейса");   
  $page->setCellValue("H1", "Серия, номер состава");  
  $page->setCellValue("I1", "Дирекция");
  $page->setCellValue("J1", "Дата создания");
  $page->setCellValue("K1", "Дата закрытия");
  $page->setCellValue("L1", "Название");
  $page->setCellValue("M1", "Описание");
  $page->setCellValue("N1", "Решение\Причина отклонения");
  $page->setCellValue("O1", "Классификация");
  $page->setCellValue("P1", "Пользователей в сети");
  $page->setCellValue("Q1", "Авторизованных пользователей");
  $page->setCellValue("R1", "Трафик, байт");
  $page->setCellValue("S1", "Авторизованный трафик, байт");
  $page->setCellValue("T1", "Замечаний по чек-листу");
  $page->setCellValue("U1", "Результат оказанных услуг");
  $page->setCellValue("V1", "Кто завел заявку");
  $page->setCellValue("W1", "Стадия заявки");
  
  



$page = $phpexcel->getActiveSheet(0);
$cellIterator = $page->getRowIterator()->current()->getCellIterator();
$cellIterator->setIterateOnlyExistingCells( true );
/** @var PHPExcel_Cell $cell */
#foreach( $cellIterator as $cell ) {
#        $page->getColumnDimension( $cell->getColumn() )->setAutoSize( true );
#}

$phpexcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$phpexcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$phpexcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$phpexcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$phpexcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$phpexcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$phpexcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$phpexcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$phpexcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$phpexcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$phpexcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$phpexcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
$phpexcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
$phpexcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
$phpexcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);

$phpexcel->getActiveSheet(0)->getStyle('A1:W1')->getFont()->setBold(true);


$phpexcel->getDefaultStyle() ->getBorders() ->getTop() ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$phpexcel->getDefaultStyle() ->getBorders() ->getBottom() ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$phpexcel->getDefaultStyle() ->getBorders() ->getLeft() ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
$phpexcel->getDefaultStyle() ->getBorders() ->getRight() ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$phpexcel->getDefaultStyle() ->getAlignment('A1:D1') ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$phpexcel->getDefaultStyle() ->getAlignment('E1:W1') ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 

$phpexcel->getActiveSheet()->setAutoFilter('A1:W1');





$s = 1;
while($row=mysqli_fetch_array($query1))
{
$s++;
    $page->setCellValue("A$s", $row['VALUE_ID']); 
  $page->setCellValue("B$s", $row['UF_CRM_1650004947115']);
  $page->setCellValue("C$s", $row['UF_CRM_1650006576943']);
  $page->setCellValue("D$s", $row['UF_CRM_1650006598799']); /*рейс */
  $page->setCellValue("E$s", $row['UF_CRM_1650017418593']); /*Рейс ФПК/ДОСС*/
  $page->setCellValue("F$s", $row['V1']); // Источник заявки
  $page->setCellValue("G$s", $row['UF_CRM_1650017273518']);   
  $page->setCellValue("H$s", $row['UF_CRM_1650017062861']);  
  $page->setCellValue("I$s", $row['VALUE']);
  $page->setCellValue("J$s", $row['DATE_CREATE']);
  $page->setCellValue("K$s", $row['UF_CRM_1650006492290']);
  $page->setCellValue("L$s", $row['TITLE']);
  $page->setCellValue("M$s", $row['UF_CRM_1650006329']);
  $page->setCellValue("N$s", $row['UF_CRM_1650006426063']);
  $page->setCellValue("O$s", $row['V2']);
  $page->setCellValue("P$s", $row['UF_CRM_1650018461564']);
  $page->setCellValue("Q$s", $row['UF_CRM_1650018509156']);
  $page->setCellValue("R$s", $row['UF_CRM_1650018540438']);
  $page->setCellValue("S$s", $row['UF_CRM_1650018582581']);
  $page->setCellValue("T$s", $row['UF_CRM_1650017950598']);
  $page->setCellValue("U$s", $row['UF_CRM_1650017950598123']);
  $page->setCellValue("V$s", $row['UF_CRM_1650018642999']);
  $page->setCellValue("W$s", $row['NAME']);
  } 

$myrow = mysqli_fetch_array($query1);

  $report_date = date('d.m.Y'); // 19-11-2003
  $page->setTitle("Report"); 
  $objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
  $objWriter->save("/home/bitrix/www/scripts/report_lasta/report_lasta_3_month_" . $report_date . ".xlsx");





#$telegram[0];
// Токен бота и идентификатор чата
$token='1223485972:AAEzNc9_JevZungd2XPFbdYjbRYHJRx1788';

$chat_id='-1001200658532';
#$chat_id='928161028';

//928161028
//-1001200658532

// Текст сообщения
$text= 'Отчёт по заявкам ласточки за 3 месяца: http://bitrix.rdl-telecom.ru/scripts/report_lasta/' . 'report_lasta_3_month_' . $report_date . '.xlsx';

//$text= 'Скачать отчёт: http://bitrix.rdl-telecom.com/scripts/reports/' . 'report_' . $report_date . '.xlsx' ;

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
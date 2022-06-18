<?php

if( isset( $_POST['my_button'] ) )
    echo 'Нажата кнопка my_button';

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
  bucd.VALUE_ID, 
  bucd.UF_CRM_1650006576943, # статус заявки
  bufe.VALUE as 'V1', # Приоритет
  bucd.UF_CRM_1650003076612, -- штабной вагон
  bcd.DATE_CREATE, -- Дата создания
  bucd.UF_CRM_1650006492290, -- дата закрытия
  bcd.TITLE, -- название
  bucd.UF_CRM_1650006329, -- описание
  bufe1.VALUE as 'V2',
  bucd.UF_CRM_1650006426063, -- решение
  bucd.UF_CRM_1650432989089,
  bcs.NAME -- по какой причине отклонена?
 FROM b_uts_crm_deal bucd
JOIN b_crm_deal bcd
ON bucd.VALUE_ID = bcd.ID 
left join b_crm_status bcs on bcs.STATUS_ID = bcd.STAGE_ID 
join b_user_field_enum bufe on bufe.id = bucd.UF_CRM_1650007980763 
left join b_user_field_enum bufe1 on bufe1.id = bucd.UF_CRM_1650004861312
WHERE bcd.CATEGORY_ID = 14
AND bcd.DATE_CREATE > NOW() - INTERVAL 3 month
order by DATE_CREATE asc");

require_once 'PHPExcel/Classes/PHPExcel.php';

  $phpexcel = new PHPExcel(); 
  $page = $phpexcel->setActiveSheetIndex(0); 
  $page->setCellValue("A1", "ID"); 
  $page->setCellValue("B1", "Статус заявки");
  $page->setCellValue("C1", "Приоритет");
  $page->setCellValue("D1", "Штабной вагон");
  $page->setCellValue("E1", "Дата создания");
  $page->setCellValue("F1", "Дата завершения");   
  $page->setCellValue("G1", "Название");  
  $page->setCellValue("H1", "Описание");
  $page->setCellValue("I1", "Классификация");
  $page->setCellValue("J1", "Решение");
  $page->setCellValue("K1", "По какой причине отклонена");
  $page->setCellValue("L1", "На ком заявка");
  
  #$page->setCellValue("L1", "Просрочена (часов)");
  #$page->setCellValue("M1", "Просрочена (минут)");

$page = $phpexcel->getActiveSheet(0);
$cellIterator = $page->getRowIterator()->current()->getCellIterator();
$cellIterator->setIterateOnlyExistingCells( true );
/** @var PHPExcel_Cell $cell */
foreach( $cellIterator as $cell ) {
        $page->getColumnDimension( $cell->getColumn() )->setAutoSize( true );
}

$phpexcel->getActiveSheet(0)->getStyle('A1:P1')->getFont()->setBold(true);

$phpexcel->getDefaultStyle() ->getBorders() ->getTop() ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$phpexcel->getDefaultStyle() ->getBorders() ->getBottom() ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$phpexcel->getDefaultStyle() ->getBorders() ->getLeft() ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
$phpexcel->getDefaultStyle() ->getBorders() ->getRight() ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$phpexcel->getDefaultStyle() ->getAlignment('A1:M1') ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


$phpexcel->getActiveSheet()->setAutoFilter('A1:M1');


$s = 1;
while($row=mysqli_fetch_array($query1))
{
$s++;
$page->setCellValue("A$s", $row['VALUE_ID']); 
  $page->setCellValue("B$s", $row['UF_CRM_1650006576943']);
  $page->setCellValue("C$s", $row['V1']); 
  $page->setCellValue("D$s", $row['UF_CRM_1650003076612']); 
  $page->setCellValue("E$s", $row['DATE_CREATE']); // Источник заявки
  $page->setCellValue("F$s", $row['UF_CRM_1650006492290']);   
  $page->setCellValue("G$s", $row['TITLE']);  
  $page->setCellValue("H$s", $row['UF_CRM_1650006329']);
  $page->setCellValue("I$s", $row['V2']);
  $page->setCellValue("J$s", $row['UF_CRM_1650006426063']);
  $page->setCellValue("K$s", $row['UF_CRM_1650432989089']);
  $page->setCellValue("L$s", $row['NAME']);
  
  #$page->setCellValue("L$s", $row['UF_CRM_1639136597022']);
  #$page->setCellValue("M$s", $row['UF_CRM_1639136614460']);
} 

$myrow = mysqli_fetch_array($query1);

$report_date = date('d.m.Y'); // 19-11-2003
  $page->setTitle("Report"); 
  $objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
  $objWriter->save("/home/bitrix/www/scripts/report_fpc/report_fpc1_" . $report_date . ".xlsx");


  #$telegram[0];
// Токен бота и идентификатор чата
$token='1223485972:AAEzNc9_JevZungd2XPFbdYjbRYHJRx1788';

$chat_id='-471251721';
//$chat_id='928161028';
//928161028
//-1001200658532

// Текст сообщения
$text= 'Отчёт по заявкам попутчик за 3 месяца: http://bitrix.rdl-telecom.ru/scripts/report_fpc/' . 'report_fpc1_' . $report_date . '.xlsx';

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
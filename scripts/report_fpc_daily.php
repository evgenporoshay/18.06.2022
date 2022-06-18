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

$report_date = date('d.m.Y'); // 19-11-2003

$res_tasks_sutki = $link->query("SELECT COUNT(*) FROM b_crm_deal WHERE CATEGORY_ID = '14' AND DATE_CREATE >= NOW() - INTERVAL 24 HOUR");

$row_tasks_sutki = $res_tasks_sutki->fetch_row();
$count_tasks_sutki = $row_tasks_sutki[0];


$res_tasks_month = $link->query("SELECT COUNT(*) FROM 
b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
WHERE b_crm_deal.CATEGORY_ID = 14 
AND  MONTH(DATE_CREATE) = MONTH(NOW()) AND YEAR(DATE_CREATE) = YEAR(NOW())
");

$row_tasks_month = $res_tasks_month->fetch_row();
$count_tasks_month = $row_tasks_month[0];

$const = 261;

$res_deals_year = $link->query("SELECT COUNT(*)+567 as 'count' FROM b_crm_deal where CATEGORY_ID = '14'
AND b_crm_deal.DATE_CREATE BETWEEN '2022-04-01 00:00:00' AND '2022-12-31 23:59:59'");
$row_deals_year = $res_deals_year->fetch_row();
$count_deal_year = $row_deals_year[0];

$deals_year = $count_deal_year;




$query1 = mysqli_query($link, "SELECT 
  VALUE_ID,
  TITLE, 
  UF_CRM_1650006329, # Описание
  bucd.UF_CRM_1650006576943, #Статус заявки
  bufe.VALUE as 'V1', # Приоритет
  bcd.DATE_CREATE , # Дата создания
  bucd.UF_CRM_1650006492290, # Дата закрытия
  bufe1.VALUE , # Классификация
  bucd.UF_CRM_1650003076612, # Штабной вагон
  bucd.UF_CRM_1650006598799, # Рейс
  bucd.UF_CRM_1650006678598, #Станция отправления
  bucd.UF_CRM_1650006719974, # Станция прибытия 
  bucd.UF_CRM_1650006426063 # Решение
FROM b_uts_crm_deal bucd
JOIN b_crm_deal bcd
ON bucd.VALUE_ID = bcd.ID
join b_user_field_enum bufe on bufe.id = bucd.UF_CRM_1650007980763
left join b_user_field_enum bufe1 on bufe1.id = bucd.UF_CRM_1650004861312
WHERE STAGE_ID = 'C14:NEW' 
OR STAGE_ID = 'C14:PREPARATION' 
OR STAGE_ID = 'C14:PREPAYMENT_INVOIC' 
OR STAGE_ID = 'C14:EXECUTING' 
OR STAGE_ID = 'C14:FINAL_INVOICE' 
OR STAGE_ID = 'C14:UC_6LNTZB'
union
  SELECT 
  VALUE_ID,
  TITLE, 
  UF_CRM_1650006329, # Описание
  bucd.UF_CRM_1650006576943, #Статус заявки
  bufe.VALUE as 'V1', # Приоритет
  bcd.DATE_CREATE , # Дата создания
  bucd.UF_CRM_1650006492290, # Дата закрытия
  bufe1.VALUE , # Классификация
  bucd.UF_CRM_1650003076612, # Штабной вагон
  bucd.UF_CRM_1650006598799, # Рейс
  bucd.UF_CRM_1650006678598, #Станция отправления
  bucd.UF_CRM_1650006719974, # Станция прибытия 
  bucd.UF_CRM_1650006426063 # Решение
 FROM b_uts_crm_deal bucd
JOIN b_crm_deal bcd
ON bucd.VALUE_ID = bcd.ID
join b_user_field_enum bufe on bufe.id = bucd.UF_CRM_1650007980763
left join b_user_field_enum bufe1 on bufe1.id = bucd.UF_CRM_1650004861312
WHERE bcd.CATEGORY_ID = 14
 AND DATE(bcd.CLOSEDATE) = DATE(NOW() - INTERVAL 24 HOUR)");


require_once 'PHPExcel/Classes/PHPExcel.php';

  $phpexcel = new PHPExcel(); 
  $page = $phpexcel->setActiveSheetIndex(0); 

  $page->setCellValue("A12", "ID"); 
  $page->setCellValue("B12", "Название");
  $page->setCellValue("C12", "Описание");
  $page->setCellValue("D12", "Статус заявки");   
  $page->setCellValue("E12", "Приоритет");  
  $page->setCellValue("F12", "Дата создания");
  $page->setCellValue("G12", "Дата закрытия");
  $page->setCellValue("H12", "Классификация");
  $page->setCellValue("I12", "Штабной вагон");
  $page->setCellValue("J12", "Рейс");
  $page->setCellValue("K12", "Станция отправления");
  $page->setCellValue("L12", "Станция прибытия");
  $page->setCellValue("M12", "Решение");



$page = $phpexcel->getActiveSheet(0);

// Вставляем текст в ячейку A1
$page->setCellValue("A1", 'Коллеги, добрый день.');
$page->mergeCells('A1:C1');

$page->setCellValue("A2", 'Отчет за');


$page->setCellValue("B2", $report_date);
$page->mergeCells('B2:C2');

#$phpexcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
#$phpexcel->getDefaultStyle()->getAlignment('D2:E2') ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$phpexcel->getActiveSheet()->getStyle('B2:C2')->getFont()->setBold(true);
$phpexcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);

$page->setCellValue("A3", '1. сведения о принятых и зарегистрированных заявках по сбоям и неисправностям, зафиксированным в работе');
$page->mergeCells('A3:L3');

$page->mergeCells('A11:M11');

$page->setCellValue("A4", 'оборудования в соответствии с пунктом 4.2.1 Регламента – Таблица 1');
$page->mergeCells('A4:H4');

$phpexcel->getActiveSheet(0)->getStyle('A12:M12')->getFont()->setBold(true);

$page->setCellValue("A5", '2. количество заявок за сутки и итогом за месяц/год, информацию о сбоях и неисправностях оборудования');
$page->mergeCells('A5:L5');

$page->setCellValue("A6", '(пункт 4.2.2 Регламента)');
$page->mergeCells('A6:C6');

$page->setCellValue("A7", 'За сутки:');
$phpexcel->getActiveSheet(0)->getStyle('A7')->getFont()->setBold(true);
#$phpexcel->getDefaultStyle(0)->getAlignment('A7')->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$page->getStyle("A7")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$page->getStyle("A7")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$page->getStyle("A2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$page->getStyle("A2")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$page->getStyle("A8")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$page->getStyle("A8")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$page->getStyle("A9")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$page->getStyle("A9")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$page->getStyle("A3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$page->getStyle("A3")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$page->getStyle("A4")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$page->getStyle("A4")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$page->getStyle("A5")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$page->getStyle("A5")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$page->getStyle("A6")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$page->getStyle("A6")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$page->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$page->getStyle("A1")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$page->getStyle("A10")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$page->getStyle("A10")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$page->getStyle("B7")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$page->getStyle("B7")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$page->getStyle("B8")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$page->getStyle("B8")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$page->getStyle("B9")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$page->getStyle("B9")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$page->getStyle("A12")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$page->getStyle("A12")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$page->getColumnDimensionByColumn("A")->setAutoSize(true);







$page->getStyle("B:M")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$page->getStyle("B:M")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$page->setCellValue("B7", $count_tasks_sutki);
#$phpexcel->getDefaultStyle(0)->getAlignment('B7')->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$phpexcel->getActiveSheet(0)->getStyle('B7')->getFont()->setBold(true); 

$page->setCellValue("A8", 'За месяц: ');
$phpexcel->getActiveSheet(0)->getStyle('A8')->getFont()->setBold(true);
#$page->getDefaultStyle(0)->getAlignment('A8')->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

$page->setCellValue("B8", $count_tasks_month);
#$phpexcel->getDefaultStyle(0)->getAlignment('B8')->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$phpexcel->getActiveSheet(0)->getStyle('B8')->getFont()->setBold(true); 

$page->setCellValue("A9", 'Итого за год:');
$phpexcel->getActiveSheet(0)->getStyle('A9')->getFont()->setBold(true);
#$page->getDefaultStyle(0)->getAlignment('A9')->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$page->setCellValue("B9", $deals_year);
#$phpexcel->getDefaultStyle(0)->getAlignment('B9')->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$phpexcel->getActiveSheet(0)->getStyle('B9')->getFont()->setBold(true); 

$page->setCellValue("A10", 'Результаты мониторинга подвижного состава (по отправлениям) - Таблица №2');
$page->mergeCells('A10:L10');

#$page->getDefaultStyle(0)->getAlignment('A7')->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



$phpexcel->getDefaultStyle() ->getBorders() ->getTop() ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$phpexcel->getDefaultStyle() ->getBorders() ->getBottom() ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$phpexcel->getDefaultStyle() ->getBorders() ->getLeft() ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
$phpexcel->getDefaultStyle() ->getBorders() ->getRight() ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$phpexcel->getDefaultStyle() ->getAlignment('A12:A200') ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
#$phpexcel->getDefaultStyle() ->getAlignment('E13:M13') ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 

$phpexcel->getActiveSheet()->setAutoFilter('A12:M12');





$s = 12;
while($row=mysqli_fetch_array($query1))
{
$s++;
  $page->setCellValue("A$s", $row['VALUE_ID']); 
  $page->setCellValue("B$s", $row['TITLE']);
  $page->setCellValue("C$s", $row['UF_CRM_1650006329']);
  $page->setCellValue("D$s", $row['UF_CRM_1650006576943']);   
  $page->setCellValue("E$s", $row['V1']);  
  $page->setCellValue("F$s", $row['DATE_CREATE']);
  $page->setCellValue("G$s", $row['UF_CRM_1650006492290']);
  $page->setCellValue("H$s", $row['VALUE']);
  $page->setCellValue("I$s", $row['UF_CRM_1650003076612']);
  $page->setCellValue("J$s", $row['UF_CRM_1650006598799']);
  $page->setCellValue("K$s", $row['UF_CRM_1650006678598']);
  $page->setCellValue("L$s", $row['UF_CRM_1650006719974']);
  $page->setCellValue("M$s", $row['UF_CRM_1650006426063']);
} 

$myrow = mysqli_fetch_array($query1);

  $page->setTitle("Таблица 1"); 

  $report_date = date('d.m.Y');
  $objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
  $objWriter->save("/home/bitrix/www/scripts/report_fpc/report_fpc_". $report_date . ".xlsx" );
  

#$telegram[0];
// Токен бота и идентификатор чата
$token='1223485972:AAEzNc9_JevZungd2XPFbdYjbRYHJRx1788';
$chat_id='-471251721';
//$chat_id='928161028';
//928161028
//

// Текст сообщения
$text= 'Отчёт ФПК ежедневный: http://bitrix.rdl-telecom.ru/scripts/report_fpc/' . 'report_fpc_'. $report_date . '.xlsx';
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
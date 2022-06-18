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

$query1 = mysqli_query($link, "SELECT
VALUE_ID,
UF_CRM_1611867292691,
UF_CRM_1611868545132,
UF_CRM_1594368335083,
UF_CRM_1611866839287,
UF_CRM_1611481422817,
UF_CRM_1611865522941,
UF_CRM_1611413941886,
bie.name as 'depo'
FROM b_uts_crm_deal bucd
JOIN b_crm_deal bcd
ON bucd.VALUE_ID = bcd.ID
LEFT JOIN b_iblock_element bie ON bie.id = bucd.UF_CRM_1596453903
WHERE STAGE_ID = 'C34:NEW'
OR STAGE_ID = 'C34:PREPARATION'
OR STAGE_ID = 'C34:1'
OR STAGE_ID = 'C34:2'
OR STAGE_ID = 'C34:3'
OR STAGE_ID = 'C34:4'");


require_once 'PHPExcel/Classes/PHPExcel.php';

  $phpexcel = new PHPExcel();
  $page = $phpexcel->setActiveSheetIndex(0);
  
  $page->setCellValue("A1", "Номер заявки");
  $page->setCellValue("B1", "Статус заявки");
  $page->setCellValue("C1", "Приоритет");
  $page->setCellValue("D1", "Штабной вагон");
  $page->setCellValue("E1", "Название");
  $page->setCellValue("F1", "Дата создания");
  $page->setCellValue("G1", "Отдел");
  $page->setCellValue("H1", "Крайний срок");
  $page->setCellValue("I1", "Депо управления");

$page = $phpexcel->getActiveSheet(0);
$cellIterator = $page->getRowIterator()->current()->getCellIterator();
$cellIterator->setIterateOnlyExistingCells( true );
/** @var PHPExcel_Cell $cell */
foreach( $cellIterator as $cell ) {
        $page->getColumnDimension( $cell->getColumn() )->setAutoSize( true );
}

$phpexcel->getActiveSheet(0)->getStyle('A1:I1')->getFont()->setBold(true);


$phpexcel->getDefaultStyle() ->getBorders() ->getTop() ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$phpexcel->getDefaultStyle() ->getBorders() ->getBottom() ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$phpexcel->getDefaultStyle() ->getBorders() ->getLeft() ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$phpexcel->getDefaultStyle() ->getBorders() ->getRight() ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$phpexcel->getDefaultStyle() ->getAlignment('A1:D1') ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$phpexcel->getDefaultStyle() ->getAlignment('E1:I1') ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

$phpexcel->getActiveSheet()->setAutoFilter('A1:I1');





$s = 1;
while($row=mysqli_fetch_array($query1))
{
$s++;
  $page->setCellValue("A$s", $row['VALUE_ID']);
  $page->setCellValue("B$s", $row['UF_CRM_1611867292691']);
  $page->setCellValue("C$s", $row['UF_CRM_1611868545132']);
  $page->setCellValue("D$s", $row['UF_CRM_1594368335083']);
  $page->setCellValue("E$s", $row['UF_CRM_1611866839287']);
  $page->setCellValue("F$s", $row['UF_CRM_1611481422817']);
  $page->setCellValue("G$s", $row['UF_CRM_1611865522941']);
  $page->setCellValue("H$s", $row['UF_CRM_1611413941886']);
  $page->setCellValue("I$s", $row['depo']);

}
$report_date = date('d.m.Y'); // 19-11-2003
$myrow = mysqli_fetch_array($query1);

  $page->setTitle("Report");
  $objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');



$objWriter->save("/home/bitrix/www/scripts/reports/report_" . $report_date . ".xlsx"   );



#$telegram[0];
// Токен бота и идентификатор чата
$token='1223485972:AAEzNc9_JevZungd2XPFbdYjbRYHJRx1788';
$chat_id='525847319';
//928161028
//
// Текст сообщения
$text= 'Скачать отчёт: http://bitrix.rdl-telecom.com/scripts/reports/' . 'report_' . $report_date . '.xlsx' ;

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
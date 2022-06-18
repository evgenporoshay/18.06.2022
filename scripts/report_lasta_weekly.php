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
  UF_CRM_1610721066423,
  UF_CRM_1611867292691, 
  UF_CRM_1610720954927, /*рейс */
  UF_CRM_1632913575811, /*Рейс ФПК/ДОСС*/
  UF_CRM_1633539115232, /*Источник*/
  UF_CRM_1611911001842, 
  UF_CRM_1611906935280,
  UF_CRM_1611909515866,
  UF_CRM_1611481422817,
  UF_CRM_1611909185274,
  TITLE, 
  UF_CRM_5EE5F20A15E11,
  UF_CRM_1607608436,
  UF_CRM_1644556545874,  /*Классификация*/
  UF_CRM_1643643036637,  /*Пользователей в сети*/
  UF_CRM_1635595990592,  /*Авторизованных пользователей*/
   UF_CRM_1643643060013, /*Трафик, байт*/
   UF_CRM_1635596006021, /*Авторизованный трафик, байт*/
  UF_CRM_1635596045446, /*Замечания по чек-листу*/
  UF_CRM_1635597334104,
  UF_CRM_1639247756423,
  bcs.NAME
 FROM b_uts_crm_deal 
JOIN b_crm_deal 
ON b_uts_crm_deal.VALUE_ID = b_crm_deal.ID
join b_crm_status bcs on bcs.STATUS_ID = b_crm_deal.STAGE_ID 
WHERE UF_CRM_1611906513352 = 'true' AND b_crm_deal.CATEGORY_ID = 35
AND UF_CRM_1611481422817 > NOW() - INTERVAL 7 day
");


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
 #       $page->getColumnDimension( $cell->getColumn() )->setAutoSize( true );
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

$phpexcel->getActiveSheet(0)->getStyle('A1:U1')->getFont()->setBold(true);


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
  $page->setCellValue("B$s", $row['UF_CRM_1610721066423']);
  $page->setCellValue("C$s", $row['UF_CRM_1611867292691']);
  $page->setCellValue("D$s", $row['UF_CRM_1610720954927']); /*рейс */
  $page->setCellValue("E$s", $row['UF_CRM_1632913575811']); /*Рейс ФПК/ДОСС*/
  $page->setCellValue("F$s", $row['UF_CRM_1633539115232']); // Источник заявки
  $page->setCellValue("G$s", $row['UF_CRM_1611911001842']);   
  $page->setCellValue("H$s", $row['UF_CRM_1611906935280']);  
  $page->setCellValue("I$s", $row['UF_CRM_1611909515866']);
  $page->setCellValue("J$s", $row['UF_CRM_1611481422817']);
  $page->setCellValue("K$s", $row['UF_CRM_1611909185274']);
  $page->setCellValue("L$s", $row['TITLE']);
  $page->setCellValue("M$s", $row['UF_CRM_5EE5F20A15E11']);
  $page->setCellValue("N$s", $row['UF_CRM_1607608436']);
  $page->setCellValue("O$s", $row['UF_CRM_1644556545874']);
  $page->setCellValue("P$s", $row['UF_CRM_1643643036637']);
  $page->setCellValue("Q$s", $row['UF_CRM_1635595990592']);
  $page->setCellValue("R$s", $row['UF_CRM_1643643060013']);
  $page->setCellValue("S$s", $row['UF_CRM_1635596006021']);
  $page->setCellValue("T$s", $row['UF_CRM_1635596045446']);
  $page->setCellValue("U$s", $row['UF_CRM_1635597334104']);
  $page->setCellValue("V$s", $row['UF_CRM_1639247756423']);
  $page->setCellValue("W$s", $row['NAME']);
  
} 

$myrow = mysqli_fetch_array($query1);

  $report_date = date('d.m.Y'); // 19-11-2003
  $page->setTitle("Report"); 
  $objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
  $objWriter->save("/home/bitrix/www/scripts/report_lasta/report_lasta_weekly_" . $report_date . ".xlsx");





#$telegram[0];
// Токен бота и идентификатор чата
$token='1223485972:AAEzNc9_JevZungd2XPFbdYjbRYHJRx1788';

$chat_id='-1001200658532';
//928161028
//-1001200658532

// Текст сообщения
$text= 'Еженедельный отчёт по заявкам ласточки: http://bitrix.rdl-telecom.com/scripts/report_lasta/' . 'report_lasta_weekly_' . $report_date . '.xlsx';

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
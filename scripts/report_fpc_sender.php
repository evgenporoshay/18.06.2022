<?php


// Инициализируем URL файла в переменную

$url = 'https://sumrv.rdl-telecom.ru/api/sumrv-1/doc_formatter/reports/topred/daily/routes/daily_topred_routes_report.xlsx?from=&to=';
$url2 = 'http://trainer.rdl-telecom.ru/api/report/yesterday';

$thisDate = date('Y-m-d');
$report_date2 = date('Y-m-d', strtotime($thisDate. " - 1 day"));
// Используем функцию basename () для возврата базового имени файла
$report_date = date('d.m.Y'); // 19-11-2003
$file_name = '/home/bitrix/www/scripts/report_fpc/Отчёт о работоспособности оборудования ' . $report_date . '.xlsx';
$file_name2 = '/home/bitrix/www/scripts/report_fpc/Статистика ФПК ' . $report_date2 . '.xls';
   

if(file_put_contents( $file_name,file_get_contents($url))) {

    echo "File downloaded successfully";

}

else {

    echo "File downloading failed.";

}


if(file_put_contents( $file_name2,file_get_contents($url2))) {

    echo "File downloaded successfully";

}

else {

    echo "File downloading failed.";

}




// Пример вывода: Размер файла somefile.txt: 1024 байта




$filename3 =  filesize($file_name2);


if ($filename3 == 0) {

    file_put_contents($file_name2,file_get_contents($url2));

} else {
    echo '123';

}


sleep(60);

require '/home/bitrix/www/scripts/PHPMailer/src/Exception.php';
require '/home/bitrix/www/scripts/PHPMailer/src/PHPMailer.php';
require '/home/bitrix/www/scripts/PHPMailer/src/SMTP.php';
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->CharSet = 'UTF-8';


#$filename1 = "./report_fpc/report_fpc_". $report_date . ".xlsx";
#$filename2 = './report_fpc/report_fpc/daily_yo_pred ' . $report_date . '.xlsx';

$mail->setFrom('crm@rdl-telecom.com', 'Техподдержка ООО РДЛ-Телеком:');
$mail->addAddress('otchet_poputchik@fpc.ru', 'ФПК');
$mail->addAddress('helpdesk@rdl-telecom.com', 'РДЛ-Телеком');
$mail->addAddress('r.gelvelchuk@rdl-telecom.com', 'Роман Гельвельчук');
$mail->addAddress('e.poroshay@rdl-telecom.com', 'РДЛ-Телеком');
$mail->Subject = 'Отчёт ФПК ' . $report_date;
$mail->msgHTML("Добрый день! Отчет во вложении");
    // Attach uploaded files

$mail->addAttachment('/home/bitrix/www/scripts/report_fpc/report_fpc_'. $report_date . ".xlsx");    

$mail->addAttachment('/home/bitrix/www/scripts/report_fpc/Отчёт о работоспособности оборудования ' . $report_date . '.xlsx');   
$mail->addAttachment('/home/bitrix/www/scripts/report_fpc/Статистика ФПК ' . $report_date2 . '.xls');   



$r = $mail->send();


?>
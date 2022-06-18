<?php
// Инициализируем URL файла в переменную

$url2 = 'http://trainer.rdl-telecom.ru/api/report/yesterday/';

$thisDate = date('Y-m-d');
$report_date2 = date('Y-m-d', strtotime($thisDate. " - 1 day"));
// Используем функцию basename () для возврата базового имени файла
$file_name2 = '/home/bitrix/www/scripts/report_fpc/Статистика ФПК ' . $report_date2 . '.xls';



if(file_put_contents($file_name2,file_get_contents($url2))) {

    echo "File downloaded successfully";

}

else {

    echo "File downloading failed.";

}

sleep(15);

if(file_put_contents($file_name2,file_get_contents($url2))) {

    echo "File downloaded successfully";

}

else {

    echo "File downloading failed.";

}


?>
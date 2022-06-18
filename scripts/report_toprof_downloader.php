<?php
// Инициализируем URL файла в переменную



$thisDate = date('Y-m-d');
$url2 = 'https://sumrv.rdl-telecom.ru/api/sumrv-1/doc_formatter/serve/files/toprof/to_prof_details.xlsx?from=' . '$thisDate'. '&to=';
$report_date2 = date('Y-m-d', strtotime($thisDate. " - 1 day"));
// Используем функцию basename () для возврата базового имени файла
$file_name2 = '/home/bitrix/www/scripts/toprof/uploads/toprof_' . $thisDate . '.xls';



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
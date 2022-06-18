<?php  


$fp = fopen('./sapsan.txt', 'w'); // создание файла
$ch = curl_init('http://185.102.120.178:55373/api/log/sapsan');

curl_setopt($ch, CURLOPT_FILE, $fp); // запись в файл
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);

curl_exec($ch);


?>
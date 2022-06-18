<?php

set_time_limit(600);
$servername = 'localhost'; // ваш хост
$database = 'sitemanager'; // ваша бд
$username = 'bitrix0'; // пользователь бд
$password = 'VwAR1{2[(?1[{iRLqCLz'; // пароль к бд

// Создаем соединение
$conn = mysqli_connect($servername, $username, $password, $database);

$res_stpwork_sum = $conn->query("SELECT count(route)
    FROM select_table st 
WHERE `type` = 'special' AND depart >= NOW()");
 $row_stpwork_sum = $res_stpwork_sum->fetch_row();
 $route = $row_stpwork_sum[0];


 mysqli_close($conn);






/* ОТПРАВКА ФАЙЛА В ТЕЛЕГРАММ */
function sendFileTelegram($fileTempName) {
  /*токен который выдаётся при регистрации бота */
  $token = "1223485972:AAEzNc9_JevZungd2XPFbdYjbRYHJRx1788";
  /*идентификатор группы*/
  $chat_id = "928161028";
$_document = '/home/bitrix/www/scripts/report_fpc/report_fpc_19.12.2021.xlsx';
  $urlSite = "https://api.telegram.org/bot{$token}/sendDocument";

  $document = new CURLFile(realpath($_document));

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $urlSite);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, ["chat_id" => $chat_id, "document" => $document]);
  curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type:multipart/form-data"]);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  $out = curl_exec($ch);
  curl_close($ch);
}

sendFileTelegram($_FILES["fileImg"]["tmp_name"]);



?>
<?php 

set_time_limit(600);
$servername = 'localhost'; // ваш хост
$database = 'sitemanager'; // ваша бд
$username = 'bitrix0'; // пользователь бд
$password = 'MDiyWby(sfjfi_FRplwd'; // пароль к бд

// Создаем соединение

$conn = mysqli_connect($servername, $username, $password, $database);

$res_stpwork_sum = $conn->query("SELECT count(*) FROM cars");
 $row_stpwork_sum = $res_stpwork_sum->fetch_row();
 $count = $row_stpwork_sum[0];

 $count2 = 'Добавлено ' . ($count - 11)  . ' записей.';

$res_stpwork_sum1 = $conn->query("SELECT count(*) FROM cars");
 $row_stpwork_sum1 = $res_stpwork_sum1->fetch_row();
 $count3 = $row_stpwork_sum1[0];

$to  = "helpdesk@rdl-telecom.com," ;
$to .= "e.poroshay@rdl-telecom.com";
$subject = "Обновлен справочник вагонов АСУПВ"; 
$message = ' <p>Обновлен справочник вагонов АСУПВ</p> </br>
              <br />
             Выполнена обработка записей. <br />
             Записей в БД: ' .  $count3   ;
$headers  = "Content-type: text/html; charset=UTF-8 \r\n";
$headers .= "From: РДЛ-Телеком <crm@rdl-telecom.com>\r\n"; 
$headers .= "Reply-To: 89152547650@mail.ru\r\n"; 

mail($to, $subject, $message, $headers); 
?>
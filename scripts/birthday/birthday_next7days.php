<?php 


$db_host='localhost'; // ваш хост
$db_name='sitemanager'; // ваша бд
$db_user='bitrix0'; // пользователь бд
$db_pass='VwAR1{2[(?1[{iRLqCLz'; // пароль к бд

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);// включаем сообщения об ошибках
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name); // коннект с сервером бд

$mysqli->set_charset("utf8mb4"); // задаем кодировку

$result = $mysqli->query('SELECT NAME, LAST_NAME,  PERSONAL_BIRTHDAY
FROM  b_user
WHERE  DATE_ADD(PERSONAL_BIRTHDAY, 
                INTERVAL YEAR(CURDATE())-YEAR(PERSONAL_BIRTHDAY)
                         + IF(DAYOFYEAR(CURDATE()) > DAYOFYEAR(PERSONAL_BIRTHDAY),1,0)
                YEAR)  
            BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY);'); // запрос на выборку
$count = mysqli_num_rows($result); // количество строк в запросе

$title .= '<b>Уважаемые Коллеги! </b><br /> <p>На следующей неделе, отмечают свой день рождения:<br /></p>';
while($row = $result->fetch_assoc())// получаем все строки в цикле по одной
{
    
    $message .= '<p><b>'.$row['NAME']. ' '.$row['LAST_NAME'].'</b>, Дата рождения: '.$row['PERSONAL_BIRTHDAY'].'</p>';// выводим данные

}

$final_message = $title.$message;

$to  = "info@rdl-telecom.com," ;
$to .= "89152547650@mail.ru";

$subject = "День рождения!";

$message =  $final_message;

$headers  = "Content-type: text/html; charset=UTF-8 \r\n";
$headers .= "From: РДЛ-Телеком <crm@rdl-telecom.com>\r\n";
$headers .= "Reply-To: e.poroshay@rdl-telecom.com\r\n";

if ($count) {

	mail($to, $subject, $message, $headers);
}

else {

	die;
}


?>
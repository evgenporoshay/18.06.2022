<?php 

$db_host='localhost'; // ваш хост
$db_name='sitemanager'; // ваша бд
$db_user='bitrix0'; // пользователь бд
$db_pass='VwAR1{2[(?1[{iRLqCLz'; // пароль к бд
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);// включаем сообщения об ошибках
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name); // коннект с сервером бд
$mysqli->set_charset("utf8mb4"); // задаем кодировку

$result = $mysqli->query("SELECT bu.NAME, bu.LAST_NAME, DATE_FORMAT(bu.PERSONAL_BIRTHDAY, ('%d.%m.%Y')) AS 'birthday', bui.UF_DEPARTMENT_NAME
FROM b_user bu
JOIN b_user_index bui ON
bui.USER_ID = bu.ID
WHERE DATE_ADD(bu.PERSONAL_BIRTHDAY, INTERVAL YEAR(CURDATE())-YEAR(bu.PERSONAL_BIRTHDAY) + IF(DAYOFYEAR(CURDATE()) > DAYOFYEAR(bu.PERSONAL_BIRTHDAY), 1, 0) YEAR) = DATE_ADD(CURDATE(), INTERVAL 2 day)
AND UF_DEPARTMENT_NAME = 'ПФ-ИВАНОВО' AND bu.ACTIVE = 'Y'"); // запрос на выборку
$count = mysqli_num_rows($result); // количество строк в запросе
$title .= '<b>Уважаемый Андрей! </b><br /> <p>Через 2 дня у следующих сотрудников вашего отдела будет День Рождения! <br /> Не забудьте их поздравить!<br /></p>';
while($row = $result->fetch_assoc())// получаем все строки в цикле по одной
{  
    $message .= '<p><b>'.$row['NAME']. ' '.$row['LAST_NAME'].'</b>, Дата рождения: '.$row['birthday'].'</p>';// выводим данные
}
$final_message = $title.$message;

$to  = "a.vishnyakov@rdl-telecom.com," ;
$to .= "e.poroshay@rdl-telecom.com";
$subject = "День рождения!";
$message =  $final_message;
$headers  = "Content-type: text/html; charset=UTF-8 \r\n";
$headers .= "crm@rdl-telecom.com\r\n";
$headers .= "Reply-To: e.poroshay@rdl-telecom.com\r\n";
if ($count) {
    mail($to, $subject, $message, $headers);
}
else {
    die;
}
$mysqli->close();

?>
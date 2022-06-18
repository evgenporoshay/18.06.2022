<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Проверка актуальности справочника");
?>
<?php
#set_time_limit(600);
$servername = 'localhost'; // ваш хост
$database = 'sitemanager'; // ваша бд
$username = 'bitrix0'; // пользователь бд
$password = 'MDiyWby(sfjfi_FRplwd'; // пароль к бд

// Создаем соединение

$conn = mysqli_connect($servername, $username, $password, $database);

$res_stpwork_sum = $conn->query("SELECT `date_update` FROM cars_update cu 
WHERE id = (SELECT max(id) FROM cars_update cu )");
 $row_stpwork_sum = $res_stpwork_sum->fetch_row();
 $count = $row_stpwork_sum[0];

 $count2 = 'Дата последнего обновления справочника: ' .'<b>' . ($count) .'</b>'. '<br />'. '<br />';

if(isset($_POST["done"])){
if ($_POST["name"] == "")
  
mysqli_close($conn);

echo $count2;




  //header("Location:check.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Обработка формы</title>
</head>
<body>

<form name="test" action="" method="post">
  <input type="submit" name="done" value="Проверить дату" />
</form>
</body>
</html>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
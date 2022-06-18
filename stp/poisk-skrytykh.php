<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск скрытых");
?><html>
    <head>
    </head>
    <body>

<h3> Поиск по скрытым заявкам </h3><br>
<form method="POST">

            Номер заявки: <input type="text" pattern="[0-9]{5}" required name="id">
            
            <input type="submit" value="OK">
<br>
<br>
</form>
<?php
    if(!empty($_POST))
    {
       
$id = $_POST[id];

// подключение к базе данных
$host = 'localhost'; // ваш хост
$user = 'bitrix0'; // пользователь бд
$pass = 'MDiyWby(sfjfi_FRplwd'; // пароль к бд
$db_name = 'sitemanager'; // ваша бд
$link = mysqli_connect($host, $user, $pass, $db_name); // Соединяемся с базой

// Ругаемся, если соединение установить не удалось
if (!$link) {
    echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
    exit;
}



$query1 = mysqli_query($link, "

   SELECT TITLE FROM b_crm_deal WHERE id = '$id' AND CATEGORY_ID = 21");

while($row = $query1->fetch_assoc())

$info .= $row['TITLE'];




echo  $info;

echo '<br>';
echo '<br>';




mysqli_close($link);





    }

    require_once('poisk-skrytykh.php');
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
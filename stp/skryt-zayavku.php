<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Скрыть заявку");
?><html>
    <head>
    </head>
    <body>

<h3> Скрыть заявку в Битрикс </h3><br>
<form method="POST">

            Номер заявки: <input type="text" pattern="[0-9]{5}" required name="id">
            
            <input type="submit" value="OK">
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


mysqli_query($link, "UPDATE b_crm_deal SET CATEGORY_ID = 21, STAGE_ID = 'C21:LOSE' WHERE ID = '$id'
LIMIT 1");

echo '<p style="color: green; font-size: 20px; ">Заявка скрыта  </p>' ;


$text .= 'Заявка ' . $id . ' перемещена в раздел Скрытых';
  
#$telegram[0];
// Токен бота и идентификатор чата
$token='1223485972:AAEzNc9_JevZungd2XPFbdYjbRYHJRx1788';
$chat_id='-471251721';


// Отправить сообщение
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL,
    'https://api.telegram.org/bot'.$token.'/sendMessage');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_POSTFIELDS,
    'chat_id='.$chat_id.'&text='.urlencode($text));
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);

$result=curl_exec($ch);
curl_close($ch);

    }
mysqli_close($link);
    require_once('skryt-zayavku.php');
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
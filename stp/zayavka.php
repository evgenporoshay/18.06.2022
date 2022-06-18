<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заявка \"Попутчик\"");
?><html>
    <head>
    </head>
    <body>
<h3> Заведение заявки "Попутчик" </h3><br>
<form method="POST">

            ID рейса: <input type="text" pattern="[0-9]{6}" required name="id">
            
            <input type="submit" value="OK">
</form>
<?php
    if(!empty($_POST))
    {
       
$id = $_POST[id];


header("Location: http://bitrix.rdl-telecom.ru/scripts/poputchik/api_deal_bitrix.php?id=$id ");


    }

    require_once('zayavka.php');
?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
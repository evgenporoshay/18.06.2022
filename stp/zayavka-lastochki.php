<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заявка \"Ласточки\"");
?><html>
    <head>
    </head>
    <body>

<h3> Заведение заявки "Ласточки" </h3><br>
<form method="POST">

            ID рейса: <input type="text" pattern="[0-9]{6}" required name="id">
            
            <input type="submit" value="OK">
</form>
<?php
    if(!empty($_POST))
    {
       
$id = $_POST[id];


header("Location: http://bitrix.rdl-telecom.ru/scripts/lastochka/api_deal_lasta_bitrix.php?id=$id ");
    }

    require_once('zayavka-lastochki.php');
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
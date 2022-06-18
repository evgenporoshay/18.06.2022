<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Обновление справочника вагонов");
?>




<html>
<head>
<title>Обновление справочника вагонов</title>
<meta charset="utf-8" />
</head>
<body>

<h2>Загрузка файла справочника вагонов из АСУПВ </h2>

Планировщик запускает обновление справочника вагонов <br />
<b>Ежедневно в 01:45 МСК</b><br /><br />
Допустимое расширение файла: *.xlsx<br />
Максимальный размер файла: 1,5 МБ.<br /><br /><br />


<form action="./upload.php" method="post" enctype="multipart/form-data">
   <p>
      <label for="file"></label> <input type="file" name="userfile" id="file"> <br /><br /><br />
      <button>Загрузить</button>
   <p>
</form>






<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
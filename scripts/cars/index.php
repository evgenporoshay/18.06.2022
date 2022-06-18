<html>
<head>
<title>Загрузка файла на сервер</title>
<meta charset="utf-8" />
</head>
<body>
<?php


if ($_FILES && $_FILES["filename"]["error"]== UPLOAD_ERR_OK)
{
    $name = $_FILES["filename"]["name"];
    //rename($_FILES["filename"]["tmp_name"], '/home/bitrix/www/scripts/cars/uploads/test.xlsx');
    $file = "cars.xlsx";
    move_uploaded_file($_FILES["filename"]["tmp_name"], "./uploads/$file");
    echo "Файл " . $name . " загружен";

    
}
?>





<h2>Загрузка файла справочника вагонов из АСУПВ (*.xlsx)</h2>
<form method="post" enctype="multipart/form-data">
Выберите файл на компьютере: <input type="file" name="filename" size="10" /><br /><br />
<input type="submit" value="Загрузить" />
</form>
</body>
</html>



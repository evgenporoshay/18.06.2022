<?php

set_time_limit(600);
$servername = 'localhost'; // ваш хост
$database = 'sitemanager'; // ваша бд
$username = 'bitrix0'; // пользователь бд
$password = 'MDiyWby(sfjfi_FRplwd'; // пароль к бд

// Создаем соединение

$conn = mysqli_connect($servername, $username, $password, $database);


mysqli_query($conn, "CREATE TEMPORARY TABLE tmp 
as  (
   SELECT min(id) as id
   FROM cars
   GROUP BY carriage, road);");
sleep(1);

mysqli_query($conn, "DELETE from cars
WHERE cars.id not in (
   SELECT id FROM tmp);");

mysqli_query($conn, "DELETE FROM cars WHERE carriage LIKE 'Итого:%'");


sleep(1);

mysqli_query($conn, "DROP table tmp");

mysqli_query($conn, "UPDATE cars SET rds = NULL 
WHERE CHAR_LENGTH(rds) <1");
sleep(1);
mysqli_query($conn, "UPDATE cars SET mds = NULL 
WHERE CHAR_LENGTH(mds) <1");
sleep(1);
mysqli_query($conn, "UPDATE cars SET date_of_construction = NULL 
WHERE CHAR_LENGTH(date_of_construction) <1");
sleep(1);
mysqli_query($conn, "UPDATE cars SET kvr_at = NULL 
WHERE CHAR_LENGTH(kvr_at) <1");
sleep(1);
mysqli_query($conn, "UPDATE cars SET kvr_location = NULL 
WHERE kvr_location LIKE '<пусто>'");
sleep(1);
mysqli_query($conn, "UPDATE cars SET md = mds WHERE id IN (SELECT id FROM (SELECT id FROM cars WHERE mds IS NOT null) AS t2)");
sleep(3);
mysqli_query($conn, "UPDATE cars SET rd = rds WHERE id IN (SELECT id FROM (SELECT id FROM cars WHERE rds IS NOT null) AS t2)");



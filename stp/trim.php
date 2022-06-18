<?php 

$servername = 'localhost'; // ваш хост
$database = 'sitemanager'; // ваша бд
$username = 'bitrix0'; // пользователь бд
$password = 'MDiyWby(sfjfi_FRplwd'; // пароль к бд

// Создаем соединение

$conn = mysqli_connect($servername, $username, $password, $database);

mysqli_query($conn, "UPDATE cars SET 
carriage = TRIM(carriage),
owner = TRIM(owner),
rd = TRIM(rd),
rds = TRIM(rds),
filial = TRIM(filial),
md = TRIM(md),
mds = TRIM(mds),
owner = TRIM(owner),
date_of_construction = TRIM(date_of_construction),
kvr_at = TRIM(kvr_at),
kvr_location = TRIM(kvr_location),
`type` = TRIM(`type`),
model = TRIM(model),
profile = TRIM(profile),
electrical_equipment = TRIM(electrical_equipment),
cctv = TRIM(cctv),
video_system = TRIM(video_system),
satellite_connection = TRIM(satellite_connection),
it_service = TRIM(it_service),
maskpp = TRIM(maskpp),
date_of_write_off = TRIM(date_of_write_off)");


mysqli_query($conn, "DELETE FROM cars WHERE carriage = ''");





echo '<br />';
echo 'Данные обрезаны';
mysqli_close($conn);
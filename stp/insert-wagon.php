<?php


$servername = 'localhost'; // ваш хост
$database = 'sitemanager'; // ваша бд
$username = 'bitrix0'; // пользователь бд
$password = 'MDiyWby(sfjfi_FRplwd'; // пароль к бд

// Создаем соединение

$conn = mysqli_connect($servername, $username, $password, $database);




include ("PHPExcel/Classes/PHPExcel/IOFactory.php"); 

$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objReader->setReadDataOnly(true); //optional
$file = "cars.xlsx";
$yesterday  = date("Y-m-d").".xlsx";
$date_update  = date("Y-m-d H:i:s");



//$yesterday  = date("Y-m-d", time()-(60*60*24)).".xlsx";
$objPHPExcel = $objReader->load("/home/bitrix/www/stp/uploads/$file");
$objWorksheet = $objPHPExcel->getActiveSheet();



mysqli_query($conn, "DELETE FROM cars");
 $i=12;


foreach ($objWorksheet->getRowIterator() as $row) {

    $carriage = $objPHPExcel->getActiveSheet()->getCell("A$i")->getValue();//column A
    $road = $objPHPExcel->getActiveSheet()->getCell("B$i")->getValue();//column B
    $rd = $objPHPExcel->getActiveSheet()->getCell("C$i")->getValue();//column C
    $rds = $objPHPExcel->getActiveSheet()->getCell("D$i")->getValue();//column D
    $filial = $objPHPExcel->getActiveSheet()->getCell("E$i")->getValue();//column D
    $md = $objPHPExcel->getActiveSheet()->getCell("F$i")->getValue();//column D
    $mds = $objPHPExcel->getActiveSheet()->getCell("G$i")->getValue();//column D
    $owner = $objPHPExcel->getActiveSheet()->getCell("H$i")->getValue();//column D
    $date_of_construction = $objPHPExcel->getActiveSheet()->getCell("I$i")->getValue();//column D
    $kvr_at = $objPHPExcel->getActiveSheet()->getCell("J$i")->getValue();//column D
    $kvr_location = $objPHPExcel->getActiveSheet()->getCell("K$i")->getValue();//column D
    $type = $objPHPExcel->getActiveSheet()->getCell("L$i")->getValue();//column D
    $model = $objPHPExcel->getActiveSheet()->getCell("M$i")->getValue();//column D
    $profile = $objPHPExcel->getActiveSheet()->getCell("N$i")->getValue();//column D
    $electrical_equipment = $objPHPExcel->getActiveSheet()->getCell("O$i")->getValue();//column D
    $cctv = $objPHPExcel->getActiveSheet()->getCell("P$i")->getValue();//column D
    $video_system = $objPHPExcel->getActiveSheet()->getCell("Q$i")->getValue();//column D
    $satellite_connection = $objPHPExcel->getActiveSheet()->getCell("R$i")->getValue();//column D
    $it_service = $objPHPExcel->getActiveSheet()->getCell("S$i")->getValue();//column D
    $maskpp = $objPHPExcel->getActiveSheet()->getCell("T$i")->getValue();//column D
    $date_of_write_off = $objPHPExcel->getActiveSheet()->getCell("U$i")->getValue();//column D
    //you can add your own columns B, C, D etc.

    //inset $column_A_Value value in DB query here

	$sql = "INSERT INTO cars(carriage, road, rd, rds,filial, md, mds, owner, date_of_construction, kvr_at, kvr_location, type, model, profile, electrical_equipment, 
cctv, video_system, satellite_connection, it_service, maskpp, date_of_write_off) VALUES ('$carriage', '$road', '$rd', '$rds', '$filial', '$md', '$mds',  '$owner', 
'$date_of_construction', '$kvr_at', '$kvr_location', '$type', '$model', '$profile', '$electrical_equipment', '$cctv', '$video_system', '$satellite_connection', '$it_service', '$maskpp', '$date_of_write_off')";
        
        mysqli_query($conn, $sql);
    ++$i;
}




 $res_stpwork_sum = $conn->query("SELECT count(*) FROM cars");
 $row_stpwork_sum = $res_stpwork_sum->fetch_row();
 $count = $row_stpwork_sum[0];

 echo 'Добавлено ' . ($count - 11)  . ' записей.';


 
 //echo 'Готово';


mysqli_close($conn);

include '/home/bitrix/www/stp/trim.php';

echo '<br />';
echo 'Пустые записи удалены.';

include '/home/bitrix/www/stp/del.php';

$res_stpwork_sum1 = $conn->query("SELECT count(*) FROM cars");
 $row_stpwork_sum1 = $res_stpwork_sum1->fetch_row();
 $count1 = $row_stpwork_sum1[0];

  $sql_date = "INSERT INTO cars_update(count, `date`) VALUES ('$count1', '$date_update')";
  mysqli_query($conn, $sql_date);

$drop_toprof_cars = "DROP TABLE toprof_cars";
  mysqli_query($conn, $drop_toprof_cars);
  

 $create_toprof_cars = "CREATE TABLE toprof_cars AS
(select distinct(c.carriage), c.video_system, c.satellite_connection, c.it_service, tm.skdu 
from cars c
left join toprof_main tm on tm.carriage = c.carriage);";
  mysqli_query($conn, $create_toprof_cars);


$upd1 = "UPDATE toprof_cars SET video_system = REPLACE(video_system, 'есть', '1')";
mysqli_query($conn, $upd1);

$upd2 = "UPDATE toprof_cars SET video_system = REPLACE(video_system, 'нет', '0')";
mysqli_query($conn, $upd2);

$upd3 = "UPDATE toprof_cars SET satellite_connection = REPLACE(satellite_connection, 'АКТ', '1')";
mysqli_query($conn, $upd3);

$upd4 = "UPDATE toprof_cars SET satellite_connection = REPLACE(satellite_connection, 'нет', '0')";
mysqli_query($conn, $upd4);

$upd5 = "UPDATE toprof_cars SET it_service = REPLACE(it_service, 'ИМ', '1')";
mysqli_query($conn, $upd5);

$upd6 = "UPDATE toprof_cars SET it_service = REPLACE(it_service, 'ИМ+Интернет', '1')";
mysqli_query($conn, $upd6);

$upd7 = "UPDATE toprof_cars SET it_service = REPLACE(it_service, 'нет', '0')";
mysqli_query($conn, $upd7);

$upd8 = "UPDATE toprof_cars SET it_service = REPLACE(it_service, '1+Интер0', '1')";
mysqli_query($conn, $upd8);

$upd9 = "UPDATE toprof_cars SET satellite_connection = REPLACE(satellite_connection, 'ДТ', '1')";
mysqli_query($conn, $upd9);

$upd10 = "UPDATE toprof_cars SET video_system = REPLACE(video_system, '<пусто>', '0')";
mysqli_query($conn, $upd10);

$upd11 = "UPDATE toprof_cars SET skdu = '0' where skdu is null";
mysqli_query($conn, $upd11);

echo '<br />';
echo 'Дубликаты удалены';
echo '<br />';
echo '<br />';
echo 'В базе данных ' . $count1 . ' вагонов';

/*include '/home/bitrix/www/stp/mail.php';*/



rename("/home/bitrix/www/stp/uploads/$file", "/home/bitrix/www/stp/uploaded/$yesterday");



?>
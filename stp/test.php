 <?php 
 
include ("PHPExcel/Classes/PHPExcel/IOFactory.php"); 

$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$file = "cars.xlsx";



//$yesterday  = date("Y-m-d", time()-(60*60*24)).".xlsx";
$objPHPExcel = $objReader->load("/home/bitrix/www/stp/uploads/$file");
$objWorksheet = $objPHPExcel->getActiveSheet();



   $carriage = $objPHPExcel->getActiveSheet()->getCell("A1")->getValue();//column A




echo $carriage;








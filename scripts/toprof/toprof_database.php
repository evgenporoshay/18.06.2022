<?php


$servername = 'localhost'; // ваш хост
$database = 'sitemanager'; // ваша бд
$username = 'bitrix0'; // пользователь бд
$password = 'MDiyWby(sfjfi_FRplwd'; // пароль к бд

// Создаем соединение

$conn = mysqli_connect($servername, $username, $password, $database);

$yesterday = date("Y-m-d").".xls";

$thisDate = date('Y-m-d');

include ("PHPExcel/Classes/PHPExcel/IOFactory.php"); 

$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objReader->setReadDataOnly(true); //optional
$file = '/home/bitrix/www/scripts/toprof/uploads/toprof_' . $thisDate . '.xls';




//$yesterday  = date("Y-m-d", time()-(60*60*24)).".xlsx";
$objPHPExcel = $objReader->load("$file");
$objWorksheet = $objPHPExcel->getActiveSheet();


 $i=2;


foreach ($objWorksheet->getRowIterator() as $row) {

    $id_sumrv = $objPHPExcel->getActiveSheet()->getCell("A$i")->getValue();//column A
    $redmine = $objPHPExcel->getActiveSheet()->getCell("B$i")->getValue();//column B
    $carriage = $objPHPExcel->getActiveSheet()->getCell("C$i")->getValue();//column C
    $data_provedeniya = $objPHPExcel->getActiveSheet()->getCell("D$i")->getValue();//column D
    $engeneer = $objPHPExcel->getActiveSheet()->getCell("E$i")->getValue();//column D
    $telephone = $objPHPExcel->getActiveSheet()->getCell("F$i")->getValue();//column D
    $status = $objPHPExcel->getActiveSheet()->getCell("G$i")->getValue();//column D
    $depo = $objPHPExcel->getActiveSheet()->getCell("H$i")->getValue();//column D
    $filial = $objPHPExcel->getActiveSheet()->getCell("I$i")->getValue();//column D
    $im = $objPHPExcel->getActiveSheet()->getCell("J$i")->getValue();//column D
    $stoimost_toprof_im = $objPHPExcel->getActiveSheet()->getCell("K$i")->getValue();//column D
    $stoimost_toprof_im_s_nds = $objPHPExcel->getActiveSheet()->getCell("L$i")->getValue();//column D
    $svnr = $objPHPExcel->getActiveSheet()->getCell("M$i")->getValue();//column D
    $stoimost_toprof_svnr = $objPHPExcel->getActiveSheet()->getCell("N$i")->getValue();//column D
    $stoimost_toprof_svnr_s_nds = $objPHPExcel->getActiveSheet()->getCell("O$i")->getValue();//column D
    $skdu = $objPHPExcel->getActiveSheet()->getCell("P$i")->getValue();//column D
    $stoimost_toprof_skdu = $objPHPExcel->getActiveSheet()->getCell("Q$i")->getValue();//column D
    $stoimost_toprof_skdu_s_nds = $objPHPExcel->getActiveSheet()->getCell("R$i")->getValue();//column D
    $skb_i_spp = $objPHPExcel->getActiveSheet()->getCell("S$i")->getValue();//column D
    $stoimost_toprof_skb_i_spp = $objPHPExcel->getActiveSheet()->getCell("T$i")->getValue();//column D
    $stoimost_toprof_skb_i_spp_s_nds = $objPHPExcel->getActiveSheet()->getCell("U$i")->getValue();//column D
    $total_stoimost = $objPHPExcel->getActiveSheet()->getCell("V$i")->getValue();//column D
    $total_stoimost_s_nds = $objPHPExcel->getActiveSheet()->getCell("W$i")->getValue();//column D
    $gorod_provedenia_toprof = $objPHPExcel->getActiveSheet()->getCell("X$i")->getValue();//column D
    //you can add your own columns B, C, D etc.

    //inset $column_A_Value value in DB query here

    $sql = "INSERT INTO toprof(id_sumrv, redmine, carriage, data_provedeniya,engeneer, telephone, status, depo, filial, im, stoimost_toprof_im, stoimost_toprof_im_s_nds, svnr, stoimost_toprof_svnr, stoimost_toprof_svnr_s_nds, skdu, 
stoimost_toprof_skdu, stoimost_toprof_skdu_s_nds, skb_i_spp, stoimost_toprof_skb_i_spp, stoimost_toprof_skb_i_spp_s_nds, total_stoimost, total_stoimost_s_nds, gorod_provedenia_toprof) VALUES ('$id_sumrv', '$redmine', '$carriage', '$data_provedeniya', '$engeneer', '$telephone', '$status',  '$depo', '$filial', 
'$im', '$stoimost_toprof_im', '$stoimost_toprof_im_s_nds', '$svnr', '$stoimost_toprof_svnr', '$stoimost_toprof_svnr_s_nds', '$skdu', '$stoimost_toprof_skdu', '$stoimost_toprof_skdu_s_nds', '$skb_i_spp', '$stoimost_toprof_skb_i_spp', '$stoimost_toprof_skb_i_spp_s_nds', '$total_stoimost', '$total_stoimost_s_nds', '$gorod_provedenia_toprof')";
        
        mysqli_query($conn, $sql);
    ++$i;
}




$create = "CREATE TEMPORARY TABLE t_toprof 
as  (
   SELECT max(id) as id
   FROM toprof
   GROUP BY carriage, data_provedeniya, status
)";

mysqli_query($conn, $create);


$delete = "DELETE from toprof
WHERE toprof.id not in (
   SELECT id FROM t_toprof
)";

mysqli_query($conn, $delete);


$drop = "DROP TABLE t_toprof";

mysqli_query($conn, $drop);


$delete_em = "delete from toprof where status = ''";

mysqli_query($conn, $delete_em);

 $res_stpwork_sum = $conn->query("SELECT count(*) FROM toprof");
 $row_stpwork_sum = $res_stpwork_sum->fetch_row();
 $count = $row_stpwork_sum[0];

 echo 'Добавлено ' . ($count - 1)  . ' записей.';


 




 //echo 'Готово';


mysqli_close($conn);


rename($file, "/home/bitrix/www/scripts/toprof/uploaded/$yesterday");




?>
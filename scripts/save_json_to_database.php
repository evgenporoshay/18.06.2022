<?php  

set_time_limit(300);


// подключение к базе данных
$host = 'localhost'; // ваш хост
$user = 'bitrix0'; // пользователь бд
$pass = 'MDiyWby(sfjfi_FRplwd'; // пароль к бд
$db_name = 'sitemanager'; // ваша бд
$link = mysqli_connect($host, $user, $pass, $db_name); // Соединяемся с базой




mysqli_query($link, "DELETE FROM select_table");




$url = 'https://trainer.rdl-telecom.ru/select_table';
//  Initiate curl session
$handle = curl_init();
// Will return the response, if false it prints the response
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($handle, CURLOPT_URL,$url);
// Execute the session and store the contents in $result
$result=curl_exec($handle);
// Closing the session
curl_close($handle);


$result = file_get_contents($url);
$array = json_decode($result, true);
$array2 = json_encode($array, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);




//write json to file
if (file_put_contents("./data.json", $array2))
    echo "JSON file created successfully...";
else 
    echo "Oops! Error creating json file...";


$filename = "./data.json";

function jsonToCSV($jfilename, $cfilename)
{
    if (($json = file_get_contents($jfilename)) == false)
        die('Error reading json file...');
    $data = json_decode($json, true);
    $fp = fopen($cfilename, 'w');
    $header = false;
    foreach ($data as $row)
    {
        if (empty($header))
        {
            $header = array_keys($row);
            fputcsv($fp, $header);
            $header = array_flip($header);
        }
        fputcsv($fp, array_merge($header, $row));
    }
    fclose($fp);
    return;
}


$json_filename = './data.json';
$csv_filename = './data.csv';
jsonToCSV($json_filename, $csv_filename);
echo 'Successfully converted json to csv file. <a href="' . $csv_filename . '" target="_blank">Click here to open it.</a>';


// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$table_name= "select_table";

$csv_file = "./data.csv"; // Name of your CSV file
$csvfile = fopen($csv_file, 'r');
$field_csv = array();
$i = 0;
while (($csv_data = fgetcsv($csvfile, 0, ",")) !== FALSE) {
if($i==0) { $i++; continue; }  // to exclude first line in the csv file.

$field_csv['auth_false'] =mysqli_real_escape_string( $link, $csv_data[0] );  // 1
$field_csv['net_traffic'] = mysqli_real_escape_string( $link, $csv_data[1]     ); // 2
$field_csv['net_traffic_auth'] = mysqli_real_escape_string( $link, $csv_data[2] ); // 3
$field_csv['net_users'] = mysqli_real_escape_string( $link, $csv_data[3] );  // 4
$field_csv['auth_store'] = mysqli_real_escape_string( $link, $csv_data[4] ); // 5
$field_csv['train'] = mysqli_real_escape_string( $link, $csv_data[5] ); // 6
$field_csv['route'] = mysqli_real_escape_string( $link, $csv_data[6] );  // 7
$field_csv['routes_route'] = mysqli_real_escape_string( $link, $csv_data[7] ); // 8
$field_csv['ip_count'] = mysqli_real_escape_string( $link, $csv_data[8] ); // 9
$field_csv['auth_count'] = mysqli_real_escape_string( $link, $csv_data[9] );  // 10
$field_csv['service_availability'] = mysqli_real_escape_string( $link, $csv_data[10] ); // 11
$field_csv['vpn_ip'] = mysqli_real_escape_string( $link, $csv_data[11] ); // 12
$field_csv['route_id'] = mysqli_real_escape_string( $link, $csv_data[12] );  // 13
$field_csv['depart'] = mysqli_real_escape_string( $link, $csv_data[13] ); // 14
$field_csv['arrive'] = mysqli_real_escape_string( $link, $csv_data[14] ); // 15
$field_csv['train_name'] = mysqli_real_escape_string( $link, $csv_data[15] );  // 16
$field_csv['p_count'] = mysqli_real_escape_string( $link, $csv_data[16] ); // 17
$field_csv['count'] = mysqli_real_escape_string( $link, $csv_data[17] ); // 18
$field_csv['real_route'] = mysqli_real_escape_string( $link, $csv_data[18] );  // 19
$field_csv['route_arrival'] = mysqli_real_escape_string( $link, $csv_data[19] ); // 20
$field_csv['station_of_departure'] = mysqli_real_escape_string( $link, $csv_data[20] ); // 21
$field_csv['station_of_arrival'] = mysqli_real_escape_string( $link, $csv_data[21] ); // 22
$field_csv['equipment'] = mysqli_real_escape_string( $link, $csv_data[22] ); // 22
$field_csv['cron'] = mysqli_real_escape_string( $link, $csv_data[23] ); // 22
$field_csv['availability'] = mysqli_real_escape_string( $link, $csv_data[24] ); // 22
$field_csv['route_current'] = mysqli_real_escape_string( $link, $csv_data[25] ); // 22
$field_csv['code'] = mysqli_real_escape_string( $link, $csv_data[26] ); // 22
$field_csv['type'] = mysqli_real_escape_string( $link, $csv_data[27] ); // 22
$field_csv['films_count'] = mysqli_real_escape_string( $link, $csv_data[28] ); // 22
$field_csv['films_available'] = mysqli_real_escape_string( $link, $csv_data[29] ); // 22
$field_csv['get_carriage'] = mysqli_real_escape_string( $link, $csv_data[30] ); // 22
$field_csv['cont_users'] = mysqli_real_escape_string( $link, $csv_data[31] ); // 22
$field_csv['actual_carriage'] = mysqli_real_escape_string( $link, $csv_data[32] ); // 22
$field_csv['scan_carriage'] = mysqli_real_escape_string( $link, $csv_data[33] ); // 22
$field_csv['rdl_api_version'] = mysqli_real_escape_string( $link, $csv_data[34] ); // 22
$field_csv['comment_c'] = mysqli_real_escape_string( $link, $csv_data[35] ); // 22
$field_csv['service_status_auth'] = mysqli_real_escape_string( $link, $csv_data[36] ); // 22
$field_csv['service_status_nginx'] = mysqli_real_escape_string( $link, $csv_data[37] ); // 22
$field_csv['service_status_dhcpd'] = mysqli_real_escape_string( $link, $csv_data[38] ); // 22
$field_csv['service_status_ipcad'] = mysqli_real_escape_string( $link, $csv_data[39] ); // 22
$field_csv['service_status_squid'] = mysqli_real_escape_string( $link, $csv_data[40] ); // 22
$field_csv['source_car'] = mysqli_real_escape_string( $link, $csv_data[41] ); // 22
$field_csv['auth_version'] = mysqli_real_escape_string( $link, $csv_data[42] ); // 22
$field_csv['daemon_version'] = mysqli_real_escape_string( $link, $csv_data[43] ); // 22
$field_csv['content_music'] = mysqli_real_escape_string( $link, $csv_data[44] ); // 22
$field_csv['content_books'] = mysqli_real_escape_string( $link, $csv_data[45] ); // 22
$field_csv['content_audio_book'] = mysqli_real_escape_string( $link, $csv_data[46] ); // 22
$field_csv['content_films'] = mysqli_real_escape_string( $link, $csv_data[47] ); // 22
$field_csv['content_press'] = mysqli_real_escape_string( $link, $csv_data[48] ); // 22
$field_csv['http_codes_200'] = mysqli_real_escape_string( $link, $csv_data[49] ); // 22
$field_csv['http_codes_404'] = mysqli_real_escape_string( $link, $csv_data[50] ); // 22
$field_csv['http_codes_404_percent'] = mysqli_real_escape_string( $link, $csv_data[51] ); // 22
$field_csv['core_version'] = mysqli_real_escape_string( $link, $csv_data[52] ); // 22
$field_csv['docker_status'] = mysqli_real_escape_string( $link, $csv_data[53] ); // 22
$field_csv['dockers_errors'] = mysqli_real_escape_string( $link, $csv_data[54] ); // 22
$field_csv['dockers_errors_status'] = mysqli_real_escape_string( $link, $csv_data[55] ); // 22
$field_csv['temp'] = mysqli_real_escape_string( $link, $csv_data[56] ); // 22
$field_csv['temp_second'] = mysqli_real_escape_string( $link, $csv_data[57] ); // 22
$field_csv['carrier'] = mysqli_real_escape_string( $link, $csv_data[58] ); // 22




$query = "INSERT INTO $table_name SET id = '".$field_csv

['route_id']."',auth_false = '".$field_csv['auth_false']."',net_traffic = '".$field_csv['net_traffic']."',net_traffic_auth = '".$field_csv['net_traffic_auth']."',net_users = '".

$field_csv['net_users']."',auth_store = '".$field_csv['auth_store']."',train = '".$field_csv['train']."',route = '".$field_csv['route']."',routes_route = '".$field_csv['routes_route']."',ip_count = '".

$field_csv['ip_count']."',auth_count = '".$field_csv['auth_count']."',service_availability = '".$field_csv['service_availability']."',vpn_ip = '".$field_csv['vpn_ip']."',route_id = '".$field_csv

['route_id']."',depart = '".$field_csv['depart']."',arrive = '".$field_csv['arrive']."',train_name = '".$field_csv['train_name']."',p_count = '".$field_csv['p_count']."',count = '".$field_csv

['count']."',real_route = '".$field_csv['real_route']."',route_arrival = '".$field_csv['route_arrival']."',station_of_departure = '".$field_csv['station_of_departure']."',station_of_arrival = '".$field_csv['station_of_arrival']."',equipment = '".

$field_csv['equipment']."',cron = '".$field_csv['cron']."',availability = '".$field_csv['availability']."',route_current = '".$field_csv['route_current']."',code = '".$field_csv

['code']."',type = '".$field_csv['type']."',films_count = '".$field_csv['films_count']."',films_available = '".$field_csv['films_available']."',get_carriage = '".$field_csv['get_carriage']."',cont_users = '".$field_csv['cont_users']."',actual_carriage = '"

.$field_csv['actual_carriage']."',scan_carriage = '".$field_csv['scan_carriage']."',rdl_api_version = '".$field_csv['rdl_api_version']."',comment_c = '".$field_csv['comment_c']."',service_status_auth = '".$field_csv

['service_status_auth']."',service_status_nginx = '".$field_csv['service_status_nginx']."',service_status_dhcpd = '".$field_csv['service_status_dhcpd']."',service_status_ipcad = '".$field_csv['service_status_ipcad']."',service_status_squid = '".$field_csv['service_status_squid']."',source_car = '".$field_csv['source_car']."',auth_version = '".$field_csv['auth_version']."',daemon_version = '".$field_csv['daemon_version']."',content_music = '".$field_csv['content_music']."',content_books = '".$field_csv['content_books']."',content_audio_book = '".$field_csv['content_audio_book']."',content_films = '".$field_csv['content_films']."',content_press = '".$field_csv['content_press']."',http_codes_200 = '".$field_csv['http_codes_200']."',http_codes_404 = '".$field_csv['http_codes_404']."',http_codes_404_percent = '".$field_csv['http_codes_404_percent']."',core_version = '".$field_csv['core_version']."',docker_status = '".$field_csv['docker_status']."',dockers_errors = '".$field_csv['dockers_errors']."'
,dockers_errors_status = '".$field_csv['dockers_errors_status']."',temp = '".$field_csv['temp']."',temp_second = '".$field_csv['temp_second']."',carrier = '".$field_csv['carrier']."' ";





mysqli_query($link,$query);

}

fclose($csvfile);

echo "CSV data successfully imported to table!!";



#mysqli_query($link, "update select_table set depart = str_to_date(depart, '%Y-%m-%dT%H:%i:%s')");
#mysqli_query($link, "update select_table set arrive = str_to_date(arrive, '%Y-%m-%dT%H:%i:%s')");






// close connection
$link->close();





?>
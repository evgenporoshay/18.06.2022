<?php  

set_time_limit(300);


// подключение к базе данных
$host = 'localhost'; // ваш хост
$user = 'bitrix0'; // пользователь бд
$pass = 'MDiyWby(sfjfi_FRplwd'; // пароль к бд
$db_name = 'sitemanager'; // ваша бд
$link = mysqli_connect($host, $user, $pass, $db_name); // Соединяемся с базой




mysqli_query($link, "INSERT INTO select_table_ar(auth_false, net_traffic, net_traffic_auth, net_users, auth_store, train, route, routes_route, ip_count, auth_count, service_availability, vpn_ip, route_id, depart, arrive, train_name, p_count, count, real_route, route_arrival, station_of_departure, station_of_arrival, equipment, cron, availability, route_current, code, `type`, films_count, films_available, get_carriage, cont_users, actual_carriage, scan_carriage, rdl_api_version, comment_c, service_status_auth, service_status_nginx, service_status_dhcpd, service_status_ipcad, service_status_squid, source_car, auth_version, daemon_version, content_music, content_books, content_audio_book, content_films, content_press, http_codes_200, http_codes_404, http_codes_404_percent, core_version, docker_status, dockers_errors, dockers_errors_status, temp, temp_second)
SELECT auth_false, net_traffic, net_traffic_auth, net_users, auth_store, train, route, routes_route, ip_count, auth_count, service_availability, vpn_ip, route_id, depart, arrive, train_name, p_count, count, real_route, route_arrival, station_of_departure, station_of_arrival, equipment, cron, availability, route_current, code, `type`, films_count, films_available, get_carriage, cont_users, actual_carriage, scan_carriage, rdl_api_version, comment_c, service_status_auth, service_status_nginx, service_status_dhcpd, service_status_ipcad, service_status_squid, source_car, auth_version, daemon_version, content_music, content_books, content_audio_book, content_films, content_press, http_codes_200, http_codes_404, http_codes_404_percent, core_version, docker_status, dockers_errors, dockers_errors_status, temp, temp_second
FROM select_table
WHERE (`type` = 'SPECIAL' OR `type` = 'LASTA') AND arrive < now()");


mysqli_query($link, "CREATE TEMPORARY TABLE t_temp 
as  (
   SELECT min(id) as id
   FROM select_table_ar
   GROUP BY arrive, route_id
)");



mysqli_query($link, "DELETE from select_table_ar
WHERE select_table_ar.id not in (
   SELECT id FROM t_temp
)");


mysqli_query($link, "DROP TABLE t_temp");

$link->close();

?>
<?php



$json = file_get_contents('http://trainer.rdl-telecom.ru/statistics');

$array = json_decode($json, true);




$date = 'Статистика за сутки: ' . $array[0]['date'];
$routs = 'Всего рейсов: '  . $array[0]['routs'];
$special_routs = 'Фирменных рейсов : '  . $array[0]['special_routs'];
$auth = 'Авторизации: '  . $array[0]['auth'];
$tr_noauth = 'Неавториз. трафик: '  . $array[0]['tr_noauth'] . ' ГБ';
$traffic =  'Авторизованный трафик: ' . $array[0]['tr_auth'] . ' ГБ';
$tr_total = 'Общий трафик: ' . $array[0]['tr_total'] . ' ГБ';
$auth_per_routs = 'Авторизаций за рейс: ' . $array[0]['auth_per_routs'];
$traf_per_routs = 'Трафик за рейс: ' . $array[0]['traf_per_routs'] . ' МБ';
$traf_per_auth = 'Трафик за авторизацию: ' . $array[0]['traf_per_auth'] . ' МБ';
$speed_mb_per_sec = 'Ср. скорость за рейс: ' . $array[0]['speed_mb_per_sec'] . ' Мб/сек';
$num_onl = 'Количество запросов в ОНЛ: ' . $array[0]['num_onl'];
$result_sims_avai = 'Доступность сим-карт (max - 4): ' . $array[0]['result_sims_avai'] ;


// echo $date;
// echo $routs;
// echo $special_routs;
// echo $auth;
// echo $tr_noauth;
// echo $traffic;
// echo $tr_total;
// echo $auth_per_routs;
// echo $traf_per_routs;
// echo $traf_per_auth;
// echo $speed_mb_per_sec;
// echo $num_onl;
// echo $result_sims_avai;

#$telegram[0];
// Токен бота и идентификатор чата
$token='1223485972:AAEzNc9_JevZungd2XPFbdYjbRYHJRx1788';
$chat_id='-1001737074659';
#$chat_id='928161028';
//928161028
//
// Текст сообщения

$telegram = array("
$date
-------------------------------------------
$routs
$special_routs
$auth
$tr_noauth
$traffic
$tr_total
$auth_per_routs
$traf_per_routs
$traf_per_auth
$speed_mb_per_sec
$num_onl
$result_sims_avai

 ");
$text = $telegram[0];

// Отправить сообщение
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL,
    'https://api.telegram.org/bot'.$token.'/sendMessage');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS,
    'chat_id='.$chat_id.'&text='.urlencode($text));
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);


// Отправить сообщение
$result=curl_exec($ch);
curl_close($ch);




?>
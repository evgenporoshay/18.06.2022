<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Обновление справочника вагонов");
?>



<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

   // Конфигурация
      $allowed_filetypes = array('.xlsx'); // разрешенные типы файлов
      $max_filesize = 1625292; // максимальный размер файла в байтах (1.5MB).
      $min_filesize = 1258291; // минимальный размер файла в байтах (1 МБ).
      $upload_path = './uploads/'; // папка для загрузки файлов на сервере (папка 'files').
 

     
    
    
   $filename = $_FILES['userfile']['name']; // получить имя файла с расширением.
   $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1); // получить расширение файла.
 
   // проверить допустимость файла, если не разрешено, то вызвать функцию DIE и вывести сообщение пользователю.
   if(!in_array($ext,$allowed_filetypes))
      die('<p style="color: red; font-size: 18px; ">ОШИБКА. <br /></p>Вы пытаетесь загрузить неразрешенный тип файла.<br /> Расширение файла должно быть .xlsx</p>' );

   // проверка размера файла, если превышает, то DIE и сообщение пользователю.
   if(filesize($_FILES['userfile']['tmp_name']) > $max_filesize)
      die('<p style="color: red; font-size: 18px; ">ОШИБКА. <br /></p>Вы пытаетесь загрузить слишком большой файл.<br /> Проверьте файл справочника..</p>' );

   // проверка размера файла, если недостает, то DIE и сообщение пользователю.
   if(filesize($_FILES['userfile']['tmp_name']) < $min_filesize)
      die('<p style="color: red; font-size: 18px; ">ОШИБКА. <br /></p>Вы пытаетесь загрузить слишком маленький файл.<br /> Проверьте файл справочника.' );

   ('<p style="color: red; font-size: 18px; ">ОШИБКА. <br /></p>Вы пытаетесь загрузить слишком маленький файл.<br /> Проверьте файл справочника.' );
 
   // проверка возможности загрузки в указанный каталог, если нет, то DIE и информация юзеру.
   if(!is_writable($upload_path))
      die('Вы не можете загрузить в указанную папку; смените CHMOD на 777.');
 
   // загрузка файла в указанную папку.
   if(move_uploaded_file($_FILES['userfile']['tmp_name'],$upload_path . 'cars.xlsx')) {
         //echo 'Ваш файл успешно загружен'; // сработало.
       echo '<p style="color: green; font-size: 20px; ">Файл загружен</p>' ;;

      $t = strtotime('+1 day 01:45:00');
      echo 'Обновление справочника будет запущено: '. '<b>' .date('Y-m-d H:i:s',$t) . '</b>';
      
       

       
        
      
//
       $to  = "helpdesk@rdl-telecom.com," ;
       $to .= "e.poroshay@rdl-telecom.com";
       $subject = "Загружен справочник вагонов из АСУПВ на сервер"; 
       $message = " <p>Загружен справочник вагонов из АСУПВ на сервер</p> </br> Имя файла:  $filename </br> 'Обновление справочника будет запущено: '. '<b>' .date('Y-m-d H:i:s',$t) . '</b>' ";          
       $headers  = "Content-type: text/html; charset=UTF-8 \r\n";
       $headers .= "From: РДЛ-Телеком <crm@rdl-telecom.com>\r\n"; 
       $headers .= "Reply-To: 89152547650@mail.ru\r\n"; 
       mail($to, $subject, $message, $headers);

$text .= 'Файл справочника вагонов загружен на сервер';
  
#$telegram[0];
// Токен бота и идентификатор чата
$token='1223485972:AAEzNc9_JevZungd2XPFbdYjbRYHJRx1788';
$chat_id='928161028';


// Отправить сообщение
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL,
    'https://api.telegram.org/bot'.$token.'/sendMessage');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_POSTFIELDS,
    'chat_id='.$chat_id.'&text='.urlencode($text));
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);

$result=curl_exec($ch);
curl_close($ch);



    }
      else
         echo 'Во время загрузки произошла ошибка. Попробуйте снова.'; // не сработало :(.
 
}
 
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
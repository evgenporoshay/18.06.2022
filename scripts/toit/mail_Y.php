
<?php

$servername  = 'localhost'; // ваш хост
$username = 'bitrix0'; // пользователь бд
$password = 'VwAR1{2[(?1[{iRLqCLz'; // пароль к бд
$dbname = 'sitemanager'; // ваша бд

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "UPDATE b_mail_mailbox SET ACTIVE = 'Y' WHERE ID ='34'";


if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}




mysqli_close($conn);
?>
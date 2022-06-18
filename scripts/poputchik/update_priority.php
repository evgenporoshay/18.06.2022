
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

$sql = "UPDATE b_uts_crm_deal SET `UF_CRM_1611413941886` = ADDDATE(`UF_CRM_1611481422817`, 3)
WHERE
    UF_CRM_1611864420209 = 'true' AND UF_CRM_1611865891850 = 'false' AND UF_CRM_1611867292691 = 'В работе' AND UF_CRM_1610614286 = '24009'";

$sql2 = "UPDATE b_uts_crm_deal SET `UF_CRM_1611413941886` = ADDDATE(`UF_CRM_1611481422817`, 5)
WHERE
    UF_CRM_1611864420209 = 'true' AND UF_CRM_1611865891850 = 'false'AND UF_CRM_1611867292691 = 'В работе' AND UF_CRM_1610614286 = '24008'";

$sql3 = "UPDATE b_uts_crm_deal SET `UF_CRM_1611413941886` = ADDDATE(`UF_CRM_1611481422817`, 12)
WHERE
    UF_CRM_1611864420209 = 'true' AND UF_CRM_1611865891850 = 'false' AND UF_CRM_1611867292691 = 'В работе' AND UF_CRM_1610614286 = '24007'";

$sql4 = "UPDATE b_uts_crm_deal SET UF_CRM_1612076539243 = 'Да' WHERE UF_CRM_1611413941886 < NOW()";

if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

if (mysqli_query($conn, $sql2)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

if (mysqli_query($conn, $sql3)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

if (mysqli_query($conn, $sql4)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
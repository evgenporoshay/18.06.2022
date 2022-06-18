
<?php

$servername  = 'localhost'; // ваш хост
$username = 'bitrix0'; // пользователь бд
$password = 'MDiyWby(sfjfi_FRplwd'; // пароль к бд
$dbname = 'sitemanager'; // ваша бд

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



$sql = "UPDATE b_uts_crm_deal SET `UF_CRM_1650004583854` = ADDDATE(`UF_CRM_1650006738038`, INTERVAL 4 HOUR)
WHERE
    UF_CRM_1652881773206 = 'true' AND UF_CRM_1650006576943 = 'В работе' AND UF_CRM_1650007980763 = '34' ";

$sql2 = "UPDATE b_uts_crm_deal SET `UF_CRM_1650004583854` = ADDDATE(`UF_CRM_1650006738038`, INTERVAL 8 HOUR)
WHERE
    UF_CRM_1652881773206 = 'true' AND UF_CRM_1650006576943 = 'В работе' AND UF_CRM_1650007980763 = '33'  ";

$sql3 = "UPDATE b_uts_crm_deal SET `UF_CRM_1650004583854` = ADDDATE(`UF_CRM_1650006738038`, INTERVAL 12 HOUR)
WHERE
    UF_CRM_1652881773206 = 'true' AND UF_CRM_1650006576943 = 'В работе' AND UF_CRM_1650007980763 = '32'  ";

   $sql4 = "UPDATE b_uts_crm_deal SET `UF_CRM_1650004583854` = ADDDATE(`UF_CRM_1650006738038`, INTERVAL 24 HOUR)
WHERE
    UF_CRM_1652881773206 = 'true' AND UF_CRM_1650006576943 = 'В работе' AND UF_CRM_1650007980763 = '351'  ";





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
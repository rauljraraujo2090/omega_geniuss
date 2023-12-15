<?php
define('DB_SERVER','localhost');
define('DB_USER','id21362833_omega');
define('DB_PASS' ,'Neymar_2090_jr');
define('DB_NAME', 'id21362833_omegag');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
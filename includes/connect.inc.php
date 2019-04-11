<?php
$conn_error = 'Kunne ikke forbinde til databasen.';

if($db = mysqli_connect("208.113.158.106", "orcbit", "ontherun666", "db_orcbit")){
}else{
	die($conn_error);
}

if (!mysqli_set_charset($db, "utf8")) {
    exit();
}
?>

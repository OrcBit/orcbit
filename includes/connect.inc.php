<?php
$conn_error = 'Kunne ikke forbinde til databasen.';

if($db = mysqli_connect("localhost", "root", "", "orcbit")){
}else{
	die($conn_error);
}

if (!mysqli_set_charset($db, "utf8")) {
    exit();
}
?>
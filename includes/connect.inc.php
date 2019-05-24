<?php
$conn_error = 'Kunne ikke forbinde til databasen.';

if($db = mysqli_connect("mysql78.unoeuro.com", "graumedia_dk", "mpe45eav", "graumedia_dk_db2")){
}else{
	die($conn_error);
}

if (!mysqli_set_charset($db, "utf8")) {
    exit();
}
?>
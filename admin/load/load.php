<?php
$conn_error = 'Kunne ikke forbinde til databasen.';

if($db = mysqli_connect("mysql78.unoeuro.com", "graumedia_dk", "mpe45eav", "graumedia_dk_db2")){
}else{
	die($conn_error);
}

if (!mysqli_set_charset($db, "utf8")) {
    exit();
}

$input = $_GET["input"];

echo $video;

if($input == 'video'){
    echo '<form action="edit-guide.php" method="post" enctype="multipart/form-data">';
  	    echo '<div class="cms_box">';
        	echo '<input type="text" name="video" placeholder="video URL">';
		echo '</div>';
  		echo '<input type="submit" class="submit" name="submit" placeholder="sumbit">';
    echo '</form>';
}if($input == 'header'){
    echo '<form action="edit-guide.php" method="post" enctype="multipart/form-data">';
        	echo '<textarea name="header" placeholder="header"></textarea>';
        echo '<input type="submit" class="submit" name="submit" placeholder="sumbit"><br><br>';
    echo '</form>';
}if($input == 'headerandtext'){
	echo '<form action="edit-guide.php?id='.$id.'&type=headerandtext" method="post" enctype="multipart/form-data">';
      echo '<textarea name="title" placeholder="Title & text" class="smalltextarea"></textarea>';
      echo '<textarea name="text" placeholder="text" class="mediumtextarea"></textarea>';
      echo '<input type="submit" class="submit" name="submit" placeholder="sumbit"><br><br>';
	echo '</form>';
}if($input == 'text'){
	echo '<form action="edit-guide.php?id='.$id.'&type=text" method="post" enctype="multipart/form-data">';
      	echo '<textarea name="text" placeholder="text"></textarea>';
    	echo '<input type="submit" class="submit" name="submit" placeholder="sumbit">';
	echo '</form>';
}if($input == 'imagesandwords'){
	echo '<form action="edit-guide.php?id='.$id.'&type=imagesandwords" method="post" enctype="multipart/form-data">';
                echo '<textarea name="text" class="medium_b_textarea" placeholder="text"></textarea>';
 				echo '<div class="cms_box_small_b">';
                  echo '<input type="file" name="image" placeholder="title">';
                  echo '<select name="float">';
                    echo '<option>right</option>';
                    echo '<option>left</option>';
                  echo '</select>';
  				echo '</div>';
                echo '<input type="submit" class="submit" name="submit" placeholder="sumbit">';
            echo '</form>';
}if($input == 'image'){
	echo '<form action="edit-guide.php?id='.$id.'&type=image" method="post" enctype="multipart/form-data">';
    	echo '<div class="cms_box">';
	    	echo '<input type="file" name="image" placeholder="title"><br>';
   		echo '</div>';
    	echo '<input type="submit" class="submit" name="submit" placeholder="sumbit">';
    echo '</form>';
  echo '</div>';
}if($input == 'tabel'){
  	echo '<form action="edit-guide.php?id='.$id.'&type=tabel" method="post" enctype="multipart/form-data">';
    	echo '<div class="cms_box">';
		    echo '<select name="tabel">';
		    $tabel_query = "SELECT * FROM tabels GROUP BY tabelName";
    		$tabel_query_run = $db->query($tabel_query);
            while($tabel_row = mysqli_fetch_assoc($tabel_query_run)){
              $tab_name = $tabel_row["tabelName"];
              $tab_num = $tabel_row["tabelNumber"];   
              echo '<option value="'.$tab_num.'">'.$tab_name.'</option>';
            }
    echo '</select>';
  	echo '</div>';
    echo '<input type="submit" class="submit" name="submit" placeholder="sumbit">';
echo '</form>';
}
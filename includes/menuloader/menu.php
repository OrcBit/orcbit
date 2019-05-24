<?php
$conn_error = 'Kunne ikke forbinde til databasen.';

if($db = mysqli_connect("mysql78.unoeuro.com", "graumedia_dk", "mpe45eav", "graumedia_dk_db2")){
}else{
	die($conn_error);
}

if (!mysqli_set_charset($db, "utf8")) {
    exit();
}
        if($amount > 0){
                    while($row = mysqli_fetch_assoc($guides_query_run)){

                        $data_name = $row['dataName'];
                        $guide_category = $row['guideCategory'];
                        $data_id = $row['dataID'];
                        $images = $row['dataIcon'];

                        if($guide_category == 'Class Guides'){

                            echo '<ul id="menu_categories_active">';

                                $class_query = "SELECT * FROM class WHERE classID = '$data_id'";
                                $class_query_run = $db->query($class_query);
                                $rows = mysqli_fetch_assoc($class_query_run);

                                $color = $rows['classColor'];
                                $icon = $rows['classIcon'];

                                echo '<div class="menu_left">';
                                    echo '<img style="border:solid; border-width:2px; border-color:'.$color.'" src="'.$icon.'" id="icon" />';   
                                echo '</div>';
                                    echo '<ul class="classes">';
                                        echo '<li style="color:'.$color.'">'.$data_name.'</a><li>';
                                    echo '</ul>';
                            echo '</ul>';
                            echo '<div class="clear">';
                            echo '</div>';
                        }else{
                            echo '<ul id="menu_categories_hidden">';
                                echo '<ul class="classes">';
                                    echo '<li>'.$data_name.'<li>';
                                echo '</ul>';
                            echo '</ul>';
                            echo '<div class="clear">';
                            echo '</div>';
                        }

                        $guide_query = "SELECT * FROM guides WHERE guideCategory = '$guide_category' AND dataID = '$data_id' ORDER BY guideName";
                        $guide_query_run = $db->query($guide_query);
                        $amount = $guide_query_run->num_rows;
                        echo '<div class="panel">';
                        if($amount > 1){
                            if($guide_category == 'Class Guides'){

                                echo '<ul class="class_guide_sub">';
                                    while($row = mysqli_fetch_assoc($guide_query_run)){
                                        $guide_id = $row['guideID'];
                                        $guide_name = $row['guideName'];
                                        $sub_icon = $row['dataIcon'];
                                        echo '<li><div class="menu_left">';
                                            echo '<img src="'.$sub_icon.'" id="icon" />';
                                        echo '</div>';
                                        echo '<a href="class.php?id='.$guide_id.'" style="color:'.$color.'">'.$guide_name.'</a></li>';
                                        echo '<div class="clear">';
                                        echo '</div>';
                                    }
                                echo '</ul>';
                            }
                        }
                        echo '</div>';
                    }
        }
?>
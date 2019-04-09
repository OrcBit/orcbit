<?php
    include '../includes/connect.inc.php';
    include '../admin/includes/header.inc.php';
    include '../admin/includes/admin-menu.inc.php';
?>
<!--main content page-->
<div id="editGuide">
    <?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $guide_id = $_GET['id'];
        $guides_query = "SELECT * FROM guides WHERE guideID = '$id'";
        $guides_query_run = $db->query($guides_query);
        while($row = mysqli_fetch_assoc($guides_query_run)){
            
            $guide_name = $row['guideName'];
            $guide_icon = $row['dataIcon'];
            echo '<div class="icon_left">';
                echo '<img src="../'.$guide_icon.'"/>';
                echo '<h2>'.$guide_name.'</h2>';
            echo '</div>';
        }
        
        $guides_query = "SELECT * FROM sections WHERE guideID = '$id'";
        $guides_query_run = $db->query($guides_query);
        
        $amount = $guides_query_run->num_rows;
                
        if($amount > 0){
            while($row = mysqli_fetch_assoc($guides_query_run)){
                
                $section_id = $row["sectionID"];
                $category = $row["sectionCategory"];
                
               
                if($category == 'video'){
                    $video_query = "SELECT * FROM sections_video WHERE sectionID = '$section_id'";
                    $video_query_run = $db->query($video_query);
                    $video_row = mysqli_fetch_assoc($video_query_run);
                    $url = $video_row["videoURL"];
                    
                    echo $url;

                }if($category == 'header'){
                    $header_query = "SELECT * FROM sections_header WHERE sectionID = '$section_id'";
                    $header_query_run = $db->query($header_query);
                    $header_row = mysqli_fetch_assoc($header_query_run);
                    $content = $header_row["headerContent"];
                    
                    echo '<h1>'.$content.'</h1>';

                }if($category == 'header and text'){
                    $ht_query = "SELECT * FROM sections_header_text WHERE sectionID = '$section_id'";
                    if($ht_query_run = $db->query($ht_query)){
                    $ht_row = mysqli_fetch_assoc($ht_query_run);
                    $title = $ht_row["headertextTitle"];
                    $text = $ht_row["headertextContent"];
                   
                    echo '<h1>'.$title.'</h1>';
                    echo '<p>'.$text.'</p>';
                    }
                }if($category == 'text'){
                    $ht_query = "SELECT * FROM sections_text WHERE sectionID = '$section_id'";
                    if($ht_query_run = $db->query($ht_query)){
                    $ht_row = mysqli_fetch_assoc($ht_query_run);
                    $text = $ht_row["textContent"];
                   
                    echo '<p>'.$text.'</p>';
                    }
                }if($category == 'images and words'){
                    $ht_query = "SELECT * FROM sections_text_images WHERE sectionID = '$section_id'";
                    if($ht_query_run = $db->query($ht_query)){
                    $ht_row = mysqli_fetch_assoc($ht_query_run);
                    $text = $ht_row["textContent"];
                    $path = $ht_row["imagePath"];
                    $float = $ht_row["imageFloat"];
                    
                    echo '<div class="text_image_section">';
                        if($float == 'left'){
                            echo '<div class="right_text">';
                                echo '<p class="align">'.$text.'</p>';
                            echo '</div>';
                        }else{
                            echo '<div class="left_text">';
                                echo '<p class="align">'.$text.'</p>';
                            echo '</div>';                        
                        }if($float == 'left'){
                            echo '<div class="guidefloat_left">';
                                echo '<img src="../'.$path.'" class="align">';
                            echo '</div>';
                        }if($float == 'right'){
                            echo '<div class="guidefloat_right">';
                                echo '<img src="../'.$path.'" class="align">';
                            echo '</div>';                        
                        }                        
                    echo '</div>';
                    echo '<div class="clearit">';
                    echo '</div>';
                    }
                }if($category == 'image'){
                    $ht_query = "SELECT * FROM sections_image WHERE sectionID = '$section_id'";
                    if($ht_query_run = $db->query($ht_query)){
                    $ht_row = mysqli_fetch_assoc($ht_query_run);
                    $path = $ht_row["imagePath"];
                   
                    echo '<img src="../'.$path.'">';
                    }
                }
            }
        }else{
            echo '<div id="guide_content">';
                echo '<p>Nothing Here Yet</p>';
            echo '</div>';
        }
        echo '<form action="edit-guide.php?id='.$id.'&type=video" method="post" enctype="multipart/form-data">';
            echo '<input type="text" name="video" placeholder="video URL">';
            echo '<input type="submit" name="submit" placeholder="sumbit"><br><br>';
        echo '</form>';
        
        echo '<form action="edit-guide.php?id='.$id.'&type=header" method="post" enctype="multipart/form-data">';
            echo '<input type="text" name="header" placeholder="header">';
            echo '<input type="submit" name="submit" placeholder="sumbit"><br><br>';
        echo '</form>';
        
        echo '<form action="edit-guide.php?id='.$id.'&type=headerandtext" method="post" enctype="multipart/form-data">';
            echo '<input type="text" name="title" placeholder="Title & text"><br>';
            echo '<textarea name="text" placeholder="text"></textarea><br>';
            echo '<input type="submit" name="submit" placeholder="sumbit"><br><br>';
        echo '</form>';
        
        echo '<form action="edit-guide.php?id='.$id.'&type=text" method="post" enctype="multipart/form-data">';
            echo '<textarea name="text" placeholder="text"></textarea><br>';
            echo '<input type="submit" name="submit" placeholder="sumbit"><br><br>';
        echo '</form>';
        
        echo '<form action="edit-guide.php?id='.$id.'&type=imagesandwords" method="post" enctype="multipart/form-data">';
            echo '<textarea name="text" placeholder="text"></textarea><br>';
            echo '<input type="file" name="image" placeholder="title"><br>';
            echo '<select name="float"><br><br>';
            echo 'Image: left or right';
            echo '<option>right</option>';
            echo '<option>left</option>';
            echo '</select>';
            echo '<input type="submit" name="submit" placeholder="sumbit">';
        echo '</form>';
        
        echo '<form action="edit-guide.php?id='.$id.'&type=image" method="post" enctype="multipart/form-data">';
            echo '<input type="file" name="image" placeholder="title"><br>';
            echo '<input type="submit" name="submit" placeholder="sumbit">';
        echo '</form>';
        
    }
    if(isset($_POST["submit"])){
        $type = $_GET["type"];
        $id = $_GET["id"];
            if($type == 'video'){
                $video = $_POST["video"];

                $query = "INSERT INTO sections VALUES('', '$type', '$id')";

                if($query_run = $db->query($query)){
                    $section_query = "SELECT * FROM sections WHERE sectionCategory = '$type' ORDER BY sectionID DESC LIMIT 1";
                    $section_query_run = $db->query($section_query);
                    $row = mysqli_fetch_assoc($section_query_run);

                    $section_id = $row["sectionID"];

                    $insert = "INSERT INTO sections_video VALUES('', '$video', '$section_id')";
                    if($insert_run = $db->query($insert)){
                        header('location: edit-guide.php?id='.$id.'');
                    }
                }
            }if($type == 'header'){
                $header = $_POST["header"];

                $query = "INSERT INTO sections VALUES('', '$type', '$id')";

                if($query_run = $db->query($query)){
                    $section_query = "SELECT * FROM sections WHERE sectionCategory = '$type' ORDER BY sectionID DESC LIMIT 1";
                    $section_query_run = $db->query($section_query);
                    $row = mysqli_fetch_assoc($section_query_run);

                    $section_id = $row["sectionID"];

                    $insert = "INSERT INTO sections_header VALUES('', '$header', '$section_id')";
                    if($insert_run = $db->query($insert)){
                        header('location: edit-guide.php?id='.$id.'');
                    }
                }
            }if($type == 'headerandtext'){
                $type = 'header and text';
                $title = $_POST["title"];
                $text = $_POST["text"];
                $insert_text = nl2br($text);
                $query = "INSERT INTO sections VALUES('', '$type', '$guide_id')";

                if($query_run = $db->query($query)){
                    $section_query = "SELECT * FROM sections WHERE sectionCategory = '$type' ORDER BY sectionID DESC LIMIT 1";
                    $section_query_run = $db->query($section_query);
                    $row = mysqli_fetch_assoc($section_query_run);

                    $section_id = $row["sectionID"];

                    $insert = "INSERT INTO sections_header_text VALUES('', '$title', '$insert_text', '$section_id')";
                    if($insert_run = $db->query($insert)){
                        header('location: edit-guide.php?id='.$id.'');
                    }
                }
            }if($type == 'text'){
                $text = $_POST["text"];
                $insert_text = nl2br($text);
                $query = "INSERT INTO sections VALUES('', '$type', '$guide_id')";

                if($query_run = $db->query($query)){
                    $section_query = "SELECT * FROM sections WHERE sectionCategory = '$type' ORDER BY sectionID DESC LIMIT 1";
                    $section_query_run = $db->query($section_query);
                    $row = mysqli_fetch_assoc($section_query_run);

                    $section_id = $row["sectionID"];

                    $insert = "INSERT INTO sections_text VALUES('', '$insert_text', '$section_id')";
                    if($insert_run = $db->query($insert)){
                        header('location: edit-guide.php?id='.$id.'');
                    }
                }
            }if($type == 'imagesandwords'){
                $type = 'images and words';
                $text = $_POST["text"];
                $insert_text = nl2br($text);
                $imageData = $_FILES["image"]["tmp_name"];
                $imageName = $_FILES["image"]["name"];
                $imageType = $_FILES["image"]["type"];
                $imagepath = "guide_images/".$imageName;
                $float = $_POST["float"];
                move_uploaded_file($ImageData, $imagepath);	

                $query = "INSERT INTO sections VALUES('', '$type', '$guide_id')";

                if($query_run = $db->query($query)){
                    $section_query = "SELECT * FROM sections WHERE sectionCategory = '$type' ORDER BY sectionID DESC LIMIT 1";
                    $section_query_run = $db->query($section_query);
                    $row = mysqli_fetch_assoc($section_query_run);

                    $section_id = $row["sectionID"];

                    $insert = "INSERT INTO sections_text_images VALUES('', '$insert_text', '$imagepath', '$float', '$section_id')";
                    if($insert_run = $db->query($insert)){
                        header('location: edit-guide.php?id='.$id.'');
                    }
                }
            }if($type == 'image'){
                $imageData = $_FILES["image"]["tmp_name"];
                $imageName = $_FILES["image"]["name"];
                $imageType = $_FILES["image"]["type"];
                $imagepath = "guide_images/".$imageName;
                move_uploaded_file($ImageData, $imagepath);	

                $query = "INSERT INTO sections VALUES('', '$type', '$guide_id')";

                if($query_run = $db->query($query)){
                    $section_query = "SELECT * FROM sections WHERE sectionCategory = '$type' ORDER BY sectionID DESC LIMIT 1";
                    $section_query_run = $db->query($section_query);
                    $row = mysqli_fetch_assoc($section_query_run);

                    $section_id = $row["sectionID"];

                    $insert = "INSERT INTO sections_image VALUES('', '$imagepath', '$section_id')";
                    if($insert_run = $db->query($insert)){
                        header('location: edit-guide.php?id='.$id.'');
                    }
                }
            }
        }
    ?>
</div>
<?php
    include '../admin/includes/footer.inc.php';
?>
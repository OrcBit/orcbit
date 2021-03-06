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
        
        $guides_query = "SELECT sectionID, sectionCategory FROM sections WHERE guideID = '$id'";
        $guides_query_run = $db->query($guides_query);
        
        $amount = $guides_query_run->num_rows;
                
        if($amount > 0){
            while($row = mysqli_fetch_assoc($guides_query_run)){
                
                $section_id = $row["sectionID"];
                $category = $row["sectionCategory"];
                
               
                if($category == 'video'){
                    $video_query = "SELECT videoURL FROM sections_video WHERE sectionID = '$section_id'";
                    $video_query_run = $db->query($video_query);
                    $video_row = mysqli_fetch_assoc($video_query_run);
                    $url = $video_row["videoURL"];
                    
                    echo $url;

                }if($category == 'header'){
                    $header_query = "SELECT headerContent FROM sections_header WHERE sectionID = '$section_id'";
                    $header_query_run = $db->query($header_query);
                    $header_row = mysqli_fetch_assoc($header_query_run);
                    $content = $header_row["headerContent"];
                    
                    echo '<h1>'.$content.'</h1>';

                }if($category == 'header and text'){
                    $ht_query = "SELECT headertextTitle, headertextContent FROM sections_header_text WHERE sectionID = '$section_id'";
                    if($ht_query_run = $db->query($ht_query)){
                    $ht_row = mysqli_fetch_assoc($ht_query_run);
                    $title = $ht_row["headertextTitle"];
                    $text = $ht_row["headertextContent"];
                   
                    echo '<h1>'.$title.'</h1>';
                    echo '<p>'.$text.'</p>';
                    }
                }if($category == 'text'){
                    $ht_query = "SELECT textContent FROM sections_text WHERE sectionID = '$section_id'";
                    if($ht_query_run = $db->query($ht_query)){
                    $ht_row = mysqli_fetch_assoc($ht_query_run);
                    $text = $ht_row["textContent"];
                   
                    echo '<p>'.$text.'</p>';
                    }
                }if($category == 'images and words'){
                    $ht_query = "SELECT textContent, imagePath, imageFloat FROM sections_text_images WHERE sectionID = '$section_id'";
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
                    $ht_query = "SELECT imagePath FROM sections_image WHERE sectionID = '$section_id'";
                    if($ht_query_run = $db->query($ht_query)){
                    $ht_row = mysqli_fetch_assoc($ht_query_run);
                    $path = $ht_row["imagePath"];
                   
                    echo '<img src="../'.$path.'">';
                    }
                }if($category == 'tabel'){
                    echo '<table>';
                    echo '<tr>';
                        echo '<th>'.$section_id.'</th>';
                        echo '<th>Item</th>';
                        echo '<th>Source</th>';
                        echo '<th>Enchant</th>';
                        echo '<th>Source type</th>';
                        echo '<th>Patch Notes</th>';
                    echo '</tr>';
                    // tæller hvor mange rows af tr vi skal have
                    $tab_query = "SELECT * FROM tabels WHERE sectionID = '$section_id' ORDER BY tabelRow";
                    $tab_query_run = $db->query($tab_query);
                    $count = $tab_query_run->num_rows;
                    
                    $amount = $count + 1;

                    // viser hvor mange gange den skal køre scriptet igennem indtil alle er blevet vist

                    for ($i = 0; $i <= $amount; $i++) {
                        $query = "SELECT * FROM tabels WHERE tabelRow = '$i'";
                        $query_run = $db->query($query);
                        echo '<tr>';
                        while($row = mysqli_fetch_assoc($query_run)){
                            $slot = $row["tabelSlot"];
                            $item = $row["tabelItem"];
                            $source = $row["tabelSource"];
                            $enchant = $row["tabelEnchant"];
                            $type = $row["tabelType"];
                            $patch = $row["tabelPatch"];

                            echo '<td>'.$slot.'</td>';
                            echo '<td>'.$item.'</td>';
                            echo '<td>'.$source.'</td>';
                            echo '<td>'.$enchant.'</td>';
                            echo '<td>'.$type.'</td>';
                            echo '<td>'.$patch.'</td>';
                        }
                        echo '</tr>';
                    }
                    echo '</table><br>';
                }
            }
        }else{
            echo '<div id="guide_content">';
                echo '<p>Nothing Here Yet</p>';
            echo '</div>';
        }
        ?>
        <div id="cms_wrapper">
    	<button value="text" onclick="cmsload(this.value)">TEXT</button>
        <button value="header" onclick="cmsload(this.value)">HEADER</button>
        <button value="headerandtext" onclick="cmsload(this.value)">HEADER & TEXT</button>
        <button value="image" onclick="cmsload(this.value)">IMAGE</button>
    	<button value="video" onclick="cmsload(this.value)">VIDEO</button>
        <button value="imagesandwords" onclick="cmsload(this.value)">TEXT & IMAGE</button>
        <button value="tabel" onclick="cmsload(this.value)">TABEL</button>
        <button value="list" onclick="cmsload(this.value)">LIST</button>
  <?php
  echo '<div id="cms_forms">';
  echo '<form action="edit-guide.php?id='.$id.'&type=text" method="post" enctype="multipart/form-data">';
      	echo '<textarea name="text" placeholder="text"></textarea>';
    	echo '<input type="submit" class="submit" name="submit" placeholder="sumbit">';
	echo '</form>';
  echo '</div>';
	?>
</div>
        <form>
        <select id="comboA" onchange="getComboA(this)">
        <option value="">Select combo</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        </select>
        </form>
        <div id="listinsert">
        </div><br><br><br><br>
        <?php
        echo '</div>';
    }
    if(isset($_GET["amount"])){
        $amount = $_GET["amount"];
  
        $section_query = "SELECT * FROM sections WHERE sectionCategory = '$type' ORDER BY sectionID DESC LIMIT 1";
        $section_query_run = $db->query($section_query);
        $row = mysqli_fetch_assoc($section_query_run);

        $section_id = $row["sectionID"];

        for ($x = 0; $x <= $amount; $x++) {
              $query = "INSERT INTO secton_list VALLUES('', '', '$x', '', '') ";
          }  	    
        }if(isset($_POST["submit"])){
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
            }if($type == 'tabel'){
                $tab_number = $_POST["tabel"];
                $query = "INSERT INTO sections VALUES('', '$type', '$guide_id')";
                
                echo $tab_number;
                if($query_run = $db->query($query)){
                    $section_query = "SELECT * FROM sections WHERE sectionCategory = '$type' ORDER BY sectionID DESC LIMIT 1";
                    $section_query_run = $db->query($section_query);
                    $row = mysqli_fetch_assoc($section_query_run);

                    $section_id = $row["sectionID"];

                    $update = "UPDATE tabels SET sectionID = '$section_id' WHERE tabelNumber = '$tab_number'";
                    if($update_run = $db->query($update)){
                        header('location: edit-guide.php?id='.$tab_number.'');
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
<?php
    include 'includes/connect.inc.php';
    $class = 'Druid';
    include 'includes/header.inc.php';
    include 'includes/menu.inc.php';

    echo '<section class="maincontent">';
    echo '<div class="wrapper">';
    echo '<div id="content">';
        echo '<div class="content-wrapper">';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $guide_id = $_GET['id'];
        $guides_query = "SELECT * FROM guides WHERE guideID = '$id'";
        $guides_query_run = $db->query($guides_query);
        
        
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
                    
                    echo '<div id="youtube_video">'.$url.'</div>';

                }if($category == 'header'){
                    $header_query = "SELECT * FROM sections_header WHERE sectionID = '$section_id'";
                    $header_query_run = $db->query($header_query);
                    $header_row = mysqli_fetch_assoc($header_query_run);
                    $content = $header_row["headerContent"];
                    echo '<div class="classheader">';
                    echo '<h1>'.$content.'</h1>';
                    echo '</div>';

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
                                echo '<img src="./'.$path.'" class="align">';
                            echo '</div>';
                        }if($float == 'right'){
                            echo '<div class="guidefloat_right">';
                                echo '<img src="./'.$path.'" class="align">';
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
                   
                    echo '<img src="./'.$path.'">';
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
        echo '</div>';
    echo '</div>';
    echo '</div>';
echo '</section>';
        }
    include 'includes/socials.inc.php';
    include 'includes/footer.inc.php';
?>
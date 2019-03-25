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

            echo '<div id="guide_content">';
                echo '<p>Something Here</p>';
            echo '</div>';
            }
        }else{
            echo '<div id="guide_content">';
                echo '<p>Nothing Here Yet</p>';
            echo '</div>';
        }
        echo '<form action="edit-guide.php?type=1" method="post" enctype="multipart/form-data">';
            echo '<input type="text" name="video" placeholder="video URL">';
            echo '<input type="submit" name="sumbit" placeholder="sumbit"><br>';
        echo '</form>';
        
        echo '<form action="edit-guide.php?type=2" method="post" enctype="multipart/form-data">';
            echo '<input type="text" name="header" placeholder="header">';
            echo '<input type="submit" name="sumbit" placeholder="sumbit"><br>';
        echo '</form>';
        
        echo '<form action="edit-guide.php?type=3 method="post" enctype="multipart/form-data">';
            echo '<input type="text" name="textwithtitle" placeholder="text with title">';
            echo '<input type="submit" name="sumbit" placeholder="sumbit"><br>';
        echo '</form>';
        
        echo '<form action="edit-guide.php?type=4" enctype="multipart/form-data">';
            echo '<textarea name="text" placeholder="text"></textarea><br>';
            echo '<input type="submit" name="sumbit" placeholder="sumbit"><br>';
        echo '</form>';
        
        echo '<form action="edit-guide.php?type=5" method="post" enctype="multipart/form-data">';
            echo '<input type="text" name="navn" placeholder="title"><br>';
            echo '<textarea name="text" placeholder="text"></textarea><br>';
            echo '<input type="file" name="navn" placeholder="title"><br>';
            echo '<select name="float"><br><br>';
            echo 'Image: left or right';
            echo '<option>right</option>';
            echo '<option>left</option>';
            echo '</select>';
            echo '<input type="submit" name="sumbit" placeholder="sumbit">';
        echo '</form>';
        
        echo '<form action="edit-guide.php?type=6" method="post" enctype="multipart/form-data">';
            echo '<input type="file" name="navn" placeholder="title"><br>';
            echo '<input type="submit" name="sumbit" placeholder="sumbit">';
        echo '</form>';
        
    }
    if(isset($_POST["navn"]) && isset($_GET["type"])){
        $type = $_GET["type"];
        if($type = '1'){
            $video = $_POST["video"];
            
        }
    }
    ?>
</div>
<?php
    include '../admin/includes/footer.inc.php';
?>
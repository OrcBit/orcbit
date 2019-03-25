<?php
    include '../includes/connect.inc.php';
    include '../admin/includes/header.inc.php';
    include '../admin/includes/admin-menu.inc.php';
?>
<!--main content page-->
<section class="maincontent">
    <?php
       $guides_query = "SELECT * FROM guides";
        $guides_query_run = $db->query($guides_query);
        echo '<ul>';
        while($row = mysqli_fetch_assoc($guides_query_run)){
            $guide_name = $row['guideName'];
            $guide_id = $row['guideID'];
            
            echo '<li><a href="edit-guide.php?id='.$guide_id.'">'.$guide_name.'</a><li>';
        }
        echo '</ul>';
    echo '';
    
    echo '';

    echo '<form action="admin.php">';
        
        echo '<p>Guide Category</p>';
        
        $category_query = "SELECT * FROM category";
        $category_query_run = $db->query($category_query);
        
        echo '<select name="category">';
        while($row = mysqli_fetch_assoc($category_query_run)){
            $guide_name = $row['categoryName'];
            
            echo '<option >'.$guide_name.'</option>';
        }
        echo '</select><br><br>';
        echo '<input type="submit" value="Add Guide">';
    echo '</form>';
    ?>
</section>
<?php
if(isset($_POST["submit"])){
    $name = $_POST["guide_name"];
    $category = $_POST["category"];
    
    $query = "INSERT INTO guides VALUES('', '$name', '$category','', ''";
    }
	if($query_run = $db->query($query)){
		header("location:add.php");
	}else{
		echo '<h2 style="color:#fff">fejl</h2>';
	}
}
    
    include '../admin/includes/footer.inc.php';
?>
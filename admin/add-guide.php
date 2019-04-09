<?php
    include '../includes/connect.inc.php';
    include '../admin/includes/header.inc.php';
    include '../admin/includes/admin-menu.inc.php';
?>

<section class="maincontent">
    <?php
    
    
    if(isset($_GET["category"])){
        $category = $_GET["category"];
                
        $guide_query = "SELECT * FROM guides WHERE guideCategory = '$category' ORDER BY guideID DESC LIMIT 1";
        $guide_query_run = $db->query($guide_query);
        $row = mysqli_fetch_assoc($guide_query_run);
        
        $id = $row["guideID"];
        
        if($category == 'Class Guides'){
        echo '<form action="add-guide.php?id='.$id.'" method="POST" enctype="multipart/form-data">';  
            $class_query = "SELECT * FROM class";
            $class_query_run = $db->query($class_query);

            echo '<p>Guide Name:</p>';
            echo '<input type="text" name="guide_name">';
            echo '<p>Class Name:</p>';
            echo '<select name="data_name">';
                while($row = mysqli_fetch_assoc($class_query_run)){
                    $class_name = $row['className'];
                    $class_id = $row['classID'];

                    echo '<option>'.$class_name.'</option>';
                }
            echo '</select><br>';
            echo '<p>Guide icon:</p>';
            echo '<input type="file" name="image"><br>';
            echo '<input type="submit" name="submit" value="Add Guide">';
        echo '</form>';   
        }            
    }
            
 ?>   
</section>

<?php
if(isset($_POST["submit"])){
    $id = $_GET["id"];
    $name = $_POST["guide_name"];
    $data_name = $_POST["data_name"];
        
    $class_query = "SELECT * FROM class WHERE className = '$data_name'";
    $class_query_run = $db->query($class_query);
    $row = mysqli_fetch_assoc($class_query_run);
    
    $data_id = $row["classID"];
    
    $imageData = $_FILES["image"]["tmp_name"];
	$imageName = $_FILES["image"]["name"];
	$imageType = $_FILES["image"]["type"];
	$imagepath = "guide_images/".$imageName;
	move_uploaded_file($ImageData, $imagepath);	
    
    $query = "UPDATE guides SET guideName = '$name', dataID = '$data_id', dataName = '$data_name', dataIcon = '$imagepath' WHERE guideID = '$id'";
    
	if($query_run = $db->query($query)){
		header("location:admin.php");
	}else{
		echo '<h2 style="color:#fff">fejl</h2>';
	}
}
    
    include '../admin/includes/footer.inc.php';
?>
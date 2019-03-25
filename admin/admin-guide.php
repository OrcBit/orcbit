<?php
    include '../admin/includes/header.inc.php';
    include '../admin/includes/admin-menu.inc.php';
?>
<!--main content page-->
<div id="addGuide">
    <form action="admin-guide.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="navn" placeholder="navn"><br>
        <input type="text" name="udgivelse" placeholder="udgivelse"><br>
        <input type="text" name="review" placeholder="resume"><br>
        <input type="text" name="trailer" placeholder="trailer"><br>
        <input type="text" name="score" placeholder="score"><br>
        <input type="text" name="anbefalet" placeholder="anbefalet af"><br>
        <input type="text" name="genre" placeholder="genre"><br>
        <input type="text" name="look" placeholder="hvem skal se"><br>
        <p>GUIDE THUMBNAIL</p><br><br>
        <input type="file" name="image"><br>
        <p>GUIDE COVER IMAGE</p><br><br>
        <input type="file" name="cover"><br>
        <textarea name="location" placeholder="fil lokation"></textarea><br>
        <input type="submit" value="Tilføj film"><br>
    </form>
</div>

<?php
if(isset($_POST["navn"])){
	
	$navnn = $_POST["navn"];

	$navn = htmlentities($navnn);
	
	$udgivelse = $_POST["udgivelse"];
	
	$resume = $_POST["review"];
	$trailer = $_POST["trailer"];
	$score = $_POST["score"];
	$anbefalet = $_POST["anbefalet"];
	$genre = $_POST["genre"];
	$senavn = $_POST["look"];
	$filepathh = $_POST["location"];
	
	
	$filepath = htmlentities($filepathh, ENT_QUOTES, "UTF-8");
	$str = str_replace('\\', '/', $filepath);	
	
	
	$coverData = $_FILES["cover"]["tmp_name"];
	$coverName = $_FILES["cover"]["name"];
	$coverType = $_FILES["cover"]["type"];
	$coverpath = "cover/".$coverName;
	
	
	$imageData = $_FILES["image"]["tmp_name"];
	$imageName = $_FILES["image"]["name"];
	$imageType = $_FILES["image"]["type"];
	$imagepath = "img/".$imageName;
	move_uploaded_file($coverData, $coverpath);	
	move_uploaded_file($ImageData, $imagepath);	
	
	$query = "INSERT INTO film VALUES('', '$navn', '$udgivelse', '$resume', '$trailer', '$score', '$anbefalet', '$genre', '$senavn', '$filepath', '$coverpath', '$imagepath')";

	if($query_run = $db->query($query)){
		header("location:add.php");
	}else{
		echo '<h2 style="color:#fff">fejl</h2>';
	}
}

?>
<?php
    include '../admin/includes/footer.inc.php';
?>
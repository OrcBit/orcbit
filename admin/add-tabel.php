<?php
    include '../includes/connect.inc.php';
    include '../admin/includes/header.inc.php';
    include '../admin/includes/admin-menu.inc.php';
?>
<table>
<tr>
	<th>Item Slot</th>
	<th>Item</th>
	<th>Source</th>
	<th>Enchant</th>
	<th>Source type</th>
	<th>Patch Notes</th>
</tr>
<?php
// tæller hvor mange rows af tr vi skal have
$query = "SELECT * FROM tabels WHERE tabelNumber = 1";
$query_run = $db->query($query);
$count = $query_run->num_rows;
// viser hvor mange gange den skal køre scriptet igennem indtil alle er blevet vist
    
for ($i = 0; $i <= $count;) {
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
   $i++;
}
?>
</table>
<div id="stop">
</div>


<form action="add-tabel.php" method="POST" enctype="multipart/form-data">
    <p>Item Slot</p>
	<input type="text" name="slot"><br><br>
    <p>Item</p>
	<input type="text" name="item"><br><br>
    <p>Source</p>
    <input type="text" name="source"><br><br>
    <p>Enchant</p>
    <input type="text" name="enchant"><br><br>
    <p>Source type</p>
    <input type="text" name="type"><br><br>
    <p>Patch Notes</p>
    <input type="text" name="notes"><br><br>    
    <input type="submit" name="submit"><br><br>    
</form>

<?php
if(isset($_POST["submit"])){
    $slot = addslashes(htmlentities(nl2br($_POST["slot"])));
    $item = addslashes(htmlentities(nl2br($_POST["item"])));
    $source = addslashes(htmlentities(nl2br($_POST["source"])));
    $enchant = addslashes(htmlentities(nl2br($_POST["enchant"])));
    $type = addslashes(htmlentities(nl2br($_POST["type"])));
    $notes = addslashes(htmlentities(nl2br($_POST["notes"])));
    
    echo $slot;
    echo '<br><br>';
    echo $item;
    echo '<br><br>';
    echo $source;
    echo '<br><br>';
    echo $enchant;
    echo '<br><br>';
    echo $type;
    echo '<br><br>';
    echo $notes;
    echo '<br><br>';

    
    $sql = "INSERT INTO tabels VALUES('', 'Resto', '$slot', '$item', '$source', '$enchant', '$type', '$notes', '5', '1', '')";
    if($sql_run = $db->query($sql)){
        echo 'Added to database';
    }else{
        echo 'NOT added to database';        
    }
}
?>
<?php
    include '../admin/includes/footer.inc.php';
?>
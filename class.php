<?php
    include 'includes/connect.inc.php';
    $class = 'Druid';
    include 'includes/header.inc.php';
    include 'includes/menu.inc.php';
?>
<!--main content page-->
<section class="maincontent">
    <?php
    $sql = "SELECT * FROM classguide WHERE className = $class";
    $query = query($sql);
    $query_run = mysql_run($query);
    $row = mysqli_fetch_assoc($query_run);
        $className = $row['className'];
        $leveling = $row['leveling'];
        $gear = $row['gear'];
        $stats = $row['stats'];
        $pve = $row['pve'];
        $pvp = $row['pve'];
        $addon = $row['addon'];
    ?>
</section>
<?php
    include 'includes/socials.inc.php';
    include 'includes/footer.inc.php';
?>
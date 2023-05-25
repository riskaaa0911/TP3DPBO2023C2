<?php

include("config/db.php");
include("classes/DB.php");
include("classes/Drama.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $drama = new Drama($db_host, $db_user, $db_pass, $db_name);
    $drama->open();

    $targetDir = "./assets/images/";
    $fileTargetDir = $targetDir . $data['poster_drama'];
    unlink($fileTargetDir);

    $drama->deleteDrama($id);
    header("location: index.php");
}

?>
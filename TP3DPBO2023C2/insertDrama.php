<?php

include("config/db.php");
include("classes/DB.php");
include("classes/Produksi.php");
include("classes/Writer.php");
include("classes/Drama.php");
include("classes/Template.php");

// open db
$drama = new Drama($db_host, $db_user, $db_pass, $db_name);
$drama->open();

$produksi = new Produksi($db_host, $db_user, $db_pass, $db_name);
$produksi->open();

$writer = new Writer($db_host, $db_user, $db_pass, $db_name);
$writer->open();

$produksi->getProduksi();
$writer->getWriter();

// jika user klik tombol submit di form untuk menambahkan data drama
if (isset($_POST['btn-submit'])) {
    // memanggil method insert drama
    $drama->insertDrama($_POST, $_FILES);
    header("location:index.php");
}


$dataWriter = null;
//mengambil semua data writer
while ($row = $writer->getResult()) {
    //membuat input dropdown untuk memilih writer
    $dataWriter .= "
        <option value='". $row['id_writer'] ."'>" . $row['nama_writer'] . "</option>
    ";
}

$dataProduksi = null;
//mengambil semua data produksi
while ($row = $produksi->getResult()) {
    // membuat input dropdown untuk memilih produksi
    $dataProduksi .= "
        <option value='". $row['id_produksi'] ."'>" . $row['nama_produksi'] . "</option>
    ";
}


// close db
$drama->close();
$produksi->close();
$writer->close();

// menerapkan ke template
$tpl = new Template("templates/drama.html");
$tpl->replace("DATA_WRITER", $dataWriter);
$tpl->replace("DATA_PRODUKSI", $dataProduksi);
$title = "Tambah Drama";
$tpl->replace("DATA_TITLE", $title);
$tpl->write();

?>
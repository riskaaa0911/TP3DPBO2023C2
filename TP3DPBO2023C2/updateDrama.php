<?php

include("config/db.php");
include("classes/DB.php");
include("classes/Produksi.php");
include("classes/Writer.php");
include("classes/Drama.php");
include("classes/Template.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $drama = new Drama($db_host, $db_user, $db_pass, $db_name);
    $drama->open();

    $produksi = new Produksi($db_host, $db_user, $db_pass, $db_name);
    $produksi->open();

    $writer = new Writer($db_host, $db_user, $db_pass, $db_name);
    $writer->open();

    $drama->getDramaById($id);
    $produksi->getProduksi();
    $writer->getWriter();

    if (isset($_POST['btn-submit'])) {
        $drama->updatedrama($id, $_POST, $_FILES);
        header("location:index.php");
    }

    list($id, $poster_drama, $judul, $jml_eps, $tahun, $id_writer, $id_produksi, $rating, $sinopsis) = $drama->getResult();

    $dataWriter = null;
    while ($row = $writer->getResult()) {
        $dataWriter .= "
            <option value='". $row['id_writer'] ."'>" . $row['nama_writer'] . "</option>
        ";
    }

    $dataProduksi = null;
    while ($row = $produksi->getResult()) {
     $dataProduksi .= "
        <option value='". $row['id_produksi'] ."'>" . $row['nama_produksi'] . "</option>
    ";
    }

    $drama->close();
    $produksi->close();
    $writer->close();

    $tpl = new Template("templates/drama.html");
    $tpl->replace("DATA_WRITER", $dataWriter);
    $tpl->replace("DATA_PRODUKSI", $dataProduksi);
    $title = "Edit Drama";
    $tpl->replace("DATA_TITLE", $title);
    $tpl->replace("DATA_JUDUL", $judul);
    $tpl->replace("DATA_EPISODE", $jml_eps);
    $tpl->replace("DATA_TAHUN", $tahun);
    $tpl->replace("DATA_RATING", $rating);
    $tpl->replace("DATA_SINOPSIS", $sinopsis);
    $tpl->write();
}

?>
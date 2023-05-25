<?php

include("config/db.php");
include("classes/DB.php");
include("classes/Produksi.php");
include("classes/Writer.php");
include("classes/Template.php");

$produksi = new Produksi($db_host, $db_user, $db_pass, $db_name);
$produksi->open();

$dataNavbar = null;
$dataHeader = null;
$dataContent = null;
$dataForm = null;
$title = "Produksi";

// Menambahkan produksi
if (!isset($_GET['id_update'], $_GET['id_delete'])) {
    // membuat form
    $inputTitle = "Tambah Produksi";
    $dataForm = "
            <div class='mb-3'>
              <label for='jabatan' class='form-label'>Nama Produksi</label>
              <input type='text' class='form-control' id='nama_produksi' name='nama_produksi' placeholder='Masukan Nama Produksi...' required />
            </div>
            <div class='float-end'>
                <button type='submit' class='btn btn-info' name='btn-submit' id='btn-submit'>Submit</button>
                <button type='reset' class='btn btn-secondary' name='btn-reset' id='btn-reset'>Reset</button>
            </div>
    ";

    // jika user klik submit
    if (isset($_POST['btn-submit'])) {
        $namaProduksi = $_POST['nama_produksi'];
        //memanggil method untuk insert data produksi
        $produksi->insertProduksi($namaProduksi);
        header("location: Produksi.php");
    }
}

// JIka user mengklik edit
if (isset($_GET['id_update'])) {
    $id_update = $_GET['id_update'];
    $produksi->getDetailProduksi($id_update);
    $row = $produksi->getResult();

    // membuat form
    $inputTitle = "Edit Produksi";
    $dataForm = "
            <div class='mb-3'>
              <input type='hidden' class='form-control' id='id_produksi' name='id_produksi' value='". $row ['id_produksi']."' />
              <label for='jabatan' class='form-label'>Nama Produksi</label>
              <input type='text' class='form-control' id='nama_produksi' name='nama_produksi' value='". $row['nama_produksi'] ."' placeholder='Masukan Jabatan...' required />
            </div>
            <div class='float-end'>
                <button type='submit' class='btn btn-info' name='btn-edit' id='btn-edit'>Submit</button>
                <button type='reset' class='btn btn-secondary' name='btn-reset' id='btn-reset'>Reset</button>
            </div>
    ";

    // jika user mengklik submit untuk mengedit data produksi
    if (isset($_POST['btn-edit'])) {
        $id_produksi = $_POST['id_produksi'];
        $namaProduksi = $_POST['nama_produksi'];
        // memanggil method untuk update data produksi
        $produksi->updateProduksi($id_produksi, $namaProduksi);
        header("location: Produksi.php");
    }
}

// jika user mengklik hapus
if (isset($_GET['id_delete'])) {
    $id_produksi = $_GET['id_delete'];
    // memanggil method untuk menghapus data produksi yang dipilih
    $produksi->deleteProduksi($id_produksi);
    header("location: Produksi.php");
}

// membuat navbar
$dataNavbar .= "
            <li class='nav-item'>
                <a class='nav-link active' href='produksi.php'>Produksi</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='writer.php'>Writer</a>
            </li>
";

// membuat header tabel
$dataHeader .= "
            <th scope='col'>No</th>
            <th scope='col'>Nama Produksi</th>
            <th scope='col'>Aksi</th>
";

$produksi->getProduksi();
$no = 1;
while ($div = $produksi->getResult()) {
    $dataContent .= "
        <tr>
            <th scope='row'>". $no ."</th>
            <td>". $div['nama_produksi'] ."</td>
            <td>
                <a href='Produksi.php?id_update=". $div['id_produksi'] ."' class='btn btn-info me-1' name='btn-edit' id='btn-edit'>Edit</a>
                <a href='Produksi.php?id_delete=". $div['id_produksi'] ."' class='btn btn-danger' name='btn-delete' id='btn-delete'>Delete</a>
            </td>
        </tr>
    ";
    $no++;
}

// close db
$produksi->close();

$tpl = new Template("templates/table.html");
$tpl->replace("DATA_NAVBAR", $dataNavbar);
$tpl->replace("DATA_TITLE", $title);
$tpl->replace("DATA_INPUT_TITLE", $inputTitle);
$tpl->replace("DATA_INPUT_FORM", $dataForm);
$tpl->replace("DATA_HEADER", $dataHeader);
$tpl->replace("DATA_CONTENT", $dataContent);
$tpl->write();

?>
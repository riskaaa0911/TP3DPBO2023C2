<?php

include("config/db.php");
include("classes/DB.php");
include("classes/writer.php");
include("classes/Template.php");

$writer = new Writer($db_host, $db_user, $db_pass, $db_name);
$writer->open();

$dataNavbar = null;
$dataHeader = null;
$dataContent = null;
$dataForm = null;
$title = "Writer";

if (!isset($_GET['id_update'], $_GET['id_delete'])) {
    $inputTitle = "Tambah Writer";
    $dataForm = "
            <div class='mb-3'>
              <label for='nama_writer' class='form-label'>Nama Writer</label>
              <input type='text' class='form-control' id='nama_writer' name='nama_writer' placeholder='Masukan Nama Writer...' required />
            </div>
            <div class='float-end'>
                <button type='submit' class='btn btn-info' name='btn-submit' id='btn-submit'>Submit</button>
                <button type='reset' class='btn btn-secondary' name='btn-reset' id='btn-reset'>Reset</button>
            </div>
    ";

    if (isset($_POST['btn-submit'])) {
        $nama_writer = $_POST['nama_writer'];

        $writer->insertWriter($nama_writer);
        header("location: writer.php");
    }
}

if (isset($_GET['id_update'])) {
    $id_update = $_GET['id_update'];

    $writer->getDetailWriter($id_update);
    $row = $writer->getResult();

    $inputTitle = "Edit Writer";
    $dataForm = "
            <div class='mb-3'>
              <input type='hidden' class='form-control' id='id_writer' name='id_writer' value='". $row['id_writer']."' />
              <label for='nama_writer' class='form-label'>Nama Writer</label>
              <input type='text' class='form-control' id='nama_writer' name='nama_writer' value='". $row['nama_writer'] ."' placeholder='Masukan Nama Writer...' required />
            </div>
            <div class='float-end'>
                <button type='submit' class='btn btn-info' name='btn-edit' id='btn-edit'>Submit</button>
                <button type='reset' class='btn btn-secondary' name='btn-reset' id='btn-reset'>Reset</button>
            </div>
    ";

    if (isset($_POST['btn-edit'])) {
        $id_writer = $_POST['id_writer'];
        $nama_writer = $_POST['nama_writer'];

        $writer->updateWriter($id_writer, $nama_writer);
        header("location: writer.php");
    }
}

if (isset($_GET['id_delete'])) {
    $id_writer = $_GET['id_delete'];
    $writer->deleteWriter($id_writer);
    header("location: writer.php");
}

$dataNavbar .= "
            <li class='nav-item'>
                <a class='nav-link' href='produksi.php'>Produksi</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link active' href='writer.php'>Writer</a>
            </li>
";

$dataHeader .= "
            <th scope='col'>No</th>
            <th scope='col'>Nama Writer</th>
            <th scope='col'>Aksi</th>
";

$no = 1;
$writer->getWriter();
while ($div = $writer->getResult()) {
    $dataContent .= "
        <tr>
            <th scope='row'>". $no ."</th>
            <td>". $div['nama_writer'] ."</td>
            <td>
                <a href='writer.php?id_update=". $div['id_writer'] ."' class='btn btn-info me-1' name='btn-edit' id='btn-edit'>Edit</a>
                <a href='writer.php?id_delete=". $div['id_writer'] ."' class='btn btn-danger' name='btn-delete' id='btn-delete'>Delete</a>
            </td>
        </tr>
    ";
    $no++;
}

$writer->close();

$tpl = new Template("templates/table.html");
$tpl->replace("DATA_NAVBAR", $dataNavbar);
$tpl->replace("DATA_TITLE", $title);
$tpl->replace("DATA_INPUT_TITLE", $inputTitle);
$tpl->replace("DATA_INPUT_FORM", $dataForm);
$tpl->replace("DATA_HEADER", $dataHeader);
$tpl->replace("DATA_CONTENT", $dataContent);
$tpl->write();

?>
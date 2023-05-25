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
 $data = null;
// jika user klik data drama tertentu
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  if ($id > 0) { 
    //menampilkan data drama berdasarkan id
    $drama->getDramaById($id);
    $row = $drama->getResult();
    $data .= "
         <div class='row justify-content-between'>
            <div class='col-md-4'>
              <div class='card bg-black'>
                <img class='m-auto' src='./assets/images/". $row['poster_drama'] ."' alt='". $row['poster_drama'] ."' width='100%' />
              </div>
            </div>
            <div class='col-md-8'>
              <div class='card'>
                <div class='card-body'>
                  <table class='text-start'>
                    <tr>
                      <th scope='row' class='w-25'>Judul</th>
                      <td>: ". $row['judul'] ."</td>
                    </tr>
                    <tr>
                      <th scope='row'>Episode</th>
                      <td>: ". $row['jml_eps'] ."</td>
                    </tr>
                    <tr>
                      <th scope='row'>Tahun Rilis</th>
                      <td>: ". $row['tahun'] ."</td>
                    </tr>
                    <tr>
                      <th scope='row'>Writer</th>
                      <td>: ". $row['nama_writer'] ."</td>
                    </tr>
                    <tr>
                      <th scope='row'>Produksi</th>
                      <td>: ". $row['nama_produksi'] ."</td>
                    </tr>
                    <tr>
                      <th scope='row'>Rating</th>
                      <td>: ". $row['rating'] ."</td>
                    </tr>
                    <tr>
                      <th scope='row'>Sinopsis</th>
                      <td>: ". $row['sinopsis'] ."</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
        </div>
        <div class='float-end'>
          <a href='updateDrama.php?id=". $row['id_drama']."' class='btn btn-info'>Edit</a>
          <a href='deleteDrama.php?id=". $row['id_drama'] ."' class='btn btn-danger ms-1'>Delete</a>
        </div>
    ";
  }
}
 // close db
 $drama->close();

 // terapkan ke template
 $tpl = new Template("templates/detailDrama.html");
 $tpl->replace("DATA_DRAMA", $data);
 $tpl->write();

?>
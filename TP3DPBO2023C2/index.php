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

$drama->getDramaJoin();

// cari drama
if (isset($_POST['btn-cari'])) {
  // methode mencari data drama
  $drama->searchDrama($_POST['cari']);
}
else if (isset($_GET['sort'])) {
  // metode mengurutkan data drama
  $drama->sortDrama($_GET['sort']);
} 
else {
  // method menampilkan data drama
  $drama->getDramaJoin();
}
$data = null;

while ($row = $drama->getResult()) {
  $data .= "<div class='col-md-3 mb-4 d-flex justify-content-center'>
  <div class='card shadow w-75'>
    <a href='detaildrama.php?id=". $row['id_drama']."'>
      <img src='./assets/images/". $row['poster_drama'] ."' class='card-img-top' alt='". $row['poster_drama']."' />
      <div class='card-body bg-light'>
        <p class='card-text fw-bold my-0'>". $row['judul'] ."</p>
        <p class='card-text my-2' style='font-size: 1em; color: rgb(20, 51, 79);'>". $row['nama_produksi'] ."</p>
        <p class='card-text my-0' style='font-size: 1em; color: rgb(43, 20, 145);'>". $row['nama_writer'] ."</p>
      </div>
    </a>
  </div>
</div>";
}

// close db
$drama->close();

// terapkan ke template
$tpl = new Template("templates/index.html");
$tpl->replace("DATA_TABLE", $data);
$tpl->write();

?>
<?php

class Drama extends DB {
    function getDramaJoin() {
        $query = "SELECT * FROM drama JOIN writer ON drama.id_writer=writer.id_writer JOIN produksi ON drama.id_produksi=produksi.id_produksi ORDER BY drama.id_drama";

        return $this->execute($query);
    }

    function getDramaById($id)
    {
        $query = "SELECT * FROM drama JOIN writer ON drama.id_writer=writer.id_writer JOIN produksi ON drama.id_produksi=produksi.id_produksi WHERE id_drama=$id";
        return $this->execute($query);
    }

    function searchDrama($keyword)
    {
        $query = "SELECT * FROM drama
        JOIN writer ON drama.id_writer=writer.id_writer
        JOIN produksi ON drama.id_produksi=produksi.id_produksi
        WHERE judul LIKE '%$keyword%'";

        return $this->execute($query);
    }

    function sortDrama($column)
    {
        $query = "SELECT * FROM drama JOIN writer ON drama.id_writer=writer.id_writer JOIN produksi ON drama.id_produksi=produksi.id_produksi ORDER BY $column";
        return $this->execute($query);
    }

    function insertDrama($data, $file) {
        $targetDir = "./assets/images/";
        $image = $file['image']['name'];
        $tmpImage = $file['image']['tmp_name'];
        $fileTargetDir = $targetDir . $image;

        if (!file_exists($fileTargetDir)) {
            $moveUploadedFile = move_uploaded_file($tmpImage, $fileTargetDir);
        }

        $judul = $data['judul'];
        $jml_eps = $data['jml_eps'];
        $tahun = $data['tahun'];
        $id_writer = $data['id_writer'];
        $id_produksi = $data['id_produksi'];
        $rating = $data['rating'];
        $sinopsis = $data['sinopsis'];
        
        $query = "INSERT INTO drama(poster_drama, judul, jml_eps, tahun, id_writer, id_produksi, rating, sinopsis) VALUES ('$image', '$judul', $jml_eps, '$tahun', $id_writer, $id_produksi, $rating, '$sinopsis')";
        return $this->execute($query);
    }

    function updateDrama($id, $data, $file) {
        $targetDir = "./assets/images/";
        $image = $file['image']['name'];
        $tmpImage = $file['image']['tmp_name'];
        $fileTargetDir = $targetDir . $image;

        if (!file_exists($fileTargetDir)) {
            $moveUploadedFile = move_uploaded_file($tmpImage, $fileTargetDir);
        }

        $judul = $data['judul'];
        $jml_eps = $data['jml_eps'];
        $tahun = $data['tahun'];
        $id_writer = $data['id_writer'];
        $id_produksi = $data['id_produksi'];
        $rating = $data['rating'];
        $sinopsis = $data['sinopsis'];
        
        $query = "UPDATE drama SET poster_drama='$image', judul='$judul', jml_eps='$jml_eps', tahun='$tahun',id_writer='$id_writer' , id_produksi='$id_produksi', rating='$rating', sinopsis='$sinopsis' WHERE id_drama='$id'";

        return $this->execute($query);
    }

    function deleteDrama($id) {
        $query = "DELETE FROM drama WHERE id_drama='$id'";
        return $this->execute($query);
    }
}

?>
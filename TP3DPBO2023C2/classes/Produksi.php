<?php

class Produksi extends DB {
    function getProduksi() {
        $query = "SELECT * FROM produksi";
        return $this->execute($query);
    }

    function getDetailProduksi($id) {
        $query = "SELECT * FROM produksi WHERE id_produksi='$id'";
        return $this->execute($query);
    }

    function insertProduksi($nama_produksi) {
        $query = "INSERT INTO produksi VALUES (null, '$nama_produksi')";
        return $this->execute($query);
    }

    function updateProduksi($id, $nama_produksi) {
        $query = "UPDATE produksi SET nama_produksi='$nama_produksi' WHERE id_produksi='$id'";
        return $this->execute($query);
    }

    function deleteProduksi($id) {
        $query = "DELETE FROM produksi WHERE id_produksi='$id'";
        return $this->execute($query);
    }
}

?>
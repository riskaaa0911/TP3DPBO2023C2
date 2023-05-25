<?php

class Writer extends DB {
    function getWriter() {
        $query = "SELECT * FROM writer";
        return $this->execute($query);
    }

    function getDetailWriter($id) {
        $query = "SELECT * FROM writer WHERE id_writer='$id'";
        return $this->execute($query);
    }

    function insertWriter($namaWriter) {
        $query = "INSERT INTO writer VALUES (null, '$namaWriter')";
        return $this->execute($query);
    }

    function updateWriter($id, $namaWriter) {
        $query = "UPDATE writer SET nama_writer='$namaWriter' WHERE id_writer='$id'";
        return $this->execute($query);
    }

    function deleteWriter($id) {
        $query = "DELETE FROM writer WHERE id_writer='$id'";
        return $this->execute($query);
    }
}

?>
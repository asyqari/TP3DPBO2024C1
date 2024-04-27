<?php

class Bidang extends DB
{
    function getBidang()
    {
        $query = "SELECT * FROM t_bidang";
        return $this->execute($query);
    }

    function getBidangById($id)
    {
        $query = "SELECT * FROM t_bidang WHERE id=$id";
        return $this->execute($query);
    }

    function addBidang($data)
    {
        $nama = $data['nama_bidang'];
        $query = "INSERT INTO t_bidang VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updateBidang($id, $data)
    {
        $nama = $data['nama_bidang'];
        $query = "UPDATE t_bidang SET nama_bidang = '$nama' WHERE id = $id";
        return $this->executeAffected($query);
    }

    function deleteBidang($id)
    {
        $query = "UPDATE t_char SET bidang_id = 0 WHERE bidang_id = $id";
        $this->execute($query);
        $query = "DELETE FROM t_bidang WHERE id = $id";
        return $this->executeAffected($query);
    }
    function searchBidang($keyword)
    {
        $query = "SELECT * FROM t_bidang  WHERE name LIKE '%$keyword%' ORDER BY nama_bidang";
        return $this->execute($query);
    }
}

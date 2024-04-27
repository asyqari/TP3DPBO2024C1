<?php

class Pengurus extends DB
{
    function getPengurusJoin()
    {
        $query = "SELECT * FROM pengurus JOIN divisi ON pengurus.divisi_id=divisi.divisi_id JOIN jabatan ON pengurus.jabatan_id=jabatan.jabatan_id ORDER BY pengurus.pengurus_id";

        return $this->execute($query);
    }

    function getPengurus()
    {
        $query = "SELECT * FROM pengurus";
        return $this->execute($query);
    }

    function getPengurusById($id)
    {
        $query = "SELECT * FROM pengurus JOIN divisi ON pengurus.divisi_id=divisi.divisi_id JOIN jabatan ON pengurus.jabatan_id=jabatan.jabatan_id WHERE pengurus_id=$id";
        return $this->execute($query);
    }

    function searchPengurus($keyword)
    {
        // ...
    }

    function addData($data, $file)
    {
        // Menyimpan data yang ada di variable $data 
        $foto = $file;
        $nim = $data['pengurus_nim'];
        $nama = $data['pengurus_nama'];
        $semester = $data['pengurus_semester'];
        $divisi = $data['divisi_id'];
        $jabatan = $data['jabatan_id'];

        $query = "INSERT INTO pengurus VALUES ('','$foto','$nim','$nama','$semester','$divisi','$jabatan')";
        return $this->execute($query);
    }

    function updateData($id, $data, $file)
    {
        $foto = $file;
        $nim = $data['pengurus_nim'];
        $nama = $data['pengurus_nama'];
        $semester = $data['pengurus_semester'];
        $divisi = $data['divisi_id'];
        $jabatan = $data['jabatan_id'];

        $query = "UPDATE pengurus SET pengurus_foto = '$foto',pengurus_nim = '$nim',pengurus_nama = '$nama',pengurus_semester = '$semester',divisi_id = '$divisi',jabatan_id = '$jabatan' WHERE pengurus.pengurus_id = $id";
        return $this->execute($query);
    }

    function deleteData($id)
    {
        $query = "DELETE FROM pengurus WHERE pengurus.pengurus_id = $id";

        return $this->execute($query);
    }
}

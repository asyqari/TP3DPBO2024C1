<?php

class Character extends DB
{
    function getCharacterJoin()
    {
        $query = "SELECT * FROM t_char JOIN t_bidang ON t_char.bidang_id = t_bidang.id JOIN t_role ON t_char.role_id = t_role.id ORDER BY t_char.id";

        return $this->execute($query);
    }

    function getCharacter()
    {
        $query = "SELECT * FROM t_char";
        return $this->execute($query);
    }

    function getCharacterById($id)
    {
        $query = "SELECT * FROM t_char JOIN t_bidang ON t_char.bidang_id = t_bidang.id JOIN t_role ON t_char.role_id = t_role.id WHERE t_char.id = $id";
        return $this->execute($query);
    }

    function searchCharacter($keyword)
    {
        // ...
    }

    function addData($data, $file)
    {
        $picNama = $file['photo']['name'];
        $picNamaTemp = $file['photo']['tmp_name'];
        $destination = 'assets/images/' . $picNama;

        if (!move_uploaded_file($picNamaTemp, $destination)) {
            $photoName = 'noPhoto.png';
        }

        $nama = $data['nama'];
        $tagline = $data['tagline'];
        $roleId = $data['role_id'];
        $bidangId = $data['bidang_id'];
        $query = "INSERT INTO t_char(nama, tagline, pic, role_id, bidang_id) VALUES('$nama', '$tagline', '$photoName', '$roleId', '$bidangId')";
        return $this->executeAffected($query);
    }

    function updateData($id, $data, $file)
    {
    }

    function deleteData($id)
    {
        $query = "DELETE FROM t_char WHERE t_char.id = $id";

        return $this->execute($query);
    }
}

<?php

class Role extends DB
{
    function getRole()
    {
        $query = "SELECT * FROM t_role";
        return $this->execute($query);
    }

    function getRoleById($id)
    {
        $query = "SELECT * FROM t_role WHERE id=$id";
        return $this->execute($query);
    }

    function addRole($data)
    {
        $nama = $data['nama_role'];
        $query = "INSERT INTO t_role VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updateRole($id, $data)
    {
        $nama = $data['nama_role'];
        $query = "UPDATE t_role SET nama_role = '$nama' WHERE id = $id";
        return $this->executeAffected($query);
    }

    function deleteRole($id)
    {
        // set 0 ke null
        $query = "UPDATE t_char SET role_id = 0 WHERE role_id = $id";
        $this->execute($query);
        $query = "DELETE FROM t_role WHERE id = $id";
        return $this->executeAffected($query);
    }
}

<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Bidang.php');
include('classes/Role.php');
include('classes/Character.php');
include('classes/Template.php');

$character = new Character($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$character->open();

$data = nulL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $character->getCharacterById($id);
        $row = $character->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['nama'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['pic'] . '" class="img-thumbnail" alt="' . $row['pic'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $row['nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Tagline</td>
                                    <td>:</td>
                                    <td>' . $row['tagline'] . '</td>
                                </tr>
                                <tr>
                                    <td>Bidang</td>
                                    <td>:</td>
                                    <td>' . $row['nama_bidang'] . '</td>
                                </tr>
                                <tr>
                                    <td>Role</td>
                                    <td>:</td>
                                    <td>' . $row['nama_role'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="#"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="Character/deleteData"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

$character->close();

$detail = new Template('templates/skindetail.html');

$detail->replace('DATA_DETAIL_CHAR', $data);
$detail->write();

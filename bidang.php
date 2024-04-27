<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Divisi.php');
include('classes/Template.php');

$bidang = new Bidang($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$bidang->open();
$bidang->getBidang();

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($bidang->addBidang($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'Bidang.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'Bidang.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'bidang';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama bidang</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'bidang';

while ($div = $bidang->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['nama_bidang'] . '</td>
    <td style="font-size: 22px;">
        <a href="Bidang.php?id=' . $div['id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="Bidang.php?hapus=' . $div['id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($bidang->updatebidang($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'Bidang.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'Bidang.php';
            </script>";
            }
        }

        $bidang->getBidangById($id);
        $row = $bidang->getResult();

        $dataUpdate = $row['bidang_nama'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($bidang->deletebidang($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'Bidang.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'Bidang.php';
            </script>";
        }
    }
}

$divisi->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();

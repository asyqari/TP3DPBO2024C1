<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Character.php');
include('classes/Role.php');
include('classes/Bidang.php');
include('classes/Template.php');

// inisialisasi data dari database
$character = new Character($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$role = new Role($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$bidang = new Bidang($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$character->open();
$role->open();
$bidang->open();

// memanggil template skinFormPerson
$view = new Template('templates/skinformchar.html');

// jika program memiliki post submit (add data)
if (isset($_POST['submit'])) {
    // memasukkan data melalui fungsi addPerson()
    if ($character->addData($_POST, $_FILES) > 0) {
        echo "<script>
            alert('Data berhasil ditambah!');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal ditambah!');
            document.location.href = 'index.php';
        </script>";
    }
}

// setting data untuk template
$btn = 'Add';
$title = 'Add';
$mainTitle = 'Karaktermu';
$formLabel = 'Person';
$photo = 'noPhoto.png';

$roleOption = '';
$role->getRole();
while ($rol = $role->getResult()) {
    $roleOption .= '<option value=' . $rol['id'] . '> ' . $rol['nama_role'] . ' </option>';
}
$bidangOption = '';
$bidang->getBidang();
while ($bid = $bidang->getResult()) {
    $bidangOption .= '<option value=' . $bid['id'] . '> ' . $bid['nama_bidang'] . ' </option>';
}

$role->close();

// setting template
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_PHOTO_LOC', $photo);
$view->replace('DATA_OPTION_ROLE', $roleOption);
$view->replace('DATA_OPTION_BIDANG', $bidangOption);
$view->write();

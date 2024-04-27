<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Bidang.php');
include('classes/Role.php');
include('classes/Character.php');
include('classes/Template.php');

// buat instance pengurus
$listChar = new Character($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listChar->open();
// tampilkan data pengurus
$listChar->getCharacterJoin();

// cari pengurus
if (isset($_POST['btn-cari'])) {
    // methode mencari data pengurus
    $listChar->searchCharacter($_POST['cari']);
} else {
    // method menampilkan data pengurus
    $listChar->getCharacterJoin();
}

$data = null;

// ambil data pengurus
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $listChar->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 pengurus-thumbnail">
        <a href="detail.php?id=' . $row['id'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['pic'] . '" class="card-img-top" alt="' . $row['pic'] . '">
            </div>
            <div class="card-body">
                <p class="card-text pengurus-nama my-0">' . $row['nama'] . '</p>
                <p class="card-text divisi-nama">' . $row['nama_bidang'] . '</p>
                <p class="card-text jabatan-nama my-0">' . $row['nama_role'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

// tutup koneksi
$listChar->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_CHAR', $data);
$home->write();

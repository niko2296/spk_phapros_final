<?php

    include "conn/database.php";
    $db = new database();

    $id = $_GET['id'];
    $value = $_GET['value'];

    $query = $db->verifikasi($id, $value, $_GET['id_anggota'], $_GET['id_jabatan'], $_GET['id_departemen'], $_GET['id_unit']);

    if($value == 1)
        echo 1;
    else if($value == 0)
        echo 2;

?>
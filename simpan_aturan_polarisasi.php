<?php
    include "conn/database.php";
    $db = new database();

    $id_polarisasi = $_POST['id_polarisasi'];
    $bmi = $_POST['bmi'];
    $bma = $_POST['bma'];
    $poin = $_POST['poin'];

    $db->input_aturan_polarisasi($id_polarisasi, $bmi, $bma, $poin);
?>
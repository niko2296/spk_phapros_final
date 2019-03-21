<?php
    include "conn/database.php";
    $db = new database();

    $kpi = $_POST['kpi'];
    $deskripsi = $_POST['deskripsi'];
    $bobot = $_POST['bobot'];
    $sasaran = $_POST['sasaran'];
    $satuan = $_POST['satuan'];
    $sifat_kpi = $_POST['sifat_kpi'];
    $id_periode = $_POST['id_periode'];

    $db->input_kpi($kpi, $deskripsi, $bobot, $sasaran, $satuan, $sifat_kpi, $id_periode);
?>
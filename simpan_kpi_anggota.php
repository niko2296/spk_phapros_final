<?php
    include "conn/database.php";
    $db = new database();

    $id_anggota = $_POST['id_anggota'];
    $id_jabatan = $_POST['id_jabatan'];
    $id_unit = $_POST['id_unit'];
    $kpi = $_POST['kpi'];
    $deskripsi = $_POST['deskripsi'];
    $bobot = $_POST['bobot'];
    $sasaran = $_POST['sasaran'];
    $satuan = $_POST['satuan'];
    $sifat_kpi = $_POST['sifat_kpi'];
    $id_periode = $_POST['id_periode'];

    $db->input_kpi_anggota($id_anggota, $id_jabatan, $id_unit, $kpi, $deskripsi, $bobot, $sasaran, $satuan, $sifat_kpi, $id_periode);
?>
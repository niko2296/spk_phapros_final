<?php
    include "conn/database.php";
    $db = new database();

    $id_anggota = $_POST['id_anggota'];
    $id_jabatan = $_POST['id_jabatan'];
    $id_departemen = $_POST['id_departemen'];
    $id_unit = $_POST['id_unit'];
    $kpi = $_POST['kpi'];
    $deskripsi = $_POST['deskripsi'];
    $bobot = $_POST['bobot'];
    $sasaran = $_POST['sasaran'];
    $satuan = $_POST['satuan'];
    $sifat_kpi = $_POST['sifat_kpi'];
    $id_periode = $_POST['id_periode'];
    $link = $_POST['link'];

    $eksekusi = $db->input_kpi($id_anggota, $id_jabatan, $id_departemen, $id_unit, $kpi, $deskripsi, $bobot, $sasaran, $satuan, $sifat_kpi, $id_periode);
    if($eksekusi == 1)
    {
        if($link == 'kpi1')
            header("location:data_kpi.php");
        else if($link == 'kpi2')
            header("location:detail_kpi_individu_mutasi.php?id_anggota=$id_anggota&&id_jabatan_lama=$id_jabatan&&id_departemen_lama=$id_departemen&&id_unit_lama=$id_unit");
    }
?>
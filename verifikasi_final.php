<?php
    include "conn/database.php";
    $db = new database();

    if($_GET['jenis'] == 'verifikasi')
    {
        $field = $_GET['field'];
        $id = $_GET['id'];
        $value = $_GET['value'];
        $eksekusi = $db->edit_user($id, $field, $value);

        if($eksekusi == 1)
            echo 1;
        else 
            echo 2;
    }
    else if($_GET['jenis'] == 'reset')
    {
        $id = $_GET['id'];
        $username = $_GET['username'];
        $eksekusi = $db->reset_password($id, $username);
        if($eksekusi == 1)
            echo 1;
        else 
            echo 2;
    }
    else if($_GET['jenis'] == 'verif_all')
    {
        $eksekusi = $db->verif_all();
        if($eksekusi == 1)
            echo 1;
        else 
            echo $eksekusi;
    }
    else if($_GET['jenis'] == 'periode')
    {
        $eksekusi = $db->verif_periode($_GET['id'], $_GET['value']);
        if($eksekusi == 1)
        {
            if($_GET['value'] == 1)
                echo 1;
            else if($_GET['value'] == 0)
                echo 2;
        }
        else if($eksekusi == 3)
        {
            echo 3;
        }
    }
    else if($_GET['jenis'] == 'hapus_kpi')
    {
        $eksekusi = $db->hapus_kpi($_GET['id_kpi'], 1);
        if($eksekusi == 1)
            echo 1;
        else 
            echo 2;
    }
    else if($_GET['jenis'] == 'verif_realisasi')
    {
        $eksekusi = $db->verif_realisasi($_GET['id'], $_GET['value']);
        if($eksekusi == 1)
        {
            if($_GET['value'] == 1)
                echo 1;
            else if($_GET['value'] == 0)
                echo 2;
        }
        else{
            echo 3;
        }
        
    }
    else if($_GET['jenis'] == 'verif_kompetensi')
    {
        $eksekusi = $db->verif_kompetensi($_GET['id'], $_GET['value']);
        if($eksekusi == 1)
        {
            if($_GET['value'] == 1)
                echo 1;
            else if($_GET['value'] == 0)
                echo 2;
        }
        else{
            echo 3;
        }
    }

?>
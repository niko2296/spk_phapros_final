<?php

    include "conn/database.php";
    $db = new database();

    $id = $_GET['id'];
    $value = $_GET['value'];
    $field = $_GET['field'];
    $query = $db->verifikasi_akses($id, $value, $field);
    if($query == 1)
    {   
        if($value == 1)
            echo 1;
        else if($value == 0)
            echo 2;
    }

?>
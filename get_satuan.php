<?php

    include "conn/database.php";
    $db = new database();

    $id_satuan = $_GET['id_satuan'];

    foreach($db->tampil_satuan() as $tampil)
    {
        if($id_satuan == $tampil['id_satuan'])
        {
            foreach(unserialize($tampil['jenis_polarisasi']) as $key => $value)
                $data1[] = $value;
        }
    }
    foreach ($db->tampil_polarisasi() as $tampil)
    {
        if(in_array($tampil['id_polarisasi'], $data1))
            $data[] = $tampil;
    }

    echo json_encode($data);

?>
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
        $eksekusi = $db->hapus_kpi($_GET['id_kpi'], $_GET['id_anggota'], $_GET['id_jabatan'], $_GET['id_departemen'], $_GET['id_unit'], $_GET['id_periode'], 1);
        if($eksekusi == 1)
            echo 1;
        else 
            echo 2;
    }
    else if($_GET['jenis'] == 'verif_realisasi')
    {
        $eksekusi = $db->verif_realisasi($_GET['id'], $_GET['value'], $_GET['id_anggota'], $_GET['id_jabatan'], $_GET['id_departemen'], $_GET['id_unit']);
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
        $eksekusi = $db->verif_kompetensi($_GET['id'], $_GET['value'], $_GET['verifikator'], $_GET['jabatan_verifikator'], $_GET['departemen_verifikator'], $_GET['unit_verifikator'], $_GET['id_anggota'], $_GET['id_jabatan'], $_GET['id_departemen'], $_GET['id_unit'], $_GET['jk']);
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
    else if($_GET['jenis'] == 'verif_matriks')
    {
        $eksekusi = $db->verif_kompetensi_matriks($_GET['id'], $_GET['value'], $_GET['verifikator'], $_GET['jabatan_verifikator'], $_GET['departemen_verifikator'], $_GET['unit_verifikator'], $_GET['id_anggota'], $_GET['id_jabatan'], $_GET['id_departemen'], $_GET['id_unit'], $_GET['jk']);
        if($eksekusi == 1)
        {
            if($_GET['value'] == 1)
                echo 1;
            else if($_GET['value'] == 0)
                echo 2;
        }
        else{
            echo 2;
        }
    }
    else if($_GET['jenis'] == 'cek_polarisasi')
    {
        $html = '
        <table class="table table-striped custom-table m-b-0">
            <thead>
                <tr>
                    <th>Batas Minimal</th>
                    <th>Batas Maksimal</th>
                    <th>Poin</th>
                </tr>
            </thead>
            <tbody>
        ';

        foreach($db->tampil_aturan_polarisasi() as $data)
        {
            if($_GET['id_polarisasi'] == $data['id_polarisasi'])
            {
                $html .=
                        '
                        <tr>
                            <td>'.$data['bmi'].'</td>
                            <td>'.$data['bma'].'</td>
                            <td>'.$data['poin'].'</td>
                        </tr>
                        ';
            }
        }
        $html .= '
            </tbody>
        </table>
        ';

        echo $html;
    }

?>
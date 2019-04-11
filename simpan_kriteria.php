<?php
    include "conn/database.php";
    $db = new database();

    $bmin = $_POST['bmin'];
    $bmax = $_POST['bmax'];
    $kriteria_nilai = $_POST['kriteria_nilai'];
    $keterangan = $_POST['keterangan'];
    $id_periode = $_POST['id_periode'];

    $eksekusi = $db->input_kriteria($bmin, $bmax, $kriteria_nilai, $keterangan, $id_periode);
    if($eksekusi == 1)
    {
        echo '
            <script>
                alert("Data Berhasil Tersimpan");
                window.location = "kriteria_nilai.php";
            </script>
        ';
    }
    else if($eksekusi == 2)
    {
        echo '
            <script>
                alert("Data Gagal Tersimpan");
                window.location = "kriteria_nilai.php";
            </script>
        ';
    }
    else
    {
        echo '
            <script>
                alert("'.$eksekusi.'");
                window.location = "kriteria_nilai.php";
            </script>
        ';
    }

?>
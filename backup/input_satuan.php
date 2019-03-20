<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Satuan</title>
</head>
<body>
    <?php
        if(isset($_POST['Simpan']))
        {
            include "conn/database.php";
            $db = new database();
            if($db->input_satuan($_POST['nama_satuan'], $_POST['jenis_polarisasi']) == 1)
                echo "Berhasil";
            else 
                echo "Gagal";
        }
    ?>

    <form action="" method="post">
    <table border="1">
        <tr>
            <td>Nama Satuan</td>
            <td>:</td>
            <td><input type="text" name="nama_satuan" id="nama_satuan"></td>
        </tr>
        <tr>
            <td>Jenis Polarisasi</td>
            <td>:</td>
            <td>
                <input type="checkbox" name="jenis_polarisasi[]" value="1"> Polarisasi Positif <br>
                <input type="checkbox" name="jenis_polarisasi[]" value="2"> Polarisasi Negatif <br>
                <input type="checkbox" name="jenis_polarisasi[]" value="3"> Polarisasi Absolute Positif/Project <br>
                <input type="checkbox" name="jenis_polarisasi[]" value="4"> Polarisasi Absolute Negatif <br>
                <input type="checkbox" name="jenis_polarisasi[]" value="5"> Polarisasi Waktu <br>
                <input type="checkbox" name="jenis_polarisasi[]" value="6"> Polarisasi Akurasi <br>
                <input type="checkbox" name="jenis_polarisasi[]" value="7"> Polarisasi Survey <br>
                <input type="checkbox" name="jenis_polarisasi[]" value="8"> Polarisasi Khusus <br>
            </td>
        </tr>
        <tr>
            <td colspan="3"><input type="submit" value="Simpan" name="Simpan"></td>
        </tr>
    </table>
    </form>
</body>
</html>
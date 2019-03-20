<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jabatan</title>
</head>
<body>

    <?php

        if(isset($_POST['Simpan']))
        {
            include "conn/database.php";
			$db = new database();
            if($db->input_jabatan($_POST['nama_jabatan']) == 1)
                echo "Berhasil";
            else 
                echo "Gagal";
        }

    ?>

    <form action="" method="post">
    <table border="1">
        <tr>
            <td>Nama Jabatan</td>
            <td>:</td>
            <td><input type="text" name="nama_jabatan" id="nama_jabatan"></td>
        </tr>
        <tr>
            <td colspan="3"><input type="submit" value="Simpan" name="Simpan"></td>
        </tr>
    </table>
    </form>
</body>
</html>
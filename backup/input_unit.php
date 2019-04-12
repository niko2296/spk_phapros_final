<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Unit</title>
</head>
<body>

    <?php
        if(isset($_POST['Simpan']))
        {
            include "conn/database.php";
			$db = new database();
            if($db->input_unit($_POST['nama_unit']) == 1)
                echo "Berhasil";
            else 
                echo "Gagal";
        }
    ?>

    <form action="" method="post">
    <table border="1">
        <tr>
            <td>Nama Unit</td>
            <td>:</td>
            <td><input type="text" name="nama_unit" id="nama_unit"></td>
        </tr>
        <tr>
            <td colspan="3"><input type="submit" value="Simpan" name="Simpan"></td>
        </tr>
    </table>
    </form>
</body>
</html>
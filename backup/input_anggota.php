<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Anggota</title>
</head>
<body>

    <?php
        include "conn/database.php";
		$db = new database();

        if(isset($_POST['Simpan']))
        {
            $nik = $_POST['nik'];
            $nama_anggota = $_POST['nama_anggota'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $tempat_lahir = $_POST['tempat_lahir'];
            $tanggal_lahir = date('Y-m-d', strtotime($_POST['tanggal_lahir']));
            $status = $_POST['status'];
            $golongan = $_POST['golongan'];
            $jabatan = $_POST['jabatan'];
            $unit = $_POST['unit'];
            $alamat = $_POST['alamat'];
            if($db->input_anggota($nik, $nama_anggota, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $status, $golongan, $jabatan, $unit, $alamat) == 1)
                echo "Berhasil";
            else 
                echo "Gagal";
        }
    ?>

    <form action="" method="post">
    <table border="1">
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td><input type="text" name="nik" id="nik"></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><input type="text" name="nama_anggota" id="nama_anggota"></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>
                <select name="jenis_kelamin" id="jenis_kelamin">
                    <option value="">Silahkan Pilih Kelamin</option>
                    <option value="1">Pria</option>
                    <option value="2">Wanita</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Tempat Lahir</td>
            <td>:</td>
            <td><input type="text" name="tempat_lahir" id="tempat_lahir"></td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td><input type="date" name="tanggal_lahir" id="tanggal_lahir"></td>
        </tr>
        <tr>
            <td>Status</td>
            <td>:</td>
            <td>
                <select name="status" id="status">
                    <option value="">Silahkan Pilih Status</option>
                    <option value="1">Belum Menikah</option>
                    <option value="2">Menikah</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Golongan</td>
            <td>:</td>
            <td>
                <select name="golongan" id="golongan">
                    <option value="">Silahkan Pilih Golongan</option>
                    <?php
                        foreach($db->tampil_golongan() as $data)
                        {
                    ?>
                            <option value="<?php echo $data['id_golongan']; ?>"><?php echo $data['nama_golongan']; ?></option>
                    <?php
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>
                <select name="jabatan" id="jabatan">
                    <option value="">Silih Pilih Jabatan</option>
                    <?php
                        foreach($db->tampil_jabatan() as $data)
                        {
                    ?>
                            <option value="<?php echo $data['id_jabatan']; ?>"><?php echo $data['nama_jabatan']; ?></option>
                    <?php
                        } 
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Departemen/Unit</td>
            <td>:</td>
            <td>
                <select name="unit" id="unit">
                    <option value="">Silahkan Pilih Departemen/Unit</option>
                    <?php
                        foreach($db->tampil_unit() as $data)
                        {
                    ?>
                            <option value="<?php echo $data['id_unit']; ?>"><?php echo $data['nama_unit']; ?></option>
                    <?php
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><textarea name="alamat" id="alamat" cols="23" rows="5"></textarea></td>
        </tr>
        <tr>
            <td colspan="3"><input type="submit" value="Simpan" name="Simpan"></td>
        </tr>
    </table>
    </form>
</body>
</html>
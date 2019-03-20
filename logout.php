<?php
    session_start();
    $_SESSION['login'] = FALSE;
    $_SESSION['aksus'] = FALSE;
    $_SESSION['id_anggota'] = null;
    $_SESSION['id_jabatan'] = null;
    $_SESSION['id_unit'] = null;
    session_destroy();
    header('location:login.php');
?>
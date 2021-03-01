<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<?php

$id     = $_SESSION['id_siswa']; 
$cek = mysqli_query($koneksi, "SELECT aktif FROM daftar WHERE id_daftar = {$id} AND aktif = 0");
$row = mysqli_fetch_assoc($cek); 


    if ($pg == '') {
        if(mysqli_num_rows($cek) > 0) {
            $url = "?pg=setup";
            echo "<script>
                window.location.href = '{$url}'
            </script>";
        }
        else {
            include "home.php";
        }
        
    } elseif ($pg == 'formulir') {

        include "mod_formulir/formulir.php";
    } elseif ($pg == 'detail') {
        include "mod_formulir/detail.php"; //Modul Detail Pendaftaran
    } elseif ($pg == 'bayar') {
        include "mod_bayar/bayar.php";
    } elseif ($pg == 'pengumuman') {
        include "mod_pengumuman/pengumuman.php";
    } 
    elseif($pg == 'setup') {
        include "mod_formulir/formulir_setup.php";
    }
    elseif ($pg == 'user') {
        include "mod_user/user.php";
    } elseif ($pg == 'setting') {
        include "mod_setting/setting.php";
    }

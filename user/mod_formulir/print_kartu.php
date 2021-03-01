<?php ob_start();
require "../../config/database.php";
require "../../config/function.php";
require "../../config/functions.crud.php";
include "../../assets/modules/phpqrcode/qrlib.php";
$id_siswa = dekripsi($_GET['id']);
$siswa = fetch($koneksi, 'daftar', ['id_daftar' => $id_siswa]);

$tempdir = "../../temp/"; //Nama folder tempat menyimpan file qrcode
if (!file_exists($tempdir)) //Buat folder bername temp
        mkdir($tempdir);

//isi qrcode jika di scan
$codeContents = $id_siswa . '-' . $siswa['nama'];

//simpan file kedalam temp
//nilai konfigurasi Frame di bawah 4 tidak direkomendasikan

QRcode::png($codeContents, $tempdir . $id_siswa . '.png', QR_ECLEVEL_L, 3, 6);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>PPDB SMK79 | <?= $siswa['nama']; ?></title>

    <!-- General CSS Files -->
	<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../assets/css/adminlte.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
</head>

<body>
	<strong>PANITIA PENERIMAAN PESERTA DIDIK BARU 2021/2022</strong><br>
    <h3><?= $setting['nama_sekolah'] ?></h3>
    <small> <?= $setting['alamat'] ?></small>
    <hr>
    <center>
        <h4><u>Kartu Peserta</u></h4>
        <p>No. Pendaftaran : <?= $siswa['no_daftar'] ?> </p>
    </center>

    <div class="table-responsiv">
        <table style="font-size: 12px" class="table table-striped table-bordered table-sm ">
            <tbody>
                
                <tr>
                    <td><b>NISN</b></td>
                    <td><?= $siswa['nisn'] ?></td>
                </tr>

                <tr>
                    <td><b>Nama Lengkap</b></td>
                    <td align="left"><?= $siswa['nama'] ?></td>
                </tr>
                <tr>
                    <td><b>Tempat Tgl Lahir</b></td>
                    <td align="left"><?= $siswa['tempat_lahir'] ?>, <?= date_short($siswa['tgl_lahir']) ?></td>
                </tr>
                <tr>
                    <td><b>Asal Sekolah</b></td>
                    <td align="left"><?= $siswa['asal_sekolah'] ?></td>
                </tr>

            </tbody>
        </table>

		<div class="info">
			<table>
				<tr>
					<td colspan="2">
						<p class="lead">Scan me:</p>
					</td>
				</tr>
				<tr>
					<td><img src="<?= $tempdir . $id_siswa . '.png' ?>" /></td>
					<td>
						<p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
							Harap disimpan untuk keperluan pendaftaran selama menjadi calon siswa/i SMK PGRI Telagasari Tahun Pelajaran 2021/2022.
						</p>
					</td>
				</tr>
			</table>	
		</div>
        
        <table style="font-size: 12px">
            <tbody>
                <!-- DATA LENGKAP WALI -->
                <tr>
                    <td align="center" colspan="2">Print Date : <?= date_full(date('Y-m-d H:is')) ?></td>
                </tr>

            </tbody>
        </table>

    </div>
</body>

</html>


<?php
$student = "Kartu_".$siswa['no_daftar'];

$html = ob_get_clean();
require_once '../../vendor/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("{$student}.pdf", array("Attachment" => false));

exit(0);
?>
<?php 

if ($nilai < 12) {
  $temp = " ". $huruf[$nilai];
} else if ($nilai <20) {
  $temp = penyebut($nilai - 10). " Belas";
} else if ($nilai < 100) {
  $temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
} else if ($nilai < 200) {
  $temp = " seratus" . penyebut($nilai - 100);
} else if ($nilai < 1000) {
  $temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
} else if ($nilai < 2000) {
  $temp = " seribu" . penyebut($nilai - 1000);
} else if ($nilai < 1000000) {
  $temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
} else if ($nilai < 1000000000) {
  $temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
} else if ($nilai < 1000000000000) {
  $temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
} else if ($nilai < 1000000000000000) {
  $temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
}
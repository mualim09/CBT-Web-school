<?php
include ('cek.php');
include ('../config/config.php');
include ('fungsi.php');
include ('pilihan.php');
$kods           =$_POST['ks1'];
$jumlah         =$_POST['jumlah1'];
$sisawaktu      =$_POST['sisawaktu'];
$mulaiujian     = $_POST['mulaiujian'];
$waktuselesai   = $_POST['waktuselesai'];
mysqli_query($mysqli, "update siswa set statuslogin='0'where nis='$username'");
$querydosen = mysqli_query ($mysqli, "SELECT * FROM ujian WHERE kodesoal='$kods'");
						if($querydosen == false){
						die ("Terjadi Kesalahan : ". mysqli_error($mysqli));
						}
						while ($ar = mysqli_fetch_array ($querydosen)){
						    date_default_timezone_set('Asia/Jakarta');
							$jam=date("h:i:sa");
							$tanggal=date("d-m-Y");
						$key=$ar['kunci'];
						$nilaipg=$ar['nilai'];
                        $score=0;
                        $benar=0;
                        $salah=0;
                        $kosong=0;
                    for ($i=0;$i<$jumlah;$i++){
                        
                    if($key[$i]==$answer[$i]){
                        //jika jawaban cocok (benar)
                        $benar++;
                    }else{
                        //jika salah
                        $salah++;
                    
                    }  
    
    
}
$score = $nilaipg/$jumlah*$benar;            
	if ($edit = mysqli_query($mysqli, "UPDATE jawaban SET jawabansiswa='$answer', kuncisoal='$key', benar='$jam', salah='$tanggal', nilai='$score', sisawaktu='$sisawaktu', mulaiujian='$mulaiujian', waktuselesai='$waktuselesai' WHERE nis='$username'")){
		header("Location:koreksi.php");
		exit();
	}
	die ("Terdapat kesalahan : ". mysqli_error($mysqli));

       } ?>
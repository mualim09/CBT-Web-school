<?php
include "configurasi/koneksi.php";
$sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM registrasi_siswa
                   WHERE email ='$_POST[email]'");
$ketemu = mysqli_num_rows($sql);
echo $ketemu;
?>

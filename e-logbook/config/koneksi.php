<?php
$server = "192.168.88.4";
$username = "root";
$password = "19K23O15P";
$database = "db_logbook";

mysql_connect($server,$username,$password) or die("Koneksi gagal ". mysql_error());
mysql_select_db($database) or die("Database tidak bisa dibuka ". mysql_error());
?>

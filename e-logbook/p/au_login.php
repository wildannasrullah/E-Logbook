<?php
error_reporting(0);
session_start();
include('../config/koneksi.php');

// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal ". mysql_error());
mysql_select_db($database) or die("Database tidak bisa dibuka ". mysql_error());

//jika session username belum dibuat, atau session username kosong
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
	//redirect ke halaman login
}

$username = $_POST['username'];
$password = $_POST['password'];

// query untuk mendapatkan record dari username
$query = "SELECT * FROM user WHERE username = '$username'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
// cek kesesuaian password
if ($password == $data['password'])
{
    // menyimpan username dan level ke dalam session
    $_SESSION['username'] = $data['username'];
    $_SESSION['level'] = $data['level'];
	$_SESSION['divisi'] = $data['divisi'];
if (isset($_SESSION['level']))
{
  
  if ($_SESSION['level'] == "admin")
   { 
	session_start();
	$_SESSION['username']    = $username;
    $_SESSION['password']    = $password;
	$username = $_SESSION['username'];
	
	header('location:page.php?p=dashboard');
   }
   else {	
	   header('location:page.php?p=dashboard');
	}	
	
}
elseif (!isset($_SESSION['level']))
{
  echo "<script>alert('The username or password you entered is incorrect.'); window.location = 'index.php'</script>";
}
}
else 
echo "<script>alert('The username or password you entered is incorrect.'); window.location = 'index.php'</script>";
?>
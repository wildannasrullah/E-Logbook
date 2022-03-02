<?php
error_reporting(0);
include('../../../../config/koneksi.php');
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/e-logbook-server/sql/sql.php";
include_once($path);

$p	=$_GET[p];  $act	=$_GET[act];

if ($p=='users' AND $act=='input'){
	inUser($_POST['fullname'], $_POST['username'], $_POST['password'], $_POST['department'], $_POST['field'], $_POST['level']);
}
if ($p=='users' AND $act=='update'){
	upUser($_POST['fullname'], $_POST['username'], $_POST['department'], $_POST['field'], $_POST['level'], $_POST['id']);
}
if ($p=='users' AND $act=='delete'){
	delUser($_GET['id']);
}
if ($p=='profile' AND $act=='update'){
	upProfile( $_POST[fullname], $_POST[username], $_POST[level], $_POST[id], $_POST[password_n], $_POST[password_c], $_POST[password_o]);
}
if ($p=='profile' AND $act=='uphoto'){
	
	$tipe_file      = $_FILES['photo']['type'];
	$nama_file      = $_FILES['photo']['name'];
	
		 unlink("photo/".$_POST['nm']);
		 mysql_query("UPDATE user SET photo = '$nama_file'
                             WHERE iduser   = '$_POST[id]'");
		move_uploaded_file($_FILES['photo']['tmp_name'], "photo/".$_FILES['photo']['name']);
		$link = "<script>
					window.location='../../../page.php?p=profile';</script>";
					echo $link;
	
}

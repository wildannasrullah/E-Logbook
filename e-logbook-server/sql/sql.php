<?php
error_reporting(0);
session_start();
include("../config/koneksi.php");

function showCategory(){
 $r = mysql_query("select *from mcategories order by idcat desc");
	while($co = mysql_fetch_array($r))
		$c[]=$co;
	return $c;
}
function showProblem(){
	$r = mysql_query("select *from tproblems tp LEFT JOIN mcategories mc ON tp.idcat=mc.idcat order by idprob desc");
	while($co = mysql_fetch_array($r))
		$c[]=$co;
	return $c;
}
function showProblemDetail($id){
	$r = mysql_query("select *from tproblems tp LEFT JOIN mcategories mc ON tp.idcat=mc.idcat where idprob = '$id' order by idprob desc");
	while($co = mysql_fetch_array($r))
		$c[]=$co;
	return $c;
}
function showLampiran($kode){
	$r = mysql_query("select *from tlampiran where idprob = '$kode' order by id_lampiran desc");
	while($co = mysql_fetch_array($r))
		$c[]=$co;
	return $c;
}
function showProblemLimit(){
	$r = mysql_query("select *from tproblems tp LEFT JOIN mcategories mc ON tp.idcat=mc.idcat order by idprob desc LIMIT 3");
	while($co = mysql_fetch_array($r))
		$c[]=$co;
	return $c;
}
function showUsers(){
	$r = mysql_query("SELECT * FROM user u left join tdepartment d on u.id_dep=d.id_dep
					  left join tfield f on u.id_field=f.id_field order by iduser desc");
	while($co = mysql_fetch_array($r))
		$c[]=$co;
	return $c;
}
function inUser($fullname, $username, $password, $department, $field, $level){
	mysql_query("INSERT INTO user VALUE('','$fullname','$username','$password','$department','$field','','$level' )");
	$link = "<script>alert('Save Success.');
	window.location='../../../page.php?p=users';</script>";
	echo $link;
}
function upUser($fullname, $username, $department, $field, $level, $idUser){
	mysql_query("UPDATE user SET fullname = '$fullname', username = '$username', id_dep = '$department', id_field = '$field', level = '$level'
				WHERE iduser  = '$idUser'");
	$link = "<script>alert('Update Success.');
	window.location='../../../page.php?p=users';</script>";
	echo $link;
}
function delUser($idUser){
	mysql_query("DELETE FROM user WHERE iduser = '$idUser'");
	$link = "<script>alert('Delete Success.');
	window.location='../../../page.php?p=users';</script>";
	echo $link;
}
function inCat($catname, $info){
	mysql_query("INSERT INTO mcategories VALUE('','$catname','$info')");
	$link = "<script>alert('Save Success.');
	window.location='../../../page.php?p=categories';</script>";
	echo $link;
}
function upCat($catname, $info, $idCat){
	mysql_query("UPDATE mcategories SET category_name = '$catname', category_ket = '$info'
				WHERE idcat  = '$idCat'");
	$link = "<script>alert('Update Success.');
	window.location='../../../page.php?p=categories';</script>";
	echo $link;
}
function delCat($idCat){
	mysql_query("DELETE FROM mcategories WHERE idcat = '$idCat'");
	$link = "<script>alert('Delete Success.');
	window.location='../../../page.php?p=categories';</script>";
	echo $link;
}
function upProfile($fullName, $userName, $level, $idUser, $password_n, $password_c, $password_o){
	$d = mysql_query("select *from user where username='$userName'");
	$y = mysql_fetch_array($d);
	
	if($y[level]=='admin'){
		
		if($password_o==''){
	mysql_query("UPDATE user SET 
								 fullname  	= '$fullName',
								 username	= '$userName',
								 level		= '$level'
								 WHERE iduser  = '$idUser'");
	$link = "<script>
					alert('Successfully to update profile, $fullName');
					window.location='../../../page.php?p=profile';</script>";
			echo $link;
}
else{
	if($password_o==$y[password]){
		if($password_n!='' AND $password_c!=''){
			if($password_n==$password_c){
				mysql_query("UPDATE user SET 
								 fullname  	= '$fullName',
								 username	= '$userName',
								 password	= '$password_n',
								 level		= '$level'
								 WHERE iduser  = '$idUser'");
				$link = "<script>
					alert('Successfully to update profile, $fullName');
					window.location='../../../page.php?p=profile';</script>";
				echo $link;
			}
			else{
				$link = "<script>
					alert('New Password and Confirm Password not match !!')
					window.location='../../../page.php?p=profile';</script>";
					echo $link;
			}
		}
		else{
			$link = "<script>
					alert('New Password and Confirm Password not fill !!')
					window.location='../../../page.php?p=profile';</script>";
					echo $link;
		}
	}else{
		$link = "<script>
					alert('Old Password not match !!')
					window.location='../../../page.php?p=profile';</script>";
					echo $link;
	}
}
		
	}else if($y[level]=='user'){
		
	if($password_o==''){
	mysql_query("UPDATE user SET 
								 fullname  	= '$fullName',
								 username	= '$userName',
								 level		= '$level'
								 WHERE iduser  = '$idUser'");
	$link = "<script>
					alert('Successfully to update profile, $fullName');
					window.location='../../../page.php?p=profile';</script>";
			echo $link;
}
else{
	
	if($password_o==$y[password]){
		if($password_n!='' AND $password_c!=''){
			if($password_n==$password_c){
				mysql_query("UPDATE user SET 
								 fullname  	= '$fullName',
								 username	= '$userName',
								 password	= '$password_n',
								 level		= '$level'
								 WHERE iduser  = '$idUser'");
				$link = "<script>
					alert('Successfully to update profile, $fullName');
					window.location='../../../page.php?p=profile';</script>";
				echo $link;
			}
			else{
				$link = "<script>
					alert('New Password and Confirm Password not match !!')
					window.location='../../../page.php?p=profile';</script>";
					echo $link;
			}
		}
		else{
				$link = "<script>
					alert('New Password and Confirm Password not fill !!')
					window.location='../../../page.php?p=profile';</script>";
					echo $link;
			}
		}else{
				$link = "<script>
					alert('Old Password not match !!')
					window.location='../../../page.php?p=profile';</script>";
					echo $link;
			}
		}

	}
}

?>
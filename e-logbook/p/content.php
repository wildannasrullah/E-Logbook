<?php
if ($_GET['p']=='dashboard'){
    include "modul/dashboard.php";
}
if ($_GET['p']=='new-post'){
    include "modul/actlog/lpost.php";
}
if ($_GET['p']=='users'){
    include "modul/master/users/user.php";
}
if ($_GET['p']=='profile'){
    include "modul/master/users/profile.php";
}
if ($_GET['p']=='categories'){
    include "modul/master/category/category.php";
}
if ($_GET['p']=='message'){
    include "modul/message/pesan.php";
}
if ($_GET['p']=='report'){
    include "modul/report/report.php";
}
if ($_GET['p']=='assign'){
    include "modul/911/911post.php";
}
if ($_GET['p']=='todolist'){
    include "modul/911/todolist.php";
}
?>
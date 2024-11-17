<?php
// echo "Testing file response_input";
// echo "<br>";
// echo "modul = ".$_GET['modul']."<br>";
// echo "fitur = ".$_GET['fitur']."<br>";
// echo "request method : ".$_SERVER['REQUEST_METHOD']."<br>";
// print_r($_POST);
// echo "<br>";
// echo "Nama Role : ".$_POST['role_name']."<br>";
// echo "Keterangan Role : ".$_POST['role_description']."<br>";
// echo "Status Role : ".$_POST['role_status']."<br>";

require_once 'domain_object/node_role.php';
$objRole = [];
$objRole[] = new Role(1,$_POST['role_name'],$_POST['role_description'],$_POST['role_status']);
include 'views/role_list.php';
?>
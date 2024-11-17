<?php
session_start();
// session_destroy();

require_once "models/model_role.php";
require_once "models/model_barang.php";


$obj_role = new modelRole();
$obj_barang = new modelBarang();

if (isset($_GET['modul'])) {
  $model = $_GET['modul'];
} else {
  $model = "dashboard";
}

switch($model) {
  case "dashboard":
    include 'views/kosong.php';
    break;
  case "role":

    $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    switch($fitur) {
      case 'add':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $name = $_POST['role_name'];
          $desc = $_POST['role_description'];
          $status = $_POST['role_status'];
          $obj_role->addRole($name, $desc, $status);
          header('location: index.php?modul=role');
        } else {
          include 'views/role_input.php';
        }
        break;
      case 'delete':
        $obj_role->deleteRole($id);
        header('location: index.php?modul=role');
        break;
      case 'update':
        $role = $obj_role->getRoleById($id);
        include 'views/role_edit.php';
        break;
      case 'edit':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $name = $_POST['role_name'];
          $desc = $_POST['role_description'];
          $status = $_POST['role_status'];
          $obj_role->updateRole($id,$name, $desc, $status);
          header('location: index.php?modul=role');
        } else {
          include 'views/role_list.php';
        }
        break;
      default:
        $roles = $obj_role->getAllRoles();
        include 'views/role_list.php';
        break;
    }
  case "barang":

    $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    switch($fitur) {
      case 'add':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $barangName = $_POST['barang_name'];
          $hargaBarang = $_POST['harga_barang'];
          $obj_barang->addBarang($barangName, $hargaBarang);
          header('location: index.php?modul=barang');
        } else {
          include 'views/barang_input.php';
        }
        break;
      case 'delete':
        $obj_barang->deleteBarang($id);
        header('location: index.php?modul=barang');
        break;
      case 'update':
        $barang = $obj_barang->getBarangById($id);
        include 'views/barang_edit.php';
        break;    
      case 'edit':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $barangName = $_POST['barang_name'];
          $hargaBarang = $_POST['harga_barang'];
          $obj_barang->updateBarang($id, $barangName, $hargaBarang);
          header('location: index.php?modul=barang');
        } else {
          include 'views/barang_list.php';
        }
      break;
      default:
        $barangs = $obj_barang->getAllBarangs();
        include 'views/barang_list.php';
        break;
    }
  case "transaksi":
    break;
}
?>
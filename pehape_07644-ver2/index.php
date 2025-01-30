<?php
session_start();
// session_destroy();

require_once "controllers/controller_role.php";
require_once "controllers/controller_user.php";
require_once "controllers/controller_transaksi.php";
require_once "models/model_barang.php";
// require_once "models/model_role.php";
// require_once "models/model_user.php";

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header('location: login.php');
  exit;
}

$objectRole = new controllerRole();
$objectUser = new controllerUser();
$objectTransaksi = new controllerTransaksi();
$obj_barang = new modelBarang();
// $obj_role = new modelRole();
// $obj_user = new modelUser();

if (isset($_GET['modul'])) {
  $model = $_GET['modul'];
} else {
  $model = "dashboard";
}

switch($model) {
  case "dashboard":
    include 'views/kosong.php';
    break;

  case "user":

    $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
    $userid = isset($_GET['idUser']) ? $_GET['idUser'] : null;
    
    switch($fitur) {
      case 'add':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $uname = $_POST['user_name'];
          $pass = $_POST['password'];
          $role_name = $_POST['role_name'];
          $objectUser->addUser($uname, $pass, $role_name, $name); 
        } else {
          $roles = $objectUser->getRoles(); 
          include 'views/user_input.php';
        }
        break;
      case 'delete':
        $objectUser->deleteUser($userid); 
        break;
      case 'update':
        $objectUser->editUser($userid);
        break;
      case 'edit':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $uname = $_POST['user_name'];
          $pass = $_POST['password'];
          $role_name = $_POST['role_name'];
          $objectUser->updateUser($userid, $uname, $pass, $role_name, $name);
        }
        break;
      default:
        $objectUser->listUsers();
    }
    break;

   
  // case "user":
  //   $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
  //   $userid = isset($_GET['idUser']) ? $_GET['idUser'] : null;
  //   switch($fitur) {
  //     case 'add':
  //       if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //         $uname = $_POST['user_name'];
  //         $pass = $_POST['password'];
  //         $role_name = $_POST['role_name'];
  //         $role = $obj_role->getRoleByName($role_name);
  //         $obj_user->addUser($uname, $pass, $role);
  //         header('location: index.php?modul=user');
  //       } else {
  //         $roles = $obj_role->getAllRoles();
  //         include 'views/user_input.php';
  //       }
  //       break;
  //     case 'delete':
  //       $userdel = $obj_user->getUserById($userid);
  //       $obj_user->deleteUser($userdel);
  //       header('location: index.php?modul=user');
  //       break;
  //     case 'update':
  //       $roles = $obj_role->getAllRoles();
  //       $user = $obj_user->getUserById($userid);
  //       include 'views/user_edit.php';
  //       break;
  //     case 'edit':
  //       if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //         $username = $_POST['user_name'];
  //         $password = $_POST['password'];
  //         $role_name = $_POST['role_name'];
  //         $role = $obj_role->getRoleByName($role_name);
  //         $obj_user->updateUser($userid,$username, $password, $role);
  //         header('location: index.php?modul=user');
  //       } else {
  //         $roles = $obj_role->getAllRoles();
  //         $user = $obj_user->getUserById($userid);
  //         include 'views/user_list.php';
  //       }
  //       break;
  //     default:
  //       $users = $obj_user->getUsers();
  //       include 'views/user_list.php';
  //   }
  //   break;

  // case "role":

  //   $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
  //   $id = isset($_GET['id']) ? $_GET['id'] : null;

  //   switch($fitur) {
  //     case 'add':
  //       if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //         $name = $_POST['role_name'];
  //         $desc = $_POST['role_description'];
  //         $status = $_POST['role_status'];
  //         $obj_role->addRole($name, $desc, $status);
  //         header('location: index.php?modul=role');
  //       } else {
  //         include 'views/role_input.php';
  //       }
  //       break;
  //     case 'delete':
  //       $obj_role->deleteRole($id);
  //       header('location: index.php?modul=role');
  //       break;
  //     case 'update';
  //       $role = $obj_role->getRoleById($id);
  //       include 'views/role_edit.php';
  //       break;
  //     case 'edit':
  //       if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //         $name = $_POST['role_name'];
  //         $desc = $_POST['role_description'];
  //         $status = $_POST['role_status'];
  //         $obj_role->updateRole($id,$name, $desc, $status);
  //         header('location: index.php?modul=role');
  //       } else {
  //         include 'views/role_list.php';
  //       }
  //       break;
  //     default:
  //       $roles = $obj_role->getAllRoles();
  //       include 'views/role_list.php';
  //       break;
  //   }
  //   break;

  case "role":

    $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    switch($fitur) {
      case 'add':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $name = $_POST['role_name'];
          $desc = $_POST['role_description'];
          $status = $_POST['role_status'];
          $objectRole->addRole($name, $desc, $status);
        } else {
          include 'views/role_input.php';
        }
        break;
      case 'delete':
        $objectRole->deleteRole($id);
        break;
      case 'update':
        $objectRole->editById($id);
        break;
      case 'edit':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $name = $_POST['role_name'];
          $desc = $_POST['role_description'];
          $status = $_POST['role_status'];
          $objectRole->updateRole($id, $name, $desc, $status);
        }
        break;
      default:
        $objectRole->listRoles();
        break;
    }
    break;

  case "barang":
    $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    switch($fitur) {
      case 'add':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $barangName = $_POST['barang_name'];
          $hargaBarang = $_POST['harga_barang'];
          $jumlahBarang = $_POST['jumlah_barang'];
          $obj_barang->addBarang($barangName, $hargaBarang, $jumlahBarang);
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
          $jumlahBarang = $_POST['jumlah_barang'];
          $obj_barang->updateBarang($id, $barangName, $hargaBarang, $jumlahBarang);
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
    break;

  case "transaksi":
    $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    switch($fitur) {
      case 'add':
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            $customer_name = $_POST['customer'];
            $Customer = $objectUser->getUserByName($customer_name);
            $Kasir = $objectUser->getUserById(1);
            echo $Customer->name."<br>";
            echo $Kasir->name."<br>";
            echo "<br>";
            // Asumsikan $_POST['barang'] dan $_POST['jumlah'] adalah array
            $barang = $_POST['barang'];
            $jumlah = $_POST['jumlah'];

            $obj_barangs = [];
            foreach ($barang as $key => $bar) {
//                        echo "Barang: " . $bar . ", Jumlah: " . $jumlah[$key] . "<br>";
                $obj_barangs[] = $obj_barang->getBarangById($bar);
            }
            $objectTransaksi->addTransaksi($obj_barangs,$jumlah,$Customer,$Kasir);
        } else {
//                    $listRoleName = $objectRole->getListRoleName();
            $barangs = $obj_barang->getAllBarangs();
            $customers = $objectUser->getUsers();
//                    foreach ($customers as $customer){
//                        echo $customer->name."<br>";
//                    }
            include 'views/transaksi_input.php';
        }
        break;
      default:
        $objectTransaksi->listTransaksi();
        break;
    }
    break;
}
?>
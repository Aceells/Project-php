<?php
// require_once('domain_object/node_role.php');
require_once 'model/role_model.php';
session_start();
// session_destroy();

// $objRole = [];
// $objRole[] = new Role(1,"Super Admin","Mengatur Admin",1);
// $objRole[] = new Role(2,"Admin","Mengatur Kasir",0);
// $objRole[] = new Role(3,"Kasir","Mengatur Uang", 1);
// $objRole[] = new Role(4,"Customer","Beli Barang",1);

// include('views/role_list.php');

if (isset($_GET['modul'])){
    $modul = $_GET['modul'];
}else{
    $modul = 'dashboard';
}

switch ($modul){
    case 'dashboard':
        include 'views/kosong.php';
    break;
    case 'role':
        $modelRole = new modelRole();
        if (isset($_GET['fitur'])){
            $fitur = $_GET['fitur'];
        }else{
            $fitur = null;
        }
        switch($fitur){
            case 'add':
                $role_name = $_POST['role_name'];
                $role_desc = $_POST['role_desc'];
                $role_status = $_POST['role_status'];
                $modelRole->addRole($role_name, $role_desc, $role_status);
                header('location:index.php?modul=role');
            break;
            case 'edit':
                if (isset($_GET['role_id'])) {
                    $role_id = $_GET['role_id'];
                    $role = $modelRole->getRoleById($role_id);
                    if ($role) {
                        include 'views/role_update.php';
                    } else {
                        header('location:index.php?modul=role');
                    }
                }
            break;
            case 'update':
                if (isset($_POST['role_id'])) {
                    $role_id = $_POST['role_id'];
                    $role_name = $_POST['role_name'];
                    $role_desc = $_POST['role_desc'];
                    $role_status = $_POST['role_status'];
                    $modelRole->updateRole($role_id, $role_name, $role_desc, $role_status);
                    header('location:index.php?modul=role');
                }
            break;
            case 'delete':
                if (isset($_GET['role_id'])) {
                    $role_id = $_GET['role_id']; 
                    $modelRole->deleteRole($role_id);
                }
            break;
            default:
                $obj_Role = $modelRole->getAllRoles();
                include 'views/role_list.php';
            break;
        }
}
?>
<?php
require_once 'models/model_user.php';
require_once 'models/model_role.php';

class controllerUser {
    private $modelUser;
    private $modelRole;

    public function __construct() {
        $this->modelUser = new modelUser();
        $this->modelRole = new modelRole();
    }

    public function listUsers() {
        $users = $this->modelUser->getUsers();
        include 'views/user_list.php';
    }

    public function addUser($username, $password, $role_name, $name) {
        $role = $this->modelRole->getRoleByName($role_name);
        $this->modelUser->addUser($username, $password, $role, $name);
        header('location: index.php?modul=user');
    }

    public function getUsers(){
        return $this->modelUser->getAllUsers();
    }

    public function getUserById($userid) {
        return $this->modelUser->getUserById($userid);
    }

    public function getRoles() {
        return $this->modelRole->getAllRoles();
    }

    public function getUserByName($name){
        return $this->modelUser->getUserByName($name);
    }

    public function editUser($userid) {
        $user = $this->modelUser->getUserById($userid); 
        if ($user) {
            $roles = $this->modelRole->getAllRoles(); 
            include 'views/user_edit.php'; 
        }
    }

    public function updateUser($userid, $username, $password, $role_name, $name) {
        $role = $this->modelRole->getRoleByName($role_name);
        $this->modelUser->updateUser($userid, $username, $password, $role, $name);
        header('location: index.php?modul=user');
    }

    public function deleteUser($userid) {
        $user = $this->modelUser->getUserById($userid);
        $this->modelUser->deleteUser($user);
        header('location: index.php?modul=user');
    }
}
?>

<?php
require_once 'nodes/node_user.php';
require_once 'nodes/node_role.php';

class modelUser {
    private $users = [];
    private $nextId = 1;

    public function __construct() {
        if (isset($_SESSION['users'])) {
            $this->users = unserialize($_SESSION['users']);
            $this->nextId = count($this->users) + 1;
        } else {
            $this->initializeDefaultUsers();
        }
    }

    public function addUser($uname, $pass, $role, $name) {
        $user = new \User($this->nextId++, $uname, $pass, $role, $name);
        $this->users[] = $user;
        $this->saveToSession();
    }

    private function saveToSession() {
        $_SESSION['users'] = serialize($this->users);
    }

    public function getAllUsers(){
        return $this->users;
    }

    public function getUsers() {
        return $this->users;
    }

    private function initializeDefaultUsers() {
        $obj_role1 = new \Role(1, "Admin", "Administration", 1);
        $obj_role2 = new \Role(2, "Kasir", "Kasir", 1);
        $this->addUser('Acel', '666', $obj_role1, 'anu');
        $this->addUser('Chax', '666', $obj_role1, 'babi');
        $this->addUser('Merikh', '666', $obj_role2, 'haram');
    }

    public function getUserById($userid) {
        foreach ($this->users as $user) {
            if ($user->user_id == $userid) {
                return $user;
            }
        }
        return null;
    }

    public function getUserByName($name) {
        foreach ($this->users as $user) {
            if ($user->name == $name) {
                return $user;
            }
        }
        return null;
    }

    public function updateUser($userid, $username, $password, $role, $name) {
        $userlokal = $this->getUserById($userid);
        if ($userlokal != null) {
            $userlokal->username = $username;
            $userlokal->password = $password;
            $userlokal->role = $role;
            $userlokal->name = $name;
            $this->saveToSession();
            return true;
        }
        return false;
    }

    public function deleteUser($user) {
        if ($user != null) {
            $key = array_search($user, $this->users);
            unset($this->users[$key]);
            $this->users = array_values($this->users);
            $this->saveToSession();
            return true;
        }
        return false;
    }

}

// session_start();
// // session_destroy();
// // Testing Input dan Output
// $obj_user = new modelUser();
// $users = $obj_user->getUsers();
// // print_r($users);
// foreach ($users as $user) {
//     echo "Username: ".$user->username."<br/>";
//     echo "Password: ".$user->password."<br/>";
//     echo "Role Name: ".$user->role->role_name."<br/>";
// }

// echo "-----------------------------------"."<br>";
// echo "Testing Delete User by ID"."<br>";
// // Search
// // $userlokal = $obj_user->getUserById(3); 
// // print_r($userlokal);
// $userlokal = $obj_user->getUserById(1);
// // Delete
// // $obj_user->deleteUser($userlokal);
// // foreach ($users as $user) {
// //     echo "Username: ".$user->username."<br/>";
// //     echo "Password: ".$user->password."<br/>";
// //     echo "Role Name: ".$user->role->role_name."<br/>";
// // }
// $obj_role1 = new \Role(1, "Admin", "Administration", 1);
// $obj_user->updateUser(2, "Lisbea@gmail.com", 666, $obj_role1);
// foreach ($users as $user) {
//     echo "Username: ".$user->username."<br/>";
//     echo "Password: ".$user->password."<br/>";
//     echo "Role Name: ".$user->role->role_name."<br/>";
// }
?>
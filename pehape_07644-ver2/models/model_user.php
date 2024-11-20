<?php
require_once '../nodes/node_user.php';
require_once '../nodes/node_role.php';

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

    public function addUser($uname, $pass, $role) {
        $user = new \User($this->nextId++, $uname, $pass, $role);
        $this->users[] = $user;
        $this->saveToSession();
    }

    private function saveToSession() {
        $_SESSION['users'] = serialize($this->users);
    }

    public function getUsers() {
        return $this->users;
    }

    private function initializeDefaultUsers() {
        $obj_role1 = new \Role(1, "Admin", "Administration", 1);
        $obj_role2 = new \Role(2, "Kasir", "Kasir", 1);
        $this->addUser('Acel@gmail.com', '666', $obj_role1);
        $this->addUser('Tata@gmail.com', '666', $obj_role1);
        $this->addUser('Orel@gmail.com', '666', $obj_role2);
    }
}

// Testing Input dan Output
$obj_user = new modelUser();
$users = $obj_user->getUsers();
// print_r($users);
foreach ($users as $user) {
    echo "Username: ".$user->username."<br/>";
    echo "Password: ".$user->password."<br/>";
    echo "Role Name: ".$user->role->role_name."<br/>";
}
?>
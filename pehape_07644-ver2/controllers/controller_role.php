<?php
require_once 'models/model_role.php';

class controllerRole {
    private $modelRole;

    public function __construct() {
        $this->modelRole = new modelRole();
    }

    public function listRoles() {
        $roles = $this->modelRole->getAllRoles();
        include 'views/role_list.php';
    }

    public function addRole($role_name, $role_description, $role_status) {
        $this->modelRole->addRole($role_name, $role_description, $role_status);
        header('location: index.php?modul=role');
    }

    public function editById($role_id) {
        $role = $this->modelRole->getRoleById($role_id);
        include 'views/role_edit.php';
    }

    public function updateRole($id, $role_name, $role_desc, $role_status) {
        $this->modelRole->updateRole($id, $role_name, $role_desc, $role_status);
        header('location: index.php?modul=role');
    }

    public function deleteRole($id) {
        $cek = $this->modelRole->deleteRole($id);
        if ($cek == false) {
            throw new Exception('Ga ono coy');
        } else {
            header('location: index.php?modul=role');
        }
    }

    public function getListRoleName() {
        $listRoleName = [];
        foreach ($this->modelRole->getAllRoles() as $role) {
            $listRoleName[] = $role->role_name;
        }
        return $listRoleName;
    }

    public function getRoleByName($role_name) {
        return $this->modelRole->getRoleByName($role_name);
    }

}

?>
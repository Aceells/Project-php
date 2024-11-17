<?php
class Role{
    public $role_id;
    public $role_name;
    public $role_desc;
    public $role_status;

    public function __construct($role_id, $role_name, $role_desc, $role_status){
        $this->role_name = $role_name;
        $this->role_id = $role_id;
        $this->role_desc = $role_desc;
        $this->role_status = $role_status;
    }
}
?>
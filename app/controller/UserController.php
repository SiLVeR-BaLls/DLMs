<?php
include 'app/model/user.php';
class UserController {

    public $data;
    public $model;

    public function __construct($data){
        $this->data = $data;
        $this->model = new user();
    }

    public function sign_up(){
        $this->model->sign_up();
    }
}
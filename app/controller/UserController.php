<?php

class UserController {

public $data;

    public function __construct($data){
        $this->data = $data;
    }

    public function test(){
        return $this->data;
    }
}
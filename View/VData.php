<?php

class VData{

    static function sendData($data){
        echo json_encode($data);
    }

    static function getEmail(){
        return $_POST['email'];
    }
    static function getPassword(){
        return $_POST['password'];
    }
}
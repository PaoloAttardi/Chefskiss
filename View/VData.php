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

    static function getNome(){
        return $_POST['nome'];
    }
    static function getCognome(){
        return $_POST['cognome'];
    }

    static function getTitoloRicetta(){
        return $_POST['title'];
    }

    static function getProcedimentoRicetta(){
        return $_POST['content'];
    }

    static function getIngredientiRicetta(){
        return $_POST['ingredients'];
    }

    static function getCategoriaRicetta(){
        return $_POST['recipe-type'];
    }

    static function getDosiRicetta(){
        return $_POST['servings'];
    }

    static function getRecensione(){
        return $_POST['recensione'];
    }

    static function getValutazione(){
        return $_POST['valutazione'];
    }

    static function getCommento(){
        return $_POST['commento'];
    }
}
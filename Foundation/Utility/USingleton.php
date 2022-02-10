<?php


final class USingleton
{

    private static $instances = array();

    private function __construct(){}

    public static function getInstance(string $class_name){

        if(!class_exists($class_name))
        {
            trigger_error("La classe ".$class_name." non esiste", E_USER_ERROR);
        }

        $class_name = strtolower($class_name);
        if (!array_key_exists($class_name, self::$instances)){
            self::$instances[$class_name] = new $class_name;
        }

        return self::$instances[$class_name];
    }

    public static function stopInstance(string $class_name){

        if(!class_exists($class_name))
        {
            trigger_error("La classe ".$class_name." non esiste", E_USER_ERROR);
        }

        $class_name = strtolower($class_name);
        if (!array_key_exists($class_name, self::$instances)){
            self::$instances[$class_name] = null;
        }

        return self::$instances[$class_name];
    }
}
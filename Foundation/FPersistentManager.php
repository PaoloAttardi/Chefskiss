<?php


class FPersistentManager extends Fdb
{

    public static function insert($object){
        $db = parent::getInstance();
        $db->insertDB($object);
    }

    public static function update($field, $newvalue, $pk, $val,$Eclass){
        $db = parent::getInstance();
        return $db->updateDB($Eclass, $field, $newvalue, $pk, $val);
    }

    public static function delete($field, $val, $Eclass){
        $db = parent::getInstance();
        $db->deleteDB($Eclass, $field, $val);
    }

    public static function exist($field, $val, $Eclass){
        $db = parent::getInstance();
        $ris = $db->existDB($Eclass, $field, $val);
        return $ris;
    }

    public static function search($EClass, $parametri=array(), $ordinamento='', $offset='', $limite='', $like=''){
        $db = parent::getInstance();
        $result = $db->searchDB($EClass, $parametri, $ordinamento, $offset, $limite, $like);
        return $result;
    }

    public static function insertMedia($object, $filename){
        $db = parent::getInstance();
        $db->storeMedia($object, $filename);
    }

    public static function loadDefCol($class, $coloumns, $order='', $limit=''){
        $ris = $class::loadDefCol($coloumns, $order, $limit);
        return $ris;
    }

}
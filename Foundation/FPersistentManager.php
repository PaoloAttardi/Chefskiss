<?php


class FPersistentManager
{

    public static function insert($object){
        $EClass = get_class($object);
        $FClass = str_replace('E', 'F', $EClass);
        $FClass::insert($object);
    }

    public static function load($Fclass, $parametri = array(), $ordinamento = '', $limite = '') {
        $ris = $Fclass::loadByField($parametri, $ordinamento, $limite);
        return $ris;
    }

    public static function loadLogin($user, $pass){
        $ris = FPersona::loadLogin($user, $pass);
        return $ris;
    }

    public static function update($field, $newvalue, $pk, $val,$Fclass){
        return $Fclass::update($field, $newvalue, $pk, $val);
    }

    public static function delete($field, $val, $Fclass){
        $Fclass::delete($field, $val);
    }

    public static function exist($field, $val, $Fclass){
        $ris = $Fclass::exist($field, $val);
        return $ris;
    }

    public static function search($Fclass, $parametri=array(), $ordinamento='', $limite=''){
        $result = $Fclass::search($parametri, $ordinamento, $limite);
        return $result;
    }

    public static function filterByCategoria($class, $categoria){
        $ris = null;
        if ($class == 'FRicetta' || $class == 'FPost'){
            $ris = $class::filterByCategoria($categoria);
        } else echo "Metodo non supportato";
        return $ris;
    }

    public static function getRows($class, $parametri = array(), $ordinamento = '', $limite = ''){
        $ris = $class::getRows($parametri, $ordinamento, $limite);
        return $ris;
    }

    public static function insertMedia($object, $filename){
        $EClass = get_class($object);
        $FClass = str_replace('E', 'F', $EClass);
        $FClass::insert($object, $filename);
    }

    public static function loadDefCol($class, $coloumns, $order='', $limit=''){
        $ris = $class::loadDefCol($coloumns, $order, $limit);
        return $ris;
    }

}
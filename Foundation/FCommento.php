<?php

class FCommento extends Fdb{

    private static $entity = 'ECommento';

    private static $alias= 'commento';

    private static $class = 'FCommento';

    private static $values = 'idCommento';

    public function __construct(){
    }

    /**
     * @return string
     */
    public static function getEntity(): string
    {
        return self::$entity;
    }


    /**
     * @return string
     */
    public static function getAlias(): string
    {
        return self::$alias;
    }


    /**
     * @return string
     */
    public static function getClass(): string
    {
        return self::$class;
    }

    /**
     * @return string
     */
    public static function getValues(): string
    {
        return self::$values;
    }


    public static function insert($object){
        $db = parent::getInstance();
        $id = $db->insertDb( $object);
        $object->setId($id);
        return $id;
    }

    public static function loadByField($parametri = array(), $ordinamento = '', $limite = ''){
        $db = parent::getInstance();
        $result = $db->searchDb(static::getClass(), $parametri, $ordinamento, $limite);
        return $result;
    }

    public static function update($field, $newvalue, $pk, $val){
        $db = parent::getInstance();
        $result = $db->updateDB(self::getClass(), $field, $newvalue, $pk, $val);
        if ($result) return true;
        else return false;
    }

    public static function delete($field, $id){
        $db = parent::getInstance();
        $result = $db->deleteDB(self::getClass(), $field, $id);
        if ($result) return true;
        else return false;
    }

    public static function exist($field, $id){
        $db = parent::getInstance();
        $result = $db->existDB(self::getClass(), $field, $id);
        if ($result != null) return true;
        else return false;
    }

    public static function search($parametri=array(), $ordinamento='', $limite=''){
        $db = parent::getInstance();
        $result = $db->searchDb(self::$class, $parametri, $ordinamento, $limite);
        return $result;
    }

    public static function getRows($parametri = array(), $ordinamento = '', $limite = ''){
        $db = parent::getInstance();
        $result = $db->getRowNum(self::$class, $parametri, $ordinamento, $limite);
        return $result;
    }

    public static function loadDefCol($coloumns, $ordinamento='', $limite=''){
        $db = parent::getInstance();
        $result = $db->loadDefColDb(self::$class, $coloumns, $ordinamento, $limite);
        return $result;
    }

}


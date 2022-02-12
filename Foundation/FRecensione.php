<?php

class FRecensione extends Fdb{

    private static $entity = 'ERecensione';

    private static $alias= 'recensione';

    private static $class = 'FRecensione';

    private static $values = 'idRecensione';

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
        echo '';
        return self::$values;
    }


    public static function insert($object){
        $db = parent::getInstance();
        $id = $db->insertDb( $object);
        $object->setId($id);
    }

    public static function loadByField($parametri = array(), $ordinamento = '', $limite = ''){
        $db = parent::getInstance();
        $result = $db->searchDb(static::getClass(), $parametri, $ordinamento, $limite);
        return $result;
    }

    public static function update($field, $newvalue, $primkey, $val){
        $db = parent::getInstance();
        $result = $db->updateDB(self::getClass(), $field, $newvalue, $primkey, $val);
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

    public static function search($parametri=array(), $ordinamento='', $offset='', $limite=''){
        $db = parent::getInstance();
        $result = $db->searchDb(self::$class, $parametri, $ordinamento, $offset, $limite);
        return $result;
    }

    public static function loadDefCol($coloumns, $ordinamento='', $limite=''){
        $db = parent::getInstance();
        $result = $db->loadDefColDb(self::$class, $coloumns, $ordinamento, $limite);
        return $result;
    }
}

?>

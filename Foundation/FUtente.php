<?php

//require 'Fdb.php';
//require 'Utility/USingleton.php';

class FUtente extends Fdb{

    private static $entity = '../Entity/EUser';

    private static $alias= 'user';

    private static $class = 'FUtente';

    private static $values = '(:ban, :dataFineBan, :idModeratore, :idUser)';

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
    }

    public static function loadById( $ordinamento = '', $limite = ''){
        $utente = null;
        $db = parent::getInstance();
        $result = $db->searchDb(static::getClass(), 'idUser', $ordinamento, $limite);
        $rows_number = $db->getRowNum(static::getClass());
        if(($result != null) && ($rows_number == 1)) {
            $utente = new EUtente($result['ban'], $result['dataFineBan'],$result['idModeratore'],$result['name'],$result['surname'],$result['idImmagine'],$result['password'],$result['description'],$result['email']);
            $utente->setId($result['idUser']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $utente = array();
                for($i = 0; $i < count($result); $i++){
                    $utente[] = new EUtente($result[$i]['ban'], $result[$i]['dataFineBan'],$result[$i]['idModeratore'],$result[$i]['name'],$result[$i]['surname'],$result[$i]['idImmagine'],$result[$i]['password'],$result[$i]['description'],$result[$i]['email']);
                    $utente[$i]->setId($result[$i]['idUser']);
                }
            }
        }
        return $utente;
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

}
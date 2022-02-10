<?php

class FRicetta extends Fdb {

    private static $entity = 'ERicetta';

    private static $alias= 'ricetta';

    private static $class = 'FRicetta';

    private static $values = 'idRicetta';

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

    public static function getValutazioneRicetta($ricetta){
        $id_ricetta = $ricetta->getId();
        $valutazione = 0;
        $pm = USingleton::getInstance('FPersistentManager');
        $recensione = $pm::load('FRecensione', array(['idRicetta', '=', $id_ricetta]));
        if($recensione != null){
            if(is_array($recensione)){
                for($i = 0; $i < sizeof($recensione); $i++){
                    if($recensione[$i]->getValutazione() != 0){
                        $voti[] = $recensione[$i]->getValutazione();
                    }
                }
                $valutazione = array_sum($voti)/sizeof($voti);
                $ricetta->setValutazione((int)$valutazione);
            }
            else {
                $valutazione = $recensione->getValutazione();
                $ricetta->setValutazione((int)$recensione->getValutazione());
            }
        }
        else {
            $valutazione = 0;
            $ricetta->setValutazione($valutazione);
        }
        return $valutazione;
    }

    public static function loadDefCol($coloumns, $ordinamento='', $limite=''){
        $db = parent::getInstance();
        $result = $db->loadDefColDb(self::$class, $coloumns, $ordinamento, $limite);
        return $result;
    }
}
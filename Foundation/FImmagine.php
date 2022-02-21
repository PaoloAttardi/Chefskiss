<?php

class FImmagine extends Fdb{
    private static $entity = 'EImmagine';

    private static $alias= 'immagine';

    private static $class = 'FImmagine';

    private static $values = 'idImmagine';

    public function __construct(){}

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

        /**
     * @param PDOStatement $stmt
     * @param EImmagine $immagine
     */
    public static function bind($stmt, EImmagine $immagine, $nome_file){
        $path = $_FILES[$nome_file]['tmp_name'];
        $file = fopen($path, 'rb') or die ("Attenzione! Impossibile da aprire!");
        $stmt->bindValue(':idImmagine', $immagine->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':nome', $immagine->getNome(), PDO::PARAM_STR);
        $stmt->bindValue(':dimensione', $immagine->getDimensione(), PDO::PARAM_STR);
        $stmt->bindValue(':tipo', $immagine->getTipo(), PDO::PARAM_STR);
        $stmt->bindValue(':immagine', fread($file, filesize($path)), PDO::PARAM_LOB);
        unset($file);
        unlink($path);
    }

    public static function insert($object, $nome_file){
        $db = parent::getInstance();
        $id = $db->storeMedia(self::$class, $object, $nome_file);
        $object->setId($id);
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

    public static function search($parametri=array(), $ordinamento='', $offset='', $limite='', $like=''){
        $db = parent::getInstance();
        $result = $db->searchDb(self::$class, $parametri, $ordinamento, $offset, $limite, $like);
        return $result;
    }

    public static function loadDefCol($coloumns, $ordinamento='', $limite=''){
        $db = parent::getInstance();
        $result = $db->loadDefColDb(self::$class, $coloumns, $ordinamento, $limite);
        return $result;
    }
}

?>
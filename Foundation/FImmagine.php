<?php

class FImmagine extends Fdb{
    private static $table = 'immagini';

    private static $class = 'FImmagine';

    private static $values = '(:nome, :dimensione, :tipo, :immagine, :id)';

    public function __construct(){}

    /**
     * @return string
     */
    public static function getTable(): string
    {
        return self::$table;
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
        $stmt->bindValue(':id', $immagine->getId(), PDO::PARAM_INT);
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

    public static function loadByField($parametri = array(), $ordinamento = '', $limite = ''){
        $immagine = null;
        $db = parent::getInstance();
        $result = $db->searchDb(static::getClass(), $parametri, $ordinamento, $limite);
        if (count($parametri) > 0) {
            $rows_number = $db->getRowNum(static::getClass(), $parametri);
        } else {
            $rows_number = $db->getRowNum(static::getClass());
        }
        if(($result != null) && ($rows_number == 1)) {
            $immagine = new EImmagine($result['id'], $result['nome'], $result['dimensione'], $result['tipo'], base64_encode($result['immagine']));
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $immagine = array();
                for($i = 0; $i < sizeof($result); $i++){
                    $immagine = new EImmagine($result[$i]['id'], $result[$i]['nome'], $result[$i]['dimensione'], $result[$i]['tipo'], base64_encode($result[$i]['immagine']));
                }
            }
        }
        return $immagine;
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

?>
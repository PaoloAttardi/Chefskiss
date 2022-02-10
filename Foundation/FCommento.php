<?php

class FCommento extends Fdb{

    private static $table = 'commento';

    private static $class = 'FCommento';

    private static $values = '(:id_post, :autore, :testo, :data)';

    public function __construct(){
    }

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
     * @param ECommento $comment
     */
    public static function bind($stmt, ECommento $comment){
        //$stmt->bindValue(':id', $comment->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':id_post', $comment->getId_post(), PDO::PARAM_INT);
        $stmt->bindValue(':autore', $comment->getAutore(), PDO::PARAM_INT);
        $stmt->bindValue(':testo', $comment->getTesto(), PDO::PARAM_STR);
        $stmt->bindValue(':data', $comment->getData(), PDO::PARAM_STR);
    }

    public static function insert($object){
        $db = parent::getInstance();
        $id = $db->insertDb(self::$class, $object);
        $object->setId($id);
        return $id;
    }

    public static function loadByField($field, $val, $criterio){
        $comment = null;
        $db = parent::getInstance();
        $result = $db->searchDb(static::getClass(), $field, $val, $criterio);
        $rows_number = $db->getRowNum(static::getClass(), $field, $val);
        if(($result != null) && ($rows_number == 1)) {
            $comment = new ECommento($result['id_post'], $result['autore'], $result['testo'], $result['data']);
            $comment->setId($result['id']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $comment = array();
                for($i = 0; $i < count($result); $i++){
                    $comment[] = new ECommento($result[$i]['id_post'], $result[$i]['autore'], $result[$i]['testo'], $result[$i]['data']);
                    $comment[$i]->setId($result[$i]['id']);
                }
            }
        }
        return $comment;
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
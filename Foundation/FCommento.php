<?php

class FCommento extends Fdb{

    private static $entity = '../Entity/ECommento';

    private static $alias= 'commento';

    private static $class = 'FCommento';

    private static $values = '(:idCommento, :idAutore, :testo, :idPost, :data, :upVote)';

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

    /**
     * @param PDOStatement $stmt
     * @param ECommento $comment
     */
    public static function bind($stmt, ECommento $comment){
        $stmt->bindValue(':idCommento', $comment->getIdCommento(), PDO::PARAM_INT);
        $stmt->bindValue(':idAutore', $comment->getAutore(), PDO::PARAM_INT);
        $stmt->bindValue(':testo', $comment->getTesto(), PDO::PARAM_STR);
        $stmt->bindValue(':idPost', $comment->getIdPost(), PDO::PARAM_INT);
        $stmt->bindValue(':data', $comment->getData(), PDO::PARAM_STR);
        $stmt->bindValue(':upVote', $comment->getUpVote(), PDO::PARAM_BOOL);

    }

    public static function insert($object){
        $db = parent::getInstance();
        $id = $db->insertDb( $object);
        $object->setId($id);
        return $id;
    }

    public static function loadByField($field, $val, $criterio){
        $comment = null;
        $db = parent::getInstance();
        $result = $db->searchDb(static::getClass(), $field, $val, $criterio);
        $rows_number = $db->getRowNum(static::getClass(), $field, $val);
        if(($result != null) && ($rows_number == 1)) {
            $comment = new ECommento($result['idPost'],$result['idAutore'],$result['testo'], $result['data'],$result['upVote']);
            $comment->setIdCommento($result['idCommento']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $comment = array();
                for($i = 0; $i < count($result); $i++){
                    $comment[] = new ECommento($result[$i]['idPost'],$result[$i]['idAutore'],$result[$i]['testo'], $result[$i]['data'],$result[$i]['upVote']);
                    $comment[$i]->setIdCommento($result[$i]['idCommento']);
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


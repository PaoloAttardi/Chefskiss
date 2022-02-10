<?php

class FRecensione extends Fdb{
    private static $table = 'recensione';

    private static $class = 'FRecensione';

    private static $values = '(:commento, :valutazione, :id, :id_ricetta, :data, :autore)';

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
        echo '';
        return self::$values;
    }



    /**
     * @param PDOStatement $stmt
     * @param Erecensione $recensione
     */
    public static function bind($stmt, ERecensione $recensione){
        $stmt->bindValue(':commento', $recensione->getCommento(),PDO::PARAM_STR);
        $stmt->bindValue(':valutazione', $recensione->getValutazione(), PDO::PARAM_INT);
        $stmt->bindValue(':id', $recensione->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':id_ricetta', $recensione->getId_ricetta(), PDO::PARAM_INT);
        $stmt->bindValue(':data', $recensione->getData_pubblicazione(), PDO::PARAM_STR);
        $stmt->bindValue(':autore', $recensione->getAutore(), PDO::PARAM_INT);

    }

    public static function insert($object){
        $db = parent::getInstance();
        $id = $db->insertDb(self::$class, $object);
        $object->setId($id);
    }

    public static function loadByField($parametri = array(), $ordinamento = '', $limite = ''){
        $recensione = null;
        $db = parent::getInstance();
        $result = $db->searchDb(static::getClass(), $parametri, $ordinamento, $limite);
        //var_dump($result);
        if (sizeof($parametri) > 0) {
            $rows_number = $db->getRowNum(static::getClass(), $parametri);
        } else {
            $rows_number = $db->getRowNum(static::getClass());
        }
        if(($result != null) && ($rows_number == 1)) {
            $recensione = new ERecensione($result['commento'], $result['valutazione'], $result['id_ricetta'], $result['data'], $result['autore']);
            $recensione->setId($result['id']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $recensione = array();
                for($i = 0; $i < sizeof($result); $i++){
                    $recensione[$i] = new ERecensione($result[$i]['commento'], $result[$i]['valutazione'], $result[$i]['id_ricetta'], $result[$i]['data'], $result[$i]['autore']);
                    $recensione[$i]->setId($result[$i]['id']);
                }
            }
        }
        return $recensione;
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

    public static function filterByid($id){
        $db = parent::getInstance();
        $recensioniFiltrate = $db->searchDb(self::$class, array(['id', '=', $id]));
        return $recensioniFiltrate;
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

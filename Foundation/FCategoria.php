<?php 

class FCategoria extends Fdb{


    private static $entity = '../Entity/ECategoria';

    private static $alias= 'categoria';

    private static $class = 'FCategoria';

    private static $values = '(:idCategoria, :categoria, :idImmagine)';

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

    public static function loadByField($parametri = array(), $ordinamento = '', $limite = ''){
        $categoria = null;
        $db = parent::getInstance();
        $result = $db->searchDb(static::getClass(), $parametri, $ordinamento, $limite);
        if (sizeof($parametri) > 0) {
            $rows_number = $db->getRowNum(static::getClass(), $parametri);
        } else {
            $rows_number = $db->getRowNum(static::getClass());
        }
        if(($result != null) && ($rows_number == 1)) {
            $categoria = new ECategoria($result['categoria'], $result['idImmagine']);
            $categoria->setId($result['idCategoria']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $categoria = array();
                for($i = 0; $i < sizeof($result); $i++){
                    $categoria[] = new ECategoria($result[$i]['categoria'], $result[$i]['idImmagine']);
                    $categoria[$i]->setIdCategoria($result[$i]['idCategoria']);
                }
            }
        }
        return $categoria;
    }

    public static function insert($object){
        $db = parent::getInstance();
        $id = $db->insertDb( $object);
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

    public static function search($parametri=array(), $ordinamento='', $limite=''){
        $db = parent::getInstance();
        $result = $db->searchDb(self::$class, $parametri, $ordinamento, $limite);
        return $result;
    }
}

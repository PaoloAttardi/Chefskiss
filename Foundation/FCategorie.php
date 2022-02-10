<?php 

class FCategorie extends Fdb{
    private static $table = 'categorie';

    private static $class = 'FCategorie';

    private static $values = '(:categoria, :id)';

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
     * @param ECategorie $categorie
     */
    public static function bind($stmt, ECategorie $categorie){
        $stmt->bindValue(':categoria', $categorie->getCategoria(), PDO::PARAM_STR);
        $stmt->bindValue(':id', $categorie->getId(), PDO::PARAM_INT);
    }

    public static function loadByField($parametri = array(), $ordinamento = '', $limite = ''){
        $categorie = null;
        $db = parent::getInstance();
        $result = $db->searchDb(static::getClass(), $parametri, $ordinamento, $limite);
        //var_dump($result);
        if (sizeof($parametri) > 0) {
            $rows_number = $db->getRowNum(static::getClass(), $parametri);
        } else {
            $rows_number = $db->getRowNum(static::getClass());
        }
        if(($result != null) && ($rows_number == 1)) {
            $categorie = new ECategorie($result['categoria'], $result['id']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $categorie = array();
                for($i = 0; $i < sizeof($result); $i++){
                    $categorie[] = new ECategorie($result[$i]['categoria'], $result[$i]['id']);
                }
            }
        }
        return $categorie;
    }

    public static function insert($object){
        $db = parent::getInstance();
        $id = $db->insertDb(self::$class, $object);
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

?>
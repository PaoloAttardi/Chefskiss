<?php 

class FPost extends Fdb{

    private static $table = 'post';

    private static $class = 'FPost';

    private static $values = '(:domanda, :autore, :titolo, :categoria, :data, :id_immagine, :id)';
    
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
     * @param EPost $post
     */
    public static function bind($stmt, EPost $post){
        //$stmt->bindValue(':id', $post->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':domanda', $post->getDomanda(), PDO::PARAM_STR);
        $stmt->bindValue(':autore', $post->getAutore(), PDO::PARAM_INT);
        $stmt->bindValue(':categoria', $post->getCategoria(), PDO::PARAM_STR);
        $stmt->bindValue(':data', $post->getData_pubb(), PDO::PARAM_STR);
        $stmt->bindValue(':id_immagine', $post->getId_immagine(), PDO::PARAM_INT);
        $stmt->bindValue(':titolo', $post->getTitolo(), PDO::PARAM_STR);
        $stmt->bindValue(':id', $post->getid(), PDO::PARAM_INT);
    }

    public static function insert($object){
        $db = parent::getInstance();
        $id = $db->insertDb(self::$class, $object);
        $object->setId($id);
    }

    public static function loadByField($parametri = array(), $ordinamento = '', $limite = ''){
        $post = null;
        $db = parent::getInstance();
        $result = $db->searchDb(static::getClass(), $parametri, $ordinamento, $limite);
        if (sizeof($parametri) > 0) {
            $rows_number = $db->getRowNum(static::getClass(), $parametri);
        } else {
            $rows_number = $db->getRowNum(static::getClass());
        }
        if(($result != null) && ($rows_number == 1)) {
            $post = new EPost($result['autore'], $result['titolo'], $result['domanda'], $result['categoria'], $result['data'], $result['id_immagine']);
            $post->setId($result['id']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $post = array();
                for($i = 0; $i < count($result); $i++){
                    $post[] = new EPost($result[$i]['autore'], $result[$i]['titolo'], $result[$i]['domanda'], $result[$i]['categoria'], $result[$i]['data'], $result[$i]['id_immagine']);
                    $post[$i]->setId($result[$i]['id']);
                }
            }
        }
        return $post;
    }

    public static function update($field, $newvalue, $pk, $val){
        $db = parent::getInstance();
        $result = $db->updateDB(self::getClass(), $field, $newvalue, $pk, $val);
        if ($result) return true;
        else return false;
    }

    public static function delete($field, $id){
        $db = parent::getInstance();
        $result = $db->deleteDB(self::getClass(), $field, $id);;
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

    public function filterByCategorie(String $categoria){
        $db = parent::getInstance();
        $result = $db->searchDB(self::class, array('categoria', '=', $categoria));
        return $result;
    }

    public static function loadDefCol($coloumns, $ordinamento='', $limite=''){
        $db = parent::getInstance();
        $result = $db->loadDefColDb(self::$class, $coloumns, $ordinamento, $limite);
        return $result;
    }
}

?>
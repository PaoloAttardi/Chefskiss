<?php


class FPersona extends Fdb
{
    private static string $entity = '../Entity/EPersona';

    private static string $alias= 'persona';

    private static string $class = 'FPersona';

    private static string $values = '(:idUser,:name, :surname, :idImmagine, :password, :description,:email,:discr)';


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

    public function __construct(){
    }

    /**
     * @param PDOStatement $stmt
     * @param Erecensione $recensione
     */
    public static function bind($stmt, EPersona $persona){
        $stmt->bindValue(':idUsere', $persona->getIdUser(), PDO::PARAM_INT);
        $stmt->bindValue(':name', $persona->getName(),PDO::PARAM_STR);
        $stmt->bindValue(':surname', $persona->getSurname(), PDO::PARAM_STR);
        $stmt->bindValue(':idImmagine', $persona->getIdImmagine(), PDO::PARAM_INT);
        $stmt->bindValue(':password', $persona->getPassword(), PDO::PARAM_STR);
        $stmt->bindValue(':description', $persona->getDescription(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $persona->getEmail(), PDO::PARAM_STR);
    }

    public static function loadByField($parametri = array(), $ordinamento = '', $limite = ''){
        $persona = null;
        $db = parent::getInstance();
        $result = $db->searchDb(static::getClass(), $parametri, $ordinamento, $limite);
        if (sizeof($parametri) > 0) {
            $rows_number = $db->getRowNum(static::getClass(), $parametri);
        } else {
            $rows_number = $db->getRowNum(static::getClass());
        }
        if(($result != null) && ($rows_number == 1)) {
            $persona = new EPersona($result['name'], $result['surname'], $result['idImmagine'], $result['password'], $result['description'],$result['email']);
            $persona->setIdUser($result['idPersona']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $post = array();
                for($i = 0; $i < count($result); $i++){
                    $persona[] = new EPersona($result[$i]['name'], $result[$i]['surname'], $result[$i]['idImmagine'], $result[$i]['password'], $result[$i]['description'],$result[$i]['email']);
                    $persona[$i]->setIdUser($result[$i]['idPersona']);
                }
            }
        }
        return $persona;
    }

    public static function insert($object){
        $db = parent::getInstance();
        $id = $db->insertDb($object);
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

    public static function loadLogin($user, $pass){
        $utente = null;
        $db = Fdb::getInstance();
        $result = $db->checkIfLogged($user, $pass);
        if (isset($result)){
            $utente = self::loadByField(array(['email', '=', $result['email']]));
        }
        return $utente;
    }
}
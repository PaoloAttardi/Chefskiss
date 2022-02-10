<?php


class FAdmin extends Fdb
{

    private static string $entity = '../Entity/EAdmin';

    private static string $alias = 'admin';

    private static string $class = 'FAdmin';

    private static string $values = '(:idBadge, :idUser)';

    public function __construct()
    {
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
     * @param Eadmin $admin
     */
    public static function bind($stmt, EModeratore $moderatore)
    {
        $stmt->bindValue(':idBadge', $moderatore->getIdBadge(), PDO::PARAM_INT);
    }

    public static function insert($object)
    {
        $db = parent::getInstance();
        $id = $db->insertDb(self::$class, $object);
        $object->setId($id);
    }

    public static function loadById($ordinamento = '', $limite = '')
    {
        $admin = null;
        $db = parent::getInstance();
        $result = $db->searchDb(static::getClass(), 'idUser', $ordinamento, $limite);
        $rows_number = $db->getRowNum(static::getClass());
        if (($result != null) && ($rows_number == 1)) {
            $admin = new EAdmin($result['idBadge'], $result['name'], $result['surname'], $result['idImmagine'], $result['password'], $result['description'], $result['email']);
            $admin->setIdUser($result['idUser']);
        } else {
            if (($result != null) && ($rows_number > 1)) {
                $admin = array();
                for ($i = 0; $i < count($result); $i++) {
                    $admin[] = new EAdmin($result[$i]['idBadge'], $result[$i]['name'], $result[$i]['surname'], $result[$i]['idImmagine'], $result[$i]['password'], $result[$i]['description'], $result[$i]['email']);
                    $admin[$i]->setIdUser($result[$i]['idUser']);
                }
            }
        }
        return $admin;
    }

    public static function update($field, $newvalue, $pk, $val)
    {
        $db = parent::getInstance();
        $result = $db->updateDB(self::getClass(), $field, $newvalue, $pk, $val);
        if ($result) return true;
        else return false;
    }

    public static function delete($field, $id)
    {
        $db = parent::getInstance();
        $result = $db->deleteDB(self::getClass(), $field, $id);
        if ($result) return true;
        else return false;
    }

    public static function exist($field, $id)
    {
        $db = parent::getInstance();
        $result = $db->existDB(self::getClass(), $field, $id);
        if ($result != null) return true;
        else return false;
    }

    public static function search($parametri = array(), $ordinamento = '', $limite = '')
    {
        $db = parent::getInstance();
        $result = $db->searchDb(self::$class, $parametri, $ordinamento, $limite);
        return $result;
    }

    public static function getRows($parametri = array(), $ordinamento = '', $limite = '')
    {
        $db = parent::getInstance();
        $result = $db->getRowNum(self::$class, $parametri, $ordinamento, $limite);
        return $result;
    }

}
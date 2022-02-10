<?php

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;

class Fdb
{

    /**
     * @var $_em PDO Variabile che stabilisce la connessione con il database
     */
    private $_em;

    private static $class = 'Fdb';

    public function __construct()
    {

        if (!$this->existConn()) {
            try {
                $this->_em = getEntityManager();
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }

        //if ($this->_em!= null) echo 'connessione stabilita '. $this->_em->errorInfo();
        //var_dump($this->_em);
    }

    /**
     * @return mixed|Fdb
     */
    public static function getInstance(){
        if (USingleton::getInstance(self::$class) == null) {
            USingleton::getInstance(self::$class);
        }
        return USingleton::getInstance(self::$class);
    }

    /**
     * Verifica l'esistenza della connessione con il database
     * @return bool
     */
    public function existConn(): bool {
        if($this->_em != null){
            return true;
        } else
            return false;
    }

    /**
     * Questa funzione carica in $result il risultato di una query. Può produrre sia risultati singoli
     * che array di risultati (se le righe prodotte sono maggiori di una)
     * @param $class
     * @param $field
     * @param $id
     * @return array|mixed|null
     */
    /*public function loadDb($class, $field='', $criterio='', $id='')
    {
        try {
            if ($field == '' || $id == '' || $criterio == ''){
                $query = "SELECT " . $class::getAlias() . " FROM `" . $class::getEntity() . '` ';
            } else {
                $query = "SELECT * FROM " . $class::getEntity() . " WHERE " . $field . $criterio . "'" . $id . "';";
            }

            $stmt = $this->_em->prepare($query);
            $stmt->execute();
            $num = $stmt->rowCount();
            if ($num == 0) {
                $result = null;        //nessuna riga interessata. return null
            } elseif ($num == 1) {                          //nel caso in cui una sola riga fosse interessata
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                echo 'sono quA';//ritorna una sola riga
            } else {
                $result = array();                         //nel caso in cui piu' righe fossero interessate
                $stmt->setFetchMode(PDO::FETCH_ASSOC);   //imposta la modalità di fetch come array associativo
                while ($row = $stmt->fetch())
                    $result[] = $row;
            }
            // $this->closeDbConnection();
            return $result;
        } catch (PDOException $e) {
            echo "Attenzione errore: " . $e->getMessage();
            $this->_em->rollBack();
            return null;
        }
    }
    */

    /**
     * Verifica l'accesso di un utente, controllando le credenziali (email e password) siano presenti nel db
     * @param $email
     * @param $pass
     * @return mixed|null
     */
    public function checkIfLogged($email, $pass){
        try {
            $qb = $this->_em->createQueryBuilder();
            $class = 'FPersona';
            $qb->select($class::getAlias())
                ->from($class::getEntity())
                ->where($class::getAlias() . ".email = :email")
                ->where($class::getAlias() . ".email = :password")
                ->setParameters(new ArrayCollection([
                    new Parameter('email', $email),
                    new Parameter('password', $pass)
                ]));
            $query = $qb->getQuery();
            $result = $query->getResult();
            // $result = $query->getArrayResult(); risultati memorizzati in un array(?)
            if (count($result) == 0) {
                $result = null;
            }
            else return $result;
        } catch (PDOException $e){
            echo "Attenzione errore: " . $e->getMessage();
            $this->_em->rollBack();
            return null;
        }
    }

    /**
     * @param $object
     * @param $class
     * @return bool|mixed
     */
    public function insertDb($object){

        try {
            $this->_em->persist($object);
            $this->_em->flush();
            $id = $this->_em->lastInsertId();
            return $id;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $this->_em->rollBack();
            return null;
        }

    }

    public function storeMedia($object) {
		try {
            $this->_em->persist($object);
            $this->_em->flush();
            $id = $this->_em->lastInsertId();
            return $id;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $this->_em->rollBack();
            return null;
        }
	}

    public function updateDB ($class, $field, $newvalue, $pk, $id)
    {
        try {
            $qb = $this->em->createQueryBuilder();
            $query = $qb->update($class::getEntity(), $class::getAlias())
                    ->set($class::getAlias() . '.' . $field, ':identifier')
                    ->where($class::getAlias() . '.id = :id')
                    ->setParameter('identifier', $newvalue)
                    ->setParameter('id', $id)
                    ->getQuery();
            $result = $query->execute();
            //var_dump($query);
            return $result;
        } catch (PDOException $e) {
            echo "Attenzione errore: " . $e->getMessage();
            $this->_em->rollBack();
            return false;
        }
    }

    /**
     * Questa funzione verifica quante righe sono state prodotte da una determinata query
     * @param $class
     * @param $field
     * @param $id
     * @return int|null
     */
    /*public function getRowNum($class, $parametri = array(), $ordinamento = '', $limite = ''){
        $filtro = '';
        try {
            //$this->_em->beginTransaction();
            for ($i = 0; $i < sizeof($parametri); $i++) {
                if ($i > 0) $filtro .= ' AND';
                $filtro .= ' `' . $parametri[$i][0] . '` ' . $parametri[$i][1] . ' \'' . $parametri[$i][2] . '\'';
            }
            $query = 'SELECT * ' .
                'FROM `' . $class::getEntity() . '` ';
            if ($filtro != '')
                $query .= 'WHERE ' . $filtro . ' ';
            if ($ordinamento != '')
                $query .= 'ORDER BY ' . $ordinamento . ' ';
            if ($limite != '')
                $query .= 'LIMIT ' . $limite . ' ';
            $stmt = $this->_em->prepare($query);
            $stmt->execute();
            $num = $stmt->rowCount();
            $this->closeConn();
            return $num;
        } catch (PDOException $e) {
            echo "Attenzione errore: " . $e->getMessage();
            $this->_em->rollBack();
            return null;
        }
    }*/

    /**
     * Questa funzione permette di caricare dal db solo una determinata colonna di una tabella
     * @param $class
     * @param $coloumn
     * @param $order
     * @param $limit
     * @return int|null
     */
    public function loadDefColDb($class, $coloumn, $order='', $limit=''){
        try {
            $qb = $this->_em->createQueryBuilder();
            $class = 'FPersona';
            $qb->select($class::getAlias() . $coloumn)
                ->from($class::getEntity());
            if ($order != '') $qb->orderBy($order);
            if ($limit != '') $qb->setMaxResults($limit);
            $query = $qb->getQuery();
            $result = $query->getResult();
            if (count($result) == 0) {
                $result = null;
            }
            else return $result;
        } catch (PDOException $e){
            echo $e->getMessage();
            return null;
        }
    }

    /**
     * Questa funzione serve a rimuovere i dati di una determinata istanza di un oggetto dal database
     * @param $object
     * @return bool
     */
    public function deleteDB ($class, $field, $id)
    {
        try {
            $qb = $this->_em->createQueryBuilder();
            $result = null;
            $esiste = $this->existDB($class, $field, $id);
            if ($esiste) {
                $qb->delete($class::getEntity(), $class::getAlias())
                    ->where($class::getAlias() . '.' . $field . '= :id')
                    ->setParameter('id', $id);
                $query = $qb->getQuery();
                $result = $query->getResult();
                $this->closeConn();
                $result = true;
            }
        } catch (PDOException $e) {
            echo "Attenzione errore: " . $e->getMessage();
            $this->_em->rollBack();
            //return false;
        }
        return $result;
    }

    public function existDB ($class, $field, $id)
    {
        try {
            $qb = $this->_em->createQueryBuilder();
            $qb->select($class::getEntity(), $class::getAlias())
                ->from($class::getEntity())
                ->where($class::getAlias() . '.' . $field . '= :id')
                ->setParameter('id', $id);
            $query = $qb->getQuery();
            $result = $query->getResult();
            if (count($result) == 1) return $result[0];  //rimane solo l'array interno
            else if (count($result) > 1) return $result;  //resituisce array di array
            $this->closeConn();
        } catch (PDOException $e) {
            echo "Attenzione errore: " . $e->getMessage();
            return null;
        }
    }

    /**
     * Chiude la connessione con il database
     */
    public function closeConn(){
        USingleton::stopInstance(self::$class);
    }


    /**
     * Cerca all'interno del database
     * @param array $parametri
     * @param string $ordinamento
     * @param string $limite
     * @return array|false
     */
    public function searchDb($class, $parametri = array(), $order = '', $limit = ''){
        try {
            $qb = $this->_em->createQueryBuilder();
            $qb->select($class::getEntity(), $class::getAlias())
                ->from($class::getEntity());
            for ($i = 0; $i < sizeof($parametri); $i++) {
                $qb->where($class::getAlias() . '.' . $parametri[$i][0] . ' ' . $parametri[$i][1] .  '= :parametro')
                    ->setParameter('parametro', $parametri[$i][2]);
            }
            if ($order != '') $qb->orderBy($order);
            if ($limit != '') $qb->setMaxResults($limit);
            $query = $qb->getQuery();
            $result = $query->getResult();
            return $result;
        } catch (PDOException $e){
            echo "Attenzione errore: " . $e->getMessage();
            $this->_em->rollBack();
            return null;
        }
    }
}
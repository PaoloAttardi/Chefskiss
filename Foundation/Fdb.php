<?php

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;

require_once 'Utility/USingleton.php';
require_once('bootstrap.php');
//require_once'../Entity/ERicetta.php';
class Fdb
{

    /**
     * @var $_em Entity Manager Variabile che stabilisce la connessione con il database
     */
    private $_em;

    private static $class = 'Fdb';

    public function __construct()
    {

        if (!$this->existConn()) {
            try {
                $this->_em = getEntityManager();
            } catch (Exception $e) {
                echo $e->getMessage();
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
                ->from($class::getEntity(), $class::getAlias())
                ->where($class::getAlias() . ".email = :email")
                ->andWhere($class::getAlias() . ".password = :password")
                ->setParameters(new ArrayCollection([
                    new Parameter('email', $email),
                    new Parameter('password', $pass)
                ]));
            $query = $qb->getQuery();
            $result = $query->getResult();
            if (count($result) == 0) {
                $result = null;
            }
            else return $result;
        } catch (Exception $e){
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
        $this->_em->getConnection()->beginTransaction();
        try {
            $this->_em->persist($object);
            $this->_em->flush();
            $this->_em->getConnection()->commit();
            $id = $object->getId();
            return $id;
        } catch (Exception $e) {
            $this->_em->getConnection()->rollBack();
            echo $e->getMessage();
            return null;
        }
    }

        /**
     * @param $object
     * @param $class
     * @return bool|mixed
     */
    public function insertDBTable($object){
        $this->_em->getConnection()->beginTransaction();
        try {
            $this->_em->persist($object);
            $this->_em->flush();
            $this->_em->getConnection()->commit();
            return true;
        } catch (Exception $e) {
            $this->_em->getConnection()->rollBack();
            echo $e->getMessage();
            return null;
        }
    }


    public function storeMedia($object) {
		try {
            $this->_em->persist($object);
            $this->_em->flush();
            $id = $object->getId();
            return $id;
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        }
	}

    public function updateDB ($class, $field, $newvalue, $pk, $id){
        $this->_em->getConnection()->beginTransaction();
        try {
            $qb = $this->_em->createQueryBuilder();
            $query = $qb->update($class::getEntity(), $class::getAlias())
                    ->set($class::getAlias() . '.' . $field, ':identifier')
                    ->where($class::getAlias() . '.' . $class::getValues() . ' = :id')
                    ->setParameter('identifier', $newvalue)
                    ->setParameter('id', $id)
                    ->getQuery();
            $result = $query->execute();
            $this->_em->getConnection()->commit();
            //var_dump($query);
            return $result;
        } catch (Exception $e) {
            echo "Attenzione errore: " . $e->getMessage();
            $this->_em->rollBack();
            return false;
        }
    }

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
            $qb->select($class::getAlias() . '.' . $coloumn)
                ->from($class::getEntity(), $class::getAlias());
            if ($order != '') $qb->orderBy($order);
            if ($limit != '') $qb->setMaxResults($limit);
            $query = $qb->getQuery();
            $result = $query->getResult();
            if (count($result) == 0) {
                $result = null;
            }
            else return $result;
        } catch (Exception $e){
            echo $e->getMessage();
            return null;
        }
    }

    /**
     * Questa funzione serve a rimuovere i dati di una determinata istanza di un oggetto dal database
     * @param $object
     * @return bool
     */
    public function deleteDB ($class, $field, $id){
        $this->_em->getConnection()->beginTransaction();
        try {
            $qb = $this->_em->createQueryBuilder();
            $result = false;
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
        } catch (Exception $e) {
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
            $qb->select($class::getAlias())
                ->from($class::getEntity(), $class::getAlias())
                ->where($class::getAlias() . '.' . $field . '= :id')
                ->setParameter('id', $id);
            $query = $qb->getQuery();
            $result = $query->getResult();
            if (count($result) == 1) return $result[0];  //rimane solo l'array interno
            else if (count($result) > 1) return $result;  //resituisce array di array
            $this->closeConn();
        } catch (Exception $e) {
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
     * @param string $order
     * @param string $offset primo elemento da restituire rispetto ad una ricerca (0 per restituire dal primo elemento)
     * @param string $limit ultimo elemento da restituire rispetto ad una ricerca (0 per restituire dal primo elemento)
     * @return array|false
     */
    public function searchDb($class, $parametri = array(), $order = '', $offset = '',$limit = '', $like=''){
        try {
            $qb = $this->_em->createQueryBuilder();
            $qb->select($class::getAlias())
                ->from($class::getEntity(), $class::getAlias());
            for ($i = 0; $i < sizeof($parametri); $i++) {
                $qb->where($class::getAlias() . '.' . $parametri[$i][0] . ' ' . $parametri[$i][1] .  ' :parametro')
                    ->setParameter('parametro', $parametri[$i][2]);
            }
            if ($like != '') {
                $qb->andWhere($class::getAlias() . '.' . $like[0] . ' LIKE :parametro')
                    ->setParameter('parametro', $like[1]);
            }
            if ($order != '') $qb->orderBy($class::getAlias() . '.' . $order, 'DESC');
            if ($offset != '' && $limit != ''){ 
                $qb->setFirstResult($offset);
                $qb->setMaxResults($limit);
                $query = $qb->getQuery();
                $paginator = new Doctrine\ORM\Tools\Pagination\Paginator($query);
                // il valore 'data' dell'array result contiene tutti i risultati compresi tra i valori di offset e limite 
                // il valore 'result' contiene invece il numero di risultati totali ottenuti dall'esecuzione della query
                $result['data'] = $paginator->getIterator();
                $result['total'] = $paginator->count();
            }
            else  {
                $query = $qb->getQuery();
                $result = $query->getResult();
            }
            return $result;
        } catch (Exception $e){
            echo "Attenzione errore: " . $e->getMessage();
            return null;
        }
    }
}
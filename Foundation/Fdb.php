<?php

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
    public function loadDb($class, $field='', $criterio='', $id='')
    {
        try {
            if ($field == '' || $id == '' || $criterio == ''){
                $query = "SELECT * FROM `" . $class::getTable() . '` ';
            } else {
                $query = "SELECT * FROM " . $class::getTable() . " WHERE " . $field . $criterio . "'" . $id . "';";
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

    /**
     * Verifica l'accesso di un utente, controllando le credenziali (email e password) siano presenti nel db
     * @param $email
     * @param $pass
     * @return mixed|null
     */
    public function checkIfLogged($email, $pass){
        try {
            $class = 'FUtente';
            $query = 'SELECT * FROM ' . $class::getTable() . " WHERE email ='" . $email . "' AND password ='" . $pass . "';";
            $stmt = $this->_em->prepare($query);
            $stmt->execute();
            $num = $stmt->rowCount();
            if ($num == 0) {
                $result = null;
            } else {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            return $result;
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
    public function insertDb($class, $object){

        try {
            $this->_em->beginTransaction();
            $query = "INSERT INTO `" . $class::getTable() . "` " . str_replace(array(':', ',', ')'), array('`', '`,', '`)'), $class::getValues()) . " VALUES " . $class::getValues();
            $stmt = $this->_em->prepare($query);
            $class::bind($stmt, $object);
            $stmt->execute();
            $id = $this->_em->lastInsertId();
            $this->_em->commit();
            $this->closeConn();
            return $id;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $this->_em->rollBack();
            return null;
        }

    }

    public function storeMedia($class , $obj,$nome_file) {
		try {
            $this->_em->beginTransaction();
            $query = "INSERT INTO `" . $class::getTable() . "` " . str_replace(array(':', ',', ')'), array('`', '`,', '`)'), $class::getValues()) . " VALUES " . $class::getValues();
            $stmt = $this->_em->prepare($query);
            $class::bind($stmt, $obj, $nome_file);
            $stmt->execute();
            $id = $this->_em->lastInsertId();
            $this->_em->commit();
            $this->closeConn();
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
            $this->_em->beginTransaction();
            $query = "UPDATE " . $class::getTable() . ' SET ' . $field . '="' . addslashes($newvalue) . '" WHERE ' . $pk . '="' . $id . '";';
            //var_dump($query);
            $stmt = $this->_em->prepare($query);
            $stmt->execute();
            $this->_em->commit();
            $this->closeConn();
            return true;
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
    public function getRowNum($class, $parametri = array(), $ordinamento = '', $limite = ''){
        $filtro = '';
        try {
            //$this->_em->beginTransaction();
            for ($i = 0; $i < sizeof($parametri); $i++) {
                if ($i > 0) $filtro .= ' AND';
                $filtro .= ' `' . $parametri[$i][0] . '` ' . $parametri[$i][1] . ' \'' . $parametri[$i][2] . '\'';
            }
            $query = 'SELECT * ' .
                'FROM `' . $class::getTable() . '` ';
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
    }

    public function loadDefColDb($class, $coloumns, $order='', $limit=''){
        $cols = '';
        try {
            for ($i = 0; $i < count($coloumns); $i++){
                if ($i > 0) $cols .= ', ';
                $cols .= $coloumns[$i];
            }
            $query = 'SELECT ' . $cols . ' FROM '. $class::getTable();
            if ($order != '')
                $query .= ' ORDER BY ' . $order . ' DESC';
            if ($limit != '')
                $query .= ' LIMIT ' . $limit;

            $stmt = $this->_em->prepare($query);
            $stmt->execute();
            $numRow = $stmt->rowCount();
            if ($numRow == 0){
                $result = null;
            } elseif ($numRow == 1) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $result = array();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                while ($row = $stmt->fetch()) $result[] = $row;
            }
            return $result;
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
            $result = null;
            $this->_em->beginTransaction();
            $esiste = $this->existDB($class, $field, $id);
            if ($esiste) {
                $query = "DELETE FROM " . $class::getTable() . " WHERE " . $field . "='" . $id . "';";
                $stmt = $this->_em->prepare($query);
                $stmt->execute();
                $this->_em->commit();
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

    /**
     * Funzione che esegue la query precedentemente istanziata
     * @return bool
     */

    public function existDB ($class, $field, $id)
    {
        try {
            $query = "SELECT * FROM " . $class::getTable() . " WHERE " . $field . "='" . $id . "'";
            $stmt = $this->_em->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    public function searchDb($class, $parametri = array(), $ordinamento = '', $limite = ''){
        $filtro = '';
        try {
            for ($i = 0; $i < sizeof($parametri); $i++) {
                if ($i > 0) $filtro .= ' AND';
                $filtro .= ' `' . $parametri[$i][0] . '` ' . $parametri[$i][1] . ' \'' . $parametri[$i][2] . '\'';
            }
            $query = 'SELECT * ' .
                'FROM `' . $class::getTable() . '` ';
            if ($filtro != '')
                $query .= 'WHERE ' . $filtro . ' ';
            if ($ordinamento != '')
                $query .= 'ORDER BY ' . $ordinamento . ' ' . 'DESC ';
            if ($limite != '')
                $query .= 'LIMIT ' . $limite . ' ';
            $stmt = $this->_em->prepare($query);
            $stmt->execute();
            $numRow = $stmt->rowCount();
            if ($numRow == 0){
                $result = null;
            } elseif ($numRow == 1) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $result = array();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                while ($row = $stmt->fetch()) $result[] = $row;
            }
            return $result;
        } catch (PDOException $e){
            echo "Attenzione errore: " . $e->getMessage();
            $this->_em->rollBack();
            return null;
        }
    }
}
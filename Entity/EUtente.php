<?php

/**
 * @Entity @Table(name="utente")
 **/

class EUtente extends EPersona
{
    /** @Id @Column(type="integer") @GeneratedValue**/
    protected $idUser;

    /** @Column(type="boolean", options = {"default" : "false"}) **/
    protected $ban;

    /** @Column(type="datetime", nullable=true)**/
    protected $dataFineBan;

    /** @Column(type="integer", nullable=true) **/
    protected $idModerator;

    protected $discr = "user";

    public function __construct($ban, $dataFineBan, $idModerator, $name, $surname, $idImmagine, $password, $description, $email)
    {
        $this->ban = $ban;
        $this->dataFineBan = $dataFineBan;
        $this->idModerator = $idModerator;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->idImmagine = $idImmagine;
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->idUser;
    }

    /**
     * @return mixed
     */
    public function getBan()
    {
        return $this->ban;
    }

    /**
     * @param mixed $ban
     */
    public function setBan($ban)
    {
        $this->ban = $ban;
    }

    /**
     * @return mixed
     */
    public function getDataFineBan()
    {
        return $this->dataFineBan;
    }

    /**
     * @param mixed $dataFineBan
     */
    public function setDataFineBan($dataFineBan)
    {
        $this->dataFineBan = $dataFineBan;
    }

    /**
     * @return mixed
     */
    public function getIdModerator()
    {
        return $this->idModerator;
    }

    /**
     * @param mixed $idModerator
     */
    public function setIdModerator($idModerator)
    {
        $this->idModerator = $idModerator;
    }



    /**
     * Get the value of discr
     */ 
    public function getDiscr()
    {
        return $this->discr;
    }

    /**
     * Set the value of idUser
     *
     * @return  self
     */ 
    public function setId($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function checkIfLogged(){
        $pm = USingleton::getInstance('FPersistentManager');
        return $pm::loadLogin($this->email, $this->password);
    }
}
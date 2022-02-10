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

    /** @Column(type="datetime") **/
    protected $dataFineBan;

    /** @Column(type="integer") **/
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
    public function getIdUser()
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
}
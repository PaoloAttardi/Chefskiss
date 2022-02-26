<?php

/**
 * @Entity @Table(name="tabellaUpVote")
 **/

class ETabellaUpVote
{
    /** @Id @Column(type="integer")
     *  @OneToOne(targetEntity="commento")
     **/
    public $idCommento;

    /** @Id @Column(type="integer")
     * @OneToOne(targetEntity="persona")
     **/
    public $idUser;

    public function __construct($idUser, $idCommento)
    {
        $this->idUser = $idUser;
        $this->idCommento = $idCommento;
    }


    /**
     * Get the value of idCommento
     */ 
    public function getIdCommento()
    {
        return $this->idCommento;
    }

    /**
     * Set the value of idCommento
     *
     * @return  self
     */ 
    public function setIdCommento($idCommento)
    {
        $this->idCommento = $idCommento;

        return $this;
    }

    /**
     * Get the value of idUser
     */ 
    public function getId()
    {
        return $this->idUser;
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
}
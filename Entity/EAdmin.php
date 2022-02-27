<?php

/**
 * @Entity @Table(name="admin")
 **/

// require "EPersona.php";

class EAdmin extends EPersona
{
    /** @Id @Column(type="integer") @GeneratedValue**/
    public $idUser;

    /** @Column(type="integer")
     * @OneToOne(targetEntity="badge")
     **/
    public $idBadge;

    public $discr = "admin";

    public function __construct($idBadge, $name, $surname, $idImmagine, $password, $description, $email)
    {
        $this->idBadge = $idBadge;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->idImmagine = $idImmagine;
        $this->description = $description;
    }


    /**
     * Get the value of idBadge
     */ 
    public function getId()
    {
        return $this->idBadge;
    }

    /**
     * Set the value of idBadge
     *
     * @return  self
     */ 
    public function setId($idBadge)
    {
        $this->idBadge = $idBadge;

        return $this;
    }

    /**
     * Get the value of idUser
     */ 
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     *
     * @return  self
     */ 
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get the value of discr
     */ 
    public function getDiscr()
    {
        return $this->discr;
    }
}
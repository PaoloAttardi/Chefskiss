<?php

/**
 * @Entity @Table(name="moderatore")
 **/

class EModeratore extends EPersona
{
    /** @Id @Column(type="integer") @GeneratedValue**/
    protected $idUser;

    /** @Column(type="integer")
     * @OneToOne(targetEntity="badge")
     **/
    protected $idBadge;

    /** @Column(type="datetime") **/
    protected $dataPromozione;

    protected $discr = "moderator";

    public function __construct($idBadge, $dataPromozione, $name, $surname, $idImmagine, $password, $description, $email)
    {
        $this->dataPromozione = $dataPromozione;
        $this->idBadge = $idBadge;
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
    public function getIdBadge()
    {
        return $this->idBadge;
    }

    /**
     * @param mixed $idBadge
     */
    public function setIdBadge($idBadge)
    {
        $this->idBadge = $idBadge;
    }

    /**
     * @return mixed
     */
    public function getDataPromozione()
    {
        return $this->dataPromozione;
    }

    /**
     * @param mixed $dataPromozione
     */
    public function setDataPromozione($dataPromozione)
    {
        $this->dataPromozione = $dataPromozione;
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
}
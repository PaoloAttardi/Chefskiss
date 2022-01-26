<?php

/**
 * @Entity @Table(name="moderator")
 **/

class EModerator extends EPerson
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

    public function __construct($idBadge, $dataPromozione)
    {
        $this->dataPromozione = $dataPromozione;
        $this->idBadge = $idBadge;
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

}
<?php

/**
 * @Entity @Table(name="moderator")
 **/

class Moderator extends Person
{
    /** @Id @Column(type="integer") @GeneratedValue**/
    protected $idUser;

    /** @Column(type="integer") **/
    protected $idBadge;

    /** @Column(type="datetime") **/
    protected $dataPromozione;

    protected $discr = "moderator";

    public function __construct($idBadge, $dataPromozione)
    {
        $this->dataPromozione = $dataPromozione;
        $this->idBadge = $idBadge;
    }
}
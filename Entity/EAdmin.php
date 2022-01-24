<?php

/**
 * @Entity @Table(name="admin")
 **/

class Admin extends Person
{
    /** @Id @Column(type="integer") @GeneratedValue**/
    protected $idUser;

    /** @Column(type="integer") **/
    protected $idBadge;

    protected $discr = "admin";

    public function __construct($idBadge)
    {
        $this->idBadge = $idBadge;
    }

}
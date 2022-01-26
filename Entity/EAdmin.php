<?php

/**
 * @Entity @Table(name="admin")
 **/

class EAdmin extends EPerson
{
    /** @Id @Column(type="integer") @GeneratedValue**/
    protected $idUser;

    /** @Column(type="integer")
     * @OneToOne(targetEntity="badge")
     **/
    protected $idBadge;

    protected $discr = "admin";

    public function __construct($idBadge)
    {
        $this->idBadge = $idBadge;
    }

}
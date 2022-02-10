<?php

/**
 * @Entity @Table(name="badge")
 **/

class EBadge
{
    /** @Id @Column(type="integer") @GeneratedValue**/
    protected $idBadge;

    /** @Column(type="string") **/
    protected $Badge;

    public function __construct($Badge)
    {
        $this->Badge = $Badge;
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
}
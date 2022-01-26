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

}
<?php

/**
 * @Entity @Table(name="badge")
 **/

class EBadge
{
    /** @Id @Column(type="integer") @GeneratedValue**/
    public $idBadge;

    /** @Column(type="string") **/
    public $Badge;

    private static string $entity = 'EBadge';

    private static string $alias = 'badge';

    public function __construct($Badge)
    {
        $this->Badge = $Badge;
    }

            /**
     * @return string
     */
    public static function getEntity(): string
    {
        return self::$entity;
    }

    /**
     * @return string
     */
    public static function getAlias(): string
    {
        return self::$alias;
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
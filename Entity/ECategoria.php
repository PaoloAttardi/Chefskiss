<?php

/**
 * @Entity @Table(name="categoria")
 **/

class ECategoria{

    /** @Id @Column(type="integer") @GeneratedValue**/
    public $idCategoria;

    /** @Column(type="string") **/
    public $categoria;

    /** @Column(type="integer") 
     * @OneToOne(targetEntity="immagine")
    **/
    public $idImmagine;

    private static $entity = 'ECategoria';

    private static $alias= 'categoria';

    /**
     * @param $categoria
     * @param $idImmagine
     */
    public function __construct($categoria, $idImmagine){
        $this->categoria = $categoria;
        $this->idImmagine = $idImmagine;
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
     * @return mixed
     */
    public function getCategoria(){
        return $this->categoria;
    }

    /**
     * @param mixed $categoria
     */
    public function setCategoria($categoria): void{
        $this->categoria = $categoria;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->idCategoria;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($idCategoria)
    {
        $this->idCategoria = $idCategoria;

        return $this;
    }

    /**
     * Get the value of idImmagine
     */ 
    public function getIdImmagine()
    {
        return $this->idImmagine;
    }

    /**
     * Set the value of idImmagine
     *
     * @return  self
     */ 
    public function setIdImmagine($idImmagine)
    {
        $this->idImmagine = $idImmagine;

        return $this;
    }
}
<?php

/**
 * @Entity @Table(name="immagine")
 **/
class EImmagine{

    /** @Id @Column(type="integer") @GeneratedValue**/
    public $idImmagine;

    /** @Column(type="string") **/
    public $nome;
    
    /** @Column(type="string") **/
    public $dimensione;
    
    /** @Column(type="string") **/
    public $tipo;
    
    /** @Column(type="blob") **/
    public $immagine;

    private static $entity = 'EImmagine';

    private static $alias= 'immagine';

    /**
     * @param $nome
     * @param $dimensione
     * @param $tipo
     * @param $immagine
     */
    public function __construct($nome, $dimensione, $tipo, $immagine)
    {
        $this->nome = $nome;
        $this->dimensione = $dimensione;
        $this->tipo = $tipo;
        $this->immagine = $immagine;
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
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->idImmagine;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($idImmagine)
    {
        $this->idImmagine = $idImmagine;

        return $this;
    }

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of dimensione
     */ 
    public function getDimensione()
    {
        return $this->dimensione;
    }

    /**
     * Set the value of dimensione
     *
     * @return  self
     */ 
    public function setDimensione($dimensione)
    {
        $this->dimensione = $dimensione;

        return $this;
    }

    /**
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */ 
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of immagine
     */ 
    public function getImmagine()
    {
        return $this->immagine;
    }

    /**
     * Set the value of immagine
     *
     * @return  self
     */ 
    public function setImmagine($immagine)
    {
        $this->immagine = $immagine;

        return $this;
    }

}

?>
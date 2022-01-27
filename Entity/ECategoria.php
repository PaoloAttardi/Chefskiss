<?php

/**
 * @Entity @Table(name="categoria")
 **/

class ECategoria{

    /** @Id @Column(type="integer") @GeneratedValue**/
    private $idCategoria;

    /** @Column(type="string") **/
    private $categoria;

    /** @Column(type="integer") 
     * @OneToOne(targetEntity="immagine")
    **/
    private $idImmagine;

    /**
     * @param $categoria
     * @param $idImmagine
     */
    public function __construct($categoria, $idImmagine){
        $this->categoria = $categoria;
        $this->idImmagine = $idImmagine;
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
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setIdCategoria($idCategoria)
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
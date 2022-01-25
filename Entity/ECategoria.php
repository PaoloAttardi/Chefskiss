<?php

/**
 * @Entity @Table(name="categoria")
 **/

class ECategoria{

    /** @Id @Column(type="integer") @GeneratedValue**/
    private $idCategoria;

    /** @Column(type="string") **/
    private $categoria;

    /**
     * @param $categoria
     */
    public function __construct($categoria){
        $this->categoria = $categoria;
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
}
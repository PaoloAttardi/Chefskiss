<?php

/**
 * @Entity @Table(name="post")
 **/

class EPost {

    /** @Id @Column(type="integer") @GeneratedValue**/
    public $idPost;

    /** @Column(type="string") **/
    public $titolo;
    
    /** @Column(type="integer") 
     * @OneToOne(targetEntity="person")
    **/
    public $autore;
    
    /** @Column(type="string") **/
    public $domanda;
    
    /** @Column(type="integer") 
     * @OneToOne(targetEntity="categoria")
    **/
    public $categoria;
    
    /** @Column(type="date") **/
    public $dataPubblicazione;

    /**
     * @param $autore
     * @param $domanda
     * @param $categoria
     * @param $dataPubblicazione
     */
    public function __construct($autore=null, $titolo=null, $domanda=null, $categoria=null, $dataPubblicazione=null)
    {
        $this->titolo = $titolo;
        $this->autore = $autore;
        $this->domanda = $domanda;
        $this->categoria = $categoria;
        $this->dataPubblicazione = $dataPubblicazione;
    }

    /**
     * @return mixed|null
     */
    public function getTitolo()
    {
        return $this->titolo;
    }

    /**
     * @param mixed|null $titolo
     */
    public function setTitolo(mixed $titolo)
    {
        $this->titolo = $titolo;
    }

    /**
     * Get the value of autore
     */ 
    public function getAutore()
    {
        return $this->autore;
    }

    /**
     * Set the value of autore
     *
     * @return  self
     */ 
    public function setAutore($autore)
    {
        $this->autore = $autore;

        return $this;
    }

    /**
     * Get the value of domanda
     */ 
    public function getDomanda()
    {
        return $this->domanda;
    }

    /**
     * Set the value of domanda
     *
     * @return  self
     */ 
    public function setDomanda($domanda)
    {
        $this->domanda = $domanda;

        return $this;
    }

    /**
     * Get the value of categoria
     */ 
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set the value of categoria
     *
     * @return  self
     */ 
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get the value of dataPubblicazione
     */ 
    public function getdataPubblicazione()
    {
        return $this->dataPubblicazione;
    }

    /**
     * Set the value of dataPubblicazione
     *
     * @return  self
     */ 
    public function setdataPubblicazione($dataPubblicazione)
    {
        $this->dataPubblicazione = $dataPubblicazione;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->idPost;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($idPost)
    {
        $this->idPost = $idPost;

        return $this;
    }
}
?>
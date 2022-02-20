<?php

/**
 * @Entity @Table(name="ricetta")
 **/
class ERicetta
{

    /** @Id @Column(type="integer") @GeneratedValue**/
    public $idRicetta;

    /** @Column(type="string") **/
    public $ingredienti;
    
    /** @Column(type="string") **/
    public $procedimento;
    
    /** @Column(type="integer") 
     * @OneToOne(targetEntity="categoria")
    **/
    public $categoria;
    
    /** @Column(type="date") **/
    public $data;
    
    /** @Column(type="integer") 
     * @OneToOne(targetEntity="person")
    **/
    public $autore;
    
    /** @Column(type="string") **/
    public $nomeRicetta;
    
    /** @Column(type="integer") **/
    public $dosiPersone;
    
    /** @Column(type="integer") 
     * @OneToOne(targetEntity="immagine")
    **/
    public $idImmagine;
    
    /** @Column(type="integer"), options = {"default" : 0} **/
    public $valutazione;


    /**
     * @param $ingredienti
     * @param $procedimento
     * @param $categoria
     * @param $data_pubblicazione
     * @param $autore
     * @param $dosiPersone
     */
    public function __construct($ingredienti, $procedimento, $categoria, $data_pubblicazione,$autore, $nomeRicetta, $dosiPersone, $idImmagine, $valutazione)
    {
        $this->ingredienti = $ingredienti;
        $this->procedimento = $procedimento;
        $this->categoria = $categoria;
        $this->data = $data_pubblicazione;
        $this->autore = $autore;
        $this->nomeRicetta = $nomeRicetta;
        $this->dosiPersone = $dosiPersone;
        $this->idImmagine = $idImmagine;
        $this->valutazione = $valutazione;
    }

    /**
     * @return mixed|null
     */
    public function getDosiPersone()
    {
        return $this->dosiPersone;
    }

    /**
     * @param mixed|null $dosiPersone
     */
    public function setDosiPersone($dosiPersone): void
    {
        $this->dosiPersone = $dosiPersone;
    }

    /**
     * @return mixed|null
     */
    public function getNomeRicetta()
    {
        return $this->nomeRicetta;
    }

    /**
     * @param mixed|null $nomeRicetta
     */
    public function setNomeRicetta($nomeRicetta): void
    {
        $this->nomeRicetta = $nomeRicetta;
    }

    public function getIngredienti()
    {
        return $this->ingredienti;
    }

    /**
     * @return mixed
     */
    public function getProcedimento()
    {
        return $this->procedimento;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->idRicetta;
    }

    /**
     * @return mixed
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getAutore()
    {
        return $this->autore;
    }

    /**
     * @param mixed $ingredienti
     */
    public function setIngredienti($ingredienti)
    {
        $this->ingredienti = $ingredienti;
    }

    /**
     * @param mixed $procedimento
     */
    public function setProcedimento($procedimento)
    {
        $this->procedimento = $procedimento;
    }

    /**
     * @param mixed $idRicetta
     */
    public function setId($idRicetta)
    {
        $this->idRicetta = $idRicetta;
    }

    /**
     * @param mixed $categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @param mixed $autore
     */
    public function setAutore($autore)
    {
        $this->autore = $autore;
    }

    /**
     * Get the value of idImmagine
     */ 
    public function getidImmagine()
    {
        return $this->idImmagine;
    }

    /**
     * Set the value of idImmagine
     *
     * @return  self
     */ 
    public function setidImmagine($idImmagine)
    {
        $this->idImmagine = $idImmagine;

        return $this;
    }

    /**
     * Get the value of valutazione
     */ 
    public function getValutazione()
    {
        return $this->valutazione;
    }

    /**
     * Set the value of valutazione
     *
     * @return  self
     */ 
    public function setValutazione($valutazione)
    {
        $this->valutazione = $valutazione;

        return $this;
    }

}


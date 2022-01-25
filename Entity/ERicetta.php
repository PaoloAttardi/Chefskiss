<?php

class ERicetta
{


    private $idRicetta;


    private $ingredienti;
    
    
    private $procedimento;
    
    
    private $categoria;
    
    
    private $data;
    
    
    private $autore;
    
    
    private $nome_ricetta;
    
    
    private $dosi_persone;
    
    
    private $id_immagine;
    
    
    private $valutazione;


    /**
     * @param string $ingredienti
     * @param string $procedimento
     * @param string $categoria
     * @param DateTime $data_pubblicazione
     * @param int $autore
     * @param int $id
     * @param $dosi_persone
     */
    public function __construct($ingredienti=null, $procedimento=null, $categoria=null, $data_pubblicazione=null,
                                 $autore=null, $nome_ricetta=null, $dosi_persone=null, $id_immagine=null, $valutazione=null)
    {
        $this->ingredienti = $ingredienti;
        $this->procedimento = $procedimento;
        $this->categoria = $categoria;
        $this->data = $data_pubblicazione;
        $this->autore = $autore;
        $this->nome_ricetta = $nome_ricetta;
        $this->dosi_persone = $dosi_persone;
        $this->id_immagine = $id_immagine;
        $this->valutazione = $valutazione;
    }

    /**
     * @return mixed|null
     */
    public function getDosiPersone()
    {
        return $this->dosi_persone;
    }

    /**
     * @param mixed|null $dosi_persone
     */
    public function setDosiPersone($dosi_persone): void
    {
        $this->dosi_persone = $dosi_persone;
    }

    /**
     * @return mixed|null
     */
    public function getNomeRicetta()
    {
        return $this->nome_ricetta;
    }

    /**
     * @param mixed|null $nome_ricetta
     */
    public function setNomeRicetta($nome_ricetta): void
    {
        $this->nome_ricetta = $nome_ricetta;
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
        return $this->id;
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
    public function getData_()
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
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function setData_($data)
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

    public function parseIngredienti(){
        $array = explode(', ', $this->getIngredienti());
        $ingredienti = array();
        for ($i = 0; $i < count($array); $i++){
            $ingredienti[$i] = $array[$i];
            //var_dump($ingredienti[$i]);
        }

        return $ingredienti;
    }

    /**
     * Get the value of id_immagine
     */ 
    public function getId_immagine()
    {
        return $this->id_immagine;
    }

    /**
     * Set the value of id_immagine
     *
     * @return  self
     */ 
    public function setId_immagine($id_immagine)
    {
        $this->id_immagine = $id_immagine;

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


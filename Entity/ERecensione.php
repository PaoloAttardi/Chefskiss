<?php

/**
 * @Entity @Table(name="recensione")
 **/

class ERecensione
{
    /** @Id @Column(type="integer") @GeneratedValue**/
    private $idRecensione;

    /** @Column(type="string") **/
    private $commento;
    
    /** @Column(type="integer") **/
    private $valutazione;
    
    /** @Column(type="integer") 
     * @OneToOne(targetEntity="ricetta")
    **/
    private $idRicetta;
    
    /** @Column(type="date") **/
    private $dataPubblicazione;
    
    /** @Column(type="integer") 
     * @OneToOne(targetEntity="person")
    **/
    private $autore;

    /**
     * @param $commento
     * @param $valutazione
     * @param $idRicetta
     * @param $dataPubblicazione
     * @param $autore
     */
    public function __construct($commento=null, $valutazione=null, $idRicetta=null, $dataPubblicazione=null, $autore=null)
    {
        $this->commento = $commento;
        $this->valutazione = $valutazione;
        $this->idRicetta = $idRicetta;
        $this->dataPubblicazione = $dataPubblicazione;
        $this->autore = $autore;
    }


    public function getCommento()
    {
        return $this->commento;
    }

    /**
     * @return mixed
     */
    public function getValutazione()
    {
        return $this->valutazione;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->idRecensione;
    }

    /**
     * @return mixed
     */
    public function getidRicetta()
    {
        return $this->idRicetta;
    }

    /**
     * @return mixed
     */
    public function getdataPubblicazione()
    {
        return $this->dataPubblicazione;
    }

    /**
     * @return mixed
     */
    public function getAutore()
    {
        return $this->autore;
    }

    /**
     * @param mixed $commento
     */
    public function setCommento($commento)
    {
        $this->commento = $commento;
    }

    /**
     * @param mixed $valutazione
     */
    public function setValutazione($valutazione)
    {
        $this->valutazione = $valutazione;
    }

    /**
     * @param mixed $id
     */
    public function setId($idRecensione)
    {
        $this->idRecensione = $idRecensione;
    }

    /**
     * @param mixed $idRicetta
     */
    public function setidRicetta($idRicetta)
    {
        $this->idRicetta = $idRicetta;
    }

    /**
     * @param mixed $dataPubblicazione
     */
    public function setdataPubblicazione($dataPubblicazione)
    {
        $this->dataPubblicazione = $dataPubblicazione;
    }

    /**
     * @param mixed $autore
     */
    public function setAutore($autore)
    {
        $this->autore = $autore;
    }
}


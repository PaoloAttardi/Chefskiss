<?php

/**
 * @Entity @Table(name="recensione")
 **/

class ERecensione
{
    /** @Id @Column(type="integer") @GeneratedValue**/
    public $idRecensione;

    /** @Column(type="string", length=1000) **/
    public $commento;
    
    /** @Column(type="integer") **/
    public $valutazione;
    
    /** @Column(type="integer") 
     * @OneToOne(targetEntity="ricetta")
    **/
    public $idRicetta;
    
    /** @Column(type="date") **/
    public $dataPubblicazione;
    
    /** @Column(type="integer") 
     * @OneToOne(targetEntity="person")
    **/
    public $autore;

    private static $entity = 'ERecensione';

    private static $alias= 'recensione';

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

    public static function getValutazioneRicetta($recensione){
        $idRicetta = $recensione->getIdRicetta();
        $valutazione = 0;
        $pm = USingleton::getInstance('FPersistentManager');
        $recensioni = $pm::search('ERecensione', array(['idRicetta', '=', $idRicetta]));
        $ricetta = $pm::search('ERicetta', array(['idRicetta', '=', $idRicetta]));
        if($recensione != null){
            if(is_array($recensioni)){
                for($i = 0; $i < sizeof($recensioni); $i++){
                    if($recensioni[$i]->getValutazione() != 0){
                        $voti[] = $recensioni[$i]->getValutazione();
                    }
                }
                $voti[] = $recensione->getValutazione();
                $valutazione = array_sum($voti)/sizeof($voti);
            }
            else {
                $valutazione = $recensione->getValutazione();
            }
        }
        $pm::update('valutazione',(int)$valutazione, 'idRicetta', $idRicetta, 'ERicetta');
        return true;
    }
}


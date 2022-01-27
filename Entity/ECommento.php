<?php

/**
 * @Entity @Table(name="commento")
 **/

class ECommento {
    
    /** @Id @Column(type="integer") @GeneratedValue**/
    private $idCommento;

    /** @Column(type="integer") 
     * @OneToOne(targetEntity="person")
    **/
    private $autore;

    /** @Column(type="string") **/
    private $testo;
    
    /** @Column(type="integer") 
     * @OneToOne(targetEntity="post")
    **/
    private $idPost;
    
    /** @Column(type="date") **/
    private $data;

    /** @Column(type="integer") **/
    private $upVote;

    /**
     * ECommento constructor.
     */
    public function __construct($idPost, $autore, $testo, $data, $upVote){
        $this->idPost = $idPost;
        $this->autore = $autore;
        $this->testo = $testo;
        $this->data = $data;
        $this->upVote = $upVote;
    }

    /**
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData(string $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the value of idPost$idPost
     */ 
    public function getidPost()
    {
        return $this->idPost;
    }

    /**
     * Set the value of idPost$idPost
     *
     * @return  self
     */ 
    public function setidPost(int $idPost)
    {
        $this->idPost = $idPost;

        return $this;
    }

    /**
     * Get the value of testo
     */ 
    public function getTesto()
    {
        return $this->testo;
    }

    /**
     * Set the value of testo
     *
     * @return  self
     */ 
    public function setTesto(string $testo)
    {
        $this->testo = $testo;

        return $this;
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
    public function setAutore(int $autore)
    {
        $this->autore = $autore;

        return $this;
    }


    /**
     * Get the value of idCommento
     */ 
    public function getIdCommento()
    {
        return $this->idCommento;
    }

    /**
     * Set the value of idCommento
     *
     * @return  self
     */ 
    public function setIdCommento($idCommento)
    {
        $this->idCommento = $idCommento;

        return $this;
    }

    /**
     * Get the value of upVote
     */ 
    public function getUpVote()
    {
        return $this->upVote;
    }

    /**
     * Set the value of upVote
     *
     * @return  self
     */ 
    public function setUpVote($upVote)
    {
        $this->upVote = $upVote;

        return $this;
    }
}
?>

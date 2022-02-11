<?php

/**
 * @Entity @Table(name="persona")
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="discr", type="string")
 * @DiscriminatorMap({"persona" = "EPersona", "utente" = "EUtente", "admin" = "EAdmin", "moderatore" = "EModeratore"})
 **/

class EPersona
{
    /** @Id @Column(type="integer") @GeneratedValue
     * @OneToOne(targetEntity="utente")
     * @OneToOne(targetEntity="admin")
     * @OneToOne(targetEntity="moderatore")
     * @JoinColumn(name="idUser", referencedColumnName="idUser")
     **/
    protected $idUser;

    /** @Column(type="string") **/
    protected $name;

    /** @Column(type="string") **/
    protected $surname;

    /** @Column(type="integer", nullable=true) **/
    protected $idImmagine;

    /** @Column(type="string") **/
    protected $password;

    /** @Column(type="string", nullable=true) **/
    protected $description;

    /** @Column(type="string") **/
    protected $email;

    protected $discr = "persona";

    public function __construct($name, $surname, $idImmagine, $password, $description, $email)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->idImmagine = $idImmagine;
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getIdImmagine()
    {
        return $this->idImmagine;
    }

    /**
     * @param mixed $idImmagine
     */
    public function setIdImmagine($idImmagine)
    {
        $this->idImmagine = $idImmagine;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->idUser;
    }


    /**
     * Get the value of discr
     */ 
    public function getDiscr()
    {
        return $this->discr;
    }

    /**
     * Set the value of idUser
     *
     * @return  self
     */ 
    public function setId($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }
}

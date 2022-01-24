<?php

/**
 * @Entity @Table(name="person")
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="discr", type="string")
 * @DiscriminatorMap({"person" = "Person", "user" = "User", "admin" = "Admin", "moderator" = "Moderator"})
 **/

class Person
{
    /** @Id @Column(type="integer") @GeneratedValue
     * @OneToOne(targetEntity="user")
     * @OneToOne(targetEntity="admin")
     * @OneToOne(targetEntity="moderator")
     * @JoinColumn(name="idUser", referencedColumnName="idUser")
     **/
    protected $idUser;

    /** @Column(type="string") **/
    protected $name;

    /** @Column(type="string") **/
    protected $surname;

    /** @Column(type="integer") **/
    protected $idImmagine;

    /** @Column(type="string") **/
    protected $password;

    /** @Column(type="string") **/
    protected $description;

    /** @Column(type="string") **/
    protected $email;

    /** @Column(type="datetime") **/
    protected $dataIscrizione;

    protected $discr = "person";

    public function __construct($name, $surname, $idImmagine, $password, $description, $email, $dataIscrizione)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->idImmagine = $idImmagine;
        $this->description = $description;
        $this->dataIscrizione = $dataIscrizione;
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
    public function getDataIscrizione()
    {
        return $this->dataIscrizione;
    }

    /**
     * @param mixed $dataIscrizione
     */
    public function setDataIscrizione($dataIscrizione)
    {
        $this->dataIscrizione = $dataIscrizione;
    }

}

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

    protected $discr = "person";

    public function __construct($name, $surname, $idImmagine, $password, $description, $email)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->idImmagine = $idImmagine;
        $this->description = $description;
    }


}
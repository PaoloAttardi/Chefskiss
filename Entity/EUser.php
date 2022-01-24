<?php

/**
 * @Entity @Table(name="user")
 **/

class User extends Person
{
    /** @Id @Column(type="integer") @GeneratedValue**/
    protected $idUser;

    /** @Column(type="boolean", options = {"default" : "false"}) **/
    protected $ban;

    /** @Column(type="datetime") **/
    protected $dataFineBan;

    /** @Column(type="integer") **/
    protected $idModerator;

    protected $discr = "user";

    public function __construct($ban, $dataFineBan, $idModerator)
    {
        $this->ban = $ban;
        $this->dataFineBan = $dataFineBan;
        $this->idModerator = $idModerator;
    }
}
<?php


class User
{
    private $id;
    private $username;
    private $full_name;
    private $email;
    private $password;
    private $contact_number;
    private $address;

    /**
     * User constructor.
     * @param $id
     * @param $username
     * @param $full_name
     * @param $email
     * @param $password
     * @param $contact_number
     * @param $address
     */
    public function __construct($id, $username, $full_name, $email, $password, $contact_number, $address)
    {
        $this->id = $id;
        $this->username = $username;
        $this->full_name = $full_name;
        $this->email = $email;
        $this->password = $password;
        $this->contact_number = $contact_number;
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->full_name;
    }

    /**
     * @param mixed $full_name
     */
    public function setFullName($full_name): void
    {
        $this->full_name = $full_name;
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
    public function setEmail($email): void
    {
        $this->email = $email;
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
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getContactNumber()
    {
        return $this->contact_number;
    }

    /**
     * @param mixed $contact_number
     */
    public function setContactNumber($contact_number): void
    {
        $this->contact_number = $contact_number;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }
}
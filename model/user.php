<?php


class User
{
    private $username;
    private $full_name;
    private $email;
    private $password;
    private $contact_number;
    private $address;
    // type of user
    // 0: participant; 1: member; 2: sponsor
    private $type_of_user;

    /**
     * User constructor.
     * @param $username
     * @param $full_name
     * @param $email
     * @param $password
     * @param $contact_number
     * @param $address
     * @param $type_of_user
     */
    public function __construct($username, $full_name, $email, $password, $contact_number, $address, $type_of_user)
    {
        $this->username = $username;
        $this->full_name = $full_name;
        $this->email = $email;
        $this->password = $password;
        $this->contact_number = $contact_number;
        $this->address = $address;
        $this->type_of_user = $type_of_user;
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

    /**
     * @return mixed
     */
    public function getTypeOfUser()
    {
        return $this->type_of_user;
    }

    /**
     * @param mixed $type_of_user
     */
    public function setTypeOfUser($type_of_user): void
    {
        $this->type_of_user = $type_of_user;
    }
}
<?php

namespace Model\Entity;

use Model\Entity\Interfaces\EntityInterface;

class User extends Entity implements EntityInterface {
    private ?string $username;
    private ?string $mail;
    private ?string $pass;
    private ?string $licence;
    private ?int $check;
    private ?int $validation;
    private ?string $key;
    private ?string $name;
    private ?string $surname;
    private ?string $phone;
    private ?Role $role;

    /**
     * User constructor.
     * @param int|null $id
     * @param string|null $username
     * @param string|null $mail
     * @param string|null $pass
     * @param string|null $licence
     * @param int|null $check
     * @param int|null $validation
     * @param string|null $key
     * @param string|null $name
     * @param string|null $surname
     * @param string|null $phone
     * @param Role|null $role
     */
    public function __construct( int $id = null, string $username = null, string $mail = null, string $pass = null,
                                string $licence = null, int $check = null,int $validation= null,string $key = null,
                                string $name = null,string $surname =null, string $phone = null, Role $role = null)    {
        parent::__construct($id);
        $this->username = $username;
        $this->mail = $mail;
        $this->pass = $pass;
        $this->licence = $licence;
        $this->role = $role;
        $this->check = $check;
        $this->validation = $validation;
        $this->key = $key;
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
    }

    /**
     * get the Check
     * @return int|null
     */
    public function getCheck(): ?int    {
        return $this->check;
    }

    /**
     * set the Check
     * @param int|null $check
     * @return User
     */
    public function setCheck(?int $check): User    {
        $this->check = $check;
        return $this;
    }

    /**
     * get the Validation
     * @return int|null
     */
    public function getValidation(): ?int    {
        return $this->validation;
    }

    /**
     * set the Validation
     * @param int|null $validation
     * @return User
     */
    public function setValidation(?int $validation): User    {
        $this->validation = $validation;
        return $this;
    }

    /**
     * get the Key
     * @return string|null
     */
    public function getKey(): ?string    {
        return $this->key;
    }

    /**
     * set the Key
     * @param string|null $key
     * @return User
     */
    public function setKey(?string $key): User    {
        $this->key = $key;
        return $this;
    }

    /**
     * get the Username
     * @return string
     */
    public function getUsername(): string    {
        return $this->username;
    }

    /**
     * set the Username
     * @param string $username
     * @return User
     */
    public function setUsername(string $username): User    {
        $this->username = $username;
        return $this;
    }

    /**
     * get the Mail
     * @return string
     */
    public function getMail(): ?string    {
        return $this->mail;
    }

    /**
     * set the Mail
     * @param string $mail
     * @return User
     */
    public function setMail(string $mail): User    {
        $this->mail = $mail;
        return $this;
    }

    /**
     * get the Pass
     * @return string
     */
    public function getPass(): string    {
        return $this->pass;
    }

    /**
     * set the Pass
     * @param string $pass
     * @return User
     */
    public function setPass(string $pass): User    {
        $this->pass = $pass;
        return $this;
    }

    /**
     * get the Role
     * @return Role
     */
    public function getRole(): Role   {
        return $this->role;
    }

    /**
     * set the Role
     * @param Role $role
     * @return User
     */
    public function setRole(Role $role): User    {
        $this->role = $role;
        return $this;
    }

    /**
     * get the Licence
     * @return string|null
     */
    public function getLicence(): ?string    {
        return $this->licence;
    }

    /**
     * set the Licence
     * @param string|null $licence
     * @return User
     */
    public function setLicence(?string $licence): User    {
        $this->licence = $licence;
        return $this;
    }

    /**
     * get the Name
     * @return string|null
     */
    public function getName(): ?string    {
        return $this->name;
    }

    /**
     * set the Name
     * @param string|null $name
     * @return User
     */
    public function setName(?string $name): User    {
        $this->name = $name;
        return $this;
    }

    /**
     * get the Surname
     * @return string|null
     */
    public function getSurname(): ?string    {
        return $this->surname;
    }

    /**
     * set the Surname
     * @param string|null $surname
     * @return User
     */
    public function setSurname(?string $surname): User    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * get the Phone
     * @return string|null
     */
    public function getPhone(): ?string    {
        return $this->phone;
    }

    /**
     * set the Phone
     * @param string|null $phone
     * @return User
     */
    public function setPhone(?string $phone): User    {
        $this->phone = $phone;
        return $this;
    }



    /**
     * return the value in array less pass for security
     * @return array
     */
    public function getAllData() : array {
        $array['id'] = $this->getId();
        $array['username'] = $this->getUsername();
        $array['mail'] = $this->getMail();
        $array['pass'] = '';
        $array['licence'] = $this->getLicence();
        $array['check'] = $this->getCheck();
        $array['validation_key'] = $this->getKey();
        $array['validation'] = $this->getValidation();
        $array['name'] = $this->getName();
        $array['surname'] = $this->getSurname();
        $array['phone'] = $this->getPhone();
        $array['role'] = $this->getRole()->getAllData();
        return $array;
    }

}
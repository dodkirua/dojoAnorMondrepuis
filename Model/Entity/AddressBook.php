<?php


namespace Model\Entity;

use Model\Entity\Interfaces\EntityInterface;
use Model\Entity\User;
use Model\Entity\Address;

class AddressBook extends Entity implements EntityInterface{
    private ?User $user;
    private ?Address $address;

    public function __construct(int $id = null ,User $user = null, Address $address = null){
        parent::__construct($id);
        $this->user = $user;
        $this->address = $address;
    }

    /**
     * get the User
     * @return User|null
     */
    public function getUser(): ?User    {
        return $this->user;
    }

    /**
     * set the User
     * @param User|null $user
     * @return AddressBook
     */
    public function setUser(?User $user): AddressBook    {
        $this->user = $user;
        return $this;
    }

    /**
     * get the Address
     * @return Address|null
     */
    public function getAddress(): ?Address    {
        return $this->address;
    }

    /**
     * set the Address
     * @param Address|null $address
     * @return AddressBook
     */
    public function setAddress(?Address $address): AddressBook    {
        $this->address = $address;
        return $this;
    }

    /**
     * return all the value of object
     * @return array
     */
    public function getAllData(): array    {
        $array['id'] = $this->getId();
        $array['user'] = $this->getUser()->getAllData();
        $array['address'] = $this->getAddress()->getAllData();
        return $array;
    }
}
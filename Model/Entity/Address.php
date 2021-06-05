<?php


namespace Model\Entity;

use Model\Entity\Interfaces\EntityInterface;

class Address extends Entity implements EntityInterface{
    private ?int $num;
    private ?string $street;
    private ?int $zip;
    private ?string $city;
    private ?string $country;
    private ?string $add;

    public function __construct(int $id = null ,int $num = null , string $street = null , int $zip = null ,
                                string $city = null , string $country = null ,string $add = null ) {
        parent::__construct($id);
        $this->num = $num;
        $this->street = $street;
        $this->zip = $zip;
        $this->city = $city;
        $this->country = $country;
        $this->add = $add;
    }

    /**
     * get the Num
     * @return int|null
     */
    public function getNum(): ?int    {
        return $this->num;
    }

    /**
     * set the Num
     * @param int|null $num
     * @return Address
     */
    public function setNum(?int $num): Address    {
        $this->num = $num;
        return $this;
    }

    /**
     * get the Street
     * @return string|null
     */
    public function getStreet(): ?string    {
        return $this->street;
    }

    /**
     * set the Street
     * @param string|null $street
     * @return Address
     */
    public function setStreet(?string $street): Address    {
        $this->street = $street;
        return $this;
    }

    /**
     * get the Zip
     * @return int|null
     */
    public function getZip(): ?int    {
        return $this->zip;
    }

    /**
     * set the Zip
     * @param int|null $zip
     * @return Address
     */
    public function setZip(?int $zip): Address    {
        $this->zip = $zip;
        return $this;
    }

    /**
     * get the City
     * @return string|null
     */
    public function getCity(): ?string    {
        return $this->city;
    }

    /**
     * set the City
     * @param string|null $city
     * @return Address
     */
    public function setCity(?string $city): Address    {
        $this->city = $city;
        return $this;
    }

    /**
     * get the Country
     * @return string|null
     */
    public function getCountry(): ?string    {
        return $this->country;
    }

    /**
     * set the Country
     * @param string|null $country
     * @return Address
     */
    public function setCountry(?string $country): Address    {
        $this->country = $country;
        return $this;
    }

    /**
     * get the Add
     * @return string|null
     */
    public function getAdd(): ?string    {
        return $this->add;
    }

    /**
     * set the Add
     * @param string|null $add
     * @return Address
     */
    public function setAdd(?string $add): Address    {
        $this->add = $add;
        return $this;
    }

    /**
     * return all the value of object
     * @return array
     */
    public function getAllData(): array    {
        $array['id'] = $this->getId();
        $array['num'] = $this->getNum();
        $array['street'] = $this->getStreet();
        $array['zip_code'] = $this->getZip();
        $array['city'] = $this->getCity();
        $array['country'] = $this->getCountry();
        $array['add'] = $this->getAdd();
        return $array;
    }
}
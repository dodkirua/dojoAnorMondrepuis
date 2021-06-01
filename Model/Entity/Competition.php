<?php


namespace Model\Entity;

use Model\Entity\Interfaces\EntityInterface;
use Model\Entity\Address;
use Model\Entity\CategoryAge;

class Competition extends Entity implements EntityInterface{
    private ?string $description;
    private ?int $date;
    private ?int $hour;
    private ?Address $address;
    private ?CategoryAge $categoryAge;

    /**
     * Competition constructor.
     * @param string|null $description
     * @param int|null $date
     * @param int|null $hour
     * @param Address|null $address
     * @param CategoryAge|null $categoryAge
     */
    public function __construct(int $id = null, string $description = null , int $date = null, int $hour = null,
                                Address $address = null, CategoryAge $categoryAge = null)    {
        parent::__construct($id);
        $this->description = $description;
        $this->date = $date;
        $this->hour = $hour;
        $this->address = $address;
        $this->categoryAge = $categoryAge;
    }

    /**
     * get the Description
     * @return string|null
     */
    public function getDescription(): ?string    {
        return $this->description;
    }

    /**
     * set the Description
     * @param string|null $description
     * @return Competition
     */
    public function setDescription(?string $description): Competition    {
        $this->description = $description;
        return $this;
    }

    /**
     * get the Date
     * @return int|null
     */
    public function getDate(): ?int    {
        return $this->date;
    }

    /**
     * set the Date
     * @param int|null $date
     * @return Competition
     */
    public function setDate(?int $date): Competition    {
        $this->date = $date;
        return $this;
    }

    /**
     * get the Hour
     * @return int|null
     */
    public function getHour(): ?int    {
        return $this->hour;
    }

    /**
     * set the Hour
     * @param int|null $hour
     * @return Competition
     */
    public function setHour(?int $hour): Competition    {
        $this->hour = $hour;
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
     * @return Competition
     */
    public function setAddress(?Address $address): Competition    {
        $this->address = $address;
        return $this;
    }

    /**
     * get the CategoryAge
     * @return CategoryAge|null
     */
    public function getCategoryAge(): ?CategoryAge    {
        return $this->categoryAge;
    }

    /**
     * set the CategoryAge
     * @param CategoryAge|null $categoryAge
     * @return Competition
     */
    public function setCategoryAge(?CategoryAge $categoryAge): Competition    {
        $this->categoryAge = $categoryAge;
        return $this;
    }

    /**
     * return all the value of object
     * @return array
     */
    public function getAllData(): array    {
       $array['id'] = $this->getId();
       $array['description'] = $this->getDescription();
       $array['date'] = $this->getDate();
       $array['hour'] = $this->getHour();
       $array['address'] = $this->getAddress()->getAllData();
       $array['category_age'] = $this->getCategoryAge()->getAllData();

       return $array;
    }
}
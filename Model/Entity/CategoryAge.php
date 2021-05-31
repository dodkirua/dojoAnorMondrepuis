<?php


namespace Model\Entity;

use Model\Entity\Interfaces\EntityInterface;

class CategoryAge extends Entity implements EntityInterface{
    private ?string $name;
    private ?int $year1;
    private ?int $year2;

    public function __construct(int $id = null, string $name = null, int $year1 = null, int $year2 = null) {
        parent::__construct($id);
        $this->name = $name;
        $this->year1 = $year1;
        $this->year2 = $year2;
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
     * @return CategoryAge
     */
    public function setName(?string $name): CategoryAge    {
        $this->name = $name;
        return $this;
    }

    /**
     * get the Year1
     * @return int|null
     */
    public function getYear1(): ?int    {
        return $this->year1;
    }

    /**
     * set the Year1
     * @param int|null $year1
     * @return CategoryAge
     */
    public function setYear1(?int $year1): CategoryAge    {
        $this->year1 = $year1;
        return $this;
    }

    /**
     * get the Year2
     * @return int|null
     */
    public function getYear2(): ?int    {
        return $this->year2;
    }

    /**
     * set the Year2
     * @param int|null $year2
     * @return CategoryAge
     */
    public function setYear2(?int $year2): CategoryAge    {
        $this->year2 = $year2;
        return $this;
    }

    /**
     * return all the value of object
     * @return array
     */
    public function getAllData(): array    {
        $array['id'] = $this->getId();
        $array['name'] = $this->getName();
        $array['year1'] = $this->getYear1();
        $array['year2'] = $this->getYear2();
        return $array;
    }
}
<?php


namespace Model\Entity;

use Model\Entity\Interfaces\EntityInterface;

class Dan extends Entity implements EntityInterface{
    private ?string $description;

    /**
     * Dan constructor.
     * @param string|null $description
     */
    public function __construct(int $id = null,string $description= null)    {
        parent::__construct($id);
        $this->description = $description;
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
     * @return Dan
     */
    public function setDescription(?string $description): Dan    {
        $this->description = $description;
        return $this;
    }

    /**
     * return all the value of object
     * @return array
     */
    public function getAllData(): array    {
        $array['id'] = $this->getId();
        $array['description'] = $this->getDescription();
        return $array;
    }
}
<?php


namespace Model\Entity;

use Model\Entity\Interfaces\EntityInterface;

class Group extends Entity implements EntityInterface{
    private ?string $name;
    private ?int $duration;

    public function __construct(int $id = null, string $name = null, int $duration = null)    {
        parent::__construct($id);
        $this->name = $name;
        $this->duration = $duration;
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
     * @return Group
     */
    public function setName(?string $name): Group    {
        $this->name = $name;
        return $this;
    }

    /**
     * get the Duration
     * @return int|null
     */
    public function getDuration(): ?int    {
        return $this->duration;
    }

    /**
     * set the Duration
     * @param int|null $duration
     * @return Group
     */
    public function setDuration(?int $duration): Group    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * return all the value of object
     * @return array
     */
    public function getAllData(): array    {
        $array['id'] = $this->getId();
        $array['name'] = $this->getName();
        $array['duration'] = $this->getDuration();
        return $array;
    }
}
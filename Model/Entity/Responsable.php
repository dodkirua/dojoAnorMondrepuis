<?php


namespace Model\Entity;

use Model\Entity\Interfaces\EntityInterface;

use Model\Entity\User;

class Responsable extends Entity implements EntityInterface {

    private ?User $child;
    private ?User $parent;

    public function __construct(int $id = null, ?User $child = null, ?User $parent = null)    {
        parent::__construct($id);
        $this->parent = $parent;
        $this->child = $child;
    }

    /**
     * get the Child
     * @return User|null
     */
    public function getChild(): ?User
    {
        return $this->child;
    }

    /**
     * set the Child
     * @param User|null $child
     * @return Responsable
     */
    public function setChild(?User $child): Responsable
    {
        $this->child = $child;
        return $this;
    }

    /**
     * get the Parent
     * @return User|null
     */
    public function getParent(): ?User
    {
        return $this->parent;
    }

    /**
     * set the Parent
     * @param User|null $parent
     * @return Responsable
     */
    public function setParent(?User $parent): Responsable
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * return all the value of object
     * @return array
     */
    public function getAllData(): array    {
        $array['id'] = $this->getId();
        $array['child'] = $this->getChild()->getAllData();
        $array['parent'] = $this->getParent()->getAllData();
        return $array;
    }
}
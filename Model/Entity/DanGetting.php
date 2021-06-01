<?php


namespace Model\Entity;

use Model\Entity\Interfaces\EntityInterface;

class DanGetting extends Entity implements EntityInterface{
    private ?int $date;
    private ?Dan $dan;
    Private ?User $user;

    public function __construct(int $id = null, int $date = null, Dan $dan = null, User $user = null)   {
        parent::__construct($id);
        $this->date = $date;
        $this->dan = $dan;
        $this->user = $user;
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
     * @return DanGetting
     */
    public function setDate(?int $date): DanGetting    {
        $this->date = $date;
        return $this;
    }

    /**
     * get the Dan
     * @return Dan|null
     */
    public function getDan(): ?Dan    {
        return $this->dan;
    }

    /**
     * set the Dan
     * @param Dan|null $dan
     * @return DanGetting
     */
    public function setDan(?Dan $dan): DanGetting    {
        $this->dan = $dan;
        return $this;
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
     * @return DanGetting
     */
    public function setUser(?User $user): DanGetting    {
        $this->user = $user;
        return $this;
    }

    /**
     * return all the value of object
     * @return array
     */
    public function getAllData(): array    {
        $array['id'] = $this->getId();
        $array['date'] = $this->getDate();
        $array['dan'] = $this->getDan()->getAllData();
        $array['user'] = $this->getUser()->getAllData();

        return $array;
    }
}
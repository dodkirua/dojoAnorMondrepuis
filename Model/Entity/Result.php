<?php


namespace Model\Entity;

use Model\Entity\Interfaces\EntityInterface;

class Result extends Entity implements EntityInterface{
    private ?int $position;
    private ?User $user;
    private ?Competition $competition;

    /**
     * Result constructor.
     * @param int|null $id
     * @param int|null $position
     * @param User|null $user
     * @param Competition|null $competition
     */
    public function __construct(int $id = null, int $position= null, User $user= null, ?Competition $competition= null)    {

        $this->position = $position;
        $this->user = $user;
        $this->competition = $competition;
    }

    /**
     * get the Position
     * @return int|null
     */
    public function getPosition(): ?int    {
        return $this->position;
    }

    /**
     * set the Position
     * @param int|null $position
     * @return Result
     */
    public function setPosition(?int $position): Result    {
        $this->position = $position;
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
     * @return Result
     */
    public function setUser(?User $user): Result    {
        $this->user = $user;
        return $this;
    }

    /**
     * get the Competition
     * @return Competition|null
     */
    public function getCompetition(): ?Competition    {
        return $this->competition;
    }

    /**
     * set the Competition
     * @param Competition|null $competition
     * @return Result
     */
    public function setCompetition(?Competition $competition): Result    {
        $this->competition = $competition;
        return $this;
    }

    /**
     * return all the value of object
     * @return array
     */
    public function getAllData(): array    {
        $array['id'] = $this->getId();
        $array['position'] = $this->getPosition();
        $array['user'] = $this->getUser()->getAllData();
        $array['competition'] = $this->getCompetition()->getAllData();

        return $array;
    }
}
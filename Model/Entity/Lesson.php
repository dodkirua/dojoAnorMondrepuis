<?php


namespace Model\Entity;

use Model\Entity\Interfaces\EntityInterface;
use Model\Entity\Group;

class Lesson extends Entity implements EntityInterface{
    private ?int $date;
    private ?int $hour;
    private ?int $duration;
    private ?Group $group;

    public function __construct(int $id = null, int $date = null, int $hour = null, int $duration = null,
                                Group $group = null )    {
        parent::__construct($id);
        $this->date = $date;
        $this->hour = $hour;
        $this->duration = $duration;
        $this->group = $group;
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
     * @return Lesson
     */
    public function setDate(?int $date): Lesson    {
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
     * @return Lesson
     */
    public function setHour(?int $hour): Lesson    {
        $this->hour = $hour;
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
     * @return Lesson
     */
    public function setDuration(?int $duration): Lesson    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * get the Group
     * @return Group|null
     */
    public function getGroup(): ?Group    {
        return $this->group;
    }

    /**
     * set the Group
     * @param Group|null $group
     * @return Lesson
     */
    public function setGroup(?Group $group): Lesson    {
        $this->group = $group;
        return $this;
    }

    /**
     * return all the value of object
     * @return array
     */
    public function getAllData(): array    {
        $array['id'] = $this->getId();
        $array['date'] = $this->getDate();
        $array['hour'] = $this->getHour();
        $array['duration'] = $this->getDuration();
        $array['group'] = $this->getGroup()->getAllData();
        return $array;
    }
}
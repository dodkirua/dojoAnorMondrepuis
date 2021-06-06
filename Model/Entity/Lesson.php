<?php


namespace Model\Entity;

use Model\Entity\Interfaces\EntityInterface;
use Model\Entity\Group;

class Lesson extends Entity implements EntityInterface{
    private ?int $date;
    private ?bool $checked;

    private ?Group $group;

    public function __construct(int $id = null, int $date = null, bool $checked = false, Group $group = null )    {
        parent::__construct($id);
        $this->date = $date;
        $this->checked = $checked;
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
     * get checked
     * @return bool|null
     */
    public function getChecked(): ?bool    {
        return $this->checked;
    }

    /**
     * set checked
     * @param bool|null $hour
     * @return Lesson
     */
    public function setChecked(?bool $hour): Lesson    {
        $this->checked = $hour;
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
        $array['checked'] = $this->getChecked();
        $array['group'] = $this->getGroup()->getAllData();
        return $array;
    }
}
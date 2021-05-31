<?php


namespace Model\Entity;

use Model\Entity\Interfaces\EntityInterface;
use Model\Entity\CategoryAge;
use Model\Entity\Group;

class GroupCategory extends Entity implements EntityInterface{
    private ?CategoryAge $categoryAge;
    private ?Group  $group;

    public function __construct(int $id = null, CategoryAge $categoryAge= null, Group $group= null)    {
        parent::__construct($id);
        $this->categoryAge =$categoryAge;
        $this->group = $group;
    }

    /**
     * get the CategoryAge
     * @return CategoryAge|null
     */
    public function getCategoryAge(): ?CategoryAge
    {
        return $this->categoryAge;
    }

    /**
     * set the CategoryAge
     * @param CategoryAge|null $categoryAge
     * @return GroupCategory
     */
    public function setCategoryAge(?CategoryAge $categoryAge): GroupCategory
    {
        $this->categoryAge = $categoryAge;
        return $this;
    }

    /**
     * get the Group
     * @return Group|null
     */
    public function getGroup(): ?Group
    {
        return $this->group;
    }

    /**
     * set the Group
     * @param Group|null $group
     * @return GroupCategory
     */
    public function setGroup(?Group $group): GroupCategory
    {
        $this->group = $group;
        return $this;
    }

    /**
     * return all the value of object
     * @return array
     */
    public function getAllData(): array    {
        $array['id'] = $this->getId();
        $array['category_age'] = $this->getGroup()->getAllData();
        $array['group'] = $this->getGroup()->getAllData();
        return $array;
    }
}
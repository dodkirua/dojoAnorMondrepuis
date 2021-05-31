<?php


namespace Model;

use Model\Entity\Interfaces\EntityInterface;
use Model\Entity\User;
use Model\Entity\CategoryAge;

class CategoryAgeArray extends Entity\Entity implements EntityInterface{
    private ?User $user;
    private ?CategoryAge $categoryAge;

    public function __construct(int $id = null, User $user = null, CategoryAge $categoryAge = null)    {
        parent::__construct($id);
        $this->user = $user;
        $this->categoryAge = $categoryAge;
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
     * @return CategoryAgeArray
     */
    public function setUser(?User $user): CategoryAgeArray    {
        $this->user = $user;
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
     * @return CategoryAgeArray
     */
    public function setCategoryAge(?CategoryAge $categoryAge): CategoryAgeArray    {
        $this->categoryAge = $categoryAge;
        return $this;
    }

    /**
     * return all the value of object
     * @return array
     */
    public function getAllData(): array    {
        $array['id'] = $this->getId();
        $array['user'] = $this->getUser()->getAllData();
        $array['category_age'] = $this->getCategoryAge()->getAllData();
        return $array;
    }
}
<?php


namespace Model\Entity;

use Model\Entity\User;
use Model\Entity\Lesson;

class Attendance extends Entity implements Interfaces\EntityInterface{

    private ?User $user;
    private ?Lesson $lesson;

    /**
     * Attendance constructor.
     * @param User|null $user
     * @param Lesson|null $lesson
     */
    public function __construct(int $id = null, User $user = null, Lesson $lesson = null)    {
        parent::__construct($id);
        $this->user = $user;
        $this->lesson = $lesson;
    }


    /**
     * get the User
     * @return user |null
     */
    public function getUser(): ?user    {
        return $this->user;
    }

    /**
     * set the User
     * @param user |null $user
     * @return Attendance
     */
    public function setUser(?user $user): Attendance    {
        $this->user = $user;
        return $this;
    }

    /**
     * get the Lesson
     * @return Lesson|null
     */
    public function getLesson(): ?Lesson    {
        return $this->lesson;
    }

    /**
     * set the Lesson
     * @param Lesson|null $lesson
     * @return Attendance
     */
    public function setLesson(?Lesson $lesson): Attendance    {
        $this->lesson = $lesson;
        return $this;
    }

    /**
     * return all the value of object
     * @return array
     */
    public function getAllData(): array    {
        $array['id'] = $this->getId();
        $array['user_id'] = $this->getUser()->getAllData();
        $array['lesson_id'] = $this->getLesson()->getAllData();
        return $array;
    }
}
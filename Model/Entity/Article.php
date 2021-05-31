<?php


namespace Model\Entity;

use Model\Entity\Interfaces\EntityInterface;

class Article extends Entity implements EntityInterface {

    private ?string $title;
    private ?string $content;
    private ?int $date;
    private ?string $image;
    private ?User $user;

    /**
     * Article constructor.
     * @param int|null $id
     * @param string|null $title
     * @param string|null $content
     * @param int|null $date
     * @param string|null $image
     * @param User|null $user
     */
    public function __construct(int $id = null, string $title = null, string $content  = null, int $date = null,string $image = null, User $user = null )    {
        parent::__construct($id);
        $this->title = $title;
        $this->content = $content;
        $this->date = $date;
        $this->image = $image;
        $this->user = $user;
    }

    /**
     * get the Title
     * @return string|null
     */
    public function getTitle(): ?string    {
        return $this->title;
    }

    /**
     * set the Title
     * @param string|null $title
     * @return Article
     */
    public function setTitle(?string $title): Article    {
        $this->title = $title;
        return $this;
    }

    /**
     * get the Content
     * @return string
     */
    public function getContent(): string    {
        return $this->content;
    }

    /**
     * set the Content
     * @param string $content
     * @return Article
     */
    public function setContent(string $content): Article    {
        $this->content = $content;
        return $this;
    }

    /**
     * get the Date
     * @return int
     */
    public function getDate(): int    {
        return $this->date;
    }

    /**
     * set the Date
     * @param int $date
     * @return Article
     */
    public function setDate(int $date): Article    {
        $this->date = $date;
        return $this;
    }

    /**
     * get the Image
     * @return string|null
     */
    public function getImage(): ?string    {
        return $this->image;
    }

    /**
     * set the Image
     * @param string|null $image
     * @return Article
     */
    public function setImage(?string $image): Article    {
        $this->image = $image;
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
     * @return Article
     */
    public function setUser(User $user): Article    {
        $this->user = $user;
        return $this;
    }

    /**
     * return the value in array
     * @return array
     */
    public function getAllData() : array {
        $array['id'] = $this->getId();
        $array['title'] = $this->getTitle();
        $array['content'] = $this->getContent();
        $array['date'] = $this->getDate();
        $array['image'] = $this->getImage();
        $array['user'] = $this->getUser()->getAllData();
        return $array;
    }
}
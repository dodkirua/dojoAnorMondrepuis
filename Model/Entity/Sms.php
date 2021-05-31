<?php


namespace Model\Entity;

use Model\Entity\Interfaces\EntityInterface;

class Sms extends Entity implements EntityInterface{
    private ?string $title;
    private ?string $content;

    public function __construct(int $id = null, string $title = null, string $content = null)    {
        parent::__construct($id);
        $this->title = $title;
        $this->content = $content;
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
     * @return Sms
     */
    public function setTitle(?string $title): Sms    {
        $this->title = $title;
        return $this;
    }

    /**
     * get the Content
     * @return string|null
     */
    public function getContent(): ?string    {
        return $this->content;
    }

    /**
     * set the Content
     * @param string|null $content
     * @return Sms
     */
    public function setContent(?string $content): Sms    {
        $this->content = $content;
        return $this;
    }

    /**
     * return all the value of object
     * @return array
     */
    public function getAllData(): array    {
        $array['id'] = $this->getId();
        $array['title'] = $this->getTitle();
        $array['content'] = $this->getContent();
        return $array;
    }
}
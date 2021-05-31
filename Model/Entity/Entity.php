<?php


namespace Model\Entity;


class Entity{

    private ?int $id;

    public function __construct(int $id = null){
        $this->id = $id;
    }
    /**
     * get the Id
     * @return int|null
     */
    public function getId(): ?int    {
        return $this->id;
    }

    /**
     * set the Id
     * @param int|null $id
     * @return self
     */
    public function setId(?int $id): self   {
        $this->id = $id;
        return $this;
    }
}
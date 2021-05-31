<?php

namespace Model\Manager;

use Model\DB;
use Model\Entity\Role;

class RoleManager extends Manager {


    /**
     * return a Role by id
     * @param int $id
     * @return Role|null
     */
    public function getById(int $id): ?Role {

        $request = DB::getInstance()->prepare("SELECT * FROM role where id = :id");
        $request->bindValue(":id",$id);
        $result = $request->execute();

        if ($result){
            $data = $request->fetch();
            if ($data) {
                return new Role($data['id'], $data['name']);
            }
        }
        return null;
    }

    /**
     * return a array with all the role
     * @return array
     */
    public function getAll() : array {
        $classes = [];
        $request = DB::getInstance()->prepare("SELECT * FROM role");
        $result = $request->execute();

        if ($result){
            $data = $request->fetchAll();
            if ($data) {
                foreach ($data as $item) {
                    $class = new Role(intval($item['id']),$item['name']);
                    $classes[] = $class;
                }
            }
        }
        return $classes;
    }

    /**
     * update on DB by id
     * @param int $id
     * @param string|null $name
     * @return bool
     */
    public function update(int $id, string $name = null): bool    {
        // modify the not null values
        if (is_null($name)){
            $data = $this->getById($id);
            $name = $data->getName();
        }
        $request = DB::getInstance()->prepare("UPDATE role 
                    SET name = :name 
                    WHERE id = :id
                    ");
        $request->bindValue(":id",$id);
        $request->bindValue(":name",mb_strtolower($name));
        return $request->execute();
    }

    /**
     * insert data in DB
     * @param string $name
     * @return bool
     */
    public function add(string $name) : bool {
        $request = DB::getInstance()->prepare("INSERT INTO role 
                    (name)
                    VALUES (:name)
                    ");
        $request->bindValue(":name",mb_strtolower($name));
        return $request->execute();
    }

    public function delete(int $id) : bool {
        if ($id > 4) {
            $request = DB::getInstance()->prepare("DELETE FROM role WHERE id = :id");
            $request->bindValue(':id',$id);
            return $request->execute();
        }
        return false;
    }
}
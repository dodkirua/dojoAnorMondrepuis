<?php


namespace Model\Manager;

use Model\DB;
use PDOStatement;
use Model\Entity\Group;

class GroupManager extends Manager{
    /**
     * return a Group by id
     * @param int $id
     * @return Group|null
     */
    public function getById (int $id) : ?Group{
        $request = DB::getInstance()->prepare("SELECT * FROM `group` where id = :id");
        $request->bindValue(":id",$id);
        return $this->getOne($request);
    }

    /**
     * get a Group by title
     * @param string $name
     * @return Group|null
     */
    public function getByName(string $name) : ?Group{
        $request = DB::getInstance()->prepare("SELECT * FROM `group` where name = :name");
        $request->bindValue(":name",$name);
        return $this->getOne($request);
    }

    /**
     * return a array with all the group
     * @return array
     */
    public function getAll() : array {
        $array = [];
        $request = DB::getInstance()->prepare("SELECT * FROM `group`");
        $result = $request->execute();

        if ($result){
            $data = $request->fetchAll();
            if ($data) {
                foreach ($data as $datum) {
                    $item = new Group(intval($datum['id']), $datum['name'], $datum['duration']);
                    $array[] = $item;
                }
            }
        }
        return $array;
    }

    /**
     * update on DB with id
     * @param int $id
     * @param string|null $name
     * @param int|null $duration
     * @return bool
     */
    public function update(int $id, string $name = null,int $duration = null) : bool{

        if (is_null($name)) {
            $data = $this->getById($id);
            $name = $data->getName();
        }

        $request = DB::getInstance()->prepare("UPDATE `group`
                    SET name = :name, duration = :duration
                    WHERE id= :id
                    ");
        $request->bindValue(":id",$id);
        $request->bindValue(":name",mb_strtolower($name));
        $request->bindValue(":duration",$duration);

        return $request->execute();
    }

    /**
     * insert group in DB
     * @param string $name
     * @param int $duration
     * @return bool
     */
    public function add(string $name, int $duration) : bool {
        $request = DB::getInstance()->prepare("INSERT INTO `group` 
        (name,duration)
        VALUES (:name, :duration)
        ");
        $request->bindValue(":name",mb_strtolower($name));
        $request->bindValue(":duration",$duration);
        return $request->execute();
    }

    /**
     * delete group by id
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool {
        //delete the lesson
        $manager = new LessonManager();
        $array = $manager->getAllByGroup($id);
        foreach ($array as $item) {
            $manager->delete($item['id']);
        }
        //delete the group_category
        $manager = new GroupCategoryManager();
        $array = $manager->getAllByGroup($id);
        foreach ($array as $item) {
            $manager->delete($item['id']);
        }

        $request = DB::getInstance()->prepare("DELETE FROM `group` WHERE id = :id");
        $request->bindValue(':id',$id);
        return $request->execute();
    }


    /**
     * private request for the getBy
     * @param PDOStatement $request
     * @return Group|null
     */
    private function getOne(PDOStatement $request ) : ?Group {
        $request->execute();
        $data = $request->fetch();
        if ($data) {
            return new Group (intval($data['id']), $data['name'], $data['duration']);
        }
        return null;
    }
}
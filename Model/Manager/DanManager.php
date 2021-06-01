<?php


namespace Model\Manager;
use Model\DB;
use PDOStatement;
use Model\Entity\Dan;

class DanManager extends Manager{
    /**
     * return a Dan by id
     * @param int $id
     * @return Dan|null
     */
    public function getById (int $id) : ?Dan{
        $request = DB::getInstance()->prepare("SELECT * FROM `dan` where id = :id");
        $request->bindValue(":id",$id);
        return $this->getOne($request);
    }


    /**
     * return a array with all the dan
     * @return array
     */
    public function getAll() : array {
        $array = [];
        $request = DB::getInstance()->prepare("SELECT * FROM `dan`");
        $result = $request->execute();

        if ($result){
            $data = $request->fetchAll();
            if ($data) {
                foreach ($data as $datum) {
                    $item = new Dan(intval($datum['id']), $datum['description']);
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
    public function update(int $id, string $description = null) : bool{

        if (is_null($description)) {
            $data = $this->getById($id);
            $description = $data->getDescription();
        }

        $request = DB::getInstance()->prepare("UPDATE `dan`
                    SET  description = :desc
                    WHERE id= :id
                    ");
        $request->bindValue(":id",$id);
        $request->bindValue(":desc",mb_strtolower($description));

        return $request->execute();
    }

    /**
     * insert dan in DB
     * @param string $name
     * @param int $duration
     * @return bool
     */
    public function add(string $name, int $duration) : bool {
        $request = DB::getInstance()->prepare("INSERT INTO `dan` 
        (description)
        VALUES (:desc)
        ");
        $request->bindValue(":desc",mb_strtolower($description));
        return $request->execute();
    }

    /**
     * delete dan by id
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool {
        //delete the lesson
        $manager = new DanGettingManager();
        $array = $manager->getAllByDan($id);
        foreach ($array as $item) {
            $manager->delete($item['id']);
        }

        $request = DB::getInstance()->prepare("DELETE FROM `dan` WHERE id = :id");
        $request->bindValue(':id',$id);
        return $request->execute();
    }


    /**
     * private request for the getBy
     * @param PDOStatement $request
     * @return Dan|null
     */
    private function getOne(PDOStatement $request ) : ?Dan {
        $request->execute();
        $data = $request->fetch();
        if ($data) {
            return new Dan (intval($data['id']), $data['description']);
        }
        return null;
    }
}
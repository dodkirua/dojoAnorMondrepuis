<?php


namespace Model\Manager;

use Model\DB;
use PDOStatement;
use Model\Entity\CategoryAge;

class CategoryAgeManager extends Manager{
    /**
     * return a CategoryAge by id
     * @param int $id
     * @return CategoryAge|null
     */
    public function getById (int $id) : ?CategoryAge{
        $request = DB::getInstance()->prepare("SELECT * FROM category_age where id = :id");
        $request->bindValue(":id",$id);
        return $this->getOne($request);
    }

    /**
     * return a array with all the CategoryAge
     * @return array
     */
    public function getAll() : array {
        $array = [];
        $request = DB::getInstance()->prepare("SELECT * FROM category_age");
        $result = $request->execute();

        if ($result){
            $data = $request->fetchAll();
            if ($data) {
                foreach ($data as $datum) {
                    $item = new CategoryAge(intval($datum['id']), $datum['name'], intval($datum['year1']),
                        intval($datum['year2']));
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
     * @param int|null $year1
     * @param int|null $year2
     * @return bool
     */
    public function update(int $id, string $name = null, int $year1 = null, int $year2 = null) : bool{
        if (is_null($name) || is_null($year1) || is_null($year2)) {
            $data = $this->getById($id);
            if (is_null($name)) {
                $name = $data->getName();
            }
            if (is_null($year1)) {
                $year1 = $data->getYear1();
            }
            if (is_null($year2)) {
                $year2 = $data->getYear2();
            }
        }

        $request = DB::getInstance()->prepare("UPDATE category_age
                    SET name = :name, year1 = :y1, year2 = :y2
                    WHERE id= :id
                    ");
        $request->bindValue(":id",$id);
        $request->bindValue(":name",mb_strtolower($name));
        $request->bindValue(":y1",$year1);
        $request->bindValue(":y2",$year2);

        return $request->execute();
    }

    /**
     * insert CategoryAge in DB
     * @param string $name
     * @param int $year1
     * @param int $year2
     * @return bool
     */
    public function add(string $name, int $year1, int $year2 ) : bool {
        $request = DB::getInstance()->prepare("INSERT INTO category_age
        (name, year1, year2)
        VALUES (:name, :y1, :y2)
        ");
        $request->bindValue(":name",mb_strtolower($name));
        $request->bindValue(":y1",$year1);
        $request->bindValue(":y2",$year2);

        return $request->execute();
    }

    /**
     * delete CategoryAge by id
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool {
        //delete the group_category
        $manager = new GroupCategoryManager();
        $array = $manager->getAllByCategory($id);
        foreach ($array as $item) {
            $manager->delete($item['id']);
        }
        //delete the category_age_array
        $manager = new CategoryAgeArrayManager();
        $array = $manager->getAllByCategoryAge($id);
        foreach ($array as $item) {
            $manager->delete($item['id']);
        }

        $request = DB::getInstance()->prepare("DELETE FROM category_age WHERE id = :id");
        $request->bindValue(':id',$id);
        return $request->execute();
    }

    /**
     * private request for the getBy
     * @param PDOStatement $request
     * @return CategoryAge|null
     */
    private function getOne(PDOStatement $request ) : ?CategoryAge {
        $request->execute();
        $data = $request->fetch();
        if ($data) {
            return new CategoryAge (intval($data['id']), $data['name'], intval($data['year1']), intval($data['year2']));
        }
        return null;
    }
}
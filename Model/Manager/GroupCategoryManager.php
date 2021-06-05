<?php


namespace Model\Manager;
use Model\DB;
use Model\Entity\GroupCategory;
use PDOStatement;
use Model\Entity\Lesson;
use Model\Entity\Group;
use Model\Manager\GroupManager;
use Model\Entity\CategoryAge;
use Model\Manager\CategoryAgeManager;

class GroupCategoryManager{

    /**
     * return a GroupCategory by id
     * @param int $id
     * @return GroupCategory|null
     */
    public function getById (int $id) : ?GroupCategory{
        $request = DB::getInstance()->prepare("SELECT * FROM group_category where id = :id");
        $request->bindValue(":id",$id);
        return self::getOne($request);
    }

    /**
     * return all groupCategory for a category
     * @param int $category
     * @return array
     */
    public function getAllByCategory(int $category) : array {
        $request = DB::getInstance()->prepare("SELECT * FROM group_category WHERE category_age_id = :cat");
        $request->bindValue(":cat",$category);
        return self::getMany($request);
    }

    /**
     * return all groupCategory for a group
     * @param int $group
     * @return array
     */
    public function getAllByGroup(int $group) : array {
        $request = DB::getInstance()->prepare("SELECT * FROM group_category WHERE group_id = :grp");
        $request->bindValue(":grp",$group);
        return self::getMany($request);
    }

    /**
     * return a array with all the groupCategory
     * @return array
     */
    public function getAll() : array {
        $request = DB::getInstance()->prepare("SELECT * FROM group_category");
        return self::getMany($request);
    }

    /**
     * update on DB with id
     * @param int $id
     * @param int|null $categoryId
     * @param int|null $groupId
     * @return bool
     */
    public function update(int $id, int $categoryId = null, int $groupId = null) : bool{
        if (is_null($categoryId) || is_null($groupId)) {
            $data = self::getById($id);
            if (is_null($categoryId)) {
                $categoryId = $data->getGroup()->getId();
            }
            if (is_null($groupId)) {
                $groupId = $data->getCategoryAge()->getId();
            }
        }

        $request = DB::getInstance()->prepare("UPDATE group_category
                    SET category_age_id = :cat, group_id = :grp
                    WHERE id= :id
                    ");
        $request->bindValue(":id",$id);
        $request->bindValue(":cat",$categoryId);
        $request->bindValue(":grp",$groupId);

        return $request->execute();
    }

    /**
     * insert groupCategory in DB
     * @param int $categoryId
     * @param int $groupId
     * @return bool
     */
    public function add(int $categoryId, int $groupId) : bool {
        $request = DB::getInstance()->prepare("INSERT INTO group_category 
        (category_age_id, group_id)
        VALUES (:cat, :grp)
        ");
        $request->bindValue(":cat",$categoryId);
        $request->bindValue(":grp",$groupId);

        return $request->execute();
    }

    /**
     * delete groupCategory by id
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool {
        $request = DB::getInstance()->prepare("DELETE FROM group_category WHERE id = :id");
        $request->bindValue(':id',$id);
        return $request->execute();
    }


    /**
     * private request for the getBy
     * @param PDOStatement $request
     * @return GroupCategory|null
     */
    private function getOne(PDOStatement $request ) : ?GroupCategory {
        $request->execute();
        $data = $request->fetch();
        if ($data) {
            return new GroupCategory (intval($data['id']), $data['category_age_id'], $data['group_id']);
        }
        return null;
    }

    /**
     * private request for the getAll
     * @param PDOStatement $request
     * @return array
     */
    private function getMany (PDOStatement $request ) : array {
        $array = [];
        $result = $request->execute();

        if ($result){
            $data = $request->fetchAll();
            if ($data) {
                foreach ($data as $datum) {
                    $group = (new GroupManager())->getById(intval($datum['group_id']));
                    $categoryAge = (new CategoryAgeManager())->getById(intval($datum['category_age_id']));
                    $item = new GroupCategory(intval($datum['id']), $categoryAge , $group );
                    $array[] = $item;
                }
            }
        }
        return $array;
    }
}
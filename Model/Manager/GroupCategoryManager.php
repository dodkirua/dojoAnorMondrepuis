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
        return $this->getOne($request);
    }

    /**
     * return a array with all the groupCategory
     * @return array
     */
    public function getAll() : array {
        $array = [];
        $request = DB::getInstance()->prepare("SELECT * FROM group_category");
        $result = $request->execute();

        if ($result){
            $data = $request->fetchAll();
            if ($data) {
                foreach ($data as $datum) {
                    $group = (new GroupManager())->getById(intval($datum['group_id']));
                    $category = (new CategoryAgeManager())->getById(intval($datum['category_age_id']));
                    $item = new GroupCategory(intval($datum['id']) , $category, $group);
                    $array[] = $item;
                }
            }
        }
        return $array;
    }

    /**
     * update on DB with id
     * @param int $id
     * @param string|null $title
     * @param string|null $content
     * @return bool
     */
    public function update(int $id, int $category = null, string $content = null) : bool{
        if (is_null($title) || is_null($content)) {
            $data = $this->getById($id);
            if (is_null($title)) {
                $title = $data->getTitle();
            }
            if (is_null($content)) {
                $content = $data->getContent();
            }
        }

        $request = DB::getInstance()->prepare("UPDATE group_category
                    SET title = :title, content = :content
                    WHERE id= :id
                    ");
        $request->bindValue(":id",$id);
        $request->bindValue(":title",mb_strtolower($title));
        $request->bindValue(":content",mb_strtolower($content));

        return $request->execute();
    }

    /**
     * insert groupCategory in DB
     * @param string $title
     * @param string $content
     * @return bool
     */
    public function add(string $title, string $content) : bool {
        $request = DB::getInstance()->prepare("INSERT INTO group_category 
        (title, content)
        VALUES (:title, :content)
        ");
        $request->bindValue(":title",mb_strtolower($title));
        $request->bindValue(":content",mb_strtolower($content));

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
            return new GroupCategory (intval($data['id']), $data['title'], $data['content']);
        }
        return null;
    }
}
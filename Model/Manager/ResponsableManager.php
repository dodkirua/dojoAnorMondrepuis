<?php


namespace Model\Manager;

use Model\DB;
use Model\Manager\UserManager;
use PDOStatement;
use Model\Entity\Responsable;
use Model\Entity\User;

class ResponsableManager extends Manager{

    /**
     * return a Responsable by id
     * @param int $id
     * @return Responsable|null
     */
    public static function getById (int $id) : ?Responsable{
        $request = DB::getInstance()->prepare("SELECT * FROM responsable where id = :id");
        $request->bindValue(":id",$id);
        return self::getOne($request);
    }

    /**
     * get all Responsable of a child
     * @param int $childID
     * @return array
     */
    public static function getAllByChild (int $childID) : array{
        $request = DB::getInstance()->prepare("SELECT * FROM responsable where child_id= :child");
        $request->bindValue(":child",$childID);
        return self::getMany($request);
    }

    /**
     * get all child for a parent
     * @param int $parentID
     * @return array
     */
    public static function getAllByParent (int $parentID) : array{
        $request = DB::getInstance()->prepare("SELECT * FROM responsable where parent_id= :parent");
        $request->bindValue(":parent",$parentID);
        return self::getMany($request);
    }

    /**
     * return a array with all the responsable
     * @return array
     */
    public static function getAll() : array {
        $request = DB::getInstance()->prepare("SELECT * FROM responsable");
        return self::getMany($request);
    }

    /**
     * update on DB with id
     * @param int $id
     * @param int|null $childId
     * @param int|null $parentId
     * @return bool
     */
    public static function update(int $id, int $childId = null, int $parentId = null) : bool{
        if (is_null($childId) || is_null($parentId)) {
            $data = self::getById($id);
            if (is_null($childId)) {
                $childId = $data->getChild()->getId();
            }
            if (is_null($parentId)) {
                $parentId = $data->getParent()->getId();
            }
        }

        $request = DB::getInstance()->prepare("UPDATE responsable
                    SET parent_id = :parent, child_id = :child
                    WHERE id= :id
                    ");
        $request->bindValue(":id",$id);
        $request->bindValue(":parent",$parentId);
        $request->bindValue(":child",$childId);

        return $request->execute();
    }

    /**
     * insert responsable in DB
     * @param int $parentId
     * @param int $childId
     * @return bool
     */
    public static function add(int $parentId, int $childId) : bool {
        $request = DB::getInstance()->prepare("INSERT INTO responsable 
        (child_id, parent_id)
        VALUES (:child, :parent)
        ");
        $request->bindValue(":parent",$parentId);
        $request->bindValue(":child",$childId);

        return $request->execute();
    }

    /**
     * delete responsable by id
     * @param int $id
     * @return bool
     */
    public static function delete(int $id) : bool {
        $request = DB::getInstance()->prepare("DELETE FROM responsable WHERE id = :id");
        $request->bindValue(':id',$id);
        return $request->execute();
    }


    /**
     * private request for the getBy
     * @param PDOStatement $request
     * @return Responsable|null
     */
    private static function getOne(PDOStatement $request ) : ?Responsable {
        $request->execute();
        $data = $request->fetch();
        if ($data) {
            $child = (new UserManager())->getById(intval($data['child_id']));
            $parent = (new UserManager())->getById(intval($data['parent_id']));
            return new Responsable(intval($data['id']), $child, $parent);
        }
        return null;
    }

    /**
     * private request for the getAll
     * @param PDOStatement $request
     * @return array
     */
    private static function getMany (PDOStatement $request ) : array {
        $array = [];
        $result = $request->execute();

        if ($result){
            $data = $request->fetchAll();
            if ($data) {
                foreach ($data as $datum) {
                    $child = (new UserManager())->getById(intval($datum['child_id']));
                    $parent = (new UserManager())->getById(intval($datum['parent_id']));
                    $item = new Responsable(intval($datum['id']), $child, $parent);
                    $array[] = $item;
                }
            }
        }
        return $array;
    }
}
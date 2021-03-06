<?php


namespace Model\Manager;

use Model\DB;
use Model\Manager\CategoryAgeManager;
use Model\Manager\UserManager;
use PDOStatement;
use Model\CategoryAgeArray;
use Model\Entity\User;
use Model\Entity\CategoryAge;

class CategoryAgeArrayManager extends Manager{
    /**
     * return a CategoryAgeArray by id
     * @param int $id
     * @return CategoryAgeArray|null
     */
    public static function getById (int $id) : ?CategoryAgeArray{
        $request = DB::getInstance()->prepare("SELECT * From category_age_array where id = :id");
        $request->bindValue(":id",$id);
        return self::getOne($request);
    }

    /**
     * get all CategoryAgeArray by category age
     * @param int $categoryAgeId
     * @return array
     */
    public static function getAllByCategoryAge(int $categoryAgeId) : array{
        $request = DB::getInstance()->prepare("SELECT * From category_age_array where category_age_id = :cat");
        $request->bindValue(":cat",$categoryAgeId);
        return self::getMany($request);
    }

    /**
     * get all CategoryAgeArray by user
     * @param int $userId
     * @return array
     */
    public static function getAllByUser(int $userId) : array{
        $request = DB::getInstance()->prepare("SELECT * From category_age_array where user_id = :user");
        $request->bindValue(":user",$userId);
        return self::getMany($request);
    }

    /**
     * return a array with all the CategoryAgeArray
     * @return array
     */
    public static function getAll() : array {
        $request = DB::getInstance()->prepare("SELECT * From category_age_array");
        return self::getMany($request);
    }

    /**
     * update on DB with id
     * @param int $id
     * @param int|null $userId
     * @param int|null $categoryAgeId
     * @return bool
     */
    public static function update(int $id, int $userId= null, int $categoryAgeId = null) : bool{
        if (is_null($userId) || is_null($categoryAgeId)) {
            $data = self::getById($id);
            if (is_null($userId)) {
                $userId = $data->getUser()->getId();
            }
            if (is_null($categoryAgeId)) {
                $categoryAgeId = $data->getCategoryAge()->getId();
            }
        }

        $request = DB::getInstance()->prepare("UPDATE category_age_array
                    SET user_id = :user, category_age_id = :cat
                    WHERE id= :id
                    ");
        $request->bindValue(":id",$id);
        $request->bindValue(":user",$userId);
        $request->bindValue(":cat",$categoryAgeId);

        return $request->execute();
    }

    /**
     * insert CategoryAgeArray in DB
     * @param int $userId
     * @param $categoryAgeId
     * @return bool
     */
    public static function add(int $userId, int $categoryAgeId) : bool {
        $request = DB::getInstance()->prepare("INSERT INTO category_age_array 
        (user_id, category_age_id)
        VALUES (:user, :cat)
        ");
        $request->bindValue(":user",$userId);
        $request->bindValue(":cat",$categoryAgeId);

        return $request->execute();
    }

    /**
     * delete CategoryAgeArray by id
     * @param int $id
     * @return bool
     */
    public static function delete(int $id) : bool {
        $request = DB::getInstance()->prepare("DELETE From category_age_array WHERE id = :id");
        $request->bindValue(':id',$id);
        return $request->execute();
    }


    /**
     * private request for the getBy
     * @param PDOStatement $request
     * @return CategoryAgeArray|null
     */
    private static function getOne(PDOStatement $request ) : ?CategoryAgeArray {
        $request->execute();
        $data = $request->fetch();
        if ($data) {
            $user = (new UserManager())->getById(intval($data['user_id']));
            $categoryAge = (new CategoryAgeManager())->getById(intval($data['category_age_id']));
            return new CategoryAgeArray(intval($data['id']), $user, $categoryAge);
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
                    $user = (new UserManager())->getById(intval($datum['user_id']));
                    $categoryAge = (new CategoryAgeManager())->getById(intval($datum['category_age_id']));
                    $item = new CategoryAgeArray(intval($datum['id']), $user, $categoryAge);
                    $array[] = $item;
                }
            }
        }
        return $array;
    }
}
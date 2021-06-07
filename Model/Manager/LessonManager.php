<?php


namespace Model\Manager;

use Model\DB;
use PDOStatement;
use Model\Entity\Lesson;
use Model\Entity\Group;
use Model\Manager\GroupManager;

class LessonManager extends Manager{
    /**
     * return a Lesson by id
     * @param int $id
     * @return Lesson|null
     */
    public static function getById (int $id) : ?Lesson{
        $request = DB::getInstance()->prepare("SELECT * FROM lesson where id = :id");
        $request->bindValue(":id",$id);
        return self::getOne($request);
    }

    /**
     * get a Lesson by date and Group
     * @param int $date
     * @param int $groupId
     * @return Lesson|null
     */
    public static function getByDateNGroup (int $date, int $groupId) : ?Lesson{
        $request = DB::getInstance()->prepare("SELECT * FROM lesson WHERE date = :date AND group_id = :grp");
        $request->bindValue(":date", $date);
        $request->bindValue(":grp", $groupId);
        return self::getOne($request);
    }

    /**
     * return a array with all the lesson
     * @return array
     */
    public static function getAll() : array {
        $request = DB::getInstance()->prepare("SELECT * FROM lesson");
        return self::getMany($request);
    }

    /**
     * return a array with lesson by groupId
     * @param int $groupId
     * @return array
     */
    public static function getAllByGroup(int $groupId) : array {
        $request = DB::getInstance()->prepare("SELECT * FROM lesson WHERE group_id = :grp");
        $request->bindValue(":grp", $groupId);
        return self::getMany($request);
    }

    /**
     * update on DB with id
     * @param int $id
     * @param int|null $date
     * @param bool|null $check
     * @param int|null $groupId
     * @return bool
     */
    public static function update(int $id, int $date =null, bool $check = null, int $groupId = null) : bool{
        if (is_null($date) || is_null($check) || is_null($groupId)) {
            $data = self::getById($id);
            if (is_null($date)) {
                $date = $data->getDate();
            }
            if (is_null($check)) {
                $check = $data->getChecked();
            }
            if (is_null($groupId)) {
                $groupId = $data->getGroup()->getId();
            }
        }

        $request = DB::getInstance()->prepare("UPDATE lesson
                    SET date = :date, checked = :check, group_id = :grp
                    WHERE id= :id
                    ");
        $request->bindValue(":id",$id);
        $request->bindValue(":date",$date);
        $request->bindValue(":check",$check);
        $request->bindValue(":grp",$groupId);

        return $request->execute();
    }

    /**
     * insert lesson in DB
     * @param int $date
     * @param bool $check
     * @param int $groupId
     * @return bool
     */
    public static function add(int $date , bool $check , int $groupId ) : bool {
        $request = DB::getInstance()->prepare("INSERT INTO lesson 
        (date, checked, group_id)
        VALUES (:date, :ckeck, :grp)
        ");
        $request->bindValue(":date",$date);
        $request->bindValue(":check",$check);
        $request->bindValue(":grp",$groupId);

        return $request->execute();
    }

    /**
     * delete lesson by id
     * @param int $id
     * @return bool
     */
    public static function delete(int $id) : bool {
        //delete the attendance
        $attendanceManger = new AttendanceManager();
        $array = $attendanceManger->getAllByLesson($id);
        foreach ($array as $item) {
            $attendanceManger->delete($item['id']);
        }

        $request = DB::getInstance()->prepare("DELETE FROM lesson WHERE id = :id");
        $request->bindValue(':id',$id);
        return $request->execute();
    }


    /**
     * private request for the getBy
     * @param PDOStatement $request
     * @return Lesson|null
     */
    private static function getOne(PDOStatement $request ) : ?Lesson {
        $request->execute();
        $datum = $request->fetch();
        if ($datum) {
            $group = (new GroupManager())->getById(intval($datum['group_id']));
            return new Lesson(intval($datum['id']), intval($datum['date']), intval($datum['hour']), $group);
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
                    $group = (new GroupManager())->getById(intval($datum['group_id']));
                    $item = new Lesson(intval($datum['id']), intval($datum['date']), intval($datum['hour']), $group);
                    $array[] = $item;
                }
            }
        }
        return $array;
    }

}
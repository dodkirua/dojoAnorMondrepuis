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
    public function getById (int $id) : ?Lesson{
        $request = DB::getInstance()->prepare("SELECT * FROM lesson where id = :id");
        $request->bindValue(":id",$id);
        return $this->getOne($request);
    }

    /**
     * get a Lesson by date and Group
     * @param int $date
     * @param int $groupId
     * @return Lesson|null
     */
    public function getByDateNGroup (int $date, int $groupId) : ?Lesson{
        $request = DB::getInstance()->prepare("SELECT * FROM lesson WHERE date = :date AND group_id = :grp");
        $request->bindValue(":date", $date);
        $request->bindValue(":grp", $groupId);
        return $this->getOne($request);
    }

    /**
     * return a array with all the lesson
     * @return array
     */
    public function getAll() : array {
        $request = DB::getInstance()->prepare("SELECT * FROM lesson");
        return $this->getMany($request);
    }

    /**
     * return a array with lesson by groupId
     * @param int $groupId
     * @return array
     */
    public function getAllByGroup(int $groupId) : array {
        $request = DB::getInstance()->prepare("SELECT * FROM lesson WHERE group_id = :grp");
        $request->bindValue(":grp", $groupId);
        return $this->getMany($request);
    }

    /**
     * update on DB with id
     * @param int $id
     * @param int|null $date
     * @param int|null $hour
     * @param int|null $groupId
     * @return bool
     */
    public function update(int $id, int $date =null, int $hour = null, int $groupId = null) : bool{
        if (is_null($date) || is_null($hour) || is_null($groupId)) {
            $data = $this->getById($id);
            if (is_null($date)) {
                $date = $data->getDate();
            }
            if (is_null($hour)) {
                $hour = $data->getHour();
            }
            if (is_null($groupId)) {
                $groupId = $data->getGroup()->getId();
            }
        }

        $request = DB::getInstance()->prepare("UPDATE lesson
                    SET date = :date, hour = :hour, group_id = :grp
                    WHERE id= :id
                    ");
        $request->bindValue(":id",$id);
        $request->bindValue(":date",$date);
        $request->bindValue(":hour",$hour);
        $request->bindValue(":grp",$groupId);

        return $request->execute();
    }

    /**
     * insert lesson in DB
     * @param int $date
     * @param int $hour
     * @param int $groupId
     * @return bool
     */
    public function add(int $date , int $hour , int $groupId ) : bool {
        $request = DB::getInstance()->prepare("INSERT INTO lesson 
        (date, hour, group_id)
        VALUES (:date, :hour, :grp)
        ");
        $request->bindValue(":date",$date);
        $request->bindValue(":hour",$hour);
        $request->bindValue(":grp",$groupId);

        return $request->execute();
    }

    /**
     * delete lesson by id
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool {
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
    private function getOne(PDOStatement $request ) : ?Lesson {
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
    private function getMany (PDOStatement $request ) : array {
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
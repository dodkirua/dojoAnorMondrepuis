<?php


namespace Model\Manager;
use Model\DB;
use Model\Entity\Attendance;
use PDOStatement;

class AttendanceManager extends Manager{
    /**
     * return a Attendance by id
     * @param int $id
     * @return Attendance|null
     */
    public function getById (int $id) : ?Attendance{
        $request = DB::getInstance()->prepare("SELECT * FROM attendance where id = :id");
        $request->bindValue(":id",$id);
        return $this->getOne($request);
    }

    /**
     * return all Attendance for a user
     * @param int $userId
     * @return array
     */
    public function getAllByUser(int $userId) : array {
        $request = DB::getInstance()->prepare("SELECT * FROM attendance WHERE user_id = :user");
        $request->bindValue(":user",$userId);
        return $this->getMany($request);
    }

    /**
     * return all Attendance by lesson
     * @param int $lesson
     * @return array
     */
    public function getAllByLesson(int $lesson) : array {
        $request = DB::getInstance()->prepare("SELECT * FROM attendance WHERE lesson_id = :lesson");
        $request->bindValue(":lesson",$lesson);
        return $this->getMany($request);
    }

    /**
     * return a array with all the Attendance
     * @return array
     */
    public function getAll() : array {
        $request = DB::getInstance()->prepare("SELECT * FROM attendance");
        return $this->getMany($request);
    }

    /**
     * update on DB with id
     * @param int $id
     * @param int|null $userId
     * @param int|null $lessonId
     * @return bool
     */
    public function update(int $id, int $userId = null, int $lessonId = null) : bool{
        if (is_null($userId) || is_null($lessonId)) {
            $data = $this->getById($id);
            if (is_null($userId)) {
                $userId = $data->getUser()->getId();
            }
            if (is_null($lessonId)) {
                $lessonId = $data->getLesson()->getId();
            }
        }

        $request = DB::getInstance()->prepare("UPDATE attendance
                    SET user_id = :user, lesson_id = :leson
                    WHERE id= :id
                    ");
        $request->bindValue(":id",$id);
        $request->bindValue(":user",$userId);
        $request->bindValue(":lesson",$lessonId);

        return $request->execute();
    }

    /**
     * insert Attendance in DB
     * @param int $userId
     * @param int $lessonId
     * @return bool
     */
    public function add(int $userId, int $lessonId) : bool {
        $request = DB::getInstance()->prepare("INSERT INTO attendance 
        (user_id, lesson_id)
        VALUES (:user, :lesson)
        ");
        $request->bindValue(":user",$userId);
        $request->bindValue(":lesson",$lessonId);

        return $request->execute();
    }

    /**
     * delete Attendance by id
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool {
        $request = DB::getInstance()->prepare("DELETE FROM attendance WHERE id = :id");
        $request->bindValue(':id',$id);
        return $request->execute();
    }


    /**
     * private request for the getBy
     * @param PDOStatement $request
     * @return Attendance|null
     */
    private function getOne(PDOStatement $request ) : ?Attendance {
        $request->execute();
        $data = $request->fetch();
        if ($data) {
            return new Attendance (intval($data['id']), $data['user_id'], $data['lesson_id']);
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
                    $user = (new UserManager())->getById(intval($datum['user_id']));
                    $lesson = (new LessonManager())->getById(intval($datum['lesson_id']));
                    $item = new Attendance(intval($datum['id']), $user , $lesson);
                    $array[] = $item;
                }
            }
        }
        return $array;
    }

}
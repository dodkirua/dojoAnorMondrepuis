<?php


namespace Model\Manager;

use Model\DB;
use PDOStatement;
use Model\Entity\Lesson;

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
     * get a Lesson by title
     * @param string $title
     * @return Lesson|null
     */
    public function getByTitle (string $title) : ?Lesson{
        $request = DB::getInstance()->prepare("SELECT * FROM lesson where title = :title");
        $request->bindValue(":title",$title);
        return $this->getOne($request);
    }

    /**
     * return a array with all the lesson
     * @return array
     */
    public function getAll() : array {
        $array = [];
        $request = DB::getInstance()->prepare("SELECT * FROM lesson");
        $result = $request->execute();

        if ($result){
            $data = $request->fetchAll();
            if ($data) {
                foreach ($data as $datum) {
                    $item = new Lesson(intval($datum['id']), $datum['title'], $datum['content']);
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
    public function update(int $id, string $title = null, string $content = null) : bool{
        if (is_null($title) || is_null($content)) {
            $data = $this->getById($id);
            if (is_null($title)) {
                $title = $data->getTitle();
            }
            if (is_null($content)) {
                $content = $data->getContent();
            }
        }

        $request = DB::getInstance()->prepare("UPDATE lesson
                    SET title = :title, content = :content
                    WHERE id= :id
                    ");
        $request->bindValue(":id",$id);
        $request->bindValue(":title",mb_strtolower($title));
        $request->bindValue(":content",mb_strtolower($content));

        return $request->execute();
    }

    /**
     * insert lesson in DB
     * @param string $title
     * @param string $content
     * @return bool
     */
    public function add(string $title, string $content) : bool {
        $request = DB::getInstance()->prepare("INSERT INTO lesson 
        (title, content)
        VALUES (:title, :content)
        ");
        $request->bindValue(":title",mb_strtolower($title));
        $request->bindValue(":content",mb_strtolower($content));

        return $request->execute();
    }

    /**
     * delete lesson by id
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool {
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
        $data = $request->fetch();
        if ($data) {
            return new Lesson (intval($data['id']), $data['title'], $data['content']);
        }
        return null;
    }

}
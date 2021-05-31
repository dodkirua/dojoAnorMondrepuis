<?php


namespace Model\Manager;

use Model\DB;
use Model\Entity\Sms;
use PDOStatement;


class SmsManager extends Manager{

    /**
     * return a Sms by id
     * @param int $id
     * @return Sms|null
     */
    public function getById (int $id) : ?Sms{
        $request = DB::getInstance()->prepare("SELECT * FROM sms where id = :id");
        $request->bindValue(":id",$id);
        return $this->getOne($request);
    }

    /**
     * get a Sms by title
     * @param string $title
     * @return Sms|null
     */
    public function getByTitle (string $title) : ?Sms{
        $request = DB::getInstance()->prepare("SELECT * FROM sms where title = :title");
        $request->bindValue(":title",$title);
        return $this->getOne($request);
    }

    /**
     * return a array with all the sms
     * @return array
     */
    public function getAll() : array {
        $array = [];
        $request = DB::getInstance()->prepare("SELECT * FROM sms");
        $result = $request->execute();

        if ($result){
            $data = $request->fetchAll();
            if ($data) {
                foreach ($data as $datum) {
                    $item = new Sms(intval($datum['id']), $datum['title'], $datum['content']);
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

        $request = DB::getInstance()->prepare("UPDATE sms
                    SET title = :title, content = :content
                    WHERE id= :id
                    ");
        $request->bindValue(":id",$id);
        $request->bindValue(":title",mb_strtolower($title));
        $request->bindValue(":content",mb_strtolower($content));

        return $request->execute();
    }

    /**
     * insert sms in DB
     * @param string $title
     * @param string $content
     * @return bool
     */
    public function add(string $title, string $content) : bool {
        $request = DB::getInstance()->prepare("INSERT INTO sms 
        (title, content)
        VALUES (:title, :content)
        ");
        $request->bindValue(":title",mb_strtolower($title));
        $request->bindValue(":content",mb_strtolower($content));

        return $request->execute();
    }

    public function delete(int $id) : bool {
        $request = DB::getInstance()->prepare("DELETE FROM sms WHERE id = :id");
        $request->bindValue(':id',$id);
        return $request->execute();
    }


    /**
     * private request for the getBy
     * @param PDOStatement $request
     * @return Sms|null
     */
    private function getOne(PDOStatement $request ) : ?Sms {
        $request->execute();
        $data = $request->fetch();
        if ($data) {
        return new Sms (intval($data['id']), $data['title'], $data['content']);
        }
        return null;
    }
}
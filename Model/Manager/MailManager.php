<?php


namespace Model\Manager;

use Model\DB;
use Model\Entity\Mail;
use PDOStatement;


class MailManager extends Manager{

    /**
     * return a Mail by id
     * @param int $id
     * @return Mail|null
     */
    public function getById (int $id) : ?Mail{
        $request = DB::getInstance()->prepare("SELECT * FROM mail where id = :id");
        $request->bindValue(":id",$id);
        return $this->getOne($request);
    }

    /**
     * get a Mail by title
     * @param string $title
     * @return Mail|null
     */
    public function getByTitle (string $title) : ?Mail{
        $request = DB::getInstance()->prepare("SELECT * FROM mail where title = :title");
        $request->bindValue(":title",$title);
        return $this->getOne($request);
    }

    /**
     * return a array with all the mail
     * @return array
     */
    public function getAll() : array {
        $array = [];
        $request = DB::getInstance()->prepare("SELECT * FROM mail");
        $result = $request->execute();

        if ($result){
            $data = $request->fetchAll();
            if ($data) {
                foreach ($data as $datum) {
                    $item = new Mail(intval($datum['id']), $datum['title'], $datum['content']);
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

        $request = DB::getInstance()->prepare("UPDATE mail
                    SET title = :title, content = :content
                    WHERE id= :id
                    ");
        $request->bindValue(":id",$id);
        $request->bindValue(":title",mb_strtolower($title));
        $request->bindValue(":content",mb_strtolower($content));

        return $request->execute();
    }

    /**
     * insert mail in DB
     * @param string $title
     * @param string $content
     * @return bool
     */
    public function add(string $title, string $content) : bool {
        $request = DB::getInstance()->prepare("INSERT INTO mail 
        (title, content)
        VALUES (:title, :content)
        ");
        $request->bindValue(":title",mb_strtolower($title));
        $request->bindValue(":content",mb_strtolower($content));

        return $request->execute();
    }

    /**
     * delete a mail by id
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool {
        $request = DB::getInstance()->prepare("DELETE FROM mail WHERE id = :id");
        $request->bindValue(':id',$id);
        return $request->execute();
    }


    /**
     * private request for the getBy
     * @param PDOStatement $request
     * @return Mail|null
     */
    private function getOne(PDOStatement $request ) : ?Mail {
        $request->execute();
        $data = $request->fetch();
        if ($data) {
            return new Mail (intval($data['id']), $data['title'], $data['content']);
        }
        return null;
    }
}
<?php


namespace Model\Manager;

use Model\DB;
use Model\Entity\AddressBook;
use Model\Manager\UserManager;
use Model\Manager\AddressManager;
use Model\Entity\Address;
use Model\Entity\User;
use PDOStatement;

class AddressBookManager extends Manager{
    /**
     * return a AddressBook by id
     * @param int $id
     * @return AddressBook|null
     */
    public function getById (int $id) : ?AddressBook{
        $request = DB::getInstance()->prepare("SELECT * FROM address_book where id = :id");
        $request->bindValue(":id",$id);
        return $this->getOne($request);
    }

     /**
     * return a array with all the addressBook
     * @return array
     */
    public function getAll() : array {
        $array = [];
        $request = DB::getInstance()->prepare("SELECT * FROM address_book");
        $result = $request->execute();
        if ($result){
            $data = $request->fetchAll();
            if ($data) {
                foreach ($data as $datum) {
                    $user = (new UserManager())->getById(intval($datum['user_id']));
                    $address = (new AddressManager())->getById(intval($datum['address_id']));
                    $item = new AddressBook(intval($datum['id']),$user , $address);
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

        $request = DB::getInstance()->prepare("UPDATE address_book
                    SET title = :title, content = :content
                    WHERE id= :id
                    ");
        $request->bindValue(":id",$id);
        $request->bindValue(":title",mb_strtolower($title));
        $request->bindValue(":content",mb_strtolower($content));

        return $request->execute();
    }

    /**
     * insert addressBook in DB
     * @param string $title
     * @param string $content
     * @return bool
     */
    public function add(string $title, string $content) : bool {
        $request = DB::getInstance()->prepare("INSERT INTO addressBook 
        (title, content)
        VALUES (:title, :content)
        ");
        $request->bindValue(":title",mb_strtolower($title));
        $request->bindValue(":content",mb_strtolower($content));

        return $request->execute();
    }

    /**
     * delete addressBook by id
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool {
        $request = DB::getInstance()->prepare("DELETE FROM address_book WHERE id = :id");
        $request->bindValue(':id',$id);
        return $request->execute();
    }


    /**
     * private request for the getBy
     * @param PDOStatement $request
     * @return AddressBook|null
     */
    private function getOne(PDOStatement $request ) : ?AddressBook {
        $request->execute();
        $data = $request->fetch();
        if ($data) {
            return new AddressBook (intval($data['id']), $data['title'], $data['content']);
        }
        return null;
    }
}
}
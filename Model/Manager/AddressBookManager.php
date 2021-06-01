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
        $request = DB::getInstance()->prepare("SELECT * FROM address_book");
        return $this->getMany($request);
    }

    /**
     * return a array the addressBook by userId
     * @param int $userId
     * @return array
     */
    public function getAllByUser (int $userId) : array {
        $request = DB::getInstance()->prepare("SELECT * FROM address_book WHERE user_id = :user");
        $request->bindValue(":user",$userId);
        return $this->getMany($request);
    }

    /**
     * return a array the addressBook by addressId
     * @param int $userId
     * @return array
     */
    public function getAllByAddress (int $addressId) : array {
        $request = DB::getInstance()->prepare("SELECT * FROM address_book WHERE address_id = :address");
        $request->bindValue(":address",$addressId);
        return $this->getMany($request);
    }

    /**
     * update on DB with id
     * @param int $id
     * @param int|null $userId
     * @param int|null $addressId
     * @return bool
     */
    public function update(int $id, int $userId = null, int $addressId = null) : bool{
        if (is_null($userId) || is_null($addressId)) {
            $data = $this->getById($id);
            if (is_null($userId)) {
                $userId = $data->getUser()->getId();
            }
            if (is_null($addressId)) {
                $addressId = $data->getAddress()->getId();
            }
        }

        $request = DB::getInstance()->prepare("UPDATE address_book
                    SET user_id =:user, address_id =:address
                    WHERE id= :id
                    ");
        $request->bindValue(":id",$id);
        $request->bindValue(":user",mb_strtolower($userId));
        $request->bindValue(":address",mb_strtolower($addressId));

        return $request->execute();
    }

    /**
     * insert addressBook in DB
     * @param int $userId
     * @param int $addressId
     * @return bool
     */
    public function add(int $userId, int $addressId) : bool {
        $request = DB::getInstance()->prepare("INSERT INTO address_book
        (user_id, address_id)
        VALUES (:user, :address)
        ");
        $request->bindValue(":user",$userId);
        $request->bindValue(":address",$addressId);

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
            return new AddressBook (intval($data['id']), $data['user'], $data['address']);
        }
        return null;
    }

    private function getMany(PDOStatement $request) : array {
        $array = [];
        $result = $request->execute();
        if ($result){
            $data = $request->fetchAll();
            if ($data) {
                foreach ($data as $datum) {
                    $userId = (new UserManager())->getById(intval($datum['user_id']));
                    $addressId = (new AddressManager())->getById(intval($datum['address_id']));
                    $item = new AddressBook(intval($datum['id']),$userId , $addressId);
                    $array[] = $item;
                }
            }
        }
        return $array;


        return $array;
    }
}
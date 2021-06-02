<?php


namespace Model\Manager;
use Model\DB;
use Model\Entity\Dan;
use PDOStatement;
use Model\Entity\DanGetting;

class DanGettingManager extends Manager{
    /**
     * return a DanGetting by id
     * @param int $id
     * @return DanGetting|null
     */
    public function getById (int $id) : ?DanGetting{
        $request = DB::getInstance()->prepare("SELECT * FROM dan_getting where id = :id");
        $request->bindValue(":id",$id);
        return $this->getOne($request);
    }

    /**
     * return a array with all the DanGetting
     * @return array
     */
    public function getAll() : array {
        $request = DB::getInstance()->prepare("SELECT * FROM dan_getting");
        return $this->getMany($request);
    }

    /**
     * return a array of DanGetting by danId
     * @param int $danId
     * @return array
     */
    public function getAllByDan(int $danId) : array {
        $request = DB::getInstance()->prepare("SELECT * FROM dan_getting WHERE dan_id = :dan");
        $request->bindValue(":dan",$danId);
        return $this->getMany($request);
    }

    /**
     * return a array of DanGetting by userId
     * @param int $userId
     * @return array
     */
    public function getAllByUser(int $userId) : array {
        $request = DB::getInstance()->prepare("SELECT * FROM dan_getting WHERE user_id = :user");
        $request->bindValue(":user",$userId);
        return $this->getMany($request);
    }

    /**
     * update on DB with id
     * @param int $id
     * @param int|null $date
     * @param int|null $danId
     * @param int|null $userId
     * @return bool
     */
    public function update(int $id, int $date = null, int $danId = null, int $userId = null) : bool{
        if (is_null($date) || is_null($danId) || is_null($userId)) {
            $data = $this->getById($id);
            if (is_null($date)) {
                $date = $data->getDate();
            }
            if (is_null($danId)) {
                $danId = $data->getDan()->getId();
            }
            if (is_null($userId)) {
                $userId = $data->getUser()->getId();
            }
        }

        $request = DB::getInstance()->prepare("UPDATE dan_getting
                    SET date = :date, dan_id = :dan, user_id = :user
                    WHERE id= :id
                    ");
        $request->bindValue(":id",$id);
        $request->bindValue(":date",$date);
        $request->bindValue(":dan",$danId);
        $request->bindValue(":user",$userId);

        return $request->execute();
    }

    /**
     * insert DanGetting in DB
     * @param int $date
     * @param int $danId
     * @param int $userId
     * @return bool
     */
    public function add(int $date, int $danId, int $userId ) : bool {
        $request = DB::getInstance()->prepare("INSERT INTO dan_getting
        (date, dan_id, user_id)
        VALUES (:date, :dan, :user)
        ");
        $request->bindValue(":date",$date);
        $request->bindValue(":dan",$danId);
        $request->bindValue(":user",$userId);

        return $request->execute();
    }

    /**
     * delete DanGetting by id
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool {
        $request = DB::getInstance()->prepare("DELETE FROM dan_getting WHERE id = :id");
        $request->bindValue(':id',$id);
        return $request->execute();
    }

    /**
     * private request for the getBy
     * @param PDOStatement $request
     * @return DanGetting|null
     */
    private function getOne(PDOStatement $request ) : ?DanGetting {
        $request->execute();
        $data = $request->fetch();
        if ($data) {
            $dan = (new DanManager())->getById(intval($data['dan_id']));
            $user = (new UserManager())->getById(intval($data['user_id']));
            return new DanGetting (intval($data['id']), $data['name'], $dan, $user);
        }
        return null;
    }

    /**
     * private request for the getAll
     * @param PDOStatement $request
     * @return array
     */
    private function getMany(PDOStatement $request) : array {
        $result = $request->execute();
        $array = [];
        if ($result){
            $data = $request->fetchAll();
            if ($data) {
                foreach ($data as $datum) {
                    $dan = (new DanManager())->getById(intval($datum['dan_id']));
                    $user = (new UserManager())->getById(intval($datum['user_id']));
                    $item = new DanGetting(intval($datum['id']), $datum['name'], $dan, $user);
                    $array[] = $item;
                }
            }
        }
        return $array;
    }
}
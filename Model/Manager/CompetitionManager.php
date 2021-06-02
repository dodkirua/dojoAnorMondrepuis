<?php


namespace Model\Manager;
use Model\DB;
use Model\Entity\Result;
use PDOStatement;
use Model\Entity\Competition;

class CompetitionManager extends Manager{
    /**
     * return a Competition by id
     * @param int $id
     * @return Competition|null
     */
    public function getById (int $id) : ?Competition{
        $request = DB::getInstance()->prepare("SELECT * From competition where id = :id");
        $request->bindValue(":id",$id);
        return $this->getOne($request);
    }

    /**
     * get all Competition by category age
     * @param int $categoryAgeId
     * @return array
     */
    public function getAllByCategoryAge(int $categoryAgeId) : array{
        $request = DB::getInstance()->prepare("SELECT * From competition where category_age_id = :cat");
        $request->bindValue(":cat",$categoryAgeId);
        return $this->getMany($request);
    }

    /**
     * get all Competition by addressId
     * @param int $addressId
     * @return array
     */
    public function getAllByAddress(int $addressId) : array{
        $request = DB::getInstance()->prepare("SELECT * From competition where address_id = :add");
        $request->bindValue(":add",$addressId);
        return $this->getMany($request);
    }

    /**
     * return a array with all the Competition
     * @return array
     */
    public function getAll() : array {
        $request = DB::getInstance()->prepare("SELECT * From competition");
        return $this->getMany($request);
    }

    /**
     * update on DB with id
     * @param int $id
     * @param string|null $description
     * @param int|null $date
     * @param int|null $hour
     * @param int|null $addressId
     * @param int|null $categoryAgeId
     * @return bool
     */
    public function update(int $id,string $description= null, int $date= null,int $hour= null, int $addressId= null, int $categoryAgeId = null) : bool{
        if (is_null($addressId) || is_null($categoryAgeId)|| is_null($description)|| is_null($date)|| is_null($hour)) {
            $data = $this->getById($id);
            if (is_null($addressId)) {
                $addressId = $data->getAddress()->getId();
            }
            if (is_null($categoryAgeId)) {
                $categoryAgeId = $data->getCategoryAge()->getId();
            }
            if (is_null($description)) {
                $description = $data->getDescription();
            }
            if (is_null($date)) {
                $date = $data->getDate();
            }
            if (is_null($hour)) {
                $hour = $data->getHour();
            }
        }

        $request = DB::getInstance()->prepare("UPDATE competition
                    SET address_id = :add, category_age_id = :cat, description = :desc, date = :date, hour = :hour
                    WHERE id= :id
                    ");
        $request->bindValue(":id",$id);
        $request->bindValue(":desc",$description);
        $request->bindValue(":date",$date);
        $request->bindValue(":hour",$hour);
        $request->bindValue(":add",$addressId);
        $request->bindValue(":cat",$categoryAgeId);

        return $request->execute();
    }

    /**
     * insert Competition in DB
     * @param string $description
     * @param int $date
     * @param int $hour
     * @param int $addressId
     * @param $categoryAgeId
     * @return bool
     */
    public function add(string $description, int $date, int $hour, int $addressId, int $categoryAgeId) : bool {
        $request = DB::getInstance()->prepare("INSERT INTO competition 
        (description, date, hour, address_id, category_age_id)
        VALUES (:desc, :date, :hour, :add, :cat)
        ");
        $request->bindValue(":desc",$description);
        $request->bindValue(":date",$date);
        $request->bindValue(":hour",$hour);
        $request->bindValue(":add",$addressId);
        $request->bindValue(":cat",$categoryAgeId);

        return $request->execute();
    }

    /**
     * delete Competition by id
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool {
        //delete result
        $manager = new ResultManager();
        $array = $manager->getAllByCategoryAge($id);
        foreach ($array as $item) {
            $manager->delete($item['id']);
        }

        $request = DB::getInstance()->prepare("DELETE From competition WHERE id = :id");
        $request->bindValue(':id',$id);
        return $request->execute();
    }


    /**
     * private request for the getBy
     * @param PDOStatement $request
     * @return Competition|null
     */
    private function getOne(PDOStatement $request ) : ?Competition {
        $request->execute();
        $data = $request->fetch();
        if ($data) {
            $address = (new AddressManager())->getById(intval($data['address_id']));
            $categoryAge = (new CategoryAgeManager())->getById(intval($data['category_age_id']));
            return new Competition(intval($data['id']),$data['description'],intval($data['date']),
                intval($data['hour']), $address, $categoryAge);
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
                    $address = (new AddressManager())->getById(intval($datum['address_id']));
                    $categoryAge = (new CategoryAgeManager())->getById(intval($datum['category_age_id']));
                    $item = new Competition(intval($datum['id']),$datum['description'],intval($datum['date']), 
                        intval($datum['hour']), $address, $categoryAge);
                    $array[] = $item;
                }
            }
        }
        return $array;
    }
}
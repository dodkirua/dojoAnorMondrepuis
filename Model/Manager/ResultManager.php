<?php


namespace Model\Manager;
use Model\DB;
use PDOStatement;
use Model\Entity\Result;

class ResultManager extends Manager{
    /**
     * return a Result by id
     * @param int $id
     * @return Result|null
     */
    public function getById (int $id) : ?Result{
        $request = DB::getInstance()->prepare("SELECT * From result where id = :id");
        $request->bindValue(":id",$id);
        return $this->getOne($request);
    }

    /**
     * get all Result by competition
     * @param int $categoryAgeId
     * @return array
     */
    public function getAllByCategoryAge(int $competitionId) : array{
        $request = DB::getInstance()->prepare("SELECT * From result where competion_id = :comp");
        $request->bindValue(":comp",$competitionId);
        return $this->getMany($request);
    }

    /**
     * get all Result by user
     * @param int $userId
     * @return array
     */
    public function getAllByUser(int $userId) : array{
        $request = DB::getInstance()->prepare("SELECT * From result where user_id = :user");
        $request->bindValue(":user",$userId);
        return $this->getMany($request);
    }

    /**
     * return a array with all the Result
     * @return array
     */
    public function getAll() : array {
        $request = DB::getInstance()->prepare("SELECT * From result");
        return $this->getMany($request);
    }

    /**
     * update on DB with id
     * @param int $id
     * @param int|null $position
     * @param int|null $userId
     * @param int|null $competitionId
     * @return bool
     */
    public function update(int $id, int $position = null, int $userId = null, int $competitionId = null) : bool{
        if (is_null($userId) || is_null($competitionId) || is_null($position)) {
            $data = $this->getById($id);
            if (is_null($userId)) {
                $userId = $data->getUser()->getId();
            }
            if (is_null($competitionId)) {
                $competitionId = $data->getCompetition()->getId();
            }
            if (is_null($position)) {
                $position = $data->getPosition();
            }
        }

        $request = DB::getInstance()->prepare("UPDATE result
                    SET user_id = :user, competion_id = :comp, position = :pos
                    WHERE id= :id
                    ");
        $request->bindValue(":id",$id);
        $request->bindValue(":pos",$position);
        $request->bindValue(":user",$userId);
        $request->bindValue(":comp",$competitionId);

        return $request->execute();
    }

    /**
     * insert Result in DB
     * @param int $position
     * @param int $userId
     * @param int $competitionId
     * @return bool
     */
    public function add(int $position, int $userId, int $competitionId) : bool {
        $request = DB::getInstance()->prepare("INSERT INTO result 
        (position, user_id, competion_id)
        VALUES (:pos, :user, :comp)
        ");
        $request->bindValue(":pos",$position);
        $request->bindValue(":user",$userId);
        $request->bindValue(":comp",$competitionId);

        return $request->execute();
    }

    /**
     * delete Result by id
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool {
        $request = DB::getInstance()->prepare("DELETE From result WHERE id = :id");
        $request->bindValue(':id',$id);
        return $request->execute();
    }


    /**
     * private request for the getBy
     * @param PDOStatement $request
     * @return Result|null
     */
    private function getOne(PDOStatement $request ) : ?Result {
        $request->execute();
        $data = $request->fetch();
        if ($data) {
            $user = (new UserManager())->getById(intval($data['user_id']));
            $competition = (new CompetitionManager())->getById(intval($data['competition_id']));
            return new Result(intval($data['id']), intval($data['position']), $user, $competition);
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
                    $competition = (new CompetitionManager())->getById(intval($datum['competition_id']));
                    $item = new Result(intval($datum['id']), intval($datum['position']), $user, $competition);
                    $array[] = $item;
                }
            }
        }
        return $array;
    }
}
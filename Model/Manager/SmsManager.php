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
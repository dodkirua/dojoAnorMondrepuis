<?php

namespace Model\Manager;

use Model\DB;
use Model\Entity\Role;
use Model\Manager\RoleManager;
use Model\Entity\User;
use Model\Utility\Utility;
use PDOStatement;


class UserManager extends Manager {

    /**
     * return a User by id
     * @param int $id
     * @param bool $pass
     * @return User|null
     */
    public static function getById(int $id,bool $pass = false): ?User {

        $request = DB::getInstance()->prepare("SELECT * FROM user where id = :id");
        $request->bindValue(":id",$id);
        return self::getOne($request,$pass);
    }

    /**
     * return User by username
     * @param string $username
     * @return User|null
     */
    public static function getByUsername(string $username): ?User {

        $request = DB::getInstance()->prepare("SELECT * FROM user where username = :username");
        $request->bindValue(":username",mb_strtolower($username));
        return self::getOne($request,true);
    }

    /**
     * return a array with all the user
     * @return array
     */
    public static function getAll() : array {
        $classes = [];
        $request = DB::getInstance()->prepare("SELECT * FROM user");
        $result = $request->execute();

        if ($result){
            $data = $request->fetchAll();
            if ($data) {
                foreach ($data as $item) {
                    $role = RoleManager::getById(intval($item['role_id']));
                    $class = new User(intval($item['id']),$item['username'],$item['mail'],'', $item['licence'] ,
                        $item['check'], $item['validation_key'], $item['validation'], $item['name'], $item['surname'],
                        $item['phone'] ,$role );
                    $classes[] = $class;
                }
            }
        }
        return $classes;
    }

    /**
     * update on DB by id
     * @param int $id
     * @param array $param
     * @return bool
     */
    public static function update(int $id, array &$param): bool    {
        // modify the values if is null for the information of DB

            if (!isset($param['pass'])){
                $data = self::getById($id,true);
                $param['pass'] = $data->getPass();
            }
            else {
                $data = self::getById($id);
            }
            if (!isset($param['username'])){
                $param['username'] = $data->getUsername();
            }

            if (!isset($param['mail'])){
                $param['mail'] = $data->getMail();
            }

            if (!isset($param['role_id'])) {
                $param['role_id'] = $data->getRole()->getId();
            }

            if (!isset($param['licence'])) {
                $param['licence'] = $data->getLicence();
            }

            if (!isset($param['check'])) {
                $param['check'] = $data->getCheck();
            }

            if (!isset($param['key'])) {
                $param['key'] = $data->getKey();
            }

            if (!isset($param['validation'])) {
                $param['validation'] = $data->getValidation();
            }

            if (!isset($param['name'])) {
                $param['name'] = $data->getName();
            }

            if (!isset($param['surname'])) {
                $param['surname'] = $data->getSurname();
            }

            if (!isset($param['phone'])) {
            $param['phone'] = $data->getPhone();
        }


        $request = DB::getInstance()->prepare("UPDATE user 
                    SET username = :username, mail = :mail, pass = :pass, role_id = :role , `check` = :check, 
                        validation_key = :key, validation = :validation, licence = :licence , name = :name, 
                        surname = :surname, phone = :phone
                    WHERE id = :id
                    ");
        $request->bindValue(":id",$id);
        $request->bindValue(":username",mb_strtolower($param['username']));
        $request->bindValue(":mail",mb_strtolower($param['mail']));
        $request->bindValue(":pass",$param['pass']);
        $request->bindValue(":role",$param['role_id']);
        $request->bindValue(":check",$param['check']);
        $request->bindValue(":key",$param['key']);
        $request->bindValue(":validation",$param['validation']);
        $request->bindValue(":licence",$param['licence']);
        $request->bindValue(":phone",$param['phone']);
        $request->bindValue(":name",mb_strtolower($param['name']));
        $request->bindValue(":surname",mb_strtolower($param['surname']));
        return $request->execute();
    }

    /**
     * insert data in DB
     * @param string $username
     * @param string $pass
     * @param array $param
     * @return bool
     */
    public static function add(string $username, string $pass, array &$param = []) : bool {

        if (!isset($param['mail'])){
            $param['mail'] = null;
        }
        else{
            $param['mail'] = mb_strtolower($param['mail']);
        }

        if (!isset($param['licence'])) {
            $param['licence'] = null;
        }

        if (!isset($param['check'])) {
            $param['check'] = null;
        }

        if (!isset($param['key'])) {
            $param['key'] = null;
        }

        if (!isset($param['validation'])) {
            $param['validation'] = null;
        }

        if (!isset($param['name'])) {
            $param['name'] = null;
        }

        if (!isset($param['surname'])) {
            $param['surname'] = null;
        }

        if (!isset($param['role_id'])) {
            $param['role_id'] = 1;
        }

        if (!isset($param['phone'])) {
            $param['phone'] = null;
        }

        $request = DB::getInstance()->prepare("INSERT INTO user 
                    (username, mail, pass ,licence , role_id, `check`, validation_key, validation, name, surname,phone)
                    VALUES (:username, :mail, :pass, :licence, :role, :check, :key, :validation, :name, :surname, :phone)
                    ");
        $request->bindValue(":username",mb_strtolower($username));
        $request->bindValue(":mail",$param['mail']);
        $request->bindValue(":pass",$pass);
        $request->bindValue(":role",$param['role_id']);
        $request->bindValue(":check",$param['check']);
        $request->bindValue(":key",$param['key']);
        $request->bindValue(":validation",$param['validation']);
        $request->bindValue(":licence",$param['licence']);
        $request->bindValue(":name",mb_strtolower($param['name']));
        $request->bindValue(":surname",mb_strtolower($param['surname']));
        $request->bindValue(":phone",$param['phone']);
        return $request->execute();
    }

    /**
     * delete a article by id
     * @param int $id
     * @return bool
     */
    public static function delete(int $id) : bool {
        if ($id !== 1){
            // update the article and comment for this user and replace by casper
            $CommentManager = new CommentManager();
            $array = $CommentManager->getAllByUser($id);
            foreach ($array as $item){
                $CommentManager->update($item->getId(),'','',1);
            }

            $articleManager = new ArticleManager();
            $array = $articleManager->getAllByUserId($id);
            foreach ($array as $item){
                $articleManager->update($item->getId(),'','','',1);
            }

            //delete the responsable
            $responsableManager = new ResponsableManager();
            $array = $responsableManager->getAllByChild($id);
            foreach ($array as $item) {
                $responsableManager->delete($item->getId());
            }
            $array = $responsableManager->getAllByParent($id);
            foreach ($array as $item) {
                $responsableManager->delete($item->getId());
            }

            //delete the attendance
            $attendanceManger = new AttendanceManager();
            $array = $attendanceManger->getAllByUser($id);
            foreach ($array as $item) {
                $attendanceManger->delete($item->getId());
            }

            //delete the addressBook
            $manager = new AddressBookManager();
            $array = $manager->getAllByUser($id);
            foreach ($array as $item) {
                $manager->delete($item->getId());
            }

            //delete the category_age_array
            $manager = new CategoryAgeArrayManager();
            $array = $manager->getAllByUser($id);
            foreach ($array as $item) {
                $manager->delete($item->getId());
            }

            $request = DB::getInstance()->prepare("DELETE FROM user WHERE id = :id");
            $request->bindValue(':id',$id);
            return $request->execute();
        }
        else{
            return false;
        }
    }

    /**
     * private request for the getBy
     * @param PDOStatement $request
     * @param bool $pass
     * @return User|null
     */
    private static function getOne(PDOStatement $request , bool $pass = false) : ?User {
        $request->execute();
        $data = $request->fetch();
        if ($data) {
            $pwd = "";
            if ($pass){
               $pwd = $data['pass'];
            }
            $username = Utility::addMaj($data['username'],true);
            $name = Utility::addMaj($data['name'],true);
            $surname = Utility::addMaj($data['surname'],true);
            $licence = strtoupper($data['licence']);
            return new User(intval($data['id']), $username , $data['mail'], $pwd, $licence ,
                $data['check'], $data['validation'], $data['validation_key'], $name, $surname, $data['phone'] ,
                (RoleManager::getById(intval($data['role_id']))));
        }

        return null;
    }
}
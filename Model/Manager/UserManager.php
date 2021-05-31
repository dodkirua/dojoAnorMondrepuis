<?php

namespace Model\Manager;

use Model\DB;
use Model\Entity\Role;
use Model\Manager\RoleManager;
use Model\Entity\User;
use PDOStatement;


class UserManager extends Manager {

    /**
     * return a User by id
     * @param int $id
     * @param bool $pass
     * @return User|null
     */
    public function getById(int $id,bool $pass = false): ?User {

        $request = DB::getInstance()->prepare("SELECT * FROM user where id = :id");
        $request->bindValue(":id",$id);
        return $this->getOne($request,$pass);
    }

    /**
     * return User by username
     * @param string $username
     * @return User|null
     */
    public function getByUsername(string $username): ?User {

        $request = DB::getInstance()->prepare("SELECT * FROM user where username = :username");
        $request->bindValue(":username",mb_strtolower($username));
        return $this->getOne($request,true);
    }

    /**
     * return a array with all the user
     * @return array
     */
    public function getAll() : array {
        $classes = [];
        $request = DB::getInstance()->prepare("SELECT * FROM user");
        $result = $request->execute();

        if ($result){
            $data = $request->fetchAll();
            if ($data) {
                foreach ($data as $item) {
                    $class = new User(intval($item['id']),$item['username'],$item['mail'],'',$item['check'],
                        $item['validation_key'],$item['validation'],(new RoleManager())->getById($data['role_id']));
                    $classes[] = $class;
                }
            }
        }
        return $classes;
    }

    /**
     * update on DB by id
     * @param int $id
     * @param string|null $username
     * @param string|null $mail
     * @param string|null $pass
     * @param string|null $licence
     * @param int|null $check
     * @param int|null $validation
     * @param string|null $key
     * @param int|null $roleId
     * @return bool
     */
    public function update(int $id, string $username = null, string $mail = null, string $pass = null, string $licence = null,
                           int $check = null,int $validation= null,string $key = null,int $roleId = null): bool    {
        // modify the not null values
        if (is_null($username) || is_null($mail) || is_null($pass) || is_null($roleId) || is_null($check) || is_null($licence)
            || is_null($validation)|| is_null($key)){
            if (is_null($pass)){
                $data = $this->getById($id,true);
                $pass = $data->getPass();
            }
            else {
                $data = $this->getById($id);

                if (is_null($username)){
                    $username = $data->getUsername();
                }

                if (is_null($mail)){
                    $mail = $data->getMail();
                }

                if (is_null($roleId)) {
                    $roleId = $data->getRole()->getId();
                }
            }
        }
        $request = DB::getInstance()->prepare("UPDATE user 
                    SET username = :name, mail = :mail, pass = :pass, role_id = :role , `check` = :check, 
                        validation_key = :key, validation = :validation, licence = :licence
                    WHERE id = :id
                    ");
        $request->bindValue(":id",$id);
        $request->bindValue(":username",mb_strtolower($username));
        $request->bindValue(":mail",mb_strtolower($mail));
        $request->bindValue(":pass",$pass);
        $request->bindValue(":role",$roleId);
        $request->bindValue(":check",$check);
        $request->bindValue(":key",$key);
        $request->bindValue(":validation",$validation);
        $request->bindValue(":licence",$licence);

        return $request->execute();
    }

    /**
     * insert data in DB
     * @param string $username
     * @param string $pass
     * @param string|null $mail
     * @param string|null $licence
     * @param int|null $check
     * @param string|null $key
     * @param int|null $validation
     * @param int $roleId
     * @return bool
     */
    public function add(string $username, string $pass, string $mail = null,string $licence = null, int $check = null,
                        string $key = null, int $validation = null, int $roleId = 1) : bool {
        $request = DB::getInstance()->prepare("INSERT INTO user 
                    (username, mail, pass ,licence , role_id, `check`, validation_key, validation)
                    VALUES (:username, :mail, :pass, :licence, :role, :check, :key, :validation)
                    ");
        $request->bindValue(":username",mb_strtolower($username));
        if (is_null($mail)){
            $request->bindValue(":mail",null);
        }
        else {
            $request->bindValue(":mail",mb_strtolower($mail));
        }
        $request->bindValue(":pass",$pass);
        $request->bindValue(":role",$roleId);
        $request->bindValue(":check",$check);
        $request->bindValue(":key",$key);
        $request->bindValue(":validation",$validation);
        $request->bindValue(":licence",$licence);
        return $request->execute();
    }

    /**
     * delete a article by id
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool {
        // update the article and comment for this user and replace by casper
        $CommentManager = new CommentManager();
        $array = $CommentManager->getAllByUser($id);
        foreach ($array as $item){
            $CommentManager->update($item['id'],'','',4);
        }

        $articleManager = new ArticleManager();
        $array = $articleManager->getAllByUserId($id);
        foreach ($array as $item){
            $articleManager->update($item['id'],'','','',4);
        }

        $request = DB::getInstance()->prepare("DELETE FROM user WHERE id = :id");
        $request->bindValue(':id',$id);
        return $request->execute();
    }

    /**
     * private request for the getBy
     * @param PDOStatement $request
     * @param bool $pass
     * @return User|null
     */
    private function getOne(PDOStatement $request , bool $pass = false) : ?User {
        $request->execute();
        $data = $request->fetch();
        if ($data) {
            $pwd = "";
            if ($pass){
               $pwd = $data['pass'];
            }
            return new User(intval($data['id']), $data['username'], $data['mail'],$pwd, $data['check'], $data['validation'],
                $data['validation_key'], (new RoleManager())->getById(intval($data['role_id'])));
        }

        return null;
    }
}
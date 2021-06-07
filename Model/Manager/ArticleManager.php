<?php

namespace Model\Manager;

use DateTime;
use Model\DB;
use Model\Entity\Article;
use Model\Manager\UserManager;
use Model\Entity\User;


class ArticleManager extends Manager {

    /**
     * return a Article by id
     * @param int $id
     * @return Article
     */
    public  static function getById(int $id): Article    {

        $request = DB::getInstance()->prepare("SELECT * FROM article where id = :id");
        $request->bindValue(":id", $id);
        return self::getOneTmp($request);
    }

    public  static function getLast() : Article{

        $request = DB::getInstance()->prepare("SELECT * FROM article where id = (SELECT MAX(id) from article)");
        return self::getOneTmp($request);
    }

    /**
     * return a array with all the article
     * @param bool $asc
     * @return array
     */
    public  static function getAll(bool $asc = true): array    {
        if($asc){
            $request = DB::getInstance()->prepare("SELECT * FROM article");
        }
        else {
            $request = DB::getInstance()->prepare("SELECT * FROM article order by id DESC");
        }
        return self::getTmp($request);
    }

    /**
     * return a array with all the article
     * @param int $userId
     * @return array
     */
    public  static function getAllByUserId(int $userId): array    {
        $request = DB::getInstance()->prepare("SELECT * FROM article WHERE user_id = :user");
        $request->bindValue(":user", $userId);
        return self::getTmp($request);
    }

    /**
     * update on DB by id
     * @param int $id
     * @param string|null $title
     * @param string|null $content
     * @param string|null $image
     * @param int|null $userId
     * @return bool
     */
    public  static function update(int $id, string $title = null, string $content = null, string $image = null, int $userId = null): bool    {
        // modify the not null values
        if (is_null($content) || is_null($userId)) {
            $data = self::getById($id);

            if (is_null($content)) {
                $content = $data->getContent();
            }

            if (is_null($userId)) {
                $userId = $data->getUser()->getId();
            }

        }
        $request = DB::getInstance()->prepare("UPDATE article 
                    SET content = :content, image = :img, user_id = :user, title = :title
                    WHERE id = :id
                    ");
        $request->bindValue(":id", $id);
        $request->bindValue(":content", mb_strtolower($content));
        $request->bindValue(":img", mb_strtolower($image));
        $request->bindValue(":title", mb_strtolower($title));
        $request->bindValue(":user", $userId);

        return $request->execute();
    }

    /**
     * insert data in DB
     * @param string $content
     * @param int $userId
     * @param string|null $image
     * @param string|null $title
     * @return bool
     */
    public  static function add(string $content, int $userId, string $image = null, string $title = null): bool    {
        $request = DB::getInstance()->prepare("INSERT INTO article 
                    (title, content, date, image, user_id)
                    VALUES (:title, :content, :date, :img, :user)
                    ");
        $request->bindValue(":title", mb_strtolower($title));
        $request->bindValue(":content", mb_strtolower($content));
        $request->bindValue(":img", mb_strtolower($image));
        $request->bindValue(":date", (new DateTime())->getTimestamp());
        $request->bindValue(":user", $userId);

        return $request->execute();
    }

    /**
     * delete a article by id
     * @param int $id
     * @return bool
     */
    public  static function delete(int $id) : bool {
        // delete the comment of this article
        $manager = new CommentManager();
        $array = $manager->getAllByArticle($id);
        foreach ($array as $item){
            $manager->delete($item['id']);
        }
        $request = DB::getInstance()->prepare("DELETE FROM article WHERE id = :id");
        $request->bindValue(':id',$id);
        return $request->execute();
    }

    /**
     * return a array for use in other getAll
     * @param $request
     * @return array
     */
    private  static function getTmp($request): array    {
        $classes = [];
        $result = $request->execute();

        if ($result) {
            $data = $request->fetchAll();
            if ($data) {
                foreach ($data as $item) {
                    $user = UserManager::getById(intval($item['user_id']));
                    $class = new Article(intval($item['id']), $item['title'], $item['content'], $item['date'],
                        $item['image'], $user);
                    $classes[] = $class;
                }
            }
        }
        return $classes;
    }

    /**
     * return a Article for the get  static function for one return
     * @param $request
     * @return Article
     */
    private  static function getOneTmp($request) : Article{
        $class = new Article();
        $result = $request->execute();

        if ($result) {
            $data = $request->fetch();
            if ($data) {
                $class->setId($data['id'])
                    ->setTitle($data['title'])
                    ->setContent($data['content'])
                    ->setDate($data['date'])
                    ->setImage($data['image'])
                    ->setUser(UserManager::getById($data['user_id']));
            }
        }
        return $class;
    }
}

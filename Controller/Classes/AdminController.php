<?php


namespace Controller\Classes;



use Model\DB;
use Model\Entity\Article;
use Model\Manager\AddressBookManager;
use Model\Manager\AddressManager;
use Model\Manager\ArticleManager;
use Model\Manager\RoleManager;
use Model\Manager\UserManager;
use Model\Utility\Security;
use Model\Utility\Utility;
use PDO;

class AdminController extends Controller {

    /**
     * display admin panel
     * @param array|null $var
     */
    public static function display(array $var = null){
        self::render('admin',"Panneau d'administration",$var);
    }

    /**
     * display article admin panel
     * @param array|null $var
     */
    public static function article(array $var = null){
        foreach (ArticleManager::getAll() as $article){
            $var['article'][] = $article->getAlldata();
        }
        self::render('articleAdmin',"Gestion des articles",$var);
    }

    /**
     * display user admin panel
     * @param array|null $var
     */
    public static function user(array $var = null){
        foreach (UserManager::getAll() as $user){
            $tmp = $user->getAllData();
            $address = AddressBookManager::getAllByUser($user->getId()); //add data address in $array
            if ($address !== []){
                foreach ($address as $add){
                    $tmp['address'] = $add->getAllData()['address'];
                    $tmp['address_book_id'] = $add->getId();
                }

            }
            $var['user'][] = $tmp;
        }
        foreach (RoleManager::getAll() as $role){
            $var['role'][] = $role->getAlldata();
        }
        self::render('adminUser',"Gestion des utilisateurs",$var);
    }

    /**
     * add article in DB
     *  -5 : $_POST problem
     * -10 : upgrade problem
     * @return int
     */
    public static function addArticle() : int{
        if (isset($_POST['title'],$_POST['content'],$_POST['user'])){
            $title = mb_strtolower(Security::sanitize($_POST['title']));
            $content = mb_strtolower(Security::sanitize($_POST['content']));
            $userId = intval($_POST['user']);

            if (ArticleManager::add($content,$userId,null,$title)){
                if (isset($_FILES['image'])){
                    return self::addImage(intval(DB::getInstance()->lastInsertId()) );
                }
                else {
                    return 1;
                }
            }
            else {
                return -10;
            }
        }
        else {
            return -5;
        }
    }

    /**
     * upload image and update DB
     *  -11 : upload problem
     * -12 : wrong type of image
     * -13 : file size too large
     * -10 : upgrade problem
     * @param int $id
     * @return int
     */
    private static function addImage(int $id) : int {
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0){

            // test file type
            $acceptedType = ['image/jpeg', 'image/png', 'image/jpg'];
            if (in_array($_FILES['image']['type'], $acceptedType)){

                // test file size
                $maxSize = 5 * 1024 *1024;
                if (intval($_FILES['image']['size']) <= $maxSize){

                    $tmpName = $_FILES['image']['tmp_name'];
                    $path = pathinfo($_FILES['image']['name']);
                    $name = "article".$id;
                    move_uploaded_file($tmpName,'/assets/img/article/' . $name . $path['extension']);
                    if (ArticleManager::update($id,null,null,$name)) {
                        return 1;
                    }
                    else {
                       return -10;
                    }
                }
                else {
                    return -13;
                }
            }
            else {
                return -12;
            }
        }
        else {
            return -11;
        }
    }

    /**
     * delete an article
     * -5 : $_Post problem
     * -13 : delete problem
     * @return int
     */
    public static function delArticle() : int{
        if (isset($_POST['articleId'])) {
            if(ArticleManager::delete(intval($_POST['articleId']))){
                return 1;
            }
            else {
                return -13;
            }
        }
        else {
            return -5;
        }
    }

    /**
     * modify article
     * @return int
     */
    public static function modArticle() : int {
        if (isset($_POST['title'],$_POST['content'])){
            if (isset($_POST['title'])){
                $title = mb_strtolower(Security::sanitize($_POST['title']));
            }
            else {
                $title = null;
            }
            if (isset($_POST['content'])){
                $content = mb_strtolower(Security::sanitize($_POST['content']));
            }
            else {
                $content = null;
            }

            /*if (isset($_FILES['image'])){
                $return = self::addImage($article->getId());
            }
            else {
                $img = $article->getImage();
                if (!is_null($img)){

                }
            }*/
            if (ArticleManager::update(intval($_POST['articleId']),$title,$content)){
                return 1;
            }
            else {
                return -7;
            }

        }
        else {
            return -5;
        }
    }

    /**
     * de user in admin pannel
     *  -5 : $_Post problem
     * -13 : delete problem
     * @return int
     */
    public static function delUser() :int{
        if (isset($_POST['userId'])) {
            if(UserManager::delete(intval($_POST['userId']))){
                return 1;
            }
            else {
                return -13;
            }
        }
        else {
            return -5;
        }
    }

    /**
     * Add user in admin panel
     * -5 : $_POST problem
     * -7 :  update problem
     * -10 : upgrade problem
     * @return int
     */
    public static function modUser() : int    {
        //modify user information
        if (isset($_POST['name']) || isset($_POST['surname']) || isset($_POST['mail']) || isset($_POST['phone']) ||
            isset($_POST['licence']) || isset($_POST['num']) || isset($_POST['street2']) || isset($_POST['street']) ||
            isset($_POST['zip']) || isset($_POST['city']) || isset($_POST['country']) || isset($_POST['add']) ||
            isset($_POST['userId'])) {
            $id = intval($_POST['userId']);

            if (isset($_POST['name'])) {
                $param['name'] = mb_strtolower(Security::sanitize($_POST['name']));
            }
            if (isset($_POST['surname'])) {
                $param['surname'] = mb_strtolower(Security::sanitize($_POST['surname']));
            }
            if (isset($_POST['licence'])) {
                $param['licence'] = mb_strtolower(Security::sanitize($_POST['licence']));
            }
            if (isset($_POST['mail'])) {
                $param['mail'] = mb_strtolower(Security::sanitize($_POST['mail']));
            }
            if (isset($_POST['phone'])) {
                $param['phone'] = Utility::removeZero(mb_strtolower(Security::sanitize($_POST['phone'])));
            }

            if (UserManager::update($id, $param)) {

                if (isset($_POST['num'])) {
                    $num = intval($_POST['num']);
                } else {
                    $num = null;
                }

                if (isset($_POST['street'])) {
                    $street = mb_strtolower(Security::sanitize($_POST['street2'])) . " " .
                        mb_strtolower(Security::sanitize($_POST['street']));
                } else {
                    $street = null;
                }

                if (isset($_POST['zip'])) {
                    $zip = intval($_POST['zip']);
                } else {
                    $zip = null;
                }

                if (isset($_POST['city'])) {
                    $city = mb_strtolower(Security::sanitize($_POST['city']));
                } else {
                    $city = null;
                }

                if (isset($_POST['country'])) {
                    $country = mb_strtolower(Security::sanitize($_POST['country']));
                } else {
                    $country = null;
                }

                if (isset($_POST['add']) && $_POST['add'] !== "") {
                    $add = mb_strtolower(Security::sanitize($_POST['add']));
                } else {
                    $add = null;
                }

                // add or update address
                $addressId = AddressManager::search($num, $street, $zip, $city, $country, $add);
                if ($addressId !== -1) {
                    if (AddressBookManager::update($_SESSION['user']['address']['address_book_id'], $_SESSION['user']['id'], $addressId)) {
                        //test for delete old
                        $addressOldId = $_SESSION['user']['address']['id'];
                        $oldBook = AddressBookManager::getAllByAddress($addressOldId);
                        if (count($oldBook) === 0) {
                            AddressManager::delete($addressOldId);
                        }
                        return 1;
                    } else {
                        return -7;
                    }
                }
                if (AddressManager::add($num, $street, $zip, $city, $country, $add)) {
                    $addressId = AddressManager::search($num, $street, $zip, $city, $country, $add);
                    if (AddressBookManager::update($_SESSION['user']['address']['address_book_id'], $_SESSION['user']['id'],
                        $addressId)) {
                        //test for delete old
                        $addressOldId = $_SESSION['user']['address']['id'];
                        $oldBook = AddressBookManager::getAllByAddress($addressOldId);
                        if (count($oldBook) === 0) {
                            AddressManager::delete($addressOldId);
                        }
                        return 1;
                    } else {
                        return -7;
                    }
                } else {
                    return -10;
                }
            }
        }
        else {
            return -5;
        }
    }

    public static function addUser() : int {
        if (isset($_POST['name'], $_POST['surname'])){
            $param['name'] = mb_strtolower(Security::sanitize($_POST['name']));
            $param['surname'] = mb_strtolower(Security::sanitize($_POST['surname']));
            $param['username'] = Utility::createUsername($param['name'],$param['surname']);
            if (isset($_POST['mail'])) {
                $param['mail'] = mb_strtolower(Security::sanitize($_POST['mail']));
            }
            if (isset($_POST['mail'])) {
                $param['mail'] = mb_strtolower(Security::sanitize($_POST['mail']));
            }
        }
        else {
            return -5;
        }
    }
}
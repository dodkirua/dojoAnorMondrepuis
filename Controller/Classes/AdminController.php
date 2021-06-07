<?php


namespace Controller\Classes;


use Model\Entity\Article;
use Model\Manager\ArticleManager;
use Model\Utility\Security;

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
        self::render('articleAdmin',"Gestion des articles",$var);
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
                    return self::addImage(ArticleManager::lastId());
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
     * @param Article $id
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
                    $name = "article".$id->getId();
                    move_uploaded_file($tmpName,'/assets/img/article/' . $name . $path['extension']);
                    if (ArticleManager::update($id->getId(),null,null,$name)) {
                        return 1;
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

}
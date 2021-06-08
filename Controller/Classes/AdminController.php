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
        foreach (ArticleManager::getAll() as $article){
            $var['article'][] = $article->getAlldata();
        }
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

}
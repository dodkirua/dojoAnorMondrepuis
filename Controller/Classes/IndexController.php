<?php


namespace Controller\Classes;


use dev\Dev;
use Model\Manager\ArticleManager;

class IndexController extends Controller{

    /**
     * display the connect page
     * @param array|null $var
     */
    public static function display(array $var = null) : void{
        $var['article'] = (new ArticleManager())->getLast()->getAllData();
        self::render('index','Accueil',$var);
    }

}
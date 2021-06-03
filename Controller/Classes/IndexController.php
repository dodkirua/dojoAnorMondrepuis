<?php


namespace Controller\Classes;


use dev\Dev;
use Model\Manager\ArticleManager;

class IndexController extends Controller{

    /**
     * display the connect page
     */
    public function display() : void{
        $var['article'] = (new ArticleManager())->getLast()->getAllData();
        $this->render('index','Accueil','principal',$var);
    }

}
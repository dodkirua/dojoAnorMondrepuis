<?php


namespace Controller\Classes;


use Model\Manager\ArticleManager;

class IndexController extends Controller{

    /**
     * display the connect page
     */
    public function display() : void{
        $var = (new ArticleManager())->getLast()->getAllData();
        $this->render('index','Accueil','principal',$var);
    }

}
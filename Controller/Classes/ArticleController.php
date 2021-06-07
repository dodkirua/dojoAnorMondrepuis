<?php


namespace Controller\Classes;


use Model\Manager\ArticleManager;

class ArticleController extends Controller{

    public static function display(array $var = null) {
        $articles = ArticleManager::getAll(false);
        foreach ($articles as $article){
            $var['article'][] = $article->getAlldata();
        }
        self::render('article','Les nouvelles', $var);
    }
}
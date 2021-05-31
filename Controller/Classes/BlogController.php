<?php


namespace Controller\Classes;


class BlogController extends Controller {


    public static function connectPage() {
        self::render('connect','Page de connection');
    }
}
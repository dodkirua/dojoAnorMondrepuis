<?php


namespace Controller\Classes;


class AccountController extends Controller{

    /**
     * display the view for the account page
     * @param array|null $var
     */
    public static function display(array $var = null){
        self::render('account','Espace personnel',$var);
    }
}
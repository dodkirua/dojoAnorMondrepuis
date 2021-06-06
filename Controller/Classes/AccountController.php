<?php


namespace Controller\Classes;


use Model\Entity\User;
use Model\Manager\UserManager;

class AccountController extends Controller{

    /**
     * display the view for the account page
     * @param array|null $var
     */
    public static function display(array $var = null){
        self::render('account','Espace personnel',$var);
    }

    /**
     * display the password change form
     */
    public static function pass(){
        self::render('pass','Changer de mot de passe');
    }

    /**
     * display the password change form
     */
    public static function modifyInformation(){
        self::render('modifyInformation','Modifier les informations');
    }

}
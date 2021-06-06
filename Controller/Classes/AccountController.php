<?php


namespace Controller\Classes;


use Model\Entity\User;
use Model\Manager\UserManager;
use Model\Utility\Security;
use Model\Utility\Utility;

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

    public static function changePass() : int{

    }

    /**
     * display the information change form
     * @param array|null $var
     */
    public static function information(array $var = null){
        self::render('modifyInformation','Modifier les informations',$var);
    }

    /**
     * modify the information
     * -5 : S_POST problem
     * -7 : : upgrade problem
     * @param int $id
     * @return int
     */
    public static function modifyInformation(int $id) : int {
        if (isset($_POST['name']) || isset($_POST['surname']) || isset($_POST['mail']) || isset($_POST['phone'])){
            if (isset($_POST['name'])) {
                $param['name'] = mb_strtolower(Security::sanitize($_POST['name']));
                $_SESSION['user']['name'] = ucfirst($param['name']);
            }
            if (isset($_POST['surname'])) {
                $param['surname'] = mb_strtolower(Security::sanitize($_POST['surname']));
                $_SESSION['user']['surname'] = ucfirst($param['surname']);
            }
            if (isset($_POST['mail'])) {
                $param['mail'] = mb_strtolower(Security::sanitize($_POST['mail']));
                $_SESSION['user']['mail'] = $param['mail'];
            }
            if (isset($_POST['phone'])) {
                $param['phone'] = Utility::removeZero(mb_strtolower(Security::sanitize($_POST['phone'])));
                $_SESSION['user']['phone'] = $param['phone'];
            }
            $param['check'] = true;
            $_SESSION['user']['check'] = $param['check'];
            if (UserManager::update($id,$param)){
                return 1;
            }
            else{
                return -7;
            }
        }
        else {
            return -5;
        }

    }

    public static function address()    {
    }

}
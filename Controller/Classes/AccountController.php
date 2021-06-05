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
    public static function Pass(){
        self::render('pass','Changer de mot de passe');
    }
    /**
     * test if pass and username are associated
     * @param string $username
     * @param string $pass
     * @return User|null
     */
    public static function passTest(string $username, string $pass) : ?User    {
        $user = UserManager::getByUsername(mb_strtolower($username));
        if (!is_null($user)) {
            if (password_verify($pass, $user->getPass())) {
                return $user;
            }
        }
        return null;
    }
    public static function testConnection(): bool{
        if (isset($_POST['username']) && isset($_POST['pass'])){
            $user = $_POST['username'];
            $pass = $_POST['pass'];
            $userClass = (new UserManager())->passTest($user,$pass);

            if (!is_null($userClass)){
                foreach ($userClass->getAll() as $key => $item){
                    $_SESSION['user'][$key] = $item;
                }

                return true;
            }
        }
        return false;
    }
}
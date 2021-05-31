<?php


namespace Controller\Classes;


use dev\Dev;
use Model\Manager\UserManager;
use Model\Utility\Security;

class RegistrationController extends Controller{

    /**
     * verification and add to DB
     * return code :
     * 1 : ok
     * -1 : not add to DB
     * -2 : pass and passVerify have different
     * -3 : the password does not correspond to the security request
     * -4 : user already exists
     * -5 : $_POST problem
     * @return int
     */
    public static function registration() : int{
        if (isset($_POST['username']) && isset($_POST['pass']) && isset($_POST['passVerify']) ){
            $username = Security::sanitize($_POST['username']);
            $pass = Security::checkPass(Security::sanitize($_POST['pass']));
            $userManager = new UserManager();
            $user = $userManager->getByUsername(strtolower($username));

            if (is_null($user)) {
                if (!is_null($pass)){
                    if ($pass === $_POST['passVerify']){
                        if ($userManager->add($username,password_hash($pass,PASSWORD_BCRYPT))) {
                            return 1;
                        }
                        else {
                            return -1;
                        }
                    }
                    else {
                        return -2;
                    }
                }
                else {
                    return -3;
                }
            }
            else {
                return -4;
            }
        }
        return -5;
    }

}
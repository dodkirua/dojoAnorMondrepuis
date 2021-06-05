<?php


namespace Controller\Classes;

use Model\Entity\User;
use Model\Manager\AddressBookManager;
use Model\Manager\UserManager;
use Model\Utility\Utility;


class ConnectController extends Controller {

    /**
     * test connection to a user
     * return :
     * 1 : ok
     * -6 : wrong password
     * -5 : $_POST variable problem
     * @return int
     */
    public static function connection() : int{
        if (isset($_POST['username']) && isset($_POST['pass'])){
            $username = mb_strtolower($_POST['username']);
            $pass = $_POST['pass'];
            $user = UserManager::getByUsername($username);
            $address = AddressBookManager::getAllByUser($user->getId());
            if (password_verify($pass,$user->getPass())){
                Utility::addToSession($user->getAllData());
                if ($address !== []){
                    $tmp = [];
                    foreach ($address as $add){
                        $tmp[] = $add->getAllData();
                    }
                    Utility::addToSession($tmp,'address');
                }
                return 1;
            }
            else {
                return -6;
            }
        }
        return -5;
    }

    /**
     * display the connect page
     * @param array|null $var
     */
    public static function display(array $var = null) : void{
       self::render('connect','Connectez-vous',$var);
    }
}



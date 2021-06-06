<?php


namespace Controller\Classes;

use dev\Dev;
use Model\Entity\Responsable;
use Model\Entity\User;
use Model\Manager\AddressBookManager;
use Model\Manager\ResponsableManager;
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
            return self::userInfo($username,$pass);
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

    /**
     * test connection to a user and add information to $_SESSION
     * return :
     * 1 : ok
     * -6 : wrong password
     * @param string|null $username
     * @param string|null $pass
     * @param int|null $id
     * @param string $key
     * @param string|null $key2
     * @param bool $token
     * @return int
     */
    private static function userInfo(string $username = null, string $pass= null, int $id = null,
                                     string $key = 'user', string $key2 = null, $token = true) : int{
        if (is_null($key2)){
            $tmp = &$array[$key];
        }
        else {
            $tmp = &$array[$key][$key2];
        }
        if (is_null($id)) { //add data user in $array
            $user = UserManager::getByUsername($username);
            if (password_verify($pass,$user->getPass())){ //add data user in $_SESSION
                $tmp = $user->getAllData();
            } else {
                return -6;
            }
        }
        else {
            $tmp = UserManager::getById($id)->getAllData();
        }
        $address = AddressBookManager::getAllByUser($tmp['id']); //add data address in $array
        if ($address !== []){
            foreach ($address as $add){
                $tmp['address'] = $add->getAllData()['address'];
            }
        }
        Utility::addToSession($array);
        if ($token){
            $tmpArray = [];
            $parent =ResponsableManager::getAllByChild($tmp['id']); //add parent information in $_SESSION
            if ($parent !== []){
                $i = 1;
                foreach ($parent as $add){
                    $tmpArray[$i] = $add->getAllData()['parent'];
                    $address = AddressBookManager::getAllByUser($tmpArray[$i]['id']); //add data address in $array
                    if ($address !== []) {
                        foreach ($address as $item) {
                            $tmpArray[$i]['address'][] = $item->getAllData()['address'];
                        }
                        $i++;
                    }

                }
                Utility::addToSession($tmpArray,'parent');
            }
            else {
                $child =ResponsableManager::getAllByParent($tmp['id']); //add parent information in $_SESSION
                if ($child !== []){
                    $i = 1;
                    foreach ($child as $add){
                        $tmpArray[$i] = $add->getAllData()['child'];
                        $address = AddressBookManager::getAllByUser($tmpArray[$i]['id']); //add data address in $array
                        if ($address !== []) {
                            foreach ($address as $item) {
                                $tmpArray[$i]['address'][] = $item->getAllData()['address'];
                            }
                            $i++;
                        }
                    }
                    Utility::addToSession($tmpArray,'child');
                }
            }
        }

        return 1;
    }


}



<?php


namespace Controller\Classes;


use http\Params;
use Model\Entity\User;
use Model\Manager\AddressBookManager;
use Model\Manager\AddressManager;
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
     * @param array|null $var
     */
    public static function pass(array $var = null){
        self::render('pass','Changer de mot de passe',$var);
    }

    /**
     * modify password
     * -2 : pass and passVerify are different
     * -3 : password not strong enough
     * -5 : S_POST problem
     * -7 : upgrade problem
     * -8 : old pass wrong
     * @return int
     */
    public static function changePass() : int{
        if (isset($_POST['old'], $_POST['pass'],$_POST['passVerify'])){
            $user = UserManager::getById($_SESSION['user']['id'],true);
            if (password_verify($_POST['old'], $user->getPass())){
                if ($_POST['pass'] === $_POST['passVerify']) {
                    if (Security::checkPass($_POST['pass'])){
                        $var['pass'] = password_hash($_POST['pass'], PASSWORD_BCRYPT);
                        if (UserManager::update($user->getId(),$var)){
                            return 1;
                        }
                        else {
                            return -7;
                        }
                    }
                    else {
                        return -3;
                    }
                }
                else {
                    return -2;
                }
            }
            else {
                return -8;
            }
        }
        else {
            return -5;
        }
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
            }
            if (isset($_POST['surname'])) {
                $param['surname'] = mb_strtolower(Security::sanitize($_POST['surname']));
            }
            if (isset($_POST['mail'])) {
                $param['mail'] = mb_strtolower(Security::sanitize($_POST['mail']));
            }
            if (isset($_POST['phone'])) {
                $param['phone'] = Utility::removeZero(mb_strtolower(Security::sanitize($_POST['phone'])));
            }
            $param['check'] = true;
            if (UserManager::update($id,$param)){
                ConnectController::userInfo(null,null,$_SESSION['user']['id']);
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

    /**
     * Display address modification form
     * @param array|null $var
     */
    public static function address(array $var=null) {
        self::render('modifyAddress',"Modifier l'adresse",$var);
    }

    /**
     * modify address
     * -5 : S_POST problem
     * -7 : upgrade problem
     * -10 : add to DB problem
     * @return int
     */
    public static function modifyAddress() :int   {

        if (isset($_POST['num']) || isset($_POST['street']) || isset($_POST['zip']) || isset($_POST['city']) ||
            isset($_POST['country'])){
            if (isset($_POST['num'])) {
                $num = intval($_POST['num']);
            }
            else {
                $num = null;
            }

            if (isset($_POST['street'])) {
                $street = mb_strtolower(Security::sanitize($_POST['street2'])). " " .
                    mb_strtolower(Security::sanitize($_POST['street']));
            }
            else {
                $street = null;
            }

            if (isset($_POST['zip'])) {
                $zip = intval($_POST['zip']);
            }
            else {
                $zip = null;
            }

            if (isset($_POST['city'])) {
                $city = mb_strtolower(Security::sanitize($_POST['city']));
            }
            else {
                $city = null;
            }

            if (isset($_POST['country'])) {
                $country = mb_strtolower(Security::sanitize($_POST['country']));
            }
            else {
                $country = null;
            }

            if (isset($_POST['add']) && $_POST['add'] !== "") {
                $add = mb_strtolower(Security::sanitize($_POST['add']));
            }
            else {
                $add = null;
            }

            // add or update address
            $addressId = AddressManager::search($num,$street,$zip,$city,$country,$add);
            if ($addressId !== -1) {
                if (AddressBookManager::update($_SESSION['user']['address']['address_book_id'],$_SESSION['user']['id'], $addressId)) {
                    //test for delete old
                    $addressOldId = $_SESSION['user']['address']['id'];
                    $oldBook = AddressBookManager::getAllByAddress($addressOldId);
                    if (count($oldBook) === 0) {
                        AddressManager::delete($addressOldId);
                    }
                    ConnectController::userInfo(null,null,$_SESSION['user']['id']);
                    return 1;
                    }
                else {
                    return -7;
                    }
            }
           if (AddressManager::add($num, $street, $zip, $city,$country,$add)){
               $addressId = AddressManager::search($num,$street,$zip,$city,$country,$add);
               if (AddressBookManager::update($_SESSION['user']['address']['address_book_id'],$_SESSION['user']['id'],
                   $addressId)) {
                   //test for delete old
                   $addressOldId = $_SESSION['user']['address']['id'];
                   $oldBook = AddressBookManager::getAllByAddress($addressOldId);
                   if (count($oldBook) === 0) {
                       AddressManager::delete($addressOldId);
                   }
                   ConnectController::userInfo(null, null, $_SESSION['user']['id']);
                   return 1;
               }
               else {
                   return -7;
               }
           }
           else{
               return -10;
           }
        }
        else {
            return -5;
        }
    }

}
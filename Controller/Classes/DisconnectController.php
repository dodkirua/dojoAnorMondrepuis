<?php


use Controller\Classes\Controller;
use Controller\Classes\IndexController;

class DisconnectController extends Controller{
    public static function disconnect() {
        $_SESSION = [];
        session_destroy();
        $var['action'] = 'Vous êtes bien déconnecté';
        IndexController::display($var);
    }
}
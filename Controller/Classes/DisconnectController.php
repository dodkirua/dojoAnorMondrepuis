<?php


use Controller\Classes\Controller;

class DisconnectController extends Controller{
    public function disconnect() {
        $_SESSION = [];
        session_destroy();
        $var['action'] = 'Vous êtes bien déconnecté';
        self::render('index','Accueil',$var);
    }
}
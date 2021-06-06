<?php

use Controller\Classes\AccountController;
use Controller\Classes\ConnectController;
use Controller\Classes\ErrorController;
use Controller\Classes\IndexController;

session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/import.php";

if (isset($_GET['ctrl'])){

    switch ($_GET['ctrl']){
        case 'connect' :
            ConnectController::display();
            break;
        case 'account':
            AccountController::display();
            break;
        case 'form':
            switch ($_GET['action']){
                case 'connect':
                    $connec = ConnectController::connection();
                    if ($connec === 1){
                        IndexController::display();
                    }
                    else {
                        ConnectController::display(ErrorController::Error($connec));
                    }
                    break;
                case 'pass':
                    AccountController::pass();
                    break;
                case 'passChange':

                    break;
                case 'modifyInformation':
                    $mod = AccountController::modifyInformation(intval($_SESSION['user']['id']));
                    if ($mod === 1){
                        AccountController::display();
                    }
                    else {
                        AccountController::information(ErrorController::Error($mod));
                    }
                    break;
                case 'information':
                    AccountController::information();
                    break;
                case 'address':
                    AccountController::address();
                    break;
            }
            break;
        case 'disconnect' :
            DisconnectController::disconnect();
            break;

    }
}
else {
    IndexController::display();
}
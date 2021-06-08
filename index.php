<?php

use Controller\Classes\AccountController;
use Controller\Classes\AdminController;
use Controller\Classes\ArticleController;
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
        case 'disconnect' :
            DisconnectController::disconnect();
            break;
        case 'article' :
           ArticleController::display();
            break;
        case 'articleAdmin' :
            AdminController::article();
            break;
        case 'admin' :
            AdminController::display();
            break;
        case 'articleDelete':
            AdminController::delArticle();
            break;
        case 'userAdmin':
            AdminController::user();
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
                    $mod = AccountController::changePass();
                    if ($mod === 1){
                        AccountController::display();
                    }
                    else {
                        AccountController::pass(ErrorController::Error($mod));
                    }
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
                case 'modifyAddress':
                    $mod = AccountController::modifyAddress();
                    if ($mod === 1){
                        AccountController::display();
                    }
                    else {
                        AccountController::address(ErrorController::Error($mod));
                    }
                    break;
                case 'addArticle' :
                        $mod = AdminController::addArticle();
                    if ($mod === 1){
                        AdminController::article();
                    }
                    else {
                        AdminController::article(ErrorController::Error($mod));
                    }
                    break;
                case 'delArticle' :
                    $mod = AdminController::delArticle();
                    if ($mod === 1){
                        AdminController::article();
                    }
                    else {
                        AdminController::article(ErrorController::Error($mod));
                    }
                    break;
                case 'modArticle' :
                    $mod = AdminController::modArticle();
                    if ($mod === 1){
                        AdminController::article();
                    }
                    else {
                        AdminController::article(ErrorController::Error($mod));
                    }
                    break;
                case 'delUser' :
                    $mod = AdminController::delUser();
                    if ($mod === 1){
                        AdminController::user();
                    }
                    else {
                        AdminController::user(ErrorController::Error($mod));
                    }
                    break;
                case 'userModify' :
                    $mod = AdminController::modUser();
                    if ($mod === 1){
                        AdminController::user();
                    }
                    else {
                        AdminController::user(ErrorController::Error($mod));
                    }
                    break;
            }
            break;

    }
}
else {
    IndexController::display();
}
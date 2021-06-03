<?php

use Controller\Classes\ConnectController;
use Controller\Classes\IndexController;

session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/import.php";

if (isset($_GET['ctrl'])){

    switch ($_GET['ctrl']){
        case 'connect' :
            ConnectController::display();
            break;
        case 'account':

            break;
        case 'form':
            switch ($_GET['action']){
                case 'connect':
                    $connec = ConnectController::connection();
                    if ($connec === 1){
                        IndexController::display();
                    }
                    else {

                    }
                    break;
            }
            break;
    }
}
else {
    IndexController::display();
}
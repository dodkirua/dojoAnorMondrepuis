<?php

use Controller\Classes\IndexController;

session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/import.php";

if (isset($_GET['ctrl'])){

    switch ($_GET['ctrl']){
        case 'connect' :

            break;
    }
}
else {
    (new IndexController())->display();
}
<?php

require_once './Model/DB.php';

require_once './Model/Entity/Interfaces/EntityInterface.php';
require_once './Model/Entity/Entity.php';
require_once './Model/Entity/Role.php';
require_once './Model/Entity/User.php';
require_once './Model/Entity/Comment.php';
require_once './Model/Entity/Article.php';

require_once './Model/Manager/Manager.php';
require_once './Model/Manager/RoleManager.php';
require_once './Model/Manager/UserManager.php';
require_once './Model/Manager/CommentManager.php';
require_once './Model/Manager/ArticleManager.php';

require_once './Controller/Classes/Controller.php';
require_once './Controller/Classes/PageController.php';
require_once './Controller/Classes/BlogController.php';
require_once './Controller/Classes/RegistrationController.php';
require_once './Controller/Classes/ConnectController.php';

require_once './Model/Utility/Security.php';
require_once './Model/Utility/Utility.php';


require_once './dev/Dev.php';
<?php

require_once './Model/DB.php';

require_once './Model/Entity/Interfaces/EntityInterface.php';
require_once './Model/Entity/Entity.php';
require_once './Model/Entity/Role.php';
require_once './Model/Entity/User.php';
require_once './Model/Entity/Comment.php';
require_once './Model/Entity/Article.php';
require_once './Model/Entity/Address.php';
require_once './Model/Entity/AddressBook.php';
require_once './Model/Entity/Attendance.php';
require_once './Model/Entity/CategoryAge.php';
require_once './Model/Entity/CategoryAgeArray.php';
require_once './Model/Entity/Competition.php';
require_once './Model/Entity/Dan.php';
require_once './Model/Entity/DanGetting.php';
require_once './Model/Entity/Group.php';
require_once './Model/Entity/GroupCategory.php';
require_once './Model/Entity/Lesson.php';
require_once './Model/Entity/Mail.php';
require_once './Model/Entity/Sms.php';
require_once './Model/Entity/Responsable.php';
require_once './Model/Entity/Result.php';

require_once './Model/Manager/Manager.php';
require_once './Model/Manager/RoleManager.php';
require_once './Model/Manager/UserManager.php';
require_once './Model/Manager/CommentManager.php';
require_once './Model/Manager/ArticleManager.php';
require_once './Model/Manager/AddressBookManager.php';
require_once './Model/Manager/AddressManager.php';
require_once './Model/Manager/AttendanceManager.php';
require_once './Model/Manager/CategoryAgeArrayManager.php';
require_once './Model/Manager/CategoryAgeManager.php';
require_once './Model/Manager/CompetitionManager.php';
require_once './Model/Manager/DanManager.php';
require_once './Model/Manager/DanGettingManager.php';
require_once './Model/Manager/GroupCategoryManager.php';
require_once './Model/Manager/GroupManager.php';
require_once './Model/Manager/LessonManager.php';
require_once './Model/Manager/MailManager.php';
require_once './Model/Manager/SmsManager.php';
require_once './Model/Manager/ResponsableManager.php';
require_once './Model/Manager/ResultManager.php';


require_once './Controller/Classes/Controller.php';
require_once './Controller/Classes/RegistrationController.php';
require_once './Controller/Classes/ConnectController.php';
require_once './Controller/Classes/IndexController.php';
require_once './Controller/Classes/ErrorController.php';
require_once './Controller/Classes/DisconnectController.php';

require_once './Model/Utility/Security.php';
require_once './Model/Utility/Utility.php';


require_once './dev/Dev.php';
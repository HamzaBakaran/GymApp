<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once '../vendor/autoload.php';


require_once 'services/UserService.class.php';
require_once 'services/MembershipService.class.php';

Flight::register('userService', 'UserService');
Flight::register('membershipService', 'MembershipService');

Flight::map('error', function(Exception $ex){
    // Handle error
    Flight::json(['message' => $ex->getMessage()], 500);
});

require_once './routes/UserRoutes.php';
require_once 'routes/MembershipRoutes.php';

Flight::start();
?>

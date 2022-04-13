<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__.'/../vendor/autoload.php';


require_once __DIR__.'/services/UserService.class.php';


require_once __DIR__.'/services/MembershipService.class.php';

Flight::register('userService', 'UserService');
Flight::register('membershipService', 'MembershipService');

Flight::map('error', function(Exception $ex){
    // Handle error
    Flight::json(['message' => $ex->getMessage()], 500);
});

require_once __DIR__.'/routes/UserRoutes.php';
require_once __DIR__.'/routes/MembershipRoutes.php';

Flight::start();
?>

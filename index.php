<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'rest/dao/ProjectDao.class.php';

require "vendor/autoload.php";







Flight::route("/",function(){
  $dao= new ProjectDao();
  $results=$dao->get_all();
  print_r($results);




});
Flight:: start();


 ?>

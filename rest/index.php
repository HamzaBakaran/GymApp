<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'dao/ProjectDao.class.php';

require_once '../vendor/autoload.php';


Flight::register('projectDao', 'ProjectDao');

// CRUD operations for todos entity

/**
* List all todos
*/
Flight::route('GET /users', function(){
  Flight::json(Flight::projectDao()->get_all());
});

/**
* List invidiual todo
*/
Flight::route('GET /users/@id', function($id){
  Flight::json(Flight::projectDao()->get_by_id($id));
});

/**
* add todo
*/
Flight::route('POST /users', function(){
  Flight::json(Flight::projectDao()->add(Flight::request()->data->getData()));
});

/**
* update todo
*/
Flight::route('PUT /users/@id', function($id){
  $data = Flight::request()->data->getData();
  $data['id'] = $id;
  Flight::json(Flight::projectDao()->update($data));
});

/**
* delete todo
*/
Flight::route('DELETE /users/@id', function($id){
  Flight::projectDao()->delete($id);
  Flight::json(["message" => "deleted"]);
});

Flight::start();


 ?>

<?php

// CRUD operations for todos entity



/**
* List all todos
*/
Flight::route('GET /users', function(){
  Flight::json(Flight::UserDao()->get_all());
});

/**
* List invidiual todo
*/
Flight::route('GET /users/@id', function($id){
  Flight::json(Flight::UserDao()->get_by_id($id));
});

/**
* add todo
*/
Flight::route('POST /users', function(){
  Flight::json(Flight::UserDao()->add(Flight::request()->data->getData()));
});

/**
* update todo
*/
Flight::route('PUT /users/@id', function($id){
  $data = Flight::request()->data->getData();
  $data['id'] = $id;
  Flight::json(Flight::UserDao()->update($data));
});

/**
* delete todo
*/
Flight::route('DELETE /users/@id', function($id){
  Flight::UserDao()->delete($id);
  Flight::json(["message" => "deleted"]);
});

Flight::start();


?>

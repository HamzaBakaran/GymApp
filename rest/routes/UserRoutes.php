<?php


use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::route('POST /login', function(){
    $login = Flight::request()->data->getData();
    $user = Flight::userDao()->get_user_by_email($login['email']);

    if (isset($user['id'])){
         if($user['password'] == md5($login['password'])){
            unset($user['password']);
           $jwt = JWT::encode($user, Config::JWT_SECRET(), 'HS256');
           Flight::json(['token' => $jwt]);
         }else{
           Flight::json(["message" => "Wrong password"], 404);
         }
       }else{
         Flight::json(["message" => "User doesn't exist"], 404);
       }

});


/**
* List all todos
*/
Flight::route('GET /users', function(){
  Flight::json(Flight::userService()->get_all());
});

/**
* List invidiual todo
*/
Flight::route('GET /users/@id', function($id){
  Flight::json(Flight::userService()->get_by_id($id));
});

/**
* add todo
*/
Flight::route('POST /users', function(){
  Flight::json(Flight::userService()->add(Flight::request()->data->getData()));
});

/**
* update todo
*/
Flight::route('PUT /users/@id', function($id){
  $data = Flight::request()->data->getData();
  $data['id'] = $id;
  Flight::json(Flight::userService()->update($data));
});

/**
* delete todo
*/
Flight::route('DELETE /users/@id', function($id){
  Flight::userService()->delete($id);
  Flight::json(["message" => "deleted"]);
});


?>

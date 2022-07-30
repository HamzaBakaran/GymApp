<?php


use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
* @OA\Post(
*     path="/login",
*     description="Login to the system",
*     tags={"users"},
*     @OA\RequestBody(description="Basic user info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="email", type="string", example="hamzabakaran@gmail.com",	description="Email"),
*    				@OA\Property(property="password", type="string", example="123",	description="Password" )
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="JWT Token on successful response"
*     ),
*     @OA\Response(
*         response=404,
*         description="Wrong Password | User doesn't exist"
*     )
* )
*/

Flight::route('POST /login', function(){
    $login = Flight::request()->data->getData();
    $user = Flight::userDao()->get_user_by_email($login['email']);

    if (isset($user['id'])){
         if($user['password'] == $login['password']){
            unset($user['password']);

            //$user['iat'] = time();
            //$user['exp'] = $user['iat'] + 20;
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
 * @OA\Get(path="/users", tags={"users"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all user  from the API. ",
 *         @OA\Response( response=200, description="List of notes.")
 * )
 */

/**
* List all todos
*/
Flight::route('GET /users', function(){
  Flight::json(Flight::userService()->get_all());
});
/**
 * @OA\Get(path="/users/{id}", tags={"users"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(in="path", name="id", example=1, description="Id of user"),
 *     @OA\Response(response="200", description="Fetch individual note")
 * )
 */


/**
* List invidiual todo
*/
Flight::route('GET /users/@id', function($id){
  Flight::json(Flight::userService()->get_by_id($id));
});

/**
* add todo
*/
/**
* @OA\Post(
*     path="/register",
*     description="Proba",
*     tags={"users"},
*     @OA\RequestBody(description="Basic user info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="name", type="string", example="Novi User",	description="Name"),
*    				@OA\Property(property="description", type="string", example="bla bla",	description="description"),
*    				@OA\Property(property="email", type="string", example="hamzabakaran@gmail.com",	description="Email"),
*    				@OA\Property(property="password", type="string", example="81dc9bdb52d04dc20036dbd8313ed055",	description="Password" )
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="JWT Token on successful response"
*     ),
*     @OA\Response(
*         response=404,
*         description="Wrong Password | User doesn't exist"
*     )
* )
*/
Flight::route('POST /register', function(){
  Flight::json(Flight::userService()->add(Flight::request()->data->getData()));
});

/**
* update todo
*/
/**
* @OA\Put(
*     path="/users/{id}", security={{"ApiKeyAuth": {}}},
*     description="Update user",
*     tags={"users"},
*     @OA\Parameter(in="path", name="id", example=1, description="Note ID"),
*     @OA\RequestBody(description="Basic note info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="name", type="string", example="Novi User",	description="Name"),
*    				@OA\Property(property="description", type="string", example="bla bla",	description="description"),
*    				@OA\Property(property="email", type="string", example="hamzabakaran@gmail.com",	description="Email"),
*    				@OA\Property(property="password", type="string", example="81dc9bdb52d04dc20036dbd8313ed055",	description="Password" )
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Note that has been updated"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
Flight::route('PUT /users/@id', function($id){
  $data = Flight::request()->data->getData();
  //$data['id'] = $id;
  Flight::json(Flight::userService()->update(Flight::get('user'), $id, $data));;

});

/**
* delete todo
*/
/**
* @OA\Delete(
*     path="/users/{id}", security={{"ApiKeyAuth": {}}},
*     description="Delete ",
*     tags={"users"},
*     @OA\Parameter(in="path", name="id", example=5, description="User ID"),
*     @OA\Response(
*         response=200,
*         description="User deleted"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
Flight::route('DELETE /users/@id', function($id){
  Flight::userService()->delete($id);
  Flight::json(["message" => "deleted"]);
});
/**
 * @OA\Get(path="/userscount", tags={"users"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return users count ",
 *         @OA\Response( response=200, description="users count")
 * )
 */

/**
* List all todos
*/
Flight::route('GET /userscount', function(){
  Flight::json(Flight::userService()->get_user_count());
});
/**
 * @OA\Get(path="/usersactive", tags={"users"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return users active count ",
 *         @OA\Response( response=200, description="users active count")
 * )
 */

/**
* List all todos
*/
Flight::route('GET /usersactive', function(){
  Flight::json(Flight::userMembershipService()->get_users_active());
});





?>

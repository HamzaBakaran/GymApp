<?php


// CRUD operations for todos entity

/**
 * @OA\Get(path="/membership", tags={"membership"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all user membership from the API. ",
 *         @OA\Response( response=200, description="List of notes.")
 * )
 */

/**
* List all todos
*/
Flight::route('GET /membership', function(){
  Flight::json(Flight::membershipService()->get_all());
});

/**
* List invidiual todo
*/
/**
 * @OA\Get(path="/membership/{id}", tags={"membership"}, security={{"ApiKeyAuth": {}}},
 *      summary="Return  membership by user id  from the API. ",
 *     @OA\Parameter(in="path", name="id", example=1, description="Id of membership"),
 *     @OA\Response(response="200", description="Fetch individual note")
 * )
 */
Flight::route('GET /membership/@id', function($id){
  Flight::json(Flight::membershipService()->get_by_id($id));
});

/**
* add todo
*/
/**
* @OA\Post(
*     path="/membership",
*     description="Proba",
*     tags={"membership"},
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
Flight::route('POST /membership', function(){
  Flight::json(Flight::membershipService()->add(Flight::request()->data->getData()));
});

/**
* update todo
*/
Flight::route('PUT /membership/@id', function($id){
  $data = Flight::request()->data->getData();
  $data['id'] = $id;
  Flight::json(Flight::MemberDao()->update($data));
});

/**
* delete todo
*/
Flight::route('DELETE /membership/@id', function($id){
  Flight::MembersshipDao()->delete($id);
  Flight::json(["message" => "deleted"]);
});


?>

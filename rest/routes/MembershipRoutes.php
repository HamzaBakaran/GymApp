<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


// CRUD operations for todos entity

/**
 * @OA\Get(path="/membership", tags={"membership"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all  membership from the API. ",
 *         @OA\Response( response=200, description="List of mebership.")
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
*    				@OA\Property(property="description", type="string", example="test",	description="description"),
*    				@OA\Property(property="price", type="double", example="50",	description="description"),
*
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
/**
* @OA\Put(
*     path="/membership/{id}", security={{"ApiKeyAuth": {}}},
*     description="Update user note",
*     tags={"membership"},
*     @OA\Parameter(in="path", name="id", example=1, description="Note ID"),
*     @OA\RequestBody(description="Basic note info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="description", type="string", example="test",	description="description"),
*    				@OA\Property(property="price", type="double", example="50",	description="description"),
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
Flight::route('PUT /membership/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::membershipService()->update(Flight::get('user'), $id, $data));

});
/**
* @OA\Delete(
*     path="/membership/{id}", security={{"ApiKeyAuth": {}}},
*     description="Delete ",
*     tags={"membership"},
*     @OA\Parameter(in="path", name="id", example=5, description="Membership ID"),
*     @OA\Response(
*         response=200,
*         description="Membership deleted"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/

/**
* delete todo
*/
Flight::route('DELETE /membership/@id', function($id){
  Flight::membershipService()->delete($id);
  Flight::json(["message" => "deleted"]);
});


?>

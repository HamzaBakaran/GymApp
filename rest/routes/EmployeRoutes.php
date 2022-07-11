<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**

 * @OA\Get(path="/employe", tags={"employe"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all employes from the API. ",
 *         @OA\Response( response=200, description="List of employes.")
 * )
 */

Flight::route('GET /employe', function(){
  Flight::json(Flight::employeService()->get_all());
});

/**
 * @OA\Get(path="/employe/{id}", tags={"employe"}, security={{"ApiKeyAuth": {}}},
 *      summary="Return  employe by  id  from the API. ",
 *     @OA\Parameter(in="path", name="id", example=1, description="Id of employe"),
 *     @OA\Response(response="200", description="Fetch individual employe")
 * )
 */
Flight::route('GET /employe/@id', function($id){
  Flight::json(Flight::employeService()->get_employe_by_id($id));
});

/**
* @OA\Post(
*     path="/employereg",
*     description="Proba",
*     tags={"employe"},
*     @OA\RequestBody(description="Basic employe info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="name", type="string", example="Novi eployee name",	description="Name"),
*    				@OA\Property(property="surname", type="string", example="Surname",	description="Surname"),
*    				@OA\Property(property="email", type="string", example="employe@gmail.com",	description="Email"),
*    				@OA\Property(property="status", type="string", example="active",	description="status" ),
*    				@OA\Property(property="position", type="string", example="gym coach",	description="position" )
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


Flight::route('POST /employereg', function(){
  Flight::json(Flight::employeService()->add(Flight::request()->data->getData()));
});

/**
* @OA\Put(
*     path="/employe/{id}", security={{"ApiKeyAuth": {}}},
*     description="Update employe",
*     tags={"employe"},
*     @OA\Parameter(in="path", name="id", example=1, description="Note ID"),
*     @OA\RequestBody(description="Basic note info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="name", type="string", example="Novi eployee name",	description="Name"),
*    				@OA\Property(property="surname", type="string", example="Surname",	description="Surname"),
*    				@OA\Property(property="email", type="string", example="employe@gmail.com",	description="Email"),
*    				@OA\Property(property="status", type="string", example="active",	description="status" ),
*    				@OA\Property(property="position", type="string", example="gym coach",	description="position" )
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
Flight::route('PUT /employe/@id', function($id){
  $data = Flight::request()->data->getData();
  //$data['id'] = $id;
  Flight::json(Flight::employeService()->update(Flight::get('user'), $id, $data));;

});
/**
* @OA\Delete(
*     path="/employe/{id}", security={{"ApiKeyAuth": {}}},
*     description="Delete ",
*     tags={"employe"},
*     @OA\Parameter(in="path", name="id", example=5, description="User ID"),
*     @OA\Response(
*         response=200,
*         description="employe deleted"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
Flight::route('DELETE /employe/@id', function($id){
  Flight::employeService()->delete($id);
  Flight::json(["message" => "deleted"]);
});
/**
 * @OA\Get(path="/employes_active", tags={"employe"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return employe active count ",
 *         @OA\Response( response=200, description="Empoye active count")
 * )
 */



Flight::route('GET /employes_active', function(){
  Flight::json(Flight::employeService()->get_employe_count());
});




?>

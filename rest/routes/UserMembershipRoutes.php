<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


// CRUD operations for todos entity

/**
 * @OA\Get(path="/usermembership", tags={"usermembership"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all user membership from the API. ",
 *         @OA\Response( response=200, description="List of mebership.")
 * )
 */

/**
* List all todos
*/
Flight::route('GET /usermembership', function(){
  Flight::json(Flight::userMembershipService()->get_users_membership());
});
/**
 * @OA\Get(path="/usermembership/{id}", tags={"usermembership"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(in="path", name="id", example=1, description="Id of user"),
 *     @OA\Response(response="200", description="Fetch individual note")
 * )
 */


/**
* List invidiual todo
*/
Flight::route('GET /usermembership/@id', function($id){
  Flight::json(Flight::userMembershipService()->get_users_membership_by_id($id));
});

/**
* @OA\Post(
*     path="/usermembership",
*     description="Proba",
*     tags={"usermembership"},
*     @OA\RequestBody(description="Basic user info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="user_id", type="integer", example="1",	description="User ID"),
*    				@OA\Property(property="membership_id", type="integer", example="1",	description="Membership ID"),
*    				@OA\Property(property="start_date", type="date", example="2022-06-02",	description="Start date"),
*    				@OA\Property(property="end_date", type="date", example="2022-07-02",	description="End date")
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
Flight::route('POST /usermembership', function(){
  Flight::json(Flight::userMembershipService()->add(Flight::request()->data->getData()));
});

/**
* @OA\Put(
*     path="/usermembership/{id}", security={{"ApiKeyAuth": {}}},
*     description="Update user note",
*     tags={"usermembership"},
*     @OA\Parameter(in="path", name="id", example=1, description="Note ID"),
*     @OA\RequestBody(description="Basic note info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="user_id", type="integer", example="1",	description="User ID"),
*    				@OA\Property(property="membership_id", type="integer", example="1",	description="Membership ID"),
*    				@OA\Property(property="start_date", type="date", example="2022-06-02",	description="Start date"),
*    				@OA\Property(property="end_date", type="date", example="2022-07-02",	description="End date")
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
Flight::route('PUT /usermembership/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::userMembershipService()->update(Flight::get('user'), $id, $data));

});
/**
* @OA\Delete(
*     path="/usermembership/{id}", security={{"ApiKeyAuth": {}}},
*     description="Delete ",
*     tags={"usermembership"},
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
Flight::route('DELETE /usermembership/@id', function($id){
  Flight::userMembershipService()->delete($id);
  Flight::json(["message" => "deleted"]);
});
/**
 * @OA\Get(path="/earned", tags={"users"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return users active count ",
 *         @OA\Response( response=200, description="Earned last 30 days")
 * )
 */

/**
* List all todos
*/
Flight::route('GET /earned', function(){
  Flight::json(Flight::userMembershipService()->get_earned());
});
/**
 * @OA\Get(path="/last_active/{id}", tags={"usermembership"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(in="path", name="id", example=1, description="Id of user"),
 *     @OA\Response(response="200", description="Fetch individual note")
 * )
 */


/**
* List invidiual todo
*/
Flight::route('GET /last_active/@id', function($id){
  Flight::json(Flight::userMembershipService()->get_last_active_membership($id));
});
/**
 * @OA\Get(path="/last_memberships/{id}", tags={"usermembership"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(in="path", name="id", example=1, description="Id of user"),
 *     @OA\Response(response="200", description="Fetch all memberships by user id ")
 * )
 */


/**
* List invidiual todo
*/
Flight::route('GET /last_memberships/@id', function($id){
  Flight::json(Flight::userMembershipService()->get_last_memberships($id));
});





?>

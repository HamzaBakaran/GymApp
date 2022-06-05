<?php


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
  Flight::json(Flight::userMembershipService()->get_all());
});
/**
 * @OA\Get(path="/usermembership/{id}", tags={"usersmembership"}, security={{"ApiKeyAuth": {}}},
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
?>

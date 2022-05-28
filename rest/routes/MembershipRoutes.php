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

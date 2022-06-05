<?php
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


?>

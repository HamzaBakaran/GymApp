<?php
require_once __DIR__.'/BaseDao.class.php';

class EmployeDao extends BaseDao{
  /**
  * constructor of dao class
  */
  public function __construct(){
    parent::__construct("employes");
  }
  public function get_employe_by_id($id){
    return $this->query("SELECT * FROM employes WHERE id = :id", ['id' => $id]);
  }
  public function delete($id){
    parent::delete($id);

  }


}

?>

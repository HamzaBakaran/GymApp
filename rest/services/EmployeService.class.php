<?php
require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../Dao/EmployeDao.class.php';

class EmployeService extends BaseService{

  public function __construct(){
    parent::__construct(new EmployeDao());
  }
  public function get_employe_by_id($id){
    return $this->dao->get_employe_by_id($id);
  }
  public function  get_employe_count(){
    return $this->dao-> get_employe_count();
  }
  public function delete($id){
    return $this->dao->delete($id);
  }
}
?>

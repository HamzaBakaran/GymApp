<?php
require_once __DIR__.'/BaseDao.class.php';

class MembershipDao extends BaseDao{

  /**
  * constructor of dao class
  */
  public function __construct(){
    parent::__construct("membership");
  }
  public function get_membership_by_user_id($user_id){
    return $this->query("SELECT * FROM membership WHERE user_id = :user_id", ['user_id' => $user_id]);
  }
  public function delete($id){
    parent::delete($id);

  }
}




?>

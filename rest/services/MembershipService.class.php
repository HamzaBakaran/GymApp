<?php
require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/MembershipDao.class.php';

class MembershipService extends BaseService{

  public function __construct(){
    parent::__construct(new MembershipDao());
  }
  public function get_membership_by_user_id($user_id){
    return $this->dao->get_membership_by_user_id($user_id);
  }

}
?>

<?php
require_once __DIR__.'/BaseDao.class.php';

class UserMembershipDao extends BaseDao{
  /**
  * constructor of dao class
  */
  public function __construct(){
    parent::__construct("users_membership");
  }
  public function get_users_membership_by_id($users_id){
     $query="SELECT users_membership.`id`,users.`name`,membership.`description`,users_membership.`start_date`,users_membership.`end_date` FROM users_membership JOIN users ON users.`id`=users_membership.`user_id` JOIN membership ON membership.`id`=users_membership.`membership_id`  WHERE users.`id`= :users_id";
      return $this->query($query, ['users_id' => $users_id]);
   }


}

?>

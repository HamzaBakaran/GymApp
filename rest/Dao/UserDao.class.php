<?php
require_once __DIR__.'/BaseDao.class.php';

class UserDao extends BaseDao{
  /**
  * constructor of dao class
  */
  public function __construct(){
    parent::__construct("users");
  }

  public function get_user_by_email($email){
     return $this->query_unique("SELECT * FROM users WHERE email = :email", ['email' => $email]);
   }
   public function get_user_count(){
      return $this->query_single(" SELECT COUNT(users.`id`) as count
FROM users");
    }
  

}

?>

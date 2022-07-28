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
    public function get_last_active_membership($id){
       return $this->query_unique(" SELECT end_date FROM users_membership
                                    WHERE user_id= :id
                                    ORDER BY end_date DESC
                                    LIMIT 1", ['id' => $id]);

     }

}

?>

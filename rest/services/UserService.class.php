<?php
require_once __DIR__.'/BaseService.class.php';
 //require_once __DIR__.'/rest/Dao/UserDao.class.php';
 require_once __DIR__.'/../Dao/UserDao.class.php';
// C:\Bitnami\wampstack-8.1.2-0\apache2\htdocs\first\rest\Dao
class UserService extends BaseService{

  public function __construct(){
    parent::__construct(new UserDao());
  }
  public function  get_user_count(){
    return $this->dao-> get_user_count();
  }




}
?>

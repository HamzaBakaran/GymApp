<?php
require_once __DIR__.'/BaseService.class.php';
// require_once __DIR__.'/../Dao/UserDao.class.php';
require_once(realpath(dirname(__FILE__) . ''/../Dao/UserDao.class.php'));

class UserService extends BaseService{

  public function __construct(){
    parent::__construct(new UserDao());
  }


}
?>

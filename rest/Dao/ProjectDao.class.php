

  <?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  class ProjectDao {

    private $conn;

    /**
    * constructor of dao class
    */
    public function __construct(){
      $servername = "localhost:3307";
      $username = "root";
      $password = "13062000";
      $schema = "gymdb";
      $this->conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);

      if($this->conn){
        echo 'connected ';
      }
      // set the PDO error mode to exception
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
    * Method used to read all todo objects from database
    **/
    public function get_all(){
      $stmt = $this->conn->prepare("SELECT * FROM users");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


  /**
    * Method used to add todo to the database
/**
    public function add($name){
      $stmt = $this->conn->prepare("INSERT INTO users (name) VALUES (:name)");
      $stmt->execute(['name' => $name);
    }

    /**
    * Delete todo record from the database

    public function delete($id){
      $stmt = $this->conn->prepare("DELETE FROM users WHERE id=:id");
      $stmt->bindParam(':id', $id); // SQL injection prevention
      $stmt->execute();
    }

    /**
    * Update todo record

    public function update($id, $name){
      $stmt = $this->conn->prepare("UPDATE users SET name=:name  WHERE id=:id");
      $stmt->execute(['id' => $id, ' name ' => $name);
    }
    **/

  }

  ?>

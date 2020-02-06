<?php
  //Define all variable for connection
  define("user", "root");
  define("pass", "");
  define("host", "localhost");
  define("db", "djwebsite");
  // Class connection
  class connection
  {
    private $host = host;
    private $user = user;
    private $pass = pass;
    private $db = db;
    protected $conn;
    public $error;
    // Define function
    public function connect()
    {
      $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
      if(!$this->conn){
        $this->error = "Unable to connect to any database.";
      }
      return false;
    }
  }
?>

<?php

class Database
{



    private $hostname = "localhost";
    private $username = "root";


    private $password = "";
    private $dbname = "crud-oop";

    private $conn;








    public function connect()
    {


        $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->dbname, );


        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        else {
           // echo "connected  successfully";
          return $this->conn;          

        }










    /*  if (!$this->conn) {
     die(' problem connection' . mysqli_connect_error());
     } else {
     echo "connect with DB";
     return $this->conn;
     
     } */
    }
}
$db = new Database();
$db->connect();
<?php
namespace Classes\Lib;
use PDO;
use PDOException;
use mysqli;

class Database {
  
    const HOST = 'localhost';
    const DB_NAME = 'school';
    const DB_USER = 'root';
    const DB_PASS = 'rootroot';

    protected $connection;

    function __construct()
    {
        $connection = new mysqli(self::HOST, self::DB_USER, self::DB_PASS, self::DB_NAME);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        $this->connection = $connection;
    }

    /**
     * connection to database
     *
     * @return $connection
     */
    private function connect()
    {
        $connection = new mysqli(self::HOST, self::DB_USER, self::DB_PASS, self::DB_NAME);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        return $connection;
    }

    /**
     * returns student grades 
     *
     * @param [type] $id
     * @return array
     */
    public function doSelectStudentGrades($id)
    {
        $connection = $this->connect();

        $query = 'SELECT grade from grades WHERE sid = ' .$id;
        $result = mysqli_query($connection, $query);

        $response = [];
        if ($result->num_rows > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $response[] = $row;
            }
        }

        return $response;
    }
}

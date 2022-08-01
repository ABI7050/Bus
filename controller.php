<?php

class Controller {

    private $host = 'localhost';
    private $user = 'ziviadmin';
    private $password = 'zivi@access';
    private $database = 'busscheduledb';

    // private $host = 'localhost';
    // private $user = 'root';
    // private $password = '';
    // private $database = 'busscheduledb';

    private $conn;

    public function __construct() {
        $this->conn = $this->connectDB();
    }

    public function connectDB() {
        $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);

        return $conn;
    }

    public function last_insert_db() {
        $id = mysqli_insert_id($this->conn);

        return $id;
        mysqli_close($this->conn);
    }

    public function escape_string($string) {
        $newstring = mysqli_real_escape_string($this->conn, $string);

        return $newstring;
    }

    public function runQuery($query) {

        $resultset = [];
        $count = $this->numRows($query);
        if ($count) {
            $result = mysqli_query($this->conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $resultset[] = $row;
            }
        }

        return $resultset;
        mysqli_close($this->conn);

        exit;
    }

    public function runOneQuery($query) {

        $resultset = [];
        $count = $this->numRows($query);
        if ($count) {
            $result = mysqli_query($this->conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $resultset = $row;
            }
        }

        return $resultset;
        mysqli_close($this->conn);
        exit;
    }

    public function numRows($query) {
        $result = mysqli_query($this->conn, $query);
        $rowcount = mysqli_num_rows($result);

        return $rowcount;
        mysqli_close($this->conn);
    }

    public function insertQuery($query) {
        $qry = mysqli_query($this->conn, $query);
        if ($qry) {
            return true;
        } else {
            return false;
        }
    }

    public function getCount($table) {
        $sql = "SELECT count(*) AS tablecount FROM $table ";
        $qry = mysqli_query($this->conn, $sql);
        $count = mysqli_fetch_assoc($qry);
        if ($qry) {
            return $count['tablecount'];
        } else {
            return 0;
        }
        mysqli_close($this->conn);
    }

    public function check_user_login() {
        return (isset($_SESSION['userId']) && isset($_SESSION['role']));
    }

    public function check_admin() {
        return (isset($_SESSION['userId']) && $_SESSION['userId'] == 1 && isset($_SESSION['role']) && $_SESSION['role'] == 1);
    }
}
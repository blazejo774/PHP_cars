<?php

require_once 'template.php';

//-----------------------------------------------------------------------------
// Class dbQuery
//-----------------------------------------------------------------------------
class dbQuery {

    private $res = null;
    private $con = null;

    //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    // private functions
    //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

    private function connect() {
        if ($this->con != null) {
            return $this->con;
        }

        try {
            $conn = new mysqli("localhost", "boso", "kernel21", "boso");
        } catch (Exception $exception) {

            $cnt = "<h1>SQL connection error</h1>"
                . "<h4>SQL message</h4><p>{$exception->getMessage()}";
            echo getPage(getMainMenu(), getSideMenu(), $cnt);
            die();
        }

        $sql = "SET NAMES 'utf8'";
        $conn->query($sql);

        $this->con = $conn;
        return $conn;
    }

    private function query($sql) {
        $this->con = $this->connect();

        try {
            $this->res = $this->con->query($sql);
        } catch (Exception $exception) {

            $cnt = "<h1>SQL query error</h1>"
                . "<h4>SQL message</h4>"
                . "<p>{$exception->getMessage()}<h4>SQL query</h4><p>{$sql}";
            echo getPage(getMainMenu(), getSideMenu(), $cnt);
            die();
        }
    }

    //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    // public functions
    //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

    public function __construct($sql) {
        $this->connect();
        $this->query($sql);
    }

    public function next() {
        return $this->res->fetch_assoc();
    }

    public function rows() {
        return $this->con->affected_rows;
    }
    
}

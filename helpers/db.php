<?php

class DB
{
    public $conn;
    public $actions;

    function __construct()
    {
        $this->conn = mysqli_connect($_ENV["DB_HOST"], $_ENV["DB_USERNAME"], $_ENV["DB_PASSWORD"], $_ENV["DB_NAME"]);
        $this->actions = new Actions();
    }

    function query($q)
    {
        $res = mysqli_query($this->conn, $q);
        if (gettype($res) == "object") {
            return $res->fetch_all(MYSQLI_ASSOC);
        } else {
            return $res;
        }
    }

}

<?php
class Users extends DB {
    function createUser($name, $email, $password)
    {
        try {
            if (!isset($password)) {
                throw "password_absence";
            }
            return $this->query(
                "INSERT INTO user(name, email, password) VALUES(\"" .
                    $name . "\", \"" . $email . "\", \"" .
                    $this->actions->hash($password) . "\")"
            );
        } catch (Exception $e) {
            return $e;
        }
    }
    function getUser($name)
    {
        $user =  $this->query("SELECT id, name, description, role FROM user WHERE name LIKE \"%" . $name . "%\"");
        unset($user["password"]);
        return $user;
    }
    function logIn($name, $password)
    {
        $user = $this->query("SELECT * FROM user WHERE name LIKE \"%" . $name . "%\"")[0];
        if (isset($user["password"])) {
            if ($this->actions->hash($password) == $user["password"]) {
                unset($user["password"]);
                return $user;
            }
            throw new Exception("password_absence");
        } else {
            throw new Exception("password_incorrect");
        }
    }
    function getUsersBooks($id) {
        return $this->query("SELECT * FROM book WHERE author=" . $id);
    }
}
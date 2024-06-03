<?php
include "dotenv.php";

use Firebase\JWT\JWT;

class Actions
{
    function hash($password)
    {
        return hash("sha256", $password);
    }
    function generateToken($payload)
    {
        return JWT::encode($payload, $_ENV["JWT_TOKEN"], "HS256");
    }
    function verifyToken($token)
    {
        try {
            return JWT::decode($token, $_ENV["JWT_TOKEN"]);
        } catch (Exception $e) {
            return $e;
        }
    }
}

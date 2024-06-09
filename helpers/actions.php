<?php
include "dotenv.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

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
            return JWT::decode($token, new Key($_ENV["JWT_TOKEN"], "HS256"));
        } catch (Exception $e) {
            return $e;
        }
    }
}

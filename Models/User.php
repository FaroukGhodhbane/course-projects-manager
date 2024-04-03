<?php

require_once 'Database.php';

class User
{
    public static function create($username, $email, $password)
    {
        $db = Database::getDB();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";

        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $hashedPassword);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function findByUsername($username)
    {
        $db = Database::getDB();
        $query = "SELECT * FROM users WHERE username = :username";
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();
        return $user;
    }

    public static function findByEmail($email)
    {
        $db = Database::getDB();
        $query = "SELECT * FROM users WHERE email = :email";
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();
        return $user;
    }
}

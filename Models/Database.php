<?php

class Database
{
    private static $dsn = 'mysql:host=localhost;dbname=course_projects_manager';
    private static $username = 'root';
    private static $password = '';
    private static $db;

    public static function getDB()
    {
        if (!isset (self::$db)) {
            try {
                self::$db = new PDO(self::$dsn, self::$username, self::$password);
            } catch (PDOException $e) {
                $error = 'Database Error: ' . $e->getMessage();
                include ('views/error.php');
                exit();
            }
        }
        return self::$db;
    }
}

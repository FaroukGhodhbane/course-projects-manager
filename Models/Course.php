<?php

require_once 'Database.php';

class Course
{
    public static function get_courses()
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM courses ORDER BY courseID';
        $statement = $db->prepare($query);
        $statement->execute();
        $courses = $statement->fetchAll();
        $statement->closeCursor();
        return $courses;
    }

    public static function delete_course($courseID)
    {
        $db = Database::getDB();
        $query = 'DELETE FROM courses WHERE courseID = :courseID';
        $statement = $db->prepare($query);
        $statement->bindValue(':courseID', $courseID);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function add_course($courseName)
    {
        $db = Database::getDB();
        $query = 'INSERT INTO courses (courseName) VALUES (:courseName)';
        $statement = $db->prepare($query);
        $statement->bindValue(':courseName', $courseName);
        $statement->execute();
        $statement->closeCursor();
    }



}

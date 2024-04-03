<?php

require_once 'Database.php';

class Course
{
    public static function get_courses($userID)
    {
        $db = Database::getDB();
        // Adjust the query to select courses based on the userID
        $query = 'SELECT * FROM courses WHERE userID = :userID ORDER BY courseID';
        $statement = $db->prepare($query);
        $statement->bindValue(':userID', $userID);
        $statement->execute();
        $courses = $statement->fetchAll();
        $statement->closeCursor();
        return $courses;
    }

    // Deletes a specific course by courseID
    public static function delete_course($courseID)
    {
        $db = Database::getDB();
        $query = 'DELETE FROM courses WHERE courseID = :courseID';
        $statement = $db->prepare($query);
        $statement->bindValue(':courseID', $courseID);
        $statement->execute();
        $statement->closeCursor();
    }

    // Adds a new course with the course name and associated userID
    public static function add_course($courseName, $userID)
    {
        $db = Database::getDB();
        $query = 'INSERT INTO courses (courseName, userID) VALUES (:courseName, :userID)';
        $statement = $db->prepare($query);
        $statement->bindValue(':courseName', $courseName);
        $statement->bindValue(':userID', $userID);
        $statement->execute();
        $statement->closeCursor();
    }

    // Updates a course's name by courseID
    public static function update_course($courseID, $courseName)
    {
        $db = Database::getDB();
        $query = "UPDATE courses SET courseName = :courseName WHERE courseID = :courseID";
        $statement = $db->prepare($query);
        $statement->bindValue(':courseID', $courseID);
        $statement->bindValue(':courseName', $courseName);
        $statement->execute();
        $statement->closeCursor();
    }
}

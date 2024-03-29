<?php

require_once 'Database.php';

class Project
{
    public static function get_projects_by_course($courseID)
    {
        $db = Database::getDB();
        $query = $courseID ?
            'SELECT P.id, P.projectName, P.description, P.status, C.courseName FROM projects P LEFT JOIN courses C ON P.courseID = C.courseID WHERE P.courseID = :courseID ORDER BY C.courseName, P.id' :
            'SELECT P.id, P.projectName, P.description, P.status, C.courseName FROM projects P LEFT JOIN courses C ON P.courseID = C.courseID ORDER BY C.courseName, P.id';
        $statement = $db->prepare($query);
        if ($courseID) {
            $statement->bindValue(':courseID', $courseID, PDO::PARAM_INT);
        }
        $statement->execute();
        $projects = $statement->fetchAll();
        $statement->closeCursor();
        return $projects;
    }


    public static function delete_project($projectID)
    {
        $db = Database::getDB();
        $query = 'DELETE FROM projects WHERE id = :projectID';
        $statement = $db->prepare($query);
        $statement->bindValue(':projectID', $projectID);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function add_project($projectName, $description, $status, $courseID)
    {
        $db = Database::getDB();
        $query = 'INSERT INTO projects (projectName, description, status, courseID) VALUES (:projectName, :description, :status, :courseID)';
        $statement = $db->prepare($query);
        $statement->bindValue(':projectName', $projectName);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':status', $status);
        $statement->bindValue(':courseID', $courseID);
        $statement->execute();
        $statement->closeCursor();
    }

}


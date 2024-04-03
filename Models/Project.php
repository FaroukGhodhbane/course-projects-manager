<?php

require_once 'Database.php';

class Project
{
    public static function get_projects_by_user_and_course($userID, $courseID = null)
    {
        $db = Database::getDB();
        // Adjust the query to include a condition for filtering by userID.
        // Optionally filter by courseID if it's provided.
        $query = 'SELECT P.id, P.projectName, P.description, P.status, C.courseName 
              FROM projects P 
              LEFT JOIN courses C ON P.courseID = C.courseID 
              WHERE P.userID = :userID ' .
            ($courseID ? 'AND P.courseID = :courseID ' : '') .
            'ORDER BY C.courseName, P.id';
        $statement = $db->prepare($query);

        // Bind the userID to the query
        $statement->bindValue(':userID', $userID, PDO::PARAM_INT);

        // Conditionally bind the courseID if it's provided
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

    public static function add_project($projectName, $description, $status, $courseID, $userID)
    {
        $db = Database::getDB();
        $query = 'INSERT INTO projects (projectName, description, status, courseID, userID) VALUES (:projectName, :description, :status, :courseID, :userID)';
        $statement = $db->prepare($query);
        $statement->bindValue(':projectName', $projectName);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':status', $status);
        $statement->bindValue(':courseID', $courseID);
        $statement->bindValue(':userID', $userID);
        $statement->execute();
        $statement->closeCursor();
    }

}


<?php

require_once 'Models/Database.php';
require_once 'Models/Project.php';
require_once 'Models/Course.php';

class ProjectsController
{
    public function listProjects($courseID = null)
    {
        $userID = $_SESSION['userID']; // Assume userID is stored in session upon login
        $courseID = filter_input(INPUT_GET, 'courseID', FILTER_VALIDATE_INT);

        // Updated to fetch projects based on userID and optional courseID
        $projects = Project::get_projects_by_user_and_course($userID, $courseID);
        $courses = Course::get_courses($userID);
        include 'views/projects/index.php';
    }

    public function addProject()
    {
        $userID = $_SESSION['userID'];

        $courseID = filter_input(INPUT_POST, 'courseID', FILTER_VALIDATE_INT);
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $projectName = isset($_POST['projectName']) ? $_POST['projectName'] : '';
        $status = isset($_POST['status']) ? $_POST['status'] : '';

        if ($projectName && $description && $status && $courseID) {
            // Updated to include userID when adding a project
            Project::add_project($projectName, $description, $status, $courseID, $userID);
            header("Location: .?courseID=$courseID&action=list_projects");
            exit;
        } else {
            $error = "Invalid project data.";
            include 'views/error.php';
            exit();
        }
    }

    public function deleteProject()
    {
        $projectID = filter_input(INPUT_POST, 'projectID', FILTER_VALIDATE_INT);
        if ($projectID) {
            Project::delete_project($projectID);
            $courseID = filter_input(INPUT_POST, 'courseID', FILTER_VALIDATE_INT);
            // To redirect back to the correct course
            header("Location: .?courseID=$courseID&action=list_projects");
            exit;
        } else {
            $error = "Missing or invalid project id.";
            include 'views/error.php';
            exit();
        }
    }

}

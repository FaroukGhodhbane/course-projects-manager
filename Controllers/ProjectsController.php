<?php

require_once 'Models/Database.php';
require_once 'Models/Project.php';

class ProjectsController
{
    public function listProjects($courseID = null)
    {
        $courseID = filter_input(INPUT_GET, 'courseID', FILTER_VALIDATE_INT);
        $projects = Project::get_projects_by_course($courseID);
        $courses = Course::get_courses();
        include 'views/projects/index.php';
    }

    public function addProject()
    {
        $courseID = filter_input(INPUT_POST, 'courseID', FILTER_VALIDATE_INT);
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $projectName = isset($_POST['projectName']) ? $_POST['projectName'] : '';
        $status = isset($_POST['status']) ? $_POST['status'] : '';


        if ($projectName && $description && $status && $courseID) {
            Project::add_project($projectName, $description, $status, $courseID);
            header("Location: .?courseID=$courseID&action=list_projects");
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
            $courseID = filter_input(INPUT_POST, 'courseID', FILTER_VALIDATE_INT); // To redirect back to the correct course
            header("Location: .?courseID=$courseID&action=list_projects");
        } else {
            $error = "Missing or invalid project id.";
            include 'views/error.php';
        }
    }

}

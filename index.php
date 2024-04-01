<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

// require controller files
require_once 'Controllers/CoursesController.php';
require_once 'Controllers/ProjectsController.php';

// Instantiate controllers
$coursesController = new CoursesController();
$projectsController = new ProjectsController();

// Attempt to get 'action' from POST, then from GET, with a default of 'list_courses'
$action = filter_input(INPUT_POST, 'action') ??
    filter_input(INPUT_GET, 'action') ??
    'list_courses';

// Simplify method check
$isPost = $_SERVER['REQUEST_METHOD'] === 'POST';

// Route the action to the appropriate controller method
switch ($action) {
    case 'list_courses':
        $coursesController->listCourses();
        break;
    case 'add_course':
        if ($isPost)
            $coursesController->addCourse();
        break;
    case 'delete_course':
        if ($isPost)
            $coursesController->deleteCourse();
        break;
    case 'list_projects':
        $projectsController->listProjects();
        break;
    case 'add_project':
        if ($isPost)
            $projectsController->addProject();
        break;
    case 'delete_project':
        if ($isPost)
            $projectsController->deleteProject();
        break;
    case 'update_courses':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $coursesController->updateCourses();
        }
        break;
}

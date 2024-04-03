<?php
session_start(); // Ensure session is started for authentication checks
ini_set('display_errors', 1);
error_reporting(E_ALL);

// require controller files
require_once 'Controllers/RegisterController.php';
require_once 'Controllers/LoginController.php';
require_once 'Controllers/LogoutController.php';
require_once 'Controllers/CoursesController.php';
require_once 'Controllers/ProjectsController.php';

// Instantiate controllers
$registerController = new RegisterController();
$loginController = new LoginController();
$logoutController = new LogoutController();
$coursesController = new CoursesController();
$projectsController = new ProjectsController();

// Default action based on user authentication
$defaultAction = isset($_SESSION['userID']) ? 'list_courses' : 'login';
$action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action') ?? $defaultAction;

$isPost = $_SERVER['REQUEST_METHOD'] === 'POST';

// Route the action to the appropriate controller method
switch ($action) {
    case 'login':
        $loginController->showLoginForm();
        break;
    case 'handle_login':
        if ($isPost) {
            $loginController->handleLogin();
        }
        break;
    case 'logout':
        if ($isPost) {
            $logoutController->logout();
        }
        break;
    case 'register':
        $registerController->showRegisterForm();
        break;
    case 'handle_register':
        if ($isPost) {
            $registerController->handleRegister();
        }
        break;
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

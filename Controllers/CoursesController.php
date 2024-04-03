<?php

require_once 'Models/Database.php';
require_once 'Models/Course.php';


class CoursesController
{

    public function listCourses()
    {
        $userID = $_SESSION['userID'];
        $courses = Course::get_courses($userID);
        include 'views/courses/index.php';
    }

    public function addCourse()
    {
        $userID = $_SESSION['userID'];
        $courseName = isset($_POST['courseName']) ? $_POST['courseName'] : '';

        if (!empty($courseName) && isset($userID)) {
            // Now passing $userID as a second argument to add_course
            Course::add_course($courseName, $userID);
            header("Location: .?action=list_courses");
            exit;
        } else {
            $error = "Invalid course data.";
            include 'views/error.php';
            exit();
        }
    }

    public function deleteCourse()
    {
        $courseID = filter_input(INPUT_POST, 'courseID', FILTER_VALIDATE_INT);
        if ($courseID) {
            try {
                Course::delete_course($courseID);
                header("Location: .?action=list_courses");
                exit;
            } catch (PDOException $e) {
                $error = "You cannot delete a course if it has projects.";
                include 'views/error.php';
                exit();
            }
        }
    }

    public function updateCourses()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);

            if (isset($data['courses']) && is_array($data['courses'])) {
                foreach ($data['courses'] as $course) {
                    $courseID = filter_var($course['courseID'], FILTER_SANITIZE_NUMBER_INT);
                    $courseName = isset($course['courseName']) ? trim($course['courseName']) : '';
                    Course::update_course($courseID, $courseName);
                }
                echo json_encode(['message' => 'Courses updated successfully']);
                exit;
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Invalid request data.']);
                exit;
            }
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Only POST method is allowed.']);
            exit;
        }
    }
}

<?php

require_once 'Models/Database.php';
require_once 'Models/Course.php';

class CoursesController
{
    public function listCourses()
    {
        $courses = Course::get_courses();
        include 'views/courses/index.php';
    }

    public function addCourse()
    {
        $courseName = isset($_POST['courseName']) ? $_POST['courseName'] : '';
        if (!empty($courseName)) {
            Course::add_course($courseName);
            header("Location: .?action=list_courses");
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
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Invalid request data.']);
            }
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Only POST method is allowed.']);
        }
    }
}

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

}

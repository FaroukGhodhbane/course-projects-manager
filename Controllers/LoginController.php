<?php

require_once 'Models/User.php';

class LoginController
{
    public function showLoginForm()
    {
        // Redirect if already logged in, preventing access to the login form
        if ($this->isLoggedIn()) {
            header('Location: ./?action=list_courses');
            exit;
        }

        include 'views/auth/login.php';
    }

    public function handleLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            // Redirect to login to handle non-POST access properly
            header('Location: ./?action=login');
            exit;
        }

        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        // Basic validation for empty fields
        if (empty($username) || empty($password)) {
            $errorMessage = "Username and password are required.";
            include 'views/auth/login.php';
            return;
        }

        // Attempt to find the user by username
        $user = User::findByUsername($username);

        // Verify password and check if user exists
        if (!$user || !password_verify($password, $user['password'])) {
            $errorMessage = "Invalid login credentials.";
            include 'views/auth/login.php';
            return;
        }

        // Regenerate session ID upon successful login
        session_regenerate_id(true);

        // Set session variables for user identification
        $_SESSION['userID'] = $user['userID'];
        $_SESSION['username'] = $user['username'];

        // Redirect to a default or dashboard page after login
        header('Location: ./?action=list_courses');
        exit;
    }

    // Utility function to check if the user is already logged in
    private function isLoggedIn()
    {
        return isset($_SESSION['userID']);
    }
}

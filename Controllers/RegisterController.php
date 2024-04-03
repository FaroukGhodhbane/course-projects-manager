<?php

require_once 'Models/User.php';

class RegisterController
{
    public function showRegisterForm()
    {
        // Include the view for the registration form
        include 'views/auth/register.php';
    }

    public function handleRegister()
    {
        // Check if the request is POST to ensure form submission
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            // Redirect to the registration form if not a POST request
            header('Location: ./?action=register');
            exit;
        }

        // Retrieve user inputs from the form
        $username = trim($_POST['username'] ?? '');
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'] ?? ''; // Directly accessing as it will be hashed
        $password_confirmation = $_POST['password_confirmation'] ?? '';

        // Basic validation
        if (empty($username) || empty($email) || empty($password) || empty($password_confirmation)) {
            $errorMessage = "All fields are required.";
            include 'views/auth/register.php';
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMessage = "Invalid email format.";
            include 'views/auth/register.php';
            return;
        }

        // Check if passwords match
        if ($password !== $password_confirmation) {
            $errorMessage = "Passwords do not match.";
            include 'views/auth/register.php';
            return;
        }

        // Check if username or email already exists
        $existingUser = User::findByUsername($username);
        if ($existingUser) {
            $errorMessage = "Username already taken.";
            include 'views/auth/register.php';
            return;
        }

        $existingEmail = User::findByEmail($email);
        if ($existingEmail) {
            $errorMessage = "Email already registered.";
            include 'views/auth/register.php';
            return;
        }

        // Create the user
        User::create($username, $email, $password);

        // Redirect to login page or any other page after successful registration
        header('Location: ./?action=login');
        exit;
    }
}

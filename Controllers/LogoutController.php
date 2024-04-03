<?php

require_once 'Models/User.php';

class LogoutController
{
    public function logout()
    {
        // Start the session to access session variables
        session_start();

        // Unset all session variables
        $_SESSION = array();

        // If it's desired to kill the session, also delete the session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        //destroy the session
        session_destroy();

        // Redirect to the login page or home page after logout
        header('Location: ./?action=login');
        exit;
    }
}
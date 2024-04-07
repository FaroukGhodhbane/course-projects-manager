# Course Projects Manager

The Course Projects Manager is a login-based web application designed to keep track of school projects throughout a given semester. It enables users to add, display, edit, and delete courses and manage projects associated with specific courses. A key feature of this system is user authentication, ensuring that access is granted only to registered users with valid credentials.

## Technologies Used

- **Backend Development**: PHP, MySQL
- **Frontend Development**: JavaScript, AJAX for dynamic content updating, and SCSS for user centered, accessible front-end designs.

## Features

- **User Authentication**: Secure login mechanism to access course and project management features using PHP sessions.
- **Project Management**: List projects by course, add new projects with details such as description and status.
- **Course Management**: Add, edit, and delete courses as well as display a list of them.

## Getting Started

These instructions are for establishing a local development setting for the project.

### Prerequisites

- PHP 8 or higher
- MySQL
- Apache or Nginx Web Server
- XAMPP or MAMP (Optional) - Simplifies the setup by bundling PHP, MySQL, and Apache.

### Installation using XAMPP/MAMP

1. **Clone the repository:** to your local machine (or download the zip folder)

2. **Setup with XAMPP/MAMP:**

Move the cloned project directory to the htdocs folder within your XAMPP/MAMP installation directory.

3. **Configure the Database:**

Start the XAMPP or MAMP server and open the PHPMyAdmin in your browser.
Create a new database for the project.
Import the provided course-projects-manager.sql file to set up the database schema.

4. **Update Environment Settings:**

Navigate to the project folder and locate the Database.php file under Models.
Update the database connection details (host, username, password, database name) to match your local setup.

5. **Access the Project:**

Open your browser and navigate to localhost/course-projects-manager (adjust the URL based on your project's path within htdocs)

You're in!

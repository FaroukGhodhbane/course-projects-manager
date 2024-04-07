<?php include './public/layouts/header.php'; ?>
<header>
    <h1>Course Projects Manager</h1>
    <nav>
        <ul>
            <li><a href="./?action=list_courses">Manage Courses</a></li>
            <li>
                <form action="./?action=logout" method="post">
                    <button type="submit" aria-label="logout" class="logoutButton">Logout</button>
                </form>
            </li>
        </ul>
    </nav>
</header>

<section id="project" class="project">
    <div class="project__header">
        <h2>Projects</h2>
        <form action="./" method="GET" class="project__listCourses_select">
            <input type="hidden" name="action" value="list_projects">
            <select name="courseID" required>
                <option value="0">View All</option>
                <?php foreach ($courses as $course): ?>
                    <option value="<?= htmlspecialchars($course['courseID']) ?>" <?= (isset($courseID) && $courseID == $course['courseID']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($course['courseName']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button class="project__listCourses_goButton">Go</button>
        </form>
    </div>
    <?php if (!empty($projects)): ?>
        <?php
        // Group projects by courseName
        $groupedProjects = [];
        foreach ($projects as $project) {
            $groupedProjects[$project['courseName']][] = $project;
        }

        foreach ($groupedProjects as $courseName => $courseProjects): ?>
            <div class="project__group">
                <div class="project__course_title">
                    <?= htmlspecialchars($courseName) ?>
                </div>
                <table class="project__table">
                    <thead>
                        <tr>
                            <th>Project Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($courseProjects as $project): ?>
                            <tr class="project__table_row">
                                <td>
                                    <?= htmlspecialchars($project['projectName']) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($project['description']) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($project['status']) ?>
                                </td>
                                <td>
                                    <form action="./?action=delete_project" method="post">
                                        <input type="hidden" name="projectID" value="<?= htmlspecialchars($project['id']) ?>">
                                        <button class="project__table_deleteButton">X</button>
                                    </form>
                                </td>
                            </tr>
                </div>
            <?php endforeach; ?>
            </tbody>
            </table>
        <?php endforeach; ?>
    <?php else: ?>
        <p>You don't have any projects yet!</p>
    <?php endif; ?>
</section>

<section id="add" class="add">
    <h2>Add a project</h2>
    <form action="./?action=add_project" method="post">
        <div class="add__fields">
            <label>Course:</label>
            <select name="courseID" required>
                <option value="">Please select</option>
                <?php foreach ($courses as $course): ?>
                    <option value="<?= htmlspecialchars($course['courseID']) ?>">
                        <?= htmlspecialchars($course['courseName']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <label>Project Name:</label>
            <input type="text" name="projectName" maxlength="120" placeholder="Project Name" required>
            <label>Brief Description:</label>
            <input type="text" name="description" maxlength="255" placeholder="Description" required>
            <label>Status:</label>
            <input type="text" name="status" maxlength="120" placeholder="Status" required>
            <br>
        </div>
        <button class="add__addButton">Add</button>
    </form>
</section>

<?php include './public/layouts/footer.php'; ?>
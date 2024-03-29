<?php include './views/layouts/header.php'; ?>

<section id="project" class="project">
    <header>
        <h1>Projects</h1>
        <form action="./" method="GET" class="project__list_select">
            <input type="hidden" name="action" value="list_projects">
            <select name="courseID" required>
                <option value="0">View All</option>
                <?php foreach ($courses as $course): ?>
                    <option value="<?= htmlspecialchars($course['courseID']) ?>" <?= (isset($courseID) && $courseID == $course['courseID']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($course['courseName']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button class="project__GoButton bold">Go</button>
        </form>
    </header>

    <?php if (!empty($projects)): ?>
        <?php
        // Group projects by courseName
        $groupedProjects = [];
        foreach ($projects as $project) {
            $groupedProjects[$project['courseName']][] = $project;
        }

        foreach ($groupedProjects as $courseName => $courseProjects): ?>
            <div class="course-title bold">
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
                        <tr class="project__row">
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
                                    <button class="delete-button">Delete</button>
                                </form>
                            </td>
                        </tr>
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
            <label>Description:</label>
            <input type="text" name="description" maxlength="255" placeholder="Description" required>
            <br><br>
            <label>Status:</label>
            <input type="text" name="status" maxlength="120" placeholder="Status" required>
            <br>
        </div>
        <div class="add__addButton">
            <button class="add-button bold">Add</button>
        </div>
    </form>
</section>


<p><a href="./?action=list_courses">Manage Courses</a></p>

<?php include './views/layouts/footer.php'; ?>
<?php
include './public/layouts/header.php';
?>
<header>
    <h1>Course Projects Manager</h1>
    <nav>
        <ul>
            <li><a href="./?action=list_projects">Manage Projects</a></li>
            <li>
                <form action="./?action=logout" method="post">
                    <button type="submit" aria-label="logout" class="logoutButton">Logout</button>
                </form>
            </li>
        </ul>
    </nav>
</header>

<div class="editModeButtons">
    <button class="editModeButtons__edit" id="editModeToggle" onclick="toggleEditMode()">Edit Course Names</button>
    <button class="editModeButtons__save" id="saveAll" onclick="saveAllChanges()" style="display:none;">Save
        All</button>
    <button class="editModeButtons__cancel" id="cancelEdit" onclick="cancelEditMode()"
        style="display:none;">Cancel</button>
</div>

<section id="course" class="course">
    <h2>Course List</h2>
    <?php if (!empty($courses)): ?>
        <table class="course__table">
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $course): ?>
                    <tr class="course__table_row" id="course-<?= htmlspecialchars($course['courseID']) ?>">
                        <td class="editable" contenteditable="false">
                            <?= htmlspecialchars($course['courseName']) ?>
                        </td>
                        <td>
                            <form action="./?action=delete_course" method="post">
                                <input type="hidden" name="courseID" value="<?= htmlspecialchars($course['courseID']) ?>">
                                <button class="course__table_deleteButton">X</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="course__start-adding">Start adding courses!</p>
    <?php endif; ?>
</section>

<section id="add" class="add">
    <h2>Add a Course</h2>
    <form action="./?action=add_course" method="post">
        <div class="add__fields">
            <label>Course Name:</label>
            <input type="text" name="courseName" maxlength="50" placeholder="Course Name" required autofocus>
        </div>
        <button class="add__addButton">Add</button>
    </form>
</section>

<script src="./public/js/courses-edit.js"></script>

<?php include './public/layouts/footer.php'; ?>
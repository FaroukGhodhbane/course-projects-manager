<?php
include './public/layouts/header.php';
?>

<button id="editModeToggle" onclick="toggleEditMode()">update courseName</button>
<button id="saveAll" onclick="saveAllChanges()" style="display:none;">Save All</button>
<button id="cancelEdit" onclick="cancelEditMode()" style="display:none;">Cancel</button>

<section id="course" class="course">
    <h1>Course List</h1>
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
                    <tr class="course__row" id="course-<?= htmlspecialchars($course['courseID']) ?>">
                        <td class="editable" contenteditable="false">
                            <?= htmlspecialchars($course['courseName']) ?>
                        </td>
                        <td>
                            <form action="./?action=delete_course" method="post">
                                <input type="hidden" name="courseID" value="<?= htmlspecialchars($course['courseID']) ?>">
                                <button class="course__deleteButton">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Start adding courses!</p>
    <?php endif; ?>
</section>


<section id="add" class="add">
    <h2>Add a Course</h2>
    <form action="./?action=add_course" method="post">
        <div class="add__fields">
            <label>Course Name:</label>
            <input type="text" name="courseName" maxlength="50" placeholder="Course Name" required autofocus>
        </div>
        <div class="add__addButton">
            <button class="add-button bold">Add</button>
        </div>
    </form>
</section>

<p><a href="./?action=list_projects">Manage Projects</a></p>

<script src="./public/js/courses-edit.js"></script>

<?php include './public/layouts/footer.php'; ?>
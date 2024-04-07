<?php include './public/layouts/header.php'; ?>
<section id="register" class="auth">
    <h2>Course Projects Manager</h2>
    <p class="headsup">
        Heads Up! This a personal project. Please do not enter any sensitive information while using it.
    </p>
    <?php if (isset($errorMessage)): ?>
        <p class="errorMessage">
            <?php echo $errorMessage; ?>
        </p>
    <?php endif; ?>
    <form action="./?action=handle_register" method="POST" class="auth__form">
        <div class="auth__fields">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <label for="password_confirmation">Repeat password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
        </div>
        <button type="submit" class="auth__registerButton">Register</button>
    </form>
    <p>Already have an account? <a href="./?action=login">Login here</a>.</p>
</section>

</main>
</body>

</html>
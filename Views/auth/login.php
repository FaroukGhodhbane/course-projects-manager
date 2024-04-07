<?php include './public/layouts/header.php'; ?>
<section id="login" class="auth">
    <h2>Course Projects Manager</h2>
    <p class="headsup">
        Heads Up! This a personal project. Please do not enter any sensitive information while using it.
    </p>
    <?php if (isset($errorMessage)): ?>
        <p class="errorMessage">
            <?php echo $errorMessage; ?>
        </p>
    <?php endif; ?>
    <form action="./?action=handle_login" method="POST" class="auth__form">
        <div class="auth__fields">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
        </div>
        <button type="submit" class="auth__loginButton">Login</button>
    </form>
    <p>Don't have an account? <a href="./?action=register">Register here</a>.</p>
</section>

</main>
</body>

</html>
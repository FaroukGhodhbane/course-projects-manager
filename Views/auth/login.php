<?php include './public/layouts/header.php'; ?>

<h2>Login</h2>
<?php if (isset($errorMessage)): ?>
    <p style="color: red;">
        <?php echo $errorMessage; ?>
    </p>
<?php endif; ?>
<form action="./?action=handle_login" method="POST">
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit">Login</button>
</form>
<p>Don't have an account? <a href="./?action=register">Register here</a>.</p>

<?php include './public/layouts/footer.php'; ?>
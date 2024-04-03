<?php include './public/layouts/header.php'; ?>

<h2>Register</h2>
<?php if (isset($errorMessage)): ?>
    <p style="color: red;">
        <?php echo $errorMessage; ?>
    </p>
<?php endif; ?>
<form action="./?action=handle_register" method="POST">
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
        <label for="password_confirmation">Repeat password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
    </div>
    <button type="submit">Register</button>
</form>
<p>Already have an account? <a href="./?action=login">Login here</a>.</p>

<?php include './public/layouts/footer.php'; ?>
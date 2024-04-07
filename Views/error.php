<?php include './public/layouts/header.php'; ?>
<section class="error">
    <h2 class="error__heading">Error</h2>
    <p class="error__message">
        <?= $error ?>
    </p>
    <br>
    <p class="error__link"><a href=".">Go back to Course List</a></p>
</section>
<?php include './public/layouts/footer.php'; ?>
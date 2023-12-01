<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <title>Home page</title>
</head>
<body>
    <h2 class="greeting">Hello <?php if(!empty($_SESSION['username']))
                    echo $_SESSION['username'];
                ?>
    </h2>
    <?php
        if(!empty($_SESSION['username']))
        {
    ?>
        <button id="logout-button" class="button" role="button">Logout</button>
    <?php
        }
    ?>

    <script src="../ajax/logout.ajax.js"></script>
</body>
</html>
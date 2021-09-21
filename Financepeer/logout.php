<?php
$pdo = new PDO('mysql:host = localhost; port = 3306; dbname=pms', 'Manoj', '123');
session_start();
?>

<html>
    <head>
        <title>JSON | logout</title>
        <link rel='stylesheet' href='stylesheet.css'>
    </head>
    <body class="login">
        <div class="login_container">
            <h1 class="logout_head">JSON file parser</h1>
            <h3 class="logout_text">Hey, Your have logged out Successfully...</h3>
            <a href='index.php' class="greenbutton submit">Go To Login</a>
            <p class="clearfix"></p>
        </div>
    
        <!--Logging out--->
        <?php
            session_destroy();
        ?>
    </body>
</html>
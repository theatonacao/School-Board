<?php
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['user_name'])){
    ?>

    <!DOCTYPE html>
    <html>
        <head>
            <title>Dashboard</title>
            <link rel="stylesheet" type="text/css" href="style.css">
        </head>
        <body>
            <h2> Hello, <?php echo $_SESSION['user_name'];?></h2>
            <a href="logout_page.php>Logout</a>
        </body>
    </html>

    <?php
}
else{
    header("Location: index.php");
    exit();
}
?>
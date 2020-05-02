<!DOCTYPE html>
<html lang="HU">
    <head>
        <link href="bootstrap\bootstrap.css" rel="stylesheet">
        <link href="mainf.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <meta charset="UTF-8">
       

        <title> Welcome to Staem</title>
        <link rel="icon" href="staem.png" type="image/x-icon">

    </head>

    <body>
    <?php include 'menu.php'; ?>
    <div>
        <?php
        

            //Ez azért van itt h a loginos cucc ne ragadjon be
            if(isset($_GET["signout"])) {
                unset($_SESSION["user"]);
                header("Location:mainpage.php");
                exit();

            }            
        ?>
    </div>
    <h1 style='font-size:200px; text-align:center'>Welcome<br>to<br>Staem!</h1>
    </body>
</html>

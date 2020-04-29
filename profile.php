<!DOCTYPE html>
<html lang="HU">
    <head>
        <link href="bootstrap\bootstrap.css" rel="stylesheet">
        <link href="mainf.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <meta charset="UTF-8">
       

        <title> Welcome to Staem!</title>
        <link rel="icon" href="staem.png" type="image/x-icon">

    </head>

    <body>

    

    <?php
        include 'menu.php';
        
        require_once("functions.php");

        $link=myconnect();
        $result=myq($link,"SELECT * FROM player WHERE tag='".$_GET["playertag"]."';");
        $row=mysqli_fetch_array($result);

        

        if(isset($_SESSION["user"])) {
            if($_SESSION["user"]==$_GET["tag"]){

            }

        }
        else {

        }

    ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-8" id="bigname">
                <?php echo "<h2>".$row["ign"]."</h2>"; ?>
            </div>

        </div>
    </div>
    

    </body>
    <?php myclose($link); ?>
</html>

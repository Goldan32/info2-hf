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

        $result=myq($link,"SELECT * FROM game");

        while ($row=mysqli_fetch_array($result)) {
            echo "
                <div class='container'>
                    <div class='panel panel-primary' style='margin-top:40px'>
                        <div class="."panel-heading"."><a href="."game.php?gameid=".$row["id"]."".">".$row["title"]."</a></div>
                        <div class="."panel-body".">
                            <div class="."media".">
                                <div class="."media-left".">
                                    <img src=".$row["pic"]." class="."media-object"." style='width:100px; height:100px'>
                                </div>
                                <div class="."media-body".">
                                    <div class='col-sm-1 col-sm-offset-11'>
                                        <h3>".$row["score"]."/10</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ";
        }
    ?>

    
    </body>
</html>
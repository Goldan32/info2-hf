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

        $result=myq($link,"SELECT * FROM game WHERE id=".$_GET["gameid"].";");
        $gamerow=mysqli_fetch_array($result);
        
        

        $loggedin=false;
        $havegame=false;
        
        if(isset($_SESSION["user"])) {
            $loggedin=true;

            $result2=myq($link,"SELECT id FROM possession WHERE gameid=".$gamerow["id"]." AND playertag=".gettag($link)."");
            $row2=mysqli_fetch_array($result2);

            if($row2["id"]!=NULL){
                $havegame=true;
            }
        }
        else {
            $loggedin=false;
        }
    
    ?>


    <div class="container">
        <div class="row">
            <div class="col-sm-11" id="bigname">
                <?php echo "<h2 id="."bigass".">".$gamerow["title"]."</h2>"; ?>
            </div>
            
        </div>

        <div class='container fullcont'>
            <div class="media">
                <div class="media-body">
                    <p>
                        
                    </p>
                    <h4 class="media-heading">Summary</h4>
                    <p style="margin-bottom:50px"><?php echo $gamerow["summary"]?></p>
                    <p>This game recieved a rating of <?php echo $gamerow["score"]?> out of 10.</p>
                    <div>
                        <?php
                            if($loggedin){
                                if (!$havegame) {
                                    echo "
                                    <form method=post action=game.php?gameid=".$gamerow["id"].">
                                        <p>
                                            <button type="."submit"." name="."add"." id="."editbutton"." class="."btn".">Add game</button>
                                        </p>
                                    </form>";

                                    if(isset($_POST["add"])){
                                        myq($link,"INSERT INTO possession (playertag,gameid,buytime,playhours) VALUES (".gettag($link).",".$gamerow["id"].",NOW(),0)");
                                        header("Location:game.php?gameid=".$gamerow["id"]);
                                        exit();
                                    }
                                    
                                    
                                }
                            }
                        ?>
                    </div>
                    
                    
                </div>
                <div class="media-right">
                    <img src=<?php echo $gamerow["pic"]; ?> class="media-object" style="width:400px">
                </div>
            </div>
        </div>

        
    </div>
    </body>
    <?php myclose($link); ?>
</html>

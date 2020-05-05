<!DOCTYPE html>
<html lang="HU">
    <head>
        <link href="bootstrap\bootstrap.css" rel="stylesheet">
        <link href="mainf.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <meta charset="UTF-8">
       

        <title> Create new team</title>
        <link rel="icon" href="staem.png" type="image/x-icon">

    </head>

    <body>
    <?php 
        include 'menu.php'; 

        require_once("functions.php");
        $link=myconnect();
        

        $result=myq($link,"SELECT id,title from game");
        


    ?>
    <div class="container">
        <div class="row">
           
            <div class="col-sm-offset-4 col-sm-4">
                <h2 id="loginfelirat"> Create new team </h1>
                <form action="newteam.php" method="post">
                <p>
                    <label class="formfelirat" for="teamname">Team name</label>
                    <input type="text" class="form-control" name="teamname" id="teamname">
                </p>
                <p>
                    <label class="formfelirat" for="short">Short name for team</label>
                    <input type="text" class="form-control" name="short" id="short">
                </p>
                <p>
                    <label class="formfelirat" for="game">Game the team plays</label>
                    <input list="games" class="form-control" name="game" id="game">
                    <datalist id="games">
                        <?php
                            while($gamelist=mysqli_fetch_array($result)){
                                echo "<option value='".$gamelist["title"]."'>";
                            }

                        ?>

                    </datalist>
                </p>
                <p>
                    <label class="formfelirat" for="pos">Your position in the team</label>
                    <input type="text" class="form-control" name="pos" id="pos">
                </p>
                <p>
                    <button type="submit" name="create" class="btn btn-mybutton">Create team</button>

                    <?php
                        if(isset($_POST["create"]) and isset($_SESSION["user"])) {

                            //Három betűs a rövidítés
                            if (strlen($_POST["short"])==3){

                                makesafe($link,$_POST["teamname"],$_POST["short"],$_POST["pos"]);

                                //gameid megszerzése
                                $result2=myq($link,"SELECT id FROM game WHERE title='".$_POST["game"]."';");
                                $gameid=mysqli_fetch_array($result2);
                                $gameid=$gameid["id"];

                                //új csapat létrehozása
                                myq($link,"INSERT INTO team (gameid,teamname,sname) VALUES (".$gameid.",'".$_POST["teamname"]."','".$_POST["short"]."')");

                                //Készítő hozzáadása a csapathoz
                                $result3=myq($link,"SELECT LAST_INSERT_ID() AS recent FROM team");
                                $teamtag=mysqli_fetch_array($result3);

                                myq($link,"INSERT INTO teammember (playertag,teamtag,jointime,position) VALUES ('".gettag($link)."',".$teamtag["recent"].", NOW() ,'".$_POST["pos"]."');");

                                header("Location:team.php?teamtag=".$teamtag["recent"]);
                            }
                            else {
                                echo "<br>The short name if a team is exactly 3 characters" ;
                            }
                        }

                        myfree($result);  
                        myclose($link);
                    ?>

                </p>
            </div>


        </div>
    </div>
    
    </body>
</html>

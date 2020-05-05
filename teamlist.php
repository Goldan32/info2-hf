<!DOCTYPE html>
<html lang="HU">
    <head>
        <link href="bootstrap\bootstrap.css" rel="stylesheet">
        <link href="mainf.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <meta charset="UTF-8">
       

        <title> Teams on Staem</title>
        <link rel="icon" href="staem.png" type="image/x-icon">

    </head>

    <?php include 'menu.php'; if(isset($_SESSION["user"])) { //új csapat létrehozása gomb?>

    <div class="container">
        <div class="col-sm-offset-5">
            <a href="newteam.php"><button type=button name=create class="btn btn-mybutton" id='middlebutton'>Create team</button></a>
        </div>
    </div>

    <?php } ?>

    <body>
    <?php 
         //Csapatok kilistázása
        require_once("functions.php");

        $link=myconnect();

        $result=myq($link,"SELECT * FROM team");

        while ($row=mysqli_fetch_array($result)) {

            $result2=myq($link,"SELECT * FROM game WHERE id=".$row["gameid"].";");
            
            $gamerow=mysqli_fetch_array($result2);

            echo "
                <div class='container'>
                    <div class='panel panel-primary' style='margin-top:40px'>
                        <div class="."panel-heading"."><a href="."team.php?teamtag=".$row["tag"]."".">".$row["sname"]."</a></div>
                        <div class="."panel-body".">
                            <h3>".$row["teamname"]."</h3>
                            <p>Playing: ".$gamerow["title"]."</p>
                        </div>
                    </div>
                </div>
                ";
        }
    ?>

    
    </body>
</html>
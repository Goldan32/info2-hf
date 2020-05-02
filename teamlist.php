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

    <body>
    <?php 
        include 'menu.php'; 
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
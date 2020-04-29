<!DOCTYPE html>
<html lang="HU">
    <head>
        <link href="bootstrap\bootstrap.css" rel="stylesheet">
        <link href="mainf.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <meta charset="UTF-8">
       

        <title> Players</title>
        <link rel="icon" href="staem.png" type="image/x-icon">

    </head>

    <body>
    <?php include 'menu.php'; ?>
    

    <div>
        <?php
            require_once("functions.php");
            $link=myconnect();
            

            
        ?>
    </div>

    <div class="container">
        <div class="col-sm-5 col-sm-offset-7">
            <form method="get" class="form-inline" action="playerlist.php">
                <div class="form-group">
                    <p>                    
                        <input type="text" class="form-control"  name="search" id="search">                    
                        <button type="submit" class="btn btn-mybutton">Search</button>

                        <?php
                            if(isset($_GET["search"])){
                                makesafe($link,$_GET["search"]);
                                $cmd="SELECT tag,ign,email FROM player WHERE 
                                    tag LIKE '%".$_GET["search"]."%' OR  ign LIKE '%".$_GET["search"]."%' OR  email LIKE '%".$_GET["search"]."%' ;";

                                $result=myq($link,$cmd);
                                

                            }
                            else {
                                $result=myq($link,"SELECT tag,ign,email FROM player");
                            }


                        ?>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <div class="container">
        
        <div class="col-sm-8 col-sm-offset-2">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Player</th>
                        <th>E-mail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($row=mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td><a href="."profile.php?playertag=".$row["tag"]."".">".$row["ign"]."#".$row["tag"]."</td>";
                            echo "<td>".$row["email"]."</td>";
                            echo "</tr>";
                        }
                        myclose($link);

                    ?>


                </tbody>
            </table>
        </div>

    </div>



    </body>
</html>

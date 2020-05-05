<!DOCTYPE html>
<html lang="HU">
    <head>
        <link href="bootstrap\bootstrap.css" rel="stylesheet">
        <link href="mainf.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <meta charset="UTF-8">
       

        <title> Team</title>
        <link rel="icon" href="staem.png" type="image/x-icon">

    </head>

    <body>
    <?php 
        include 'menu.php'; 
        require_once("functions.php");
        $link=myconnect();
        $loggedin=false;

        //Lekérdezzük az infókat a csapatról, és a tagokat
        $result=myq($link,"SELECT * FROM team WHERE tag=".$_GET["teamtag"].";");
        $row=mysqli_fetch_array($result);

        $result2=myq($link,"SELECT * FROM player INNER JOIN teammember ON tag=playertag WHERE teamtag=".$_GET["teamtag"].";");

        if(isset($_SESSION["user"])){
            $loggedin=true;
        }

    ?>


    <div class="container">
        <div class="row">
            <div class="col-sm-10" id="bigname">
                <?php echo "<h2 id="."bigass".">".$row["teamname"]."</h2>"; ?>
            </div>
            <div class="col-sm-2" id="bigname">
                <?php echo "<h2 id="."bigass".">".$row["sname"]."</h2>"; ?>
            </div>
            
        </div>
       
        <div class="container fullcont">
            
            <div class="col-sm-6">
                <table id="itemtable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $inteam=false;
                            while ($member=mysqli_fetch_array($result2)) {
                                echo "
                                    <tr>
                                        <td><a href="."profile.php?playertag=".$member["tag"]."".">".$member["ign"]."#".$member["tag"]."</td>
                                        <td>".$member["position"]."</td>
                                    </tr>
                                ";
                                if ($loggedin){
                                    if($member["ign"]==$_SESSION["user"]) $inteam=true;
                                }
                            }
                        ?>
                    

                    </tbody>
                </table>
            </div>
            <div class="col-sm-4 col-sm-offset-1" style='margin-top:150px'>
                <?php if ($loggedin and (!$inteam))  { //Hehe az utolsó oldal kódolásánál... ?>
                    <form action='join.php' method='post'>
                        <p>
                            <label class="formfelirat" for="pos">Your position:</label>
                            <input type="text" class="form-control" name="pos" id="pos">
                            <input type='hidden' name='func' value='join'>
                            <input type='hidden' name='teamtag' value=<?php echo $_GET["teamtag"] ?>>
                        </p>
                        <p>
                            <button type="submit" name="join" class="btn btn-mybutton">Join team</button>
                        </p>
                    </form>
                <?php } elseif ($loggedin and $inteam) { ?>
                    <form action='join.php' method='post'>
                        <p>
                            <button type="submit" name="leave" class="btn btn-mybutton">Leave team</button>
                            <input type='hidden' name='func' value='leave'>
                            <input type='hidden' name='teamtag' value=<?php echo $_GET["teamtag"] ?>>
                        </p>
                    </form>

                <?php } //...rájöttem, hogy ezt is lehet :D ?>
                        
            </div>
            
        </div>
    </div>
    </body>
</html>
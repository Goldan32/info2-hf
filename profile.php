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

        
        $loggedin=false;
       
        
        if(isset($_SESSION["user"])) {
            if($_SESSION["user"]==$row["ign"]){
                
                $loggedin=true;

            }

        }
        else {
            $loggedin=false;
        }

        $crossresult=myq($link,"SELECT game.title AS title, game.id AS id, game.pic AS pic, possession.playhours AS hrs
             FROM possession INNER JOIN game ON game.id=possession.gameid WHERE possession.playertag='".$_GET["playertag"]."' ORDER BY possession.playhours DESC;");

        $result2=myq($link,"SELECT * FROM item WHERE playertag='".$_GET["playertag"]."';");

    ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-11" id="bigname">
                <?php echo "<h2 id="."bigass".">".$row["ign"]."</h2>"; ?>
            </div>
            <?php
                if($loggedin) {
                    echo "<div class=col-sm-1>
                        <a href="."editprofile.php?playertag=".$row["tag"].""."><button type=button id=editbutton name=edit class="."btn".">Edit profile</button></a>
                    </div>";
                }
            ?>
        </div>
       
        <div class="container fullcont">
            <div class="row">
                <div class="container fullcont">
                    <?php

                        while($crossrow=mysqli_fetch_array($crossresult))
                            echo "<div class="."col-sm-2".">
                                    <p class="."rightshift".">".$crossrow["title"]."</p>
                                    <a href="."game.php?gameid=".$crossrow["id"].""."><img class="."mypic"." src=".$crossrow["pic"]."></a>
                                    <p class="."rightshift".">".$crossrow["hrs"]." <small>hours played</small></p>
                                </div>";
                    ?>

                </div>

            </div>
            <div class="col-sm-8 col-sm-offset-2">
                <table id="itemtable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Unique name</th>
                            <th>Item type</th>
                            <th>Value</th>
                            <?php 
                                if($loggedin) echo "<th>Sell</th>";
                                elseif(isset($_SESSION["user"])) echo "<th>Purchase</th>"; 
                            ?>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($_SESSION["user"])){
                                $result3=myq($link,"SELECT balance FROM player WHERE tag='".gettag($link)."'");
                                $money=mysqli_fetch_array($result3);
                                $money=$money["balance"];
                            }

                            while ($row2=mysqli_fetch_array($result2)) {
                                
                                echo "<tr>";
                                echo "<td>".$row2["uname"]."</td>";
                                echo "<td>".$row2["itemname"]."</td>";
                                echo "<td>".$row2["price"]."</td>";
                                if($loggedin) {
                                    if($row2["sell"]){ $available="sellbutton"; $writing="Offering";}
                                    else {$available="buybutton"; $writing="Sell";}

                                    echo "
                                        <form method='post' action='trade.php'>
                                            <td style='width:100px'>
                                                <button type='submit' name='sell' id=".$available." class='btn'>".$writing."</button>
                                                <input type='hidden' name='formtype' value='selling'>
                                                <input type='hidden' name='writing' value=".$writing.">
                                                <input type='hidden' name='itemid' value=".$row2["id"].">
                                                <input type='hidden' name='playertag' value='".$row["tag"]."'>
                                            </td>
                                        </form>
                                    ";
                                }
                                elseif(isset($_SESSION["user"])) {
                                    if($row2["sell"]) {
                                        echo "
                                        <form method=post action='trade.php'".">
                                            <td style='width:100px'>
                                                <button type="."submit"." name="."buy"." id="."buybutton"." class="."btn".">Buy</button>
                                                <input type='hidden' name='money' value=".$money.">
                                                <input type='hidden' name='ownermoney' value=".$row["balance"].">
                                                <input type='hidden' name='price' value=".$row2["price"].">
                                                <input type='hidden' name='itemid' value=".$row2["id"].">
                                                <input type='hidden' name='playertag' value='".$row["tag"]."'>
                                                <input type='hidden' name='formtype' value='buying'>
                                            ";                                                                                                                    
                                        echo "</td>
                                        </form>";
                                    }
                                    else 
                                    {
                                        echo "<td></td>";
                                    }
                                }
                                echo "</tr>";
                                
                            }
                            

                        ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>


    </body>
    <?php myclose($link); ?>
</html>

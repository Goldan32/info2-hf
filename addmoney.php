<!DOCTYPE html>
<html lang="HU">
    <head>
        <link href="bootstrap\bootstrap.css" rel="stylesheet">
        <link href="mainf.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <meta charset="UTF-8">
       

        <title> Edit your profile</title>
        <link rel="icon" href="staem.png" type="image/x-icon">

    </head>

    <body>
    <?php 
        include 'menu.php'; 

        require_once("functions.php");
        $link=myconnect();
        $tag=gettag($link);


    ?>
    <div class="container">
        <div class="row">
           
            <div class="col-sm-offset-4 col-sm-4">
                <h2 id="loginfelirat"> Add currency to your account. </h1>
                <form action="addmoney.php?playertag="<?php echo $tag; ?> method="post">
                <p>
                    <label class="formfelirat" for="sum">This amount will be added to your account:</label>
                    <input type="text" class="form-control" name="sum" id="sum">
                </p>
                <p>
                    <label class="formfelirat" for="pw">Confirm current password:</label>
                    <input type="password" class="form-control" name="pw" id="pw">
                </p>
                <p>
                    <button type="submit" name="pay" class="btn btn-mybutton">Pay</button>

                    <?php
                        $result=myq($link,"SELECT balance from player WHERE tag=".$tag.";");
                        $mon=mysqli_fetch_array($result);
                        $mon=$mon["balance"];

                        if($_GET["playertag"]=$tag) {
                            if(isset($_POST["pay"])) {
                                makesafe($link,$_POST["sum"],$_POST["pw"]);

                                $mon=$mon+$_POST["sum"];

                                if(validatepw($link,$_SESSION["user"],$_POST["pw"])) {

                                    if($_POST["sum"]=="" or !is_numeric($_POST["sum"])) {
                                        
                                        echo "<br>Give a number!";
                                    }
                                    elseif ($_POST["sum"]<0){
                                        echo "<br>We appreciate, but try adding a positive number to your balance.";
                                    }
                                    else{
                                        myq($link,"UPDATE player SET balance=".$mon." WHERE tag=".$tag.";");
                                        echo "<br> Payment succesful!";
                                        echo "<p style='margin-top:5px'><a href='profile.php?playertag=".$tag."' style='text-decoration:underline'><br>Back to profile</a></p>";
                                    }



                                    
                                    
                                }
                                else {
                                    echo "<br>The password is incorrect";
                                }

                            }

                        }
                        

                        


                            
                    ?>

                </p>
            </div>


        </div>
    </div>
    
    </body>
</html>

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

        // tag valtozó tartalmazza az épp bejelentkezett felhasználó tag-jét
        $tag=gettag($link);


    ?>
    <div class="container">
        <div class="row">
           
            <div class="col-sm-offset-4 col-sm-4">
                <h2 id="loginfelirat"> Change account details. </h1>
                <form action="editprofile.php?playertag="<?php echo $tag; ?> method="post">
                <p>
                    <label class="formfelirat" for="IGN">New name:</label>
                    <input type="text" class="form-control" name="IGN" id="IGN">
                </p>
                <p>
                    <label class="formfelirat" for="email">New email:</label>
                    <input type="email" class="form-control" name="email" id="email">
                </p>
                <p>
                    <label class="formfelirat" for="npw">New password:</label>
                    <input type="password" class="form-control" name="npw" id="npw">
                </p>
                <p>
                    <label class="formfelirat" for="pw">Confirm current password:</label>
                    <input type="password" class="form-control" name="pw" id="pw">
                </p>
                <p style="margin-bottom:30px">
                    <input type="checkbox" id="del" name="del" value="delete">
                    <label for="del" >Delete account?</label>
                </p>
                <p>
                    <button type="submit" name="edit" class="btn btn-mybutton">Save changes</button>

                    <?php
                        

                         
                            if(isset($_POST["edit"])) {
                                makesafe($link,$_POST["IGN"],$_POST["email"],$_POST["npw"],$_POST["pw"]);

                                if(validatepw($link,$_SESSION["user"],$_POST["pw"])) {

                                    //Profil törlése
                                    if (isset($_POST["del"])) {
                                        myq($link,"DELETE FROM teammember WHERE playertag='".$tag."';");
                                        myq($link,"DELETE FROM possession WHERE playertag='".$tag."';");
                                        myq($link,"DELETE FROM item WHERE playertag='".$tag."';");
                                        myq($link,"DELETE FROM player WHERE tag='".$tag."';");

                                        unset($_SESSION["user"]);

                                        //Törlés után vissza a kezdőoldalra
                                        header("Location:mainpage.php");
                                        exit();
                                    }
                                    else {
                                        //Csak azokat a mezőket dolgozzuk fel, amiket kitöltöttek
                                        //email és név esetében megnézzük, hogy szerepel-e az adatbázisban

                                        $result=myq($link,"SELECT tag FROM player WHERE email='" .$_POST["email"]. "';");
                                        $row=mysqli_fetch_array($result);

                                        $result2=myq($link,"SELECT tag FROM player WHERE ign='" .$_POST["IGN"]. "';");
                                        $row2=mysqli_fetch_array($result2);

                                        //Új név
                                        if($_POST["IGN"]!="") {
                                            if($row2["tag"]==NULL) {
                                                if(myq($link,"UPDATE player SET ign='".$_POST["IGN"]."' WHERE tag='".$tag."';")) {
                                                    $_SESSION["user"]=$_POST["IGN"];
                                                }
                                            }
                                            else {
                                                echo "<br>This name is already taken.";
                                            }
                                            
                                        }

                                        //Új email
                                        if($_POST["email"]!="") {
                                            if ($row["tag"]==NULL){
                                                myq($link,"UPDATE player SET email='".$_POST["email"]."' WHERE tag='".$tag."';");
                                            }
                                            else {
                                                echo "<br>This email is already in use.";
                                            }
                                        }

                                        //Új jelszó
                                        if($_POST["npw"]!="") {
                                            createpw($link,$_SESSION["user"],$_POST["npw"]);
                                        }
                                        myfree($result);
                                        myfree($result2);

                                        header("Location:profile.php?playertag=".$tag);
                                    }
                                    
                                }
                                else {
                                    echo "<br>The password is incorrect";
                                }

                            }

                        
                        

                        


                            
                    ?>

                </p>
            </div>


        </div>
    </div>
    
    </body>
</html>

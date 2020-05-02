<!DOCTYPE html>
<html lang="HU">
    <head>
        <link href="bootstrap\bootstrap.css" rel="stylesheet">
        <link href="mainf.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <meta charset="UTF-8">
       

        <title> Join Staem</title>
        <link rel="icon" href="staem.png" type="image/x-icon">

    </head>

    <body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <div class="row">
           
            <div class="col-sm-offset-4 col-sm-4">
                <h2 id="loginfelirat"> Create new account. </h1>
                <form action="register.php" method="post">
                <p>
                    <label class="formfelirat" for="IGN">In-Game Name:</label>
                    <input type="text" class="form-control" name="IGN" id="IGN">
                </p>
                <p>
                    <label class="formfelirat" for="email">E-mail address:</label>
                    <input type="email" class="form-control" name="email" id="email">
                </p>
                <p>
                    <label class="formfelirat" for="pw">Password:</label>
                    <input type="password" class="form-control" name="pw" id="pw">
                </p>
                <p>
                    <label class="formfelirat" for="pwa">Password again:</label>
                    <input type="password" class="form-control" name="pwa" id="pwa">
                </p>
                <p>
                    <button type="submit" name="register" class="btn btn-mybutton">Create account</button>

                    <?php
                        require_once("functions.php");
                        

                        if (isset($_POST["register"])){

                            $link=myconnect();

                            if (empty($_POST["IGN"]) or empty($_POST["pw"]) or empty($_POST["email"]) or empty($_POST["pwa"])) {
                                echo "<br>Every field must be filled!";
                                return false;
                            }

                            if ($_POST["pw"] != $_POST["pwa"]) {
                                echo "<br>The given passwords don't match.";
                                return false;
                            }

                            makesafe($link,$_POST["IGN"],$_POST["email"],$_POST["pw"],$_POST["pwa"]);

                            $result=myq($link,"SELECT tag FROM player WHERE email='" .$_POST["email"]. "';");
                            $row=mysqli_fetch_array($result);

                            $result2=myq($link,"SELECT tag FROM player WHERE ign='" .$_POST["IGN"]. "';");
                            $row2=mysqli_fetch_array($result2);

                            if ($row["tag"]==NULL){
                                if ($row2["tag"]==NULL){

                                    myq($link,"INSERT INTO player (ign,balance,email) VALUES ('".$_POST["IGN"]."',0,'".$_POST["email"]."')");
                                    createpw($link,$_POST["IGN"],$_POST["pw"]);
                                    myclose($link);

                                    $_SESSION["user"]=$_POST["IGN"];
                                    header("Location:mainpage.php");
                                    exit();
                                }
                                else {
                                    echo "This name is already taken.";
                                    myclose($link);
                                }
                            }
                            else {
                                echo "This email is already in use.";
                                myclose($link);
                            }
                        }


                            
                    ?>

                </p>
            </div>


        </div>
    </div>



    <div>
        <?php
             
        ?>
    </div>
    </body>

</html>
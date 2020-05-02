<!DOCTYPE html>
<html lang="HU">
    <head>
        <link href="bootstrap\bootstrap.css" rel="stylesheet">
        <link href="mainf.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <meta charset="UTF-8">
       

        <title> Login to Staem</title>
        <link rel="icon" href="staem.png" type="image/x-icon">

    </head>

    <body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <div class="row">
           
            <div class="col-sm-offset-4 col-sm-4">
                <h2 id="loginfelirat"> Log in to an existing account. </h1>
                <form action="login.php" method="post">
                <p>
                    <label class="formfelirat" for="IGN">In-Game Name:</label>
                    <input type="text" class="form-control" name="IGN" id="IGN">
                </p>
                <p>
                    <label class="formfelirat" for="pw">Password:</label>
                    <input type="password" class="form-control" name="pw" id="pw">
                </p>
                <p>
                    <button type="submit" name="login" class="btn btn-mybutton">Login</button>

                    <?php
                        require_once("functions.php");
                        $link=myconnect();
                        createpw($link,"Goldan","asd123");
                        myclose($link);

                        

                        if(isset($_POST["login"])){

                            $link=myconnect();

                            if (empty($_POST["IGN"]) or empty($_POST["pw"])) {
                                echo "<br>Every field must be filled!";
                                return false;
                            }
                            
                            if(validatepw($link,$_POST["IGN"],$_POST["pw"])) {
                                $_SESSION["user"]=$_POST["IGN"];
                                
                                myclose($link);
                                header("Location:mainpage.php");
                                exit();
                            }
                            else {
                                echo "<br>Name or Password is incorrect.";
                                unset($_SESSION["user"]);
                                myclose($link);
                            }

                            

                            


                        }






                    ?>

                </p>
            </div>


        </div>
    </div>
    <?php ?>
    </body>

</html>
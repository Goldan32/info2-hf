<header class="container-fluid">
    <div class="row">
        <div class="container">
            <div class="row">
                <h1 class="col-sm-4"><a href="mainpage.php">Staem</a></h1>
                <nav class="col-sm-6">
                    <a href="gamelist.php">Games</a>
                    <a href="playerlist.php">Players</a>
                    <a href="">Teams</a>
                    
                </nav>
                <div class="col-sm-2">
                    <?php
                        require_once("functions.php");
                        $link=myconnect();
                        session_start();
                        if (!isset($_SESSION["user"])) {

                            echo " <a href="."login.php".">login</a>
                            |
                            <a href="."register.php".">register</a>";
                        }
                        else {
                            echo "<a href="."mainpage.php?signout=yes".">sign out</a>
                            |
                            <a href="."profile.php?playertag=".gettag($link).">profile</a>";
                            
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</header>
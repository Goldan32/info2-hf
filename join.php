<?php 
    require_once("functions.php");
    session_start();
    $link=myconnect();

    //A játékos belép a csapatba
    if($_POST["func"]=="join"){
        
        makesafe($link,$_POST["pos"]);
        $cmd="INSERT INTO teammember (playertag,teamtag,jointime,position) VALUES (".gettag($link).",".$_POST["teamtag"].", NOW() ,'".$_POST["pos"]."');";
        if(myq($link,$cmd));

        myclose($link);
        header("Location:team.php?teamtag=".$_POST["teamtag"]);
        exit();
    }

    //Játékos kilép a csapatból
    if($_POST["func"]=="leave"){
        myq($link,"DELETE FROM teammember WHERE playertag=".gettag($link)." AND teamtag=".$_POST["teamtag"].";");

        $result=myq($link,"SELECT id FROM teammember WHERE teamtag='".$_POST["teamtag"]."';");


        if(mysqli_fetch_array($result)==NULL){
            myq($link,"DELETE FROM team WHERE teamtag='".$_POST["teamtag"]."';");
        }
        myclose($link);
        header("Location:teamlist.php");
        exit();
    }

    
?>
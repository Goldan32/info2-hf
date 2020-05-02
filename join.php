<?php 
    require_once("functions.php");
    session_start();
    $link=myconnect();

    if($_POST["func"]=="join"){
        
        makesafe($link,$_POST["pos"]);
        $cmd="INSERT INTO teammember (playertag,teamtag,jointime,position) VALUES (".gettag($link).",".$_POST["teamtag"].", NOW() ,'".$_POST["pos"]."');";
        echo $cmd;
        if(myq($link,$cmd));
    }

    if($_POST["func"]=="leave"){
        myq($link,"DELETE FROM teammember WHERE playertag=".gettag($link)." AND teamtag=".$_POST["teamtag"].";");
    }

    myclose($link);
    header("Location:team.php?teamtag=".$_POST["teamtag"]);
    exit();
?>
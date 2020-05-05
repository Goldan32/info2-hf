<?php 
    require_once("functions.php");
    $link=myconnect();
    session_start();

    //Item megvásárlása
    if($_POST["formtype"]=="buying"){
        if($_POST["money"]>=$_POST["price"]) {
            if(myq($link,"UPDATE item SET playertag='".gettag($link)."' WHERE id=".$_POST["itemid"].";")) {

                $moneyminus=$_POST["money"]-$_POST["price"];
                $moneyplus=$_POST["ownermoney"]+$_POST["price"];

                if(myq($link,"UPDATE player SET balance=".$moneyminus." WHERE tag='".gettag($link)."';")) {
                    myq($link,"UPDATE player SET balance=".$moneyplus." WHERE tag='".$_POST["playertag"]."';");
                    myq($link,"UPDATE item SET sell=false WHERE id=".$_POST["itemid"].";");
                }
            }
        }
    }

    //A híres toggle button implementálása
    if($_POST["formtype"]=="selling"){
        if($_POST["writing"]=="Offering"){
            myq($link,"UPDATE item SET sell=false WHERE id=".$_POST["itemid"].";");
        }
        elseif ($_POST["writing"]=="Sell"){
            myq($link,"UPDATE item SET sell=true WHERE id=".$_POST["itemid"].";");
        }
    }

    
    myclose($link);
    header("Location:profile.php?playertag=".$_POST["playertag"]);
    exit();
?>
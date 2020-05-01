<?php
    

    function myconnect() {
        $db_server="127.0.0.1:3306";
        $db_user="root";
        $db_password="";
        $db_name="staem";

        $link=mysqli_connect($db_server,$db_user,$db_password,$db_name) or die("Nem tudok csatlakozni az adatbázishoz.");
        mysqli_query ($link, "set character_set_results='utf8'");
        mysqli_query ($link, "set character_set_client='utf8'");

        return $link;
    }

    function myclose ($link) {
        mysqli_close($link);
    }
    
    function makesafe (&...$args)  {
        
        foreach($args as &$value) {

            if(gettype($value)!="string") continue;
            
            $value=mysqli_real_escape_string($args[0],$value);
            
        }

    }

    

    function myq ($link,$cmd) {
        
        $stuff=mysqli_query($link,$cmd);
        return $stuff;
    }

    function createpw ($link,$user,$pw) {

        makesafe($link,$user,$pw);
        $hash=password_hash($pw,PASSWORD_DEFAULT,['cost' => 12]);
        myq($link,"UPDATE player SET pw='$hash' WHERE IGN='$user'");

    }

    function validatepw ($link,$user,$pw) {
        $correct=false;
        makesafe($link,$user,$pw);
        $re=myq($link,"SELECT pw FROM player WHERE IGN='$user'");
        $row=mysqli_fetch_array($re);
        $hash=$row["pw"];
        if(password_verify($pw,$hash)) {

            $correct=true;
            if (password_needs_rehash($hash,PASSWORD_DEFAULT,['cost' => 12])) {
                createpw($link,$user,$pw);
            }
        }
        else{
            $correct=false;
        }
        return $correct;
        

    }

    function gettag ($link) {
        $cmd="SELECT tag FROM player WHERE ign='".$_SESSION["user"]."';";
        $res=myq($link,$cmd);
        $ro=mysqli_fetch_array($res);
        return $ro["tag"];
    }


?>
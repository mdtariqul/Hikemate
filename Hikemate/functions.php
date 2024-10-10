<?php

function check_login($con)
{
if(isset($_SESSION['user_id']))
    {
        $id=$_SESSION['user_id'];
        $query="Select * from user where user_id='$id'limit 1";
        $result=mysqli_query($con,$query);

        if($result && mysqli_num_rows($result)>0){

            $user_data=mysqli_fetch_assoc($result);
            return $user_data;
        }



        
    }

    header("location: login.php");
    die;

}

function random_num($length){

    $tex="";
    if($length<5){
        $lenght=5;
    }
    $len=rand(4,$length);

    for($i=0;$i<$len;$i++){

        $tex.=rand(0,9);
}
return $tex;
}

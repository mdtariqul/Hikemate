<?php
session_start();

include("connection.php");
include("functions.php");
$text="u";
if($_SERVER['REQUEST_METHOD'] == "POST" ){

$mobile_no=$_POST['mobile_no'];

$password=$_POST['password'];
$password=md5($password);
/*eidt last line*/

    if(!empty($mobile_no) && !empty($password) && is_numeric($mobile_no)){
    
    $query="Select * from user where mobile_no='$mobile_no' limit 1";
    $result= mysqli_query($con,$query);
    
    if($result && mysqli_num_rows($result)>0){

            $user_data=mysqli_fetch_assoc($result);

            if($user_data['password'] == $password){
                $_SESSION['user_id']=$user_data['user_id'];
                header("location: index.php");
                die;

                }
                $text="pass";
            
            }
            
            else{
        
                $text="noac";
        
            }   
            
        

    }
    else{
        
        $text="info";

    } 

 
}

?>


<!DOCTYPE html>
<html> 


    <head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css\login10.css">
    </head>
    <body>
        <div class="container">
        
           <b> <a href="signup.php" >Create an Account</a></b>
            <div class="header"><p><b>HikeMate</b></p></div>
            <p><b>Find your partner in the discover of the unknown</b></p>
            
            
            
        </div>




    




    
        <div id ="box">
            <img  src="css\avatar1.png" class ="avatar">
            <h1>Login here</h1>
           
           
            <form  method="POST">
                


                <p> Mobile Number</p>
                
                <input id="text" type="text" name="mobile_no" placeholder="Enter Mobile Number"><br><br>

                <p> Password</p>
                <input id="text" type="password" name="password" placeholder="Enter Password"><br><br>

                <?php
                    if($text=="pass")
                    {

                        echo"<div id='mes'><b><p>Worng Password</p></b></div>";

                    }
                    elseif($text=="info")
                    {
                        echo"<div id='mes'><b><p>Please enter right information</p></b></div>";
                    }
                    elseif($text=="noac")
                    {
                        echo"<div id='mes'><b><p>Please create an account first</p></b></div>";
                    }
                    else
                    {
                        echo" 
                        ";
                    }



                    ?>

                <b><input id="botton" type="submit" value="Login"><br><br></b>

                <b><a href="confrim number.php" >Forget password?</a><br></b>
            
            



            </form>
        </div>


    </body>

</html>
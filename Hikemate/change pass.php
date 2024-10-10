<?php
session_start();

include("connection.php");
include("functions.php");
$flag="u";
if($_SERVER['REQUEST_METHOD'] == "POST" )
{

        


        
        $password=$_POST['pass1'];
        $password2=$_POST['pass2'];
        //$number=$_POST['mobile'];
        $number=$_SESSION['n'];
       

        if(!empty($number) && !empty($password)  && !empty($password2) && is_numeric($number))
        {
                
                if($password==$password2)
                {
                                
                                
                        $query="Select * from user where mobile_no='$number' limit 1";
                        $result= mysqli_query($con,$query);
                        if($result && mysqli_num_rows($result)>0)
                        {
                                $password=md5($password);
                                $query="update user SET user.password = '$password' WHERE user.mobile_no='$number'";
                                mysqli_query($con,$query);
                                header("location: login.php");
                                unset($_SESSION['n']);
                                die;
                                
                        }
                         else
                        {
                                $flag="number";
                                
                        }

                                

                }
                else
                {
                        $flag="flase";
                        
                }
        }
        else
        {
        $flag="empty";

        }


}


?>

<!DOCTYPE HTML>
<html>

<head>

<title>Change password</title>
<link rel="stylesheet" type="text/css" href="css\changpas.css">


</head>


<body>

<div class="container">
        
   
        <div class="header"><p>HikeMate</p></div>
        <p>Find your partner in the discover of the unknown</p>
        
        
        
</div>

<div class="box">

<form method="POST">


<p>Enter New Password</p>
<input id="text" type="password" name="pass1" placeholder="Enter new password."><br><br>

<p>Confirm New Password</p>
<input id="text" type="password" name="pass2" placeholder="Confrim new password."><br><br><br><br>

<?php
                    if($flag=="number")
                    {

                        echo"<div id='mes'><b><p>Please Enter Correct Number</p></b></div>";

                    }
                    elseif($flag=="false")
                    {
                        echo"<div id='mes'><b><p>Password Doesn't Match</p></b></div>";
                    }
                    elseif($flag=="empty")
                    {
                        echo"<div id='mes'><b><p>Please Enter Correct Information</p></b></div>";
                    }
                    else
                    {
                        echo" 
                        ";
                    }



                    ?>

<input id="botton" type="submit" value="Change Password"><br>

</form>
</div>




</body>




</html>
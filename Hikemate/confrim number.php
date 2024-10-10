<?php
session_start();

include("connection.php");
include("functions.php");
$flag="u";
$number_change=0;

if($_SERVER['REQUEST_METHOD'] == "POST" )
{
       
        
      

        

        $number=$_POST['number'];
      
        if(!empty($number)  && is_numeric($number))
        {
        
        
                
                
                $query="Select * from user where mobile_no='$number' limit 1";
                $result= mysqli_query($con,$query);
                if($result && mysqli_num_rows($result)>0)
                {
                        
                        $_SESSION['n']=$number;
                        header("location: varification.php");
                   
                }
                else
                {
                       
                        $flag="number";
                       
                }

                
                
       
        }
        else
        {
        $flag="i";

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
<br><br>
<b><p>Enter Number</p></b>
<input type="text" id="text" name="number" placeholder="Enter number"><br><br>


<?php
if($flag=="i")
{

    echo"<div id='mes'><b><p>Please Enter Right number.</p></b></div>";

}
elseif($flag=="number")
{
    echo"<div id='mes'><b><p>No Account.    </p> <a href='signup.php' >Click Here to Create One!!</a></b></div> ";
}

else
{
    echo" 
    ";
}






?>

<br><input id="botton" type="submit" value="Get Code"><br>

</form>

</div>

   




</body>




</html>
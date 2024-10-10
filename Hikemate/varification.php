<?php
session_start();
$number=$_SESSION['n'];

include("connection.php");
include("functions.php");
$flag="u";
if($_SERVER['REQUEST_METHOD'] == "POST" )
{   

        $number=$_POST['code'];

        if(!empty($number)  && is_numeric($number) )
        {
                
                if( $number=='1234')
                {
                
                header("Location:change pass.php");    
                }
                else
                {

                $flag="error";
                }       
                        
                

                        

        
        }
        else
{
$flag="emp";

}
        
}        

?>

<!DOCTYPE HTML>
<html>

<head>

<title>Varification</title>
<link rel="stylesheet" type="text/css" href="css\changpas.css">


</head>


<body>

<div class="container">
        
   
        <div class="header"><p>HikeMate</p></div>
        <p>Find your partner in the discover of the unknown</p>
        
        
        
</div>




        <div class='box'>

        <form method="POST">
        <br><br>
        <b><p>Enter Varification Code</p></b>
        <input type='text' id='text' name='code' placeholder='Enter Varification Code'><br><br>
        <?php
                if($flag=="emp")
                {
                echo"<div id='mes'><b><p>Please Enter code</p></b></div>";
                }
                elseif($flag=="error")
                {
                        echo"<div id='mes'><b><p>Code Dosen't Match</p></b></div>";

                }
                else{
                        echo"
                        ";
                }

        ?>
        <b><input id='botton' type='submit' value='Submit'></b><br>
        
        </form>
        
        </div>







   




</body>




</html>
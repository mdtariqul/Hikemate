<?php
session_start();

include("connection.php");
include("functions.php");
if($_SERVER['REQUEST_METHOD'] == "POST" )
{

    if($_POST['password']==$_POST['password2'])
    {
        $full_name=$_POST['full_name'];
        $mobile_no=$_POST['mobile_no'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        /*eidit next line*/
        $password=md5($password);
        $file=$_FILES['file'];


        $query="Select * from user where mobile_no='$mobile_no' limit 1";
        $result= mysqli_query($con,$query);
        if($result && mysqli_num_rows($result)>0)
        {
            echo"This Number is already exist!";
           
        }
        else
        {
            $filename=$_FILES['file']['name'];
            $filetemname=$_FILES['file']['tmp_name'];
            $filesize=$_FILES['file']['size'];
            $fileerror=$_FILES['file']['error'];
            $filetype=$_FILES['file']['type'];
    
            $fileext=explode('.',$filename);
            $fileActualext=strtolower(end($fileext));
            $allowed=array('jpg','jpeg','png');
    
            if(in_array($fileActualext,$allowed))
                {
    
                    if( $fileerror===0)
                    {
                        if($filesize<10000000)
                        {
                           
                            if(!empty($full_name) && !empty($password)  && !empty($email) && !empty($mobile_no) && !is_numeric($full_name) && !is_numeric($email) && is_numeric($mobile_no))
                            {
                                $filenamenew=uniqid('',true).".".$fileActualext;
                                $filedestination='data/'.$filenamenew;
                                move_uploaded_file($filetemname,$filedestination);

                                $user_id=random_num(20);
                                $query="insert into user (user_id,Fullname,mobile_no,email,password,img) values ('$user_id','$full_name','$mobile_no','$email','$password','$filedestination')";
                                mysqli_query($con,$query);
                                header("location: login.php");
                                die;
                    
                            }
                            else
                            {
                                echo"please enter right information";
                            }
                        }
                        else
                        {
                            echo"Your photo size is too big";
                        }
                       
                    }
                    else
                    {
                        echo"There was an error uploding your file";
                        
                    }
                    
                }
            else
            {
                echo"Invalid file Type!";
               
            }
    
        }











    }
    else
    {
        echo"Enter Correct Password";
    }
    



}


?>



<!DOCTYPE html>
<html>


<head>
<title>sign up</title>
<link rel="stylesheet" type="text/css" href="css/signup.css">
</head>
<body>

<div class="container">
      
      <b><a href="login.php" >Login</a></b>
      <div class="header"><p>HikeMate</p></div>
      <p >Find your partner in the discover of the unknown</p>
      
      
      
  </div>


<div id ="box">
    <h1>sign up</h1>
    <form  method="POST" enctype="multipart/form-data">
        <p>Enter Full Name</p>
        <input id="text" type="text" name="full_name" placeholder="Enter Full Name"><br><br>

        <p>Enter Mobile No</p>
        <input id="text" type="text" name="mobile_no" placeholder="Enter Mobile No"><br><br>

        <p>Enter Email Address</p>
        <input id="text" type="text" name="email" placeholder="Enter Email Address"><br><br>


        <p>Enter Password</p>
        <input id="text" type="password" name="password" placeholder="Enter Password"><br><br>

        <p>Confirm Password</p>
        <input id="text" type="Password" name="password2" placeholder="Confirm Password"><br><br><br>


        <p>Uplode Profile Photo</p>
        <input type="file" name="file"><br><br><br>

        <input id="botton" type="submit" value="sign up"><br>

      


    </form>
</div>


</body>

</html>
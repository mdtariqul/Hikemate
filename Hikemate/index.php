<?php
session_start();

include("connection.php");
include("functions.php");
$user_data = check_login($con);
$current_id=$_SESSION['user_id'];



$query="SELECT fullname,img,caption,post_img,post_time from user , post_data   where post_data.poster_id=user.user_id order by post_data.post_id desc";
$post_data= mysqli_query($con,$query);


if($_SERVER['REQUEST_METHOD'] == "POST" )
{
    
    $poster_id=$_SESSION['user_id'];
    $caption= $_POST['caption'];

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
                
               
                if(1==1)
                {
                    
                    $filenamenew=uniqid('',true).".".$fileActualext;
                    $filedestination='data/post data/'.$filenamenew;
                    move_uploaded_file($filetemname,$filedestination);

                    
                    $query="insert into post_data (poster_id,caption,post_img) values ('$poster_id','$caption','$filedestination')";
                    mysqli_query($con,$query);
                    
                    
        
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




?>

<!DOCTYPE html>
<html>

<head>


    <title> Home page </title>
    <link rel="stylesheet" type="text/css" href="css\index01.css">

</head>

<body>
    <div class="container">

        <div class="se">
            <div class="header">
                <p><b>HikeMate</b></p>
            </div>
            <p><b>Find your partner in the discover of the unknown</b></p>
        </div>
        
        <a href="profile.php">
        <?php echo "<h2>{$user_data['Fullname']}</h2> </a>";
        echo "<img src='{$user_data['img']}'>" ?>



    </div>



    <br>

        <div class="timmline">

                <div class="create_post">



                    <form  method="POST" enctype="multipart/form-data">
                        <textarea name="caption" id="caption"  placeholder="What's on your mind,<?php echo "{$user_data['Fullname']}";?>?"></textarea><br><br><br>
                        <input type="file" name="file"><br>
                        <p>Uplode Photo</p>
                        <input id="botton" type="submit" value="Create Post">
                    </form>




                </div>

                <div class="post_area">

                        <?php
                        while($each_post=mysqli_fetch_assoc($post_data))
                        {?>
                            <div class="post">
                                <div class="poster_description">
                                    <?php  echo"<img id='poster_img' src='{$each_post['img']}'>";?>  
                                    <div class="part">
                                        <a id="name"href="profile.php?id=">                      
                                        <?php  echo"<p>{$each_post['fullname']} </p></a><br><p>{$each_post['post_time']}</p>";?> 
                                    </div>                                                                                           
                                </div>
                                <?php  echo"<p id='post_caption'>{$each_post['caption']} </p>";?>
                                <?php  echo"<img id='post_img' src='{$each_post['post_img']}'";?>
                                <br><br><br>
                            </div>
                            <?php
                        }
                        ?>

                </div>
        
            
    
        </div>
   
 
        </div>

    <a id="logout" href="logout.php">logout</a>
  

</body>


<footer><p> by Tariqul Islam</p></footer>



</html>
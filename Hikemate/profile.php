<?php
session_start();

include("connection.php");
include("functions.php");
$user_data = check_login($con);
$poster_id=$user_data['user_id'];

$query="SELECT fullname,img,caption,post_img,post_time from user , post_data   where post_data.poster_id=$poster_id and post_data.poster_id=user.user_id order by post_data.post_id desc";
$post_data= mysqli_query($con,$query);




?>

<!DOCTYPE html>
<html>

<head>


    <title> Home page </title>
    <link rel="stylesheet" type="text/css" href="css\profile10.css">

</head>

<div class="container">

        <div class="se">
            <div class="header">
                <p><b>HikeMate</b></p>
            </div>
            <p><b>Find your partner in the discover of the unknown</b></p>
        </div>

        <a id="logout" href="index.php">Home</a>
        <a id="logout" href="logout.php">logout</a>
       



    </div>





    <div class="all">


        <div class="details">

                    <?php  echo "<img id='profile_pic' src='{$user_data['img']}'>" ; 
                echo "<h2>{$user_data['Fullname']}</h2>";
                    ?>

        </div>
        <div class="personal_post">
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
            <a id="delete" href="#">Delete post</a>                                                                                       
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



    
   



</html>
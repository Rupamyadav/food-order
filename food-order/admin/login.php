<?php include('../config/constants.php'); ?>
<html>
    <head>
        <title> login food-order php</title>
        <link rel="stylesheet" href="../css/add.css" >
</head>
<body>
    <div class="login">   
    <h1 class="center"> login page</h1>
    <?php
    if(isset($_SESSION['login']))
    {
       echo $_SESSION['login']; //display session message
       unset($_SESSION['login']); //it will remove session message
    }
    if(isset($_SESSION['not-login']))
    {
       echo $_SESSION['not-login']; //display session message
       unset($_SESSION['not-login']); //it will remove session message
    } 
 ?>
    <form action="" method="POST">
        username:
        <input type="text" name="username" placeholder="username"> <br/> 
        password:
        <input type="password" name="password" placeholder="password"> <br/>
        <input type="submit" value="login" name="submit" class="btn-primary">
</form>
    <p > created by rupam yadav</p>
</div>
</html>
<?php
if(isset($_POST['submit']))
{
      $username=$_POST['username']; //it should same as database name for all values
      $password =$_POST['password']; 
      $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password' "; 
      $res=mysqli_query($conn,$sql);
      $count = mysqli_num_rows($res);
      if($count==1)
      {
        $_SESSION['login']="<div class='success'> login sucess </div>";
        $_SESSION['user']=$username;
        header('location:'.SITEURL.'admin/index.php');
      }
else
{
    $_SESSION['login']="<div class='error'>login failed </div>";
    header('location:'.SITEURL.'admin/login.php');
   
}
}
?>

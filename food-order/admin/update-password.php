<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>change password </h1>
        <br/><br/>
        <?php  
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        } ?>
 <form action="" method="POST" >
 <table class="tbl-30">
     <tr> <td>current password</td>
         <td> <input type="password" name="current_password" placeholder="old_password">
    </td></tr>
         <tr><td>new password</td>
         <td><input type="password" name="new_password" placeholder="new_password"></td></tr>
         <tr>
         <td>confirm password</td> 
         <td><input type="password" name="confirm_password" placeholder="confirm_password"></td></tr>
         <tr>
             <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                 <input type="submit" name="submit" value="update password" class="btn-secondary"></td></tr>
 </table>
 </form>
    </div>
</div>
<?php
  if(isset($_POST['submit'])) 
  { //first start
    //echo "button clicked";
     $id = $_POST['id']; //it will get data from form
     $current_password =($_POST['current_password']); 
    $new_password=($_POST['new_password']);
    $confirm_password=($_POST['confirm_password']);
    $sql= "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password' ";
     $res = mysqli_query($conn,$sql);
 if($res==true)
  {
  $count=mysqli_num_rows($res);
  if($count==1)
  {
   //$_SESSION['user-found']="<div class='success'> user found </div>";
   // header("location:".SITEURL.'admin/manage-admin.php');
 //echo "user found";

if($new_password==$confirm_password)
{
 //echo "password match";

  $sql2="UPDATE tbl_admin SET password='$new_password' WHERE id=$id ";
  $res2= mysqli_query($conn, $sql2);
  if($res2==true)
  { 
    $_SESSION['pwd-changed']="<div class='success'>  password changed</div>";
  header("location:".SITEURL.'admin/manage-admin.php');
  }
  else
  {
    $_SESSION['pwd-not-changed']="<div class='error'>  password changed</div>";
    header("location:".SITEURL.'admin/manage-admin.php');
  }
}
  }
}
  }
 
?>
<?php include('partials/footer.php') ?>
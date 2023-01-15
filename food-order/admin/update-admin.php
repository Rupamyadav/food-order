<?php  include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
<h1>update admin page</h1>
 <br>
 <?php
   $id=$_GET['id']; //id of selected admin
  $sql= "SELECT * FROM tbl_admin WHERE id=$id";

//EXCUETE query
$res = mysqli_query($conn,$sql);

//redirect to manage admin page with message or error
if($res==TRUE)
   {
   $count=mysqli_num_rows($res);
   if($count==1)
   {
    //echo "details available";
    $row=mysqli_fetch_assoc($res); //it will fetch row
    $full_name = $row['full_name'];
    $username = $row['username'];
   }
   else
   {
    header("location:".SITEURL.'admin/manage-admin.php');
   }
}
 ?>
 <form action="" method="POST" >
 <table class="tbl-30">
     <tr>
         <td>full name</td>
         <td><input type="text" value= "<?php echo $full_name;?>" name="full_name" placeholder="enter name"></td></tr>
         <tr>
             <td>username</td>
             <td>
                 <input type="text" name="username" placeholder="enter username" value= "<?php echo $username; ?>">
             </td></tr>
            <tr>
             <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                 <input type="submit" name="submit" value="update admin" class="btn-secondary"></td></tr>
 </table>
 </form>
    </div>
</div>
<?php
  if(isset($_POST['submit'])) 
  {
    //echo "button clicked";
     $id = $_POST['id']; 
     $full_name =$_POST['full_name']; 
     $username=$_POST['username'];

     $sql= "UPDATE tbl_admin SET
     full_name='$full_name',
     username='$username'
     WHERE id='$id' 
     ";
     $res = mysqli_query($conn,$sql);
  if($res==true)
  {
    $_SESSION['update']= "<div class='success'> admin update successfully. </div>"; //it will display the message in main-content(manage-admin.php)
  header("location:".SITEURL.'admin/manage-admin.php'); //it will redirect with constants.php and concate both the siteurls

  }
else{
    $_SESSION['update']= "<div class='error'> admin not updated. </div>"; //it will display the message in main-content(manage-admin.php)
   header("location:".SITEURL.'admin/manage-admin.php'); //it will redirect with constants.php and concate both the siteurls

}
  }
  
?>
<?php include('partials/footer.php') ?>
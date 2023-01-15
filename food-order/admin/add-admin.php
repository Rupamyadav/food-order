<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
<h1>add admin</h1>
</br>
<?php
if(isset($_SESSION['add']))
{
    echo $_SESSION['add']; //display session message
    unset($_SESSION['add']); //it will remove session message
}
?>
<form action=" " method="POST" >
<table class="tbl-30">
    <tr>
        <td>full name</td>
        <td><input type="text" name="full_name" placeholder="enter name"></td></tr>
        <tr>
            <td>username</td>
            <td>
                <input type="text" name="username" placeholder="enter username">
            </td></tr>
            <tr>
                <td>password</td>
           <td> <input type="password" name="password" placeholder="enter password"></td></tr>
           <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="add admin" class="btn-secondary"></td></tr>
</table>
</form>
</div>
</div>
<?php include('partials/footer.php') ?>
<?php
if(isset($_POST['submit']))
{
    $full_name=$_POST['full_name']; //it will save the name as u have given or get the data from form
    $username=$_POST['username'];
    $password=($_POST['password']); //password encryption with md5
    //sql query to save the data into database
    $sql = "INSERT INTO tbl_admin SET
    full_name='$full_name',
    username='$username',
    password='$password' ";
    //save data into database
    $res = mysqli_query($conn,$sql) or die(mysqli_error());

   // check whether data is inserted or not
   if($res==TRUE)
   {
    //echo "data inserted";
    //creating session to display message
    $_SESSION['delete']= "<div class='success'> admin added successfully. </div>";  //it will display the message in main-content(manage-admin.php)
    header("location:".SITEURL.'admin/manage-admin.php');//it will redirect with constants.php and concate both the siteurls

  }
   else
   {
    //creating session to display message
    $_SESSION['add']= "<div class='error'> admin failed to add </div>";  //it will display the message in main-content
    header("location:".SITEURL.'admin/add-admin.php'); //it will redirect in add-admin page
    $_SESSION['add']= "failed to add admin";

    //echo "data not inserted";
   }


}
?>

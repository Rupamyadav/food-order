<?php  include('../config/constants.php'); ?>

<?php
//get the id of admin which is to be deleted
 $id = $_GET['id'];

//create sql query to delete admin it will delete in database
$sql= "DELETE FROM tbl_category WHERE id=$id";

//EXCUETE query
$res = mysqli_query($conn,$sql);

//redirect to manage admin page with message or error

if($res==TRUE)
   {
    //echo "data inserted";
    //creating session to display message
    $_SESSION['delete']= "<div class='success'> category deleted successfully. </div>"; //it will display the message in main-content(manage-admin.php)
   header("location:".SITEURL.'admin/manage-category.php'); //it will redirect with constants.php and concate both the siteurls
   //echo "admin deleted";
  }
   else
   {
    //creating session to display message
    //it will display the message in main-content
    header("location:".SITEURL.'admin/manage-category.php'); //it will redirect in add-admin page
    $_SESSION['delete']= "<div class='error'> admin failed to delete. </div>";
   // $_SESSION['add']= "failed to add admin";

    //echo "data not inserted";
   // echo "admin not deleted";
   }



?>
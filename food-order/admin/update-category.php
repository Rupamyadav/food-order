<?php  include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
<h1>update category page</h1>
 <br>
 <?php
   $id=$_GET['id']; //id of selected admin for changes of paricular category
  $sql= "SELECT * FROM tbl_category WHERE id=$id";

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
    $title = $row['title'];
    $image_name = $row['image_name'];
    $featured = $row['featured'];
    $active = $row['active'];
   }
   else
   {
    $_SESSION['no-category']="<div class='error'> no category found </div> ";
    header("location:".SITEURL.'admin/manage-category.php');
   }
}
 ?>
 <form action="" method="POST" >
 <table class="tbl-30">
     <tr>
         <td>title:</td>
         <td><input type="text" value= "<?php echo $title;?>" name="title" placeholder="title"></td></tr>
         <tr>
             <td>current image:</td>
             <td>
                 <input type="text" name="image_name" placeholder="image_name" value= "<?php echo $image_name; ?>">
             </td></tr>
         <tr>
             <td>new image:</td>
             <td>
                 <input type="text" name="image_name" placeholder="image_name" value= "<?php echo $image_name; ?>">
             </td></tr>
            <tr><td>featured: </td>
             <td> <input type="radio" name="featured" value="Yes">Yes
           <input type="radio" name="featured" value="no">No</td> </tr><br>
            <tr><td> category active: </td>
            <td> <input type="radio" name="active" value="Yes">Yes
            <input type="radio" name="active" value="No">No </td></tr>
            <tr>
             <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                 <input type="submit" name="submit" value="update category" class="btn-secondary"></td></tr>
 </table>
 </form>
    </div>
</div>
<?php
  if(isset($_POST['submit'])) 
  {
    //echo "button clicked";
     $id = $_POST['id']; 
     $title =$_POST['title']; 
     $image_name=$_POST['image_name'];
     $featured=$_POST['featured'];
     $active=$_POST['active'];

     $sql= "UPDATE tbl_category SET
     title='$title',
     image_name='$image_name',
     featured='$featured',
     active='$active'
     WHERE id='$id' 
     ";
     $res = mysqli_query($conn,$sql);
  if($res==true)
  {
    $_SESSION['update']= "<div class='success'> category updated successfully. </div>"; //it will display the message in main-content(manage-admin.php)
  header("location:".SITEURL.'admin/manage-category.php'); //it will redirect with constants.php and concate both the siteurls
  }
else{
    $_SESSION['update']= "<div class='error'> category not updated. </div>"; //it will display the message in main-content(manage-admin.php)
   header("location:".SITEURL.'admin/manage-category.php'); //it will redirect with constants.php and concate both the siteurls
}
  }
  ?>

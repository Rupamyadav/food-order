<?php include('partials/menu.php'); ?>
<div class="main-content">
<div class="wrapper">
   <h1> add category</h1>
   <br/>
   <br/>
   <?php
   if(isset($_SESSION['add']))
   {
      echo $_SESSION['add']; //display session message
       unset($_SESSION['add']); //it will remove session message
   }
    if(isset($_SESSION['upload']))
{
   echo $_SESSION['upload']; //display session message
    unset($_SESSION['upload']); //it will remove session message
}
?>

   <form action="" method="POST" enctype="multipart/form-data"> <!-- it will allow to upload file or document enctype section-->
    <table class="tbl-30">
        <tr> 
            <td> title: </td>
            <td><input type="text" name="title" placeholder="category title"></td></tr> <br>
           <tr> <td>select image:</td>
           <td><input type="file" name="image_name">
           <tr> <td> category featured: </td>
           <td> <input type="radio" name="featured" value="Yes">Yes
           <input type="radio" name="featured" value="no">No</td> </tr><br>
            <tr><td> category active: </td>
            <td> <input type="radio" name="active" value="Yes">Yes
            <input type="radio" name="active" value="No">No </td></tr>
            <tr>
               <td colspan="2">
                  <input type="submit" name="submit" value="Add category" class="btn-primary">
                </td></tr>
</table>
</form>
<?php
    if(isset($_POST['submit']))
    {
     $title = $_POST['title']; 
     if(isset($_POST['featured'])) //it is for radio button
     {
      $featured=$_POST['featured'];
     }
     else
     {
      $featured="No";
     }
     if(isset($_POST['active'])) //it for radio button
     {
      $active=$_POST['active'];
     }
     else
     {
      $active="No";
     }
     if(isset($_FILES['image_name']['name'])) //it will wheather the image is chosen or not if chosen it will get image_name of image 
     {
     $image_name=$_FILES['image_name']['name'];
     $ext =end(explode('.',$image_name));//it will get extension of the image, ext for extenstion
     $image_name="food_category_".rand(000,999).'.'.$ext; //it will rename the image_name

     $source_path=$_FILES['image_name']['tmp_name'];
     
     $destination_path="../images/category/".$image_name;
     $upload= move_uploaded_file($source_path, $destination_path);
     if($upload==false)
     {
      $_SESSION['upload']="<div class='error'> failed to upload image </div>";
      header('loaction:'.SITEURL.'admin/add-category.php');
      die(); //it will stop the process //if failed to upload the then don't want to store data in database 
     }
   }
     else
     {
      $image_name=""; //it will not upload image name and set the image name as blank
     }
     //print_r($_FILES['image_name']); //it will check whether image is selected or not //print_r is used to display value of array
    // die(); // it will the code
     $sql="INSERT INTO tbl_category SET title='$title' ,featured='$featured', active='$active', image_name='$image_name' "; //it will insert the data in database
    $res= mysqli_query($conn, $sql); //it will excuete the query and save it into database
    if($res==true)
    {
      $_SESSION['add']="<div class='success'>category added </div>";
      header('location:'.SITEURL.'admin/manage-category.php');
    }
    else
    {
      $_SESSION['add']="<div class='error'>category not added </div>";
      header('location:'.SITEURL.'admin/add-category.php');
    }
    }
?>
   </form>
</div>
</div>
<?php include('partials/footer.php') ?>

<?php  include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
<h1>update food page</h1>
 <br>
 <?php
 if(isset($_GET['id']))
 {
   $id=$_GET['id']; //id of selected admin
  $sql2= "SELECT * FROM tbl_food WHERE id=$id" ;

//EXCUETE query
$res2 = mysqli_query($conn,$sql2);
$row=mysqli_fetch_assoc($res2); //it will fetch row from database
    $title = $row['title'];
    $description=$row['description'];
    $price = $row['price'];
    $current_image=$row['image_name'];
    $current_category=$row['category_id'];
    $image_name = $row['image_name'];
    $featured = $row['featured'];
    $active = $row['active'];

   }
   else
   {
    header("location:".SITEURL.'admin/manage-food.php');
   }
 ?>
 <form action="" method="POST" enctype="multipart/form-data" >
 <table class="tbl-30">
     <tr>
         <td>title</td>
         <td><input type="text" value= "<?php echo $title;?>" name="title" placeholder="enter title"></td></tr>
         <td>description</td>
         <td><textarea cols="10" rows="5" value= "<?php echo $description;?>" name="description" placeholder="enter description"></textarea></td></tr>

         <tr>
             <td>price</td>
             <td>
                 <input type="number" name="price" placeholder="enter price" value= "<?php echo $price; ?>">
             </td></tr>
             <td>current image </td>
             <td>
                <?php
                if($current_image == "")
                {
                  echo "<div class='error'>image not available </div>";

                }
                else
                {
                  ?>
                  <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>">
                  <?php

                }
                ?>
             </td></tr>
             <tr>
             <td>new image </td>
             <td>
              <?php
             if(isset($_FILES['image_name']['name'])) //it will wheather the image is chosen or not if chosen it will get image_name of image 
    {
    $image_name=$_FILES['image_name']['name'];
    $ext =end(explode('.',$image_name));//it will get extension of the image, ext for extenstion
    $image_name="food_".rand(000,999).'.'.$ext; //it will rename the image_name

    $source_path=$_FILES['image_name']['tmp_name'];
    
    $destination_path="../images/food/".$image_name;
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
    ?>
             </td></tr>
             <tr>
            <td>category</td>
            <td>
                <select name="category">
<?php
$sql="SELECT * FROM tbl_category WHERE active='Yes' ";
$res=mysqli_query($conn,$sql);
$count=mysqli_num_rows($res);
if($count>0)
{
while($rows=mysqli_fetch_assoc($res))
{
 $Category_title=$row['title'];
 $Category_id=$row['id'];
// echo "<option value='$Category_id'>$Category_title </option>";
?>
<option value="<?php echo $Category_id ?>"> <?php echo $Category_title ?> </option>
<?php 
}
}
else
{
  echo "<option value='0'>category not avilable </option>";
}
?>
                    <option value="0">test category </option>
</select>
</td>
</tr>
             <tr>
                <td>featured</td>
           <td> <input <?php if($featured=="yes") { echo "checked"; } ?> type="radio" name="featured" value="yes">Yes
           <input  <?php if($featured=="No") { echo "checked"; } ?> type="radio" name="featured" value="No">No
        </td></tr>
           <tr>
                <td>active</td>
           <td> 
           <input  <?php if($active=="yes") {    echo "checked";  }   ?> name="active" type="radio" value="yes">Yes
           <input  <?php if($featured=="no")    {  echo "checked"; } ?> name="active" type="radio" value="<?php  echo $active ?>">No
           </td></tr>
            <tr>
             <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                 <input type="submit" name="submit" value="update food" class="btn-secondary"></td></tr>
 </table>
 </form>
    </div>
</div>
<?php
  if(isset($_POST['submit'])) 
  {
    //echo "button clicked";
     $title = $_POST['title']; 
     $description=$_POST['description'];
     $price=($_POST['price']);
     $image_name=$_POST['image_name'];
     if(isset($_POST['featured']))
    {
    $featured=$_POST['featured'];
    }
    else
    {
        $featured="No"; //setting default value
    }
    if(isset($_POST['active']))
    {
        $active=$_POST['active'];
    }
    else
    {
        $active="No"; //setting default value
    }

     $sql= "UPDATE tbl_food SET
     title='$title',
     description='$description'
     price='$price',
     image_name='$image_name',
     featured='$featured',
     active='$active',
     WHERE id='$id' 
     ";
     $res = mysqli_query($conn,$sql);
  if($res==true)
  {
    $_SESSION['update']= "<div class='success'> food update successfully. </div>"; //it will display the message in main-content(manage-admin.php)
  header("location:".SITEURL.'admin/manage-food.php'); //it will redirect with constants.php and concate both the siteurls

  }
else{
    $_SESSION['update']= "<div class='error'> admin not updated. </div>"; //it will display the message in main-content(manage-admin.php)
   header("location:".SITEURL.'admin/manage-food.php'); //it will redirect with constants.php and concate both the siteurls

}
  }





?>
<?php include('partials/footer.php') ?>
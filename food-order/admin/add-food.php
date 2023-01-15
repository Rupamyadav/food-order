<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
<h1>add food</h1>
</br>
<?php
 if(isset($_SESSION['delete']))
{
   echo $_SESSION['delete']; //display session message
    unset($_SESSION['delete']); //it will remove session message
}
if(isset($_SESSION['upload']))
{
   echo $_SESSION['upload']; //display session message
    unset($_SESSION['upload']); //it will remove session message
}
?>
<form action="" method="POST" enctype="multipart/form-data">
<table class="tbl-30">
    <tr>
        <td>title:</td>
        <td><input type="text" name="title" placeholder="enter title"></td></tr>
        <tr>
            <td>description</td>
            <td>
                <textarea cols="30" rows="6" name="description" placeholder="enter description"></textarea>
            </td></tr>
           <tr>
                <td>price</td>
           <td> <input type="number" name="price"></td></tr>
           <tr>
                <td>image_name</td>
           <td> <input type="file" name="image_name"></td></tr>
           <tr>
                <td>category id</td>
           <td> <select name="category_id">
            <?php
            $sql="SELECT * FROM tbl_category WHERE active='Yes'"; //it will get the category from database
            $res=mysqli_query($conn, $sql); //it will excuete the query
            $count=mysqli_num_rows($res); //it will fetch row
            if($count>0)
            {
                while($row=mysqli_fetch_assoc($res)) //it will fetch row from database
                {
                    $id= $row['id'];
                    $title=$row['title'];
                    ?>
                    <option value="<?php echo $id; ?>"><?php echo $title; ?> </option>
                    <?php
                }
            }
            else
            {
                ?>
                <option value="0">no category found </option>
                <?php
            }
            ?>
         </select>
           </td></tr>
           <tr>
                <td>featured</td>
           <td> <input type="radio" name="featured" value="yes">Yes
           <input type="radio" name="featured" value="No">No
        </td></tr>
           <tr>
                <td>active</td>
           <td> 
           <input type="radio" name="active" value="yes">Yes
           <input type="radio" name="active" value="No">No
           </td></tr>
           <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="add-food" class="btn-secondary"></td></tr>
</table>
</form>
<?php
if(isset($_POST['submit']))
{
    $title=$_POST['title'];   //it will save the name as u have given or get the data from form
    $description=$_POST['description'];
    $price=($_POST['price']);
    $category_id=($_POST['category_id']);
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
    //sql query to save the data into database
    $sql2 = "INSERT INTO tbl_food SET
    title='$title',
    description='$description',
    price=$price,
   image_name='$image_name',
    category_id=$category_id,
    featured='$featured',
    active='$active'  
    ";
    $res2 = mysqli_query($conn,$sql2);

   // check whether data is inserted or not
   if($res2==TRUE)
   {
    //echo "data inserted";
    //creating session to display message
    $_SESSION['add']= "<div class='success'> food added successfully. </div>";  //it will display the message in main-content(manage-admin.php)
    header("location:".SITEURL.'admin/manage-food.php');//it will redirect with constants.php and concate both the siteurls

  }
   else
   {
    //creating session to display message
    $_SESSION['add']= "<div class='error'> admin failed to add </div>";  //it will display the message in main-content
    header("location:".SITEURL.'admin/add-food.php'); //it will redirect in add-admin page
    $_SESSION['add']= "failed to add food";

    //echo "data not inserted";
   }
}
?>
<?php include('partials/footer.php') ?>

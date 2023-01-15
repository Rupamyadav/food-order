<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>manage category</h1>
        <a href="add-category.php" class="btn-primary">Add category</a>
<br/><br/><br/>
<?php 
if(isset($_SESSION['add']))
{
   echo $_SESSION['add']; //display session message
    unset($_SESSION['add']); //it will remove session message
}
if(isset($_SESSION['delete']))
{
   echo $_SESSION['delete']; //display session message
    unset($_SESSION['delete']); //it will remove session message
}
if(isset($_SESSION['update']))
{
   echo $_SESSION['update']; //display session message
    unset($_SESSION['update']); //it will remove session message
}
if(isset($_SESSION['no-category']))
{
   echo $_SESSION['no-category']; //display session message
    unset($_SESSION['no-category']); //it will remove session message
}
?>
<br/><br/><br/>
    <table class="tbl-full">
<tr>   
<th> S.N</th>
<th>Title</th>
<th> image_name</th>
<th>Featured</th>
<th> Active</th>
<th></th>
<th></th>
<th>Actions</th>
</tr>
<?php
    $sql = "SELECT * FROM tbl_category"; //query to get all admin
    $res= mysqli_query($conn,$sql); //excuete the query
    if($res==TRUE) //CHECK weather the query is excueted or not
    {
        $count = mysqli_num_rows($res); //it will get all the rows
        $sn=1;
        if($count >0)
        {
           while($rows=mysqli_fetch_assoc($res)) //it will fetch all the row of database
           {
            $id=$rows['id'];
            $title=$rows['title'];
            $image_name=$rows['image_name'];
            $featured=$rows['featured'];
            $active=$rows['active'];
            ?>
            <tr>
<td> <?php echo $sn++; ?> </td>
<td><?php echo $title; ?> </td>
<td> <?php 
if($image_name!="")
{
 ?>
<img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
 <?php
}
else
{
    echo "<div class='error'> image not added </div>";
}
?> </td>
<td> <?php echo $featured; ?> </td>
<td> <?php echo $active; ?> </td>
<td></td>
<td></td>
<td>
<a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php  echo $id; //it will get the id in update category?>"  class="btn-secondary">Update Category</a>
<a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php  echo $id;?>" class="btn-danger">Delete Category</a>
</td>
</tr>
            <?php
           }
        }
        else
        {

        }
    }

?>
    </table> 



</div>
</div>




<?php include('partials/footer.php') ?>
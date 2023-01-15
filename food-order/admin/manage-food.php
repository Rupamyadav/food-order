<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>manage food</h1>
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add food</a>
<br/><br/>
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
 ?>
    <table class="tbl-full">
<tr>   
<th> S.N</th>
<th> title</th>
<th> price</th>
<th> image</th>
<th> featured</th>
<th> active</th>
<th> actions</th>
</tr>
<?php
    $sql = "SELECT * FROM tbl_food"; //query to get all admin
    $res= mysqli_query($conn,$sql); //excuete the query
    //if($res==TRUE) //CHECK weather the query is excueted or not
    //{
        $count = mysqli_num_rows($res); //it will get all the rows
        $sn=1;
        if($count >0)
        {
           while($rows=mysqli_fetch_assoc($res)) //it will fetch all the row of database
           {
            $id=$rows['id'];
            $title=$rows['title'];
            $price=$rows['price'];
            $image_name=$rows['image_name'];
            $featured=$rows['featured'];
            $active=$rows['active'];
            ?>
            <tr>
                
<td> <?php echo $sn++; ?> </td>
<td><?php echo $title; ?> </td>
<td> <?php echo $price; ?> </td>
<td> 
    <?php
if($image_name!="")
{
 ?>
<img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
 <?php
}
else
{
    echo "<div class='error'> image not added </div>";
}
?>
 </td>
<td> <?php echo $featured; ?> </td>
<td> <?php echo $active; ?> </td>
<td>
<a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php  echo $id;?>"  class="btn-secondary">update food</a>
<a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php  echo $id;?>" class="btn-danger">delete food</a>
</td>
</tr>
<?php
           }
        }
        else
        {
           echo "<tr> <td colspan='7' class='error'> food not added</td></tr>";
        }
?>
    </table> 
</div></div>
<?php include('partials/footer.php') ?>
<?php include('partials/menu.php') ?>

<div class="main-content">
<div class="wrapper">
   <h1> manage admin</h1>

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
if(isset($_SESSION['user-not-found']))
{
   echo $_SESSION['user-not-found']; //display session message
    unset($_SESSION['user-not-found']); //it will remove session message
}
if(isset($_SESSION['user-found']))
{
   echo $_SESSION['user-found']; //display session message
    unset($_SESSION['user-found']); //it will remove session message
}
if(isset($_SESSION['pwd-changed']))
{
   echo $_SESSION['pwd-changed']; //display session message
    unset($_SESSION['pwd-changed']); //it will remove session message
}
if(isset($_SESSION['pwd-not-changed']))
{
   echo $_SESSION['pwd-not-changed']; //display session message
    unset($_SESSION['pwd-not-changed']); //it will remove session message
}

?>
<br/><br/>
<a href="add-admin.php" class="btn-primary">Add Admin</a>
    <table class="tbl-full">
<tr>   
<th> S.N</th>
<th> Full Name</th>
<th> Username</th>
<th> Actions</th>
</tr>
<?php
    $sql = "SELECT * FROM tbl_admin"; //query to get all admin
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
            $full_name=$rows['full_name'];
            $username=$rows['username'];
            ?>
            <tr>
<td> <?php echo $sn++; ?> </td>
<td><?php echo $full_name; ?> </td>
<td> <?php echo $username; ?> </td>
<td>
<a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php  echo $id;?>"  class="btn-secondary">update Admin</a>
<a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php  echo $id;?>" class="btn-danger">delete Admin</a>
<a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php  echo $id;?>"  class="btn-primary">change-password</a>
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
</div></div>
<?php include('partials/footer.php') ?>

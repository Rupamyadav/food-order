<?php include('partials/menu.php'); ?>
<div class="main-content">
<div class="wrapper">
   <h1> DASHBOARD</h1>
  <?php 
  if(isset($_SESSION['login']))
    {
       echo $_SESSION['login']; //display session message
       unset($_SESSION['login']); //it will remove session message
    } 
    if(isset($_SESSION['user']))
    {
       echo $_SESSION['user']; //display session message when you are logged in from particular username
    } 
?>
     <div class="col-4 text-center">
<h1>5</h1>
<br/>
categories
 </div>
    <div class="col-4">
<h1>5</h1>
<br/>
categories
</div>
    <div class="col-4">
<h1>5</h1>
<br/>
categories
</div>
    <div class="col-4">
<h1>5</h1>
<br/>
categories
    </div>
    <div class="clearfix">
    </div>
</div></div>
<?php include('partials/footer.php') ?>

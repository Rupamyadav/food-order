<?php include('../config/constants.php'); ?>
<?php
session_destroy(); // it will destroy when user logout
header('location:'.SITEURL.'admin/login.php');
?>

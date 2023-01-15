<?php if( ! isset($_SESSION['user'])) //if user is not logged in
    {
        $_SESSION['not-login']="<div class='error'> you are not logged in</div>";
        header('location:'.SITEURL.'admin/login.php');
    } ?>
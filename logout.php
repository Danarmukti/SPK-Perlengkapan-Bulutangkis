<?php 
    require 'config/functions.php';
    if(isset($_SESSION['loggedinadmin']) && is_array($_SESSION['loggedinadmin'])) {
        logoutsession();
        $response = 200;
        redirect('login.php','Log out Success!',$response); 
    }
        else if(isset($_SESSION['loggedinuser']) && is_array($_SESSION['loggedinuser'])) {
        logoutsession();
        $response = 200;
        redirect('user-login.php','Log out Success!',$response);
    }
?>
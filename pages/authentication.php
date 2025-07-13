<?php 
if (isset($_SESSION['loggedin'])) {
    $email = validate($_SESSION['loggedinadmin']['email']);
    $query = "SELECT * FROM admins Where email='$email' LIMIT 1";
    $result= mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
               
        logoutsession();
        $response = 400;
        redirect('../login.php','Access Denied!',$response);

    } else {
        $row = mysqli_fetch_assoc($result);
        if ($row['is_ban']==1) {
            logoutsession();
            $response = 400;
            redirect('../login.php','You has been banned!, Contact Admin!',$response);
        }
    }    
} else {
    $response=400;
    redirect('../login.php','Login First!',$response);
}
?>
<?php
require 'config/functions.php';
if (isset($_POST['loginBtn'])) {
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    if ($email != '' && $password != '') {
        $query = "SELECT * FROM admins Where email='$email' LIMIT 1";
        $result= mysqli_query($conn, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $hashedpassword = $row['password'];
            if (mysqli_num_rows($result) == 1) {
                if (!password_verify($password,$hashedpassword)) {
                $response = 400;
                redirect('login.php','Invalid Password',$response);
            }
            if ($row['is_ban']==1) {
                $response = 400;
                redirect('login.php','your account has been banned, Contact admin',$response);
            }
            $_SESSION['loggedin'] = [];
            $_SESSION['loggedinadmin'] = [
                'user_id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
            ];
            $response = 200;
            redirect('pages/index.php','Login Success!',$response);
            } else {
                $response = 400;
                redirect('login.php','Email Invalid',$response);
            }
        } else {
            redirect('login.php','Something Went Wrong!',$response);
        }
    } else {
        redirect('login.php','All Fields Are Mandetory!',$response);
    }
}
if (isset($_POST['loginUserBtn'])) {
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    if ($email != '' && $password != '') {
        $query = "SELECT * FROM user Where email='$email' LIMIT 1";
        $result= mysqli_query($conn, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $hashedpassword = $row['password'];
            if (mysqli_num_rows($result) == 1) {
                if (!password_verify($password,$hashedpassword)) {
                $response = 400;
                redirect('login.php','Invalid Password',$response);
            }
            $_SESSION['loggeduser'] = [];
            $_SESSION['loggedinuser'] = [
                'user_id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
            ];
            $response = 200;
            redirect('index.php','Login Success!',$response);
            } else {
                $response = 400;
                redirect('user-login.php','Email Invalid',$response);
            }
        } else {
            redirect('user-login.php','Something Went Wrong!',$response);
        }
    } else {
        redirect('user-login.php','All Fields Are Mandetory!',$response);
    }
}
if (isset($_POST['registerUserBtn'])) {
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    if ($name != '' && $email != '' && $password != '') {
        $emailCheck = mysqli_query($conn,"SELECT * FROM user WHERE email='$email'");
        if ($emailCheck) {
            if (mysqli_num_rows($emailCheck) > 0) {
                redirect('user-login.php','Email already used!',$response);
            } 
        }
        $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $bcrypt_password,
        ];
        $result = insert('user', $data);
        $response = 200;
        if ($result) {
            redirect('user-login.php','User Created Succesfully!',$response);
        } else {
            redirect('user-login.php','Something went Wrong!',$response);
        }
    } else {
        redirect('user-login.php','Please fill required fields!',$response);
    }
}
if (isset($_POST['itungBobot'])) {
    $preferensi = $_POST['preferensi'];
    foreach ($preferensi as $id1 => $row) {
        foreach ($row as $id2 => $nilai) {
            $lebihPenting = $nilai['pilih'];
            $tingkat = floatval($nilai['tingkat']);
            if ($lebihPenting == $id1) {
                $nilaiPerbandingan = $tingkat;
            } else {
                $nilaiPerbandingan = 1 / $tingkat;
            }
            $cek = mysqli_query($conn, "SELECT * FROM perbandingan_ahp WHERE id_kriteria_1='$id1' AND id_kriteria_2='$id2'");
            if (mysqli_num_rows($cek) > 0) {
                mysqli_query($conn, "UPDATE perbandingan_ahp SET nilai='$nilaiPerbandingan' WHERE id_kriteria_1='$id1' AND id_kriteria_2='$id2'");
            } else {
                mysqli_query($conn, "INSERT INTO perbandingan_ahp (id_kriteria_1, id_kriteria_2, nilai) 
                                     VALUES ('$id1', '$id2', '$nilaiPerbandingan')");
            }
        }
    }
    $hasil = hitungSAW_dinamis(); 
    $_SESSION['hasil_ranking'] = $hasil['data'];
    $_SESSION['ranking'] = $hasil['ranking'];   
    echo "<script>window.location.href = 'Hasil-perbandingan.php';</script>";
    exit;
}
?>
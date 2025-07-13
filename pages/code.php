<?php 

include("../config/functions.php");

if (isset($_POST['saveAdmin'])) {
    
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);
    $is_ban = isset($_POST['is_ban']) == true ? 1:0;

    if ($name != '' && $email != '' && $password != '') {
        
        $emailCheck = mysqli_query($conn,"SELECT * FROM admins WHERE email='$email'");
        if ($emailCheck) {
            if (mysqli_num_rows($emailCheck) > 0) {
                redirect('admins-create.php','Email already used!',$response);
            } 
        }

        $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $bcrypt_password,
            'phone' => $phone,
            'is_ban' => $is_ban
        ];
        $result = insert('admins', $data);
        $response = 200;
        
        if ($result) {
            redirect('admins.php','Admin Created Succesfully!',$response);
        } else {
            redirect('admins-create.php','Something went Wrong!',$response);
        }

    } else {
        
        redirect('admins-create.php','Please fill required fields!',$response);

    }

}

if (isset($_POST['updateAdmin'])) {

    $adminId = validate($_POST['id']);
    $adminData = getById('admins', $adminId);

    
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);
    $is_ban = isset($_POST['is_ban']) == true ? 1:0;

    if ($password != '') {
        $hashedpassword = password_hash($password, PASSWORD_BCRYPT);
    } else {
        $hashedpassword = $adminData['data']['password']; 
  }

    if ($name != '' && $email != '') {

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $hashedpassword,
            'phone' => $phone,
            'is_ban' => $is_ban
        ];
        $result = update('admins', $adminId, $data);
        $response = 200;
        
        if ($result) {
            redirect('admins.php','Admin Updated Succesfully!',$response);
        } else {
            redirect('admins.php','Something went Wrong!',$response);
        }

    } else {
        redirect('admins.php','Please fill required fields!',$response);
    }

}

if (isset($_POST['deleteAdmin'])) {

    $adminId = validate($_POST['id']);
    $adminData = getById('admins', $adminId);

    if ($adminId != '') {

        $result = delete('admins', $adminId);
        $response = 200;
        
        if ($result) {
            redirect('admins.php','Admin Delete Permanent Succesfully!',$response);
        } else {
            redirect('admins.php','Something went Wrong!',$response);
        }

    } else {
        redirect('admins.php','Please fill required fields!',$response);
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
                redirect('user-register.php','Email already used!',$response);
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
            redirect('user-view.php','User Created Succesfully!',$response);
        } else {
            redirect('user-register.php','Something went Wrong!',$response);
        }

    } else {
        
        redirect('user-register.php','Please fill required fields!',$response);

    }

}

if (isset($_POST['updateUser'])) {

    $userId = validate($_POST['id']);
    $userData = getById('user', $userId);

    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    if ($password != '') {
        $hashedpassword = password_hash($password, PASSWORD_BCRYPT);
    } else {
        $hashedpassword = $userData['data']['password']; 
  }

    if ($name != '' && $email != '') {

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $hashedpassword,
        ];
        $result = update('user', $userId, $data);
        $response = 200;
        
        if ($result) {
            redirect('user-view.php','User Updated Succesfully!',$response);
        } else {
            redirect('user-view.php','Something went Wrong!',$response);
        }

    } else {
        redirect('user-view.php','Please fill required fields!',$response);
    }

}

if (isset($_POST['deleteUser'])) {

    $userId = validate($_POST['id']);
    $userData = getById('user', $userId);


    if ($userId != '') {

        $result = delete('user', $userId);
        $response = 200;
        
        if ($result) {
            redirect('user-view.php','User Deleted Succesfully!',$response);
        } else {
            redirect('user-view.php','Something went Wrong!',$response);
        }

    } else {
        redirect('user-view.php','Please fill required fields!',$response);
    }

}

if (isset($_POST['editalternatif'])) {
    foreach ($_POST['nilai'] as $id_alternatif => $dataKriteria) {
        foreach ($dataKriteria as $id_kriteria => $nilai) {
            $cek = mysqli_query($conn, "SELECT * FROM nilai_alternatif 
                WHERE id_alternatif='$id_alternatif' AND id_kriteria='$id_kriteria'");

            if (mysqli_num_rows($cek) > 0) {
                mysqli_query($conn, "UPDATE nilai_alternatif 
                    SET nilai='$nilai' 
                    WHERE id_alternatif='$id_alternatif' AND id_kriteria='$id_kriteria'");
            } else {
                mysqli_query($conn, "INSERT INTO nilai_alternatif (id_alternatif, id_kriteria, nilai)
                    VALUES ('$id_alternatif', '$id_kriteria', '$nilai')");
            }
        }
    }

    redirect('nilai-alternatif.php','nilai alternatif update Succesfully!',200);
}

if (isset($_POST['updateKriteria'])) {

    $kriteriaId = validate($_POST['id']);
    $kriteriaData = getById('kriteria', $kriteriaId);

    $name = validate($_POST['nama']);
    $kode = validate($_POST['kode']);
    $jenis = validate($_POST['jenis']);

    if ($name != '' && $kode != '') {

        $data = [
            'nama' => $name,
            'kode' => $kode,
            'jenis' => $jenis,
        ];
        $result = update('kriteria', $kriteriaId, $data);
        $response = 200;
        
        if ($result) {
            redirect('perhitungan-kriteria.php','Kriteria Updated Succesfully!',$response);
        } else {
            redirect('perhitungan-kriteria.php','Something went Wrong!',$response);
        }

    } else {
        redirect('perhitungan-kriteria.php','Please fill required fields!',$response);
    }

}
if (isset($_POST['saveKriteria'])) {

    $kriteriaId = validate($_POST['id']);
    $kriteriaData = getById('kriteria', $kriteriaId);

    $name = validate($_POST['nama']);
    $kode = validate($_POST['kode']);
    $jenis = validate($_POST['jenis']);

    if ($name != '' && $kode != '') {

        $data = [
            'nama' => $name,
            'kode' => $kode,
            'jenis' => $jenis,
        ];
        $result = insert('kriteria', $data);
        $response = 200;
        
        if ($result) {
            redirect('perhitungan-kriteria.php','Kriteria Added Succesfully!',$response);
        } else {
            redirect('perhitungan-kriteria.php','Something went Wrong!',$response);
        }

    } else {
        redirect('perhitungan-kriteria.php','Please fill required fields!',$response);
    }

}
if (isset($_POST['deleteKriteria'])) {

    $kriteriaId = validate($_POST['id']);
    $kriteriaData = getById('kriteria', $kriteriaId);

    if ($kriteriaId != '') {

        $result = delete('kriteria', $kriteriaId);
        $response = 200;
        
        if ($result) {
            redirect('perhitungan-kriteria.php','Kriteria Deleted Succesfully!',$response);
        } else {
            redirect('perhitungan-kriteria.phpp','Something went Wrong!',$response);
        }

    } else {
        redirect('perhitungan-kriteria.php','Please fill required fields!',$response);
    }

}
if (isset($_POST['itungBobot'])) {
    $preferensi = $_POST['preferensi'];

    foreach ($preferensi as $id1 => $row) {
        foreach ($row as $id2 => $nilai) {
            $lebihPenting = $nilai['pilih'];
            $tingkat = floatval($nilai['tingkat']); // pastikan nilai numerik

            if ($lebihPenting == $id1) {
                $nilaiPerbandingan = $tingkat;
            } else {
                $nilaiPerbandingan = 1 / $tingkat;
            }

            // Cek apakah kombinasi sudah ada (arah 1 ke 2)
            $cek = mysqli_query($conn, "SELECT * FROM perbandingan_ahp WHERE id_kriteria_1='$id1' AND id_kriteria_2='$id2'");

            if (mysqli_num_rows($cek) > 0) {
                // Update jika sudah ada
                mysqli_query($conn, "UPDATE perbandingan_ahp SET nilai='$nilaiPerbandingan' WHERE id_kriteria_1='$id1' AND id_kriteria_2='$id2'");
            } else {
                // Insert jika belum ada
                mysqli_query($conn, "INSERT INTO perbandingan_ahp (id_kriteria_1, id_kriteria_2, nilai) 
                                     VALUES ('$id1', '$id2', '$nilaiPerbandingan')");
            }
        }
    }

    // Proses perhitungan AHP -> SAW
    $hasil = hitungSAW_dinamis(); // Mengembalikan ['data' => [...], 'ranking' => [...]]

    $_SESSION['hasil_ranking'] = $hasil['data']; // simpan hasil skor & normalisasi
    $_SESSION['ranking'] = $hasil['ranking'];    // simpan urutan peringkat

    // Redirect ke halaman ranking
    echo "<script>window.location.href = 'hasil-perhitungan.php';</script>";
    exit;
}
?>
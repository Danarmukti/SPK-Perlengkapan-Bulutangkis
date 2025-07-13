<?php 

session_start();

require 'dbcon.php';
date_default_timezone_set('Asia/Jakarta');

function validate($inputData) {

    global $conn;
    $validateData = mysqli_real_escape_string($conn, $inputData);
    return trim($validateData);

}

function getParamId($type) {
    if (isset($_GET[$type])) {
        if ($_GET[$type]!= '') {
            return $_GET[$type];
        } else {
            return '<h5> Id not found </h5';
        }
    } else {
        return '<h5> Id not given </h5';
    }
}

function redirect($url, $status, $response) {
    
    if ($response !=200) {
        $colorAlert = "danger";
    } else {
        $colorAlert = "success";
    }

    $_SESSION['response'] = $colorAlert;
    $_SESSION['status'] = $status;
    header('Location: '.$url);
    exit(0);

}

function alertMessage() {
    if (isset($_SESSION['status'])) {
        echo '
        <div class="alert alert-'.$_SESSION['response'].' alert-dismissible fade show" role="alert">
           <h6>'. $_SESSION['status'] .'</h6>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
        unset($_SESSION['status']);
    }

}

function insert($tableName, $data) {

    global $conn;

    $table = validate($tableName);

    $columns = array_keys($data);
    $values = array_values($data);

    $finalColumn = implode(',', $columns);
    $finalValues = "'".implode("', '", $values)."'";

    $query = "INSERT INTO $table ($finalColumn) VALUES ($finalValues)";
    $result = mysqli_query($conn, $query);
    return $result;

}

function update($tableName, $id, $data){

    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $updateDataString = "";

    foreach ($data as $column => $value) {
        $updateDataString .= $column. '='. "'$value',";
    }

    $finalUpdateData = substr(trim($updateDataString),0,-1);
    $query = "UPDATE $table SET $finalUpdateData WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    return $result;
}

function getAll($tableName, $status = NULL) {
    global $conn;

    $table = validate($tableName);
    $status = validate($status);

    if ($status == 'status' ) {
        $query = "SELECT * FROM $table WHERE status='0'";
    } else {
        $query = "SELECT * FROM $table ";
    }
    $result = mysqli_query($conn, $query);
    return $result;
}

function getById($tableName, $id) {

    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $query = "SELECT * FROM $table WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        if (mysqli_num_rows($result)==1) {
            $row = mysqli_fetch_assoc($result);
            $response = [
                'status' => 200,
                'data' => $row,
                'message' => "Record Found"
            ];
        return $response;
        } else {
            $response = [
                'status' => 404,
                'message' => "Data Not Found!"
            ];
        return $response;
        }
    } else {
        $response = [
            'status' => 500,
            'message' => "Something went wrong!"
        ];
        return $response;
    }

}

function delete($tableName, $id) {

    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $query = "DELETE FROM $table WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
 
    return $result;
}

function logoutsession() {
    unset($_SESSION['loggedin']);
    unset($_SESSION['loggeduser']);
    unset($_SESSION['loggedinuser']);
    unset($_SESSION['loggedinadmin']);
}

function jsonResponse($status, $statusType, $message) {
    $response = [
        'status' => $status,
        'status_type' => $statusType,
        'message' => $message
    ];
    echo json_encode($response);
    return;
}

function getCount($tablename) {
    global $conn;

    $table = validate($tablename);

    $query = "SELECT * FROM $table";
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $total_count = mysqli_num_rows($query_run);
        return $total_count;
    } else {
        return 'Something went wrong!';
    }
}

function hitungAHP($matriksPerbandingan) {
    $jumlahKriteria = count($matriksPerbandingan);
    $totalKolom = array_fill(0, $jumlahKriteria, 0);

    foreach ($matriksPerbandingan as $baris) {
        foreach ($baris as $i => $nilai) {
            $totalKolom[$i] += $nilai;
        }
    }

    $matriksNormalisasi = [];
    for ($i = 0; $i < $jumlahKriteria; $i++) {
        for ($j = 0; $j < $jumlahKriteria; $j++) {
            $matriksNormalisasi[$i][$j] = $matriksPerbandingan[$i][$j] / $totalKolom[$j];
        }
    }

    $bobot = [];
    for ($i = 0; $i < $jumlahKriteria; $i++) {
        $bobot[$i] = array_sum($matriksNormalisasi[$i]) / $jumlahKriteria;
    }

    $lambdaMax = 0;
    for ($i = 0; $i < $jumlahKriteria; $i++) {
        $rowSum = 0;
        for ($j = 0; $j < $jumlahKriteria; $j++) {
            $rowSum += $matriksPerbandingan[$i][$j] * $bobot[$j];
        }
        $lambdaMax += $rowSum / $bobot[$i];
    }

    $lambdaMax = $lambdaMax / $jumlahKriteria;
    $ci = ($lambdaMax - $jumlahKriteria) / ($jumlahKriteria - 1);
    $riList = [1 => 0.00, 2 => 0.00, 3 => 0.58, 4 => 0.90, 5 => 1.12, 6 => 1.24, 7 => 1.32, 8 => 1.41, 9 => 1.45];
    $ri = $riList[$jumlahKriteria] ?? 1.45;
    $cr = $ri == 0 ? 0 : $ci / $ri;

    return [
        'normalisasi' => $matriksNormalisasi,
        'bobot' => $bobot,
        'lambdaMax' => $lambdaMax,
        'ci' => $ci,
        'cr' => $cr
    ];
}



function ambilMatriksAHP() {
    global $conn;

    $kriteria = mysqli_query($conn, "SELECT * FROM kriteria");
    $dataKriteria = [];
    while ($row = mysqli_fetch_assoc($kriteria)) {
        $dataKriteria[] = $row;
    }

    $jumlah = count($dataKriteria);
    $matriks = [];

    for ($i = 0; $i < $jumlah; $i++) {
        for ($j = 0; $j < $jumlah; $j++) {
            if ($i == $j) {
                $matriks[$i][$j] = 1;
            } else {
                $id1 = $dataKriteria[$i]['id'];
                $id2 = $dataKriteria[$j]['id'];

                $q = mysqli_query($conn, "SELECT nilai FROM perbandingan_ahp WHERE id_kriteria_1='$id1' AND id_kriteria_2='$id2'");
                if (mysqli_num_rows($q) > 0) {
                    $row = mysqli_fetch_assoc($q);
                    $matriks[$i][$j] = $row['nilai'];
                } else {
                    $q = mysqli_query($conn, "SELECT nilai FROM perbandingan_ahp WHERE id_kriteria_1='$id2' AND id_kriteria_2='$id1'");
                    $row = mysqli_fetch_assoc($q);
                    $matriks[$i][$j] = 1 / $row['nilai'];
                }
            }
        }
    }

    return [$dataKriteria, $matriks];
}

function hitungBobotAHP_dinamis() {
    list($dataKriteria, $matriksPerbandingan) = ambilMatriksAHP();
    return hitungAHP($matriksPerbandingan); 
}


function hitungSAW($alternatif, $bobot, $jenisKriteria) {
    $jmlKriteria = count($bobot);
    $nilaiMaks = $nilaiMin = [];

    for ($j = 0; $j < $jmlKriteria; $j++) {
        $kolom = array_column($alternatif, $j);
        $nilaiMaks[$j] = max($kolom);
        $nilaiMin[$j] = min($kolom);
    }

    $hasil = [];
    foreach ($alternatif as $key => $nilai) {
        $skor = 0;
        for ($i = 0; $i < $jmlKriteria; $i++) {
            if ($jenisKriteria[$i] === 'benefit') {
                $normal = ($nilaiMaks[$i] == 0) ? 0 : $nilai[$i] / $nilaiMaks[$i];
            } else {
                $normal = ($nilai[$i] == 0) ? 0 : $nilaiMin[$i] / $nilai[$i];
            }

            $skor += $bobot[$i] * $normal;
        }
        $hasil[$key] = $skor;
    }

    return $hasil;
}

function getRankedAlternatif($hasilSAW) {
    arsort($hasilSAW);
    $ranking = 1;
    $data = [];
    foreach ($hasilSAW as $key => $value) {
        $data[] = [
            'alternatif' => $key,
            'skor' => round($value, 4),
            'peringkat' => $ranking++
        ];
    }
    return $data;
}

function ambilNilaiAlternatif() {
    global $conn;

    $alternatif = mysqli_query($conn, "SELECT * FROM alternatif");
    $kriteria = mysqli_query($conn, "SELECT * FROM kriteria");

    $dataAlternatif = [];
    while ($alt = mysqli_fetch_assoc($alternatif)) {
        $row = [
            'id' => $alt['id'],
            'nama' => $alt['nama'],
            'nilai' => []
        ];

        $kriteriaResult = mysqli_query($conn, "SELECT * FROM kriteria");
        while ($krit = mysqli_fetch_assoc($kriteriaResult)) {
            $idAlt = $alt['id'];
            $idKrit = $krit['id'];

            $nilai = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nilai FROM nilai_alternatif WHERE id_alternatif='$idAlt' AND id_kriteria='$idKrit'"));
            $row['nilai'][] = $nilai['nilai'] ?? 0;
        }

        $dataAlternatif[] = $row;
    }

    return $dataAlternatif;
}

function hitungSAW_dinamis() {
     global $conn;

    $dataAlternatif = ambilNilaiAlternatif();
    
    $bobotAHP = hitungBobotAHP_dinamis();
    $bobot = $bobotAHP['bobot'];

    $jenisKriteria = [];
    $res = mysqli_query($conn, "SELECT jenis FROM kriteria ORDER BY id");
    while ($row = mysqli_fetch_assoc($res)) {
        $jenisKriteria[] = strtolower($row['jenis']);
    }

    $matriksNilai = array_map(fn($alt) => $alt['nilai'], $dataAlternatif);

    $normalisasi = [];
    $jmlKriteria = count($jenisKriteria);
    for ($j = 0; $j < $jmlKriteria; $j++) {
        $kolom = array_column($matriksNilai, $j);
        $max = max($kolom);
        $min = min($kolom);

        foreach ($matriksNilai as $i => $row) {
            $val = $row[$j];
            $normalisasi[$i][$j] = ($jenisKriteria[$j] == 'benefit') 
                ? ($val / $max) 
                : ($min / $val);
        }
    }

    $skor = [];
    foreach ($normalisasi as $i => $row) {
        $total = 0;
        foreach ($row as $j => $nilai) {
            $total += $nilai * $bobot[$j];
        }
        $skor[$i] = $total;
    }

    $hasil = [];
    foreach ($dataAlternatif as $i => $alt) {
        $hasil[] = [
            'id' => $alt['id'],
            'nama' => $alt['nama'],
            'nilai' => $alt['nilai'],
            'normalisasi' => $normalisasi[$i],
            'skor' => $skor[$i]
        ];
    }

    return [
        'data' => $hasil,
        'ranking' => getRankedAlternatif(array_column($hasil, 'skor', 'nama'))
    ];
}


?>
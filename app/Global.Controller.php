<?php
include __DIR__ . '../../config/database.php';

function query($q){
    global $conn;
    return mysqli_query($conn, $q);
}

function fetchAllAssoc($q){
    return mysqli_fetch_all(query($q), MYSQLI_ASSOC);
}

function masaInd($mulai, $sampai){
    $b = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
    ];
    $m = strtotime($mulai);
    $s = strtotime($sampai);
    $tglm = date('j', $m);
    $blnm = date('n', $m);
    $thnm = date('Y', $m);
    $tgls = date('j', $s);
    $blns = date('n', $s);
    $thns = date('Y', $s);

    if($tglm == $tgls && $thnm == $thns && $blnm == $blns){
        return "$tglm {$b[$blnm]} $thnm";
    }
    if($thnm == $thns && $blnm == $blns){
        return "$tglm-$tgls {$b[$blnm]} $thnm";
    }
    if($thnm == $thns){
        return "$tglm {$b[$blnm]} - $tgls {$b[$blns]} $thnm";
    }
    return "$tglm {$b[$blnm]} $thnm - $tgls {$b[$blns]} $thns";
}

function kalenderInd($tgl, $f='j F Y'){
    $h = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thurday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    ];
    $b = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
    ];
    $t = strtotime($tgl);
    $output = date($f, $t);
    $output = str_replace(array_keys($h), array_values($h), $output);
    $output = str_replace(date('F', $t), $b[(int)date('n', $t)], $output);
    return $output;
}

$no = 1;
$hariini = date('Y-m-d');
?>
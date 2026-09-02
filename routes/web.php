<?php

$route = $_GET['route'] ?? 'dashboard';

switch ($route) {

    case 'dashboard':
        
        $page = __DIR__ . '/../resources/views/pages/Dashboard.php';

        break;


    case 'menu':
        include __DIR__ . '/../app/Menu.Controller.php';
        $page = __DIR__ . '/../resources/views/pages/KelolaMenu.php';

        break;

    case 'menu/kategori':
        include __DIR__ . '/../app/Kategori.Controller.php';
        $page = __DIR__ . '/../resources/views/pages/KelolaKategori.php';

        break;

    case 'menu/aktivitas':
        
        $page = __DIR__ . '/../resources/views/pages/AktivitasKelolaMenu.php';

        break;

    case 'kalender':
        
        $page = __DIR__ . '/../resources/views/pages/Kalender.php';

        break;

    case 'kasir':
        
        $page = __DIR__ . '/../resources/views/pages/Kasir.php';

        break;

    case 'transaksi':
        
        $page = __DIR__ . '/../resources/views/pages/KelolaMetode.php';

        break;

    case 'hutang':
        
        $page = __DIR__ . '/../resources/views/pages/Hutang.php';

        break;

    case 'pelanggan':
        include  __DIR__ . '../../app/Pelanggan.Controller.php';
        $page = __DIR__ . '/../resources/views/pages/pelanggan.php';

        break;

    case 'karyawan':
        include  __DIR__ . '../../app/Karyawan.Controller.php';
        $page = __DIR__ . '/../resources/views/pages/karyawan.php';

        break;

    case 'hak/akses':
        
        $page = __DIR__ . '/../resources/views/pages/HakAkses.php';

        break;

    case 'laporan':
        
        $page = __DIR__ . '/../resources/views/pages/Laporan.php';

        break;

    case 'pengaturan':
        
        $page = __DIR__ . '/../resources/views/pages/Pengaturan.php';

        break;


    default:

        http_response_code(404);

        exit('404 | Halaman tidak ditemukan');

}
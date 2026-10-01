<?php
date_default_timezone_set('Asia/Makassar');

function simpanPesananMenunggu($data)
{
    global $conn;

    $transaksi = $data['transaksi'] ?? [];
    $items = $data['items'] ?? [];

    if (empty($items)) {
        return [
            'status' => false,
            'bg' => 'warning',
            'pesan' => 'Pesanan tidak memiliki item.'
        ];
    }

    $tipePesanan = $transaksi['tipe_pesanan'] ?? '';

    $idPelanggan = !empty($transaksi['id_pelanggan'])
        ? (int)$transaksi['id_pelanggan']
        : null;

    $namaPelanggan = trim(
        $transaksi['nama_pelanggan'] ?? ''
    );

    if (trim($tipePesanan) == '') {
        return [
            'status' => false,
            'pesan' => 'Tipe pesanan haap dipilih.',
            'bg' => 'warning'
        ];
    }

    if (!in_array(
        $tipePesanan,
        ['DineIn', 'Takeaway'],
        true
    )) {
        return [
            'status' => false,
            'bg' => 'warning',
            'pesan' => 'Tipe pesanan tidak valid.'
        ];
    }

    $tipePesananDb = match ($tipePesanan) {
        'DineIn' => 1,
        'Takeaway' => 2
    };

    $detail = [];

    $subtotalTransaksi = 0;
    $totalDiskon = 0;

    foreach ($items as $item) {

        $idMenu = (int)($item['id_menu'] ?? 0);
        $qty = (int)($item['qty'] ?? 0);
        $diskon = (int)($item['diskon'] ?? 0);
        $catatan = trim($item['catatan'] ?? '');

        if ($idMenu <= 0) {
            return [
                'status' => false,
                'bg' => 'warning',
                'pesan' => 'Menu tidak valid.'
            ];
        }

        if ($qty <= 0) {
            return [
                'status' => false,
                'bg' => 'warning',
                'pesan' => 'Jumlah menu tidak valid.'
            ];
        }

        $stmt = mysqli_prepare(
            $conn,
            "SELECT harga
             FROM menu
             WHERE id_menu = ?"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "i",
            $idMenu
        );

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $menu = mysqli_fetch_assoc($result);

        mysqli_stmt_close($stmt);

        if (!$menu) {
            return [
                'status' => false,
                'bg' => 'warning',
                'pesan' => "Menu ID $idMenu tidak ditemukan."
            ];
        }

        $harga = (int)$menu['harga'];

        $subtotal = $harga * $qty;

        $diskon = max(0, $diskon);
        $diskon = min($diskon, $subtotal);

        $total = $subtotal - $diskon;

        $subtotalTransaksi += $subtotal;
        $totalDiskon += $diskon;

        $detail[] = [
            'id_menu' => $idMenu,
            'harga' => $harga,
            'qty' => $qty,
            'catatan' => $catatan,
            'diskon' => $diskon,
            'subtotal' => $subtotal,
            'total' => $total
        ];
    }

    $totalTransaksi =
        $subtotalTransaksi - $totalDiskon;

    $statusTransaksi = 2;
    $statusPembayaran = 1;

    $idMetode = null;
    $uangDiterima = 0;
    $kembalian = 0;

    $kodeTransaksi =
        'TRX-' . date('YmdHis');

    mysqli_begin_transaction($conn);

    try {

        $sql = "
            INSERT INTO transaksi (
                kode_transaksi,
                tanggal,
                tipe_pesanan,
                id_pelanggan,
                nama_pelanggan,
                subtotal,
                total_diskon,
                total,
                status_transaksi,
                status_pembayaran,
                id_metode,
                uang_diterima,
                kembalian
            )
            VALUES (
                ?, NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
            )
        ";

        $stmt = mysqli_prepare(
            $conn,
            $sql
        );

        mysqli_stmt_bind_param(
            $stmt,
            "siisiiiiiiii",
            $kodeTransaksi,
            $tipePesananDb,
            $idPelanggan,
            $namaPelanggan,
            $subtotalTransaksi,
            $totalDiskon,
            $totalTransaksi,
            $statusTransaksi,
            $statusPembayaran,
            $idMetode,
            $uangDiterima,
            $kembalian
        );

        if (!mysqli_stmt_execute($stmt)) {

            mysqli_stmt_close($stmt);

            throw new Exception(
                'Gagal menyimpan pesanan.'
            );
        }

        $idTransaksi =
            mysqli_insert_id($conn);

        mysqli_stmt_close($stmt);

        $sqlDetail = "
            INSERT INTO detail_transaksi (
                id_transaksi,
                id_menu,
                qty,
                harga,
                catatan,
                diskon,
                subtotal,
                total
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ";

        $stmtDetail = mysqli_prepare(
            $conn,
            $sqlDetail
        );

        foreach ($detail as $item) {

            mysqli_stmt_bind_param(
                $stmtDetail,
                "iiiisiii",
                $idTransaksi,
                $item['id_menu'],
                $item['qty'],
                $item['harga'],
                $item['catatan'],
                $item['diskon'],
                $item['subtotal'],
                $item['total']
            );

            if (!mysqli_stmt_execute($stmtDetail)) {

                mysqli_stmt_close($stmtDetail);

                throw new Exception(
                    'Gagal menyimpan detail pesanan.'
                );
            }
        }

        mysqli_stmt_close($stmtDetail);

        mysqli_commit($conn);

        return [
            'status' => true,
            'bg' => 'success',
            'pesan' => 'Pesanan berhasil disimpan.',
            'data' => [
                'id_transaksi' => $idTransaksi,
                'kode_transaksi' => $kodeTransaksi,
                'status_transaksi' => $statusTransaksi,
                'status_pembayaran' => $statusPembayaran,
                'subtotal' => $subtotalTransaksi,
                'total_diskon' => $totalDiskon,
                'total' => $totalTransaksi
            ]
        ];

    } catch (Throwable $e) {

        mysqli_rollback($conn);

        throw $e;
    }
}

function simpanTransaksi($data)
{
    global $conn;

    $transaksi = $data['transaksi'] ?? [];
    $items = $data['items'] ?? [];
    $pembayaran = $data['pembayaran'] ?? [];

    $metode = $pembayaran['metode'] ?? '';

    if (empty($items)) {
        return [
            'status' => false,
            'pesan' => 'Pesanan tidak memiliki item.',
            'bg' => 'warning'
        ];
    }

    $detail = [];

    $subtotalTransaksi = 0;
    $totalDiskon = 0;

    foreach ($items as $item) {

        $idMenu = (int)($item['id_menu'] ?? 0);
        $qty = (int)($item['qty'] ?? 0);
        $diskon = (int)($item['diskon'] ?? 0);
        $catatan = trim($item['catatan'] ?? '');

        if ($idMenu <= 0) {
            return [
                'status' => false,
                'pesan' => 'Menu tidak valid.',
                'bg' => 'warning'
            ];
        }

        if ($qty <= 0) {
            return [
                'status' => false,
                'pesan' => 'Jumlah menu tidak valid.',
                'bg' => 'warning'
            ];
        }

        $stmt = mysqli_prepare(
            $conn,
            "SELECT harga FROM menu WHERE id_menu = ?"
        );

        mysqli_stmt_bind_param($stmt, "i", $idMenu);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $menu = mysqli_fetch_assoc($result);

        mysqli_stmt_close($stmt);

        if (!$menu) {
            return [
                'status' => false,
                'pesan' => "Menu ID $idMenu tidak ditemukan.",
                'bg' => 'warning'
            ];
        }

        $harga = (int)$menu['harga'];

        $subtotal = $harga * $qty;

        if ($diskon < 0) {
            $diskon = 0;
        }

        if ($diskon > $subtotal) {
            $diskon = $subtotal;
        }

        $total = $subtotal - $diskon;

        $subtotalTransaksi += $subtotal;
        $totalDiskon += $diskon;

        $detail[] = [
            'id_menu' => $idMenu,
            'harga' => $harga,
            'qty' => $qty,
            'catatan' => $catatan,
            'diskon' => $diskon,
            'subtotal' => $subtotal,
            'total' => $total
        ];
    }

    $totalTransaksi = $subtotalTransaksi - $totalDiskon;

    $idMetode = null;

    if ($metode === 'Tunai') {
    
        $stmt = mysqli_prepare(
            $conn,
            "SELECT m.id_metode
             FROM metode m
             INNER JOIN tipe t ON m.id_tipe = t.id_tipe
             WHERE t.kode_tipe = 'tunai'
               AND m.status = 1
             LIMIT 1"
        );
    
        mysqli_stmt_execute($stmt);
    
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
    
        mysqli_stmt_close($stmt);
    
        if (!$row) {
            return [
                'status' => false,
                'pesan' => 'Metode Tunai tidak ditemukan.',
                'bg' => 'warning'
            ];
        }
    
        $idMetode = (int)$row['id_metode'];
    
    } elseif ($metode === 'Transfer') {
    
        $idMetode = (int)($pembayaran['bank'] ?? 0);
    
    } elseif ($metode === 'E-Wallet') {
    
        $idMetode = (int)($pembayaran['ewallet'] ?? 0);
    
    } elseif ($metode === 'Card') {
    
        $idMetode = (int)($pembayaran['card'] ?? 0);
    
    } elseif ($metode === 'Hutang') {
    
        $idMetode = null;
    
    } else {
    
        return [
            'status' => false,
            'pesan' => 'Metode pembayaran tidak valid.',
            'bg' => 'warning'
        ];
    }

    if (in_array($metode, ['Transfer', 'E-Wallet', 'Card'])) {

        if ($idMetode <= 0) {
            return [
                'status' => false,
                'pesan' => 'Metode pembayaran belum dipilih.',
                'bg' => 'warning'
            ];
        }

        $stmt = mysqli_prepare(
            $conn,
            "SELECT m.id_metode
             FROM metode m
             INNER JOIN tipe t ON m.id_tipe = t.id_tipe
             WHERE m.id_metode = ?
               AND t.kode_tipe = ?
               AND m.status = 1
             LIMIT 1"
        );

        $kodeTipe = match ($metode) {
            'Transfer' => 'transfer',
            'E-Wallet' => 'ewallet',
            'Card' => 'card'
        };

        mysqli_stmt_bind_param(
            $stmt,
            "is",
            $idMetode,
            $kodeTipe
        );

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (!mysqli_fetch_assoc($result)) {
            mysqli_stmt_close($stmt);
            return [
                'status' => false,
                'pesan' => 'Metode pembayaran tidak valid.',
                'bg' => 'warning'
            ];
        }

        mysqli_stmt_close($stmt);
    }
    
    $uangDiterima = 0;
    $kembalian = 0;
    $statusPembayaran = 1; // 1 = belum_lunas
    
    if ($metode === 'Hutang') {
    
        $uangDiterima = 0;
        $kembalian = 0;
        $statusPembayaran = 1;
    
    } elseif ($metode === 'Tunai') {
    
        $uangDiterima = (int)($pembayaran['nominal'] ?? 0);
    
        if ($uangDiterima < $totalTransaksi) {
            return [
                'status' => false,
                'pesan' => 'Uang yang diterima kurang dari total transaksi.',
                'bg' => 'warning'
            ];
        }
    
        $kembalian = $uangDiterima - $totalTransaksi;
        $statusPembayaran = 2; // lunas
    
    } else {
        $uangDiterima = $totalTransaksi;
        $kembalian = 0;
        $statusPembayaran = 2; // lunas
    }

    $tipePesanan = $transaksi['tipe_pesanan'] ?? '';

    $idPelanggan = !empty($transaksi['id_pelanggan'])
        ? (int)$transaksi['id_pelanggan']
        : null;

    $namaPelanggan = trim($transaksi['nama_pelanggan'] ?? '');

    if ($metode === 'Hutang' && empty($idPelanggan)) {
        return [
            'status' => false,
            'pesan' => 'Pelanggan terdaftar wajib dipilih untuk transaksi hutang.',
            'bg' => 'warning'
        ];
    }

    if (trim($tipePesanan) == '') {
        return [
            'status' => false,
            'pesan' => 'Tipe pesanan harap dipilih.',
            'bg' => 'warning'
        ];
    }

    if (!in_array($tipePesanan, ['DineIn', 'Takeaway'], true)) {
        return [
            'status' => false,
            'pesan' => 'Tipe pesanan tidak valid.',
            'bg' => 'warning'
        ];
    }

    $tipePesananDb = match ($tipePesanan) {
        'DineIn' => 1,
        'Takeaway' => 2
    };

    $kodeTransaksi = 'TRX-' . date('YmdHis');

    $statusTransaksi = 1; // 1 = selesai

    mysqli_begin_transaction($conn);
    try{
        $sql = "
            INSERT INTO transaksi (
                kode_transaksi,
                tanggal,
                tipe_pesanan,
                id_pelanggan,
                nama_pelanggan,
                subtotal,
                total_diskon,
                total,
                status_transaksi,
                status_pembayaran,
                id_metode,
                uang_diterima,
                kembalian
            ) VALUES (?, NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ";
        
        $stmt = mysqli_prepare($conn, $sql);
        
       mysqli_stmt_bind_param(
            $stmt,
            "siisiiiiiiii",
            $kodeTransaksi,
            $tipePesananDb,
            $idPelanggan,
            $namaPelanggan,
            $subtotalTransaksi,
            $totalDiskon,
            $totalTransaksi,
            $statusTransaksi,
            $statusPembayaran,
            $idMetode,
            $uangDiterima,
            $kembalian
        );
        
        if (!mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            throw new Exception('Gagal menyimpan transaksi.');
        }
        
        $idTransaksi = mysqli_insert_id($conn);
        
        mysqli_stmt_close($stmt);
        
        $sqlDetail = "
            INSERT INTO detail_transaksi(
                id_transaksi,
                id_menu,
                qty,
                harga,
                catatan,
                diskon,
                subtotal,
                total
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ";
        
        $stmtDetail = mysqli_prepare($conn, $sqlDetail);
        
        foreach ($detail as $item) {
        
            mysqli_stmt_bind_param(
                $stmtDetail,
                "iiiisiii",
                $idTransaksi,
                $item['id_menu'],
                $item['qty'],
                $item['harga'],
                $item['catatan'],
                $item['diskon'],
                $item['subtotal'],
                $item['total']
            );
        
            if (!mysqli_stmt_execute($stmtDetail)) {
                mysqli_stmt_close($stmtDetail);
        
                throw new Exception(
                    'Gagal menyimpan detail transaksi.'
                );
            }
        }
        mysqli_stmt_close($stmtDetail);
        
        mysqli_commit($conn);

        return [
            'status' => true,
            'pesan' => 'Transaksi Berhasil',
            'bg' => 'success',
            'data' => [
                'id_transaksi' => $idTransaksi,
                'kode_transaksi' => $kodeTransaksi,
                'detail' => $detail,
                'subtotal' => $subtotalTransaksi,
                'total_diskon' => $totalDiskon,
                'total' => $totalTransaksi
            ]
        ];
    } catch(Throwable $e){
        mysqli_rollback($conn);
        throw $e;
    }

}

function bayarPesananMenunggu($data)
{
    global $conn;

    $idTransaksi = (int)($data['id_transaksi'] ?? 0);
    $metode = $data['metode'] ?? '';

    $bank = (int)($data['bank'] ?? 0);
    $ewallet = (int)($data['ewallet'] ?? 0);
    $card = (int)($data['card'] ?? 0);

    $nominal = (int)($data['nominal'] ?? 0);


    if ($idTransaksi <= 0) {
        return [
            'status' => false,
            'pesan' => 'ID transaksi tidak valid.',
            'bg' => 'warning'
        ];
    }


    $stmt = mysqli_prepare(
        $conn,
        "SELECT
            id_transaksi,
            total,
            status_transaksi,
            status_pembayaran
         FROM transaksi
         WHERE id_transaksi = ?
         LIMIT 1"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $idTransaksi
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $transaksi = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);


    if (!$transaksi) {
        return [
            'status' => false,
            'pesan' => 'Transaksi tidak ditemukan.',
            'bg' => 'warning'
        ];
    }

    if ((int)$transaksi['status_transaksi'] !== 2) {
        return [
            'status' => false,
            'pesan' => 'Pesanan ini sudah tidak berstatus menunggu.',
            'bg' => 'warning'
        ];
    }


    $totalTransaksi = (int)$transaksi['total'];

    $idMetode = null;

    if ($metode === 'Tunai') {

        $stmt = mysqli_prepare(
            $conn,
            "SELECT m.id_metode
             FROM metode m
             INNER JOIN tipe t
                ON m.id_tipe = t.id_tipe
             WHERE t.kode_tipe = 'tunai'
               AND m.status = 1
             LIMIT 1"
        );

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        mysqli_stmt_close($stmt);

        if (!$row) {
            return [
                'status' => false,
                'pesan' => 'Metode Tunai tidak ditemukan.',
                'bg' => 'warning'
            ];
        }

        $idMetode = (int)$row['id_metode'];


    } elseif ($metode === 'Transfer') {

        $idMetode = $bank;


    } elseif ($metode === 'E-Wallet') {

        $idMetode = $ewallet;


    } elseif ($metode === 'Card') {

        $idMetode = $card;


    } else {

        return [
            'status' => false,
            'pesan' => 'Metode pembayaran tidak valid.',
            'bg' => 'warning'
        ];
    }


    if (in_array($metode, [
        'Transfer',
        'E-Wallet',
        'Card'
    ])) {

        if ($idMetode <= 0) {
            return [
                'status' => false,
                'pesan' => 'Metode pembayaran belum dipilih.',
                'bg' => 'warning'
            ];
        }

        $kodeTipe = match ($metode) {
            'Transfer' => 'transfer',
            'E-Wallet' => 'ewallet',
            'Card' => 'card'
        };


        $stmt = mysqli_prepare(
            $conn,
            "SELECT m.id_metode
             FROM metode m
             INNER JOIN tipe t
                ON m.id_tipe = t.id_tipe
             WHERE m.id_metode = ?
               AND t.kode_tipe = ?
               AND m.status = 1
             LIMIT 1"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "is",
            $idMetode,
            $kodeTipe
        );

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $valid = mysqli_fetch_assoc($result);

        mysqli_stmt_close($stmt);

        if (!$valid) {
            return [
                'status' => false,
                'pesan' => 'Metode pembayaran tidak valid.',
                'bg' => 'warning'
            ];
        }
    }

    $uangDiterima = 0;
    $kembalian = 0;


    if ($metode === 'Tunai') {

        if ($nominal < $totalTransaksi) {
            return [
                'status' => false,
                'pesan' => 'Uang yang diterima kurang dari total transaksi.',
                'bg' => 'warning'
            ];
        }

        $uangDiterima = $nominal;

        $kembalian = $nominal - $totalTransaksi;


    } else {

        // Transfer / E-Wallet / Card
        $uangDiterima = $totalTransaksi;
        $kembalian = 0;
    }


    mysqli_begin_transaction($conn);

    try {

        $sql = "
            UPDATE transaksi
            SET
                status_transaksi = 1,
                status_pembayaran = 2,
                id_metode = ?,
                uang_diterima = ?,
                kembalian = ?
            WHERE id_transaksi = ?
              AND status_transaksi = 2
        ";

        $stmt = mysqli_prepare(
            $conn,
            $sql
        );

        mysqli_stmt_bind_param(
            $stmt,
            "iiii",
            $idMetode,
            $uangDiterima,
            $kembalian,
            $idTransaksi
        );

        if (!mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);

            throw new Exception(
                'Gagal memperbarui transaksi.'
            );
        }

        $affectedRows = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);


        if ($affectedRows !== 1) {

            throw new Exception(
                'Transaksi gagal diperbarui atau sudah diproses.'
            );
        }


        mysqli_commit($conn);


        return [
            'status' => true,
            'pesan' => 'Pembayaran berhasil.',
            'bg' => 'success',
            'data' => [
                'id_transaksi' => $idTransaksi,
                'total' => $totalTransaksi,
                'uang_diterima' => $uangDiterima,
                'kembalian' => $kembalian
            ]
        ];


    } catch (Throwable $e) {

        mysqli_rollback($conn);

        throw $e;
    }
}

function jadikanPiutang($idTransaksi, $idPelanggan)
{
    global $conn;

    $idTransaksi = (int)$idTransaksi;
    $idPelanggan = (int)$idPelanggan;

    if ($idTransaksi <= 0) {
        return [
            'status' => false,
            'bg' => 'warning',
            'pesan' => 'ID transaksi tidak valid.'
        ];
    }

    if ($idPelanggan <= 0) {
        return [
            'status' => false,
            'bg' => 'warning',
            'pesan' => 'Silakan pilih pelanggan.'
        ];
    }

    try {
        $stmt = mysqli_prepare($conn, "
            SELECT
                id_transaksi,
                total,
                status_transaksi,
                status_pembayaran
            FROM transaksi
            WHERE id_transaksi = ?
            LIMIT 1
        ");

        mysqli_stmt_bind_param($stmt, "i", $idTransaksi);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $transaksi = mysqli_fetch_assoc($result);

        mysqli_stmt_close($stmt);

        if (!$transaksi) {
            return [
                'status' => false,
                'bg' => 'warning',
                'pesan' => 'Transaksi tidak ditemukan.'
            ];
        }

        if ((int)$transaksi['status_transaksi'] !== 2) {
            return [
                'status' => false,
                'bg' => 'warning',
                'pesan' => 'Transaksi ini bukan pesanan menunggu.'
            ];
        }

        $stmt = mysqli_prepare($conn, "
            SELECT id_pelanggan
            FROM pelanggan
            WHERE id_pelanggan = ?
            LIMIT 1
        ");

        mysqli_stmt_bind_param($stmt, "i", $idPelanggan);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $pelanggan = mysqli_fetch_assoc($result);

        mysqli_stmt_close($stmt);

        if (!$pelanggan) {
            return [
                'status' => false,
                'bg' => 'warning',
                'pesan' => 'Pelanggan tidak ditemukan.'
            ];
        }


        mysqli_begin_transaction($conn);

        $stmt = mysqli_prepare($conn, "
            UPDATE transaksi
            SET
                id_pelanggan = ?,
                nama_pelanggan = NULL,
                status_transaksi = 1,
                status_pembayaran = 1,
                id_metode = NULL,
                uang_diterima = 0,
                kembalian = 0
            WHERE id_transaksi = ?
              AND status_transaksi = 2
        ");

        mysqli_stmt_bind_param(
            $stmt,
            "ii",
            $idPelanggan,
            $idTransaksi
        );

        mysqli_stmt_execute($stmt);

        $affectedRows = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);

        if ($affectedRows !== 1) {
            throw new Exception(
                'Transaksi gagal dijadikan piutang.'
            );
        }

        mysqli_commit($conn);

        return [
            'status' => true,
            'bg' => 'success',
            'pesan' => 'Pesanan berhasil dijadikan piutang.',
            'id_transaksi' => $idTransaksi,
            'id_pelanggan' => $idPelanggan,
            'total' => (int)$transaksi['total']
        ];

    } catch (Throwable $e) {

        mysqli_rollback($conn);

        return [
            'status' => false,
            'bg' => 'danger',
            'pesan' => $e->getMessage()
        ];
    }
}

if(isset($_POST['aksi'])){
    if ($_POST['aksi'] === 'simpanPesananMenunggu') {

        $data = json_decode(
            $_POST['pesanan'] ?? '{}',
            true
        );

        if (!$data) {
            echo json_encode([
                'status' => false,
                'bg' => 'warning',
                'pesan' => 'Data pesanan tidak valid.'
            ]);
            exit;
        }

        try {

            $hasil = simpanPesananMenunggu($data);

            echo json_encode($hasil);

        } catch (Throwable $e) {

            echo json_encode([
                'status' => false,
                'bg' => 'danger',
                'pesan' => $e->getMessage()
            ]);
        }

        exit;
    }

    if ($_POST['aksi'] === 'simpanTransaksi') {

        $data = json_decode($_POST['transaksi'] ?? '{}', true);
    
        if (!$data) {
            echo json_encode([
                'status' => false,
                'pesan' => 'Data transaksi tidak valid.',
                'bg' => 'warning'
            ]);
            exit;
        }
    
        try {
    
            $hasil = simpanTransaksi($data);
    
            echo json_encode($hasil);
    
        } catch (Throwable $e) {
    
            echo json_encode([
                'status' => false,
                'pesan' => $e->getMessage(),
                'bg' => 'danger'
            ]);
        }
    
        exit;
    }

    if ($_POST['aksi'] === 'bayarPesananMenunggu') {

        $data = [
            'id_transaksi' => (int)($_POST['id_transaksi'] ?? 0),
            'metode'       => $_POST['metode'] ?? '',
            'bank'         => (int)($_POST['bank'] ?? 0),
            'ewallet'      => (int)($_POST['ewallet'] ?? 0),
            'card'         => (int)($_POST['card'] ?? 0),
            'nominal'      => (int)($_POST['nominal'] ?? 0)
        ];

        try {

            $hasil = bayarPesananMenunggu($data);

            echo json_encode($hasil);

        } catch (Throwable $e) {

            echo json_encode([
                'status' => false,
                'bg' => 'danger',
                'pesan' => $e->getMessage()
            ]);
        }

        exit;
    }

    if ($_POST['aksi'] === 'jadikanPiutang') {

    $idTransaksi = (int)($_POST['id_transaksi'] ?? 0);
    $idPelanggan = (int)($_POST['id_pelanggan'] ?? 0);

    try {

        $hasil = jadikanPiutang(
            $idTransaksi,
            $idPelanggan
        );

        echo json_encode($hasil);

    } catch (Throwable $e) {

        echo json_encode([
            'status' => false,
            'bg' => 'danger',
            'pesan' => $e->getMessage()
        ]);
    }

    exit;
}
}

$hasil = $_SESSION['toast'] ?? null;
unset($_SESSION['toast']);

$kategori = fetchAllAssoc("SELECT * FROM kategori");
$pelanggan = fetchAllAssoc("SELECT * FROM pelanggan");
$transfer = fetchAllAssoc("SELECT * FROM metode m LEFT JOIN tipe t ON m.id_tipe = t.id_tipe WHERE kode_tipe='transfer' AND status = 1");
$ewallet = fetchAllAssoc("SELECT * FROM metode m LEFT JOIN tipe t ON m.id_tipe = t.id_tipe WHERE kode_tipe='ewallet' AND status = 1");
$card = fetchAllAssoc("SELECT * FROM metode m LEFT JOIN tipe t ON m.id_tipe = t.id_tipe WHERE kode_tipe='card' AND status = 1");

$pesananMenunggu = fetchAllAssoc("
    SELECT
        t.id_transaksi,
        t.kode_transaksi,
        t.tanggal,
        t.tipe_pesanan,
        t.id_pelanggan,
        t.nama_pelanggan,
        t.subtotal,
        t.total_diskon,
        t.total,
        t.status_transaksi,
        t.status_pembayaran,
        p.nama_pelanggan AS namapelanggan
    FROM transaksi t
    LEFT JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
    WHERE t.status_transaksi = 2
    ORDER BY t.id_transaksi DESC
");
$jumlahPesananMenunggu = count($pesananMenunggu);

$cari = trim($_GET['cari'] ?? '');
$kategorif = (int)($_GET['kategorif'] ?? 0);
$currentPage = max(1, (int) ($_GET['page'] ?? 1));
$limit = 10;
$offset = ($currentPage - 1) * $limit;
$where = "";
$params = [];
$types = "";

if($cari !== ''){
    $where .= " AND ( m.nama LIKE ? )";
    $keyword = "%$cari%";
    $params[] = $keyword;
    $types .= "s";
}
if($kategorif > 0){
    $where .= " AND m.id_kategori = ?";
    $params[] = (int)$kategorif;
    $types .= "i";
}

$sqlCount = "SELECT COUNT(*) AS total FROM menu m LEFT JOIN kategori k ON m.id_kategori = k.id_kategori WHERE 1=1 $where";
$stmtCount = mysqli_prepare($conn, $sqlCount);

if(!empty($params)){
    mysqli_stmt_bind_param($stmtCount, $types, ...$params);
}

mysqli_stmt_execute($stmtCount);
$resultCount = mysqli_stmt_get_result($stmtCount);
$totalData = mysqli_fetch_assoc($resultCount)['total'];
$totalPage = max(1, (int) ceil($totalData / $limit));
mysqli_stmt_close($stmtCount);

$sql = "SELECT * FROM menu m LEFT JOIN kategori k ON m.id_kategori = k.id_kategori WHERE 1=1 $where LIMIT ? OFFSET ?";
$paramsData = $params;
$typesData = $types . "ii";
$paramsData[] = $limit;
$paramsData[] = $offset;
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, $typesData, ...$paramsData);
mysqli_stmt_execute($stmt);
$data = mysqli_stmt_get_result($stmt);
?>
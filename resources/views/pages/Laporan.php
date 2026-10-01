<?php
/*
|--------------------------------------------------------------------------
| HELPER VIEW
|--------------------------------------------------------------------------
*/

function formatRupiahLaporan($nominal): string
{
    return 'Rp ' . number_format((int) $nominal, 0, ',', '.');
}

function formatTanggalLaporan($tanggal): string
{
    if (empty($tanggal)) {
        return '-';
    }

    $timestamp = strtotime($tanggal);

    if ($timestamp === false) {
        return '-';
    }

    return date('d-m-Y', $timestamp);
}

function formatWaktuLaporan($tanggal): string
{
    if (empty($tanggal)) {
        return '-';
    }

    $timestamp = strtotime($tanggal);

    if ($timestamp === false) {
        return '-';
    }

    return date('H:i', $timestamp);
}
?>

<section id="Laporan">

    <div
        x-data="{
            FilterRiwayatTransaksi: false,
            ViewRiwayatTransaksi: false,

            selectedData: {
                id_transaksi: null,
                kode_transaksi: '',
                status_transaksi: '',
                status_pembayaran: '',
                tanggal: '',
                pelanggan: '',
                pembayaran: '',
                subtotal: 0,
                total_diskon: 0,
                total: 0,
                uang_diterima: 0,
                kembalian: 0,
                items: []
            },

            formatDesimal(value) {
                return Number(value || 0).toLocaleString('id-ID');
            },

            formatRupiah(value) {
                return 'Rp ' + Number(value || 0).toLocaleString('id-ID');
            },

            openDetail(data) {
                this.selectedData = data;
                this.ViewRiwayatTransaksi = true;
            },

            formatTipePesanan(value) {
                return Number(value) === 1 ? 'DineIn' : 'TakeAway';
            },

            printStruk() {
                window.print();
            }
        }"

        x-init="
            $watch('FilterRiwayatTransaksi', value => {
                document.body.classList.toggle(
                    'overflow-hidden',
                    value || ViewRiwayatTransaksi
                );
            });

            $watch('ViewRiwayatTransaksi', value => {
                document.body.classList.toggle(
                    'overflow-hidden',
                    value || FilterRiwayatTransaksi
                );
            });
        "
    >

        <!-- =========================================================
             HEADER
        ========================================================== -->

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-5">

            <div class="flex items-center gap-x-5">

                <div
                    class="w-13 h-13 rounded-lg bg-primary flex items-center justify-center shrink-0 border border-gray-200/80"
                >
                    <i class="bx bxs-archive text-2xl text-white"></i>
                </div>

                <div>

                    <h1 class="text-2xl font-black text-slate-900">
                        Laporan Penjualan
                    </h1>

                    <p class="text-sm text-slate-500 font-medium mt-1.5">
                        Pantau dan analisis laporan penjualan serta transaksi.
                    </p>

                </div>

            </div>


            <div class="flex flex-row gap-x-3 my-1 shrink-0">

                <button
                    type="button"
                    @click="FilterRiwayatTransaksi = true"
                    class="w-full h-12 md:w-auto flex items-center justify-center bg-primary text-white font-bold px-6 gap-2 rounded-lg cursor-pointer hover:opacity-90 transition-opacity"
                >
                    <i class="bx bxs-filter text-lg"></i>

                    <span>
                        Filter
                    </span>
                </button>

            </div>

        </div>


        <!-- =========================================================
             STATISTIK
        ========================================================== -->

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mt-10 mb-8">

            <!-- TOTAL PENDAPATAN -->

            <div class="bg-white border-e border-gray-200/80 rounded-lg px-3 py-6">

                <div class="flex items-center justify-between">

                    <div class="w-12 h-12 rounded-lg bg-primary flex items-center justify-center">

                        <i class="bx bxs-chart-sine text-xl text-white"></i>

                    </div>

                </div>

                <div class="mt-5">

                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">
                        Total Pendapatan
                    </p>

                    <h3 class="text-xl sm:text-2xl font-black text-gray-900 mt-1.5">
                        <?= formatRupiahLaporan($totalPendapatan) ?>
                    </h3>

                    <p class="text-xs text-gray-400 mt-1.5">
                        dari seluruh transaksi
                    </p>

                </div>

            </div>


            <!-- TOTAL TRANSAKSI -->

            <div class="bg-white border-e border-gray-200/80 rounded-lg px-3 py-6">

                <div class="flex items-center justify-between">

                    <div class="w-12 h-12 rounded-lg bg-primary flex items-center justify-center">

                        <i class="bx bxs-receipt text-xl text-white"></i>

                    </div>

                </div>

                <div class="mt-5">

                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">
                        Total Transaksi
                    </p>

                    <h3 class="text-2xl font-black text-gray-900 mt-1.5">
                        <?= number_format($totalTransaksi, 0, ',', '.') ?>
                    </h3>

                    <p class="text-xs text-gray-400 mt-1.5">
                        transaksi periode ini
                    </p>

                </div>

            </div>


            <!-- TOTAL MENU TERJUAL -->

            <div class="bg-white rounded-lg px-3 py-6 sm:col-span-2 lg:col-span-1">

                <div class="flex items-center justify-between">

                    <div class="w-12 h-12 rounded-lg bg-primary flex items-center justify-center">

                        <i class="bx bxs-bowl-hot text-xl text-white"></i>

                    </div>

                </div>

                <div class="mt-5">

                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">
                        Total Menu Terjual
                    </p>

                    <h3 class="text-2xl font-black text-gray-900 mt-1.5">
                        <?= number_format($totalMenuTerjual, 0, ',', '.') ?>
                    </h3>

                    <p class="text-xs text-gray-400 mt-1.5">
                        total item terjual
                    </p>

                </div>

            </div>

        </div>


        <!-- =========================================================
             DAFTAR PENJUALAN
        ========================================================== -->

        <div class="my-6 bg-white border-t border-gray-200/80 sm:p-5 dark:bg-slate-950 min-w-0">

            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-6">

                <div>

                    <div class="flex items-center gap-2">

                        <div class="w-1.5 h-5 rounded-full bg-primary"></div>

                        <h2 class="text-sm font-black text-slate-800 dark:text-white">
                            Daftar Penjualan
                        </h2>

                    </div>

                    <p class="text-xs text-gray-400 font-medium mt-1 ml-3.5">
                        Riwayat transaksi penjualan
                    </p>

                </div>


                <!-- SEARCH -->

                <div class="relative w-full lg:w-96">

                    <div
                        class="
                            relative flex items-center gap-2
                            p-1.5
                            rounded-lg
                            border-2 border-gray-200/80
                            dark:border-slate-700
                            bg-white dark:bg-slate-800
                            min-h-[48px]
                            transition-all
                            focus-within:border-primary
                        "
                    >

                        <div class="flex items-center text-gray-400 shrink-0 ml-2">

                            <i class="bx bx-search text-lg"></i>

                        </div>


                        <div class="flex-1 min-w-0">
                            <form action="" method="GET" autocomplete="off">
                                <input type="hidden" name="route" value="laporan">
                            
                                <input
                                    type="search"
                                    name="cari"
                                    class="
                                        input-delay
                                        w-full
                                        px-1 py-0.5
                                        bg-transparent
                                        text-slate-900 dark:text-slate-100
                                        text-sm
                                        placeholder:text-gray-400
                                        focus:outline-none
                                        font-medium
                                    "
                                    placeholder="Cari transaksi..."
                                    value="<?= htmlspecialchars($cari) ?>"
                                >
                            </form>
                        </div>

                    </div>

                </div>

            </div>


            <!-- =====================================================
                 TABLE
            ====================================================== -->

            <div class="overflow-x-auto overflow-y-auto max-h-[700px] p-1">

                <table
                    id="selection-table"
                    class="w-full min-w-[900px] text-sm border-separate border-spacing-0"
                >

                    <thead class="sticky top-0 z-10 bg-slate-50 dark:bg-slate-900">

                        <tr>

                            <th class="text-left font-bold text-slate-500 dark:text-slate-400 px-5 py-4 rounded-tl-xl">
                                #
                            </th>

                            <th class="text-left font-bold text-slate-500 dark:text-slate-400 px-5 py-4">
                                Kode Transaksi
                            </th>

                            <th class="text-left font-bold text-slate-500 dark:text-slate-400 px-5 py-4">
                                Tanggal
                            </th>

                            <th class="text-left font-bold text-slate-500 dark:text-slate-400 px-5 py-4">
                                Total
                            </th>

                            <th class="text-left font-bold text-slate-500 dark:text-slate-400 px-5 py-4">
                                Pembayaran
                            </th>

                            <th class="text-left font-bold text-slate-500 dark:text-slate-400 px-5 py-4">
                                Status
                            </th>

                            <th class="text-left font-bold text-slate-500 dark:text-slate-400 px-5 py-4 rounded-tr-xl">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php if (empty($data)): ?>

                            <!-- EMPTY STATE -->

                            <tr>

                                <td colspan="7">

                                    <div class="flex flex-col items-center justify-center py-12 px-4 text-center bg-gray-50">

                                        <div
                                            class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-gray-200/80"
                                        >
                                            <i class="bx bx-archive text-4xl text-gray-300"></i>
                                        </div>

                                        <h3 class="text-base font-black text-slate-800 mb-1">
                                            Data Transaksi Belum Tersedia
                                        </h3>

                                        <p class="text-xs text-gray-400 max-w-sm">
                                            Belum ada transaksi yang sesuai dengan filter laporan.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        <?php else: ?>


                            <?php foreach ($data as $i => $d): ?>

                                <?php
                                $namaPelanggan = namaPelangganLaporan($d);

                                $statusPembayaran = statusPembayaranLaporan(
                                    isset($d['status_pembayaran'])
                                        ? (int) $d['status_pembayaran']
                                        : null
                                );

                                $statusTransaksi = statusTransaksiLaporan(
                                    isset($d['status_transaksi'])
                                        ? (int) $d['status_transaksi']
                                        : null
                                );

                                $namaMetode = !empty($d['nama_metode'])
                                    ? $d['nama_metode']
                                    : '-';
                                ?>

                                <tr
                                    class="group bg-white dark:bg-slate-950 hover:bg-slate-50 dark:hover:bg-slate-900 transition-colors duration-200"
                                >

                                    <!-- NO -->

                                    <td class="px-5 py-4 font-bold text-gray-500">
                                        <?= $no++ ?>
                                    </td>


                                    <!-- KODE -->

                                    <td class="px-5 py-4">

                                        <span
                                            class="inline-flex items-center px-5 py-2 rounded-lg bg-primary text-white text-sm font-bold"
                                        >
                                            <?= htmlspecialchars($d['kode_transaksi']) ?>
                                        </span>

                                    </td>


                                    <!-- TANGGAL -->

                                    <td class="px-5 py-4">

                                        <div class="flex flex-col">

                                            <span class="font-bold text-slate-800 dark:text-slate-200">
                                                <?= kalenderInd($d['tanggal'], 'd M Y') ?>
                                            </span>

                                            <span class="text-xs text-gray-400 mt-0.5">
                                                <?= formatWaktuLaporan($d['tanggal']) ?>
                                            </span>

                                        </div>

                                    </td>


                                    <!-- TOTAL -->

                                    <td class="px-5 py-4">

                                        <span class="font-bold text-primary">
                                            <?= formatRupiahLaporan($d['total']) ?>
                                        </span>

                                    </td>


                                    <!-- PEMBAYARAN -->

                                    <td class="px-5 py-4">

                                        <span class="font-bold text-slate-800 dark:text-slate-200">
                                            <?= htmlspecialchars($namaMetode) ?>
                                        </span>

                                    </td>


                                    <!-- STATUS -->

                                    <td class="px-5 py-4">

                                        <!-- <?php if ((int) $d['status_pembayaran'] === 2): ?>

                                            <span
                                                class="inline-flex items-center px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-600 text-xs font-bold"
                                            >
                                                Lunas
                                            </span>

                                        <?php else: ?>

                                            <span
                                                class="inline-flex items-center px-3 py-1.5 rounded-full bg-amber-50 text-amber-600 text-xs font-bold"
                                            >
                                                Belum Lunas
                                            </span>

                                        <?php endif; ?> -->

                                        <?php
                                        if ($d['status_pembayaran'] === 2) {
                                            $s = 'Lunas';
                                            $ws = 'bg-emerald-600';
                                        } else {
                                            $s = 'Belum Lunas';
                                            $ws = 'bg-rose-600';
                                        }
                                        ?>
                                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg <?= $ws ?> text-xs font-bold text-white">
                                            <!-- <span class="w-1.5 h-1.5 rounded-full bg-white"></span> -->
                                            <?= $s ?>
                                        </span>

                                    </td>


                                    <!-- AKSI -->

                                    <td class="px-5 py-4">

                                        <div
                                            class="inline-flex gap-2"
                                            role="group"
                                        >

                                            <!-- DETAIL -->

                                            <button
                                                type="button"
                                                @click="
                                                    openDetail({
                                                        id_transaksi: <?= (int) $d['id_transaksi'] ?>,
                                                        kode_transaksi: <?= htmlspecialchars(json_encode($d['kode_transaksi']), ENT_QUOTES, 'UTF-8') ?>,
                                                        status_transaksi: <?= htmlspecialchars(json_encode($statusTransaksi), ENT_QUOTES, 'UTF-8') ?>,
                                                        status_pembayaran: <?= htmlspecialchars(json_encode($statusPembayaran), ENT_QUOTES, 'UTF-8') ?>,
                                                        tanggal: <?= htmlspecialchars(json_encode($d['tanggal']), ENT_QUOTES, 'UTF-8') ?>,
                                                        pelanggan: <?= htmlspecialchars(json_encode($namaPelanggan), ENT_QUOTES, 'UTF-8') ?>,
                                                        pembayaran: <?= htmlspecialchars(json_encode($namaMetode), ENT_QUOTES, 'UTF-8') ?>,
                                                        subtotal: <?= (int) $d['subtotal'] ?>,
                                                        total_diskon: <?= (int) $d['total_diskon'] ?>,
                                                        total: <?= (int) $d['total'] ?>,
                                                        uang_diterima: <?= (int) $d['uang_diterima'] ?>,
                                                        kembalian: <?= (int) $d['kembalian'] ?>,
                                                        is_hutang: <?= (
                                                            (int) $d['status_pembayaran'] === 1 &&
                                                            $d['id_metode'] === null
                                                        ) ? 'true' : 'false' ?>,
                                                        items: <?= htmlspecialchars(
                                                            json_encode(
                                                                $detailLaporan[(int) $d['id_transaksi']] ?? [],
                                                                JSON_HEX_TAG |
                                                                JSON_HEX_APOS |
                                                                JSON_HEX_AMP |
                                                                JSON_HEX_QUOT
                                                            ),
                                                            ENT_QUOTES,
                                                            'UTF-8'
                                                        ) ?>
                                                    })
                                                "
                                                class="w-10 h-10 rounded-lg bg-slate-800 text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all"
                                                title="Lihat detail"
                                            >
                                                <i class="bx bxs-eye"></i>
                                            </button>

                                        </div>

                                        <div
                                            class="inline-flex gap-2"
                                            role="group"
                                        >

                                            <button
                                                type="button"
                                                onclick="showConfirmForm({
                                                    title: 'Hapus Transaksi',
                                                    message: 'Apakah Anda yakin ingin hapus permanen transaksi <?= htmlspecialchars($d['kode_transaksi']); ?> senilai <?= formatRupiahLaporan($d['total']) ?>?',
                                                    actionText: 'Ya, hapus',
                                                    type: 'danger',
                                                    nameAksi: 'hapus',
                                                    inputs: [
                                                        {
                                                            name: 'aksi',
                                                            type: 'hidden',
                                                            value: 'hapus'
                                                        },
                                                        {
                                                            name: 'id',
                                                            type: 'hidden',
                                                            value: <?= (int) $d['id_transaksi']; ?>
                                                        }
                                                    ]
                                                });"
                                                class="w-10 h-10 rounded-lg bg-red-500 text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all"
                                                title="Hapus Transaksi"
                                            >
                                                <i class="bx bxs-trash"></i>
                                            </button>

                                        </div>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

            <?php

            $queryPagination = $_GET;

            unset($queryPagination['page']);

            ?>

            <?php if ($totalData > 0 && $totalPage > 1): ?>
            
            <div class="w-full flex justify-center mt-6">
                <nav aria-label="Pagination">
            
                    <ul class="inline-flex items-center gap-1.5 p-1.5 rounded-lg border-2 border-gray-200/80 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm font-medium">
            
                        <!-- Previous -->
                        <li>
            
                            <?php if ($currentPage > 1): ?>
                            
                                <?php
                                $queryPagination['page'] = $currentPage - 1;
                                ?>

                                <a
                                    href="?<?= http_build_query($queryPagination) ?>"
                                    class="flex items-center justify-center px-3.5 h-9 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors"
                                >
                                    Previous
                                </a>
                            
                            <?php else: ?>
                            
                                <span
                                    class="flex items-center justify-center px-3.5 h-9 rounded-lg text-slate-400 dark:text-slate-500 opacity-50 cursor-not-allowed pointer-events-none"
                                >
                                    Previous
                                </span>
                            
                            <?php endif; ?>
                            
                        </li>
                            
                            
                        <!-- Nomor halaman -->
                        <?php

                        $startPage = max(1, $currentPage - 2);
                        $endPage = min($totalPage, $currentPage + 2);
                            
                        ?>

                            
                        <!-- Halaman pertama -->
                        <?php if ($startPage > 1): ?>
                        
                            <?php
                            $queryPagination['page'] = 1;
                            ?>

                            <li>
                                <a
                                    href="?<?= http_build_query($queryPagination) ?>"
                                    class="flex items-center justify-center w-9 h-9 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors"
                                >
                                    1
                                </a>
                            </li>
                        
                            <?php if ($startPage > 2): ?>
                            
                                <li>
                                    <span class="flex items-center justify-center w-9 h-9 text-slate-400">
                                        ...
                                    </span>
                                </li>
                            
                            <?php endif; ?>
                            
                        <?php endif; ?>
                            
                            
                        <!-- Halaman sekitar halaman aktif -->
                        <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                        
                            <?php
                            $queryPagination['page'] = $i;
                            ?>

                            <li>
                        
                                <a
                                    href="?<?= http_build_query($queryPagination) ?>"
                                    class="flex items-center justify-center w-9 h-9 rounded-lg
                                    <?= $i === $currentPage
                                        ? 'bg-primary text-white font-bold shadow-sm'
                                        : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors'
                                    ?>"
                                >
                                    <?= $i ?>
                                </a>
                        
                            </li>
                        
                        <?php endfor; ?>
                        
                        
                        <!-- Halaman terakhir -->
                        <?php if ($endPage < $totalPage): ?>
                        
                            <?php if ($endPage < $totalPage - 1): ?>
                            
                                <li>
                                    <span class="flex items-center justify-center w-9 h-9 text-slate-400">
                                        ...
                                    </span>
                                </li>
                            
                            <?php endif; ?>
                            
                            
                            <?php
                            $queryPagination['page'] = $totalPage;
                            ?>

                            <li>
                                <a
                                    href="?<?= http_build_query($queryPagination) ?>"
                                    class="flex items-center justify-center w-9 h-9 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors"
                                >
                                    <?= $totalPage ?>
                                </a>
                            </li>
                            
                        <?php endif; ?>
                            
                            
                        <!-- Next -->
                        <li>
                            
                            <?php if ($currentPage < $totalPage): ?>
                            
                                <?php
                                $queryPagination['page'] = $currentPage + 1;
                                ?>

                                <a
                                    href="?<?= http_build_query($queryPagination) ?>"
                                    class="flex items-center justify-center px-3.5 h-9 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors"
                                >
                                    Next
                                </a>
                            
                            <?php else: ?>
                            
                                <span
                                    class="flex items-center justify-center px-3.5 h-9 rounded-lg text-slate-400 dark:text-slate-500 opacity-50 cursor-not-allowed pointer-events-none"
                                >
                                    Next
                                </span>
                            
                            <?php endif; ?>
                            
                        </li>
                            
                    </ul>
                            
                </nav>
            </div>
                            
            <?php endif; ?>

        </div>


        <!-- =========================================================
             MODAL FILTER
        ========================================================== -->

        <div>

            <div
                x-show="FilterRiwayatTransaksi"
                x-cloak
                @keydown.escape.window="FilterRiwayatTransaksi = false"
                class="fixed inset-0 z-[999] flex justify-center items-center w-full p-4 sm:p-6 overflow-y-auto"
            >

                <!-- BACKDROP -->

                <div
                    x-show="FilterRiwayatTransaksi"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-slate-950/60 backdrop-blur-[2px]"
                    @click="FilterRiwayatTransaksi = false"
                ></div>


                <!-- MODAL -->

                <div
                    x-show="FilterRiwayatTransaksi"
                    x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 scale-95 translate-y-4 sm:translate-y-2"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                    x-transition:leave-end="opacity-0 scale-95 translate-y-4 sm:translate-y-2"
                    class="relative w-full max-w-xl z-10 my-auto"
                >

                    <div
                        class="relative bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-lg p-5 sm:p-8 shadow-xl max-h-[calc(100vh-2rem)] overflow-y-auto"
                    >

                        <!-- HEADER -->

                        <div class="mb-6 sm:mb-8 flex justify-between items-start sm:items-center gap-4">

                            <div class="flex items-center gap-3 sm:gap-4">

                                <div
                                    class="flex w-12 h-12 rounded-lg bg-primary items-center justify-center shrink-0"
                                >
                                    <i class="bx bxs-filter text-2xl text-white"></i>
                                </div>

                                <div>

                                    <h1 class="text-slate-900 dark:text-white font-black text-xl sm:text-2xl leading-tight">
                                        Filter Riwayat Transaksi
                                    </h1>

                                    <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 font-medium mt-1">
                                        Atur periode dan kriteria pencarian transaksi.
                                    </p>

                                </div>

                            </div>


                            <button
                                type="button"
                                @click="FilterRiwayatTransaksi = false"
                                class="flex items-center justify-center w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 hover:text-white dark:hover:text-white hover:bg-primary dark:hover:bg-primary font-black cursor-pointer transition-colors shrink-0"
                                title="Tutup"
                            >
                                <i class="bx bx-x text-2xl"></i>
                            </button>

                        </div>


                        <!-- FORM -->

                        <form
                            action=""
                            method="GET"
                            class="w-full"
                        >

                            <input
                                type="hidden"
                                name="route"
                                value="laporan"
                            >


                            <div class="grid grid-cols-1 gap-5">

                                <!-- METODE PEMBAYARAN -->

                                <div class="flex flex-col gap-1.5 w-full">

                                    <label
                                        class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1"
                                    >
                                        Metode Pembayaran
                                    </label>

                                    <div class="relative flex items-center w-full group">

                                        <div
                                            class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200"
                                        >
                                            <i class="bx bxs-credit-card text-xl sm:text-lg"></i>
                                        </div>


                                        <select
                                            name="pembayaran"
                                            class="w-full pl-10 sm:pl-11 pr-10 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-lg border-2 border-gray-200/80 dark:border-slate-700 focus:outline-none focus:ring focus:ring-primary focus:border-primary appearance-none transition-all cursor-pointer"
                                        >

                                            <option value="">
                                                Semua Pembayaran
                                            </option>

                                            <?php foreach ($metode as $d): ?>

                                                <option
                                                    value="<?= (int) $d['id_metode'] ?>"
                                                    <?= (string) $pembayaran === (string) $d['id_metode'] ? 'selected' : '' ?>
                                                >
                                                    <?= htmlspecialchars($d['nama_metode']) ?>
                                                </option>

                                            <?php endforeach; ?>

                                        </select>


                                        <div
                                            class="absolute right-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200"
                                        >
                                            <i class="bx bxs-chevron-down text-lg"></i>
                                        </div>

                                    </div>

                                </div>

                                <div class="flex flex-col gap-1.5 w-full">

                                    <label
                                        class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1"
                                    >
                                        Status Pembayaran
                                    </label>

                                    <div class="relative flex items-center w-full group">

                                        <div
                                            class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200"
                                        >
                                            <i class="bx bxs-note text-xl sm:text-lg"></i>
                                        </div>


                                        <select
                                            name="status_pembayaran"
                                            class="w-full pl-10 sm:pl-11 pr-10 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-lg border-2 border-gray-200/80 dark:border-slate-700 focus:outline-none focus:ring focus:ring-primary focus:border-primary appearance-none transition-all cursor-pointer"
                                        >

                                            <option value="">
                                                Semua Status
                                            </option>

                                            <option
                                                value="2"
                                                <?= $statusPembayaranFilter === '2' ? 'selected' : '' ?>
                                            >
                                                Lunas
                                            </option>
                                                                                    
                                            <option
                                                value="1"
                                                <?= $statusPembayaranFilter === '1' ? 'selected' : '' ?>
                                            >
                                                Belum Lunas
                                            </option>

                                        </select>


                                        <div
                                            class="absolute right-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200"
                                        >
                                            <i class="bx bxs-chevron-down text-lg"></i>
                                        </div>

                                    </div>

                                </div>


                                <!-- KATEGORI -->

                                <div class="flex flex-col gap-1.5 w-full">

                                    <label
                                        class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1"
                                    >
                                        Kategori
                                    </label>

                                    <div class="relative flex items-center w-full group">

                                        <div
                                            class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200"
                                        >
                                            <i class="bx bxs-layers-alt text-xl sm:text-lg"></i>
                                        </div>


                                        <select
                                            name="kategori"
                                            class="w-full pl-10 sm:pl-11 pr-10 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-lg border-2 border-gray-200/80 dark:border-slate-700 focus:outline-none focus:ring focus:ring-primary focus:border-primary appearance-none transition-all cursor-pointer"
                                        >

                                            <option value="">
                                                Semua Kategori
                                            </option>

                                            <?php foreach ($kategoriData as $d): ?>

                                                <option
                                                    value="<?= (int) $d['id_kategori'] ?>"
                                                    <?= (int) $kategori === (int) $d['id_kategori'] ? 'selected' : '' ?>
                                                >
                                                    <?= htmlspecialchars($d['nama_kategori']) ?>
                                                </option>

                                            <?php endforeach; ?>

                                        </select>


                                        <div
                                            class="absolute right-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200"
                                        >
                                            <i class="bx bxs-chevron-down text-lg"></i>
                                        </div>

                                    </div>

                                </div>


                                <!-- TANGGAL -->

                                <div class="flex flex-col gap-1.5 w-full">

                                    <label
                                        class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1"
                                    >
                                        Rentang Tanggal
                                    </label>


                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">

                                        <!-- MULAI -->

                                        <div class="relative flex items-center w-full group">

                                            <div
                                                class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200"
                                            >
                                                <i class="bx bxs-calendar text-xl sm:text-lg"></i>
                                            </div>


                                            <input
                                                type="date"
                                                name="tanggal_mulai"
                                                value="<?= htmlspecialchars($tanggalMulai) ?>"
                                                class="w-full pl-10 sm:pl-11 pr-3 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-lg border-2 border-gray-200/80 dark:border-slate-700 focus:outline-none focus:ring focus:ring-primary focus:border-primary transition-all cursor-pointer"
                                            >

                                        </div>


                                        <!-- SAMPAI -->

                                        <div class="relative flex items-center w-full group">

                                            <div
                                                class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200"
                                            >
                                                <i class="bx bxs-calendar text-xl sm:text-lg"></i>
                                            </div>


                                            <input
                                                type="date"
                                                name="tanggal_sampai"
                                                value="<?= htmlspecialchars($tanggalSampai) ?>"
                                                class="w-full pl-10 sm:pl-11 pr-3 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-lg border-2 border-gray-200/80 dark:border-slate-700 focus:outline-none focus:ring focus:ring-primary focus:border-primary transition-all cursor-pointer"
                                            >

                                        </div>

                                    </div>

                                </div>

                            </div>


                            <!-- FOOTER -->

                            <div
                                class="w-full flex flex-col-reverse sm:flex-row justify-end mt-6 sm:mt-8 pt-5 border-t border-gray-100 dark:border-slate-800 gap-3"
                            >

                                <button
                                    type="button"
                                    @click="FilterRiwayatTransaksi = false"
                                    class="w-full sm:w-auto flex items-center justify-center bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-bold px-6 py-3 gap-2 rounded-lg cursor-pointer transition-all active:scale-95"
                                >
                                    Batal
                                </button>


                                <button
                                    type="submit"
                                    class="w-full sm:w-auto flex items-center justify-center bg-primary hover:bg-primary/90 text-white font-black px-6 py-3 gap-2 rounded-lg cursor-pointer transition-all active:scale-95"
                                >

                                    <i class="bx bxs-filter-alt text-lg"></i>

                                    <span>
                                        Terapkan Filter
                                    </span>

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>


        <!-- =========================================================
             MODAL DETAIL TRANSAKSI
        ========================================================== -->

        <div>

            <div
                x-show="ViewRiwayatTransaksi"
                x-cloak
                @keydown.escape.window="ViewRiwayatTransaksi = false"
                class="fixed inset-0 z-[999] flex justify-center items-center w-full p-4 sm:p-6 overflow-y-auto print:p-0 print:static print:block"
            >

                <!-- BACKDROP -->

                <div
                    x-show="ViewRiwayatTransaksi"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-slate-950/60 backdrop-blur-[2px] print:hidden"
                    @click="ViewRiwayatTransaksi = false"
                ></div>


                <!-- CONTAINER -->

                <div
                    x-show="ViewRiwayatTransaksi"
                    x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 scale-95 translate-y-4 sm:translate-y-2"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                    x-transition:leave-end="opacity-0 scale-95 translate-y-4 sm:translate-y-2"
                    id="printable-receipt"
                    class="relative w-full max-w-xl z-10 my-auto print:w-[58mm] sm:print:w-[80mm] print:max-w-none print:m-0 print:p-0"
                >

                    <div
                        class="relative bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 sm:p-8 shadow-2xl max-h-[calc(100vh-2rem)] overflow-y-auto print:overflow-visible print:max-h-none print:border-none print:p-0 print:bg-white print:text-black"
                    >

                        <!-- HEADER -->

                        <div class="mb-6 sm:mb-8 flex justify-between items-start sm:items-center gap-4">

                            <div class="flex items-center gap-3 sm:gap-4 min-w-0">

                                <div
                                    class="flex w-12 h-12 rounded-lg bg-primary items-center justify-center shrink-0 shadow-sm"
                                >
                                    <i class="bx bx-receipt text-2xl text-white"></i>
                                </div>

                                <div class="min-w-0">

                                    <h1 class="text-slate-900 dark:text-white font-black text-xl sm:text-2xl leading-tight">
                                        Detail Riwayat Transaksi
                                    </h1>

                                    <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 font-medium mt-1">
                                        Informasi lengkap transaksi penjualan.
                                    </p>

                                </div>

                            </div>


                            <button
                                type="button"
                                @click="ViewRiwayatTransaksi = false"
                                title="Tutup"
                                class="flex items-center justify-center w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 hover:text-white hover:bg-primary font-black cursor-pointer transition-colors shrink-0"
                            >
                                <i class="bx bx-x text-2xl"></i>
                            </button>

                        </div>


                        <div class="max-w-md mx-auto print:max-w-none">

                            <!-- IDENTITAS TOKO -->

                            <!-- <div
                                class="text-center pb-4 mb-4 border-b border-dashed border-slate-200 dark:border-slate-800 print:border-black"
                            >

                                <h3
                                    class="text-slate-900 dark:text-white font-black text-base tracking-wider uppercase print:text-black print:text-sm"
                                >
                                    PW CAFFE
                                </h3>

                                <p
                                    class="text-xs text-slate-500 dark:text-slate-400 mt-0.5 print:text-black print:text-[10px]"
                                >
                                    Jl. A. Wahab Syahranie No.Gang 9
                                </p>

                                <p
                                    class="text-xs text-slate-500 dark:text-slate-400 print:text-black print:text-[10px]"
                                >
                                    Telp. 081234567890
                                </p>

                            </div> -->


                            <!-- METADATA -->

                            <div
                                class="py-1 text-xs sm:text-sm space-y-1.5 border-b border-dashed border-slate-200 dark:border-slate-800 print:border-black print:py-2 print:text-[10px]"
                            >

                                <div class="flex justify-between gap-4">

                                    <span class="text-slate-500 dark:text-slate-400 font-medium print:text-black">
                                        No. TRX
                                    </span>

                                    <span
                                        class="font-bold text-slate-800 dark:text-slate-200 print:text-black"
                                        x-text="selectedData.kode_transaksi || '-'"
                                    ></span>

                                </div>

                                <div class="flex justify-between gap-4">

                                    <span class="text-slate-500 dark:text-slate-400 font-medium print:text-black">
                                        Pelanggan
                                    </span>

                                    <span
                                        class="font-bold text-slate-800 dark:text-slate-200 print:text-black"
                                        x-text="selectedData.pelanggan || '-'"
                                    ></span>

                                </div>


                                <div class="flex justify-between gap-4">

                                    <span class="text-slate-500 dark:text-slate-400 font-medium print:text-black">
                                        Tanggal
                                    </span>

                                    <span
                                        class="font-bold text-slate-800 dark:text-slate-200 print:text-black"
                                        x-text="selectedData.tanggal || '-'"
                                    ></span>

                                </div>

                            </div>


                            <!-- ITEM -->

                            <div class="my-4 print:my-2">

                                <table class="w-full text-xs sm:text-sm text-left print:text-[10px]">

                                    <thead>

                                        <tr
                                            class="border-b border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 font-bold print:border-black print:text-black"
                                        >

                                            <th class="py-2 pr-2">
                                                Nama
                                            </th>

                                            <th class="py-2 px-1 text-right">
                                                Harga
                                            </th>

                                            <th class="py-2 px-1 text-center">
                                                Qty
                                            </th>

                                            <th class="py-2 pl-2 text-right">
                                                Total
                                            </th>

                                        </tr>

                                    </thead>


                                    <tbody
                                        class="divide-y divide-slate-100 dark:divide-slate-800/60 print:divide-none"
                                    >

                                        <template x-if="selectedData.items.length === 0">

                                            <tr>

                                                <td
                                                    colspan="4"
                                                    class="py-8 text-center text-gray-400"
                                                >
                                                    Detail menu belum dimuat.
                                                </td>

                                            </tr>

                                        </template>


                                        <template
                                            x-for="item in selectedData.items"
                                            :key="item.id_menu"
                                        >
                                                                                    
                                            <tr class="text-slate-800 dark:text-slate-200 print:text-black">
                                                                                    
                                                <td class="py-2.5 pr-2">
                                                                                    
                                                    <div
                                                        class="font-medium"
                                                        x-text="item.nama"
                                                    ></div>
                                                                                    
                                                    <template x-if="item.catatan">
                                                        <div
                                                            class="mt-0.5 text-xs text-slate-400 dark:text-slate-500 print:text-gray-500"
                                                            x-text="'Catatan: ' + item.catatan"
                                                        ></div>
                                                    </template>
                                                                                    
                                                    <template x-if="Number(item.diskon) > 0">
                                                        <div
                                                            class="mt-0.5 text-xs text-red-500 print:text-red-600"
                                                            x-text="'Diskon: ' + formatRupiah(item.diskon)"
                                                        ></div>
                                                    </template>
                                                                                    
                                                </td>
                                                                                    
                                                <td
                                                    class="py-2.5 px-1 text-right whitespace-nowrap"
                                                    x-text="formatDesimal(item.harga)"
                                                ></td>
                                                                                    
                                                <td
                                                    class="py-2.5 px-1 text-center"
                                                    x-text="formatDesimal(item.qty)"
                                                ></td>
                                                                                    
                                                <td
                                                    class="py-2.5 pl-2 text-right font-bold whitespace-nowrap"
                                                    x-text="formatDesimal(item.total)"
                                                ></td>
                                                                                    
                                            </tr>
                                                                                    
                                        </template>

                                    </tbody>

                                </table>

                            </div>


                            <!-- SUMMARY -->

                            <div
                                class="pt-3 border-t border-dashed border-slate-200 dark:border-slate-800 space-y-1.5 text-xs sm:text-sm print:border-black print:pt-2 print:text-[10px]"
                            >

                                <div class="flex justify-between items-center">

                                    <span class="font-bold text-slate-600 dark:text-slate-400 print:text-black">
                                        Pembayaran :
                                    </span>

                                    <span
                                        class="font-bold text-slate-900 dark:text-white print:text-black"
                                        x-text="selectedData.pembayaran || '-'"
                                    ></span>

                                </div>


                                <div class="flex justify-between items-center">

                                    <span class="font-bold text-slate-600 dark:text-slate-400 print:text-black">
                                        Status :
                                    </span>

                                    <span
                                        class="font-bold text-slate-900 dark:text-white print:text-black"
                                        x-text="selectedData.status_pembayaran || '-'"
                                    ></span>

                                </div>


                                <div class="flex justify-between items-center">

                                    <span class="font-bold text-slate-600 dark:text-slate-400 print:text-black">
                                        Total Diskon :
                                    </span>

                                    <span
                                        class="font-bold text-slate-900 dark:text-white print:text-black"
                                        x-text="'Rp ' + Number(selectedData.total_diskon || 0).toLocaleString('id-ID')"
                                    ></span>

                                </div>


                                <div
                                    class="flex justify-between items-center text-sm sm:text-base py-1 font-black text-slate-900 dark:text-white border-y border-slate-100 dark:border-slate-800 print:border-none print:py-0.5 print:text-[11px] print:text-black"
                                >

                                    <span>
                                        Total Bayar :
                                    </span>

                                    <span
                                        class="text-blue-600 dark:text-blue-400 print:text-black"
                                        x-text="'Rp ' + Number(selectedData.total || 0).toLocaleString('id-ID')"
                                    ></span>

                                </div>


                                <div class="flex justify-between items-center">

                                    <span class="font-bold text-slate-600 dark:text-slate-400 print:text-black">
                                        Dibayar :
                                    </span>

                                    <span
                                        class="font-bold text-slate-900 dark:text-white print:text-black"
                                        x-text="'Rp ' + Number(selectedData.uang_diterima || 0).toLocaleString('id-ID')"
                                    ></span>

                                </div>


                                <div class="flex justify-between items-center">

                                    <span class="font-bold text-slate-600 dark:text-slate-400 print:text-black">
                                        Kembali :
                                    </span>

                                    <span
                                        class="font-bold text-slate-900 dark:text-white print:text-black"
                                        x-text="'Rp ' + Number(selectedData.kembalian || 0).toLocaleString('id-ID')"
                                    ></span>

                                </div>

                            </div>


                            <!-- FOOTER STRUK -->

                            <div
                                class="hidden print:block text-center mt-4 pt-2 border-t border-dashed border-black text-[9px]"
                            >

                                <p class="font-bold">
                                    *** TERIMA KASIH ***
                                </p>

                            </div>

                        </div>


                        <!-- FOOTER BUTTON -->

                        <div
                            class="flex justify-end gap-3 mt-8 pt-4 border-t border-slate-100 dark:border-slate-800 print:hidden"
                        >

                            <button
                                type="button"
                                @click="ViewRiwayatTransaksi = false"
                                class="px-6 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 font-bold text-sm transition-all active:scale-95 cursor-pointer"
                            >
                                Tutup
                            </button>

                            <template x-if="selectedData.is_hutang">
                                <button
                                    type="button"
                                    @click="showConfirmForm({
                                        title: 'Lunasi Transaksi',
                                        message: 'Apakah Anda yakin ingin melunasi transaksi ' + selectedData.kode_transaksi + '?',
                                        actionText: 'Ya, lunasi',
                                        type: 'success',
                                        nameAksi: 'bayar_hutang',
                                        inputs: [
                                            {
                                                name: 'aksi',
                                                type: 'hidden',
                                                value: 'bayar_hutang'
                                            },
                                            {
                                                name: 'id',
                                                type: 'hidden',
                                                value: selectedData.id_transaksi
                                            }
                                        ]
                                    });"
                                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-green-500 text-white text-sm font-bold hover:bg-green-600 active:scale-95 transition"
                                >
                                    <i class="bx bx-check-circle text-lg"></i>
                                    Lunasi
                                </button>
                            </template>

                            <button
                                type="button"
                                @click="printStruk()"
                                class="flex items-center gap-2 px-6 py-3 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm transition-all active:scale-95 cursor-pointer"
                            >

                                <i class="bx bx-printer text-lg"></i>

                                <span>
                                    Cetak Struk
                                </span>

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div
            id="strukPrint"
            class="hidden print:block"
        >
            <div class="struk">

                <div class="text-center">
                    <h1 class="font-bold text-lg">
                        <?= htmlspecialchars($p['nama_usaha'] ?? 'Nama Usaha') ?>
                    </h1>

                    <p>
                        <?= htmlspecialchars($p['alamat'] ?? '') ?>
                    </p>

                    <p>
                        <?= htmlspecialchars($p['telepon'] ?? '') ?>
                    </p>
                </div>

                <div class="border-t border-dashed border-black my-3"></div>

                <div class="text-sm">
                    <div class="flex justify-between">
                        <span>Transaksi</span>
                        <span x-text="selectedData.kode_transaksi"></span>
                    </div>

                    <div class="flex justify-between">
                        <span>Tanggal</span>
                        <span x-text="selectedData.tanggal"></span>
                    </div>

                    <div class="flex justify-between">
                        <span>Pelanggan</span>
                        <span x-text="selectedData.pelanggan || '-'"></span>
                    </div>

                    <div class="flex justify-between">
                        <span>Tipe</span>
                        <span x-text="formatTipePesanan(selectedData.tipe_pesanan)"></span>
                    </div>
                </div>

                <div class="border-t border-dashed border-black my-3"></div>

                <div class="space-y-2">

                    <template
                        x-for="item in selectedData.items"
                        :key="item.id_menu"
                    >
                        <div>

                            <div class="flex justify-between">
                                <span
                                    class="font-medium"
                                    x-text="item.nama_menu"
                                ></span>

                                <span
                                    x-text="formatRupiah(item.total)"
                                ></span>
                            </div>

                            <div class="text-xs">
                                <span
                                    x-text="formatRupiah(item.harga) + ' x ' + item.qty"
                                ></span>
                            </div>

                            <template x-if="item.diskon > 0">
                                <div class="text-xs">
                                    Diskon -
                                    <span x-text="formatRupiah(item.diskon)"></span>
                                </div>
                            </template>

                            <template x-if="item.catatan">
                                <div class="text-xs">
                                    Catatan:
                                    <span x-text="item.catatan"></span>
                                </div>
                            </template>

                        </div>
                    </template>

                </div>

                <div class="border-t border-dashed border-black my-3"></div>

                <div class="text-sm">

                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span x-text="formatRupiah(selectedData.subtotal)"></span>
                    </div>

                    <div class="flex justify-between">
                        <span>Diskon</span>
                        <span x-text="'-' + formatRupiah(selectedData.total_diskon)"></span>
                    </div>

                    <div class="flex justify-between font-bold text-base mt-1">
                        <span>Total</span>
                        <span x-text="formatRupiah(selectedData.total)"></span>
                    </div>

                    <div class="flex justify-between mt-2">
                        <span>Pembayaran</span>
                        <span x-text="selectedData.pembayaran"></span>
                    </div>

                    <template x-if="selectedData.pembayaran !== 'Hutang'">
                        <div class="flex justify-between">
                            <span>Dibayar</span>
                            <span x-text="formatRupiah(selectedData.uang_diterima)"></span>
                        </div>
                    </template>

                    <template x-if="selectedData.kembalian > 0">
                        <div class="flex justify-between">
                            <span>Kembalian</span>
                            <span x-text="formatRupiah(selectedData.kembalian)"></span>
                        </div>
                    </template>

                </div>

                <div class="border-t border-dashed border-black my-3"></div>

                <div class="text-center text-xs">
                    <p>Terima kasih atas kunjungan Anda.</p>
                </div>

            </div>
        </div>

    </div>

</section>
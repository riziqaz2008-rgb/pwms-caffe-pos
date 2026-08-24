<section id="Laporan">

    <div
        x-data="{
            FilterRiwayatTransaksi: false,
            ViewRiwayatTransaksi: false
        }"
        x-init="$watch('FilterRiwayatTransaksi', value => document.body.classList.toggle('overflow-hidden', value))"
    >

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-5">

            <div class="flex items-center gap-x-5">

                <div class="w-13 h-13 rounded-2xl bg-primary flex items-center justify-center shrink-0 border border-gray-200/80">

                    <i class="bx bxs-archive text-2xl text-white"></i>

                </div>

                <div>

                    <h1 class="text-2xl font-black text-slate-900">

                        Laporan Penjualan

                    </h1>

                    <p class="text-sm text-slate-500 font-medium mt-1.5">

                        Pantau dan analisis laporan penjualan serta transaksi cafe.

                    </p>

                </div>

            </div>

            <div class="flex flex-row gap-x-3 my-1 shrink-0">

                <button
                    type="button"
                    @click="FilterRiwayatTransaksi = true"
                    class="w-full h-12 md:w-auto flex items-center justify-center bg-primary text-white font-black px-6 gap-2 rounded-xl cursor-pointer hover:opacity-90 transition-opacity"
                >

                    <i class="bx bxs-filter text-lg"></i>

                    <span>

                        Filter

                    </span>

                </button>

            </div>

        </div>

        <div class="grid  grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mt-10 mb-8">

                    <div class="bg-white border-e border-gray-200/80 rounded-2xl p-6">

                <div class="flex items-center justify-between">

                    <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center">

                        <i class="bx bxs-chart-sine text-xl text-white"></i>

                    </div>

                    <span class="text-xs font-bold text-gray-400">

                        Pendapatan

                    </span>

                </div>

                <div class="mt-5">

                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">

                        Total Pendapatan

                    </p>

                    <h3 class="text-xl sm:text-2xl font-black text-gray-900 mt-1.5">

                        Rp 8.450.000

                    </h3>

                    <p class="text-xs text-gray-400 mt-1.5">

                        dari seluruh transaksi

                    </p>

                </div>

            </div>
            
            <div class="bg-white border-e border-gray-200/80 rounded-2xl p-6">

                <div class="flex items-center justify-between">

                    <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center">

                        <i class="bx bxs-receipt text-xl text-white"></i>

                    </div>

                    <span class="text-xs font-bold text-gray-400">

                        Transaksi

                    </span>

                </div>

                <div class="mt-5">

                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">

                        Total Transaksi

                    </p>

                    <h3 class="text-2xl font-black text-gray-900 mt-1.5">

                        128

                    </h3>

                    <p class="text-xs text-gray-400 mt-1.5">

                        transaksi periode ini

                    </p>

                </div>

            </div>

            <div class="bg-white rounded-2xl p-6 sm:col-span-2 lg:col-span-1">

                <div class="flex items-center justify-between">

                    <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center">

                        <i class="bx bxs-bowl-hot text-xl text-white"></i>

                    </div>

                    <span class="text-xs font-bold text-gray-400">

                        item

                    </span>

                </div>

                <div class="mt-5">

                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">

                        Total Menu Terjual

                    </p>

                    <h3 class="text-2xl font-black text-gray-900 mt-1.5">

                        356

                    </h3>

                    <p class="text-xs text-gray-400 mt-1.5">

                        total item terjual

                    </p>

                </div>

            </div>

        </div>

        <div class="my-6 bg-white border-t border-gray-200/80 p-5  dark:bg-slate-950 min-w-0">

    <!-- HEADER -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-6">

        <!-- JUDUL -->
        <div>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-5 rounded-full bg-primary"></div>

                <h2 class="text-sm font-black text-slate-800 dark:text-white">
                    Daftar Penjualan
                </h2>
            </div>

            <p class="text-xs text-gray-400 font-medium mt-1 ml-3.5">
                Riwayat transaksi penjualan cafe
            </p>
        </div>

        <!-- SEARCH -->
        <div class="relative w-full lg:w-96">

            <div
                class="
                    relative flex items-center gap-2
                    p-1.5
                    rounded-xl
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
                    <input
                        type="search"
                        class="
                            w-full
                            px-1 py-0.5
                            bg-transparent
                            text-slate-900 dark:text-slate-100
                            text-sm
                            placeholder:text-gray-400
                            focus:outline-none
                            font-medium
                        "
                        placeholder="Cari kode transaksi atau kasir..."
                    >
                </div>

            </div>

        </div>

    </div>


    <!-- TABLE -->
    <div class="overflow-y-auto overflow-x-auto p-1 max-h-[700px]">

        <div class="w-full overflow-x-auto rounded-2xl">

            <table
                id="selection-table"
                class="
                    w-full
                    min-w-[900px]
                    text-sm
                    border-separate
                    border-spacing-0
                "
            >

                <!-- HEADER TABLE -->
                <thead>

                    <tr class="bg-slate-50 dark:bg-slate-900">

                        <th
                            class="
                                text-left
                                font-bold
                                text-slate-500 dark:text-slate-400
                                px-5 py-4
                                rounded-tl-xl
                            "
                        >
                            #
                        </th>

                        <th
                            class="
                                text-left
                                font-bold
                                text-slate-500 dark:text-slate-400
                                px-5 py-4
                            "
                        >
                            Kode Transaksi
                        </th>

                        <th
                            class="
                                text-left
                                font-bold
                                text-slate-500 dark:text-slate-400
                                px-5 py-4
                            "
                        >
                            Tanggal
                        </th>

                        <th
                            class="
                                text-left
                                font-bold
                                text-slate-500 dark:text-slate-400
                                px-5 py-4
                            "
                        >
                            Kasir
                        </th>

                        <th
                            class="
                                text-left
                                font-bold
                                text-slate-500 dark:text-slate-400
                                px-5 py-4
                            "
                        >
                            Pembayaran
                        </th>

                        <th
                            class="
                                text-left
                                font-bold
                                text-slate-500 dark:text-slate-400
                                px-5 py-4
                            "
                        >
                            Total
                        </th>

                        <th
                            class="
                                text-center
                                font-bold
                                text-slate-500 dark:text-slate-400
                                px-5 py-4
                                rounded-tr-xl
                            "
                        >
                            Aksi
                        </th>

                    </tr>

                </thead>


                <!-- BODY -->
                <tbody>

                    <tr
                        class="
                            group
                            bg-white dark:bg-slate-950
                            hover:bg-slate-50 dark:hover:bg-slate-900
                            transition-colors duration-200
                        "
                    >

                        <!-- <td class="px-5 py-5 border-b border-slate-100 dark:border-slate-800">

                            <span class="text-sm font-semibold text-slate-400">
                                1
                            </span>

                        </td>

                        <td class="px-5 py-5 border-b border-slate-100 dark:border-slate-800">

                            <span
                                class="
                                    inline-flex
                                    items-center
                                    gap-2
                                    px-6 py-2
                                    rounded-lg
                                    bg-primary
                                    text-white
                                    text-xs
                                    font-bold
                                    whitespace-nowrap
                                "
                            >

                                #TRX001
                            </span>

                        </td>

                        <td class="px-5 py-5 border-b border-slate-100 dark:border-slate-800">

                            <span
                                class="
                                    text-sm
                                    font-semibold
                                    text-slate-700
                                    dark:text-slate-200
                                    whitespace-nowrap
                                "
                            >
                                18-08-2026
                            </span>

                        </td>

                        <td class="px-5 py-5 border-b border-slate-100 dark:border-slate-800">

                            <div class="flex items-center gap-2">

                                <span
                                    class="
                                        font-semibold
                                        text-slate-700
                                        dark:text-slate-200
                                    "
                                >
                                    Eko
                                </span>

                            </div>

                        </td>

                        <td class="px-5 py-5 border-b border-slate-100 dark:border-slate-800">

                            <span
                                class="
                                    inline-flex
                                    items-center
                                    gap-2
                                    px-3 py-1.5
                                    rounded-lg
                                    text-primary
                                    text-sm
                                    font-black
                                    whitespace-nowrap
                                "
                            >
                                <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>

                                Cash
                            </span>

                        </td>

                        <td class="px-5 py-5 border-b border-slate-100 dark:border-slate-800">

                            <span
                                class="
                                    font-bold
                                    text-slate-800
                                    dark:text-slate-200
                                    whitespace-nowrap
                                "
                            >
                                Rp 75.000
                            </span>

                        </td>

                        <td class="px-5 py-5 border-b border-slate-100 dark:border-slate-800">

                            <div class="flex justify-center items-center gap-2">

                                <button
                                    type="button"
                                    class="
                                        w-10 h-10
                                        flex items-center justify-center
                                        rounded-xl
                                        bg-primary
                                        text-white
                                        hover:opacity-90
                                        active:scale-95
                                        transition
                                    "
                                    title="Lihat Detail"
                                    @click="ViewRiwayatTransaksi = true"
                                >
                                    <i class="bx bxs-eye text-lg"></i>
                                </button>

                                <button
                                    type="button"
                                    class="
                                        w-10 h-10
                                        flex items-center justify-center
                                        rounded-xl
                                        bg-red-500
                                        text-white
                                        hover:opacity-90
                                        active:scale-95
                                        transition
                                    "
                                    title="Hapus Penjualan"
                                >
                                    <i class="bx bxs-trash text-lg"></i>
                                </button>

                            </div>

                        </td> -->

                        <td colspan="7">
                                <div class="flex flex-col items-center justify-center py-12 px-4 text-center bg-gray-50">
                                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-gray-200/80">
                                        <i class="bx bx-credit-card text-4xl text-gray-300"></i>
                                    </div>
                                    <h3 class="text-base font-black text-slate-800 mb-1">Riwayat Transaksi Belum Tersedia</h3>
                                    <p class="text-xs text-gray-400 max-w-sm mb-5">
                                        Belum ada data transaksi yang ditambahkan atau hasil pencarian tidak cocok.
                                    </p>
                                    <button type="button"  @click="TambahMetode = true" class="px-4 py-3 bg-primary text-white text-sm font-bold rounded-xl hover:opacity-90 transition-all flex items-center gap-2">
                                        <i class="bx bxs-plus text-base"></i>
                                        <span>Tambah Transaksi</span>
                                    </button>
                                </div>
                            </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

      <div x-init="$watch('FilterRiwayatTransaksi', value => document.body.classList.toggle('overflow-hidden', value))">

    <div
        x-show="FilterRiwayatTransaksi"
        x-cloak
        @keydown.escape.window="FilterRiwayatTransaksi = false"
        class="fixed inset-0 z-[999] flex justify-center items-center w-full p-4 sm:p-6 overflow-y-auto"
    >

        <!-- Backdrop -->
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

        <!-- Modal Panel -->
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

            <div class="relative bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-2xl p-5 sm:p-8 shadow-xl max-h-[calc(100vh-2rem)] overflow-y-auto">

                <!-- Header Modal -->
                <div class="mb-6 sm:mb-8 flex justify-between items-start sm:items-center gap-4">

                    <div class="flex items-center gap-3 sm:gap-4">

                        <div class="flex w-12 h-12 rounded-2xl bg-primary items-center justify-center shrink-0">
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

                <!-- Form Content -->
                <form action="" method="GET" class="w-full">

                    <div class="grid grid-cols-1 gap-5">

                        <!-- Filter Pembayaran -->
                        <div class="flex flex-col gap-1.5 w-full">

                            <label class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">
                                Metode Pembayaran
                            </label>

                            <div class="relative flex items-center w-full group">

                                <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200">
                                    <i class="bx bxs-credit-card text-xl sm:text-lg"></i>
                                </div>

                                <select
                                    name="pembayaran"
                                    class="w-full pl-10 sm:pl-11 pr-10 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-xl sm:rounded-2xl border-2 border-gray-200/80 dark:border-slate-700 focus:outline-none focus:ring focus:ring-primary focus:border-primary appearance-none transition-all cursor-pointer"
                                >
                                    <option value="">Semua Pembayaran</option>
                                    <option value="cash">Cash / Tunai</option>
                                    <option value="qris">QRIS</option>
                                    <option value="transfer">Transfer Bank</option>
                                    <option value="debit">Kartu Debit</option>
                                </select>

                                <div class="absolute right-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200">
                                    <i class="bx bxs-chevron-down text-lg"></i>
                                </div>

                            </div>

                        </div>

                        <!-- Filter Kategori -->
                        <div class="flex flex-col gap-1.5 w-full">

                            <label class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">
                                Kategori
                            </label>

                            <div class="relative flex items-center w-full group">

                                <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200">
                                    <i class="bx bxs-layers-alt text-xl sm:text-lg"></i>
                                </div>

                                <select
                                    name="kategori"
                                    class="w-full pl-10 sm:pl-11 pr-10 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-xl sm:rounded-2xl border-2 border-gray-200/80 dark:border-slate-700 focus:outline-none focus:ring focus:ring-primary focus:border-primary appearance-none transition-all cursor-pointer"
                                >
                                    <option value="">Semua Kategori</option>
                                    <option value="makanan">Makanan</option>
                                    <option value="minuman">Minuman</option>
                                    <option value="snack">Snack</option>
                                    <option value="dessert">Dessert</option>
                                </select>

                                <div class="absolute right-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200">
                                    <i class="bx bxs-chevron-down text-lg"></i>
                                </div>

                            </div>

                        </div>

                        <!-- Filter Rentang Tanggal -->
                        <div class="flex flex-col gap-1.5 w-full">

                            <label class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">
                                Rentang Tanggal
                            </label>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">

                                <!-- Tanggal Mulai -->
                                <div class="relative flex items-center w-full group">
                                    <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200">
                                        <i class="bx bxs-calendar text-xl sm:text-lg"></i>
                                    </div>
                                    <input
                                        type="date"
                                        name="tanggal_mulai"
                                        class="w-full pl-10 sm:pl-11 pr-3 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-xl sm:rounded-2xl border-2 border-gray-200/80 dark:border-slate-700 focus:outline-none focus:ring focus:ring-primary focus:border-primary transition-all cursor-pointer"
                                    >
                                </div>

                                <!-- Tanggal Sampai -->
                                <div class="relative flex items-center w-full group">
                                    <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200">
                                        <i class="bx bxs-calendar text-xl sm:text-lg"></i>
                                    </div>
                                    <input
                                        type="date"
                                        name="tanggal_sampai"
                                        class="w-full pl-10 sm:pl-11 pr-3 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-xl sm:rounded-2xl border-2 border-gray-200/80 dark:border-slate-700 focus:outline-none focus:ring focus:ring-primary focus:border-primary transition-all cursor-pointer"
                                    >
                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Footer / Buttons -->
                    <div class="w-full flex flex-col-reverse sm:flex-row justify-end mt-6 sm:mt-8 pt-5 border-t border-gray-100 dark:border-slate-800 gap-3 sm:gap-3">

                        <button
                            type="button"
                            @click="FilterRiwayatTransaksi = false"
                            class="w-full sm:w-auto flex items-center justify-center bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-bold px-6 py-3 gap-2 rounded-xl sm:rounded-2xl cursor-pointer transition-all active:scale-95"
                        >
                            <span>Batal</span>
                        </button>

                        <button
                            type="submit"
                            @click="FilterRiwayatTransaksi = false"
                            class="w-full sm:w-auto flex items-center justify-center bg-primary hover:bg-primary/90 text-white font-black px-6 py-3 gap-2 rounded-xl sm:rounded-2xl cursor-pointer transition-all active:scale-95"
                        >
                            <i class="bx bxs-filter-alt text-lg"></i>
                            <span>Terapkan Filter</span>
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

        <!-- =====================================================
     MODAL DETAIL RIWAYAT TRANSAKSI
====================================================== -->

<div
    x-show="ViewRiwayatTransaksi"
    x-cloak
    @keydown.escape.window="ViewRiwayatTransaksi = false"
    class="fixed inset-0 z-999 flex justify-center items-start sm:items-center w-full p-3 sm:p-4 overflow-y-auto"
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
        class="fixed inset-0 bg-slate-950/60 backdrop-blur-[2px]"
        @click="ViewRiwayatTransaksi = false"
    ></div>


    <!-- MODAL -->
    <div
        x-show="ViewRiwayatTransaksi"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 scale-95 translate-y-2"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-2"
        class="relative p-0 sm:p-4 w-full max-w-2xl max-h-full z-10 my-auto"
    >

        <div
            class="
                relative
                bg-white dark:bg-slate-900
                border border-gray-200 dark:border-slate-800
                rounded-2xl
                border border-gray-200/80
                p-5 md:p-7 md:px-8
                max-h-[calc(100vh-1.5rem)]
                sm:max-h-[calc(100vh-2rem)]
                overflow-y-auto
            "
        >

            <!-- HEADER -->
            <div class="flex justify-between items-start gap-4 mb-7">

                <div class="flex items-center gap-4 min-w-0">

                    <div
                        class="
                            flex
                            w-13 h-13
                            rounded-2xl
                            bg-primary
                            items-center justify-center
                            shrink-0
                            border border-gray-200/80
                        "
                    >
                        <i class="bx bxs-receipt text-2xl text-white"></i>
                    </div>

                    <div class="min-w-0">

                        <h1 class="text-black dark:text-white font-black text-2xl">
                            Detail Transaksi
                        </h1>

                        <p class="text-sm text-gray-500 font-medium mt-1">
                            Informasi lengkap transaksi penjualan.
                        </p>

                    </div>

                </div>


                <button
                    type="button"
                    @click="ViewRiwayatTransaksi = false"
                    class="
                        flex items-center justify-center
                        w-11 h-11
                        rounded-full
                        bg-slate-100
                        text-slate-500
                        hover:text-white
                        font-black
                        cursor-pointer
                        hover:bg-blue-700
                        transition
                        shrink-0
                    "
                >
                    <span>X</span>
                </button>

            </div>


            <!-- KODE TRANSAKSI -->
            <div
                class="
                    flex flex-col sm:flex-row
                    sm:items-center
                    justify-between
                    gap-3
                    p-4
                    rounded-2xl
                    bg-slate-50
                    dark:bg-slate-800
                "
            >

                <div>

                    <p class="text-xs font-bold uppercase tracking-wide text-slate-400">
                        Kode Transaksi
                    </p>

                    <p class="text-base font-black text-slate-800 dark:text-white mt-1">
                        #TRX001
                    </p>

                </div>


                <span
                    class="
                        inline-flex items-center
                        gap-2
                        w-fit
                        px-3 py-1.5
                        rounded-lg
                        bg-primary
                        text-white
                        text-xs
                        font-bold
                    "
                >
                    <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                    Selesai
                </span>

            </div>


            <!-- INFORMASI TRANSAKSI -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-5">

                <div class="p-4 rounded-2xl border border-slate-200 dark:border-slate-700">

                    <div class="flex items-center gap-3">

                        <div
                            class="
                                w-10 h-10
                                rounded-xl
                                bg-primary
                                flex items-center justify-center
                                shrink-0
                            "
                        >
                            <i class="bx bxs-calendar text-lg text-white"></i>
                        </div>

                        <div>

                            <p class="text-xs font-bold text-slate-400 uppercase">
                                Tanggal
                            </p>

                            <p class="text-sm font-bold text-slate-800 dark:text-white mt-1">
                                18-08-2026
                            </p>

                        </div>

                    </div>

                </div>


                <div class="p-4 rounded-2xl border border-slate-200 dark:border-slate-700">

                    <div class="flex items-center gap-3">

                        <div
                            class="
                                w-10 h-10
                                rounded-xl
                                bg-primary
                                flex items-center justify-center
                                shrink-0
                            "
                        >
                            <i class="bx bxs-user text-lg text-white"></i>
                        </div>

                        <div>

                            <p class="text-xs font-bold text-slate-400 uppercase">
                                Kasir
                            </p>

                            <p class="text-sm font-bold text-slate-800 dark:text-white mt-1">
                                Eko
                            </p>

                        </div>

                    </div>

                </div>


                <div class="p-4 rounded-2xl border border-slate-200 dark:border-slate-700">

                    <div class="flex items-center gap-3">

                        <div
                            class="
                                w-10 h-10
                                rounded-xl
                                bg-primary
                                flex items-center justify-center
                                shrink-0
                            "
                        >
                            <i class="bx bxs-credit-card text-lg text-white"></i>
                        </div>

                        <div>

                            <p class="text-xs font-bold text-slate-400 uppercase">
                                Pembayaran
                            </p>

                            <p class="text-sm font-bold text-slate-800 dark:text-white mt-1">
                                Cash
                            </p>

                        </div>

                    </div>

                </div>


                <div class="p-4 rounded-2xl border border-slate-200 dark:border-slate-700">

                    <div class="flex items-center gap-3">

                        <div
                            class="
                                w-10 h-10
                                rounded-xl
                                bg-primary
                                flex items-center justify-center
                                shrink-0
                            "
                        >
                            <i class="bx bxs-clock text-lg text-white"></i>
                        </div>

                        <div>

                            <p class="text-xs font-bold text-slate-400 uppercase">
                                Waktu
                            </p>

                            <p class="text-sm font-bold text-slate-800 dark:text-white mt-1">
                                14:35 
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            <!-- DAFTAR PESANAN -->
            <div class="mt-6">

                <div class="flex items-center gap-2 mb-3">

                    <div class="w-1.5 h-5 rounded-full bg-primary"></div>

                    <h2 class="text-sm font-black text-slate-800 dark:text-white">
                        Detail Pesanan
                    </h2>

                </div>


                <div
                    class="
                        rounded-2xl
                        border border-slate-200
                        dark:border-slate-700
                        overflow-hidden
                    "
                >

                    <!-- ITEM 1 -->
                    <div
                        class="
                            flex items-center justify-between
                            gap-4
                            p-4
                            border-b border-slate-100
                            dark:border-slate-800
                        "
                    >

                        <div class="min-w-0">

                            <p class="text-sm font-bold text-slate-800 dark:text-white">
                                Nasi Goreng
                            </p>

                            <p class="text-xs text-slate-400 mt-1">
                                2 × Rp 25.000
                            </p>

                        </div>

                        <span class="text-sm font-black text-slate-800 dark:text-white whitespace-nowrap">
                            Rp 50.000
                        </span>

                    </div>


                    <!-- ITEM 2 -->
                    <div
                        class="
                            flex items-center justify-between
                            gap-4
                            p-4
                        "
                    >

                        <div class="min-w-0">

                            <p class="text-sm font-bold text-slate-800 dark:text-white">
                                Es Teh
                            </p>

                            <p class="text-xs text-slate-400 mt-1">
                                1 × Rp 25.000
                            </p>

                        </div>

                        <span class="text-sm font-black text-slate-800 dark:text-white whitespace-nowrap">
                            Rp 25.000
                        </span>

                    </div>

                </div>

            </div>


            <!-- TOTAL -->
            <div
                class="
                    flex items-center justify-between
                    gap-4
                    mt-5
                    p-5
                    rounded-2xl
                    bg-primary
                    text-white
                "
            >

                <div>

                    <p class="text-xs font-bold uppercase tracking-wide text-white">
                        Total Pembayaran
                    </p>

                    <p class="text-xs text-white mt-1">
                        3 item
                    </p>

                </div>

                <span class="text-xl font-black whitespace-nowrap">
                    Rp 75.000
                </span>

            </div>


            <!-- FOOTER -->
            <div
                class="
                    flex flex-col-reverse sm:flex-row
                    sm:justify-end
                    gap-3
                    mt-6
                    pt-5
                    border-t border-slate-100
                    dark:border-slate-800
                "
            >

                <button
                    type="button"
                    @click="ViewRiwayatTransaksi = false"
                    class="
                        h-11
                        px-6
                        rounded-xl
                        bg-gray-100
                        dark:bg-slate-800
                        text-slate-600
                        dark:text-slate-300
                        text-sm
                        font-bold
                        hover:bg-gray-200
                        dark:hover:bg-slate-700
                        transition
                    "
                >
                    Tutup
                </button>

            </div>

        </div>

    </div>

</div>

    </div>

</section>
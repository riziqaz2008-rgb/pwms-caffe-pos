<section id="MetodeTransaksi">

    <div
        x-data="{
            layoutModeToggle: $persist(true),
            filterToggle: $persist(true),
            TambahMetode: false,
            FilterMetode: false
        }"
    >
 <?php $layoutMode = $_GET['layoutMode'] ?? 'table'; ?>
        <!-- HEADER SECTION (Tombol Tambah & Filter dipindah ke Kanan Atas) -->
        <div class="bg-white dark:bg-slate-900 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 dark:border-slate-800 gap-4">
                <div class="flex items-center gap-4 min-w-0">
                    <div class="hidden sm:flex w-13 h-13 rounded-2xl bg-primary border border-indigo-100/80 items-center justify-center shrink-0 border border-gray-200/80">
                        <i class="bx bxs-credit-card text-2xl text-white"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="flex items-center gap-3 flex-wrap">
                            <h1 class="text-black dark:text-white font-black text-2xl">
                                Metode Transaksi
                            </h1>
                        </div>
                        <p class="text-sm text-gray-500 font-medium mt-1">
                            Kelola metode pembayaran yang tersedia pada transaksi cafe.
                        </p>
                    </div>
                </div>

                <!-- TOMBOL AKSI DI KANAN ATAS -->
                <div class="flex items-center gap-2 shrink-0">
                    <button
                        type="button"
                        @click="FilterMetode = true"
                        class="h-12 flex items-center justify-center gap-2 px-5 rounded-xl text-sm font-bold border border-slate-300 text-slate-700 bg-white dark:bg-slate-800 dark:border-slate-700 dark:text-slate-200 hover:bg-slate-50 transition-all duration-200"
                    >
                        <i class="bx bxs-filter text-xl"></i>
                        <span>Filter</span>
                    </button>

                    <button
                        type="button"
                        @click="TambahMetode = true"
                        class="h-12 flex items-center justify-center bg-primary text-white font-black px-5 gap-2 rounded-xl cursor-pointer border border-gray-200/80 hover:opacity-90 active:scale-95 transition-all duration-200"
                    >
                        <i class="bx bxs-plus text-lg"></i>
                        <span>Tambah</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- STATS BAR: Dipindah ke atas dalam bentuk Grid Horizontal -->
      <!-- STATS BAR: Variatif 3 Kolom dengan Warna & Aksen Berbeda -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-7">
            
            <!-- Card 1: Total Metode Tersedia -->
            <div class="relative bg-white dark:bg-slate-900 border-e border-gray-200/80 dark:border-slate-700 rounded-2xl p-3 flex items-center justify-between overflow-hidden group transition-all duration-300">
                <div>
                    <p class="text-[10px] uppercase tracking-wider font-black text-gray-400">Total Tersedia</p>
                    <div class="flex items-end gap-2 mt-1">
                        <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white leading-none">0</h2>
                        <span class="text-xs font-bold text-gray-400">metode</span>
                    </div>
                </div>
                <div class="flex items-center justify-center w-12 h-12 rounded-2xl bg-primary text-white group-hover:scale-110 transition-transform duration-300 shrink-0">
                    <i class="bx bxs-credit-card text-2xl"></i>
                </div>
            </div>

            <!-- Card 2: Metode Aktif -->
            <div class="relative bg-white dark:bg-slate-900 border-e border-gray-200/80 dark:border-slate-700 rounded-2xl p-3 flex items-center justify-between overflow-hidden group transition-all duration-300">
                <div>
                    <p class="text-[10px] uppercase tracking-wider font-black text-gray-400">Metode Aktif</p>
                    <div class="flex items-end gap-2 mt-1">
                        <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white leading-none">0</h2>
                        <span class="text-xs font-bold text-gray-400">aktif</span>
                    </div>
                </div>
                <div class="flex items-center justify-center w-12 h-12 rounded-2xl bg-primary text-white dark:text-emerald-400 group-hover:scale-110 transition-transform duration-300 shrink-0">
                    <i class="bx bx-check-circle text-2xl"></i>
                </div>
            </div>

            <!-- Card 3: Metode Nonaktif -->
            <div class="relative bg-white dark:bg-slate-900  dark:border-slate-700 rounded-2xl p-5 flex items-center justify-between overflow-hidden group transition-all duration-300 col-span-full lg:col-span-1">
                <div>
                    <p class="text-[10px] uppercase tracking-wider font-black text-gray-400">Metode Nonaktif</p>
                    <div class="flex items-end gap-2 mt-1">
                        <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white leading-none">0</h2>
                        <span class="text-xs font-bold text-gray-400">nonaktif</span>
                    </div>
                </div>
                <div class="flex items-center justify-center w-12 h-12 rounded-2xl bg-primary text-white dark:text-amber-400 group-hover:scale-110 transition-transform duration-300 shrink-0">
                    <i class="bx bx-block text-2xl"></i>
                </div>
            </div>

        </div>

       <div class="rounded-2xl p-5 my-6 bg-white dark:bg-slate-950">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-5">

        <!-- JUDUL KIRI -->
        <div class="min-w-0">
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-5 rounded-full bg-primary"></div>
                <h2 class="text-xl font-black text-slate-800 dark:text-white">
                    Daftar Metode Transaksi
                </h2>
            </div>

            <p class="text-xs font-medium text-slate-400 mt-1 ml-3.5">
                Kelola kategori menu yang tersedia di KedaiKu.
            </p>
        </div>


        <!-- SEARCH + LAYOUT KANAN -->
        <div class="flex items-center gap-3 w-full sm:w-auto">

            <!-- SEARCH -->
            <form action="" method="GET" class="flex-1 sm:w-[280px]">
                <div class="relative flex items-center gap-2 p-1.5 rounded-xl border-2 border-gray-200/80 dark:border-slate-700 bg-white dark:bg-slate-800 focus-within:ring-2 focus-within:ring-primary transition-all min-h-[48px]">
                    <div class="flex items-center text-gray-400 pl-2 shrink-0">
                        <i class="bx bx-search text-lg"></i>
                    </div>

                    <input
                        name="search"
                        type="search"
                        id="search-dropdown"
                        oninput="doLiveSearch(this.value)"
                        class="flex-1 px-1 py-1 bg-transparent text-slate-900 dark:text-slate-100 text-sm placeholder:text-gray-400 focus:outline-none font-medium min-w-0"
                        placeholder="Cari kategori..."
                    >
                </div>
            </form>


            <!-- LAYOUT SWITCHER -->
            <div class="flex items-center gap-1 p-1.5 rounded-xl border-2 border-gray-200/80 dark:border-slate-700 bg-white dark:bg-slate-800 shrink-0 min-h-[48px]">
                <a
                    href="?route=transaksi&layoutMode=table"
                    class="flex items-center justify-center w-9 h-9 rounded-lg text-lg transition-colors <?= $layoutMode == 'table' ? 'bg-primary text-white font-bold shadow-sm' : 'text-slate-400 hover:text-slate-600 dark:hover:text-slate-200' ?>"
                    title="Tampilan Tabel"
                >
                    <i class="bx bxs-rows"></i>
                </a>

                <a
                    href="?route=transaksi&layoutMode=grid"
                    class="flex items-center justify-center w-9 h-9 rounded-lg text-lg transition-colors <?= $layoutMode == 'grid' ? 'bg-primary text-white font-bold shadow-sm' : 'text-slate-400 hover:text-slate-600 dark:hover:text-slate-200' ?>"
                    title="Tampilan Grid"
                >
                    <i class="bx bxs-grid"></i>
                </a>
            </div>

        </div>

    </div>


    <!-- CONTENT -->
    <div class="overflow-y-auto p-1 max-h-[700px]">

        <?php if ($layoutMode == 'table'): ?>

            <div class="overflow-hidden">
                <table id="selection-table" class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-900 text-gray-400">
                            <th class="text-left font-bold px-5 py-4">#</th>
                            <th class="text-left font-bold px-5 py-4">Nama Metode Transaksi</th>
                            <th class="text-left font-bold px-5 py-4">Deskripsi</th>
                            <th class="text-left font-bold px-5 py-4">Status</th>
                            <th class="text-center font-bold px-5 py-4">Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="body-tabel-kategori">
                        <tr>
                            <td colspan="5">
                                <div class="flex flex-col items-center justify-center py-12 px-4 text-center bg-gray-50">
                                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-gray-200/80">
                                        <i class="bx bx-credit-card text-4xl text-gray-300"></i>
                                    </div>
                                    <h3 class="text-base font-black text-slate-800 mb-1">Kategori Belum Tersedia</h3>
                                    <p class="text-xs text-gray-400 max-w-sm mb-5">
                                        Belum ada data kategori yang ditambahkan atau hasil pencarian tidak cocok.
                                    </p>
                                    <button type="button"  @click="TambahMetode = true" class="px-4 py-3 bg-primary text-white text-sm font-bold rounded-xl hover:opacity-90 transition-all flex items-center gap-2">
                                        <i class="bx bxs-plus text-base"></i>
                                        <span>Tambah Metode</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        <?php elseif ($layoutMode == 'grid'): ?>

               <div class="flex flex-col items-center justify-center py-12 px-4 text-center">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-gray-200/80">
                        <i class="bx bx-credit-card text-4xl text-gray-300"></i>
                    </div>
                    <h3 class="text-base font-black text-slate-800 mb-1">Kategori Belum Tersedia</h3>
                    <p class="text-xs text-gray-400 max-w-sm mb-5">
                        Belum ada data kategori yang ditambahkan atau hasil pencarian tidak cocok.
                    </p>
                    <button type="button"  @click="TambahMetode = true" class="px-4 py-3 bg-primary text-white text-sm font-bold rounded-xl hover:opacity-90 transition-all flex items-center gap-2">
                        <i class="bx bxs-plus text-base"></i>
                        <span>Tambah Metode</span>
                    </button>
                </div>

        <?php endif; ?>

    </div>


    <!-- PAGINATION -->
    <div class="w-full flex justify-center mt-6">
        <nav aria-label="Pagination">
            <ul class="inline-flex items-center gap-1.5 p-1.5 rounded-xl border-2 border-gray-200/80 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm font-medium">
                
                <!-- Prev Button -->
                <li>
                    <a
                        href="?page=1"
                        class="flex items-center justify-center px-3.5 h-9 rounded-lg text-slate-400 dark:text-slate-500 opacity-50 cursor-not-allowed pointer-events-none"
                    >
                        Previous
                    </a>
                </li>

                <!-- Page 1 (Active) -->
                <li>
                    <a
                        href="?page=1"
                        class="flex items-center justify-center w-9 h-9 rounded-lg bg-primary text-white font-bold shadow-sm"
                    >
                        1
                    </a>
                </li>

                <!-- Page 2 (Inactive Example) -->
                <li>
                    <a
                        href="?page=2"
                        class="flex items-center justify-center w-9 h-9 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors"
                    >
                        2
                    </a>
                </li>

                <!-- Next Button -->
                <li>
                    <a
                        href="?page=2"
                        class="flex items-center justify-center px-3.5 h-9 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors"
                    >
                        Next
                    </a>
                </li>

            </ul>
        </nav>
    </div>

</div>

        <!-- MODAL TAMBAH METODE -->
     <div x-init="$watch('TambahMetode', value => document.body.classList.toggle('overflow-hidden', value))">

    <div
        x-show="TambahMetode"
        x-cloak
        @keydown.escape.window="TambahMetode = false"
        class="fixed inset-0 z-[999] flex justify-center items-center w-full p-4 sm:p-6 overflow-y-auto"
    >

        <!-- Backdrop -->
        <div
            x-show="TambahMetode"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-slate-950/60 backdrop-blur-[2px]"
            @click="TambahMetode = false"
        ></div>

        <!-- Modal Panel -->
        <div
            x-show="TambahMetode"
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
                            <i class="bx bxs-credit-card text-2xl text-white"></i>
                        </div>

                        <div>
                            <h1 class="text-slate-900 dark:text-white font-black text-xl sm:text-2xl leading-tight">
                                Tambah Metode Pembayaran
                            </h1>
                            <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 font-medium mt-1">
                                Tambahkan metode pembayaran baru untuk transaksi cafe.
                            </p>
                        </div>

                    </div>

                    <button 
                        type="button"
                        @click="TambahMetode = false"
                        class="flex items-center justify-center w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 hover:text-white dark:hover:text-white hover:bg-primary dark:hover:bg-primary font-black cursor-pointer transition-colors shrink-0"
                        title="Tutup"
                    >
                        <i class="bx bxs-x text-2xl"></i>
                    </button>

                </div>

                <!-- Form Content -->
                <form action="" method="POST" class="w-full">

                    <div class="grid grid-cols-1 gap-5">

                        <!-- Nama Metode -->
                        <div class="flex flex-col gap-1.5 w-full">

                            <label for="namaMetode" class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">
                                Nama Metode <span class="text-red-500">*</span>
                            </label>

                            <div class="relative flex items-center w-full group">

                                <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200">
                                    <i class="bx bxs-credit-card text-xl sm:text-lg"></i>
                                </div>

                                <input
                                    type="text"
                                    name="namaMetode"
                                    id="namaMetode"
                                    placeholder="Contoh: QRIS, Cash, Transfer Bank"
                                    autocomplete="off"
                                    class="w-full pl-10 sm:pl-11 pr-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-xl sm:rounded-2xl border-2 border-gray-200/80 dark:border-slate-700 focus:outline-none focus:ring focus:ring-primary focus:border-primary transition-all"
                                    required
                                >

                            </div>

                        </div>

                        <!-- Deskripsi -->
                        <div class="flex flex-col gap-1.5 w-full">

                            <label for="deskripsiMetode" class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">
                                Deskripsi
                            </label>

                            <div class="relative flex w-full group">

                                <div class="absolute left-3.5 top-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200">
                                    <i class="bx bxs-info-octagon text-xl sm:text-lg"></i>
                                </div>

                                <textarea
                                    name="deskripsiMetode"
                                    id="deskripsiMetode"
                                    rows="3"
                                    placeholder="Jelaskan penggunaan metode pembayaran ini..."
                                    class="w-full pl-10 sm:pl-11 pr-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-xl sm:rounded-2xl border-2 border-gray-200/80 dark:border-slate-700 focus:outline-none focus:ring focus:ring-primary focus:border-primary resize-y transition-all"
                                ></textarea>

                            </div>

                        </div>

                    </div>

                    <!-- Footer / Buttons -->
                    <div class="w-full flex flex-col-reverse sm:flex-row justify-end mt-6 sm:mt-8 pt-5 border-t border-gray-100 dark:border-slate-800 gap-3 sm:gap-3">

                        <button
                            type="button"
                            @click="TambahMetode = false"
                            class="w-full sm:w-auto flex items-center justify-center bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-bold px-6 py-3 gap-2 rounded-xl sm:rounded-2xl cursor-pointer transition-all active:scale-95"
                        >
                            <span>Batal</span>
                        </button>

                        <button
                            type="submit"
                            class="w-full sm:w-auto flex items-center justify-center bg-primary hover:bg-primary/90 text-white font-black px-6 py-3 gap-2 rounded-xl sm:rounded-2xl cursor-pointer transition-all active:scale-95"
                        >
                            <i class="bx bxs-save text-lg"></i>
                            <span>Simpan Metode</span>
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

        <!-- MODAL FILTER METODE -->
<div x-init="$watch('FilterMetode', value => document.body.classList.toggle('overflow-hidden', value))">

    <div
        x-show="FilterMetode"
        x-cloak
        @keydown.escape.window="FilterMetode = false"
        class="fixed inset-0 z-[999] flex justify-center items-center w-full p-4 sm:p-6 overflow-y-auto"
    >

        <!-- Backdrop -->
        <div
            x-show="FilterMetode"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-slate-950/60 backdrop-blur-[2px]"
            @click="FilterMetode = false"
        ></div>

        <!-- Modal Panel -->
        <div
            x-show="FilterMetode"
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
                            <div class="flex items-center gap-2">
                                <h1 class="text-slate-900 dark:text-white font-black text-xl sm:text-2xl leading-tight">
                                    Filter Metode
                                </h1>
                            </div>
                            <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 font-medium mt-1">
                                Atur tampilan fitur metode pembayaran.
                            </p>
                        </div>

                    </div>

                    <button 
                        type="button"
                        @click="FilterMetode = false"
                        class="flex items-center justify-center w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 hover:text-white dark:hover:text-white hover:bg-primary dark:hover:bg-primary font-black cursor-pointer transition-colors shrink-0"
                        title="Tutup"
                    >
                        <i class="bx bxs-x text-2xl"></i>
                    </button>

                </div>

                <!-- Form Content -->
                <form action="" method="GET" class="w-full">

                    <div class="grid grid-cols-1 gap-5">

                        <!-- Filter: Status Metode -->
                        <div class="flex flex-col gap-1.5 w-full">

                            <label class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">
                                Status Metode
                            </label>

                            <div class="grid grid-cols-2 gap-3">
                                <label class="cursor-pointer">
                                    <input type="radio" name="status" value="aktif" class="peer hidden">
                                    <div class="flex items-center justify-center bg-white dark:bg-slate-800 text-gray-600 dark:text-gray-300 font-bold px-4 py-3 rounded-xl sm:rounded-2xl border-2 border-gray-200/80 dark:border-slate-700 peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:text-primary transition-all text-sm active:scale-95">
                                        Aktif
                                    </div>
                                </label>

                                <label class="cursor-pointer">
                                    <input type="radio" name="status" value="nonaktif" class="peer hidden">
                                    <div class="flex items-center justify-center bg-white dark:bg-slate-800 text-gray-600 dark:text-gray-300 font-bold px-4 py-3 rounded-xl sm:rounded-2xl border-2 border-gray-200/80 dark:border-slate-700 peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:text-primary transition-all text-sm active:scale-95">
                                        Nonaktif
                                    </div>
                                </label>
                            </div>

                        </div>

                        <!-- Filter: Penggunaan -->
                        <div class="flex flex-col gap-1.5 w-full">

                            <label for="penggunaan" class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">
                                Penggunaan
                            </label>

                            <div class="relative flex items-center w-full group">

                                <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200">
                                    <i class="bx bxs-layers-alt text-xl"></i>
                                </div>

                                <select
                                    name="penggunaan"
                                    id="penggunaan"
                                    class="w-full pl-10 sm:pl-11 pr-10 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-xl sm:rounded-2xl border-2 border-gray-200/80 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-primary transition-all appearance-none cursor-pointer"
                                >
                                    <option value="">Semua Penggunaan</option>
                                    <option value="terbanyak">Paling Banyak Digunakan</option>
                                    <option value="tersedikit">Paling Sedikit Digunakan</option>
                                </select>

                                <div class="absolute right-3.5 flex items-center pointer-events-none text-gray-400">
                                    <i class="bx bxs-chevron-down text-xl"></i>
                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Footer / Buttons -->
                    <div class="w-full flex flex-col-reverse sm:flex-row justify-end mt-6 sm:mt-8 pt-5 border-t border-gray-100 dark:border-slate-800 gap-3 sm:gap-3">

                        <button
                            type="reset"
                            class="w-full sm:w-auto flex items-center justify-center bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-bold px-6 py-3 gap-2 rounded-xl sm:rounded-2xl cursor-pointer transition-all active:scale-95"
                        >
                            <span>Reset Filter</span>
                        </button>

                        <button
                            type="submit"
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

    </div>

</section>
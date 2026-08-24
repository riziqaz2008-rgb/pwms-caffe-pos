<section id="Menu" x-data="{ 
            layoutModeToggle: $persist(true), 
            filterToggle: $persist(true), 
            TambahMenu: false, 
            FilterMenu: false, 
            filterOpen: false 
        }">

    <div class="w-full" >
  <?php $layoutMode = $_GET['layoutMode'] ?? 'table'; ?>
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-start justify-between gap-5">

            <div class="flex items-center gap-4 min-w-0">

                <div
                    class="w-13 h-13 rounded-2xl bg-primary border-y border-indigo-100 flex items-center justify-center shrink-0">
                    <i class="bx bxs-bowl-noodles text-2xl text-white"></i>
                </div>

                <div class="min-w-0">
                    <h1 class="text-black dark:text-white font-black text-2xl">
                        Kelola Menu
                    </h1>

                    <p class="text-sm text-gray-500 font-medium mt-1">
                        Kelola daftar menu makanan dan minuman yang tersedia.
                    </p>
                </div>

            </div>


            <!-- Action -->
            <div class="flex flex-row gap-3 mt-1">

                <!-- Kategori -->
                <a href="?route=menu/kategori"
                    class="w-full sm:w-auto flex items-center justify-center gap-2 text-gray-700 font-bold px-5 py-3 border border-gray-200 rounded-xl  hover:bg-slate-50 active:scale-95 transition-all duration-200">

                    <i class="bx bxs-book-bookmark text-md"></i>

                    <span>
                        Kategori
                    </span>

                </a>


                <!-- Tambah Menu -->
                <button
                    type="button"
                    @click="TambahMenu = true"
                    class="w-full sm:w-auto flex items-center justify-center gap-2 bg-primary text-white font-bold px-6 py-3 rounded-xl hover:bg-blue-700 active:scale-95 transition-all duration-200">

                    <i class="bx bxs-plus text-xl"></i>

                    <span>
                        Tambah Menu
                    </span>

                </button>

            </div>

        </div>


        <!-- Menu Control -->
   <div class="bg-white overflow-hidden border-gray-200/80 mt-4 sm:mt-8">

    <!-- 4 Informasi Menu -->
    <div class="py-6  border-gray-200/80">
        <div class="grid grid-cols-2 lg:grid-cols-4 divide-x divide-gray-200">

            <!-- Total Menu -->
            <div class="flex items-center gap-4 px-5 py-4">
                <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center shrink-0">
                    <i class="bx bxs-fork-spoon text-xl text-white"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-400">Total Menu</p>
                    <p class="text-2xl font-extrabold text-slate-800 mt-0.5" id="totalMenuStat">6</p>
                </div>
            </div>

            <!-- Total Kategori -->
            <div class="flex items-center gap-4 px-5 py-4">
                <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center shrink-0">
                    <i class="bx bxs-book-bookmark text-xl text-white"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-400">Total Kategori</p>
                    <p class="text-2xl font-extrabold text-slate-800 mt-0.5" id="totalCategoryStat">3</p>
                </div>
            </div>

            <!-- Menu Aktif -->
            <div class="flex items-center gap-4 px-5 py-4">
                <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center shrink-0">
                    <i class="bx bx-check-circle text-xl text-white"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-400">Menu Aktif</p>
                    <p class="text-2xl font-extrabold text-slate-800 mt-0.5" id="activeMenuStat">6</p>
                </div>
            </div>

            <!-- Menu Nonaktif -->
            <div class="flex items-center gap-4 px-5 py-4">
                <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center shrink-0">
                    <i class="bx bx-x-circle text-xl text-white"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-400">Menu Nonaktif</p>
                    <p class="text-2xl font-extrabold text-slate-800 mt-0.5" id="inactiveMenuStat">0</p>
                </div>
            </div>

        </div>
    </div>

    <!-- Search & Filter -->
<div class="mt-4 p-3">
    <form class="flex flex-col md:flex-row rounded-xl bg-white overflow-hidden">
        
        <!-- Category Select -->
        <div class="relative w-full md:w-52 shrink-0">
            <select name="category" class="w-full h-12 pl-4 pr-10 bg-slate-50 text-sm font-bold text-gray-700 border border-gray-200 rounded-t-xl md:rounded-t-none md:rounded-l-xl md:border-r-0 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary focus:z-10 cursor-pointer appearance-none">
                <option value="Semua Kategori" selected>Semua Kategori</option>
                <option value="Makanan">Makanan</option>
                <option value="Minuman">Minuman</option>
                <option value="Camilan">Camilan</option>
            </select>
            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-400">
                <i class="bx bx-chevron-down text-lg"></i>
            </div>
        </div>

        <!-- Search Input -->
        <div class="relative flex-1">
            <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-gray-400 z-20">
                <i class="bx bx-search text-xl"></i>
            </div>
            <input type="search" name="search" class="w-full h-12 pl-11 pr-4 bg-white border-x border-b md:border-y md:border-x-0 border-gray-200 text-sm font-semibold text-slate-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary focus:z-10" placeholder="Cari nama menu...">
        </div>

        <!-- Search Button -->
        <a href="#" class="h-12 px-5 inline-flex items-center justify-center gap-2 bg-primary text-white text-sm font-bold border-0 rounded-b-xl md:rounded-b-none md:rounded-r-xl hover:bg-primary-dark focus:outline-none focus:ring-1 focus:ring-inset focus:ring-primary focus:z-10 transition-all shrink-0">
            <i class="bx bx-search text-lg"></i>
            <span class="hidden sm:inline">Cari</span>
        </a>

    </form>
</div>

</div>

<div class="px-4 my-8">
    <!-- Info -->
    <div class="flex items-center justify-between mt-8 mb-5">

        <div class="min-w-0">
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-5 rounded-full bg-primary"></div>
                <h2 class="text-xl font-black text-slate-800 dark:text-white">Daftar Menu</h2>
            </div>
            <p class="text-xs font-medium text-slate-400 mt-1 ml-3.5">Kelola menu yang tersedia di KedaiKu.</p>
        </div>

      <div class="flex items-center gap-1 p-1.5 rounded-xl border-2 border-gray-200/80 dark:border-slate-700 bg-white dark:bg-slate-800 shrink-0 min-h-[48px]">
                <a
                    href="?route=menu&layoutMode=table"
                    class="flex items-center justify-center w-9 h-9 rounded-lg text-lg transition-colors <?= $layoutMode == 'table' ? 'bg-primary text-white font-bold shadow-sm' : 'text-slate-400 hover:text-slate-600 dark:hover:text-slate-200' ?>"
                    title="Tampilan Tabel"
                >
                    <i class="bx bxs-rows"></i>
                </a>

                <a
                    href="?route=menu&layoutMode=grid"
                    class="flex items-center justify-center w-9 h-9 rounded-lg text-lg transition-colors <?= $layoutMode == 'grid' ? 'bg-primary text-white font-bold shadow-sm' : 'text-slate-400 hover:text-slate-600 dark:hover:text-slate-200' ?>"
                    title="Tampilan Grid"
                >
                    <i class="bx bxs-grid"></i>
                </a>
            </div>

    </div>

    <div class="overflow-y-auto p-1 max-h-[700px]">

        <?php 
        // Ganti variabel $menuData dengan data array/object database kamu (contoh: $dataMenu)
        $menuData = []; // Kosong untuk testing Empty State
        ?>

        <?php if ($layoutMode == 'table'): ?>

            <!-- TABLE CONTENT (DIDEAKTIFKAN / DIKOMENTARI BILA KOSONG) -->
            
            <div class="w-full overflow-x-auto">
                <table id="selection-table" class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-500 uppercase bg-slate-50 dark:bg-slate-900">
                        <tr>
                            <th scope="col" class="px-5 py-4 font-bold">#</th>
                            <th scope="col" class="px-5 py-4 font-bold">Foto</th>
                            <th scope="col" class="px-5 py-4 font-bold">Nama Menu</th>
                            <th scope="col" class="px-5 py-4 font-bold">Harga</th>
                            <th scope="col" class="px-5 py-4 font-bold">Kategori</th>
                            <th scope="col" class="px-5 py-4 font-bold">Status</th>
                            <th scope="col" class="px-5 py-4 text-center font-bold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="group hover:bg-slate-50 transition-colors">
                            <!-- <td class="px-5 py-4 font-bold text-gray-500">1</td>
                            <td class="px-5 py-4">
                                <div class="w-11 h-11 rounded-xl bg-gray-100 flex items-center justify-center shrink-0">
                                    <i class="bx bxs-bowl-hot text-xl text-gray-400"></i>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <span class="font-bold text-slate-800">Nasi Goreng Spesial</span>
                            </td>
                            <td class="px-5 py-4">
                                <span class="font-bold text-slate-800">Rp 25.000</span>
                            </td>
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center px-6 py-2 rounded-lg bg-primary text-white text-sm font-bold">
                                    Makanan
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-primary text-xs font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                                    Aktif
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button type="button" onclick="editMenu(1)" class="w-10 h-10 rounded-xl bg-primary text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all" title="Edit menu">
                                        <i class="bx bxs-pencil"></i>
                                    </button>
                                    <button type="button" onclick="hapusMenu(1)" class="w-10 h-10 rounded-xl bg-red-500 text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all" title="Hapus menu">
                                        <i class="bx bxs-trash"></i>
                                    </button>
                                </div>
                            </td> -->

                            <td colspan="7">
                                <div class="flex flex-col items-center justify-center py-12 px-4 text-center bg-gray-50">
                                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-gray-200/80">
                                        <i class="bx bx-dish text-4xl text-gray-300"></i>
                                    </div>
                                    <h3 class="text-base font-black text-slate-800 mb-1">Menu Tidak Ditemukan</h3>
                                    <p class="text-xs text-gray-400 max-w-sm mb-5">
                                        Belum ada data menu yang ditambahkan atau hasil pencarian tidak cocok.
                                    </p>
                                    <button type="button" @click="TambahMenu = true" class="px-4 py-3 bg-primary text-white text-sm font-bold rounded-xl hover:opacity-90 transition-all flex items-center gap-2">
                                        <i class="bx bx-plus text-base"></i>
                                        <span>Tambah Menu</span>
                                    </button>
                                </div>
                            </td>
                        </tr>                        
                    </tbody>
                </table>
            </div>
           

        <?php elseif ($layoutMode == 'grid'): ?>

            <!-- GRID CONTENT (DIDEAKTIFKAN / DIKOMENTARI BILA KOSONG) -->
            <!-- 
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                <div class="flex flex-row sm:flex-col group bg-white rounded-2xl overflow-hidden transition-all duration-200">
                    <div class="relative w-32 h-32 shrink-0 sm:w-full sm:h-40 overflow-hidden bg-gray-100">
                        <img src="https://images.unsplash.com/photo-1603133872878-684f208fb84b?q=80&w=800&auto=format&fit=crop" loading="lazy" class="w-full h-full object-cover object-center group-hover:scale-105 transition duration-300" alt="Nasi Goreng Spesial">
                        <div class="absolute top-2 left-2 sm:top-3 sm:left-3">
                            <span class="px-2 py-1 sm:px-2.5 sm:py-1.5 rounded-lg bg-primary text-[9px] sm:text-[10px] font-black text-white">
                                Makanan
                            </span>
                        </div>
                    </div>
                    <div class="p-3 sm:p-4 flex-1 min-w-0">
                        <h3 class="font-black text-gray-900 text-lg line-clamp-1">Nasi Goreng Spesial</h3>
                        <div class="flex items-end justify-between gap-2 mt-3 sm:mt-4">
                            <div class="min-w-0">
                                <span class="text-[9px] sm:text-[10px] uppercase tracking-wider font-bold text-gray-400 block">Harga</span>
                                <span class="text-sm sm:text-base font-black text-gray-900 whitespace-nowrap">Rp 25.000</span>
                            </div>
                            <div class="flex gap-x-2">
                                <button type="button" class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-primary text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all shrink-0" title="Edit menu">
                                    <i class="bx bxs-pencil text-lg sm:text-xl"></i>
                                </button>
                                <button type="button" class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-red-600 text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all shrink-0" title="Hapus menu">
                                    <i class="bx bxs-trash text-lg sm:text-xl"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            -->

            <div class="flex flex-col items-center justify-center py-12 px-4 text-center">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-gray-200/80">
                    <i class="bx bx-dish text-4xl text-gray-300"></i>
                </div>
                <h3 class="text-base font-black text-slate-800 mb-1">Menu Tidak Ditemukan</h3>
                <p class="text-xs text-gray-400 max-w-sm mb-5">
                    Belum ada data menu yang ditambahkan atau hasil pencarian tidak cocok.
                </p>
                <button type="button" @click="TambahMenu = true" class="px-4 py-3 bg-primary text-white text-sm font-bold rounded-xl hover:opacity-90 transition-all flex items-center gap-2">
                    <i class="bx bx-plus text-base"></i>
                    <span>Tambah Menu</span>
                </button>
            </div>

        <?php endif; ?>

    </div>
</div>


        <!-- Empty State -->
        <div
            id="emptyMenuState"
            class="hidden bg-white rounded-2xl p-12 text-center mt-6">

            <div
                class="w-14 h-14 mx-auto rounded-2xl bg-gray-100 flex items-center justify-center">

                <i class="bx bxs-search-alt text-2xl text-gray-400"></i>

            </div>

            <h3 class="text-base font-black text-gray-900 mt-4">
                Menu tidak ditemukan
            </h3>

            <p class="text-sm text-gray-400 mt-1">
                Coba gunakan kata kunci atau kategori yang berbeda.
            </p>

            <button
                type="button"
                onclick="resetMenuFilter()"
                class="mt-5 px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-bold hover:bg-red-500 transition-all">

                Reset Filter

            </button>

        </div>


        <!-- Pagination -->
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



 

   <div 
    x-show="TambahMenu"
    x-cloak
    @keydown.escape.window="TambahMenu = false"
    class="fixed inset-0 z-[999] flex justify-center items-center w-full p-4 sm:p-6 overflow-y-auto"
>

    <!-- Backdrop -->
    <div 
        x-show="TambahMenu"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-slate-950/60 backdrop-blur-[2px]"
        @click="TambahMenu = false"
    ></div>

    <!-- Modal Panel -->
    <div 
        x-show="TambahMenu"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4 sm:translate-y-2"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4 sm:translate-y-2"
        class="relative w-full max-w-5xl z-10 my-auto"
    >

        <div class="relative bg-white border border-gray-200 rounded-2xl shadow-xl p-5 sm:p-8 max-h-[calc(100vh-2rem)] overflow-y-auto">

            <!-- Header Modal -->
            <div class="mb-6 sm:mb-8 flex justify-between items-start sm:items-center gap-4">

                <div class="flex items-center gap-3 sm:gap-4 min-w-0">

                    <div class="flex w-12 h-12 rounded-2xl bg-primary items-center justify-center shrink-0 shadow-sm">
                        <i class="bx bx-bowl-hot text-2xl text-white"></i>
                    </div>

                    <div class="min-w-0">

                        <div class="flex items-center gap-2 sm:gap-3 flex-wrap">
                            <h1 class="text-slate-900 font-black text-xl sm:text-2xl leading-tight">
                                Tambah Menu
                            </h1>
                        </div>

                        <p class="text-xs sm:text-sm text-gray-500 font-medium mt-1">
                            Kelola daftar menu, harga, kategori, dan informasi menu cafe.
                        </p>

                    </div>

                </div>

                <button 
                    type="button"
                    @click="TambahMenu = false"
                    class="flex items-center justify-center w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-slate-100 text-slate-500 hover:text-white hover:bg-primary font-black cursor-pointer transition-colors shrink-0"
                    title="Tutup"
                >
                    <i class="bx bx-x text-2xl"></i>
                </button>

            </div>

            <!-- Form Content -->
            <form 
                action=""
                method="POST"
                enctype="multipart/form-data"
                class="w-full"
            >

                <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-x-6 gap-y-5">

                    <!-- Nama Menu -->
                    <div class="flex flex-col gap-1.5 w-full min-w-0">
                        <label 
                            for="namaBarang"
                            class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 ml-1"
                        >
                            Nama Menu <span class="text-red-500">*</span>
                        </label>
                        <div class="relative flex items-center w-full group">
                            <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200">
                                <i class="bx bx-price-tag-alt text-xl sm:text-lg"></i>
                            </div>
                            <input 
                                type="text"
                                name="namaBarang"
                                id="namaBarang"
                                placeholder="Contoh: Nasi Goreng Special"
                                autocomplete="off"
                                class="w-full pl-10 sm:pl-11 pr-4 py-3 bg-white text-slate-900 text-sm font-medium rounded-xl sm:rounded-2xl border-2 border-gray-200/80 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary transition-all"
                                required
                            >
                        </div>
                    </div>

                    <!-- Harga Jual -->
                    <div class="flex flex-col gap-1.5 w-full min-w-0">
                        <label 
                            for="hargaJual"
                            class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 ml-1"
                        >
                            Harga Jual (Rp) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative flex items-center w-full group">
                            <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200">
                                <i class="bx bx-coin text-xl sm:text-lg"></i>
                            </div>
                            <input 
                                type="text"
                                inputmode="numeric"
                                name="hargaBarang"
                                id="hargaJual"
                                placeholder="Contoh: 50000"
                                autocomplete="off"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                class="w-full pl-10 sm:pl-11 pr-4 py-3 bg-white text-slate-900 text-sm font-medium rounded-xl sm:rounded-2xl border-2 border-gray-200/80 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary transition-all"
                                required
                            >
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div class="flex flex-col gap-1.5 w-full min-w-0">
                        <label 
                            for="kategoriTambah"
                            class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 ml-1"
                        >
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <div class="relative flex items-center w-full group">
                            <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200 z-10">
                                <i class="bx bx-filter text-xl sm:text-lg"></i>
                            </div>
                            <select 
                                name="kategoriBarang"
                                id="kategoriTambah"
                                required
                                class="w-full pl-10 sm:pl-11 pr-10 py-3 bg-white text-slate-900 text-sm font-medium rounded-xl sm:rounded-2xl border-2 border-gray-200/80 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary appearance-none cursor-pointer transition-all"
                            >
                                <option value="" disabled selected>Pilih Kategori Menu</option>
                                <option value="makanan">Makanan</option>
                                <option value="minuman">Minuman</option>
                            </select>
                            <div class="absolute right-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200">
                                <i class="bx bx-chevron-down text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="flex flex-col gap-1.5 w-full group col-span-1 lg:col-span-2 xl:col-span-3 min-w-0">
                        <label 
                            for="deskripsi"
                            class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 ml-1"
                        >
                            Deskripsi & Catatan
                        </label>
                        <div class="relative flex w-full h-full">
                            <div class="absolute left-3.5 top-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200">
                                <i class="bx bx-info-octagon text-xl sm:text-lg"></i>
                            </div>
                            <textarea 
                                name="deskripsiBarang"
                                id="deskripsi"
                                rows="3"
                                placeholder="Tambahkan deskripsi menu..."
                                class="w-full pl-10 sm:pl-11 pr-4 py-3 bg-white text-slate-900 text-sm font-medium rounded-xl sm:rounded-2xl border-2 border-gray-200/80 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary resize-y transition-all"
                            ></textarea>
                        </div>
                    </div>

                    <!-- Foto Menu -->
                    <div class="flex flex-col gap-1.5 w-full col-span-1 lg:col-span-2 xl:col-span-3 min-w-0">
                        <label class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 ml-1">
                            Foto Menu
                        </label>
                        <label 
                            for="gambarBarang"
                            class="relative border-2 border-dashed border-gray-200/90 hover:border-primary group transition-all duration-200 rounded-xl sm:rounded-2xl p-6 sm:p-8 flex flex-col items-center justify-center cursor-pointer text-center bg-slate-50/40 hover:bg-slate-50 overflow-hidden"
                        >
                            <div class="flex flex-col items-center justify-center gap-3">
                                <div class="w-12 h-12 text-white bg-primary rounded-xl flex items-center justify-center shadow-sm">
                                    <i class="bx bx-images text-2xl"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-sm text-slate-800">
                                        Upload Foto Menu
                                    </p>
                                    <p class="text-gray-400 text-xs mt-0.5">
                                        JPG, PNG, WEBP (Maks. 2MB)
                                    </p>
                                </div>
                            </div>
                            <input 
                                type="file"
                                id="gambarBarang"
                                name="gambarBarang"
                                class="hidden"
                                accept="image/jpeg,image/png,image/webp"
                            >
                        </label>
                    </div>

                    <!-- Toggle Status Aktif / Tidak Aktif (DITAMBAHKAN DI SINI) -->
                    <div class="flex flex-col gap-1.5 w-full col-span-1 lg:col-span-2 xl:col-span-3 min-w-0">
                        <div class="flex items-center justify-between p-4 sm:p-5 bg-gray-50 rounded-xl sm:rounded-2xl border border-gray-200/80">
                            <div>
                                <label class="block text-sm font-bold text-gray-700">
                                    Menu Tersedia
                                </label>
                                <p class="text-xs text-gray-500 font-medium mt-0.5">
                                    Aktifkan jika menu ini siap untuk dipesan oleh pelanggan.
                                </p>
                            </div>
                            
                            <label class="relative inline-flex items-center cursor-pointer shrink-0">
                                <input type="checkbox" name="status_aktif" value="1" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                            </label>
                        </div>
                    </div>

                </div>

                <!-- Footer / Buttons -->
                <div class="w-full flex flex-col-reverse sm:flex-row justify-end mt-6 sm:mt-8 pt-5 border-t border-gray-100 gap-3">

                    <button 
                        type="button"
                        @click="TambahMenu = false"
                        class="w-full sm:w-auto flex items-center justify-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-6 py-3 gap-2 rounded-xl sm:rounded-2xl cursor-pointer transition-all active:scale-95"
                    >
                        <span>Batal</span>
                    </button>

                    <button 
                        type="submit"
                        class="w-full sm:w-auto flex items-center justify-center bg-primary hover:bg-primary/90 text-white font-black px-6 py-3 gap-2 rounded-xl sm:rounded-2xl cursor-pointer transition-all active:scale-95"
                    >
                        <i class="bx bxs-save text-lg"></i>
                        <span>Simpan Menu</span>
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</section>

<script>
     document.addEventListener("DOMContentLoaded", function () {

    const table = document.getElementById("selection-table");

    if (!table) return;

    new DataTable(table, {

        searchable: true,

        sortable: true,

        perPage: 10,

        perPageSelect: [5, 10, 15, 20],

        labels: {
            placeholder: "Cari menu...",
            perPage: "menu per halaman",
            noRows: "Belum ada menu",
            info: "Menampilkan {start} sampai {end} dari {rows} menu"
        }

    });

});
</script>
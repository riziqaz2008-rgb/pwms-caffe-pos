<section id="Kategorikategori">
    <div x-data="{
        layoutModeToggle: $persist(true),
        filterToggle: $persist(true),
        kategori: false
    }">
    <?php $layoutMode = $_GET['layoutMode'] ?? 'table'; ?>
        <div class="bg-white dark:bg-slate-900 mb-6">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 pb-6 dark:border-slate-800">
                <div class="flex items-center gap-4 min-w-0">
                    <div class="flex w-13 h-13 rounded-lg bg-primary items-center justify-center shrink-0">
                        <i class="bx bxs-book-bookmark text-2xl text-white"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="flex items-center gap-3 flex-wrap">
                            <a href="?route=menu" class="text-2xl font-black text-slate-900 dark:text-white hover:text-primary transition-colors">
                                Kelola Kategori
                            </a>
                        </div>
                        <p class="text-sm text-gray-500 font-medium mt-1">
                            Kelola kategori menu cafe dengan mudah.
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-2 w-full lg:w-auto">
                    <button type="button" 
                       onclick='showGlobalModal(<?= json_encode([
                            "title" => "Tambah Kategori",
                            "subtitle" => "Kelola kategori menu cafe.",
                            "icon" => "bxs-book-add",
                            "iconBg" => "bg-primary",
                            "action" => "/kategori/store",
                            "method" => "POST",
                            "buttonText" => "Simpan Kategori",
                            "buttonIcon" => "bxs-save",
                            "buttonColor" => "bg-primary hover:bg-blue-700",
                            "value" => ""
                        ]) ?>)'
                        class="flex-1 flex items-center justify-center bg-primary text-white font-bold px-5 py-3 gap-2 rounded-lg cursor-pointer whitespace-nowrap  hover:opacity-90 transition">
                        <i class="bx bxs-plus text-lg"></i>
                        <span>Tambah Kategori</span>
                    </button>
                </div>
            </div>     
        </div>

        <div class="rounded-lg sm:p-5 my-6 bg-white dark:bg-slate-950">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-5">
                <div class="min-w-0">
                    <div class="flex items-center gap-2">
                        <div class="w-1.5 h-5 rounded-full bg-primary"></div>
                        <h2 class="text-xl font-black text-slate-800 dark:text-white">
                            Daftar Kategori
                        </h2>
                    </div>
                    <p class="text-xs font-medium text-slate-400 mt-1 ml-3.5">
                        Kelola kategori menu yang tersedia di KedaiKu.
                    </p>
                </div>
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <form action="" method="GET" class="flex-1 sm:w-[280px]">
                        <div class="relative flex items-center gap-2 p-1.5 rounded-lg border-2 border-gray-200/80 dark:border-slate-700 bg-white dark:bg-slate-800 focus-within:ring-2 focus-within:ring-primary transition-all min-h-[48px]">
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
                </div>
            </div>
            <div class="overflow-y-auto p-1 max-h-[700px]">
                <div class="">
                    <table id="selection-table" class="w-full min-w-[400px] text-sm">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-900 text-gray-400">
                                <th class="text-left font-bold px-5 py-4">#</th>
                                <th class="text-left font-bold px-5 py-4">Nama Kategori</th>
                                <th class="text-center font-bold px-5 py-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="body-tabel-kategori">
                            <tr>

                            <!-- YANG DI KOMENT INI CONTOH JIKA ADA VALUE NYA.
                                            SILAHKAN DI SESUAIKAN ISI DATABASE. -->

                                <td class="px-5 py-4">
                                    <span class="font-bold text-slate-800">1</span>
                                </td>
                                <td class="px-5 py-4">
                                    <span class="inline-flex items-center gap-2 px-6 py-2 rounded-lg bg-primary text-white text-sm font-bold">
                                        Makanan
                                    </span>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <button type="button" 
                                        onclick='showGlobalModal(<?= json_encode([
                                            "title" => "Edit Kategori",
                                            "subtitle" => "Perbarui informasi kategori menu.",
                                            "icon" => "bxs-edit",
                                            "iconBg" => "bg-amber-500",
                                            "action" => "/kategori/update/1",
                                            "method" => "POST",
                                            "buttonText" => "Simpan Perubahan",
                                            "buttonIcon" => "bxs-save",
                                            "buttonColor" => "bg-amber-500 hover:bg-amber-600",
                                            "value" => "Makanan"
                                        ]) ?>)'
                                        class="w-10 h-10 rounded-lg bg-primary text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all" title="Edit menu">
                                            <i class="bx bxs-pencil"></i>
                                        </button>
                                        <button type="button" onclick="hapusMenu(1)" class="w-10 h-10 rounded-lg bg-red-500 text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all" title="Hapus menu">
                                            <i class="bx bxs-trash"></i>
                                        </button>
                                    </div>
                                </td> 

                                <!-- YANG DI BAWAH INI CONTOH JIKA VALUE NYA KOSONG. -->

                                <!-- <td colspan="3">
                                    <div class="flex flex-col items-center justify-center py-12 px-4 text-center bg-gray-50">
                                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-gray-200/80">
                                            <i class="bx bx-book-bookmark text-4xl text-gray-300"></i>
                                        </div>
                                        <h3 class="text-base font-black text-slate-800 mb-1">Kategori Belum Tersedia</h3>
                                        <p class="text-xs text-gray-400 max-w-sm mb-5">
                                            Belum ada data kategori yang ditambahkan atau hasil pencarian tidak cocok.
                                        </p>
                                        <button type="button" @click="kategori = true" class="px-4 py-3 bg-primary text-white text-sm font-bold rounded-lg hover:opacity-90 transition-all flex items-center gap-2">
                                            <i class="bx bx-plus text-base"></i>
                                            <span>Tambah Kategori</span>
                                        </button>
                                    </div>
                                </td> --> 
                                
                            </tr>
                        </tbody>
                    </table>
                </div>  
            </div>

            <div class="w-full flex justify-center mt-6">
                <nav aria-label="Pagination">
                    <ul class="inline-flex items-center gap-1.5 p-1.5 rounded-lg border-2 border-gray-200/80 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm font-medium">
                        
                        <li>
                            <a href="?page=1" class="flex items-center justify-center px-3.5 h-9 rounded-lg text-slate-400 dark:text-slate-500 opacity-50 cursor-not-allowed pointer-events-none">
                                Previous
                            </a>
                        </li>

                        <li>
                            <a href="?page=1" class="flex items-center justify-center w-9 h-9 rounded-lg bg-primary text-white font-bold shadow-sm">
                                1
                            </a>
                        </li>

                        <li>
                            <a href="?page=2" class="flex items-center justify-center w-9 h-9 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                                2
                            </a>
                        </li>

                        <li>
                            <a href="?page=2" class="flex items-center justify-center px-3.5 h-9 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                                Next
                            </a>
                        </li>    
                    </ul>
                </nav>
            </div>    
        </div>

        <div id="global-modal" class="hidden fixed inset-0 z-[9999] items-center justify-center p-4 bg-slate-950/60 backdrop-blur-[2px]">
            <div class="relative p-4 w-full max-w-xl">
                <div class="relative bg-white rounded-lg shadow-xl border border-gray-200">
                    <div class="flex items-start justify-between p-5 sm:p-6 border-b border-gray-100">
                        <div class="flex items-center gap-3 sm:gap-4">
                            <div id="globalModalIconContainer" class="flex w-12 h-12 rounded-lg bg-primary items-center justify-center shrink-0">
                                <i id="globalModalIcon" class="bx bxs-book-add text-2xl text-white"></i>
                            </div>
                            <div>
                                <h3 id="globalModalTitle" class="text-xl sm:text-2xl font-black text-slate-900 leading-tight">Tambah Kategori</h3>
                                <p id="globalModalSubtitle" class="text-xs sm:text-sm text-gray-500 font-medium mt-1">Kelola kategori menu cafe.</p>
                            </div>
                        </div>
                        <button type="button" onclick="closeGlobalModal()" class="text-slate-500 bg-slate-100 hover:bg-primary hover:text-white rounded-full w-10 h-10 inline-flex justify-center items-center transition-colors cursor-pointer">
                            <i class="bx bx-x text-2xl"></i>
                            <span class="sr-only">Tutup</span>
                        </button>
                    </div>
                    <form id="globalModalForm" action="" method="POST" class="p-5 sm:p-6">
                        <div class="flex flex-col gap-1.5 w-full">
                            <label for="globalModalInput" class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 ml-1">
                                Nama Kategori
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative flex items-center w-full group">
                                <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                                    <i class="bx bxs-bookmark text-xl"></i>
                                </div>
                                <input type="text" name="namaKategori" id="globalModalInput" placeholder="Contoh: Makanan Utama" autocomplete="off" class="w-full pl-11 pr-4 py-3 bg-white text-slate-900 text-sm font-medium rounded-lg border-2 border-gray-200/80 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all" required>
                            </div>
                        </div>
                        <div class="flex flex-col-reverse sm:flex-row items-center justify-end pt-5 mt-6 border-t border-gray-100 gap-3">
                            <button type="button" onclick="closeGlobalModal()" class="w-full sm:w-auto bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-6 py-3 rounded-lg text-sm transition-all">
                                Batal
                            </button>
                            <button id="globalModalSubmit" type="submit" class="w-full sm:w-auto flex items-center justify-center bg-primary hover:bg-blue-700 text-white font-black px-6 py-3 gap-2 rounded-lg text-sm transition-all">
                                <i id="globalModalSubmitIcon" class="bx bxs-save text-lg"></i>
                                <span id="globalModalSubmitText">Simpan Kategori</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
    </div>
</section>




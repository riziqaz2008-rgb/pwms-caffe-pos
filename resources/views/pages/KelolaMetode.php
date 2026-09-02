<section id="MetodePembayaran">
    <div class="bg-white dark:bg-slate-900 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 dark:border-slate-800 gap-4">
            <div class="flex items-center gap-4 min-w-0">
                <div class="flex w-13 h-13 rounded-lg bg-primary border border-indigo-100/80 items-center justify-center shrink-0 border border-gray-200/80">
                    <i class="bx bxs-credit-card text-2xl text-white"></i>
                </div>
                <div class="min-w-0">
                    <div class="flex items-center gap-3 flex-wrap">
                        <h1 class="text-black dark:text-white font-black text-2xl">
                            Metode Pembayaran
                        </h1>
                    </div>
                    <p class="text-sm text-gray-500 font-medium mt-1">
                        Kelola metode pembayaran yang tersedia pada pembayaran cafe.
                    </p>
                </div>
            </div>
            <div class="flex flex-row gap-3 mt-1">
                <button type="button" 
                onclick='showGlobalModal(<?= json_encode([
                    "title" => "Tambah Metode Pembayaran",
                    "subtitle" => "Tambahkan metode pembayaran baru untuk pembayaran cafe.",
                    "icon" => "bxs-credit-card",
                    "iconBg" => "bg-primary",
                    "action" => "/metode-pembayaran/store",
                    "method" => "POST",
                    "buttonText" => "Simpan Metode",
                    "buttonIcon" => "bxs-save",
                    "buttonColor" => "bg-primary hover:bg-blue-700",
                    
                    "nameBtn" => "aksi",
                    "value" => "tambah"  
                ]) ?>)'
                    class="w-full sm:w-auto flex items-center justify-center gap-2 bg-primary text-white font-bold px-6 py-3 rounded-lg hover:bg-blue-700 active:scale-95 transition-all duration-200">
                        <i class="bx bxs-plus text-xl"></i>
                    <span>Tambah Metode</span>
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-7">

        <div class="relative bg-white dark:bg-slate-900 border-e border-gray-200/80 dark:border-slate-700 rounded-lg p-3 flex items-center justify-between overflow-hidden group transition-all duration-300">
            <div>
                <p class="text-[10px] uppercase tracking-wider font-black text-gray-400">Total Tersedia</p>
                <div class="flex items-end gap-2 mt-1">
                    <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white leading-none">0</h2>
                    <span class="text-xs font-bold text-gray-400">metode</span>
                </div>
            </div>
            <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-primary text-white group-hover:scale-110 transition-transform duration-300 shrink-0">
                <i class="bx bxs-credit-card text-2xl"></i>
            </div>
        </div>

        <div class="relative bg-white dark:bg-slate-900 border-e border-gray-200/80 dark:border-slate-700 rounded-lg p-3 flex items-center justify-between overflow-hidden group transition-all duration-300">
            <div>
                <p class="text-[10px] uppercase tracking-wider font-black text-gray-400">Metode Aktif</p>
                <div class="flex items-end gap-2 mt-1">
                    <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white leading-none">0</h2>
                    <span class="text-xs font-bold text-gray-400">aktif</span>
                </div>
            </div>
            <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-primary text-white dark:text-emerald-400 group-hover:scale-110 transition-transform duration-300 shrink-0">
                <i class="bx bxs-check-circle text-2xl"></i>
            </div>
        </div>

        <div class="relative bg-white dark:bg-slate-900  dark:border-slate-700 rounded-lg p-3 flex items-center justify-between overflow-hidden group transition-all duration-300 col-span-full lg:col-span-1">
            <div>
                <p class="text-[10px] uppercase tracking-wider font-black text-gray-400">Metode Nonaktif</p>
                <div class="flex items-end gap-2 mt-1">
                    <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white leading-none">0</h2>
                    <span class="text-xs font-bold text-gray-400">nonaktif</span>
                </div>
            </div>
            <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-primary text-white dark:text-amber-400 group-hover:scale-110 transition-transform duration-300 shrink-0">
                <i class="bx bxs-block text-2xl"></i>
            </div>
        </div>

    </div>

    <div class="rounded-lg sm:p-5 my-6 bg-white dark:bg-slate-950">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-5">
            <div class="min-w-0">
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-5 rounded-full bg-primary"></div>
                    <h2 class="text-xl font-black text-slate-800 dark:text-white">
                        Daftar Metode pembayaran
                    </h2>
                </div>

                <p class="text-xs font-medium text-slate-400 mt-1 ml-3.5">
                    Kelola metode pembayaran yang tersedia di CaffePW.
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
                            placeholder="Cari metode...">
                    </div>
                </form>
            </div>
        </div>

        <div class="overflow-x-auto overflow-y-auto max-h-[700px] p-1">
            <table id="selection-table" class="w-full min-w-[600px] text-sm">
                <thead class="sticky top-0 bg-slate-50 dark:bg-slate-900 z-10">
                    <tr class="text-gray-400">
                        <th class="text-left font-bold px-5 py-4">#</th>
                        <th class="text-left font-bold px-5 py-4">Nama</th>
                        <th class="text-left font-bold px-5 py-4">Tipe</th>
                        <th class="text-left font-bold px-5 py-4">Status</th>
                        <th class="text-center font-bold px-5 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody id="body-tabel-kategori">
                    <tr>
                        <td class="px-5 py-4 font-bold text-gray-500 w-12">1</td>
                        <td class="px-5 py-4">
                            <span class="font-bold text-slate-800">Bank Mandiri</span>
                        </td>
                        <td class="px-5 py-4">
                            <span class="font-bold text-slate-800">Transfer</span>
                        </td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-primary text-xs font-bold text-white">
                                <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                Aktif
                            </span>
                        </td>
                        <td class="px-5 py-4 w-36 whitespace-nowrap">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" 
                                onclick='showGlobalModal(<?= json_encode([
                                    "title" => "Edit Metode Pembayaran",
                                    "subtitle" => "Perbarui informasi metode pembayaran cafe.",
                                    "icon" => "bxs-edit",
                                    "iconBg" => "bg-amber-500",
                                    "action" => "/metode-pembayaran/update/1",
                                    "method" => "POST",
                                    "buttonText" => "Simpan Perubahan",
                                    "buttonIcon" => "bxs-save",
                                    "buttonColor" => "bg-amber-500 hover:bg-amber-600",

                                    "nameBtn" => "aksi",
                                    "value" => "tambah"  
                                ]) ?>)'
                                class="w-10 h-10 rounded-lg bg-primary text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all" title="Edit menu">
                                    <i class="bx bxs-pencil"></i>
                                </button>
                                <button type="button" 
                                onclick="showConfirm(
                                    'Hapus Data?',
                                    'Yakin ingin menghapus data ini?',
                                    'Ya, Hapus',
                                    'danger'
                                )"    
                                class="w-10 h-10 rounded-lg bg-red-500 text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all" title="Hapus menu">
                                    <i class="bx bxs-trash"></i>
                                </button>
                            </div>
                        </td>
                    <!-- YANG DI BAWAH INI CONTOH JIKA VALUE NYA KOSONG. -->

                        <!-- <td colspan="5">
                            <div class="flex flex-col items-center justify-center py-12 px-4 text-center bg-gray-50">
                                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-gray-200/80">
                                    <i class="bx bxs-credit-card text-4xl text-gray-300"></i>
                                </div>
                                <h3 class="text-base font-black text-slate-800 mb-1">Metode Belum Tersedia</h3>
                                <p class="text-xs text-gray-400 max-w-sm mb-5">
                                    Belum ada metode pembayaran yang ditambahkan atau hasil pencarian tidak cocok.
                                </p>
                                <button type="button" 
                                onclick='showGlobalModal(<?= json_encode([
                                    "title" => "Tambah Metode Pembayaran",
                                    "subtitle" => "Tambahkan metode pembayaran baru untuk pembayaran cafe.",
                                    "icon" => "bxs-credit-card",
                                    "iconBg" => "bg-primary",
                                    "action" => "/metode-pembayaran/store",
                                    "method" => "POST",
                                    "buttonText" => "Simpan Metode",
                                    "buttonIcon" => "bxs-save",
                                    "buttonColor" => "bg-primary hover:bg-blue-700",
                                    
                                    "nameBtn" => "aksi",
                                    "value" => "tambah"  
                                ]) ?>)'
                                class="px-4 py-3 bg-primary text-white text-sm font-bold rounded-lg hover:opacity-90 transition-all flex items-center gap-2">
                                    <i class="bx bxs-plus text-base"></i>
                                    <span>Tambah Metode</span>
                                </button>
                            </div>
                        </td> -->
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="w-full flex justify-center mt-6">
            <nav aria-label="Pagination">
                <ul class="inline-flex items-center gap-1.5 p-1.5 rounded-lg border-2 border-gray-200/80 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm font-medium">

                    <li>
                        <a href="?page=1"
                            class="flex items-center justify-center px-3.5 h-9 rounded-lg text-slate-400 dark:text-slate-500 opacity-50 cursor-not-allowed pointer-events-none">
                            Previous
                        </a>
                    </li>

                    <li>
                        <a href="?page=1"
                            class="flex items-center justify-center w-9 h-9 rounded-lg bg-primary text-white font-bold shadow-sm">
                            1
                        </a>
                    </li>

                    <li>
                        <a href="?page=2"
                            class="flex items-center justify-center w-9 h-9 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                            2
                        </a>
                    </li>

                    <li>
                        <a href="?page=2"
                            class="flex items-center justify-center px-3.5 h-9 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                            Next
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </div>

    <div id="global-modal" class="hidden fixed inset-0 z-[9999] items-center justify-center w-full p-4 sm:p-6 overflow-y-auto bg-slate-950/60 backdrop-blur-[2px]">
        <div class="relative w-full max-w-xl z-10 my-auto">
            <div class="relative bg-white border border-gray-200 rounded-lg shadow-xl p-5 sm:p-8 max-h-[calc(100vh-2rem)] overflow-y-auto">
                <div class="mb-6 sm:mb-8 flex justify-between items-start sm:items-center gap-4">
                    <div class="flex items-center gap-3 sm:gap-4 min-w-0">
                        <div class="globalModalIconContainer flex w-12 h-12 rounded-lg bg-primary items-center justify-center shrink-0">
                            <i id="globalModalIcon" class="bx bxs-credit-card text-2xl text-white"></i>
                        </div>
                        <div class="min-w-0">
                            <h1 id="globalModalTitle" class="text-slate-900 font-black text-xl sm:text-2xl leading-tight">Tambah Metode Pembayaran</h1>
                            <p id="globalModalSubtitle" class="text-xs sm:text-sm text-gray-500 font-medium mt-1">Tambahkan metode pembayaran baru untuk pembayaran cafe.</p>
                        </div>
                    </div>
                    <button type="button" onclick="closeGlobalModal()" title="Tutup" class="flex items-center justify-center w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-slate-100 text-slate-500 hover:text-white hover:bg-primary font-black cursor-pointer transition-colors shrink-0">
                        <i class="bx bxs-x text-2xl"></i>
                    </button>
                </div>
                <form id="globalModalForm" action="" method="POST" class="w-full">
                    <div class="grid grid-cols-1 gap-5">
                        <div class="flex flex-col gap-1.5 w-full">
                            <label for="globalModalInput" class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 ml-1">Nama Metode <span class="text-red-500">*</span></label>
                            <div class="relative flex items-center w-full group">
                            <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200">
                                <i class="bx bxs-wallet-alt text-xl sm:text-lg"></i>
                            </div>
                            <input type="text" name="namaMetode" id="globalModalInput" placeholder="Contoh: Bank Mandiri" autocomplete="off" class="w-full pl-10 sm:pl-11 pr-4 py-3 bg-white text-slate-900 text-sm font-medium rounded-lg border-2 border-gray-200/80 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary transition-all" required>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1.5 w-full">
                            <label for="tipePembayaran" class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 ml-1">Tipe Pembayaran <span class="text-red-500">*</span></label>
                            <div class="relative flex items-center w-full group">
                            <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200 z-10">
                                <i class="bx bxs-credit-card text-xl sm:text-lg"></i>
                            </div>
                            <select name="tipePembayaran" id="tipePembayaran" class="w-full pl-10 sm:pl-11 pr-10 py-3 bg-white text-slate-900 text-sm font-medium rounded-lg border-2 border-gray-200/80 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary transition-all appearance-none cursor-pointer" required>
                                <option value="" disabled selected hidden>Pilih Tipe Pembayaran</option>
                                <option value="Cash">Cash / Tunai</option>
                                <option value="QRIS">QRIS</option>
                                <option value="Transfer Bank">Transfer Bank</option>
                                <option value="Debit Card">Kartu Debit</option>
                                <option value="Credit Card">Kartu Kredit</option>
                            </select>
                            <div class="absolute right-3.5 flex items-center pointer-events-none text-gray-400">
                                <i class="bx bxs-chevron-down text-xl"></i>
                            </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1.5 w-full mt-2">
                            <label for="deskripsiMetode" class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 ml-1">Deskripsi</label>
                            <div class="relative flex w-full group">
                            <div class="absolute left-3.5 top-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200">
                                <i class="bx bxs-info-octagon text-xl sm:text-lg"></i>
                            </div>
                            <textarea name="deskripsiMetode" id="deskripsiMetode" rows="3" placeholder="Jelaskan penggunaan metode pembayaran ini..." class="w-full pl-10 sm:pl-11 pr-4 py-3 bg-white text-slate-900 text-sm font-medium rounded-lg border-2 border-gray-200/80 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary resize-y transition-all"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="w-full flex flex-col-reverse sm:flex-row justify-end mt-6 sm:mt-8 pt-5 border-t border-gray-100 gap-3">
                        <button type="button" onclick="closeGlobalModal()" class="w-full sm:w-auto flex items-center justify-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-6 py-3 gap-2 rounded-lg cursor-pointer transition-all active:scale-95">
                            <span>Batal</span>
                        </button>
                        <button id="globalModalSubmit" type="submit" class="w-full sm:w-auto flex items-center justify-center bg-primary hover:bg-primary/90 text-white font-black px-6 py-3 gap-2 rounded-lg cursor-pointer transition-all active:scale-95">
                            <i id="globalModalSubmitIcon" class="bx bxs-save text-lg"></i>
                            <span id="globalModalSubmitText">Simpan Metode</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


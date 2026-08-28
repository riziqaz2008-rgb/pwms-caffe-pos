<section id="Laporan">
    <div
    x-data="{
        FilterRiwayatTransaksi: false,
        ViewRiwayatTransaksi: false,
        selectedData: {
            kode: '',
            status: '',
            tanggal: '',
            kasir: '',
            pembayaran: '',
            waktu: '',
            items: [],
            total: 0
        },
        openDetail(data) {
            this.selectedData = data;
            this.ViewRiwayatTransaksi = true;
        }
    }"
    x-init="$watch('FilterRiwayatTransaksi', value => document.body.classList.toggle('overflow-hidden', value)); $watch('ViewRiwayatTransaksi', value => document.body.classList.toggle('overflow-hidden', value))">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-5">
            <div class="flex items-center gap-x-5">
                <div class="w-13 h-13 rounded-lg bg-primary flex items-center justify-center shrink-0 border border-gray-200/80">
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
                <button type="button" @click="FilterRiwayatTransaksi = true"
                    class="w-full h-12 md:w-auto flex items-center justify-center bg-primary text-white font-bold px-6 gap-2 rounded-lg cursor-pointer hover:opacity-90 transition-opacity">
                    <i class="bx bxs-filter text-lg"></i>
                    <span>
                        Filter
                    </span>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mt-10 mb-8">

            <div class="bg-white border-e border-gray-200/80 rounded-lg px-3 py-3 py-6">
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-lg bg-primary flex items-center justify-center">
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

            <div class="bg-white border-e border-gray-200/80 rounded-lg px-3 py-3 py-6">
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-lg bg-primary flex items-center justify-center">
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

            <div class="bg-white rounded-lg px-3 py-3 py-6 sm:col-span-2 lg:col-span-1">
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-lg bg-primary flex items-center justify-center">
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
                        Riwayat transaksi penjualan cafe
                    </p>
                </div>
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

            <div class="overflow-x-auto overflow-y-auto max-h-[700px] p-1">
                <table id="selection-table" class="w-full min-w-[900px] text-sm border-separate border-spacing-0">
                    <thead class="sticky top-0 z-10 bg-slate-50 dark:bg-slate-900">
                        <tr>
                            <th class="text-left font-bold text-slate-500 dark:text-slate-400 px-5 py-4 rounded-tl-xl">#</th>
                            <th class="text-left font-bold text-slate-500 dark:text-slate-400 px-5 py-4">Kode Transaksi</th>
                            <th class="text-left font-bold text-slate-500 dark:text-slate-400 px-5 py-4">Tanggal</th>
                            <th class="text-left font-bold text-slate-500 dark:text-slate-400 px-5 py-4">Total</th>
                            <th class="text-left font-bold text-slate-500 dark:text-slate-400 px-5 py-4">Status</th>
                            <th class="text-center font-bold text-slate-500 dark:text-slate-400 px-5 py-4 rounded-tr-xl">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="group bg-white dark:bg-slate-950 hover:bg-slate-50 dark:hover:bg-slate-900 transition-colors duration-200">

                            <td class="px-5 py-4 font-bold text-gray-500">1</td>
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center px-6 py-2 rounded-lg bg-primary text-white text-sm font-bold">
                                   TRX-001
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <span class="font-bold text-slate-800">27-08-2026</span>
                            </td>       
                            <td class="px-5 py-4">
                                <span class="font-bold text-primary">Rp 25.000</span>
                            </td>  
                            <td class="px-5 py-4">
                                <span class="font-bold text-slate-800">Transfer</span>
                            </td>       
                            <td class="px-5 py-4">
                                <div class="inline-flex rounded-lg shadow-sm" role="group">
                                    <button type="button" 
                                        @click="openDetail({
                                            kode: 'TRX-001',
                                            status: 'Selesai',
                                            tanggal: '27-08-2026',
                                            kasir: 'Eko',
                                            pembayaran: 'Transfer',
                                            waktu: '14:35',
                                            items: [
                                                { nama: 'Nasi Goreng', qty: 2, harga: 25000, subtotal: 50000 },
                                                { nama: 'Es Teh', qty: 1, harga: 25000, subtotal: 25000 }
                                            ],
                                            total: 75000
                                        })"
                                        class="w-10 h-10 rounded-l-lg bg-slate-800 text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all border-r border-purple-700" 
                                        title="Lihat detail">
                                        <i class="bx bxs-eye"></i>
                                    </button>

                                    <button type="button" onclick="editMenu(1)" class="w-10 h-10 bg-primary text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all border-r border-primary/20" title="Edit menu">
                                        <i class="bx bxs-pencil"></i>
                                    </button>

                                    <button type="button" onclick="hapusMenu(1)" class="w-10 h-10 rounded-r-lg bg-red-500 text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all" title="Hapus menu">
                                        <i class="bx bxs-trash"></i>
                                    </button>
                                </div>
                            </td>

                            <!-- <td colspan="8">
                                <div class="flex flex-col items-center justify-center py-12 px-4 text-center bg-gray-50">
                                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-gray-200/80">
                                        <i class="bx bx-archive text-4xl text-gray-300"></i>
                                    </div>
                                    <h3 class="text-base font-black text-slate-800 mb-1">Riwayat Transaksi Belum Tersedia</h3>
                                    <p class="text-xs text-gray-400 max-w-sm mb-5">Belum ada data transaksi yang ditambahkan atau hasil pencarian tidak cocok.</p>
                                    <a href="?route=kasir" class="px-4 py-3 bg-primary text-white text-sm font-bold rounded-lg hover:opacity-90 transition-all flex items-center gap-2">
                                        <i class="bx bxs-plus text-base"></i>
                                        <span>Tambah Transaksi</span>
                                    </a>
                                </div>
                            </td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div x-init="$watch('FilterRiwayatTransaksi', value => document.body.classList.toggle('overflow-hidden', value))">
            <div x-show="FilterRiwayatTransaksi" x-cloak @keydown.escape.window="FilterRiwayatTransaksi = false" class="fixed inset-0 z-[999] flex justify-center items-center w-full p-4 sm:p-6 overflow-y-auto">
                <div x-show="FilterRiwayatTransaksi" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-950/60 backdrop-blur-[2px]" @click="FilterRiwayatTransaksi = false"></div>
                <div x-show="FilterRiwayatTransaksi" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 scale-95 translate-y-4 sm:translate-y-2" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-95 translate-y-4 sm:translate-y-2" class="relative w-full max-w-xl z-10 my-auto">
                    <div class="relative bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-lg p-5 sm:p-8 shadow-xl max-h-[calc(100vh-2rem)] overflow-y-auto">
                        <div class="mb-6 sm:mb-8 flex justify-between items-start sm:items-center gap-4">
                            <div class="flex items-center gap-3 sm:gap-4">
                                <div class="flex w-12 h-12 rounded-lg bg-primary items-center justify-center shrink-0">
                                    <i class="bx bxs-filter text-2xl text-white"></i>
                                </div>
                                <div>
                                    <h1 class="text-slate-900 dark:text-white font-black text-xl sm:text-2xl leading-tight">Filter Riwayat Transaksi</h1>
                                    <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 font-medium mt-1">Atur periode dan kriteria pencarian transaksi.</p>
                                </div>
                            </div>
                            <button type="button" @click="FilterRiwayatTransaksi = false" class="flex items-center justify-center w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 hover:text-white dark:hover:text-white hover:bg-primary dark:hover:bg-primary font-black cursor-pointer transition-colors shrink-0" title="Tutup">
                                <i class="bx bx-x text-2xl"></i>
                            </button>
                        </div>
                        <form action="" method="GET" class="w-full">
                            <div class="grid grid-cols-1 gap-5">
                                <div class="flex flex-col gap-1.5 w-full">
                                    <label class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">Metode Pembayaran</label>
                                    <div class="relative flex items-center w-full group">
                                        <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200">
                                            <i class="bx bxs-credit-card text-xl sm:text-lg"></i>
                                        </div>
                                        <select name="pembayaran" class="w-full pl-10 sm:pl-11 pr-10 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-lg sm:rounded-lg border-2 border-gray-200/80 dark:border-slate-700 focus:outline-none focus:ring focus:ring-primary focus:border-primary appearance-none transition-all cursor-pointer">
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
                                <div class="flex flex-col gap-1.5 w-full">
                                    <label class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">Kategori</label>
                                    <div class="relative flex items-center w-full group">
                                        <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200">
                                            <i class="bx bxs-layers-alt text-xl sm:text-lg"></i>
                                        </div>
                                        <select name="kategori" class="w-full pl-10 sm:pl-11 pr-10 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-lg sm:rounded-lg border-2 border-gray-200/80 dark:border-slate-700 focus:outline-none focus:ring focus:ring-primary focus:border-primary appearance-none transition-all cursor-pointer">
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
                                <div class="flex flex-col gap-1.5 w-full">
                                    <label class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">Rentang Tanggal</label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                        <div class="relative flex items-center w-full group">
                                            <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200">
                                                <i class="bx bxs-calendar text-xl sm:text-lg"></i>
                                            </div>
                                            <input type="date" name="tanggal_mulai" class="w-full pl-10 sm:pl-11 pr-3 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-lg sm:rounded-lg border-2 border-gray-200/80 dark:border-slate-700 focus:outline-none focus:ring focus:ring-primary focus:border-primary transition-all cursor-pointer">
                                        </div>
                                        <div class="relative flex items-center w-full group">
                                            <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200">
                                                <i class="bx bxs-calendar text-xl sm:text-lg"></i>
                                            </div>
                                            <input type="date" name="tanggal_sampai" class="w-full pl-10 sm:pl-11 pr-3 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-lg sm:rounded-lg border-2 border-gray-200/80 dark:border-slate-700 focus:outline-none focus:ring focus:ring-primary focus:border-primary transition-all cursor-pointer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full flex flex-col-reverse sm:flex-row justify-end mt-6 sm:mt-8 pt-5 border-t border-gray-100 dark:border-slate-800 gap-3 sm:gap-3">
                                <button type="button" @click="FilterRiwayatTransaksi = false" class="w-full sm:w-auto flex items-center justify-center bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-bold px-6 py-3 gap-2 rounded-lg sm:rounded-lg cursor-pointer transition-all active:scale-95">
                                    <span>Batal</span>
                                </button>
                                <button type="submit" @click="FilterRiwayatTransaksi = false" class="w-full sm:w-auto flex items-center justify-center bg-primary hover:bg-primary/90 text-white font-black px-6 py-3 gap-2 rounded-lg sm:rounded-lg cursor-pointer transition-all active:scale-95">
                                    <i class="bx bxs-filter-alt text-lg"></i>
                                    <span>Terapkan Filter</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

     <div 
    x-data="{ status: 'Hutang' }" 
    x-init="$watch('ViewRiwayatTransaksi', value => document.body.classList.toggle('overflow-hidden', value))"
>
    <!-- MODAL WRAPPER MAIN -->
    <div 
        x-show="ViewRiwayatTransaksi" 
        x-cloak 
        @keydown.escape.window="ViewRiwayatTransaksi = false" 
        class="fixed inset-0 z-[999] flex justify-center items-center w-full p-4 sm:p-6 overflow-y-auto print:p-0 print:static print:block"
    >
        
        <!-- BACKDROP OVERLAY -->
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

        <!-- CONTAINER MODAL (Disamakan max-w-5xl) -->
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
            
            <div class="relative bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 sm:p-8 shadow-2xl max-h-[calc(100vh-2rem)] overflow-y-auto print:overflow-visible print:max-h-none print:border-none print:p-0 print:bg-white print:text-black">
                
                 <div class="mb-6 sm:mb-8 flex justify-between items-start sm:items-center gap-4">
                    <div class="flex items-center gap-3 sm:gap-4 min-w-0">
                        <div class="flex w-12 h-12 rounded-lg bg-primary items-center justify-center shrink-0 shadow-sm">
                            <i class="bx bx-clock text-2xl text-white"></i>
                        </div>
                        <div class="min-w-0">    
                            <div class="flex items-center gap-2 sm:gap-3 flex-wrap">
                                <h1 class="text-slate-900 font-black text-xl sm:text-2xl leading-tight">
                                    Detail Riwayat Transaksi
                                </h1>
                            </div>    
                            <p class="text-xs sm:text-sm text-gray-500 font-medium mt-1">
                                Kelola daftar menu, harga, kategori, dan informasi menu cafe.
                            </p>    
                        </div>    
                    </div>    
                    <button type="button" @click="TambahMenu = false" title="Tutup"
                        class="flex items-center justify-center w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-slate-100 text-slate-500 hover:text-white hover:bg-primary font-black cursor-pointer transition-colors shrink-0"                    >
                        <i class="bx bx-x text-2xl"></i>
                    </button>
                </div>

                <div class="max-w-md mx-auto print:max-w-none">
                    
                    <!-- IDENTITAS TOKO (Tampilan cetak / header struk) -->
                    <div class="text-center pb-4 mb-4 border-b border-dashed border-slate-200 dark:border-slate-800 print:border-black">
                        <h3 class="text-slate-900 dark:text-white font-black text-base tracking-wider uppercase print:text-black print:text-sm">PW CAFFE</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5 print:text-black print:text-[10px]">Jl. A. Wahab Syahranie No.Gang 9</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 print:text-black print:text-[10px]">Telp. 081234567890</p>
                    </div>

                    <!-- METADATA TRANSAKSI -->
                    <div class="py-1 text-xs sm:text-sm space-y-1.5 border-b border-dashed border-slate-200 dark:border-slate-800 print:border-black print:py-2 print:text-[10px]">
                        <div class="flex justify-between">
                            <span class="text-slate-500 dark:text-slate-400 font-medium print:text-black">No. TRX</span>
                            <span class="font-bold text-slate-800 dark:text-slate-200 print:text-black">TR00104910</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-500 dark:text-slate-400 font-medium print:text-black">Kasir</span>
                            <span class="font-bold text-slate-800 dark:text-slate-200 print:text-black">Maulida</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-500 dark:text-slate-400 font-medium print:text-black">Pelanggan</span>
                            <span class="font-bold text-slate-800 dark:text-slate-200 print:text-black">APARTEMEN</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-500 dark:text-slate-400 font-medium print:text-black">Tanggal</span>
                            <span class="font-bold text-slate-800 dark:text-slate-200 print:text-black">2026-08-26 09:47:43</span>
                        </div>
                    </div>

                    <!-- TABEL ITEM PESANAN -->
                    <div class="my-4 print:my-2">
                        <table class="w-full text-xs sm:text-sm text-left print:text-[10px]">
                            <thead>
                                <tr class="border-b border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 font-bold print:border-black print:text-black">
                                    <th class="py-2 pr-2">Nama</th>
                                    <th class="py-2 px-1 text-right">Harga</th>
                                    <th class="py-2 px-1 text-center">Qty</th>
                                    <th class="py-2 pl-2 text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 print:divide-none">
                                <tr class="text-slate-800 dark:text-slate-200 print:text-black">
                                    <td class="py-2.5 pr-2 font-medium">SARIWANGI MELATI 25S</td>
                                    <td class="py-2.5 px-1 text-right whitespace-nowrap">10,000</td>
                                    <td class="py-2.5 px-1 text-center">1</td>
                                    <td class="py-2.5 pl-2 text-right font-bold whitespace-nowrap">Rp10,000</td>
                                </tr>
                                <tr class="text-slate-800 dark:text-slate-200 print:text-black">
                                    <td class="py-2.5 pr-2 font-medium">CAP ENAAK SKM PUTIH KLG 375G</td>
                                    <td class="py-2.5 px-1 text-right whitespace-nowrap">15,000</td>
                                    <td class="py-2.5 px-1 text-center">1</td>
                                    <td class="py-2.5 pl-2 text-right font-bold whitespace-nowrap">Rp15,000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- SUMMARY PEMBAYARAN -->
                    <div class="pt-3 border-t border-dashed border-slate-200 dark:border-slate-800 space-y-1.5 text-xs sm:text-sm print:border-black print:pt-2 print:text-[10px]">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-slate-600 dark:text-slate-400 print:text-black">Pembayaran :</span>
                            <span class="font-bold text-slate-900 dark:text-white print:text-black" x-text="status">Hutang</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-slate-600 dark:text-slate-400 print:text-black">Total Diskon :</span>
                            <span class="font-bold text-slate-900 dark:text-white print:text-black">Rp0</span>
                        </div>
                        <div class="flex justify-between items-center text-sm sm:text-base py-1 font-black text-slate-900 dark:text-white border-y border-slate-100 dark:border-slate-800 print:border-none print:py-0.5 print:text-[11px] print:text-black">
                            <span>Total Bayar :</span>
                            <span class="text-blue-600 dark:text-blue-400 print:text-black">Rp25,000</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-slate-600 dark:text-slate-400 print:text-black">Dibayar :</span>
                            <span class="font-bold text-slate-900 dark:text-white print:text-black">Rp25,000</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-slate-600 dark:text-slate-400 print:text-black">Kembali :</span>
                            <span class="font-bold text-slate-900 dark:text-white print:text-black">Rp0</span>
                        </div>
                    </div>

                    <!-- FOOTER STRUK (Cetak Thermal) -->
                    <div class="hidden print:block text-center mt-4 pt-2 border-t border-dashed border-black text-[9px]">
                        <p class="font-bold">*** TERIMA KASIH ***</p>
                    </div>

                    <!-- DROPDOWN UBAH STATUS (Sama persis ukuran style label form modal 1) -->
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-800 print:hidden">
                        <label for="status-transaksi" class="block text-[11px] font-bold uppercase tracking-wide text-slate-500 dark:text-slate-400 mb-2">
                            Ubah Status Transaksi
                        </label>
                        <div class="relative w-full">
                            <select 
                                id="status-transaksi" 
                                x-model="status" 
                                class="w-full appearance-none bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-200 font-bold text-sm rounded-xl px-4 py-3 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 transition-all cursor-pointer"
                            >
                                <option value="Hutang">Hutang / Belum Lunas</option>
                                <option value="Lunas">Lunas (Cash)</option>
                                <option value="Transfer">Lunas (Transfer / QRIS)</option>
                                <option value="Batal">Dibatalkan / Void</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-500 dark:text-slate-400">
                                <i class="bx bx-chevron-down text-xl"></i>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- FOOTER TOMBOL AKSI (Identik dengan Modal Form) -->
                <div class="flex justify-end gap-3 mt-8 pt-4 border-t border-slate-100 dark:border-slate-800 print:hidden">
                    <button 
                        type="button" 
                        @click="ViewRiwayatTransaksi = false" 
                        class="px-6 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 font-bold text-sm transition-all active:scale-95 cursor-pointer"
                    >
                        Batal
                    </button>
                    <button 
                        type="button" 
                        @click="window.print()" 
                        class="flex items-center gap-2 px-6 py-3 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm transition-all active:scale-95 cursor-pointer"
                    >
                        <i class="bx bx-printer text-lg"></i>
                        <span>Cetak Struk</span>
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
    </div>


</section>


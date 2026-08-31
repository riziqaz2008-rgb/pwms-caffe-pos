<section id="Kasir">
    <div 
        x-data="{ 
            layoutModeToggle: $persist(true), 
            filterToggle: $persist(true), 
            open: false,
            tambahUser: false,
            total: 68000,
            nominal: 0,
            pelanggan: '',
            metode: '',
            
            pesananMenunggu: false,        

            StepJenisPesanan: '',
            StepDataDiri: false,
            StepPembayaran: false,

            qty: 1,
            hargaSatuan: 20000,

            menuOpen: false,
            diskonOpen: false,
            catatanOpen: false,

            tipeDiskon: 'nominal',
            diskonNilai: 0,
            catatan: '',

            get subtotalSebelumDiskon() {
                return this.hargaSatuan * this.qty;
            },

            get subtotal() {
                let total = this.subtotalSebelumDiskon;

                if (this.tipeDiskon === 'nominal') {
                    total -= this.diskonNilai;
                }

                return Math.max(0, total);
            }

        }"
        x-init="$watch('open', value => document.body.classList.toggle('overflow-hidden', value))">
        
        <?php $LayoutMode = $_GET['layoutMode'] ?? 'table' ?>
  
        <div class="grid grid-cols-1 xl:grid-cols-[minmax(0,1fr)_400px] gap-6 items-start">
            <div class="min-w-0 order-2 xl:order-1">
                <div class="bg-white overflow-hidden"> 
                    <div class="sm:px-3 pt-5 border-b-2 border-dashed border-gray-200"> 
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-5 mb-5"> 
                            <div class="flex items-center gap-4 min-w-0"> 
                                <div class="w-12 h-12 rounded-lg bg-primary flex items-center justify-center shrink-0"> 
                                    <i class="bx bxs-cart text-2xl text-white"></i> 
                                </div> 

                                <div class="min-w-0"> 
                                    <h1 class="text-black font-black text-2xl">Kasir</h1> 
                                    <p class="hidden sm:flex text-sm text-gray-500 font-medium mt-1"> 
                                        Pilih menu untuk membuat pesanan pelanggan. 
                                    </p> 
                                </div> 
                            </div>
                            <button
                                type="button"
                                @click="pesananMenunggu = true"
                                class="w-full sm:w-auto h-11 px-4 flex items-center justify-center gap-2 rounded-lg bg-gray-100 text-gray-600 hover:bg-gray-200 transition-all"
                            >
                                <i class="bx bx-time-five text-xl"></i>

                                <span class="text-xs font-black">
                                    Pesanan Menunggu
                                </span>

                                <span class="min-w-5 h-5 px-1.5 flex items-center justify-center rounded-full bg-primary text-white text-[10px] font-black">
                                    7
                                </span>
                            </button>
                        </div> 
                        <div class="flex flex-col md:flex-row gap-3 my-5"> 

                            <div class="relative w-full md:w-64"> 
                                <select  
                                    name="Kategori" 
                                    required 
                                    class="w-full h-12 px-4 pr-10 bg-white border border-gray-200 rounded-lg text-sm font-semibold text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary outline-none transition-all appearance-none cursor-pointer" 
                                > 
                                    <option value="" disabled selected>Pilih Kategori</option> 
                                    <option value="Makanan">Makanan</option> 
                                    <option value="Minuman">Minuman</option> 
                                </select> 

                                <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-gray-400"> 
                                    <i class="bx bx-chevron-down text-xl"></i> 
                                </div> 
                            </div> 

                            <div class="relative w-full flex-1"> 
                                <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-gray-400"> 
                                    <i class="bx bx-search text-xl"></i> 
                                </div> 

                                <input  
                                    type="search" 
                                    name="search" 
                                    value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" 
                                    oninput="doLiveSearch(this.value)" 
                                    class="w-full h-12 pl-11 pr-4 border border-gray-200 rounded-lg text-sm font-semibold text-slate-900 placeholder:text-gray-400 focus:bg-white focus:ring-2 focus:ring-primary outline-none transition-all" 
                                    placeholder="Cari nama menu..." 
                                > 
                            </div> 

                        </div> 

                    </div> 
                </div>

                <div class="sm:p-6 mt-6">
                    <div class="flex items-center justify-between pb-8">
                        <div>
                            <h2 class="text-xl font-black text-gray-900">Daftar Menu</h2>
                            <p class="text-xs text-gray-400 mt-1">Pilih menu untuk ditambahkan ke pesanan</p>
                        </div>

                        <div class="flex items-center gap-1 p-1 rounded-lg">
                            <a
                                href="?route=kasir&layoutMode=grid"
                                class="w-9 h-9 flex items-center justify-center rounded-lg transition-all <?= ($_GET['layoutMode'] ?? 'grid') == 'grid' ? 'bg-primary text-white shadow-sm' : 'text-gray-400 hover:text-gray-700' ?>"
                            >
                                <i class="bx bxs-grid text-lg"></i>
                            </a>

                            <a
                                href="?route=kasir&layoutMode=table"
                                class="w-9 h-9 flex items-center justify-center rounded-lg transition-all <?= ($_GET['layoutMode'] ?? 'grid') == 'table' ? 'bg-primary text-white shadow-sm' : 'text-gray-400 hover:text-gray-700' ?>"
                            >
                                <i class="bx bxs-rows text-lg"></i>
                            </a>
                        </div>
                    </div>

                    <?php if (($_GET['layoutMode'] ?? 'grid') == 'table'): ?>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="bg-slate-50">
                                        <th class="px-4 py-3 text-[11px] font-black text-gray-400 uppercase tracking-wider">No</th>
                                        <th class="px-4 py-3 text-[11px] font-black text-gray-400 uppercase tracking-wider">Foto</th>
                                        <th class="px-4 py-3 text-[11px] font-black text-gray-400 uppercase tracking-wider">Nama</th>
                                        <th class="px-4 py-3 text-[11px] font-black text-gray-400 uppercase tracking-wider">Kategori</th>
                                        <th class="px-4 py-3 text-[11px] font-black text-gray-400 uppercase tracking-wider">Harga</th>
                                        <th class="px-4 py-3 text-[11px] font-black text-gray-400 uppercase tracking-wider text-right">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-100">
                                    <tr class="group hover:bg-gray-50 transition-all">
                                        <td class="px-5 py-4 font-bold text-gray-500">1</td>

                                        <td class="px-5 py-4">
                                            <div class="w-11 h-11 rounded-full bg-gray-100 flex items-center justify-center shrink-0 overflow-hidden">
                                                <img
                                                    src="https://images.unsplash.com/photo-1603133872878-684f208fb84b?q=80&w=800&auto=format&fit=crop"
                                                    class="w-full h-full object-cover"
                                                    alt="Foto menu"
                                                >
                                            </div>
                                        </td>

                                        <td class="px-5 py-4">
                                            <span class="font-bold text-slate-800">Nasi Goreng Spesial</span>
                                        </td>

                                        <td>
                                            <span class="inline-flex items-center px-6 py-2 rounded-lg text-primary text-sm font-bold">
                                                Makanan
                                            </span>
                                        </td>

                                        <td class="px-5 py-4">
                                            <span class="font-bold text-slate-800">Rp 25.000</span>
                                        </td>

                                        <td class="px-5 py-4">
                                            <div class="flex items-center justify-center gap-2">
                                               <button
                                                    type="button"
                                                    onclick="showGlobalForm({
                                                        title: 'Edit Nama Barang',
                                                        message: 'Silakan ubah data barang berikut:',
                                                        actionUrl: '/barang/update',
                                                        method: 'POST',
                                                        type: 'info',
                                                        icon: 'pencil',
                                                        inputs: [
                                                            { 
                                                                label: 'Nama Barang', 
                                                                type: 'text', 
                                                                name: 'NamaBarang', 
                                                                value: 'Udin', 
                                                                placeholder: 'Contoh: Nasi Goreng' 
                                                            }
                                                        ]
                                                    })"
                                                    class="w-10 h-10 rounded-lg bg-primary text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all cursor-pointer"
                                                    title="Edit menu"
                                                >
                                                    <i class="bx bxs-pencil"></i>
                                                </button>

                                                <button
                                                    type="button"
                                                    onclick="hapusMenu(1)"                                                   
                                                    class="w-10 h-10 rounded-lg bg-red-500 text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all"
                                                    title="Hapus menu"
                                                >
                                                    <i class="bx bxs-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="flex flex-row sm:flex-col group bg-white border border-gray-200 rounded-lg overflow-hidden transition-all duration-200">
                                <div class="relative w-36 h-36 shrink-0 sm:w-full sm:h-48 overflow-hidden bg-gray-100">
                                    <img
                                        src="https://images.unsplash.com/photo-1603133872878-684f208fb84b?q=80&w=800&auto=format&fit=crop"
                                        loading="lazy"
                                        class="w-full h-full object-cover object-center group-hover:scale-105 transition duration-300"
                                        alt="Nasi Goreng Spesial"
                                    >

                                    <div class="absolute top-2.5 left-2.5 sm:top-3 sm:left-3">
                                        <span class="px-2.5 py-1 sm:px-3 sm:py-1.5 rounded-lg bg-primary text-[10px] sm:text-xs font-black text-white">
                                            Makanan
                                        </span>
                                    </div>
                                </div>

                                <div class="p-4 sm:p-5 flex-1 min-w-0 flex flex-col justify-between">
                                    <h3 class="font-black text-gray-900 text-base sm:text-lg line-clamp-2 leading-snug">
                                        Nasi Goreng Spesial
                                    </h3>

                                    <div class="flex items-end justify-between gap-3 mt-4 sm:mt-6 pt-2">
                                        <div class="min-w-0">
                                            <span class="text-[10px] uppercase tracking-wider font-bold text-gray-400 block mb-0.5">
                                                Harga
                                            </span>
                                            <span class="text-base sm:text-lg font-black text-gray-900 whitespace-nowrap">
                                                Rp 25.000
                                            </span>
                                        </div>

                                        <div class="flex gap-x-2.5">
                                             <button
                                                    type="button"
                                                    onclick="showGlobalForm({
                                                        title: 'Edit Nama Barang',
                                                        message: 'Silakan ubah data barang berikut:',
                                                        actionUrl: '/barang/update',
                                                        method: 'POST',
                                                        type: 'info',
                                                        icon: 'pencil',
                                                        inputs: [
                                                            { 
                                                                label: 'Nama Barang', 
                                                                type: 'text', 
                                                                name: 'NamaBarang', 
                                                                value: 'Udin', 
                                                                placeholder: 'Contoh: Nasi Goreng' 
                                                            }
                                                        ]
                                                    })"
                                                    class="w-10 h-10 rounded-lg bg-primary text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all cursor-pointer"
                                                    title="Edit menu"
                                                >
                                                    <i class="bx bxs-pencil"></i>
                                                </button>

                                            <button
                                                type="button"
                                                class="w-10 h-10 rounded-xl bg-red-600 text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all shrink-0"
                                                title="Hapus menu"
                                            >
                                                <i class="bx bxs-trash text-lg"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($data_barang)): ?>
                        <div class="w-full flex justify-center mt-6">
                            <nav aria-label="Pagination">
                                <ul class="flex items-center gap-1.5 bg-white rounded-full p-2">
                                    <li>
                                        <a
                                            href="?route=kasir&page=<?= max(1, $current - 1) ?>"
                                            class="flex items-center justify-center w-9 h-9 rounded-full text-gray-500 transition-all <?= $current <= 1 ? 'pointer-events-none opacity-40' : 'hover:bg-gray-100' ?>"
                                        >
                                            <i class="bx bxs-chevron-left"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a
                                            href="?route=kasir&page=1"
                                            class="flex items-center justify-center w-9 h-9 rounded-full text-sm <?= $current == 1 ? 'bg-primary text-white font-black' : 'text-gray-600 hover:bg-gray-100' ?>"
                                        >
                                            1
                                        </a>
                                    </li>

                                    <?php if ($last > 1): ?>
                                        <?php
                                        $start = max(2, $current - 1);
                                        $end = min($last - 1, $current + 1);
                                        ?>

                                        <?php if ($current > 3): ?>
                                            <li class="px-1 text-gray-400 text-sm">...</li>
                                        <?php endif; ?>

                                        <?php for ($i = $start; $i <= $end; $i++): ?>
                                            <li>
                                                <a
                                                    href="?route=kasir&page=<?= $i ?>"
                                                    class="flex items-center justify-center w-9 h-9 rounded-full text-sm transition-all <?= $current == $i ? 'bg-primary text-white font-black' : 'text-gray-600 hover:bg-gray-100' ?>"
                                                >
                                                    <?= $i ?>
                                                </a>
                                            </li>
                                        <?php endfor; ?>

                                        <?php if ($current < $last - 2): ?>
                                            <li class="px-1 text-gray-400 text-sm">...</li>
                                        <?php endif; ?>

                                        <li>
                                            <a
                                                href="?route=kasir&page=<?= $last ?>"
                                                class="flex items-center justify-center w-9 h-9 rounded-full text-sm transition-all <?= $current == $last ? 'bg-primary text-white font-black' : 'text-gray-600 hover:bg-gray-100' ?>"
                                            >
                                                <?= $last ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <li>
                                        <a
                                            href="?route=kasir&page=<?= min($last, $current + 1) ?>"
                                            class="flex items-center justify-center w-9 h-9 rounded-full text-gray-500 transition-all <?= $current >= $last ? 'pointer-events-none opacity-40' : 'hover:bg-gray-100' ?>"
                                        >
                                            <i class="bx bxs-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <aside class="w-full xl:sticky xl:top-6 xl:h-[calc(85vh)] order-1 xl:order-2">
                <div class="bg-white xl:h-full flex flex-col">
                    <div class="py-5 border-b-2 border-dashed border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-lg bg-primary flex items-center justify-center shrink-0">
                                    <i class="bx bxs-basket text-2xl text-white"></i>
                                </div>

                                <div>
                                    <h2 class="text-lg font-black text-gray-900">
                                        Pesanan
                                        <span class="px-2 py-1 rounded-full bg-primary text-white text-[10px] font-black">3</span>
                                    </h2>
                                    <p class="text-xs text-gray-400 mt-1">Daftar menu yang dipilih</p>
                                </div>
                            </div>

                            <button 
                            type="button"
                            onclick="showGlobalForm({
                                title: 'Hapus Barang',
                                message: 'Silakan hapus barang berikut',
                                actionUrl: '/barang/update',
                                method: 'POST',
                                type: 'danger',
                                icon: 'trash',
                            })"
                            class="w-10 h-10 rounded-lg bg-rose-600 text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all cursor-pointer"
                            title="Edit menu"
                                                >
                                <i class="bx bxs-trash text-lg text-white"></i>
                            </button>
                        </div>

                        <div class="w-full mt-6">
                            <div class="flex items-center gap-1 bg-gray-100 rounded-lg">
                                <label
                                    class="flex-1 relative flex items-center justify-center gap-2 px-4 py-3 rounded-md cursor-pointer select-none transition-all duration-150"
                                    :class="StepJenisPesanan === '' || StepJenisPesanan === 'DineIn'
                                        ? 'bg-primary text-white shadow-sm'
                                        : 'text-gray-500 hover:text-gray-700'"
                                >
                                    <input
                                        type="radio"
                                        name="jenis_pemesanan"
                                        value="DineIn"
                                        x-model="StepJenisPesanan"
                                        class="sr-only"
                                    >
                                    <i class="bx bx-fork-spoon text-lg"></i>
                                    <span class="text-sm font-bold">Dine In</span>
                                </label>

                                <label
                                    class="flex-1 relative flex items-center justify-center gap-2 px-4 py-3 rounded-md cursor-pointer select-none transition-all duration-150"
                                    :class="StepJenisPesanan === 'Takeaway'
                                        ? 'bg-primary text-white shadow-sm'
                                        : 'text-gray-500 hover:text-gray-700'"
                                >
                                    <input
                                        type="radio"
                                        name="jenis_pemesanan"
                                        value="Takeaway"
                                        x-model="StepJenisPesanan"
                                        class="sr-only"
                                    >
                                    <i class="bx bxs-shopping-bag text-lg"></i>
                                    <span class="text-sm font-bold">Takeaway</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 min-h-0 overflow-y-auto py-4 border-b border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-14 h-14 rounded-lg bg-gray-100 flex items-center justify-center shrink-0">
                                <i class="bx bxs-coffee text-2xl text-gray-400"></i>
                            </div>

                            <div class="flex-1 min-w-0">
                                <h4 class="font-black text-gray-900 text-sm truncate">Es Kopi Susu</h4>
                                <p class="text-xs font-bold text-gray-900">
                                    Rp<span x-text="hargaSatuan.toLocaleString('id-ID')"></span>
                                </p>
                            </div>

                            <div class="relative">
                                <button
                                    type="button"
                                    @click="menuOpen = !menuOpen"
                                    @click.outside="menuOpen = false"
                                    class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:bg-gray-100 hover:text-gray-700 transition-all"
                                >
                                    <i class="bx bx-dots-vertical-rounded text-xl"></i>
                                </button>

                                <div
                                    x-show="menuOpen"
                                    x-transition
                                    x-cloak
                                    class="absolute right-0 top-9 z-30 w-44 bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden"
                                >
                                    <button
                                        type="button"
                                        @click="diskonOpen = true; menuOpen = false"
                                        class="w-full flex items-center gap-3 px-4 py-3 text-xs font-bold text-gray-700 hover:bg-gray-50 transition"
                                    >
                                        <i class="bx bxs-discount text-base text-primary"></i>
                                        Tambah Diskon
                                    </button>

                                    <button
                                        type="button"
                                        @click="catatanOpen = true; menuOpen = false"
                                        class="w-full flex items-center gap-3 px-4 py-3 text-xs font-bold text-gray-700 hover:bg-gray-50 transition"
                                    >
                                        <i class="bx bxs-note text-base text-primary"></i>
                                        Tambah Catatan
                                    </button>
                                </div>
                            </div>

                            <button
                                type="button"
                                title="Hapus Item"
                                class="w-7 h-7 flex items-center justify-center text-gray-300 hover:text-red-500 transition-all shrink-0"
                            >
                                <i class="bx bxs-x-circle text-xl"></i>
                            </button>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <span class="text-[11px] text-gray-500 font-medium">Jumlah</span>

                            <div class="flex items-center gap-2">
                                <button
                                    type="button"
                                    @click="qty = Math.max(1, qty - 1)"
                                    class="w-7 h-7 rounded-lg bg-gray-100 text-gray-600 flex items-center justify-center hover:bg-gray-200 transition active:scale-95"
                                >
                                    <i class="bx bxs-minus text-xs"></i>
                                </button>

                                <input
                                    type="number"
                                    x-model.number="qty"
                                    @input="if (qty > 99) qty = 99; if (qty < 1 || isNaN(qty)) qty = 1;"
                                    min="1"
                                    max="9999"
                                    class="w-14 text-center text-sm font-black text-gray-800 bg-transparent border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary py-0.5 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                >

                                <button
                                    type="button"
                                    @click="qty = Math.min(99, qty + 1)"
                                    class="w-7 h-7 rounded-lg bg-primary text-white flex items-center justify-center hover:opacity-90 transition active:scale-95"
                                >
                                    <i class="bx bxs-plus text-xs"></i>
                                </button>
                            </div>
                        </div>

                        <div x-show="diskonOpen" x-transition x-cloak class="mt-3 pt-3 border-t border-dashed border-gray-100">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="text-[11px] font-bold text-gray-500">Diskon</span>
                                    <button
                                        type="button"
                                        @click="diskonOpen = false; diskonNilai = 0"
                                        class="text-gray-300 hover:text-red-500"
                                    >
                                        <i class="bx bx-x text-sm"></i>
                                    </button>
                                </div>

                                <div class="relative">
                                    <span class="absolute left-2 top-1.5 text-[10px] font-bold text-gray-400">Rp</span>
                                    <input
                                        type="number"
                                        x-model.number="diskonNilai"
                                        @input="if (diskonNilai < 0 || isNaN(diskonNilai)) diskonNilai = 0; if (diskonNilai > subtotalSebelumDiskon) diskonNilai = subtotalSebelumDiskon;"
                                        min="0"
                                        :max="subtotalSebelumDiskon"
                                        placeholder="0"
                                        class="w-24 pl-6 pr-2 py-1 text-right text-xs font-bold text-gray-800 bg-white border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                    >
                                </div>
                            </div>
                        </div>

                        <div x-show="catatanOpen" x-transition x-cloak class="mt-3 pt-3 border-t border-dashed border-gray-100">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-[11px] font-bold text-gray-500">Catatan</span>

                                <button
                                    type="button"
                                    @click="catatanOpen = false; catatan = ''"
                                    class="text-gray-300 hover:text-red-500"
                                >
                                    <i class="bx bx-x text-sm"></i>
                                </button>
                            </div>

                            <textarea
                                x-model="catatan"
                                rows="2"
                                placeholder="Contoh: Es sedikit gula..."
                                class="w-full px-3 py-2 text-xs font-semibold text-gray-800 bg-white border border-gray-200 rounded-lg resize-none focus:outline-none focus:ring-2 focus:ring-primary placeholder:text-gray-300"
                            ></textarea>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 py-5 shrink-0">
                        <div class="space-y-2.5">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-400">Subtotal</span>
                                <span class="font-black text-gray-700">
                                    Rp<span x-text="subtotal.toLocaleString('id-ID')"></span>
                                </span>
                            </div>

                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-400">Diskon</span>
                                <span class="font-bold text-gray-700">Rp0</span>
                            </div>
                        </div>

                        <div class="flex items-end justify-between mt-5 pt-4 border-t border-dashed border-gray-200">
                            <div>
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Total</span>
                                <span class="text-2xl font-black text-gray-900">Rp68.000</span>
                            </div>
                        </div>

                        <div class="flex flex-col gap-2 mt-6">
                            <div class="flex flex-col sm:flex-row items-center gap-4">
                                <div x-show="tambahUser === false" x-transition class="relative flex items-center w-full">
                                    <div class="absolute left-4 flex items-center pointer-events-none text-gray-400 z-10">
                                        <i class="bx bx-user text-lg"></i>
                                    </div>

                                    <select
                                        x-model="pelanggan"
                                        required
                                        class="w-full pl-12 pr-10 py-3 bg-white text-gray-900 text-sm font-bold rounded-lg border-2 border-gray-200 focus:outline-none focus:ring focus:border-primary focus:ring-primary appearance-none cursor-pointer transition-colors"
                                    >
                                        <option value="" disabled>Pilih Pelanggan</option>
                                        <option value="Jamal">Jamal</option>
                                        <option value="Udin">Udin</option>
                                    </select>

                                    <div class="absolute right-4 flex items-center pointer-events-none text-gray-900">
                                        <i class="bx bx-chevron-down text-xl"></i>
                                    </div>
                                </div>

                                <div x-show="tambahUser === true" x-transition class="flex flex-col gap-2 w-full">
                                    <div class="relative flex items-center w-full">
                                        <div class="absolute left-4 flex items-center pointer-events-none text-gray-400">
                                            <i class="bx bx-user-plus text-lg"></i>
                                        </div>

                                        <input
                                            type="text"
                                            placeholder="Saiful Anwar"
                                            class="w-full pl-12 pr-4 py-3 bg-white text-gray-900 text-sm font-bold rounded-lg border-2 border-gray-200 focus:outline-none focus:ring focus:border-primary focus:ring-primary transition-colors placeholder:text-gray-300"
                                        >
                                    </div>
                                </div>

                                <button
                                    type="button"
                                    x-show="tambahUser === false"
                                    @click="tambahUser = true"
                                    class="w-full sm:w-auto flex items-center justify-center bg-primary text-white font-black p-3.5 gap-2 rounded-lg cursor-pointer transition-all shadow-md"
                                >
                                    <i class="bx bx-user-plus text-xl"></i>
                                </button>

                                <button
                                    type="button"
                                    x-show="tambahUser === true"
                                    @click="tambahUser = false"
                                    class="w-full sm:w-auto flex items-center justify-center bg-primary text-white font-black p-3.5 gap-2 rounded-lg cursor-pointer transition-all shadow-md"
                                >
                                    <i class="bx bx-x text-xl"></i>
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <button
                                type="button"
                                @click="open = true"
                                class="w-full flex-1 flex items-center justify-center bg-gray-100 text-gray-500 font-black px-8 py-3.5 gap-2 rounded-lg cursor-pointer transition-all shadow-sm mt-4"
                            >
                                <i class="bx bxs-wallet-alt text-xl"></i>
                            </button>

                            <button
                                type="button"
                                onclick="showToast({ type: 'success', message: 'Pesanan Berhasil Disimpan!' })"
                                class="w-full flex items-center justify-center bg-primary text-white font-black px-8 py-3.5 gap-2 rounded-lg cursor-pointer transition-all shadow-md mt-4"
                            >
                                <i class="bx bxs-basket text-xl"></i>
                                Simpan Pesanan
                            </button>
                        </div>
                    </div>
                </div>
            </aside>
        </div>

        <div 
            x-show="open"
            x-cloak
            @keydown.escape.window="open = false"
            class="fixed inset-0 z-[999] flex justify-center items-center w-full p-4 sm:p-6 overflow-y-auto">

            <div 
                x-show="open"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-500/20 backdrop-blur-sm"
                @click="open = false">
            </div>

            <div 
                x-show="open"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4 sm:translate-y-2"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-4 sm:translate-y-2"
                class="relative w-full max-w-4xl z-10 my-auto">

                <div class="relative bg-white border border-gray-200 rounded-lg shadow-2xl p-6 sm:p-10 max-h-[calc(100vh-2rem)] overflow-y-auto">
                    <div class="mb-6 flex justify-between items-start sm:items-center gap-4">
                        <div class="flex items-center gap-4 min-w-0">
                            <div class="flex w-12 h-12 rounded-lg bg-primary items-center justify-center shrink-0">
                                <i class="bx bx-store-alt text-2xl text-white"></i>
                            </div>
                            <div class="min-w-0">
                                <h1 class="text-gray-900 font-black text-xl sm:text-2xl uppercase tracking-tight">
                                    Kasir - Pembayaran
                                </h1>
                                <p class="text-xs sm:text-sm text-gray-500 font-medium mt-1">
                                    Selesaikan transaksi pesanan pelanggan.
                                </p>
                            </div>
                        </div>
                        <button type="button" @click="open = false" title="Tutup"
                            class="flex items-center justify-center w-11 h-11 rounded-full bg-gray-100 border border-gray-200 text-gray-400 hover:text-white hover:bg-primary font-black cursor-pointer transition-all shrink-0"    >
                            <i class="bx bx-x text-2xl"></i>
                        </button>
                    </div>
                    <div class="w-full my-8 pb-8 border-b-2 border-dashed border-gray-300 text-center">
                        <span class="text-xs font-bold uppercase tracking-[0.2em] text-gray-400 mb-2">
                            Total Tagihan
                        </span>
                        <h2 class="text-4xl sm:text-5xl font-black text-primary tracking-tighter" x-text="'Rp' + (total || 0).toLocaleString('id-ID')">
                            Rp0
                        </h2> 

                        <!-- <div class="flex items-center w-full mt-6">
                            <div class="flex items-center flex-1">
                                <span class="flex items-center justify-center w-12 h-12 bg-primary text-white rounded-full shrink-0">
                                    <i class="bx bx-store text-xl"></i>
                                </span>

                                <div class="h-1 flex-1 mx-4 bg-primary rounded-full"></div>
                            </div>

                            <div class="flex items-center flex-1">
                                <span class="flex items-center justify-center w-12 h-12 bg-transparent border-2 border-gray-300 rounded-full shrink-0">
                                    <i class="bx bx-user-id-card"></i>
                                </span>

                                <div class="h-1 flex-1 mx-4 bg-gray-300 rounded-full"></div>
                            </div>

                            <div class="flex items-center">
                                <span class="flex items-center justify-center w-12 h-12 bg-transparent border-2 border-gray-300 rounded-full shrink-0">
                                    <i class="bx bx-wallet"></i>
                                </span>
                            </div>
                        </div> -->
                    </div>
                    

                    
                    <div class="grid grid-cols-1 gap-8">

                        <div class="flex flex-col gap-6">

                            <div x-show="StepPembayaran === false" class="flex flex-col gap-3">
                                <div class="grid grid-cols-1">
                                    <div class="flex flex-col gap-4">
                                        <label class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-900">
                                            1. Metode Pembayaran <span class="text-red-500">*</span>
                                        </label>                        
                                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">

                                            <label
                                                class="relative flex flex-col items-center justify-center p-4 rounded-lg border-2 cursor-pointer transition-all duration-150 select-none text-center bg-white"
                                                :class="metode === 'Tunai'
                                                    ? 'border-primary ring-1 ring-primary text-primary shadow-sm'
                                                    : 'border-gray-200 text-gray-500 hover:border-gray-300 hover:text-primary'"
                                                >
                                                <input
                                                    type="radio"
                                                    name="metode_pembayaran"
                                                    value="Tunai"
                                                    x-model="metode"
                                                    class="sr-only"
                                                >
                                                <i class="bx bx-currency-note text-2xl mb-2"></i>        
                                                <span class="text-xs font-bold uppercase">
                                                    Tunai
                                                </span>
                                            </label>

                                            <label
                                                class="relative flex flex-col items-center justify-center p-4 rounded-lg border-2 cursor-pointer transition-all duration-150 select-none text-center bg-white"
                                                :class="metode === 'Transfer'
                                                    ? 'border-primary ring-1 ring-primary text-primary shadow-sm'
                                                    : 'border-gray-200 text-gray-500 hover:border-gray-300 hover:text-primary'">
                                                <input
                                                    type="radio"
                                                    name="metode_pembayaran"
                                                    value="Transfer"
                                                    x-model="metode"
                                                    class="sr-only"
                                                >                    
                                                <i class="bx bx-arrow-left-right text-2xl mb-2"></i>                    
                                                <span class="text-xs font-bold uppercase">
                                                    Transfer
                                                </span>
                                            </label>
                                            
                                            <label
                                                class="relative flex flex-col items-center justify-center p-4 rounded-lg border-2 cursor-pointer transition-all duration-150 select-none text-center bg-white"
                                                :class="metode === 'E-Wallet'
                                                    ? 'border-primary ring-1 ring-primary text-primary shadow-sm'
                                                    : 'border-gray-200 text-gray-500 hover:border-gray-300 hover:text-primary'"
                                            >
                                                <input
                                                    type="radio"
                                                    name="metode_pembayaran"
                                                    value="E-Wallet"
                                                    x-model="metode"
                                                    class="sr-only"
                                                >                        
                                                <i class="bx bx-wallet text-2xl mb-2"></i>                        
                                                <span class="text-xs font-bold uppercase">
                                                    E-Wallet
                                                </span>
                                            </label>

                                            <label
                                                class="relative flex flex-col items-center justify-center p-4 rounded-lg border-2 cursor-pointer transition-all duration-150 select-none text-center bg-white"
                                                :class="metode === 'Card'
                                                    ? 'border-primary ring-1 ring-primary text-primary shadow-sm'
                                                    : 'border-gray-200 text-gray-500 hover:border-gray-300 hover:text-primary'"
                                            >
                                                <input
                                                    type="radio"
                                                    name="metode_pembayaran"
                                                    value="Card"
                                                    x-model="metode"
                                                    class="sr-only"
                                                >                        
                                                <i class="bx bx-credit-card text-2xl mb-2"></i>                        
                                                <span class="text-xs font-bold uppercase">
                                                    Card
                                                </span>
                                            </label>

                                            <label
                                                class="relative flex flex-col items-center justify-center p-4 rounded-lg border-2 cursor-pointer transition-all duration-150 select-none text-center bg-white col-span-2"
                                                :class="metode === 'Hutang'
                                                    ? 'border-primary ring-1 ring-primary text-primary shadow-sm'
                                                    : 'border-gray-200 text-gray-500 hover:border-gray-300 hover:text-primary'"
                                            >
                                                <input
                                                    type="radio"
                                                    name="metode_pembayaran"
                                                    value="Hutang"
                                                    x-model="metode"
                                                    class="sr-only"
                                                >                        
                                                <i class="bx bx-minus-circle text-2xl mb-2"></i>                        
                                                <span class="text-xs font-bold uppercase">
                                                    Hutang
                                                </span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="flex flex-row gap-6 mt-3">                                        
                                         <div 
                                            x-show="['E-Wallet'].includes(metode)"
                                            x-transition
                                            class="flex-1 flex-col gap-2"
                                        >
                                            <label class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-900">
                                                2. E-Wallet Tujuan <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative flex items-center w-full mt-2">
                                                <div class="absolute left-4 flex items-center pointer-events-none text-gray-400 z-10">
                                                    <i class="bx bx-building-house text-lg"></i>
                                                </div>
                                                <select 
                                                    x-model="bank"
                                                    class="w-full pl-12 pr-10 py-3.5 bg-white text-gray-900 text-sm font-bold rounded-lg border-2 border-gray-200 focus:outline-none focus:border-primary focus:ring focus:ring-primary appearance-none cursor-pointer transition-colors"
                                                >
                                                    <option value="" selected disabled>Pilih Bank</option>
                                                    <option value="Dana">Dana</option>
                                                    <option value="OVO">OVO</option>
                                                </select>
                                                <div class="absolute right-4 flex items-center pointer-events-none text-gray-900">
                                                    <i class="bx bx-chevron-down text-xl"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div 
                                            x-show="['Transfer'].includes(metode)"
                                            x-transition
                                            class="flex-1 flex-col gap-2"
                                        >
                                            <label class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-900">
                                                2. Bank Tujuan <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative flex items-center w-full mt-2">
                                                <div class="absolute left-4 flex items-center pointer-events-none text-gray-400 z-10">
                                                    <i class="bx bx-building-house text-lg"></i>
                                                </div>
                                                <select 
                                                    x-model="bank"
                                                    class="w-full pl-12 pr-10 py-3.5 bg-white text-gray-900 text-sm font-bold rounded-lg border-2 border-gray-200 focus:outline-none focus:border-primary focus:ring focus:ring-primary appearance-none cursor-pointer transition-colors"
                                                >
                                                    <option value="" selected disabled>Pilih Bank</option>
                                                    <option value="BNI">Bank BNI</option>
                                                    <option value="BCA">Bank BCA</option>
                                                </select>
                                                <div class="absolute right-4 flex items-center pointer-events-none text-gray-900">
                                                    <i class="bx bx-chevron-down text-xl"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div 
                                            x-show="['Card'].includes(metode)"
                                            x-transition
                                            class="flex-1 flex-col gap-2"
                                        >
                                            <label class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-900">
                                                2. Kartu Tujuan <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative flex items-center w-full mt-2">
                                                <div class="absolute left-4 flex items-center pointer-events-none text-gray-400 z-10">
                                                    <i class="bx bx-building-house text-lg"></i>
                                                </div>
                                                <select 
                                                    x-model="card"
                                                    class="w-full pl-12 pr-10 py-3.5 bg-white text-gray-900 text-sm font-bold rounded-lg border-2 border-gray-200 focus:outline-none focus:border-primary focus:ring focus:ring-primary appearance-none cursor-pointer transition-colors"
                                                >
                                                    <option value="" selected disabled>Pilih Kartu</option>
                                                    <option value="Debit">Debit</option>
                                                    <option value="Kredit">Kredit</option>
                                                </select>
                                                <div class="absolute right-4 flex items-center pointer-events-none text-gray-900">
                                                    <i class="bx bx-chevron-down text-xl"></i>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div 
                                            x-show="['Tunai'].includes(metode)"
                                            x-transition
                                            class="flex-1 flex-col gap-2"
                                        >
                                            <label class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-900">
                                                2. Nominal Diterima <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative flex items-center w-full mt-2">
                                                <div class="absolute left-4 flex items-center pointer-events-none text-gray-400 font-bold">
                                                    Rp
                                                </div>
                                                <input 
                                                    type="number"
                                                    x-model.number="nominal"
                                                    min="0"
                                                    placeholder="0"
                                                    class="w-full pl-12 pr-4 py-3 bg-white text-gray-900 text-lg font-black rounded-lg border-2 border-gray-200 focus:outline-none focus:ring focus:border-primary focus:ring-primary transition-colors placeholder:text-gray-300"
                                                >
                                            </div>
                                        </div>
                        
                                    </div>
                                </div>
                            </div>           
                           
                        </div>

                    </div>

                    <!-- <div x-show="['Tunai', 'QRIS', 'Transfer', 'E-Wallet', 'Card'].includes(metode)" class="p-4 rounded-lg border border-gray-200 flex items-center justify-between">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wide text-primary">
                                Total Akhir
                            </span>
                            <p class="text-[10px] text-gray-500 font-semibold">
                                Hemat Rp10.000
                            </p>
                        </div>
                        <span class="text-xl font-black text-primary tracking-tight">
                            Rp140.000
                        </span>
                    </div> -->
                    <div x-show="metode === 'Tunai'" class="mt-4 relative overflow-hidden p-4 rounded-lg flex items-center justify-between border-2 border-dashed border-primary bg-white">
                        <div class="space-y-1 z-10">
                            <div class="flex items-center gap-1.5 text-primary font-black text-sm uppercase tracking-widest">
                                <span>Kembalian</span>
                            </div>

                            <p class="text-[10px] uppercase text-gray-500 font-bold tracking-wider">
                                Uang Tunai
                            </p>
                        </div>

                        <div class="z-10 text-right">
                            <span class="text-2xl sm:text-xl font-black text-primary tracking-tighter">
                                Rp10.000
                            </span>
                        </div>
                    </div>
               
                    <div class="w-full flex flex-col-reverse sm:flex-row justify-end mt-10 pt-6 border-t-2 border-gray-100 gap-4">
                        <button 
                            type="button"
                            @click="open = false"
                            class="w-full sm:w-auto flex items-center justify-center bg-white border-2 border-gray-200 hover:ring-2 hover:ring-primary text-gray-900 font-bold px-8 py-4 rounded-lg cursor-pointer transition-all active:scale-95"
                        >
                            Batal
                        </button>

                        <button             
                            type="button"
                            @click="open = false"
                            :disabled="metode === '' ||
                            (metode === 'Tunai' && nominal < total) ||
                            (['Transfer', 'E-Wallet'].includes(metode) && bank === '') ||
                            (metode === 'Card' && card === '')"
                            :class="metode === '' ||
                            (metode === 'Tunai' && nominal < total) ||
                            (['Transfer', 'E-Wallet'].includes(metode) && bank === '') ||
                            (metode === 'Card' && card === '')
                                    ? 'opacity-30 cursor-not-allowed'
                                    : 'hover:bg-hover-primary active:scale-95'"
                            class="w-full sm:w-auto flex items-center justify-center bg-primary text-white font-black px-8 py-4 gap-2 rounded-lg cursor-pointer transition-all shadow-md"
                        >
                            <i class="bx bxs-basket text-xl"></i>
                            <span>KONFIRMASI</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div
            x-show="pesananMenunggu"
            x-cloak
            x-transition.opacity
            @keydown.escape.window="pesananMenunggu = false"
            class="fixed inset-0 z-[999] flex items-center justify-center p-4 bg-black/40"
        >
            <div
                x-show="pesananMenunggu"
                x-transition
                @click.outside="pesananMenunggu = false"
                class="w-full max-w-2xl bg-white rounded-xl shadow-xl overflow-hidden"
            >

                <div class="mb-6 sm:mb-8 flex justify-between items-start sm:items-center gap-4 p-8 pb-0">
                    <div class="flex items-center gap-3 sm:gap-4 min-w-0">
                        <div class="flex w-12 h-12 rounded-lg bg-primary items-center justify-center shrink-0 shadow-sm">
                            <i class="bx bxs-receipt text-2xl text-white"></i>
                        </div>
                        <div class="min-w-0">    
                            <div class="flex items-center gap-2 sm:gap-3 flex-wrap">
                                <h1 class="text-slate-900 font-black text-xl sm:text-2xl leading-tight">
                                    Pesanan Menunggu
                                </h1>
                            </div>    
                            <p class="text-xs sm:text-sm text-gray-500 font-medium mt-1">
                                Kelola pesanan yang menunggu untuk di bayar.
                            </p>    
                        </div>    
                    </div>    
                    <button type="button" @click="pesananMenunggu = false" title="Tutup"
                        class="flex items-center justify-center w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-slate-100 text-slate-500 hover:text-white hover:bg-primary font-black cursor-pointer transition-colors shrink-0"                    >
                        <i class="bx bx-x text-2xl"></i>
                    </button>
                </div>

                <div class="max-h-[60vh] overflow-y-auto">
                    <div class="px-10 py-5 border-b border-gray-100">
                        <div class="flex items-center justify-between gap-4">
                            <div class="min-w-0">
                                <span class="text-[10px] font-black uppercase tracking-wider text-gray-400">
                                    No. Transaksi
                                </span>
                                <h3 class="text-sm font-black text-gray-900 mt-1">
                                    TRX-20260828-001
                                </h3>
                                <div class="flex flex-wrap items-center gap-x-5 gap-y-2 mt-3">
                                    <div>
                                        <span class="text-[10px] text-gray-400 font-medium block">
                                            Pelanggan
                                        </span>
                                        <span class="text-sm font-bold text-gray-700">
                                            Jamal
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-[10px] text-gray-400 font-medium block">
                                            Total
                                        </span>
                                        <span class="text-sm font-black text-gray-900">
                                            Rp68.000
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 shrink-0">
                                <button
                                    type="button"
                                    @click="open = true; pesananMenunggu = false"
                                    class="h-10 px-4 rounded-lg bg-primary text-white text-xs font-black flex items-center gap-2 hover:opacity-90 active:scale-95 transition-all"
                                >
                                    <i class="bx bxs-wallet-alt text-base"></i>
                                    Bayar
                                </button>
                                <button
                                    type="button"
                                    class="h-10 px-4 rounded-lg bg-gray-100 text-gray-600 text-xs font-black flex items-center gap-2 hover:bg-gray-200 active:scale-95 transition-all"
                                >
                                    <i class="bx bx-time-five text-base"></i>
                                    Jadikan Piutang
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="px-10 py-5 border-b border-gray-100">
                        <div class="flex items-center justify-between gap-4">
                            <div class="min-w-0">
                                <span class="text-[10px] font-black uppercase tracking-wider text-gray-400">
                                    No. Transaksi
                                </span>
                                <h3 class="text-sm font-black text-gray-900 mt-1">
                                    TRX-20260828-002
                                </h3>
                                <div class="flex flex-wrap items-center gap-x-5 gap-y-2 mt-3">
                                    <div>
                                        <span class="text-[10px] text-gray-400 font-medium block">
                                            Pelanggan
                                        </span>
                                        <span class="text-sm font-bold text-gray-700">
                                            Udin
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-[10px] text-gray-400 font-medium block">
                                            Total
                                        </span>
                                        <span class="text-sm font-black text-gray-900">
                                            Rp45.000
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 shrink-0">
                                <button
                                    type="button"
                                    @click="open = true; pesananMenunggu = false"
                                    class="h-10 px-4 rounded-lg bg-primary text-white text-xs font-black flex items-center gap-2 hover:opacity-90 active:scale-95 transition-all"
                                >
                                    <i class="bx bxs-wallet-alt text-base"></i>
                                    Bayar
                                </button>
                                <button
                                    type="button"
                                    class="h-10 px-4 rounded-lg bg-gray-100 text-gray-600 text-xs font-black flex items-center gap-2 hover:bg-gray-200 active:scale-95 transition-all"
                                >
                                    <i class="bx bx-time-five text-base"></i>
                                    Jadikan Piutang
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="px-10 py-5">
                        <div class="flex items-center justify-between gap-4">
                            <div class="min-w-0">
                                <span class="text-[10px] font-black uppercase tracking-wider text-gray-400">
                                    No. Transaksi
                                </span>
                                <h3 class="text-sm font-black text-gray-900 mt-1">
                                    TRX-20260828-003
                                </h3>
                                <div class="flex flex-wrap items-center gap-x-5 gap-y-2 mt-3">
                                    <div>
                                        <span class="text-[10px] text-gray-400 font-medium block">
                                            Pelanggan
                                        </span>
                                        <span class="text-sm font-bold text-gray-700">
                                            Saiful Anwar
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-[10px] text-gray-400 font-medium block">
                                            Total
                                        </span>
                                        <span class="text-sm font-black text-gray-900">
                                            Rp92.000
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 shrink-0">
                                <button
                                    type="button"
                                    @click="open = true; pesananMenunggu = false"
                                    class="h-10 px-4 rounded-lg bg-primary text-white text-xs font-black flex items-center gap-2 hover:opacity-90 active:scale-95 transition-all"
                                >
                                    <i class="bx bxs-wallet-alt text-base"></i>
                                    Bayar
                                </button>
                                <button
                                    type="button"
                                    class="h-10 px-4 rounded-lg bg-gray-100 text-gray-600 text-xs font-black flex items-center gap-2 hover:bg-gray-200 active:scale-95 transition-all"
                                >
                                    <i class="bx bx-time-five text-base"></i>
                                    Jadikan Piutang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
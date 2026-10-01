<section id="Kasir">
    <div 
       x-init="
            $watch('open', value => {
                document.body.classList.toggle('overflow-hidden', value)
            });

            $watch('metode', value => {
                nominal = 0;
                bank = '';
                ewallet = '';
                card = '';

                const input = document.getElementById('nominal');

                if (input) {
                    input.value = '';
                }

                updatePayment(
                idTransaksiMenunggu !== null ? total : null
                );
            });
        "
        @buka-pembayaran.window = "idTransaksiMenunggu = null; total = Number($event.detail.total) || 0; open = true; updatePayment(total);"
        @tutup-pembayaran.window = "open = false"
        @buka-pembayaran-menunggu.window="
            idTransaksiMenunggu = $event.detail.idTransaksi;
            total = Number($event.detail.total) || 0;
            nominal = 0;
            pesananMenunggu = false;
            open = true;
            updatePayment(total);
        "
        x-data="{ 
            idTransaksiMenunggu: null,
            layoutModeToggle: $persist(true), 
            filterToggle: $persist(true), 
            open: false,
            tambahUser: false,

            modalPiutang: false,
            idTransaksiPiutang: null,
            pelangganPiutang: '',

            total: 0,
            nominal: 0,

            idPelanggan: null,
            namaPelanggan: '',

            metode: '',
            bank: '',
            ewallet: '',
            card: '',
            
            pesananMenunggu: false,        

            StepJenisPesanan: '',
            StepDataDiri: false,
            StepPembayaran: false,

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

        }">
        
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
                                    <?= $jumlahPesananMenunggu ?>
                                </span>
                            </button>
                        </div> 
                        <form method="GET" autocomplete="off">
                            <input type="hidden" name="route" value="<?= htmlspecialchars($_GET['route'] ?? '')?>">
                            <div class="flex flex-col md:flex-row gap-3 my-5"> 
                                <div class="relative w-full md:w-64"> 
                                    <select  
                                        name="kategorif" 
                                        required 
                                        class="w-full h-12 px-4 pr-10 bg-white border border-gray-200 rounded-lg text-sm font-semibold text-slate-900 focus:bg-white focus:ring-2 focus:ring-primary outline-none transition-all appearance-none cursor-pointer" 
                                        onchange="this.form.submit()"
                                    > 
                                        <option value="" disabled selected>Pilih Kategori</option> 
                                        <?php foreach($kategori as $d): ?>
                                            <option value="<?= $d['id_kategori'] ?>" <?= $kategorif == $d['id_kategori'] ? 'selected' :'' ?>><?= $d['nama_kategori'] ?></option>
                                        <?php endforeach; ?>
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
                                        name="cari" 
                                        class="input-delay w-full h-12 pl-11 pr-4 border border-gray-200 rounded-lg text-sm font-semibold text-slate-900 placeholder:text-gray-400 focus:bg-white focus:ring-2 focus:ring-primary outline-none transition-all" 
                                        placeholder="Cari nama menu..." 
                                        value="<?= htmlspecialchars($_GET['cari'] ?? '')?>"
                                    > 
                                </div> 
                            </div> 
                        </form>

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
                    <?php if(mysqli_num_rows($data)): ?>
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
                                    <?php while($d = mysqli_fetch_assoc($data)): ?>
                                    <tr class="group hover:bg-gray-50 transition-all">
                                        <td class="px-5 py-4 font-bold text-gray-500"><?= $no++ ?></td>

                                        <td class="px-5 py-4">
                                            <div class="w-11 h-11 rounded-full bg-gray-100 flex items-center justify-center shrink-0 overflow-hidden">
                                                <?php if (!empty($d['foto'])): ?>
                                                    <img
                                                        src="public/images/<?= htmlspecialchars($d['foto']); ?>"
                                                        class="w-full h-full object-cover"
                                                        alt="<?= htmlspecialchars($d['nama']); ?>">
                                                <?php else: ?>
                                                    <i class="bx bxs-bowl-hot text-xl text-gray-400"></i>
                                                <?php endif; ?>
                                            </div>
                                        </td>

                                        <td class="px-5 py-4">
                                            <span class="font-bold text-slate-800"><?= $d['nama'] ?></span>
                                        </td>

                                        <td>
                                            <span class="inline-flex items-center px-6 py-2 rounded-lg text-primary text-sm font-bold">
                                                <?= $d['nama_kategori'] ?>
                                            </span>
                                        </td>

                                        <td class="px-5 py-4">
                                            <span class="font-bold text-slate-800">Rp <?= number_format($d['harga'], 0, ',', '.') ?></span>
                                        </td>

                                        <td class="px-5 py-4">
                                            <div class="flex items-center justify-center gap-2">
                                               <button
                                                    type="button"
                                                    onclick='addMenu(<?= json_encode($d, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>)'
                                                    class="w-10 h-10 rounded-lg bg-primary text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all cursor-pointer"
                                                >
                                                    <i class="bx bxs-plus"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                            <?php endif; ?>
                    <?php else: ?>
                        <?php if(mysqli_num_rows($data)): ?>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                <?php while($d = mysqli_fetch_assoc($data)): ?>
                                <div class="flex flex-row sm:flex-col group bg-white border border-gray-200 rounded-lg overflow-hidden transition-all duration-200">
                                    <div class="relative w-36 h-36 shrink-0 sm:w-full sm:h-48 overflow-hidden bg-gray-100">
                                        <?php if (!empty($d['foto'])): ?>
                                            <img
                                                src="public/images/<?= htmlspecialchars($d['foto']); ?>"
                                                loading="lazy"
                                                class="w-full h-full object-cover object-center group-hover:scale-105 transition duration-300"
                                                alt="<?= htmlspecialchars($d['nama']); ?>">
                                        <?php else: ?>
                                            <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                                <i class="bx bxs-bowl-hot text-4xl text-gray-300"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div class="absolute top-2.5 left-2.5 sm:top-3 sm:left-3">
                                            <span class="px-2.5 py-1 sm:px-3 sm:py-1.5 rounded-lg bg-primary text-[10px] sm:text-xs font-black text-white">
                                                <?= $d['nama_kategori'] ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="p-4 sm:p-5 flex-1 min-w-0 flex flex-col justify-between">
                                        <h3 class="font-black text-gray-900 text-base sm:text-lg line-clamp-2 leading-snug">
                                            <?= htmlspecialchars($d['nama']) ?>
                                        </h3>

                                        <div class="flex items-end justify-between gap-3 mt-4 sm:mt-6 pt-2">
                                            <div class="min-w-0">
                                                <span class="text-[10px] uppercase tracking-wider font-bold text-gray-400 block mb-0.5">
                                                    Harga
                                                </span>
                                                <span class="text-base sm:text-lg font-black text-gray-900 whitespace-nowrap">
                                                    Rp <?= number_format($d['harga'], 0, '', '.') ?>
                                                </span>
                                            </div>

                                            <div class="flex gap-x-2.5">
                                                 <button
                                                        type="button"
                                                        onclick='addMenu(<?= json_encode($d) ?>);'
                                                        class="w-10 h-10 rounded-lg bg-primary text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all cursor-pointer"
                                                    >
                                                        <i class="bx bxs-plus"></i>
                                                    </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="w-full flex justify-center mt-6">
                        <nav aria-label="Pagination">
                            <ul class="inline-flex items-center gap-1.5 p-1.5 rounded-lg border-2 border-gray-200/80 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm font-medium">
                                
                               <li>
                                   <?php if($currentPage > 1): ?>
                                   <a href="?<?= http_build_query(array_merge($_GET, ['page' => $currentPage - 1])) ?>"
                                       class="flex items-center justify-center px-3.5 h-9 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                                       Previous
                                   </a>
                                   <?php else: ?>
                                   <span
                                       class="flex items-center justify-center px-3.5 h-9 rounded-lg text-slate-400 dark:text-slate-500 opacity-50 cursor-not-allowed pointer-events-none">
                                       Previous
                                   </span>
                                   <?php endif; ?>
                               </li>
                                
                                <?php for($i = 1; $i <= $totalPage; $i++): ?>
                                <li>
                                    <a href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>"
                                        class="flex items-center justify-center w-9 h-9 rounded-lg <?= $i == $currentPage ? 'bg-primary text-white font-bold shadow-sm' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors' ?>">
                                        <?= $i  ?>
                                    </a>
                                </li>
                                <?php endfor; ?>
                                
                                <li>
                                    <?php if($currentPage < $totalPage): ?>
                                    <a href="?<?= http_build_query(array_merge($_GET, ['page' => $currentPage + 1])) ?>"
                                        class="flex items-center justify-center px-3.5 h-9 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                                        Next
                                    </a>
                                    <?php else: ?>
                                    <span
                                        class="flex items-center justify-center px-3.5 h-9 rounded-lg text-slate-400 dark:text-slate-500 opacity-50 cursor-not-allowed pointer-events-none">
                                        Next
                                    </span>
                                    <?php endif; ?>
                                </li>
                                    
                            </ul>
                        </nav>
                    </div>
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
                                        <span class="px-2 py-1 rounded-full bg-primary text-white text-[10px] font-black hidden" id="tjenismenu"></span>
                                    </h2>
                                    <p class="text-xs text-gray-400 mt-1">Daftar menu yang dipilih</p>
                                </div>
                            </div>

                            <button 
                            type="button"
                            onclick="showConfirm(
                                'Kosongkan Pesanan',
                                'Apakah Anda yakin ingin kososngkan pesanan?. Semua item dalam pesanan saat ini akan dihapus.',
                                'Ya, kosongkan',
                                'danger',
                                onConfirm => removePesanan()
                            )"
                            class="w-10 h-10 rounded-lg bg-rose-600 text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all cursor-pointer"
                                                >
                                <i class="bx bxs-trash text-lg text-white"></i>
                            </button>
                        </div>

                        <div class="w-full mt-6">
                            <div class="flex items-center gap-1 bg-gray-100 rounded-lg">
                                <label
                                    class="flex-1 relative flex items-center justify-center gap-2 px-4 py-3 rounded-md cursor-pointer select-none transition-all duration-150"
                                    :class="StepJenisPesanan === 'DineIn'
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

                    <div class="flex-1 min-h-0 overflow-y-auto py-4 border-b border-gray-100" id="detailPesanan"></div>

                    <div class="border-t border-gray-100 py-5 shrink-0">
                        <div class="space-y-2.5">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-400">Subtotal</span>
                                <span class="font-black text-gray-700" id="subtotal">
                                    Rp
                                </span>
                            </div>

                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-400">Total Diskon</span>
                                <span class="font-bold text-gray-700" id="diskon">Rp0</span>
                            </div>
                        </div>

                        <div class="flex items-end justify-between mt-5 pt-4 border-t border-dashed border-gray-200">
                            <div>
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Total</span>
                                <span class="paymentTotal text-2xl font-black text-gray-900">Rp 0</span>
                            </div>
                        </div>

                        <div class="flex flex-col gap-2 mt-6">
                            <div class="flex flex-col sm:flex-row items-center gap-4">
                                <div x-show="tambahUser === false" x-transition class="relative flex items-center w-full">
                                    <div class="absolute left-4 flex items-center pointer-events-none text-gray-400 z-10">
                                        <i class="bx bx-user text-lg"></i>
                                    </div>

                                    <select
                                        x-model="idPelanggan"
                                        required
                                        class="w-full pl-12 pr-10 py-3 bg-white text-gray-900 text-sm font-bold rounded-lg border-2 border-gray-200 focus:outline-none focus:ring focus:border-primary focus:ring-primary appearance-none cursor-pointer transition-colors"
                                    >
                                    <?php if(!$pelanggan): ?>
                                        <option value="">Tidak ada pelanggan terdaftar</option>
                                    <?php else: ?>
                                        <option value="">Pilih pelanggan terdaftar</option>
                                        <?php foreach($pelanggan as $d): ?>
                                            <option value="<?= $d['id_pelanggan'] ?>"><?= $d['nama_pelanggan'] ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
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
                                            x-model="namaPelanggan"
                                            type="text"
                                            placeholder="Masukkan nama pelanggan"
                                            class="w-full pl-12 pr-4 py-3 bg-white text-gray-900 text-sm font-bold rounded-lg border-2 border-gray-200 focus:outline-none focus:ring focus:border-primary focus:ring-primary transition-colors placeholder:text-gray-300"
                                        >
                                    </div>
                                </div>

                                <button
                                    type="button"
                                    x-show="tambahUser === false"
                                    @click="tambahUser = true; idPelanggan = null;"
                                    class="w-full sm:w-auto flex items-center justify-center bg-primary text-white font-black p-3.5 gap-2 rounded-lg cursor-pointer transition-all shadow-md"
                                >
                                    <i class="bx bx-user-plus text-xl"></i>
                                </button>

                                <button
                                    type="button"
                                    x-show="tambahUser === true"
                                    @click="tambahUser = false; namaPelanggan = '';"
                                    class="w-full sm:w-auto flex items-center justify-center bg-primary text-white font-black p-3.5 gap-2 rounded-lg cursor-pointer transition-all shadow-md"
                                >
                                    <i class="bx bx-x text-xl"></i>
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <button
                                type="button"
                                onclick="bukaPembayaran()"
                                class="w-full flex-1 flex items-center justify-center bg-gray-100 text-gray-500 font-black px-8 py-3.5 gap-2 rounded-lg cursor-pointer transition-all shadow-sm mt-4"
                            >
                                <i class="bx bxs-wallet-alt text-xl"></i>
                            </button>

                            <button
                                type="button"
                                @click="simpanPesananMenunggu(StepJenisPesanan, idPelanggan, namaPelanggan)"
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
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mt-6">

                            <div class="p-4 rounded-lg border border-gray-200 bg-gray-50">
                                <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400">
                                    Total Tagihan
                                </span>

                                <span class="paymentTotal block mt-1 text-lg font-black text-primary">
                                    Rp0
                                </span>
                            </div>

                            <div class="p-4 rounded-lg border border-gray-200 bg-gray-50">
                                <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400">
                                    Total Dibayar
                                </span>

                                <span class="paymentDibayar block mt-1 text-lg font-black text-gray-900">
                                    Rp0
                                </span>
                            </div>

                            <div class="p-4 rounded-lg border border-gray-200 bg-gray-50">
                                <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400">
                                    Sisa Tagihan
                                </span>

                                <span class="paymentSisa block mt-1 text-lg font-black text-gray-900">
                                    Rp0
                                </span>
                            </div>

                        </div>

                        <!-- <span class="text-xs font-bold uppercase tracking-[0.2em] text-gray-400 mb-2">
                            Total Tagihan
                        </span>
                        <h2 class="paymentTotal text-4xl sm:text-5xl font-black text-primary tracking-tighter" id="">
                            Rp0
                        </h2>  -->

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
                                                    x-model="ewallet"
                                                    class="w-full pl-12 pr-10 py-3.5 bg-white text-gray-900 text-sm font-bold rounded-lg border-2 border-gray-200 focus:outline-none focus:border-primary focus:ring focus:ring-primary appearance-none cursor-pointer transition-colors"
                                                >
                                                    <?php if(!$ewallet): ?>
                                                        <option value="">Tidak ada metode e-wallet terdaftar</option>
                                                    <?php else: ?>
                                                        <option value="">Pilih E-Wallet</option>
                                                        <?php foreach($ewallet as $d): ?>
                                                            <option value="<?= $d['id_metode'] ?>"><?= $d['nama_metode'] ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
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
                                                    <?php if(!$transfer): ?>
                                                        <option value="">Tidak ada metode transfer terdaftar</option>
                                                    <?php else: ?>
                                                        <option value="">Pilih Bank</option>
                                                        <?php foreach($transfer as $d): ?>
                                                            <option value="<?= $d['id_metode'] ?>"><?= $d['nama_metode'] ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
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
                                                    <?php if(!$card): ?>
                                                        <option value="">Tidak ada metode kartu terdaftar</option>
                                                    <?php else: ?>
                                                        <option value="">Pilih Kartu</option>
                                                        <?php foreach($card as $d): ?>
                                                            <option value="<?= $d['id_metode'] ?>"><?= $d['nama_metode'] ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
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
                                                    type="text"
                                                    id="nominal"
                                                    inputmode="numeric"
                                                    @input="
                                                        formatNominal($event.target);
                                                        nominal = Number($event.target.value.replace(/\D/g, '')) || 0;
                                                        updatePayment(
                                                            idTransaksiMenunggu !== null
                                                                ? total
                                                                : null
                                                        );
                                                    "
                                                    min="0"
                                                    placeholder="0"
                                                    autocomplete="off"
                                                    class="w-full pl-12 pr-4 py-3 bg-white text-gray-900 text-lg font-black rounded-lg border-2 border-gray-200 focus:outline-none focus:ring focus:border-primary focus:ring-primary transition-colors placeholder:text-gray-300"
                                                >
                                            </div>
                                            <div class="mt-2">
                                                <p class="hidden text-sm font-bold" id="nominalStatus"></p>
                                            </div>
                                        </div>
                        
                                    </div>
                                </div>
                            </div>           
                           
                        </div>

                    </div>

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
                            <span class="text-2xl sm:text-xl font-black text-primary tracking-tighter" id="paymentKembalian">
                                Rp0
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
                            @click="
                                idTransaksiMenunggu !== null
                                    ? konfirmasiPembayaranMenunggu(
                                        idTransaksiMenunggu,
                                        total,
                                        metode,
                                        bank,
                                        ewallet,
                                        card,
                                        nominal
                                    )
                                    : konfirmasiPembayaran(
                                        StepJenisPesanan,
                                        idPelanggan,
                                        namaPelanggan,
                                        metode,
                                        bank,
                                        ewallet,
                                        card,
                                        nominal
                                    )
                            "
                            :disabled="metode === '' ||
                            (metode === 'Tunai' && Number(nominal) < Number(total)) ||
                            (['Transfer'].includes(metode) && bank === '') || (metode === 'E-Wallet' && ewallet === '') ||
                            (metode === 'Card' && card === '')"
                            :class="metode === '' ||
                            (metode === 'Tunai' && Number(nominal) < Number(total)) ||
                            (['Transfer'].includes(metode) && bank === '') || (metode === 'E-Wallet' && ewallet === '') ||
                            (metode === 'Card' && card === '')
                                    ? 'opacity-30 cursor-not-allowed'
                                    : 'hover:bg-hover-primary active:scale-95 cursor-pointer'"
                            class="w-full sm:w-auto flex items-center justify-center bg-primary text-white font-black px-8 py-4 gap-2 rounded-lg transition-all shadow-md"
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
                <?php if(empty($pesananMenunggu)): ?>
                    <div class="text-center py-8 text-gray-400">
                        <i class="bx bx-receipt text-4xl"></i>
                        <p class="mt-2">Belum ada pesanan menunggu.</p>
                    </div>
                <?php else: ?>
                    <?php foreach($pesananMenunggu as $p):
                    $tipePesanan = match ((int) $p['tipe_pesanan']){
                        1 => 'Dine In',
                        2 => 'Takeaway',
                        default => 'Tidak diketahui'
                    }
                    ?>
                    <div class="px-10 py-5 border-b border-gray-200">
                        <div class="flex items-center justify-between gap-4">
                            <div class="min-w-0">
                                <div class="flex items-center justify-between gap-4">
                                    <div class="">
                                        <span class="text-[10px] font-black uppercase tracking-wider text-gray-400">
                                            No. Transaksi
                                        </span>
                                        <h3 class="text-sm font-black text-gray-900 mt-1">
                                            <?= htmlspecialchars($p['kode_transaksi']) ?>
                                        </h3>
                                    </div>
                                    <span class="min-w-5 h-5 px-2 flex items-center justify-center rounded-full bg-primary text-white text-[10px] font-black">
                                        <?= $tipePesanan ?>
                                    </span>
                                </div>
                                <div class="flex flex-wrap items-center gap-x-5 gap-y-2 mt-3">
                                    <div>
                                        <span class="text-[10px] text-gray-400 font-medium block">
                                            Pelanggan
                                        </span>
                                        <span class="text-sm font-bold text-gray-700">
                                            <?php if(!empty($p['nama_pelanggan'])){
                                                echo htmlspecialchars($p['nama_pelanggan']);
                                            } elseif($p['id_pelanggan'] !== null){
                                                echo htmlspecialchars($p['namapelanggan']);
                                            } else{
                                                echo "-";
                                            }?>
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-[10px] text-gray-400 font-medium block">
                                            Total
                                        </span>
                                        <span class="text-sm font-black text-gray-900">
                                            Rp<?= number_format($p['total'], 0, ",", ".") ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 shrink-0">
                                <button
                                    type="button"
                                    @click="bukaPembayaranMenunggu(<?= (int)$p['id_transaksi'] ?>, <?= (int)$p['total'] ?>)"
                                    class="h-10 px-6 rounded-lg bg-primary text-white text-sm font-black flex items-center gap-2 hover:opacity-90 active:scale-95 transition-all"
                                >
                                    <i class="bx bxs-wallet-alt text-base"></i>
                                    Bayar
                                </button>
                                <?php if (!empty($p['id_pelanggan'])): ?>

                                <button
                                    type="button"
                                    @click="
                                        konfirmasiJadikanPiutang(
                                            <?= (int)$p['id_transaksi'] ?>,
                                            <?= (int)$p['id_pelanggan'] ?>
                                        )
                                    "
                                    class="w-full sm:w-auto h-11 px-4 flex items-center justify-center gap-2 rounded-lg bg-gray-100 font-black text-sm text-gray-600 hover:bg-gray-200 transition-all"
                                    >
                                    Jadikan Piutang
                                </button>
                                <?php else: ?>
                                    
                                    <button
                                    type="button"
                                    @click="
                                    idTransaksiPiutang = <?= (int)$p['id_transaksi'] ?>;
                                    pelangganPiutang = '';
                                    modalPiutang = true;
                                    "
                                    class="w-full sm:w-auto h-11 px-4 flex items-center justify-center gap-2 rounded-lg bg-gray-100 font-black text-sm text-gray-600 hover:bg-gray-200 transition-all"
                                >
                                    Jadikan Piutang
                                </button>
                                
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                </div>
            </div>
        </div>

        <div
            x-show="modalPiutang"
            x-cloak
            class="fixed inset-0 z-[9991] flex items-center justify-center bg-black/50"
        >
            <div class="w-full max-w-2xl bg-white rounded-xl">

                <div class="mb-6 sm:mb-8 flex justify-between items-start sm:items-center gap-4 p-8 pb-0">
                        <div class="flex items-center gap-3 sm:gap-4 min-w-0">
                            <div class="flex w-12 h-12 rounded-lg bg-primary items-center justify-center shrink-0 shadow-sm">
                                <i class="bx bxs-receipt text-2xl text-white"></i>
                            </div>
                            <div class="min-w-0">    
                                <div class="flex items-center gap-2 sm:gap-3 flex-wrap">
                                    <h1 class="text-slate-900 font-black text-xl sm:text-2xl leading-tight">
                                        Jadikan Piutang
                                    </h1>
                                </div>    
                                <p class="text-xs sm:text-sm text-gray-500 font-medium mt-1">
                                    Pilih pelanggan yang memiliki tagihan ini.
                                </p>    
                            </div>    
                        </div>    
                        <button type="button" @click="modalPiutang = false" title="Tutup"
                            class="flex items-center justify-center w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-slate-100 text-slate-500 hover:text-white hover:bg-primary font-black cursor-pointer transition-colors shrink-0"                    >
                            <i class="bx bx-x text-2xl"></i>
                        </button>
                    </div>

                <div class="px-8 pb-8">
                    <div class="relative flex items-center w-full">
                        <div class="absolute left-4 flex items-center pointer-events-none text-gray-400 z-10">
                            <i class="bx bx-user text-lg"></i>
                        </div>

                        <select
                            x-model="pelangganPiutang"
                            required
                            class="w-full pl-12 pr-10 py-3 bg-white text-gray-900 text-sm font-bold rounded-lg border-2 border-gray-200 focus:outline-none focus:ring focus:border-primary focus:ring-primary appearance-none cursor-pointer transition-colors"
                        >                       
                            <option value="">Pilih Pelanggan</option>
                            <?php foreach ($pelanggan as $p): ?>
                            
                                <option
                                    value="<?= (int)$p['id_pelanggan'] ?>"
                                >
                                    <?= htmlspecialchars($p['nama_pelanggan']) ?>
                                </option>
                            
                            <?php endforeach; ?>                    
                        </select>

                        <div class="absolute right-4 flex items-center pointer-events-none text-gray-900">
                            <i class="bx bx-chevron-down text-xl"></i>
                        </div>
                    </div>                                                    

                    <div class="flex justify-end gap-2 mt-6">
                            
                        <button
                            type="button"
                            @click="modalPiutang = false"
                            class="h-10 px-6 rounded-lg bg-gray-100 text-gray-600 text-sm font-black flex items-center gap-2 hover:bg-gray-200 active:scale-95 transition-all"
                        >
                            Batal
                        </button>
                            
                        <button
                            type="button"
                            @click="konfirmasiJadikanPiutang(idTransaksiPiutang, pelangganPiutang)"
                            :disabled="pelangganPiutang === ''"
                            class="h-10 px-6 rounded-lg bg-primary text-white text-sm font-black flex items-center gap-2 hover:opacity-90 active:scale-95 transition-all"
                        >
                            Lanjutkan
                        </button>
                            
                    </div>
                </div>
                        
            </div>
        </div>

    </div>
</section>

<script>
    const value = document.querySelector('input[name="jenis_pemesanan"]').value;
    // console.log(value);
    function tdisk(b){
      const item = b.closest('.item-order');
      const igdisk = item.querySelector('.ig-diskon');
      const idisk = item.querySelector('.idiskon');
      igdisk.classList.toggle('hidden');
      if(igdisk.classList.contains('hidden')){
        b.innerHTML = '<i class="bx bxs-discount text-base text-primary"></i> Tambahkan Diskon';
        idisk.value = '';
        const i =  [...document.querySelectorAll('.item-order')].indexOf(item);
        order[i].diskon = 0;
        updateTDiskon();
      } else{
        b.innerHTML = '<i class="bx bxs-discount text-base text-primary"></i> Hapus Diskon';
      }
    }
    function tpdisk(b){
      const item = b.closest('.item-order');
      const bdisk = item.querySelector('.b-diskon');
      const igdisk = item.querySelector('.ig-diskon');
      const idisk = item.querySelector('.idiskon');
      igdisk.classList.toggle('hidden');
      if(igdisk.classList.contains('hidden')){
        bdisk.innerHTML = '<i class="bx bxs-discount text-base text-primary"></i> Tambahkan Diskon';
        idisk.value = '';
        const i =  [...document.querySelectorAll('.item-order')].indexOf(item);
        order[i].diskon = 0;
        updateTDiskon();
      } else{
        bdisk.innerHTML = '<i class="bx bxs-discount text-base text-primary"></i> Hapus Diskon';
      }
    }
    
    function tcatatan(b){
        const item = b.closest('.item-order');
        const igc = item.querySelector('.ig-catatan');
        const ic = item.querySelector('.icatatan');
        igc.classList.toggle('hidden');
        if(igc.classList.contains('hidden')){
            b.innerHTML = '<i class="bx bxs-note text-base text-primary"></i> Tambahkan Catatan';
            const i =  [...document.querySelectorAll('.item-order')].indexOf(item);
            order[i].catatan = '';
        } else{
            b.innerHTML = '<i class="bx bxs-note text-base text-primary"></i> Hapus Catatan';
            ic.value = '';
        }
    }
    function tpcatatan(b){
        const item = b.closest('.item-order');
        const bc = item.querySelector('.b-catatan');
        const igc = item.querySelector('.ig-catatan');
        const ic = item.querySelector('.icatatan');
        igc.classList.toggle('hidden');
        if(igc.classList.contains('hidden')){
            bc.innerHTML = '<i class="bx bxs-note text-base text-primary"></i> Tambahkan Catatan';
        } else{
            bc.innerHTML = '<i class="bx bxs-note text-base text-primary"></i> Hapus Catatan';
            ic.value = '';
        }
    }

    function updateTDiskon(){
        const td = order.reduce((total, item) => {
            return total + Number(item.diskon || 0);
        }, 0);
        document.getElementById('diskon').textContent = 'Rp' + td.toLocaleString('id-ID');
    }

    function dotsMenu(b){
      const item = b.closest('.item-order');
      const idm = item.querySelector('.item-dots-menu');
      idm.classList.toggle('hidden');
    }

    let order = [];
    function addMenu(m){
        const ex = order.find(item => item.id_menu == m.id_menu);
        if(ex){
            ex.qty++;
        } else{
            order.push({
                id_menu: m.id_menu,
                foto: m.foto,
                nama_menu: m.nama,
                harga: Number(m.harga),
                qty: 1,
                diskon: 0,
                catatan: ''
            });
        }
        renderOrder();

        // console.log('ORDER', order);
        // console.log('SUM', getOrderSummary());
    }

    function increaseQty(index){
        if(order[index].qty < 99){
            order[index].qty++;
        }
        renderOrder();
    }
    function decreaseQty(index){
        if(order[index].qty > 1){
            order[index].qty--;
        } else{
            order.splice(index, 1);
        }
        renderOrder();
    }

    function changeQty(index, value){
        let qty = parseInt(value);
        if(isNaN(qty) || qty < 1){
            qty = 1;
        }
        if(qty > 99){
            qty = 99;
        }
        order[index].qty = qty;
        renderOrder();
    }

    function removePesanan(){
        order = [];
        renderOrder();
    }

    function removeMenu(index){
        order.splice(index, 1);
        renderOrder();
    }

    function renderOrder(){
        const container = document.getElementById('detailPesanan');
        container.innerHTML = '';
        let subtotal = 0;
        let tdiskon = 0;
        order.forEach((item, index) => {
            const t = item.harga * item.qty;
            subtotal += t;
            tdiskon += Number(item.diskon || 0);
            container.innerHTML += `
            <div class="item-order">
                <div class="flex items-center gap-3">
                    <div class="w-14 h-14 rounded-lg bg-gray-100 flex items-center justify-center shrink-0 overflow-hidden">
                        ${item.foto ? `<img src="public/images/${item.foto}" class="w-full h-full object-cover" alt="${item.nama}">` : `<i class="bx bxs-bowl-hot text-xl text-gray-400"></i>`}
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="font-black text-gray-900 text-sm truncate">${item.nama_menu}</h4>
                        <p class="text-xs font-bold text-gray-900">
                            Rp<span>${item.harga.toLocaleString('id-ID')}</span>
                        </p>
                    </div>
                    <div class="relative">
                        <button
                        onclick="dotsMenu(this)"
                            type="button"
                            class="btn-dots-permenu w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:bg-gray-100 hover:text-gray-700 transition-all"
                        >
                            <i class="bx bx-dots-vertical-rounded text-xl"></i>
                        </button>
                        <div
                            class="item-dots-menu absolute right-0 top-9 z-30 w-44 bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden hidden"
                        >
                            <button
                            onclick="tdisk(this)"
                                type="button"
                                class="b-diskon w-full flex items-center gap-3 px-4 py-3 text-xs font-bold text-gray-700 hover:bg-gray-50 transition"
                            >
                                <i class="bx bxs-discount text-base text-primary"></i>
                                Tambahkan Diskon
                            </button>
                            <button
                            onclick="tcatatan(this)"
                                type="button"
                                class="b-catatan w-full flex items-center gap-3 px-4 py-3 text-xs font-bold text-gray-700 hover:bg-gray-50 transition"
                            >
                                <i class="bx bxs-note text-base text-primary"></i>
                                Tambahkan Catatan
                            </button>
                        </div>
                    </div>
                    <button
                        onclick="removeMenu(${index})"
                        type="button"
                        class="w-7 h-7 flex items-center justify-center text-gray-300 hover:text-red-500 transition-all shrink-0"
                    >
                        <i class="bx bxs-x-circle text-xl"></i>
                    </button>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <span class="text-[11px] text-gray-500 font-medium">Jumlah</span>
                    <div class="flex items-center gap-2">
                        <button
                            onclick="decreaseQty(${index})"
                            type="button"
                            class="w-7 h-7 rounded-lg bg-gray-100 text-gray-600 flex items-center justify-center hover:bg-gray-200 transition active:scale-95"
                        >
                            <i class="bx bxs-minus text-xs"></i>
                        </button>
                        <input
                            oninput="changeQty(${index}, this.value)"
                            type="number"
                            min="1"
                            max="9999"
                            class="w-14 text-center text-sm font-black text-gray-800 bg-transparent border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary py-0.5 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                            value="${item.qty}"
                        >
                        <button
                            onclick="increaseQty(${index})"
                            type="button"
                            class="w-7 h-7 rounded-lg bg-primary text-white flex items-center justify-center hover:opacity-90 transition active:scale-95"
                        >
                            <i class="bx bxs-plus text-xs"></i>
                        </button>
                    </div>
                </div>
    
                <div class="ig-diskon ${Number(item.diskon || 0) > 0 ? '' : 'hidden'} mt-3 pt-3 border-t border-dashed border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="text-[11px] font-bold text-gray-500">Diskon</span>
                            <button
                                onclick="tpdisk(this)"
                                type="button"
                                class="text-gray-300 hover:text-red-500"
                            >
                                <i class="bx bx-x text-sm"></i>
                            </button>
                        </div>
                        <div class="relative">
                            <span class="absolute left-2 top-1.5 text-[10px] font-bold text-gray-400">Rp</span>
                            <input
                                type="number"
                                placeholder="0"
                                class="idiskon w-24 pl-6 pr-2 py-1 text-right text-xs font-bold text-gray-800 bg-white border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                value="${item.diskon || 0}"
                                min="0"
                                oninput="order[${index}].diskon = Number(this.value || 0); updateTDiskon();"
                            >
                        </div>
                    </div>
                </div>
    
                <div class="ig-catatan ${item.catatan ? '' : 'hidden'} mt-3 pt-3 border-t border-dashed border-gray-100">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[11px] font-bold text-gray-500">Catatan</span>
                        <button
                            onclick="tpcatatan(this)"
                            type="button"
                            class="text-gray-300 hover:text-red-500"
                        >
                            <i class="bx bx-x text-sm"></i>
                        </button>
                    </div>
                    <textarea
                        oninput="order[${index}].catatan = this.value"
                        rows="2"
                        placeholder="Contoh: Es sedikit gula..."
                        class="icatatan w-full px-3 py-2 text-xs font-semibold text-gray-800 bg-white border border-gray-200 rounded-lg resize-none focus:outline-none focus:ring-2 focus:ring-primary placeholder:text-gray-300"
                    >${item.catatan || ''}</textarea>
                </div>
            </div>
            `;
        });
        document.getElementById('subtotal').textContent = 'Rp' + subtotal.toLocaleString('id-ID');
        document.getElementById('diskon').textContent = 'Rp' + tdiskon.toLocaleString('id-ID');

        const tjenismenu = order.length;
        const vtjenismenu = document.getElementById('tjenismenu');
        if(tjenismenu > 0){
            vtjenismenu.classList.remove('hidden');
            vtjenismenu.textContent = tjenismenu;
        } else{
            vtjenismenu.classList.add('hidden');
            vtjenismenu.textContent = 0;
        }
        updatePayment();
    }

    function getOrderSummary(){
        let subtotal = 0;
        let totalDiskon = 0;
        order.forEach((item, index) => {
            const harga = Number(item.harga) || 0;
            const qty = Number(item.qty) || 0;
            const diskon = Number(item.diskon) || 0;
            subtotal += harga * qty;
            totalDiskon += diskon;
        });
        const total = Math.max(0, subtotal - totalDiskon)
        return {
            subtotal,
            totalDiskon,
            total
        };
    }

    function formatRupiah(nominal) {
    return 'Rp' + Number(nominal || 0).toLocaleString('id-ID');
}

function updatePayment(totalOverride = null) {

    const summary = getOrderSummary();

    const nominalInput = document.getElementById('nominal');

    const nominal = Number(
        nominalInput?.value.replace(/\D/g, '')
    ) || 0;

    const total = totalOverride !== null
        ? Number(totalOverride)
        : summary.total;

    const sisaTagihan = Math.max(0, total - nominal);
    const kembalian = Math.max(0, nominal - total);

    // =========================
    // STATUS NOMINAL
    // =========================

    const statusEl = document.getElementById('nominalStatus');

    if (statusEl) {

        statusEl.classList.remove(
            'hidden',
            'text-red-500',
            'text-green-500'
        );

        if (nominal === 0) {

            statusEl.classList.add('hidden');
            statusEl.innerHTML = '';

        } else if (nominal < total) {

            statusEl.classList.add('text-red-500');

            statusEl.innerHTML =
                `<i class="bx bxs-alert-triangle"></i>
                 Nominal pembayaran belum mencukupi.
                 Sisa ${formatRupiah(sisaTagihan)}`;

        } else {

            statusEl.classList.add('text-green-500');

            statusEl.innerHTML =
                `<i class="bx bx-check-circle"></i>
                 Nominal pembayaran mencukupi.`;

        }
    }

    // TOTAL TAGIHAN
    document.querySelectorAll('.paymentTotal').forEach(el => {
        el.textContent = formatRupiah(total);
    });

    // TOTAL DIBAYAR
    document.querySelectorAll('.paymentDibayar').forEach(el => {
        el.textContent = formatRupiah(nominal);
    });

    // SISA TAGIHAN
    document.querySelectorAll('.paymentSisa').forEach(el => {
        el.textContent = formatRupiah(sisaTagihan);
    });

    // KEMBALIAN
    const elKembalian =
        document.getElementById('paymentKembalian');

    if (elKembalian) {
        elKembalian.textContent =
            formatRupiah(kembalian);
    }

    return {
        total,
        nominal,
        sisaTagihan,
        kembalian
    };
}
    
    function formatNominal(i) {

    let angka = i.value.replace(/\D/g, '');

    angka = angka.replace(/^0+(?=\d)/, '');

    if (angka === '') {
        i.value = '';
        return;
    }

    i.value = Number(angka).toLocaleString('id-ID');
}

    function bukaPembayaran(){
        if(order.length === 0){
            showToast({
                pesan: 'Belum ada pesanan.', 
                bg: 'warning'
            });
            return;
        }

        const summary = getOrderSummary();
        // console.log('Order:', order);
        // console.log('Sum Pemba:', summary);

        const nominalInput = document.getElementById('nominal');
        if(nominalInput){
            nominalInput.value = '';
        }
        window.dispatchEvent(new CustomEvent('buka-pembayaran', {
                detail: {
                    total: summary.total
                }
            })
        );

        updatePayment();
    }

    function resetTransaksi() {
        order = [];
        renderOrder();

        idPelanggan = null;
        namaPelanggan = '';
        tambahUser = false;

        modalPiutang = false;
        idTransaksiPiutang = null;
        pelangganPiutang = '';

        metode = '';
        bank = '';
        ewallet = '';
        card = '';
        nominal = 0;
        total = 0;

        StepJenisPesanan = '';
        StepDataDiri = false;
        StepPembayaran = false;
        open = false;

        
        const ni = document.getElementById('nominal');
        if(ni){
            ni.value = '';
        }
        
        document.querySelectorAll('.paymentDibayar').forEach(el => {
            el.textContent = formatRupiah(0);
        });
        updatePayment();

        window.dispatchEvent(new CustomEvent('tutup-pembayaran'));
    }

    async function konfirmasiPembayaran(
    tipePesanan,
    idPelanggan,
    namaPelanggan,
    metode,
    bank,
    ewallet,
    card,
    nominal
) {
    if (!metode) {
        showToast({
            pesan: 'Silakan pilih metode pembayaran.',
            bg: 'warning'
        });
        return;
    }

    const summary = getOrderSummary();

    if (summary.total <= 0) {
        showToast({
            pesan: 'Total transaksi tidak valid.',
            bg: 'warning'
        });
        return;
    }

    if (metode === 'Tunai' && Number(nominal) < summary.total) {
        showToast({
            pesan: 'Nominal pembayaran belum mencukupi.',
            bg: 'warning'
        });
        return;
    }

    if (metode === 'Hutang' && !idPelanggan) {
        showToast({
            pesan: 'Pelanggan terdaftar wajib dipilih untuk transaksi hutang.',
            bg: 'warning'
        });
        return;
    }

    if (metode === 'Transfer' && !bank) {
        showToast({
            pesan: 'Silakan pilih bank.',
            bg: 'warning'
        });
        return;
    }

    if (metode === 'E-Wallet' && !ewallet) {
        showToast({
            pesan: 'Silakan pilih E-Wallet.',
            bg: 'warning'
        });
        return;
    }

    if (metode === 'Card' && !card) {
        showToast({
            pesan: 'Silakan pilih kartu.',
            bg: 'warning'
        });
        return;
    }

    const dataPesanan = {
        tipePesanan,
        idPelanggan: idPelanggan ? Number(idPelanggan) : null,
        namaPelanggan: namaPelanggan?.trim() || ''
    };

    const dataPembayaran = {
        metode,
        bank: bank || '',
        ewallet: ewallet || '',
        card: card || '',
        nominal: Number(nominal) || 0
    };

    const transaksi = buildTransaksi(
        dataPesanan,
        dataPembayaran
    );

    // console.log('DATA TRANSAKSI:', transaksi);

    // SELANJUTNYA FETCH KE PHP
    const formData = new FormData();

    formData.append('aksi', 'simpanTransaksi');
    formData.append('transaksi', JSON.stringify(transaksi));

    const response = await fetch('?route=kasir', {
        method: 'POST',
        body: formData
    });

    const result = await response.json();
    if (!result.status) {
        showToast({
            pesan: result.pesan,
            bg: result.bg
        });
        return;
    }
    showToast({
        pesan: result.pesan,
        bg: result.bg
    });

    resetTransaksi();
    console.log('TRANSAKSI BERHASIL', result);
}

function buildTransaksi(dataPesanan, dataPembayaran) {

    const summary = getOrderSummary();

    const metode = dataPembayaran.metode;

    const isTunai = metode === 'Tunai';
    const isHutang = metode === 'Hutang';


    // =========================
    // PEMBAYARAN
    // =========================

    let nominalDibayar = 0;
    let kembalian = 0;
    let statusPembayaran = 'belum_lunas';


    if (isHutang) {

        nominalDibayar = 0;
        kembalian = 0;
        statusPembayaran = 'belum_lunas';

    } else if (isTunai) {

        nominalDibayar =
            Number(dataPembayaran.nominal) || 0;

        kembalian = Math.max(
            0,
            nominalDibayar - summary.total
        );

        statusPembayaran = 'lunas';

    } else {

        // Transfer
        // E-Wallet
        // Card

        nominalDibayar = summary.total;
        kembalian = 0;
        statusPembayaran = 'lunas';
    }


    // =========================
    // DATA TRANSAKSI
    // =========================

    return {

        transaksi: {

            tipe_pesanan:
                dataPesanan.tipePesanan,

            id_pelanggan:
                dataPesanan.idPelanggan || null,

            nama_pelanggan:
                dataPesanan.namaPelanggan || ''

        },


        // =========================
        // DETAIL MENU
        // =========================

        items: order.map(item => ({

            id_menu:
                item.id_menu,

            qty:
                Number(item.qty),

            harga:
                Number(item.harga),

            diskon:
                Number(item.diskon) || 0,

            catatan:
                item.catatan || ''

        })),


        // =========================
        // TOTAL
        // =========================

        subtotal:
            summary.subtotal,

        total_diskon:
            summary.totalDiskon,

        total:
            summary.total,


        // =========================
        // PEMBAYARAN
        // =========================

        pembayaran: {

            metode:
                metode,

            bank:
                metode === 'Transfer'
                    ? dataPembayaran.bank || ''
                    : '',

            ewallet:
                metode === 'E-Wallet'
                    ? dataPembayaran.ewallet || ''
                    : '',

            card:
                metode === 'Card'
                    ? dataPembayaran.card || ''
                    : '',

            nominal:
                nominalDibayar,

            kembalian:
                kembalian,

            status:
                statusPembayaran

        }
    };
}

function buildPesananMenunggu(tipePesanan, idPelanggan, namaPelanggan) {

    const summary = getOrderSummary();

    return {
        transaksi: {
            tipe_pesanan: tipePesanan,
            id_pelanggan: idPelanggan
                ? Number(idPelanggan)
                : null,
            nama_pelanggan: namaPelanggan?.trim() || ''
        },

        items: order.map(item => ({
            id_menu: item.id_menu,
            qty: Number(item.qty),
            diskon: Number(item.diskon) || 0,
            catatan: item.catatan || ''
        })),

        subtotal: summary.subtotal,
        total_diskon: summary.totalDiskon,
        total: summary.total
    };

}
async function simpanPesananMenunggu(tipePesanan, idPelanggan, namaPelanggan) {

    if (order.length === 0) {
        showToast({
            pesan: 'Pesanan belum memiliki menu.',
            bg: 'warning'
        });
        return;
    }

    if (!tipePesanan) {
        showToast({
            pesan: 'Silakan pilih jenis pesanan.',
            bg: 'warning'
        });
        return;
    }

    const summary = getOrderSummary();

    if (summary.total <= 0) {
        showToast({
            pesan: 'Total pesanan tidak valid.',
            bg: 'warning'
        });
        return;
    }

    const pesanan = buildPesananMenunggu(tipePesanan, idPelanggan, namaPelanggan);

    const formData = new FormData();

    formData.append('aksi', 'simpanPesananMenunggu');
    formData.append('pesanan', JSON.stringify(pesanan));

    try {

        const response = await fetch('?route=kasir', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (!result.status) {
            showToast({
                pesan: result.pesan,
                bg: result.bg
            });
            return;
        }

        showToast({
            pesan: result.pesan,
            bg: result.bg
        });

        resetTransaksi();
        setTimeout(() => {
            window.location.reload();
        }, 3200);

    } catch (error) {

        console.error(error);

        showToast({
            pesan: 'Terjadi kesalahan saat menyimpan pesanan.',
            bg: 'danger'
        });
    }
}

function bukaPembayaranMenunggu(idTransaksi, total) {
    total = Number(total) || 0;

    window.dispatchEvent(
        new CustomEvent('buka-pembayaran-menunggu', {
            detail: {
                idTransaksi: Number(idTransaksi),
                total: total
            }
        })
    );
}

async function konfirmasiPembayaranMenunggu(
    idTransaksi,
    total,
    metode,
    bank,
    ewallet,
    card,
    nominal
) {
    if (!idTransaksi) {
        showToast({
            pesan: 'Transaksi menunggu tidak valid.',
            bg: 'warning'
        });
        return;
    }

    if (!metode) {
        showToast({
            pesan: 'Silakan pilih metode pembayaran.',
            bg: 'warning'
        });
        return;
    }

    // Pesanan menunggu dibayar melalui Bayar,
    // jadi Hutang ditangani oleh tombol "Jadikan Piutang".
    if (metode === 'Hutang') {
        showToast({
            pesan: 'Untuk menjadikan pesanan sebagai piutang, gunakan tombol "Jadikan Piutang".',
            bg: 'warning'
        });
        return;
    }

    if (metode === 'Tunai') {

        nominal = Number(nominal) || 0;

        if (nominal <= 0) {
            showToast({
                pesan: 'Nominal pembayaran belum diisi.',
                bg: 'warning'
            });
            return;
        }

        if (nominal < Number(total)) {
            showToast({
                pesan: 'Nominal pembayaran belum mencukupi.',
                bg: 'warning'
            });
            return;
        }
    }

    if (metode === 'Transfer' && !bank) {
        showToast({
            pesan: 'Silakan pilih bank.',
            bg: 'warning'
        });
        return;
    }

    if (metode === 'E-Wallet' && !ewallet) {
        showToast({
            pesan: 'Silakan pilih E-Wallet.',
            bg: 'warning'
        });
        return;
    }

    if (metode === 'Card' && !card) {
        showToast({
            pesan: 'Silakan pilih kartu.',
            bg: 'warning'
        });
        return;
    }

    const formData = new FormData();

    formData.append(
        'aksi',
        'bayarPesananMenunggu'
    );

    formData.append(
        'id_transaksi',
        idTransaksi
    );

    formData.append(
        'metode',
        metode
    );

    formData.append(
        'bank',
        bank || ''
    );

    formData.append(
        'ewallet',
        ewallet || ''
    );

    formData.append(
        'card',
        card || ''
    );

    formData.append(
        'nominal',
        nominal
    );

    try {

        const response = await fetch('?route=kasir', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (!result.status) {
            showToast({
                pesan: result.pesan,
                bg: result.bg
            });
            return;
        }

        showToast({
            pesan: result.pesan,
            bg: result.bg
        });

        resetTransaksi();
        setTimeout(() => {
            window.location.reload();
        }, 3200);

    } catch (error) {

        console.error(error);

        showToast({
            pesan: 'Terjadi kesalahan saat membayar pesanan.',
            bg: 'danger'
        });
    }
}

async function konfirmasiJadikanPiutang(idTransaksiPiutang, pelangganPiutang) {

    if (!idTransaksiPiutang) {
        showToast({
            pesan: 'Transaksi tidak valid.',
            bg: 'danger'
        });
        return;
    }

    if (!pelangganPiutang) {
        showToast({
            pesan: 'Silakan pilih pelanggan.',
            bg: 'warning'
        });
        return;
    }

    const formData = new FormData();

    formData.append(
        'aksi',
        'jadikanPiutang'
    );

    formData.append(
        'id_transaksi',
        idTransaksiPiutang
    );

    formData.append(
        'id_pelanggan',
        pelangganPiutang
    );

    try {

        const response = await fetch(
            window.location.href,
            {
                method: 'POST',
                body: formData
            }
        );

        const hasil = await response.json();

        if (!hasil.status) {

            showToast({
                pesan: hasil.pesan || 'Gagal menjadikan piutang.',
                bg: hasil.bg || 'danger'
            });

            return;
        }

        modalPiutang = false;

        showToast({
            pesan: hasil.pesan || 'Pesanan berhasil dijadikan piutang.',
            bg: 'success'
        });

        setTimeout(() => {
            window.location.reload();
        }, 3200);

    } catch (error) {

        console.error(error);

        showToast({
            pesan: 'Terjadi kesalahan saat memproses piutang.',
            bg: 'danger'
        });
    }
}
</script>
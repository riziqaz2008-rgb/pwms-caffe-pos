<section id="Kasir">
    <div 
        x-data="{ 
    layoutModeToggle: $persist(true), 
    filterToggle: $persist(true), 
    open: false,
    total: 68000,
    nominal: 0,
    pelanggan: '',
    metode: 'Tunai'
}"
        x-init="$watch('open', value => document.body.classList.toggle('overflow-hidden', value))"
    >

        <!-- =========================
             HEADER
        ========================== -->

        <div class="flex flex-row lg:items-center justify-between gap-5 mx-6">

            <div class="flex items-center gap-4 min-w-0">

                <div class="w-12 h-12 rounded-2xl bg-primary flex items-center justify-center shrink-0">
                    <i class="bx bxs-cart-alt text-2xl text-white"></i>
                </div>

                <div class="min-w-0">

                    <div class="flex items-center gap-3">

                        <h1 class="text-black font-black text-2xl">
                            Kasir
                        </h1>

                        <span class="text-sm font-semibold text-gray-400">
                            <?= $total_data ?> Menu
                        </span>

                    </div>

                    <p class="hidden sm:flex text-sm text-gray-500 font-medium mt-1">
                        Pilih menu untuk membuat pesanan pelanggan.
                    </p>

                </div>

            </div>

            <div class="flex items-center gap-3 shrink-0">

                <a 
                    href="?route=laporan"
                    class="w-full flex items-center justify-center gap-2 px-5 py-3 rounded-xl border-2 border-gray-200/80 bg-white text-gray-700 font-bold text-sm hover:border-primary hover:text-primary transition-all"
                >

                    <i class="bx bxs-history text-lg"></i>

                    <span>
                        Riwayat
                    </span>

                </a>

            </div>

        </div>


        <!-- =========================
             MAIN POS
        ========================== -->

        <div class="grid grid-cols-1 xl:grid-cols-[minmax(0,1fr)_400px] gap-6 mt-6 items-start">


            <!-- =========================
                 MENU
            ========================== -->

            <div class="min-w-0  order-2 xl:order-1">

          <div class="bg-white  overflow-hidden">

    <!-- Search & Filter -->

    <div class="p-5 border-b border-gray-200">

        <div class="flex flex-col md:flex-row gap-3">

            <div class="relative flex-1">

                <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-gray-400">

                    <i class="bx bx-search text-xl"></i>

                </div>

                <input 
                    type="search" 
                    name="search" 
                    value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" 
                    oninput="doLiveSearch(this.value)" 
                    class="w-full h-12 pl-11 pr-4 border border-gray-200 rounded-xl text-sm font-semibold text-slate-900 placeholder:text-gray-400 focus:bg-white focus:ring-2 focus:ring-primary outline-none transition-all" 
                    placeholder="Cari nama menu..."
                >

            </div>


            <?php  
                $currentCategory = $_GET['category'] ?? 'Semua';  
  
                $categories = [  
                    'Semua',  
                    'Makanan',  
                    'Minuman',  
                    'Bahan Pokok',  
                    'Kesehatan',  
                    'Kebersihan',  
                    'Ibu & Anak',  
                    'Bumbu Dapur',  
                    'Kosmetik'  
                ];  
            ?>


            <div class="relative w-full md:w-52 shrink-0">

                <select 
                    onchange="window.location.href = '?route=kasir&category=' + encodeURIComponent(this.value)" 
                    class="w-full h-12 px-4 pr-10 border border-gray-200 rounded-xl text-sm font-bold text-gray-700 focus:bg-white focus:ring-2 focus:ring-primary outline-none transition-all appearance-none cursor-pointer" 
                >

                    <?php foreach ($categories as $category): ?>

                        <option 
                            value="<?= htmlspecialchars($category) ?>" 
                            <?= $currentCategory == $category ? 'selected' : '' ?>
                        >
                            <?= htmlspecialchars($category) ?>
                        </option>

                    <?php endforeach; ?>

                </select>


                <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-gray-400">

                    <i class="bx bxs-chevron-down text-lg"></i>

                </div>

            </div>

        </div>

    </div>

</div>


                    <!-- Menu Content -->

                    <div class="bg-white p-6 mt-6">
                    <!-- Menu Header -->

                    <div class="flex items-center justify-between pb-8">

                        <div>

                            <h2 class="text-xl font-black text-gray-900">
                                Daftar Menu
                            </h2>

                            <p class="text-xs text-gray-400 mt-1">
                                Pilih menu untuk ditambahkan ke pesanan
                            </p>

                        </div>

                        <div class="flex items-center gap-1 p-1 rounded-xl">

                            <a
                                href="?route=kasir&layoutMode=grid&category=<?= urlencode($currentCategory) ?>"
                                class="w-9 h-9 flex items-center justify-center rounded-lg transition-all <?= ($_GET['layoutMode'] ?? 'grid') == 'grid' ? 'bg-primary text-white shadow-sm' : 'text-gray-400 hover:text-gray-700' ?>"
                            >
                                <i class="bx bxs-grid text-lg"></i>
                            </a>

                            <a
                                href="?route=kasir&layoutMode=table&category=<?= urlencode($currentCategory) ?>"
                                class="w-9 h-9 flex items-center justify-center rounded-lg transition-all <?= ($_GET['layoutMode'] ?? 'grid') == 'table' ? 'bg-primary text-white shadow-sm' : 'text-gray-400 hover:text-gray-700' ?>"
                            >
                                <i class="bx bxs-rows text-lg"></i>
                            </a>

                        </div>

                    </div>


                        <?php if (!empty($data_barang)): ?>

                            <?php if (($_GET['layoutMode'] ?? 'grid') == 'table'): ?>

                                <!-- Menu Table -->

                                <div class="overflow-x-auto">

                                    <table class="w-full text-left">

                                        <thead>

                                            <tr class="border-b border-gray-200">

                                                <th class="px-4 py-3 text-[11px] font-black text-gray-400 uppercase tracking-wider">
                                                    Menu
                                                </th>

                                                <th class="px-4 py-3 text-[11px] font-black text-gray-400 uppercase tracking-wider">
                                                    Kategori
                                                </th>

                                                <th class="px-4 py-3 text-[11px] font-black text-gray-400 uppercase tracking-wider">
                                                    Harga
                                                </th>

                                                <th class="px-4 py-3 text-[11px] font-black text-gray-400 uppercase tracking-wider text-right">
                                                    Aksi
                                                </th>

                                            </tr>

                                        </thead>

                                        <tbody class="divide-y divide-gray-100">

                                            <?php foreach ($data_barang as $barang): ?>

                                                <?php

                                                    $namaGambar = trim($barang['gambar_barang']);
                                                    $imagePath = __DIR__ . '/../../../../assets/images/products/' . $namaGambar;
                                                    $imageUrl = '/assets/images/products/' . $namaGambar;

                                                ?>

                                                <tr class="group hover/70 transition-all">

                                                    <!-- Menu -->

                                                    <td class="px-4 py-4">

                                                        <div class="flex items-center gap-3 min-w-[220px]">

                                                            <div class="w-12 h-12 rounded-xl overflow-hidden bg-gray-100 shrink-0">

                                                                <?php if (!empty($namaGambar) && file_exists($imagePath)): ?>

                                                                    <img
                                                                        src="<?= htmlspecialchars($imageUrl) ?>"
                                                                        loading="lazy"
                                                                        class="w-full h-full object-cover"
                                                                        alt="<?= htmlspecialchars($barang['nama_barang']) ?>"
                                                                    >

                                                                <?php else: ?>

                                                                    <div class="w-full h-full flex items-center justify-center">

                                                                        <i class="bx bxs-image text-2xl text-gray-300"></i>

                                                                    </div>

                                                                <?php endif; ?>

                                                            </div>

                                                            <div class="min-w-0">

                                                                <h3 class="font-black text-gray-900 text-sm truncate">
                                                                    <?= htmlspecialchars($barang['nama_barang']) ?>
                                                                </h3>

                                                                <p class="text-xs text-gray-400 mt-1 truncate max-w-[280px]">
                                                                    <?= !empty($barang['deskripsi_barang']) ? htmlspecialchars($barang['deskripsi_barang']) : 'Menu siap dipesan.' ?>
                                                                </p>

                                                            </div>

                                                        </div>

                                                    </td>


                                                    <!-- Kategori -->

                                                    <td class="px-4 py-4">

                                                        <span class="inline-flex px-2.5 py-1.5 rounded-lg bg-primary/10 text-primary text-[10px] font-black">
                                                            <?= htmlspecialchars($barang['kategori_barang']) ?>
                                                        </span>

                                                    </td>


                                                    <!-- Harga -->

                                                    <td class="px-4 py-4">

                                                        <span class="text-sm font-black text-gray-900 whitespace-nowrap">
                                                            Rp <?= number_format($barang['harga_barang'], 0, ',', '.') ?>
                                                        </span>

                                                    </td>


                                                    <!-- Aksi -->

                                                    <td class="px-4 py-4">

                                                        <div class="flex justify-end">

                                                            <button
                                                                type="button"
                                                                class="w-10 h-10 rounded-xl bg-primary text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all"
                                                                title="Tambah ke pesanan"
                                                            >

                                                                <i class="bx bxs-plus text-xl"></i>

                                                            </button>

                                                        </div>

                                                    </td>

                                                </tr>

                                            <?php endforeach; ?>

                                        </tbody>

                                    </table>

                                </div>


                            <?php else: ?>

                                <!-- Menu Grid -->

                               <div
    id="grid-barang"
    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4"
>
    <?php foreach ($data_barang as $barang): ?>
        <?php
            $namaGambar = trim($barang['gambar_barang']);
            $imagePath = __DIR__ . '/../../../../assets/images/products/' . $namaGambar;
            $imageUrl = '/assets/images/products/' . $namaGambar;
        ?>

        <div
            class="flex flex-row sm:flex-col group bg-white rounded-2xl overflow-hidden
                   transition-all duration-200"
        >

            <!-- Image -->
            <div
                class="relative w-32 h-32 shrink-0
                       sm:w-full sm:h-40
                       overflow-hidden bg-gray-100"
            >

                <?php if (!empty($namaGambar) && file_exists($imagePath)): ?>

                    <img
                        src="<?= htmlspecialchars($imageUrl) ?>"
                        loading="lazy"
                        class="w-full h-full object-cover object-center
                               group-hover:scale-105 transition duration-300"
                        alt="<?= htmlspecialchars($barang['nama_barang']) ?>"
                    >

                <?php else: ?>

                    <div class="w-full h-full flex items-center justify-center">
                        <i class="bx bxs-image text-4xl text-gray-300"></i>
                    </div>

                <?php endif; ?>

                <div class="absolute top-2 left-2 sm:top-3 sm:left-3">
                    <span
                        class="px-2 py-1 sm:px-2.5 sm:py-1.5
                               rounded-lg bg-primary
                               text-[9px] sm:text-[10px]
                               font-black text-white shadow-sm"
                    >
                        <?= htmlspecialchars($barang['kategori_barang']) ?>
                    </span>
                </div>

            </div>

            <!-- Content -->
            <div class="p-3 sm:p-4 flex-1 min-w-0">

                <h3 class="font-black text-gray-900 text-sm line-clamp-1">
                    <?= htmlspecialchars($barang['nama_barang']) ?>
                </h3>

                <p class="text-xs text-gray-400 mt-1 line-clamp-2">
                    <?= !empty($barang['deskripsi_barang'])
                        ? htmlspecialchars($barang['deskripsi_barang'])
                        : 'Menu siap dipesan.'
                    ?>
                </p>

                <div class="flex items-end justify-between gap-2 mt-3 sm:mt-4">

                    <div class="min-w-0">
                        <span
                            class="text-[9px] sm:text-[10px]
                                   uppercase tracking-wider
                                   font-bold text-gray-400 block"
                        >
                            Harga
                        </span>

                        <span
                            class="text-sm sm:text-base
                                   font-black text-gray-900
                                   whitespace-nowrap"
                        >
                            Rp <?= number_format($barang['harga_barang'], 0, ',', '.') ?>
                        </span>
                    </div>

                    <button
                        type="button"
                        class="w-9 h-9 sm:w-10 sm:h-10
                               rounded-xl bg-primary text-white
                               flex items-center justify-center
                               hover:opacity-90
                               active:scale-95
                               transition-all shrink-0"
                        title="Tambah ke pesanan"
                    >
                        <i class="bx bxs-plus text-lg sm:text-xl"></i>
                    </button>

                </div>

            </div>

        </div>

    <?php endforeach; ?>
</div>

                            <?php endif; ?>

                        <?php else: ?>

                            <div class="min-h-[400px] flex flex-col items-center justify-center text-gray-400">

                                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-4">

                                    <i class="bx bxs-package text-4xl text-gray-300"></i>

                                </div>

                                <h3 class="font-black text-gray-500">
                                    Menu tidak ditemukan
                                </h3>

                                <p class="text-sm mt-1">
                                    Coba gunakan kata kunci atau kategori lain.
                                </p>

                            </div>

                        <?php endif; ?>

                    
               


                <!-- Pagination -->

                <?php if (!empty($data_barang)): ?>

                    <div class="w-full flex justify-center mt-6">

                        <nav aria-label="Pagination">

                            <ul class="flex items-center gap-1.5 bg-white  rounded-full p-2">

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

                                        <li class="px-1 text-gray-400 text-sm">
                                            ...
                                        </li>

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

                                        <li class="px-1 text-gray-400 text-sm">
                                            ...
                                        </li>

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

            <!-- =========================
                 CART
            ========================== -->

            <aside class="w-full xl:sticky xl:top-6 order-1 xl:order-2">

                <div class="bg-white  rounded-3xl overflow-hidden">


                    <!-- Cart Header -->

                    <div class="px-5 py-5 border-b border-gray-100">

                        <div class="flex items-center justify-between">

                            <div>

                                <div class="flex items-center gap-2">

                                    <h2 class="text-lg font-black text-gray-900">
                                        Pesanan
                                    </h2>

                                    <span class="px-2 py-1 rounded-full bg-primary text-white text-[10px] font-black">
                                        3
                                    </span>

                                </div>

                                <p class="text-xs text-gray-400 mt-1">
                                    Daftar menu yang dipilih
                                </p>

                            </div>


                            <button
                                type="button"
                                class="w-9 h-9 rounded-xl flex items-center justify-center text-gray-400 bg-red-600 hover:text-red-500 transition-all"
                                title="Kosongkan pesanan"
                            >

                                <i class="bx bxs-trash text-lg text-white"></i>

                            </button>

                        </div>

                    </div>


                    <!-- Cart Items -->

                    <div class="max-h-[360px] overflow-y-auto px-5 py-3 divide-y divide-gray-100">

                        <!-- Item -->

                      <div class="py-4 border-b border-gray-100 dark:border-slate-800" x-data="{ 
    qty: 2, 
    hargaSatuan: 25000, 
    tipeDiskon: 'persen', // 'persen' atau 'nominal'
    diskonNilai: 0,
    get totalDiskon() {
        if (this.tipeDiskon === 'persen') {
            let pct = Math.min(100, Math.max(0, Number(this.diskonNilai) || 0));
            return (this.hargaSatuan * this.qty) * (pct / 100);
        } else {
            let maxTotal = this.hargaSatuan * this.qty;
            return Math.min(maxTotal, Math.max(0, Number(this.diskonNilai) || 0));
        }
    },
    get subtotal() {
        return Math.max(0, (this.hargaSatuan * this.qty) - this.totalDiskon);
    }
}">

    <!-- Header Item & Gambar -->
    <div class="flex items-center gap-3">
        <div class="w-14 h-14 rounded-xl bg-gray-100 dark:bg-slate-800 flex items-center justify-center shrink-0">
            <i class="bx bxs-bowl-hot text-2xl text-gray-400 dark:text-slate-500"></i>
        </div>

        <div class="flex-1 min-w-0">
            <h4 class="font-black text-gray-900 dark:text-white text-sm truncate">
                Nasi Goreng Spesial
            </h4>
            <div class="flex items-center gap-2 mt-0.5">
                <p class="text-xs font-bold text-primary">
                    Rp<span x-text="hargaSatuan.toLocaleString('id-ID')"></span>
                </p>
                <!-- Badge jika ada diskon aktif -->
                <template x-if="totalDiskon > 0">
                    <span class="text-[10px] font-bold text-red-500 bg-red-50 dark:bg-red-950/40 px-1.5 py-0.5 rounded">
                        -<span x-text="tipeDiskon === 'persen' ? diskonNilai + '%' : 'Rp' + Number(diskonNilai).toLocaleString('id-ID')"></span>
                    </span>
                </template>
            </div>
        </div>

        <!-- Tombol Hapus -->
        <button
            type="button"
            class="w-7 h-7 flex items-center justify-center text-gray-300 dark:text-slate-600 hover:text-red-500 dark:hover:text-red-400 transition-all shrink-0"
            title="Hapus Item"
        >
            <i class="bx bxs-x-circle text-xl"></i>
        </button>
    </div>

    <!-- Kontrol Jumlah (Qty) -->
    <div class="flex items-center justify-between mt-3">
        <span class="text-[11px] text-gray-500 dark:text-slate-400 font-medium">
            Jumlah
        </span>

        <div class="flex items-center gap-2">
            <!-- Tombol Kurang -->
            <button
                type="button"
                @click="qty = Math.max(1, qty - 1)"
                class="w-7 h-7 rounded-lg bg-gray-100 dark:bg-slate-800 text-gray-600 dark:text-gray-300 flex items-center justify-center hover:bg-gray-200 dark:hover:bg-slate-700 transition active:scale-95"
            >
                <i class="bx bxs-minus text-xs"></i>
            </button>

            <!-- Input Jumlah -->
            <input
                type="number"
                x-model.number="qty"
                @input="if (qty > 9999) qty = 9999; if (qty < 1 || isNaN(qty)) qty = 1;"
                min="1"
                max="9999"
                class="w-14 text-center text-sm font-black text-gray-800 dark:text-white bg-transparent border border-gray-200 dark:border-slate-700 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary py-0.5 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
            >

            <!-- Tombol Tambah -->
            <button
                type="button"
                @click="qty = Math.min(9999, qty + 1)"
                class="w-7 h-7 rounded-lg bg-primary text-white flex items-center justify-center hover:opacity-90 transition active:scale-95"
            >
                <i class="bx bxs-plus text-xs"></i>
            </button>
        </div>
    </div>

    <!-- Input Diskon Section -->
    <div class="flex items-center justify-between mt-2.5 pt-2.5 border-t border-dashed border-gray-100 dark:border-slate-800/80">
        <div class="flex items-center gap-1">
            <span class="text-[11px] text-gray-500 dark:text-slate-400 font-medium">
                Diskon
            </span>

            <!-- Toggle Tipe Diskon (% / Rp) -->
            <div class="inline-flex rounded-md p-0.5 bg-gray-100 dark:bg-slate-800 ml-1">
                <button
                    type="button"
                    @click="tipeDiskon = 'persen'; diskonNilai = Math.min(100, diskonNilai)"
                    :class="tipeDiskon === 'persen' ? 'bg-white dark:bg-slate-700 text-primary shadow-sm' : 'text-gray-400 dark:text-slate-500'"
                    class="px-1.5 py-0.5 text-[10px] font-bold rounded transition-all"
                >
                    %
                </button>
                <button
                    type="button"
                    @click="tipeDiskon = 'nominal'"
                    :class="tipeDiskon === 'nominal' ? 'bg-white dark:bg-slate-700 text-primary shadow-sm' : 'text-gray-400 dark:text-slate-500'"
                    class="px-1.5 py-0.5 text-[10px] font-bold rounded transition-all"
                >
                    Rp
                </button>
            </div>
        </div>

        <!-- Input Nilai Diskon -->
        <div class="relative flex items-center">
            <span 
                x-show="tipeDiskon === 'nominal'" 
                class="absolute left-2 text-[10px] font-bold text-gray-400 pointer-events-none"
            >Rp</span>
            
            <input
                type="number"
                x-model.number="diskonNilai"
                @input="
                    if (diskonNilai < 0 || isNaN(diskonNilai)) diskonNilai = 0;
                    if (tipeDiskon === 'persen' && diskonNilai > 100) diskonNilai = 100;
                "
                :placeholder="tipeDiskon === 'persen' ? '0%' : '0'"
                :class="tipeDiskon === 'nominal' ? 'pl-6' : 'px-2'"
                class="w-24 text-right text-xs font-bold text-gray-800 dark:text-white bg-gray-50 dark:bg-slate-800/50 border border-gray-200 dark:border-slate-700 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary py-1 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
            >
            
            <span 
                x-show="tipeDiskon === 'persen'" 
                class="text-xs font-bold text-gray-400 ml-1"
            >%</span>
        </div>
    </div>

    <!-- Ringkasan Subtotal Item -->
    <div class="flex items-center justify-between mt-2 pt-2 border-t border-gray-100 dark:border-slate-800/60">
        <span class="text-xs font-bold text-gray-700 dark:text-slate-300">
            Subtotal
        </span>
        <span class="text-xs font-black text-slate-900 dark:text-white">
            Rp<span x-text="subtotal.toLocaleString('id-ID')"></span>
        </span>
    </div>

</div>


                        <!-- Item -->
<div class="py-4 border-b border-gray-100 dark:border-slate-800" x-data="{ 
    qty: 2, 
    hargaSatuan: 15000, 
    tipeDiskon: 'persen', // 'persen' atau 'nominal'
    diskonNilai: 0,
    get totalDiskon() {
        if (this.tipeDiskon === 'persen') {
            let pct = Math.min(100, Math.max(0, Number(this.diskonNilai) || 0));
            return (this.hargaSatuan * this.qty) * (pct / 100);
        } else {
            let maxTotal = this.hargaSatuan * this.qty;
            return Math.min(maxTotal, Math.max(0, Number(this.diskonNilai) || 0));
        }
    },
    get subtotal() {
        return Math.max(0, (this.hargaSatuan * this.qty) - this.totalDiskon);
    }
}">

    <!-- Header Item & Gambar -->
    <div class="flex items-center gap-3">
        <div class="w-14 h-14 rounded-xl bg-gray-100 dark:bg-slate-800 flex items-center justify-center shrink-0">
            <i class="bx bxs-coffee text-2xl text-gray-400 dark:text-slate-500"></i>
        </div>

        <div class="flex-1 min-w-0">
            <h4 class="font-black text-gray-900 dark:text-white text-sm truncate">
                Es Kopi Susu
            </h4>
            <div class="flex items-center gap-2 mt-0.5">
                <p class="text-xs font-bold text-primary">
                    Rp<span x-text="hargaSatuan.toLocaleString('id-ID')"></span>
                </p>
                <!-- Badge jika ada diskon aktif -->
                <template x-if="totalDiskon > 0">
                    <span class="text-[10px] font-bold text-red-500 bg-red-50 dark:bg-red-950/40 px-1.5 py-0.5 rounded">
                        -<span x-text="tipeDiskon === 'persen' ? diskonNilai + '%' : 'Rp' + Number(diskonNilai).toLocaleString('id-ID')"></span>
                    </span>
                </template>
            </div>
        </div>

        <!-- Tombol Hapus -->
        <button
            type="button"
            class="w-7 h-7 flex items-center justify-center text-gray-300 dark:text-slate-600 hover:text-red-500 dark:hover:text-red-400 transition-all shrink-0"
            title="Hapus Item"
        >
            <i class="bx bxs-x-circle text-xl"></i>
        </button>
    </div>

    <!-- Kontrol Jumlah (Qty) -->
    <div class="flex items-center justify-between mt-3">
        <span class="text-[11px] text-gray-500 dark:text-slate-400 font-medium">
            Jumlah
        </span>

        <div class="flex items-center gap-2">
            <!-- Tombol Kurang -->
            <button
                type="button"
                @click="qty = Math.max(1, qty - 1)"
                class="w-7 h-7 rounded-lg bg-gray-100 dark:bg-slate-800 text-gray-600 dark:text-gray-300 flex items-center justify-center hover:bg-gray-200 dark:hover:bg-slate-700 transition active:scale-95"
            >
                <i class="bx bxs-minus text-xs"></i>
            </button>

            <!-- Input Jumlah -->
            <input
                type="number"
                x-model.number="qty"
                @input="if (qty > 9999) qty = 9999; if (qty < 1 || isNaN(qty)) qty = 1;"
                min="1"
                max="9999"
                class="w-14 text-center text-sm font-black text-gray-800 dark:text-white bg-transparent border border-gray-200 dark:border-slate-700 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary py-0.5 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
            >

            <!-- Tombol Tambah -->
            <button
                type="button"
                @click="qty = Math.min(9999, qty + 1)"
                class="w-7 h-7 rounded-lg bg-primary text-white flex items-center justify-center hover:opacity-90 transition active:scale-95"
            >
                <i class="bx bxs-plus text-xs"></i>
            </button>
        </div>
    </div>

    <!-- Input Diskon Section -->
    <div class="flex items-center justify-between mt-2.5 pt-2.5 border-t border-dashed border-gray-100 dark:border-slate-800/80">
        <div class="flex items-center gap-1">
            <span class="text-[11px] text-gray-500 dark:text-slate-400 font-medium">
                Diskon
            </span>

            <!-- Toggle Tipe Diskon (% / Rp) -->
            <div class="inline-flex rounded-md p-0.5 bg-gray-100 dark:bg-slate-800 ml-1">
                <button
                    type="button"
                    @click="tipeDiskon = 'persen'; diskonNilai = Math.min(100, diskonNilai)"
                    :class="tipeDiskon === 'persen' ? 'bg-white dark:bg-slate-700 text-primary shadow-sm' : 'text-gray-400 dark:text-slate-500'"
                    class="px-1.5 py-0.5 text-[10px] font-bold rounded transition-all"
                >
                    %
                </button>
                <button
                    type="button"
                    @click="tipeDiskon = 'nominal'"
                    :class="tipeDiskon === 'nominal' ? 'bg-white dark:bg-slate-700 text-primary shadow-sm' : 'text-gray-400 dark:text-slate-500'"
                    class="px-1.5 py-0.5 text-[10px] font-bold rounded transition-all"
                >
                    Rp
                </button>
            </div>
        </div>

        <!-- Input Nilai Diskon -->
        <div class="relative flex items-center">
            <span 
                x-show="tipeDiskon === 'nominal'" 
                class="absolute left-2 text-[10px] font-bold text-gray-400 pointer-events-none"
            >Rp</span>
            
            <input
                type="number"
                x-model.number="diskonNilai"
                @input="
                    if (diskonNilai < 0 || isNaN(diskonNilai)) diskonNilai = 0;
                    if (tipeDiskon === 'persen' && diskonNilai > 100) diskonNilai = 100;
                "
                :placeholder="tipeDiskon === 'persen' ? '0%' : '0'"
                :class="tipeDiskon === 'nominal' ? 'pl-6' : 'px-2'"
                class="w-24 text-right text-xs font-bold text-gray-800 dark:text-white bg-gray-50 dark:bg-slate-800/50 border border-gray-200 dark:border-slate-700 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary py-1 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
            >
            
            <span 
                x-show="tipeDiskon === 'persen'" 
                class="text-xs font-bold text-gray-400 ml-1"
            >%</span>
        </div>
    </div>

    <!-- Ringkasan Subtotal Item -->
    <div class="flex items-center justify-between mt-2 pt-2 border-t border-gray-100 dark:border-slate-800/60">
        <span class="text-xs font-bold text-gray-700 dark:text-slate-300">
            Subtotal
        </span>
        <span class="text-xs font-black text-slate-900 dark:text-white">
            Rp<span x-text="subtotal.toLocaleString('id-ID')"></span>
        </span>
    </div>

</div>

                    </div>


                    <!-- Summary -->

                    <div class="border-t border-gray-100 p-5">

                        <div class="space-y-2.5">

                            <div class="flex items-center justify-between text-sm">

                                <span class="text-gray-400">
                                    Subtotal
                                </span>

                                <span class="font-bold text-gray-700">
                                    Rp68.000
                                </span>

                            </div>

                            <div class="flex items-center justify-between text-sm">

                                <span class="text-gray-400">
                                    Diskon
                                </span>

                                <span class="font-bold text-gray-700">
                                    Rp0
                                </span>

                            </div>

                        </div>


                        <div class="flex items-end justify-between mt-5 pt-4 border-t border-dashed border-gray-200">

                            <div>

                                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">
                                    Total
                                </span>

                                <span class="text-2xl font-black text-gray-900">
                                    Rp68.000
                                </span>

                            </div>

                        </div>


                        <button
                            type="button"
                            @click="open = true"
                            class="w-full h-12 mt-5 flex items-center justify-center gap-2 rounded-xl bg-primary text-white font-black hover:opacity-90 active:scale-[.98] transition-all"
                        >

                            <i class="bx bxs-wallet text-xl"></i>

                            Bayar Sekarang

                        </button>

                    </div>

                </div>

            </aside>

        </div>


<!-- =========================
    MODAL PEMBAYARAN
========================= -->
<div 
    x-show="open"
    x-cloak
    @keydown.escape.window="open = false"
    class="fixed inset-0 z-[999] flex justify-center items-center w-full p-4 sm:p-6 overflow-y-auto"
>

    <!-- Backdrop -->
    <div 
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-slate-950/60 backdrop-blur-[2px]"
        @click="open = false"
    ></div>

    <!-- Modal Panel -->
    <div 
        x-show="open"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4 sm:translate-y-2"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4 sm:translate-y-2"
        class="relative w-full max-w-4xl z-10 my-auto"
    >

        <div class="relative bg-white border border-gray-200 rounded-3xl shadow-xl p-6 sm:p-10 max-h-[calc(100vh-2rem)] overflow-y-auto">

            <!-- Header Modal -->
            <div class="mb-6 sm:mb-8 flex justify-between items-start sm:items-center gap-4">
                <div class="flex items-center gap-4 min-w-0">
                    <div class="flex w-12 h-12 rounded-2xl bg-primary items-center justify-center shrink-0 shadow-sm">
                        <i class="bx bxs-receipt text-2xl text-white"></i>
                    </div>
                    <div class="min-w-0">
                        <h1 class="text-slate-900 font-black text-xl sm:text-2xl leading-tight">
                            Proses Pembayaran
                        </h1>
                        <p class="text-xs sm:text-sm text-gray-500 font-medium mt-1">
                            Selesaikan transaksi pesanan pelanggan dengan cepat dan akurat.
                        </p>
                    </div>
                </div>

                <button 
                    type="button"
                    @click="open = false"
                    class="flex items-center justify-center w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-slate-100 text-slate-500 hover:text-white hover:bg-primary font-black cursor-pointer transition-colors shrink-0"
                    title="Tutup"
                >
                    <i class="bx bx-x text-2xl"></i>
                </button>
            </div>

            <!-- Konten Grid 2 Kolom -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-4">

                <!-- ================= KOLOM KIRI: RINGKASAN PESANAN ================= -->
                <div class="flex flex-col justify-between bg-white">
                    <div class="space-y-5">
                        <h2 class="text-xs font-black uppercase tracking-wider text-gray-600 flex items-center gap-2">
                            <i class="bx bxs-rows text-base text-primary"></i>
                            Daftar Item Pesanan
                        </h2>

                        <!-- List Item -->
                        <div class="space-y-4 max-h-72 overflow-y-auto pr-1">
                            <div class="p-4 bg-white rounded-2xl border border-gray-100 shadow-2xs">
                                <div class="flex items-center gap-3.5">
                                    <div class="w-14 h-14 rounded-xl bg-gray-100 flex items-center justify-center shrink-0">
                                        <i class="bx bxs-bowl-hot text-2xl text-gray-400"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-black text-gray-900 text-sm truncate">
                                            Nasi Goreng Spesial
                                        </h4>
                                        <p class="text-xs font-bold text-primary mt-1">
                                            Rp25.000
                                        </p>
                                    </div>
                                    <button
                                        type="button"
                                        class="w-8 h-8 flex items-center justify-center rounded-xl text-gray-300 hover:bg-red-50 hover:text-red-500 transition-all cursor-pointer"
                                    >
                                        <i class="bx bxs-x text-lg"></i>
                                    </button>
                                </div>

                                <div class="flex items-center justify-between mt-4 pt-3 border-t border-gray-100">
                                    <span class="text-xs text-gray-400 font-semibold">
                                        Jumlah Porsi
                                    </span>

                                    <div class="flex items-center gap-2.5" x-data="{ qty: 2 }">
                                        <button
                                            type="button"
                                            @click="qty = Math.max(1, qty - 1)"
                                            class="w-8 h-8 rounded-xl bg-gray-100 text-gray-600 flex items-center justify-center hover:bg-gray-200 transition cursor-pointer"
                                        >
                                            <i class="bx bxs-minus text-xs"></i>
                                        </button>

                                        <input
                                            type="number"
                                            x-model.number="qty"
                                            @input="if (qty > 9999) qty = 9999; if (qty < 1 || isNaN(qty)) qty = 1;"
                                            min="1"
                                            max="9999"
                                            class="w-14 text-center text-sm font-black text-gray-800 bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-primary py-1 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                        >

                                        <button
                                            type="button"
                                            @click="qty = Math.min(9999, qty + 1)"
                                            class="w-8 h-8 rounded-xl bg-primary text-white flex items-center justify-center hover:opacity-90 transition cursor-pointer"
                                        >
                                            <i class="bx bxs-plus text-xs"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Harga Kiri -->
                    <div class="mt-6 pt-5 border-t border-gray-200/80 flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wide text-gray-500">Total Tagihan</span>
                        <span class="text-xl sm:text-2xl font-black text-primary" x-text="'Rp' + total.toLocaleString('id-ID')">Rp68.000</span>
                    </div>
                </div>

                <!-- ================= KOLOM KANAN: FORM PEMBAYARAN ================= -->
                <div class="flex flex-col justify-between">
                    <div class="space-y-5">
                        <!-- 1. Kode Transaksi -->
                        <div class="flex flex-col gap-2 w-full min-w-0">
                            <label class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 ml-1">
                                Kode Transaksi
                            </label>
                            <div class="relative flex items-center w-full">
                                <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400">
                                    <i class="bx bx-qr text-xl sm:text-lg"></i>
                                </div>
                                <input 
                                    type="text"
                                    readonly
                                    value="TRX-20260823-001"
                                    class="w-full pl-11 pr-4 py-3.5 bg-slate-100 text-slate-500 text-sm font-bold rounded-2xl border-2 border-gray-200/80 cursor-not-allowed outline-none"
                                >
                            </div>
                        </div>

                        <!-- 2. Nama Pelanggan -->
                        <div class="flex flex-col gap-2 w-full min-w-0">
                            <label class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 ml-1">
                                Nama Pelanggan <span class="text-red-500">*</span>
                            </label>
                            <div class="relative flex items-center w-full group">
                                <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200 z-10">
                                    <i class="bx bx-user text-xl sm:text-lg"></i>
                                </div>
                                <select 
                                    x-model="pelanggan"
                                    required
                                    class="w-full pl-11 pr-10 py-3.5 bg-white text-slate-900 text-sm font-medium rounded-2xl border-2 border-gray-200/80 focus:outline-none focus:ring-1 focus:ring-primary appearance-none cursor-pointer transition-all"
                                >
                                    <option value="" disabled selected>Pilih Pelanggan</option>
                                    <option value="Udin">Udin</option>
                                    <option value="Jamal">Jamal</option>
                                </select>
                                <div class="absolute right-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200">
                                    <i class="bx bx-chevron-down text-xl"></i>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Metode Pembayaran -->
                        <div class="flex flex-col gap-2 w-full min-w-0">
                            <label class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 ml-1">
                                Metode Pembayaran <span class="text-red-500">*</span>
                            </label>
                            <div class="relative flex items-center w-full group">
                                <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200 z-10">
                                    <i class="bx bx-wallet text-xl sm:text-lg"></i>
                                </div>
                                <select 
                                    x-model="metode"
                                    required
                                    class="w-full pl-11 pr-10 py-3.5 bg-white text-slate-900 text-sm font-medium rounded-2xl border-2 border-gray-200/80 focus:outline-none focus:ring-1 focus:ring-primary appearance-none cursor-pointer transition-all"
                                >
                                    <option value="" disabled>Pilih Metode Pembayaran</option>
                                    <option value="Tunai">Tunai</option>
                                    <option value="QRIS">QRIS</option>
                                    <option value="QRIS">Transfer Bank</option>
                                    <option value="Hutang">Hutang (Bayar Nanti)</option>
                                </select>
                                <div class="absolute right-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200">
                                    <i class="bx bx-chevron-down text-xl"></i>
                                </div>
                            </div>
                        </div>

                        <!-- 4. Nominal Dibayar -->
                        <div class="flex flex-col gap-2 w-full min-w-0" x-show="metode === 'Tunai' || metode === 'QRIS'" x-transition>
                            <label class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 ml-1">
                                Nominal Dibayar <span class="text-red-500">*</span>
                            </label>
                            <div class="relative flex items-center w-full group">
                                <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200">
                                    <span class="text-sm font-bold">Rp</span>
                                </div>
                                <input 
                                    type="number"
                                    x-model.number="nominal"
                                    min="0"
                                    placeholder="Contoh: 100000"
                                    class="w-full pl-11 pr-4 py-3.5 bg-white text-slate-900 text-sm font-medium rounded-2xl border-2 border-gray-200/80 focus:outline-none focus:ring-1 focus:ring-primary transition-all"
                                >
                            </div>
                        </div>

                        <!-- 5. Tampilan Kembalian -->
                        <div x-show="metode === 'Tunai'" x-transition class="relative overflow-hidden p-5 rounded-2xl flex items-center justify-between shadow-xs">
                            <div class="absolute -right-4 -bottom-4 text-primary/10 pointer-events-none">
                                <i class='bx bx-wallet-alt text-7xl'></i>
                            </div>
                            <div class="space-y-1 z-10">
                                <div class="flex items-center gap-1.5 text-primary font-black text-sm uppercase tracking-wider">
                                    <span>Kembalian</span>
                                </div>
                                <p class="text-[11px] text-gray-500 font-medium">Dihitung otomatis dari uang tunai</p>
                            </div>
                            <div class="z-10 text-right">
                                <span class="text-xl sm:text-2xl font-black text-primary" x-text="'Rp' + Math.max(0, nominal - total).toLocaleString('id-ID')">
                                    Rp0
                                </span>
                            </div>
                        </div>

                    </div>

                    <!-- Tombol Aksi -->
                    <div class="w-full flex flex-col-reverse sm:flex-row justify-end mt-8 pt-5 border-t border-gray-100 gap-3.5">
                        <button 
                            type="button"
                            @click="open = false"
                            class="w-full sm:w-auto flex items-center justify-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-6 py-3.5 gap-2 rounded-2xl cursor-pointer transition-all active:scale-95"
                        >
                            <span>Batal</span>
                        </button>

                        <button 
                            type="button"
                            :disabled="metode === '' || (metode === 'Tunai' && nominal < total)"
                            :class="metode === '' || (metode === 'Tunai' && nominal < total) ? 'opacity-40 cursor-not-allowed' : 'hover:bg-primary/90 active:scale-95'"
                            class="w-full sm:w-auto flex items-center justify-center bg-primary text-white font-black px-6 py-3.5 gap-2 rounded-2xl cursor-pointer transition-all shadow-sm"
                        >
                            <i class="bx bxs-check-shield text-lg"></i>
                            <span>Simpan Transaksi</span>
                        </button>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
    </div>
</section>
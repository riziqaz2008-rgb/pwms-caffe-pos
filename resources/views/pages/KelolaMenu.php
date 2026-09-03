
<section id="Menu">
    <div class="w-full">
        <div class="flex flex-col md:flex-row md:items-start justify-between gap-5">
            <div class="flex items-center gap-4 min-w-0">
                <div
                    class="w-13 h-13 rounded-lg bg-primary border-y border-indigo-100 flex items-center justify-center shrink-0">
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
            <div class="flex flex-row gap-3 mt-1">
                <a href="?route=menu/kategori"
                    class="w-full sm:w-auto flex items-center justify-center gap-2 text-gray-700 font-bold px-5 py-3 border border-gray-200 rounded-lg  hover:bg-slate-50 active:scale-95 transition-all duration-200">
                        <i class="bx bxs-book-bookmark text-md"></i>
                    <span>Kategori</span>
                </a>
                <button type="button" 
                    onclick='showGlobalModal(<?= json_encode([
                        "title" => "Tambah Menu",
                        "subtitle" => "Kelola daftar menu, harga, kategori, dan informasi menu cafe.",
                        "icon" => "bxs-bowl-hot",
                        "iconBg" => "bg-primary",
                        "method" => "POST",
                        "buttonText" => "Simpan Menu",
                        "buttonIcon" => "bxs-save",
                        "buttonColor" => "bg-primary hover:bg-blue-700",

                        "nameBtn" => "aksi",
                        "value" => "tambah" 
                    ]) ?>)'
                    class="w-full sm:w-auto flex items-center justify-center gap-2 bg-primary text-white font-bold px-6 py-3 rounded-lg hover:bg-blue-700 active:scale-95 transition-all duration-200">
                        <i class="bx bxs-plus text-xl"></i>
                    <span>Tambah Menu</span>
                </button>
            </div>
        </div>

        <div class="bg-white overflow-hidden border-gray-200/80 mt-4 sm:mt-8">
            <div class="py-6  border-gray-200/80">
                <div class="grid grid-cols-2 lg:grid-cols-4 divide-x divide-gray-200">

                    <div class="flex items-center gap-4 px-5 py-4">
                        <div class="w-12 h-12 rounded-lg bg-primary flex items-center justify-center shrink-0">
                            <i class="bx bxs-fork-spoon text-xl text-white"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-400">Total Menu</p>
                            <p class="text-2xl font-extrabold text-slate-800 mt-0.5" id="totalMenuStat"><?= (totalmenu()); ?></p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 px-5 py-4">
                        <div class="w-12 h-12 rounded-lg bg-primary flex items-center justify-center shrink-0">
                            <i class="bx bxs-book-bookmark text-xl text-white"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-400">Total Kategori</p>
                            <p class="text-2xl font-extrabold text-slate-800 mt-0.5" id="totalCategoryStat"><?= (totalkategori()); ?></p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 px-5 py-4">
                        <div class="w-12 h-12 rounded-lg bg-primary flex items-center justify-center shrink-0">
                            <i class="bx bxs-check-circle text-xl text-white"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-400">Menu Aktif</p>
                            <p class="text-2xl font-extrabold text-slate-800 mt-0.5" id="activeMenuStat"><?= (totalaktif()); ?></p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 px-5 py-4">
                        <div class="w-12 h-12 rounded-lg bg-primary flex items-center justify-center shrink-0">
                            <i class="bx bxs-x-circle text-xl text-white"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-400">Menu Nonaktif</p>
                            <p class="text-2xl font-extrabold text-slate-800 mt-0.5" id="inactiveMenuStat"><?= (totalnonaktif()); ?></p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="mt-4 p-3">
                <form method="GET" class="flex flex-col md:flex-row rounded-lg bg-white overflow-hidden" id="formCariMenu">

    <input type="hidden" name="route" value="menu">

    <div class="relative w-full md:w-52 shrink-0">
        <select 
            name="kategori"
            onchange="this.form.submit()"
            class="w-full h-12 pl-4 pr-10 bg-slate-50 text-sm font-bold text-gray-700 border border-gray-200 rounded-t-xl md:rounded-t-none md:rounded-l-xl md:border-r-0 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary focus:z-10 cursor-pointer appearance-none">
            <option value="">Semua Kategori</option>
            <?php foreach ($kategori as $k): ?>
                <option 
                    value="<?= $k['id_kategori']; ?>"
                    <?= ($kategoripilih == $k['id_kategori']) ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($k['nama_kategori']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-400">
            <i class="bx bxs-chevron-down text-lg"></i>
        </div>
    </div>
    <div class="relative flex-1">
        <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-gray-400 z-20">
            <i class="bx bx-search text-xl"></i>
        </div>
        <input 
            type="search" name="keyword" id="searchMenu" value="<?= htmlspecialchars($keyword ?? '') ?>" class="w-full h-12 pl-11 pr-4 bg-white border-x border-b md:border-y md:border-x-0 border-gray-200 text-sm font-semibold text-slate-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary focus:z-10"placeholder="Cari nama menu...">
    </div>
    <button 
        type="submit"
        class="h-12 px-5 inline-flex items-center justify-center gap-2 bg-primary text-white text-sm font-bold border-0 rounded-b-xl md:rounded-b-none md:rounded-r-xl hover:bg-primary-dark focus:outline-none focus:ring-1 focus:ring-inset focus:ring-primary focus:z-10 transition-all shrink-0">
        <i class="bx bx-search text-lg"></i>
        <span class="hidden sm:inline">Cari</span>
    </button>
</form>
            </div>
        </div>

        <div class="px-4 my-8">
            <div class="flex items-center justify-between mt-8 mb-5">
                <div class="min-w-0">
                    <div class="flex items-center gap-2">
                        <div class="w-1.5 h-5 rounded-full bg-primary"></div>
                        <h2 class="text-xl font-black text-slate-800 dark:text-white">Daftar Menu</h2>
                    </div>
                    <p class="text-xs font-medium text-slate-400 mt-1 ml-3.5">Kelola menu yang tersedia di KedaiKu.</p>
                </div>
                <div class="flex items-center gap-1 p-1.5 rounded-lg border-2 border-gray-200/80 dark:border-slate-700 bg-white dark:bg-slate-800 shrink-0 min-h-[48px]">
                    <a href="?route=menu&layoutMode=table" title="Tampilan Tabel"
                        class="flex items-center justify-center w-9 h-9 rounded-lg text-lg transition-colors <?= $layoutMode == 'table' ? 'bg-primary text-white font-bold shadow-sm' : 'text-slate-400 hover:text-slate-600 dark:hover:text-slate-200' ?>">
                        <i class="bx bxs-rows"></i>
                    </a>
                    <a href="?route=menu&layoutMode=grid"  title="Tampilan Grid"
                        class="flex items-center justify-center w-9 h-9 rounded-lg text-lg transition-colors <?= $layoutMode == 'grid' ? 'bg-primary text-white font-bold shadow-sm' : 'text-slate-400 hover:text-slate-600 dark:hover:text-slate-200' ?>"                    >
                        <i class="bx bxs-grid"></i>
                    </a>
                </div>
            </div>
            
            <div class="overflow-y-auto p-1 max-h-[700px]">
                <?php if ($layoutMode == 'table'): ?>                    
                    <div class="w-full overflow-x-auto">
                        <table id="selection-table" class="w-full min-w-[900px] text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-500 uppercase bg-slate-50 dark:bg-slate-900">
                                <tr>
                                    <th scope="col" class="px-5 py-4 font-bold">#</th>
                                    <th scope="col" class="px-5 py-4 font-bold">Foto</th>
                                    <th scope="col" class="px-5 py-4 font-bold">Nama Menu</th>
                                    <th scope="col" class="px-5 py-4 font-bold">Harga</th>
                                    <th scope="col" class="px-5 py-4 font-bold">Kategori</th>
                                    <th scope="col" class="px-5 py-4 font-bold">Tersedia</th>
                                    <th scope="col" class="px-5 py-4 font-bold">Status</th>
                                    <th scope="col" class="px-5 py-4 text-center font-bold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($menu as $m): ?>
                                    <tr class="group hover:bg-slate-50 transition-colors">

                                        <!-- YANG DI KOMENT INI CONTOH JIKA ADA VALUE NYA.
                                        SILAHKAN DI SESUAIKAN ISI DATABASE. -->

                                        <td class="px-5 py-4 font-bold text-gray-500"><?= $no++ ?></td>
                                        <td class="px-5 py-4">

                                            <!-- JIKA GAMBAR KOSONG -->

                                            <!-- <div class="w-11 h-11 rounded-lg bg-gray-100 flex items-center justify-center shrink-0">
                                                <i class="bx bxs-bowl-hot text-xl text-gray-400"></i>
                                            </div> -->

                                            <div class="w-11 h-11 rounded-full bg-gray-100 flex items-center justify-center shrink-0 overflow-hidden">
                                                <img
                                                    src="public/images/<?= $m['foto']; ?>"
                                                    class="w-full h-full object-cover"
                                                    alt="alt">
                                            </div>
                                        </td>
                                        <td class="px-5 py-4">
                                            <span class="font-bold text-slate-800"><?= $m['nama'] ?></span>
                                        </td>
                                        <td class="px-5 py-4">
                                            <span class="font-bold text-slate-800">Rp <?= number_format($m['harga'], 0, ',', '.') ?></span>
                                        </td>
                                        <td class="px-5 py-4">
                                            <span class="inline-flex items-center px-6 py-2 rounded-lg bg-primary text-white text-sm font-bold">
                                                <?= $m['nama_kategori']; ?>
                                            </span>
                                        </td>
                                        <td class="px-5 py-4">
                                            <?php if ($m['menu_tersedia'] == 1): ?>
                                            
                                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-green-600 bg-green-50 text-xs font-bold">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                                    Tersedia
                                                </span>
                                            
                                            <?php else: ?>
                                            
                                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-red-600 bg-red-50 text-xs font-bold">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                                    Tidak Tersedia
                                                </span>
                                            
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-5 py-4">
                                            <?php if ($m['status_menu'] == 1): ?>
                                            
                                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-green-600 bg-green-50 text-xs font-bold">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                                    Aktif
                                                </span>
                                            
                                            <?php else: ?>
                                            
                                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-red-600 bg-red-50 text-xs font-bold">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                                    Nonaktif
                                                </span>
                                            
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-5 py-4">
                                            <div class="flex items-center justify-center gap-2">
                                                <button type="button" 
                                                    onclick='showGlobalModal(<?= json_encode([
                                                        "title" => "Edit Menu",
                                                        "subtitle" => "Perbarui informasi menu cafe.",
                                                        "icon" => "bxs-edit",
                                                        "iconBg" => "bg-amber-500",
                                                        "method" => "POST",
                                                        "buttonText" => "Simpan Perubahan",
                                                        "buttonIcon" => "bxs-save",
                                                        "buttonColor" => "bg-amber-500 hover:bg-amber-600",
                                                        
                                                        "nameBtn" => "aksi",
                                                        "value" => "edit"          
                                                    ]) ?>)
                                                    modalEdit(this) '
                                                    class="w-10 h-10 rounded-lg bg-primary text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all" title="Edit menu"
                                                     data-id="<?= htmlspecialchars($m['id_menu']) ?>" data-foto="<?= htmlspecialchars($m['foto']) ?>" data-nama="<?= htmlspecialchars($m['nama']) ?>" data-harga="<?= number_format($m['harga'], 0, ',', '.') ?>" data-kategori="<?= htmlspecialchars($m['id_kategori']) ?>" data-deskripsi="<?= htmlspecialchars($m['deskripsi']) ?>" data-menu="<?= htmlspecialchars($m['menu_tersedia']) ?>" data-status="<?= htmlspecialchars($m['status_menu']) ?>">

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

                                        <!-- <td colspan="7">
                                            <div class="flex flex-col items-center justify-center py-12 px-4 text-center bg-gray-50">
                                                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-gray-200/80">
                                                    <i class="bx bxs-dish text-4xl text-gray-300"></i>
                                                </div>
                                                <h3 class="text-base font-black text-slate-800 mb-1">Menu Belum Tersedia</h3>
                                                <p class="text-xs text-gray-400 max-w-sm mb-5">
                                                    Belum ada data menu yang ditambahkan atau hasil pencarian tidak cocok.
                                                </p>
                                                <button type="button" 
                                                onclick='showGlobalModal(<?= json_encode([
                                                    "title" => "Tambah Menu",
                                                    "subtitle" => "Kelola daftar menu, harga, kategori, dan informasi menu cafe.",
                                                    "icon" => "bxs-bowl-hot",
                                                    "iconBg" => "bg-primary",
                                                    "action" => "/menu/store",
                                                    "method" => "POST",
                                                    "buttonText" => "Simpan Menu",
                                                    "buttonIcon" => "bxs-save",
                                                    "buttonColor" => "bg-primary hover:bg-blue-700",
                                                    
                                                    "nameBtn" => "aksi",
                                                    "value" => "tambah"   
                                                ]) ?>)' 
                                                class="px-4 py-3 bg-primary text-white text-sm font-bold rounded-lg hover:opacity-90 transition-all flex items-center gap-2">
                                                    <i class="bx bxs-plus text-base"></i>
                                                    <span>Tambah Menu</span>
                                                </button>
                                            </div>
                                        </td> -->

                                    </tr>
                                <?php endforeach; ?>                        
                            </tbody>
                        </table>
                    </div>
                
<?php elseif ($layoutMode == 'grid'): ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        <?php foreach ($menu as $m): ?>

            <!-- YANG DI KOMENT INI CONTOH JIKA ADA VALUE NYA.
            SILAHKAN DI SESUAIKAN ISI DATABASE. -->

            <div class="flex flex-row sm:flex-col group bg-white border border-gray-200 rounded-lg overflow-hidden transition-all duration-200">
                <div class="relative w-36 h-36 shrink-0 sm:w-full sm:h-48 overflow-hidden bg-gray-100">
                    <img
                       src="public/images/<?= $m['foto']; ?>"
                        loading="lazy"
                        class="w-full h-full object-cover object-center group-hover:scale-105 transition duration-300"
                        alt="<?= $m['nama']; ?>">
                    <div class="absolute top-2.5 left-2.5 sm:top-3 sm:left-3">
                        <span class="px-2.5 py-1 sm:px-3 sm:py-1.5 rounded-lg bg-primary text-[10px] sm:text-xs font-black text-white">
                            <?= $m['nama_kategori']; ?>
                        </span>
                    </div>
                </div>
                <div class="p-4 sm:p-5 flex-1 min-w-0 flex flex-col justify-between">
                    <h3 class="font-black text-gray-900 text-base sm:text-lg line-clamp-2 leading-snug">
                        <?= $m['nama']; ?>
                    </h3>
                    <div class="flex items-end justify-between gap-3 mt-4 sm:mt-6 pt-2">
                        <div class="min-w-0">
                            <span class="text-[10px] uppercase tracking-wider font-bold text-gray-400 block mb-0.5">
                                Harga
                            </span>
                            <span class="text-base sm:text-lg font-black text-gray-900 whitespace-nowrap">
                                Rp <?= number_format($m['harga'], 0, ',', '.'); ?>
                            </span>
                        </div>
                        <div class="flex gap-x-2.5">
                            <button
                                 type="button" 
                                                    onclick='showGlobalModal(<?= json_encode([
                                                        "title" => "Edit Menu",
                                                        "subtitle" => "Perbarui informasi menu cafe.",
                                                        "icon" => "bxs-edit",
                                                        "iconBg" => "bg-amber-500",
                                                        "method" => "POST",
                                                        "buttonText" => "Simpan Perubahan",
                                                        "buttonIcon" => "bxs-save",
                                                        "buttonColor" => "bg-amber-500 hover:bg-amber-600",
                                                        
                                                        "nameBtn" => "aksi",
                                                        "value" => "edit"          
                                                    ]) ?>)
                                                    modalEdit(this) '
                                                    class="w-10 h-10 rounded-lg bg-primary text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all" title="Edit menu"
                                                     data-id="<?= htmlspecialchars($m['id_menu']) ?>" data-foto="<?= htmlspecialchars($m['foto']) ?>" data-nama="<?= htmlspecialchars($m['nama']) ?>" data-harga="<?= number_format($m['harga'], 0, ',', '.') ?>" data-kategori="<?= htmlspecialchars($m['id_kategori']) ?>" data-deskripsi="<?= htmlspecialchars($m['deskripsi']) ?>" data-menu="<?= htmlspecialchars($m['menu_tersedia']) ?>" data-status="<?= htmlspecialchars($m['status_menu']) ?>">

                                                    <i class="bx bxs-pencil"></i>
                                                </button>
                        
                            <button
                                type="button"
                                class="w-10 h-10 rounded-xl bg-red-600 text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all shrink-0"
                                title="Hapus menu">
                                <i class="bx bxs-trash text-lg"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- YANG DI BAWAH INI CONTOH JIKA VALUE NYA KOSONG. -->

   
    <div class="flex flex-col items-center justify-center py-12 px-4 text-center">
        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-gray-200/80">
            <i class="bx bxs-dish text-4xl text-gray-300"></i>
        </div>

        <h3 class="text-base font-black text-slate-800 mb-1">
            Menu Belum Tersedia
        </h3>

        <p class="text-xs text-gray-400 max-w-sm mb-5">
            Belum ada data menu yang ditambahkan atau hasil pencarian tidak cocok.
        </p>

        <button
            type="button"
            @click="TambahMenu = true"
            class="px-4 py-3 bg-primary text-white text-sm font-bold rounded-lg hover:opacity-90 transition-all flex items-center gap-2"
        >
            <i class="bx bxs-plus text-base"></i>
            <span>Tambah Menu</span>
        </button>
    </div>
   
<?php endif; ?>

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
            
    <div id="global-modal" class="hidden fixed inset-0 z-[9999] items-center justify-center w-full p-4 sm:p-6 overflow-y-auto bg-slate-950/60 backdrop-blur-[2px]">
        <div class="relative w-full max-w-5xl my-auto">
            <div class="relative bg-white border border-gray-200 rounded-lg shadow-xl p-5 sm:p-8 max-h-[calc(100vh-2rem)] overflow-y-auto">
                <div class="mb-6 sm:mb-8 flex justify-between items-start sm:items-center gap-4">
                    <div class="flex items-center gap-3 sm:gap-4 min-w-0">
                        <div class="globalModalIconContainer flex w-12 h-12 rounded-lg bg-primary items-center justify-center shrink-0 shadow-sm">
                            <i id="globalModalIcon" class="bx bxs-bowl-hot text-2xl text-white"></i>
                        </div>
                        <div class="min-w-0">
                            <h1 id="globalModalTitle" class="text-slate-900 font-black text-xl sm:text-2xl leading-tight">Tambah Menu</h1>
                            <p id="globalModalSubtitle" class="text-xs sm:text-sm text-gray-500 font-medium mt-1">Kelola daftar menu, harga, kategori, dan informasi menu cafe.</p>
                        </div>
                    </div>
                    <button type="button" onclick="closeGlobalModal()" title="Tutup" class="flex items-center justify-center w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-slate-100 text-slate-500 hover:text-white hover:bg-primary font-black cursor-pointer transition-colors shrink-0">
                        <i class="bx bxs-x text-2xl"></i>
                    </button>
                </div>
                <form id="globalModalForm" action="" method="POST" enctype="multipart/form-data" class="w-full">
                     <input type="hidden" id="id" name="id">
                    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-x-6 gap-y-5">
                        <div class="flex flex-col gap-1.5 w-full min-w-0">
                            <label for="globalModalInput" class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 ml-1">Nama Menu <span class="text-red-500">*</span></label>
                            <div class="relative flex items-center w-full group">
                                <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200">
                                    <i class="bx bxs-price-tag-alt text-xl sm:text-lg"></i>
                                </div>
                                <input type="text" name="nama" id="nama"maxlength="100" id="globalModalInput" placeholder="Contoh: Nasi Goreng Special" autocomplete="off" class="w-full pl-10 sm:pl-11 pr-4 py-3 bg-white text-slate-900 text-sm font-medium rounded-lg border-2 border-gray-200/80 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary transition-all" required>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1.5 w-full min-w-0">
                            <label for="hargaJual" class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 ml-1">Harga Jual (Rp) <span class="text-red-500">*</span></label>
                            <div class="relative flex items-center w-full group">
                                <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200">
                                    <i class="bx bxs-coin text-xl sm:text-lg"></i>
                                </div>
                                <input type="text" inputmode="numeric" name="harga" id="harga" maxlength="9" placeholder="Contoh: 50000" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.')" class="w-full pl-10 sm:pl-11 pr-4 py-3 bg-white text-slate-900 text-sm font-medium rounded-lg border-2 border-gray-200/80 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary transition-all" required>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1.5 w-full min-w-0">
                            <label for="kategoriTambah" class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 ml-1">Kategori <span class="text-red-500">*</span></label>
                            <div class="relative flex items-center w-full group">
                                <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200 z-10">
                                    <i class="bx bxs-filter text-xl sm:text-lg"></i>
                                </div>
                                <select name="kategori" id="kategori" required class="w-full pl-10 sm:pl-11 pr-10 py-3 bg-white text-slate-900 text-sm font-medium rounded-lg border-2 border-gray-200/80 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary appearance-none cursor-pointer transition-all">
                                    
                                <?php foreach ($kategori as $k): ?>
                            <option value="<?= $k['id_kategori']; ?>">
                                <?= htmlspecialchars($k['nama_kategori']); ?>
                            </option>
                                <?php endforeach; ?>
                                </select>
                                <div class="absolute right-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200">
                                    <i class="bx bxs-chevron-down text-xl"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1.5 w-full group col-span-1 lg:col-span-2 xl:col-span-3 min-w-0">
                            <label for="deskripsi" class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 ml-1">Deskripsi & Catatan</label>
                            <div class="relative flex w-full h-full">
                                <div class="absolute left-3.5 top-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors duration-200">
                                    <i class="bx bxs-info-octagon text-xl sm:text-lg"></i>
                                </div>
                                <textarea name="deskripsi" maxlength="200" id="deskripsi" rows="3" placeholder="Tambahkan deskripsi menu..." class="w-full pl-10 sm:pl-11 pr-4 py-3 bg-white text-slate-900 text-sm font-medium rounded-lg border-2 border-gray-200/80 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary resize-y transition-all"></textarea>
                            </div>
                        </div>
                        <div x-data="{ imageUrl: null }" class="flex flex-col gap-1.5 w-full col-span-1 lg:col-span-2 xl:col-span-3 min-w-0">
                            <label class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 ml-1">Foto Menu</label>
                            <label for="gambarBarang" class="relative border-2 border-dashed border-gray-200/90 hover:border-primary group transition-all duration-200 rounded-lg p-6 sm:p-8 flex flex-col items-center justify-center cursor-pointer text-center bg-slate-50/40 hover:bg-slate-50 overflow-hidden min-h-[160px]">
                                <div x-show="!imageUrl" class="flex flex-col items-center justify-center gap-3">
                                    <div class="globalModalIconContainer w-12 h-12 text-white bg-primary rounded-lg flex items-center justify-center shadow-sm">
                                        <i class="bx bxs-images text-2xl text-white"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-sm text-slate-800">Upload Foto Menu</p>
                                        <p class="text-gray-400 text-xs mt-0.5">JPG, PNG, WEBP (Maks. 2MB)</p>
                                    </div>
                                </div>
                                <template x-if="imageUrl">
                                    <div class="relative flex flex-col items-center justify-center w-full h-full">
                                        <img :src="imageUrl" class="max-h-40 w-auto object-cover rounded-lg shadow-md border border-gray-100" />
                                        <button type="button" @click.stop.prevent="imageUrl = null; $refs.fileInput.value = ''" class="mt-3 px-3 py-1 text-sm font-semibold bg-red-600 text-white hover:bg-red-700 rounded-lg transition-colors flex items-center gap-1">
                                            <i class="bx bxs-trash"></i> Hapus Foto
                                        </button>
                                    </div>
                                </template>
                                <input x-ref="fileInput" type="file" id="gambarBarang" name="gambarBarang" class="hidden" accept="image/jpeg,image/png,image/webp" @change="const file = $event.target.files[0]; if (file) { const reader = new FileReader(); reader.onload = (e) => { imageUrl = e.target.result; }; reader.readAsDataURL(file); }">
                            </label>
                        </div>
                        <div class="flex flex-col gap-1.5 w-full col-span-1 lg:col-span-2 xl:col-span-2 min-w-0">
                            <div class="flex items-center justify-between p-4 sm:p-5 bg-gray-50 rounded-lg border border-gray-200/80">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700">Menu Tersedia</label>
                                    <p class="text-xs text-gray-500 font-medium mt-0.5">Aktifkan jika menu ini siap untuk dipesan oleh pelanggan.</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer shrink-0">
                                    <input type="checkbox" name="menu" id="menu" value="1" class="sr-only peer" checked>
                                    <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                </label>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1.5 w-full col-span-1 lg:col-span-2 xl:col-span-1 min-w-0">
                            <div class="flex items-center justify-between p-4 sm:p-5 bg-gray-50 rounded-lg border border-gray-200/80">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700">Status Menu</label>
                                    <p class="text-xs text-gray-500 font-medium mt-0.5">Aktifkan jika menu tersedia.</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer shrink-0">
                                    <input type="checkbox" name="status" id="status" value="1" class="sr-only peer" checked>
                                    <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="w-full flex flex-col-reverse sm:flex-row justify-end mt-6 sm:mt-8 pt-5 border-t border-gray-100 gap-3">
                        <button type="button" onclick="closeGlobalModal()" class="w-full sm:w-auto flex items-center justify-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-6 py-3 gap-2 rounded-lg cursor-pointer transition-all active:scale-95">
                            <span>Batal</span>
                        </button>
                        <button id="globalModalSubmit" type="submit" class="w-full sm:w-auto flex items-center justify-center bg-primary hover:bg-primary/90 text-white font-black px-6 py-3 gap-2 rounded-lg cursor-pointer transition-all active:scale-95">
                            <i id="globalModalSubmitIcon" class="bx bxs-save text-lg"></i>
                            <span id="globalModalSubmitText">Simpan Menu</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
const searchMenu = document.getElementById('searchMenu');
const formCariMenu = document.getElementById('formCariMenu');

let typingTimer;

searchMenu.addEventListener('input', function () {

    clearTimeout(typingTimer);

    typingTimer = setTimeout(function () {
        formCariMenu.submit();
    }, 500);

});

function modalEdit(btn){
      $('#id').val(btn.dataset.id);
      $('#gambarBarang').val(btn.dataset.gambarBarang);
      $('#nama').val(btn.dataset.nama);
      $('#harga').val(btn.dataset.harga);
      $('#kategori').val(btn.dataset.kategori);
      $('#deskripsi').val(btn.dataset.deskripsi);
      $('#menu').val(btn.dataset.menu);
      $('#status').val(btn.dataset.status);
    }
</script>
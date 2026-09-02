<section id="Pelanggan">
    <div class="w-full flex flex-col items-center justify-between gap-5">
        <div class="w-full flex flex-col md:flex-row md:items-center justify-between gap-5">
            <div class="flex items-center gap-x-5">
                <div class="w-13 h-13 rounded-lg bg-primary flex items-center justify-center shrink-0 border-e border-gray-200">
                    <i class="bx bxs-group text-2xl text-white"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-black text-slate-900">
                        Pelanggan
                    </h1>
                    <p class="text-sm text-slate-500 font-medium mt-1.5">
                        Kelola data pelanggan.
                    </p>
                </div>
            </div>

            <div class="flex flex-row gap-x-3 my-1 shrink-0">
                <button
                    type="button"
                        onclick='showGlobalModal(<?= json_encode([
                        "title" => "Tambah Pelanggan",
                        "subtitle" => "Tambahkan data pelanggan baru ke dalam sistem.",
                        "icon" => "bxs-user-plus",
                        "iconBg" => "bg-primary",
                        "method" => "POST",
                        "buttonText" => "Tambahkan",
                        "buttonIcon" => "bxs-save",
                        "buttonColor" => "bg-primary hover:bg-blue-700",
                        "nameBtn" => "aksi",
                        "value" => "tambah"
                    ]) ?>)'
                    class="w-full h-12 md:w-auto flex items-center justify-center bg-primary text-white font-bold px-6 gap-2 rounded-lg cursor-pointer hover:opacity-90 transition-opacity"
                >
                    <i class="bx bxs-plus text-lg"></i>
                    <span>Tambah Pelanggan</span>
                </button>

            </div>
        </div>

    <div class="w-full mt-8">
        <form method="GET" autocomplete="off">
            <input type="hidden" name="route" value="<?= htmlspecialchars($_GET['route'] ?? '')?>">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-5">
                <div>
                    <h2 class="text-lg font-black text-slate-900">
                        Daftar Pelanggan
                    </h2>
                    <p class="text-xs text-slate-400 mt-1">
                        Data pelanggan yang terdaftar di sistem
                    </p>
                </div>

                <div class="relative w-full lg:w-96">
                    <i class="bx bx-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xl"></i>
                    <input
                        type="search"
                        placeholder="Cari nama, atau nomor Telepon..."
                        class="w-full h-12 pl-11 pr-11 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all"
                        name="cari"
                        oninput="this.form.submit()"
                        value="<?= htmlspecialchars($_GET['cari'] ?? '')?>"
                    >
                </div>
            </div>
        </form>
    </div>

    <div class="w-full overflow-hidden">
        <table id="selection-table" class="w-full text-sm">
            <thead>
                <tr class="bg-slate-50 dark:bg-slate-900 text-gray-400">
                    <th class="text-left font-bold px-5 py-4">#</th>
                    <th class="text-left font-bold px-5 py-4">Nama</th>
                    <th class="text-left font-bold px-5 py-4">No Telepon</th>
                    <th class="text-center font-bold px-5 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody id="body-tabel-Pelanggan">
            <?php if(mysqli_num_rows($dpelanggan)): ?>
                <?php while($d = mysqli_fetch_assoc($dpelanggan)): ?>
                    <tr>
                        <td class="px-5 py-4"><?= $no++ ?></td>
                        <td class="px-5 py-4"><?= $d['nama_pelanggan'] ?></td>
                        <td class="px-5 py-4"><?= $d['telepon'] ?></td>
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" 
                                onclick='showGlobalModal(<?= json_encode([
                                    "title" => "Edit Pelanggan",
                                    "subtitle" => "Perbarui data pelanggan.",
                                    "icon" => "bxs-edit",
                                    "iconBg" => "bg-amber-500",
                                    "method" => "POST",
                                    "buttonText" => "Simpan Perubahan",
                                    "buttonIcon" => "bxs-save",
                                    "buttonColor" => "bg-amber-500 hover:bg-amber-600",
                                    "nameBtn" => "aksi",
                                    "value" => "edit"
                                ]) ?>)
                                 modalEdit(this)
                                 '
                                class="w-10 h-10 rounded-lg bg-primary text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all" title="Edit menu"
                                data-id="<?= htmlspecialchars($d['id_pelanggan']) ?>" data-nama="<?= htmlspecialchars($d['nama_pelanggan']) ?>" data-telp="<?= htmlspecialchars($d['telepon']) ?>">
                                    <i class="bx bxs-pencil"></i>
                                </button>
                                <button type="button" 
                                onclick="showConfirmForm({
                                    title: 'Hapus Pelanggan',
                                    message: 'Apakah Anda yakin ingin hapus pelanggan <?= htmlspecialchars($d['nama_pelanggan']) ?>?.',
                                    actionText: 'Ya, hapus',
                                    type: 'danger',
                                    nameAksi: 'hapus',
                                    inputs: [
                                        {
                                            name: 'aksi',
                                            type: 'hidden',
                                            value: 'hapus'
                                        },
                                        {
                                            name: 'id',
                                            type: 'hidden',
                                            value: <?= htmlspecialchars($d['id_pelanggan']) ?>
                                        }
                                    ]
                                });"    
                                class="w-10 h-10 rounded-lg bg-red-500 text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all" title="Hapus menu">
                                    <i class="bx bxs-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">
                        <div class="flex flex-col items-center justify-center py-12 px-4 text-center bg-gray-50">
                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-gray-200/80">
                                <i class="bx bxs-user text-4xl text-gray-300"></i>
                            </div>
                            <h3 class="text-base font-black text-slate-800 mb-1">
                                Pelanggan Belum Tersedia
                            </h3>
                            <p class="text-xs text-gray-400 max-w-sm mb-5">
                                Belum ada data Pelanggan yang ditambahkan atau hasil pencarian tidak cocok.
                            </p>
                            <button 
                                type="button"
                                onclick='showGlobalModal(<?= json_encode([
                                    "title" => "Tambah Pelanggan",
                                    "subtitle" => "Tambahkan data pelanggan baru ke dalam sistem.",
                                    "icon" => "bxs-user-plus",
                                    "iconBg" => "bg-primary",
                                    "method" => "POST",
                                    "buttonText" => "Tambahkan",
                                    "buttonIcon" => "bxs-save",
                                    "buttonColor" => "bg-primary hover:bg-blue-700",
                                    "nameBtn" => "aksi",
                                    "value" => "tambah"
                                ]) ?>)'
                                class="px-4 py-3 bg-primary text-white text-sm font-bold rounded-lg hover:opacity-90 transition-all flex items-center gap-2"
                            >
                                <i class="bx bxs-plus text-base"></i>
                                <span>Tambah Pelanggan</span>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="w-full flex justify-center mt-7">
        <nav aria-label="Pagination">
            <ul class="flex items-center gap-1.5 bg-white border-e border-gray-200 rounded-full p-2">
                <li>
                    <button
                        type="button"
                        class="flex items-center justify-center w-9 h-9 rounded-full text-gray-400 hover:bg-gray-100 transition-all">
                        <i class="bx bxs-chevron-left"></i>
                    </button>
                </li>
                <li>
                    <button
                        type="button"
                        class="flex items-center justify-center w-9 h-9 rounded-full bg-primary text-white text-sm font-black">
                        1
                    </button>
                </li>
                <li>
                    <button
                        type="button"
                        class="flex items-center justify-center w-9 h-9 rounded-full text-gray-600 hover:bg-gray-100 text-sm font-medium transition-all">
                        2
                    </button>
                </li>
                <li>
                    <button
                        type="button"
                        class="flex items-center justify-center w-9 h-9 rounded-full text-gray-600 hover:bg-gray-100 transition-all">
                        <i class="bx bxs-chevron-right"></i>
                    </button>
                </li>
            </ul>
        </nav>
    </div>

    <div id="global-modal" role="dialog" aria-modal="true" aria-labelledby="globalModalTitle" class="hidden fixed inset-0 z-[9999] items-center justify-center p-4 bg-slate-950/60 backdrop-blur-[2px]">
        <div class="relative p-4 w-full max-w-xl">
            <div class="relative bg-white dark:bg-slate-900 rounded-lg shadow-xl border border-gray-200 dark:border-slate-800">
                <div class="flex items-start justify-between p-5 sm:p-6 border-b border-gray-100 dark:border-slate-800">
                    <div class="flex items-center gap-3 sm:gap-4">
                        <div id="globalModalIconContainer" class="flex w-12 h-12 rounded-lg bg-primary items-center justify-center shrink-0">
                            <i id="globalModalIcon" class="bx bxs-user-plus text-2xl text-white" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h3 id="globalModalTitle" class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white leading-tight"></h3>
                            <p id="globalModalSubtitle" class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 font-medium mt-1"></p>
                        </div>
                    </div>
                    <button type="button" onclick="closeGlobalModal()" class="text-slate-500 bg-slate-100 dark:bg-slate-800 dark:text-slate-400 hover:bg-primary hover:text-white rounded-full w-10 h-10 inline-flex justify-center items-center transition-colors cursor-pointer shrink-0" aria-label="Tutup modal">
                        <i class="bx bxs-x text-2xl" aria-hidden="true"></i>
                    </button>
                </div>
                <form id="globalModalForm" action="" method="POST" class="p-5 sm:p-6" autocomplete="off">
                    <input type="hidden" name="id" id="id">
                    <div class="grid grid-cols-1 gap-5">
                        <div class="flex flex-col gap-1.5 w-full">
                            <label for="nama" class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">
                            Nama Pelanggan <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <div class="relative flex items-center w-full group">
                            <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                                <i class="bx bxs-user text-xl" aria-hidden="true"></i>
                            </div>
                            <input type="text" name="nama" id="nama" placeholder="Masukkan nama pelanggan" class="w-full pl-11 pr-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-lg border-2 border-gray-200/80 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all" required>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1.5 w-full">
                            <label for="telepon" class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">
                            No. Telepon <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <div class="relative flex items-center w-full group">
                            <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                                <i class="bx bxs-phone text-xl" aria-hidden="true"></i>
                            </div>
                            <input type="text" name="telepon" inputmode="numeric" pattern="[0-9]{12}" minlength="12" maxlength="12" id="telepon" placeholder="Contoh: 081234567890" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="w-full pl-11 pr-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-lg border-2 border-gray-200/80 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all" required>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col-reverse sm:flex-row items-center justify-end pt-5 mt-6 border-t border-gray-100 dark:border-slate-800 gap-3">
                        <button type="button" onclick="closeGlobalModal()" class="w-full sm:w-auto bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold px-6 py-3 rounded-lg text-sm transition-all">
                            Batal
                        </button>
                        <button id="globalModalSubmit" type="submit" class="w-full sm:w-auto flex items-center justify-center bg-primary hover:bg-blue-700 text-white font-black px-6 py-3 gap-2 rounded-lg text-sm transition-all">
                            <i id="globalModalSubmitIcon" class="bx bxs-save text-lg" aria-hidden="true"></i>
                            <span id="globalModalSubmitText"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>

<script>
    function modalEdit(btn){
      $('#id').val(btn.dataset.id);
      $('#nama').val(btn.dataset.nama);
      $('#telepon').val(btn.dataset.telp);
    }
</script>

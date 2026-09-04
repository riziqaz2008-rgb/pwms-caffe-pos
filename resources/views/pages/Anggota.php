<section id="Anggota">
    <div class="bg-white dark:bg-slate-900 mb-6">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-5 pb-6 dark:border-slate-800">
            <div class="flex items-center gap-4 min-w-0">
                <div class="hidden sm:flex w-13 h-13 rounded-lg bg-primary items-center justify-center shrink-0">
                    <i class="bx bxs-user-id-card text-2xl text-white"></i>
                </div>
                <div class="min-w-0">
                    <div class="flex items-center gap-3 flex-wrap">
                        <h1 class="text-black dark:text-white font-black text-2xl">
                            Anggota
                        </h1>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 font-medium mt-1">
                        Kelola data Anggota dan akses pengguna pada sistem cafe.
                    </p>
                </div>
            </div>

            <button type="button"
                onclick='showGlobalModal(<?= json_encode([
                    "title" => "Tambah Anggota",
                    "subtitle" => "Tambahkan data anggota baru ke dalam sistem.",
                    "icon" => "bxs-user-id-card",
                    "iconBg" => "bg-primary",
                    "method" => "POST",
                    "buttonText" => "Simpan Anggota",
                    "buttonIcon" => "bxs-save",
                    "buttonColor" => "bg-primary hover:bg-blue-700",
                    
                    "nameBtn" => "aksi",
                    "value" => "tambah"
                ]) ?>);
                 modalTambah();'
                class="btn-aksi w-full sm:w-auto flex items-center justify-center gap-2 bg-primary text-white font-bold px-6 py-3 rounded-lg hover:bg-blue-700 active:scale-95 transition-all duration-200"
                >
            <i class="bx bxs-user-id-card text-xl"></i>
            <span>Tambah Anggota</span>
        </button>
        </div>
    </div>

    <div class="w-full sticky top-10 bg-white dark:bg-slate-900 rounded-lg p-5 mb-6">
        <div>
            <form method="GET" class="flex flex-row gap-3" autocomplete="off">
                <input type="hidden" name="route" value="<?= htmlspecialchars($_GET['route'] ?? '')?>">
                <div class="relative flex-1">
                    <i class="bx bx-search absolute left-4 top-1/2 -translate-y-1/2 text-xl text-gray-400"></i>
                    <input
                        type="text"
                        placeholder="Cari nama, username, atau nomor telepon..."
                        class="w-full pl-12 pr-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-lg border border-gray-200 dark:border-slate-700 focus:outline-none focus:ring focus:ring-primary transition-all"
                        name="cari"
                        oninput="this.form.submit()"
                        value="<?= htmlspecialchars($_GET['cari'] ?? '')?>">
                </div>

                <select
                    class="w-full lg:w-48 px-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-bold rounded-lg border border-gray-200 dark:border-slate-700 focus:outline-none focus:ring focus:ring-primary"
                    name="rolef"
                    onchange="this.form.submit()">

                    <option value="" <?= $rolef == '' ? 'selected' :'' ?>>Semua Role</option>
                    <?php foreach($role as $d): ?>
                        <option value="<?= $d['id_role'] ?>" <?= $rolef == $d['id_role'] ? 'selected' :'' ?>><?= $d['nama_role'] ?></option>
                    <?php endforeach; ?>
                </select>

                <select
                    class="w-full lg:w-44 px-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-bold rounded-lg border border-gray-200 dark:border-slate-700 focus:outline-none focus:ring focus:ring-primary"
                    name="statusf"
                    onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="0" <?= $statusf == 0 ? 'selected' :'' ?>>Nonaktif</option>
                    <option value="1" <?= $statusf == 1 ? 'selected' :'' ?>>Aktif</option>

                </select>
            </form>
        </div>
    </div>

    <div class="mb-5">
        <div class="flex items-center gap-2">
            <div class="w-1.5 h-5 rounded-full bg-primary"></div>
            <h2 class="text-sm font-black text-slate-800 dark:text-white">
                Daftar Anggota
            </h2>
        </div>
        <p class="text-xs text-gray-400 dark:text-gray-500 font-medium mt-1 ml-3.5">
            Data anggota yang terdaftar pada sistem.
        </p>
    </div>
    <div class="overflow-hidden">
        <table id="selection-table" class="w-full text-sm">
            <thead>
                <tr class="bg-slate-50 dark:bg-slate-900 text-gray-400">
                    <th class="text-left font-bold px-5 py-4">#</th>
                    <th class="text-left font-bold px-5 py-4">Nama</th>
                    <th class="text-left font-bold px-5 py-4">No. Telepon</th>
                    <th class="text-left font-bold px-5 py-4">Role</th>
                    <th class="text-left font-bold px-5 py-4">Status Anggota</th>
                    <th class="text-center font-bold px-5 py-4">Aksi</th>
                </tr>
            </thead>

            <tbody id="body-tabel-kategori">
                <?php if(mysqli_num_rows($data)): ?>
                    <?php while($d = mysqli_fetch_assoc($data)):
                    if($d['status'] == 1){
                        $s = 'Aktif';
                        $ws = 'bg-emerald-600';
                    } else{
                        $s = 'Nonaktif';
                        $ws = 'bg-gray-600';
                    }
                    ?>
                    <tr>
                        <td class="px-5 py-4"><?= $no++ ?></td>
                        <td class="px-5 py-4"><?= $d['nama'] ?></td>
                        <td class="px-5 py-4"><?= $d['telepon'] ?></td>
                        <td class="px-5 py-4"><?= $d['nama_role'] ?></td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg <?= $ws ?> text-xs font-bold text-white">
                                <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                <?= $s ?>
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" 
                                onclick='showGlobalModal(<?= json_encode([
                                    "title" => "Edit Anggota",
                                    "subtitle" => "Perbarui data anggota.",
                                    "icon" => "bxs-edit",
                                    "iconBg" => "bg-amber-500",
                                    "method" => "POST",
                                    "buttonText" => "Simpan Perubahan",
                                    "buttonIcon" => "bxs-save",
                                    "buttonColor" => "bg-amber-500 hover:bg-amber-600",
                                    "nameBtn" => "aksi",
                                    "value" => "edit"
                                ]) ?>);
                                 modalEdit(this);
                                 '
                                class="w-10 h-10 rounded-lg bg-primary text-white flex items-center justify-center hover:opacity-90 active:scale-95 transition-all" title="Edit menu"
                                data-id="<?= htmlspecialchars($d['id_anggota']) ?>" data-nama="<?= htmlspecialchars($d['nama']) ?>" data-telp="<?= htmlspecialchars($d['telepon']) ?>" data-role="<?= htmlspecialchars($d['id_role']) ?>" data-status="<?= htmlspecialchars($d['status']) ?>" data-user="<?= htmlspecialchars($d['username']) ?>" data-pw="<?= htmlspecialchars($d['password']) ?>"
                                >
                                    <i class="bx bxs-pencil"></i>
                                </button>
                                <button type="button" 
                                onclick="showConfirmForm({
                                    title: 'Hapus Pelanggan',
                                    message: 'Apakah Anda yakin ingin hapus pelanggan <?= htmlspecialchars($d['nama']) ?>?.',
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
                                            value: <?= htmlspecialchars($d['id_anggota']) ?>
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
                    <td colspan="7">
                        <div class="flex flex-col items-center justify-center py-12 px-4 text-center bg-gray-50">
                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-gray-200/80">
                                <i class="bx bxs-user-id-card text-4xl text-gray-300"></i>
                            </div>
                            <h3 class="text-base font-black text-slate-800 mb-1">Anggota Belum Tersedia</h3>
                            <p class="text-xs text-gray-400 max-w-sm mb-5">
                                Belum ada anggota yang ditambahkan atau hasil pencarian tidak cocok.
                            </p>
                            <button type="button" 
                                onclick='showGlobalModal(<?= json_encode([
                                    "title" => "Tambah Anggota",
                                    "subtitle" => "Tambahkan data anggota baru ke dalam sistem.",
                                    "icon" => "bxs-user-id-card",
                                    "iconBg" => "bg-primary",
                                    "method" => "POST",
                                    "buttonText" => "Simpan Anggota",
                                    "buttonIcon" => "bxs-save",
                                    "buttonColor" => "bg-primary hover:bg-blue-700",
                                    "nameBtn" => "aksi",
                                    "value" => "tambah"
                                ]) ?>);
                                 modalTambah();'
                                class="w-full sm:w-auto flex items-center justify-center gap-2 bg-primary text-white font-bold px-6 py-3 rounded-lg hover:bg-blue-700 active:scale-95 transition-all duration-200">
                            <i class="bx bxs-user-id-card text-xl"></i>
                            <span>Tambah Anggota</span>
                        </button>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

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

    <div id="global-modal" role="dialog" aria-modal="true" aria-labelledby="globalModalTitle" class="hidden fixed inset-0 z-[9999] items-center justify-center p-4 bg-slate-950/60 backdrop-blur-[2px]">
        <div class="relative p-4 w-full max-w-2xl">
            <div class="relative bg-white dark:bg-slate-900 rounded-lg shadow-xl border border-gray-200 dark:border-slate-800">
                <div class="flex items-start justify-between p-5 sm:p-6 border-b border-gray-100 dark:border-slate-800">
                    <div class="flex items-center gap-3 sm:gap-4">
                        <div id="globalModalIconContainer" class="flex w-12 h-12 rounded-lg bg-primary items-center justify-center shrink-0">
                            <i id="globalModalIcon" class="bx bxs-user-id-card text-2xl text-white" aria-hidden="true"></i>
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
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="col-span-1 md:col-span-2 flex items-center gap-3 pb-2 border-b border-gray-100 dark:border-slate-800">
                            <i class="bx bxs-id-card text-primary text-xl" aria-hidden="true"></i>
                            <h4 class="text-sm font-bold uppercase tracking-wider text-slate-800 dark:text-gray-300">Data Diri</h4>
                        </div>
                    <div class="flex flex-col gap-1.5 w-full">
                        <label for="nama" class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">
                            Nama <span class="text-red-500" aria-hidden="true">*</span>
                        </label>
                        <div class="relative flex items-center w-full group">
                            <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                                <i class="bx bxs-user text-xl" aria-hidden="true"></i>
                            </div>
                            <input type="text" name="nama" minlength="1" maxlength="100" id="nama" placeholder="Contoh: budi santoso" class="w-full pl-11 pr-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-lg border-2 border-gray-200/80 dark:border-slate-700 focus:outline-none focus:ring focus:ring-primary focus:border-primary transition-all" required>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1.5 w-full">
                        <label for="noTelepon" class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">
                            No. Telepon <span class="text-red-500" aria-hidden="true">*</span>
                        </label>
                        <div class="relative flex items-center w-full group">
                            <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                                <i class="bx bxs-phone text-xl" aria-hidden="true"></i>
                            </div>
                            <input type="text" name="telepon" inputmode="numeric" pattern="[0-9]{12}" minlength="12" maxlength="12" id="telepon" placeholder="Contoh: 081234567890" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="w-full pl-11 pr-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-lg border-2 border-gray-200/80 dark:border-slate-700 focus:outline-none focus:ring focus:ring-primary focus:border-primary transition-all" required>
                        </div>
                    </div>
                        <div class="flex flex-col gap-1.5 w-full">
                            <label for="role" class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">
                                Role <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <div class="relative flex items-center w-full group">
                                <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                                    <i class="bx bxs-briefcase-alt-2 text-xl" aria-hidden="true"></i>
                                </div>
                                <select name="role" id="role" class="w-full pl-11 pr-10 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-bold rounded-lg border-2 border-gray-200/80 dark:border-slate-700 focus:outline-none focus:ring focus:ring-primary focus:border-primary transition-all appearance-none cursor-pointer" required>
                                    <option value="">Pilih role...</option>
                                    <?php foreach($role as $d): ?>
                                    <option value="<?= $d['id_role'] ?>"><?= $d['nama_role'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="absolute right-3.5 pointer-events-none text-gray-400">
                                    <i class="bx bxs-chevron-down text-xl"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1.5 w-full" id="g-status">
                            <label class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">
                                Status Anggota<span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <div class="w-full px-4 py-3 bg-white dark:bg-slate-800 rounded-lg border-2 border-gray-200/80 dark:border-slate-700 flex items-center">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="status" id="status" value="" class="sr-only peer">
                                    <div class="relative w-10 h-5.5 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary/50 dark:peer-focus:ring-primary/30 rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4.5 after:w-4.5 after:transition-all dark:border-gray-600 peer-checked:bg-primary"></div>
                                    <span class="ms-3 text-sm font-bold text-slate-700 dark:text-slate-300">Aktif</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-span-1 md:col-span-2 flex items-center gap-3 pt-4 pb-2 border-b border-gray-100 dark:border-slate-800">
                            <i class="bx bxs-user-account text-primary text-xl" aria-hidden="true"></i>
                            <h4 class="text-sm font-bold uppercase tracking-wider text-slate-800 dark:text-gray-300">Data Akun</h4>
                        </div>
                        <div class="flex flex-col gap-1.5 w-full">
                            <label for="username" class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">
                                Username <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <div class="relative flex items-center w-full group">
                                <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                                    <i class="bx bxs-user-circle text-xl" aria-hidden="true"></i>
                                </div>
                                <input type="text" name="username" maxlength="25" id="username" placeholder="Contoh: budi.santoso" autocomplete="off" class="w-full pl-11 pr-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-lg border-2 border-gray-200/80 dark:border-slate-700 focus:outline-none focus:ring focus:ring-primary focus:border-primary transition-all" required>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1.5 w-full">
                            <label for="password" class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">
                                Password <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <div class="relative flex items-center w-full group">
                                <div class="absolute left-3.5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                                    <i class="bx bxs-lock text-xl" aria-hidden="true"></i>
                                </div>
                                <input type="password" name="password" maxlength="25" id="password" placeholder="Masukkan password" autocomplete="off"  class="w-full pl-11 pr-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-lg border-2 border-gray-200/80 dark:border-slate-700 focus:outline-none focus:ring focus:ring-primary focus:border-primary transition-all" required>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col-reverse sm:flex-row items-center justify-end pt-5 mt-6 border-t border-gray-100 dark:border-slate-800 gap-3">
                        <button type="button" onclick="closeGlobalModal()" class="w-full sm:w-auto bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold px-6 py-3 rounded-lg text-sm transition-all">
                            Batal
                        </button>
                        <button id="globalModalSubmit" type="submit" class="w-full sm:w-auto flex items-center justify-center bg-primary hover:bg-blue-700 text-white font-black px-6 py-3 gap-2 rounded-lg text-sm transition-all">
                            <i id="globalModalSubmitIcon" class="bx bxs-save text-lg" aria-hidden="true"></i>
                            <span id="globalModalSubmitText">Simpan Karyawan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    function modalTambah(){
        $('#g-status').addClass('hidden');
    }

    function modalEdit(b){
        let status = b.dataset.status;
        $('#id').val(b.dataset.id);
        $('#nama').val(b.dataset.nama);
        $('#telepon').val(b.dataset.telp);
        $('#role').val(b.dataset.role);
        $('#g-status').removeClass('hidden');
        $('#status').prop('checked', status == '1');
        $('#username').val(b.dataset.user);
        $('#password').val(b.dataset.pw);
    }
</script>
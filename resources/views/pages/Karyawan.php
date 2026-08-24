
<section id="Karyawan">

    <div
        x-data="{
            TambahKaryawan: false,
            DetailKaryawan: false,
            karyawanDetail: null,
            search: '',
            filterRole: 'Semua',
            filterStatus: 'Semua'
        }"
    >

        <div class="bg-white dark:bg-slate-900 mb-6">

            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-5 pb-6 dark:border-slate-800">

                <div class="flex items-center gap-4 min-w-0">

                    <div class="hidden sm:flex w-13 h-13 rounded-2xl bg-primary items-center justify-center shrink-0">

                        <i class="bx bx-group text-2xl text-white"></i>

                    </div>

                    <div class="min-w-0">

                        <div class="flex items-center gap-3 flex-wrap">

                            <h1 class="text-black dark:text-white font-black text-2xl">

                                Karyawan

                            </h1>

                        </div>

                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium mt-1">

                            Kelola data karyawan dan akses pengguna pada sistem cafe.

                        </p>

                    </div>

                </div>


                <button
                    type="button"
                    @click="TambahKaryawan = true"
                    class="w-full lg:w-auto flex items-center justify-center bg-primary text-white font-black px-5 py-3 gap-2 rounded-xl cursor-pointer hover:bg-blue-700 active:scale-95 transition-all duration-200"
                >

                    <i class="bx bx-plus text-lg"></i>

                    <span>Tambah Karyawan</span>

                </button>

            </div>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-7">

            <div class="bg-white dark:bg-slate-900 shadow-sm rounded-2xl p-5">

                <div class="flex items-center gap-4">

                    <div class="w-12 h-12 rounded-2xl bg-primary flex items-center justify-center shrink-0">

                        <i class="bx bx-group text-2xl text-white"></i>

                    </div>

                    <div>

                        <p class="text-xs uppercase tracking-wider font-black text-slate-900 dark:text-blue-400">

                            Total Karyawan

                        </p>

                        <h2 class="text-3xl font-black text-slate-700 dark:text-white mt-1">

                            8

                        </h2>

                    </div>

                </div>

            </div>


            <div class="bg-white dark:bg-slate-900 shadow-sm rounded-2xl p-5">

                <div class="flex items-center gap-4">

                    <div class="w-12 h-12 rounded-2xl bg-primary flex items-center justify-center shrink-0">

                        <i class="bx bx-user-check text-2xl text-white"></i>

                    </div>

                    <div>

                        <p class="text-xs uppercase tracking-wider font-black text-slate-900 dark:text-blue-400">

                            Karyawan Aktif

                        </p>

                        <h2 class="text-3xl font-black text-slate-700 dark:text-white mt-1">

                            7

                        </h2>

                    </div>

                </div>

            </div>

        </div>


        <div class="sticky top-10 bg-white dark:bg-slate-900 shadow-sm rounded-2xl p-5 mb-6">

            <div class="flex flex-col lg:flex-row gap-3">

                <div class="relative flex-1">

                    <i class="bx bx-search absolute left-4 top-1/2 -translate-y-1/2 text-xl text-gray-400"></i>

                    <input
                        type="text"
                        x-model="search"
                        placeholder="Cari nama, username, atau nomor telepon..."
                        class="w-full pl-12 pr-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-xl border border-gray-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-primary transition-all"
                    >

                </div>


                <select
                    x-model="filterRole"
                    class="w-full lg:w-48 px-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-bold rounded-xl border border-gray-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-primary"
                >

                    <option value="Semua">Semua Role</option>

                    <option value="Administrator">Administrator</option>

                    <option value="Kasir">Kasir</option>

                    <option value="Staff">Staff</option>

                </select>


                <select
                    x-model="filterStatus"
                    class="w-full lg:w-44 px-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-bold rounded-xl border border-gray-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-primary"
                >

                    <option value="Semua">Semua Status</option>

                    <option value="Aktif">Aktif</option>

                    <option value="Nonaktif">Nonaktif</option>

                </select>

            </div>

        </div>


        <div class="mb-5">

            <div class="flex items-center gap-2">

                <div class="w-1.5 h-5 rounded-full bg-primary"></div>

                <h2 class="text-sm font-black text-slate-800 dark:text-white">

                    Daftar Karyawan

                </h2>

            </div>

            <p class="text-xs text-gray-400 dark:text-gray-500 font-medium mt-1 ml-3.5">

                Data karyawan yang terdaftar pada sistem.

            </p>

        </div>
<div class="overflow-x-auto overflow-y-auto p-1 max-h-[700px]">

    <div class="w-full overflow-x-auto rounded-2xl shadow-sm">

        <table
            id="selection-table"
            class="w-full min-w-[950px] text-sm mt-3 rounded-2xl overflow-hidden"
        >

            <!-- =========================
                 TABLE HEADER
            ========================== -->
            <thead>

                <tr class="bg-slate-50 dark:bg-slate-900 text-slate-500 dark:text-slate-400 border-b border-slate-200 dark:border-slate-800">

                    <th class="text-center font-semibold px-5 py-4 border-r border-slate-200 dark:border-slate-800">
                        #
                    </th>

                    <th class="text-center font-semibold px-5 py-4 border-r border-slate-200 dark:border-slate-800">
                        Nama
                    </th>

                    <th class="text-center font-semibold px-5 py-4 border-r border-slate-200 dark:border-slate-800">
                        Username
                    </th>

                    <th class="text-center font-semibold px-5 py-4 border-r border-slate-200 dark:border-slate-800">
                        No Telpon
                    </th>

                    <th class="text-center font-semibold px-5 py-4 border-r border-slate-200 dark:border-slate-800">
                        Role
                    </th>

                    <th class="text-center font-semibold px-5 py-4 border-r border-slate-200 dark:border-slate-800">
                        Status
                    </th>

                    <th class="text-center font-semibold px-5 py-4">
                        Aksi
                    </th>

                </tr>

            </thead>


            <!-- =========================
                 TABLE BODY
            ========================== -->
            <tbody id="body-tabel-karyawan">

                <?php if (!empty($data_karyawan)): ?>

                    <?php $no = 1; ?>

                    <?php foreach ($data_karyawan as $karyawan): ?>

                        <tr
                            class="text-center bg-white dark:bg-slate-950
                                   border-b border-slate-200 dark:border-slate-800
                                   hover:bg-slate-50/70 dark:hover:bg-slate-900/60
                                   transition-colors duration-200"
                        >

                            <!-- =========================
                                 NOMOR
                            ========================== -->
                            <td class="px-5 py-4 border-r border-slate-200 dark:border-slate-800">

                                <span class="font-semibold text-slate-700 dark:text-slate-300">
                                    <?= $no++ ?>
                                </span>

                            </td>


                            <!-- =========================
                                 NAMA
                            ========================== -->
                            <td class="px-5 py-4 border-r border-slate-200 dark:border-slate-800">

                                <div class="flex items-center justify-center gap-3 min-w-[180px]">

                                    <!-- Foto -->
                                    <div class="w-11 h-11 rounded-full overflow-hidden shrink-0">

                                        <?php
                                        $namaGambar = trim($karyawan['gambar_karyawan'] ?? '');
                                        $imagePath = __DIR__ . '/../../../../assets/images/products/' . $namaGambar;
                                        $imageUrl = '/assets/images/products/' . $namaGambar;
                                        ?>

                                        <?php if (!empty($namaGambar) && file_exists($imagePath)): ?>

                                            <a
                                                href="<?= htmlspecialchars($imageUrl) ?>"
                                                target="_blank"
                                                class="block w-full h-full"
                                            >

                                                <img
                                                    src="<?= htmlspecialchars($imageUrl) ?>"
                                                    loading="lazy"
                                                    class="w-full h-full object-cover hover:scale-110 transition duration-300"
                                                    alt="<?= htmlspecialchars($karyawan['nama_karyawan'] ?? '') ?>"
                                                >

                                            </a>

                                        <?php else: ?>

                                            <div class="w-full h-full flex items-center justify-center bg-slate-100 dark:bg-slate-800">

                                                <i class="bx bx-user text-xl text-slate-400"></i>

                                            </div>

                                        <?php endif; ?>

                                    </div>


                                    <!-- Nama -->
                                    <div class="text-left min-w-0">

                                        <p class="text-sm font-bold text-slate-800 dark:text-slate-200 line-clamp-2 leading-snug">
                                            <?= htmlspecialchars($karyawan['nama_karyawan'] ?? '-') ?>
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <!-- =========================
                                 USERNAME
                            ========================== -->
                            <td class="px-5 py-4 border-r border-slate-200 dark:border-slate-800">

                                <div class="flex justify-center">

                                    <span class="inline-flex items-center gap-2
                                                 px-4 py-2 rounded-lg
                                                 bg-slate-50 dark:bg-slate-900
                                                 text-slate-700 dark:text-slate-300
                                                 font-semibold whitespace-nowrap">

                                        <i class="bx bx-user text-primary"></i>

                                        <?= htmlspecialchars($karyawan['username_karyawan'] ?? '-') ?>

                                    </span>

                                </div>

                            </td>


                            <!-- =========================
                                 NO TELEPON
                            ========================== -->
                            <td class="px-5 py-4 border-r border-slate-200 dark:border-slate-800">

                                <div class="flex justify-center">

                                    <span class="inline-flex items-center gap-2
                                                 text-slate-700 dark:text-slate-300
                                                 font-medium whitespace-nowrap">

                                        <i class="bx bx-phone text-primary"></i>

                                        <?= htmlspecialchars($karyawan['no_telpon_karyawan'] ?? '-') ?>

                                    </span>

                                </div>

                            </td>


                            <!-- =========================
                                 ROLE
                            ========================== -->
                            <td class="px-5 py-4 border-r border-slate-200 dark:border-slate-800">

                                <div class="flex justify-center">

                                    <div class="inline-flex items-center gap-2
                                                px-4 py-2 rounded-lg
                                                bg-primary text-white
                                                font-semibold whitespace-nowrap">

                                        <span class="w-2 h-2 rounded-full bg-white"></span>

                                        <span>
                                            <?= htmlspecialchars($karyawan['role_karyawan'] ?? '-') ?>
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <!-- =========================
                                 STATUS
                            ========================== -->
                            <td class="px-5 py-4 border-r border-slate-200 dark:border-slate-800">

                                <div class="flex justify-center">

                                    <div class="inline-flex items-center gap-2
                                                px-4 py-2 rounded-lg
                                                bg-primary text-white
                                                font-semibold whitespace-nowrap">

                                        <span class="w-2 h-2 rounded-full bg-white"></span>

                                        <span>
                                            Aktif
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <!-- =========================
                                 AKSI
                            ========================== -->
                            <td class="px-5 py-4">

                                <div class="flex justify-center items-center gap-2 shrink-0">

                                    <!-- Edit -->
                                    <a
                                        href="edit.php?id=<?= $karyawan['id'] ?? '' ?>"
                                        class="flex items-center justify-center
                                               w-11 h-11
                                               bg-primary text-white
                                               rounded-xl
                                               shadow-sm
                                               hover:bg-blue-700
                                               active:scale-95
                                               transition-all duration-200"
                                        title="Edit Data"
                                    >

                                        <i class="bx bxs-pencil text-xl"></i>

                                    </a>


                                    <!-- Hapus -->
                                    <button
                                        type="button"
                                        class="flex items-center justify-center
                                               w-11 h-11
                                               bg-red-500 text-white
                                               rounded-xl
                                               shadow-sm
                                               hover:bg-red-600
                                               active:scale-95
                                               transition-all duration-200"
                                        title="Hapus Data"
                                    >

                                        <i class="bx bxs-trash text-xl"></i>

                                    </button>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>


                <?php else: ?>

                    <!-- =========================
                         EMPTY STATE
                    ========================== -->
                    <tr>

                        <td colspan="7">

                            <div class="min-h-[320px] w-full
                                        flex flex-col justify-center items-center
                                        gap-3
                                        text-slate-400">

                                <div class="w-16 h-16 rounded-2xl
                                            bg-slate-100 dark:bg-slate-900
                                            flex items-center justify-center">

                                    <i class="bx bx-user text-4xl"></i>

                                </div>

                                <div class="text-center">

                                    <h1 class="font-black text-slate-700 dark:text-slate-300">
                                        Belum ada data karyawan
                                    </h1>

                                    <p class="text-xs text-slate-400 mt-1">
                                        Data karyawan yang ditambahkan akan tampil di sini.
                                    </p>

                                </div>

                            </div>

                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>



        <div
            x-show="TambahKaryawan"
            x-cloak
            @keydown.escape.window="TambahKaryawan = false"
            class="fixed inset-0 z-999 flex justify-center items-start sm:items-center w-full p-3 sm:p-4 overflow-y-auto"
        >

            <div
                x-show="TambahKaryawan"
                x-transition
                class="fixed inset-0 bg-slate-950/60"
                @click="TambahKaryawan = false"
            ></div>


            <div
                x-show="TambahKaryawan"
                x-transition
                class="relative w-full max-w-2xl z-999 my-auto"
            >

                <div class="relative bg-white dark:bg-slate-900 shadow-sm rounded-2xl p-5 md:p-8">

                    <div class="flex items-center justify-between gap-4 pb-5 border-b border-gray-200 dark:border-slate-800">

                        <div class="flex items-center gap-4">

                            <div class="w-12 h-12 rounded-2xl bg-primary flex items-center justify-center">

                                <i class="bx bx-user-plus text-2xl text-white"></i>

                            </div>

                            <div>

                                <h2 class="text-xl font-black text-slate-900 dark:text-white">

                                    Tambah Karyawan

                                </h2>

                                <p class="text-sm text-gray-400 mt-1">

                                    Tambahkan data karyawan ke sistem.

                                </p>

                            </div>

                        </div>


                        <button
                            type="button"
                            @click="TambahKaryawan = false"
                            class="w-10 h-10 rounded-xl bg-gray-100 text-slate-700 flex items-center justify-center hover:text-white hover:bg-blue-700 transition"
                        >

                            <i class="bx bx-x text-xl"></i>

                        </button>

                    </div>


                    <form class="mt-6">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        
                            <div class="flex flex-col border-b border-gray-200 col-span-2 py-2">

                                <label class="text-xs text-center font-black uppercase tracking-wide text-black dark:text-gray-400 ml-1">

                                    Data Diri

                                </label>
    
                            </div>

                            

                            <div>

                                <label class="text-xs font-black uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">

                                    Nama Lengkap <span class="text-red-600">*</span>

                                </label>

                                <input
                                    type="text"
                                    placeholder="Masukkan nama lengkap"
                                    class="w-full mt-1.5 px-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-xl border border-gray-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-primary transition-all"
                                >

                            </div>
                        
                            <div>

                                <label class="text-xs font-black uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">

                                    No. Telepon <span class="text-red-600">*</span>

                                </label>

                                <input
                                    type="text"
                                    placeholder="08xxxxxxxxxx"
                                    class="w-full mt-1.5 px-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-xl border border-gray-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-primary transition-all"
                                >

                            </div>

                            <div>

                                <label class="text-xs font-black uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">

                                    Role <span class="text-red-600">*</span>

                                </label>

                                <select
                                    class="w-full mt-1.5 px-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-bold rounded-xl border border-gray-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-primary"
                                >

                                    <option value="">Pilih role</option>
                                    
                                    <?php foreach($role as $d): ?>
                                        <option value="<?= $d['id_role'] ?>"><?= $d['nama_role'] ?></option>
                                    <?php endforeach; ?>

                                </select>

                            </div>

                            <div>
                                <label class="text-xs font-black uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">

                                    Status <span class="text-red-600">*</span>

                                </label>

                                <div>

                                    <label class="text-xs flex justify-start items-center gap-2 rounded-xl p-2.5 mt-2 border border-gray-200 font-black uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1" for="status">
                                        <label class="inline-flex justify-between items-center cursor-pointer">
                                            <input type="checkbox" value="" class="sr-only peer" id="status" checkeed>
                                            <div class="relative w-10.5 h-6 bg-gray-200 dark:peer-focus:ring-primary rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-buffer after:content-[''] after:absolute after:top-[4px] after:start-[5px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary"></div>
                                        </label>
                                        Aktif 
                                    </label>

                                </div>
                            </div>
                            
                            <div class="flex flex-col border-b border-gray-200 col-span-2 mt-4 py-2">

                                <label class="text-xs text-center font-black uppercase tracking-wide text-black dark:text-gray-400 ml-1">

                                    Data Akun

                                </label>
    
                            </div>                        

                            <div>

                                <label class="text-xs font-black uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">

                                    Username <span class="text-red-600">*</span>

                                </label>

                                <input
                                    type="text"
                                    placeholder="Contoh: budi.santoso"
                                    class="w-full mt-1.5 px-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-xl border border-gray-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-primary transition-all"
                                >

                            </div>

                            <div>

                                <label class="text-xs font-black uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1 col-span-2">

                                    Password <span class="text-red-600">*</span>

                                </label>

                                <input
                                    type="password"
                                    placeholder="Masukkan password"
                                    class="w-full mt-1.5 px-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-xl border border-gray-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-primary transition-all"
                                >

                            </div>


                        </div>


                        <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 mt-6 pt-5 border-t border-gray-200 dark:border-slate-800">

                            <button
                                type="button"
                                @click="TambahKaryawan = false"
                                class="w-full sm:w-auto px-6 py-3 rounded-xl bg-gray-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 font-bold hover:bg-gray-200 transition"
                            >

                                Batal

                            </button>


                            <button
                                type="submit"
                                class="w-full sm:w-auto px-6 py-3 rounded-xl bg-primary text-white font-black hover:bg-blue-700 active:scale-95 transition"
                            >

                                <i class="bx bx-save mr-1"></i>

                                Simpan Karyawan

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>


        <div
            x-show="DetailKaryawan"
            x-cloak
            @keydown.escape.window="DetailKaryawan = false"
            class="fixed inset-0 z-999 flex justify-center items-start sm:items-center w-full p-3 sm:p-4 overflow-y-auto"
        >

            <div
                x-show="DetailKaryawan"
                x-transition
                class="fixed inset-0 bg-slate-950/60"
                @click="DetailKaryawan = false"
            ></div>


            <div
                x-show="DetailKaryawan"
                x-transition
                class="relative w-full max-w-xl z-999 my-auto"
            >

                <div class="bg-white dark:bg-slate-900 shadow-sm rounded-2xl p-6 md:p-8">

                    <div class="flex items-center justify-between gap-4">

                        <div class="flex items-center gap-4">

                            <div class="w-12 h-12 rounded-2xl bg-primary flex items-center justify-center">

                                <i class="bx bx-user text-2xl text-white"></i>

                            </div>

                            <div>

                                <p class="text-xs font-black uppercase tracking-wider text-blue-600">

                                    Detail Karyawan

                                </p>

                                <h2
                                    class="text-xl font-black text-slate-900 dark:text-white mt-1"
                                    x-text="karyawanDetail"
                                ></h2>

                            </div>

                        </div>


                        <button
                            type="button"
                            @click="DetailKaryawan = false"
                            class="w-10 h-10 rounded-xl bg-primary text-white flex items-center justify-center hover:bg-blue-700 transition"
                        >

                            <i class="bx bx-x text-xl"></i>

                        </button>

                    </div>


                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-7">

                        <div class="p-4 rounded-xl shadow-sm">

                            <p class="text-[10px] uppercase tracking-wider font-black text-gray-400">

                                Role

                            </p>

                            <p class="text-sm font-black text-slate-900 dark:text-white mt-1">

                                Kasir

                            </p>

                        </div>


                        <div class="p-4 rounded-xl shadow-sm">

                            <p class="text-[10px] uppercase tracking-wider font-black text-gray-400">

                                Status

                            </p>

                            <p class="text-sm font-black text-blue-600 mt-1">

                                Aktif

                            </p>

                        </div>


                        <div class="p-4 rounded-xl shadow-sm">

                            <p class="text-[10px] uppercase tracking-wider font-black text-gray-400">

                                Email

                            </p>

                            <p class="text-sm font-bold text-slate-700 dark:text-slate-200 mt-1">

                                karyawan@kedaiku.id

                            </p>

                        </div>


                        <div class="p-4 rounded-xl shadow-sm">

                            <p class="text-[10px] uppercase tracking-wider font-black text-gray-400">

                                No. Telepon

                            </p>

                            <p class="text-sm font-bold text-slate-700 dark:text-slate-200 mt-1">

                                0812-3456-7890

                            </p>

                        </div>

                    </div>


                    <div class="mt-6 pt-5 border-t border-gray-200 dark:border-slate-800">

                        <button
                            type="button"
                            @click="DetailKaryawan = false"
                            class="w-full flex items-center justify-center bg-primary text-white font-black px-5 py-3 rounded-xl hover:bg-blue-700 active:scale-95 transition"
                        >

                            Tutup

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
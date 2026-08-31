
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

                    <div class="hidden sm:flex w-13 h-13 rounded-lg bg-primary items-center justify-center shrink-0">

                        <i class="bx bxs-user-id-card text-2xl text-white"></i>

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
                    class="w-full lg:w-auto flex items-center justify-center bg-primary text-white font-bold px-5 py-3 gap-2 rounded-lg cursor-pointer hover:bg-blue-700 active:scale-95 transition-all duration-200"
                >

                    <i class="bx bx-plus text-lg"></i>

                    <span>Tambah Karyawan</span>

                </button>

            </div>

        </div>

        <div class="sticky top-10 bg-white dark:bg-slate-900 rounded-lg p-5 mb-6">

            <div class="flex flex-col lg:flex-row gap-3">

                <div class="relative flex-1">

                    <i class="bx bx-search absolute left-4 top-1/2 -translate-y-1/2 text-xl text-gray-400"></i>

                    <input
                        type="text"
                        x-model="search"
                        placeholder="Cari nama, username, atau nomor telepon..."
                        class="w-full pl-12 pr-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-lg border border-gray-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-primary transition-all"
                    >

                </div>


                <select
                    x-model="filterRole"
                    class="w-full lg:w-48 px-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-bold rounded-lg border border-gray-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-primary"
                >

                    <option value="Semua">Semua Role</option>

                    <option value="Administrator">Administrator</option>

                    <option value="Kasir">Kasir</option>

                    <option value="Staff">Staff</option>

                </select>


                <select
                    x-model="filterStatus"
                    class="w-full lg:w-44 px-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-bold rounded-lg border border-gray-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-primary"
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
 <div class="overflow-hidden">
                <table id="selection-table" class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-900 text-gray-400">
                            <th class="text-left font-bold px-5 py-4">#</th>
                            <th class="text-left font-bold px-5 py-4">Nama</th>
                            <th class="text-left font-bold px-5 py-4">No Telpon</th>
                            <th class="text-left font-bold px-5 py-4">Role</th>
                            <th class="text-left font-bold px-5 py-4">Status</th>
                            <th class="text-center font-bold px-5 py-4">Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="body-tabel-kategori">
                        <tr>
                            <td colspan="6">
                                <div class="flex flex-col items-center justify-center py-12 px-4 text-center bg-gray-50">
                                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-gray-200/80">
                                        <i class="bx bx-user-id-card text-4xl text-gray-300"></i>
                                    </div>
                                    <h3 class="text-base font-black text-slate-800 mb-1">Karyawan Belum Tersedia</h3>
                                    <p class="text-xs text-gray-400 max-w-sm mb-5">
                                        Belum ada karyawan pembayaran yang ditambahkan atau hasil pencarian tidak cocok.
                                    </p>
                                    <button type="button"  @click="TambahKaryawan = true" class="px-4 py-3 bg-primary text-white text-sm font-bold rounded-lg hover:opacity-90 transition-all flex items-center gap-2">
                                        <i class="bx bxs-plus text-base"></i>
                                        <span>Tambah Karyawan</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>



 <div
    x-show="TambahKaryawan"
    x-cloak
    @keydown.escape.window="TambahKaryawan = false"
    class="fixed inset-0 z-[999] flex justify-center items-start sm:items-center w-full p-3 sm:p-4 overflow-y-auto"
>

    <!-- Backdrop dengan Transisi Halus -->
    <div
        x-show="TambahKaryawan"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-slate-950/60 backdrop-blur-[2px]"
        @click="TambahKaryawan = false"
    ></div>

    <!-- Modal Panel dengan Animasi Masuk/Keluar (Scale & Translate) -->
    <div
        x-show="TambahKaryawan"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4 sm:translate-y-2"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4 sm:translate-y-2"
        class="relative w-full max-w-2xl z-10 my-auto"
    >

        <div class="relative bg-white dark:bg-slate-900 rounded-lg p-5 md:p-8 shadow-xl border border-gray-200 dark:border-slate-800">

            <!-- Header Modal -->
            <div class="flex items-center justify-between gap-4 pb-5 border-b border-gray-200 dark:border-slate-800">

                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-lg bg-primary flex items-center justify-center shrink-0">
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
                    class="w-11 h-11 rounded-full bg-gray-100 text-slate-700 flex items-center justify-center hover:text-white hover:bg-primary transition cursor-pointer shrink-0"
                >
                    <i class="bx bx-x text-xl"></i>
                </button>

            </div>

            <!-- Form Content -->
            <form class="mt-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                
                    <!-- Section: Data Diri -->
                    <div class="flex flex-col border-b border-gray-200 dark:border-slate-800 col-span-2 py-2">
                        <label class="text-xs text-center font-black uppercase tracking-wide text-black dark:text-gray-400 ml-1">
                            Data Diri
                        </label>
                    </div>

                    <!-- Nama Lengkap -->
                    <div>
                        <label class="text-xs font-black uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">
                            Nama Lengkap <span class="text-red-600">*</span>
                        </label>
                        <input
                            type="text"
                            placeholder="Masukkan nama lengkap"
                            class="w-full mt-1.5 px-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-lg border border-gray-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-primary transition-all"
                        >
                    </div>
                
                    <!-- No. Telepon -->
                    <div>
                        <label class="text-xs font-black uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">
                            No. Telepon <span class="text-red-600">*</span>
                        </label>
                        <input
                            type="text"
                            placeholder="08xxxxxxxxxx"
                            class="w-full mt-1.5 px-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-lg border border-gray-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-primary transition-all"
                        >
                    </div>

                    <!-- Role -->
                    <div>
                        <label class="text-xs font-black uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">
                            Role <span class="text-red-600">*</span>
                        </label>
                        <select
                            class="w-full mt-1.5 px-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-bold rounded-lg border border-gray-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-primary"
                        >
                            <option value="">Pilih role</option>
                            <?php foreach($role as $d): ?>
                                <option value="<?= $d['id_role'] ?>"><?= $d['nama_role'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="text-xs font-black uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">
                            Status <span class="text-red-600">*</span>
                        </label>
                        <div>
                            <label class="text-xs flex justify-start items-center gap-2 rounded-lg p-2.5 mt-1.5 border border-gray-200 dark:border-slate-700 font-black uppercase tracking-wide text-gray-600 dark:text-gray-400" for="status">
                                <label class="inline-flex justify-between items-center cursor-pointer">
                                    <!-- Perbaikan typo pada atribut checked -->
                                    <input type="checkbox" value="" class="sr-only peer" id="status" checked>
                                    <div class="relative w-10.5 h-6 bg-gray-200 dark:bg-slate-700 dark:peer-focus:ring-primary rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:start-[5px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary"></div>
                                </label>
                                Aktif 
                            </label>
                        </div>
                    </div>
                    
                    <!-- Section: Data Akun -->
                    <div class="flex flex-col border-b border-gray-200 dark:border-slate-800 col-span-2 mt-4 py-2">
                        <label class="text-xs text-center font-black uppercase tracking-wide text-black dark:text-gray-400 ml-1">
                            Data Akun
                        </label>
                    </div>            

                    <!-- Username -->
                    <div>
                        <label class="text-xs font-black uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">
                            Username <span class="text-red-600">*</span>
                        </label>
                        <input
                            type="text"
                            placeholder="Contoh: budi.santoso"
                            class="w-full mt-1.5 px-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-lg border border-gray-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-primary transition-all"
                        >
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="text-xs font-black uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">
                            Password <span class="text-red-600">*</span>
                        </label>
                        <input
                            type="password"
                            placeholder="Masukkan password"
                            class="w-full mt-1.5 px-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-lg border border-gray-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-primary transition-all"
                        >
                    </div>

                </div>

                <!-- Footer Buttons -->
                <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 mt-6 pt-5 border-t border-gray-200 dark:border-slate-800">
                    <button
                        type="button"
                        @click="TambahKaryawan = false"
                        class="w-full sm:w-auto px-6 py-3 rounded-lg bg-gray-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 font-bold hover:bg-gray-200 transition cursor-pointer"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="w-full sm:w-auto px-6 py-3 rounded-lg bg-primary text-white font-black hover:bg-blue-700 active:scale-95 transition cursor-pointer flex items-center justify-center gap-2"
                    >
                        <i class="bx bx-save text-lg"></i>
                        <span>Simpan Karyawan</span>
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

                <div class="bg-white dark:bg-slate-900 rounded-lg p-6 md:p-8">

                    <div class="flex items-center justify-between gap-4">

                        <div class="flex items-center gap-4">

                            <div class="w-12 h-12 rounded-lg bg-primary flex items-center justify-center">

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
                            class="w-10 h-10 rounded-lg bg-primary text-white flex items-center justify-center hover:bg-blue-700 transition"
                        >

                            <i class="bx bx-x text-xl"></i>

                        </button>

                    </div>


                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-7">

                        <div class="p-4 rounded-lg">

                            <p class="text-[10px] uppercase tracking-wider font-black text-gray-400">

                                Role

                            </p>

                            <p class="text-sm font-black text-slate-900 dark:text-white mt-1">

                                Kasir

                            </p>

                        </div>


                        <div class="p-4 rounded-lg">

                            <p class="text-[10px] uppercase tracking-wider font-black text-gray-400">

                                Status

                            </p>

                            <p class="text-sm font-black text-blue-600 mt-1">

                                Aktif

                            </p>

                        </div>


                        <div class="p-4 rounded-lg">

                            <p class="text-[10px] uppercase tracking-wider font-black text-gray-400">

                                Email

                            </p>

                            <p class="text-sm font-bold text-slate-700 dark:text-slate-200 mt-1">

                                karyawan@kedaiku.id

                            </p>

                        </div>


                        <div class="p-4 rounded-lg">

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
                            class="w-full flex items-center justify-center bg-primary text-white font-black px-5 py-3 rounded-lg hover:bg-blue-700 active:scale-95 transition"
                        >

                            Tutup

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
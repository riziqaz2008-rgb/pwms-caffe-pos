<section id="Pelanggan">
    <div>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-5">
            <div class="flex items-center gap-x-5">
                <div class="w-13 h-13 rounded-lg bg-primary flex items-center justify-center shrink-0 border-e border-gray-200">
                    <i class="bx bx-group text-2xl text-white"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-black text-slate-900">
                        Pelanggan
                    </h1>
                    <p class="text-sm text-slate-500 font-medium mt-1.5">
                        Kelola data pelanggan dan informasi piutang cafe.
                    </p>
                </div>
            </div>

            <div class="flex flex-row gap-x-3 my-1 shrink-0">
                <button
                    type="button"
                    class="w-full h-12 md:w-auto flex items-center justify-center bg-primary text-white font-bold px-6 gap-2 rounded-lg cursor-pointer hover:opacity-90 transition-opacity"
                >
                    <i class="bx bx-plus text-lg"></i>
                    <span>Tambah Pelanggan</span>
                </button>
            </div>
        </div>

        <div class="mt-8">
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
                        placeholder="Cari nama, ID, atau nomor HP..."
                        class="w-full h-12 pl-11 pr-11 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all"
                    >
                </div>
            </div>

            <div class="overflow-hidden">
                <table id="selection-table" class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-900 text-gray-400">
                            <th class="text-left font-bold px-5 py-4">#</th>
                            <th class="text-left font-bold px-5 py-4">Nama</th>
                            <th class="text-left font-bold px-5 py-4">No HP</th>
                            <th class="text-center font-bold px-5 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="body-tabel-Pelanggan">
                        <tr>
                            <td colspan="4">
                                <div class="flex flex-col items-center justify-center py-12 px-4 text-center bg-gray-50">
                                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-gray-200/80">
                                        <i class="bx bx-user text-4xl text-gray-300"></i>
                                    </div>
                                    <h3 class="text-base font-black text-slate-800 mb-1">
                                        Pelanggan Belum Tersedia
                                    </h3>
                                    <p class="text-xs text-gray-400 max-w-sm mb-5">
                                        Belum ada data Pelanggan yang ditambahkan atau hasil pencarian tidak cocok.
                                    </p>
                                    <button 
                                        type="button" 
                                        @click="Pelanggan = true" 
                                        class="px-4 py-3 bg-primary text-white text-sm font-bold rounded-lg hover:opacity-90 transition-all flex items-center gap-2"
                                    >
                                        <i class="bx bx-plus text-base"></i>
                                        <span>Tambah Pelanggan</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="w-full flex justify-center mt-7">
            <nav aria-label="Pagination">
                <ul class="flex items-center gap-1.5 bg-white border-e border-gray-200 rounded-full p-2">
                    <li>
                        <button
                            type="button"
                            class="flex items-center justify-center w-9 h-9 rounded-full text-gray-400 hover:bg-gray-100 transition-all"
                        >
                            <i class="bx bx-chevron-left"></i>
                        </button>
                    </li>
                    <li>
                        <button
                            type="button"
                            class="flex items-center justify-center w-9 h-9 rounded-full bg-primary text-white text-sm font-black"
                        >
                            1
                        </button>
                    </li>
                    <li>
                        <button
                            type="button"
                            class="flex items-center justify-center w-9 h-9 rounded-full text-gray-600 hover:bg-gray-100 text-sm font-medium transition-all"
                        >
                            2
                        </button>
                    </li>
                    <li>
                        <button
                            type="button"
                            class="flex items-center justify-center w-9 h-9 rounded-full text-gray-600 hover:bg-gray-100 transition-all"
                        >
                            <i class="bx bx-chevron-right"></i>
                        </button>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</section>
<section id="HakAkses">

    <div
        x-data="{
            TambahRole: false,
            DetailRole: false,
            roleDetail: null
        }"
    >

        <div class="bg-white dark:bg-slate-900 mb-6">

            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-5 pb-6 border-b border-gray-200 dark:border-slate-800">

                <div class="flex items-center gap-4 min-w-0">

                    <div class="hidden sm:flex w-13 h-13 rounded-2xl bg-primary items-center justify-center shrink-0">

                        <i class="bx bx-shield-quarter text-2xl text-white"></i>

                    </div>

                    <div class="min-w-0">

                        <div class="flex items-center gap-3 flex-wrap">

                            <h1 class="text-black dark:text-white font-black text-2xl">

                                Hak Akses & Role

                            </h1>

                            <span class="text-sm font-black text-blue-600 dark:text-blue-400">

                                3 Role

                            </span>

                        </div>

                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium mt-1">

                            Kelola role dan hak akses pengguna pada sistem cafe.

                        </p>

                    </div>

                </div>


                <button
                    type="button"
                    @click="TambahRole = true"
                    class="w-full lg:w-auto flex items-center justify-center bg-primary text-white font-black px-5 py-3 gap-2 rounded-xl cursor-pointer hover:bg-blue-700 active:scale-95 transition-all duration-200"
                >

                    <i class="bx bx-plus text-lg"></i>

                    <span>Tambah Role</span>

                </button>

            </div>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-7">

            <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-2xl p-5">

                <div class="flex items-center gap-4">

                    <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center shrink-0">

                        <i class="bx bx-shield text-2xl text-white"></i>

                    </div>

                    <div>

                        <p class="text-xs uppercase tracking-wider font-black text-blue-600 dark:text-blue-400">

                            Total Role

                        </p>

                        <h2 class="text-3xl font-black text-slate-900 dark:text-white mt-1">

                            3

                        </h2>

                    </div>

                </div>

            </div>


            <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-2xl p-5">

                <div class="flex items-center gap-4">

                    <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center shrink-0">

                        <i class="bx bx-user-check text-2xl text-white"></i>

                    </div>

                    <div>

                        <p class="text-xs uppercase tracking-wider font-black text-blue-600 dark:text-blue-400">

                            Pengguna

                        </p>

                        <h2 class="text-3xl font-black text-slate-900 dark:text-white mt-1">

                            8

                        </h2>

                    </div>

                </div>

            </div>


            <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-2xl p-5">

                <div class="flex items-center gap-4">

                    <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center shrink-0">

                        <i class="bx bx-lock-open-alt text-2xl text-white"></i>

                    </div>

                    <div>

                        <p class="text-xs uppercase tracking-wider font-black text-blue-600 dark:text-blue-400">

                            Permission

                        </p>

                        <h2 class="text-3xl font-black text-slate-900 dark:text-white mt-1">

                            12

                        </h2>

                    </div>

                </div>

            </div>

        </div>


        <div class="mb-5">

            <div class="flex items-center gap-2">

                <div class="w-1.5 h-5 rounded-full bg-primary"></div>

                <h2 class="text-sm font-black text-slate-800 dark:text-white">

                    Daftar Role

                </h2>

            </div>

            <p class="text-xs text-gray-500 dark:text-gray-400 font-medium mt-1 ml-3.5">

                Role yang tersedia untuk pengguna sistem.

            </p>

        </div>


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">


            <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-2xl overflow-hidden">

                <div class="p-6">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center shrink-0">

                            <i class="bx bx-crown text-2xl text-white"></i>

                        </div>

                        <div class="min-w-0">

                            <h3 class="text-lg font-black text-slate-900 dark:text-white">

                                Administrator

                            </h3>

                            <p class="text-xs text-blue-600 dark:text-blue-400 font-bold mt-0.5">

                                Akses penuh sistem

                            </p>

                        </div>

                    </div>


                    <div class="mt-6">

                        <p class="text-[10px] uppercase tracking-wider font-black text-gray-500 dark:text-gray-400 mb-3">

                            Hak Akses

                        </p>

                        <div class="flex flex-wrap gap-2">

                            <span class="px-3 py-1.5 rounded-lg bg-blue-600 text-white text-xs font-bold">

                                Dashboard

                            </span>

                            <span class="px-3 py-1.5 rounded-lg bg-blue-600 text-white text-xs font-bold">

                                Menu

                            </span>

                            <span class="px-3 py-1.5 rounded-lg bg-blue-600 text-white text-xs font-bold">

                                Kasir

                            </span>

                            <span class="px-3 py-1.5 rounded-lg bg-blue-600 text-white text-xs font-bold">

                                Laporan

                            </span>

                            <span class="px-3 py-1.5 rounded-lg bg-blue-600 text-white text-xs font-bold">

                                Pengguna

                            </span>

                        </div>

                    </div>


                    <div class="flex items-center justify-between mt-6 pt-5 border-t border-gray-200 dark:border-slate-800">

                        <span class="text-xs font-bold text-blue-600 dark:text-blue-400">

                            5 Permission

                        </span>

                        <button
                            type="button"
                            @click="roleDetail = 'Administrator'; DetailRole = true"
                            class="flex items-center gap-2 text-sm font-black text-blue-600 hover:text-blue-700 transition"
                        >

                            <span>Detail</span>

                            <i class="bx bx-right-arrow-alt text-lg"></i>

                        </button>

                    </div>

                </div>

            </div>


            <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-2xl overflow-hidden">

                <div class="p-6">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center shrink-0">

                            <i class="bx bx-calculator text-2xl text-white"></i>

                        </div>

                        <div class="min-w-0">

                            <h3 class="text-lg font-black text-slate-900 dark:text-white">

                                Kasir

                            </h3>

                            <p class="text-xs text-blue-600 dark:text-blue-400 font-bold mt-0.5">

                                Akses operasional kasir

                            </p>

                        </div>

                    </div>


                    <div class="mt-6">

                        <p class="text-[10px] uppercase tracking-wider font-black text-gray-500 dark:text-gray-400 mb-3">

                            Hak Akses

                        </p>

                        <div class="flex flex-wrap gap-2">

                            <span class="px-3 py-1.5 rounded-lg bg-blue-600 text-white text-xs font-bold">

                                Kasir

                            </span>

                            <span class="px-3 py-1.5 rounded-lg bg-blue-600 text-white text-xs font-bold">

                                Transaksi

                            </span>

                            <span class="px-3 py-1.5 rounded-lg bg-blue-600 text-white text-xs font-bold">

                                Menu

                            </span>

                            <span class="px-3 py-1.5 rounded-lg bg-blue-600 text-white text-xs font-bold">

                                Riwayat

                            </span>

                        </div>

                    </div>


                    <div class="flex items-center justify-between mt-6 pt-5 border-t border-gray-200 dark:border-slate-800">

                        <span class="text-xs font-bold text-blue-600 dark:text-blue-400">

                            4 Permission

                        </span>

                        <button
                            type="button"
                            @click="roleDetail = 'Kasir'; DetailRole = true"
                            class="flex items-center gap-2 text-sm font-black text-blue-600 hover:text-blue-700 transition"
                        >

                            <span>Detail</span>

                            <i class="bx bx-right-arrow-alt text-lg"></i>

                        </button>

                    </div>

                </div>

            </div>


            <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-2xl overflow-hidden">

                <div class="p-6">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center shrink-0">

                            <i class="bx bx-user text-2xl text-white"></i>

                        </div>

                        <div class="min-w-0">

                            <h3 class="text-lg font-black text-slate-900 dark:text-white">

                                Staff

                            </h3>

                            <p class="text-xs text-blue-600 dark:text-blue-400 font-bold mt-0.5">

                                Akses terbatas

                            </p>

                        </div>

                    </div>


                    <div class="mt-6">

                        <p class="text-[10px] uppercase tracking-wider font-black text-gray-500 dark:text-gray-400 mb-3">

                            Hak Akses

                        </p>

                        <div class="flex flex-wrap gap-2">

                            <span class="px-3 py-1.5 rounded-lg bg-blue-600 text-white text-xs font-bold">

                                Dashboard

                            </span>

                            <span class="px-3 py-1.5 rounded-lg bg-blue-600 text-white text-xs font-bold">

                                Menu

                            </span>

                            <span class="px-3 py-1.5 rounded-lg bg-blue-600 text-white text-xs font-bold">

                                Transaksi

                            </span>

                        </div>

                    </div>


                    <div class="flex items-center justify-between mt-6 pt-5 border-t border-gray-200 dark:border-slate-800">

                        <span class="text-xs font-bold text-blue-600 dark:text-blue-400">

                            3 Permission

                        </span>

                        <button
                            type="button"
                            @click="roleDetail = 'Staff'; DetailRole = true"
                            class="flex items-center gap-2 text-sm font-black text-blue-600 hover:text-blue-700 transition"
                        >

                            <span>Detail</span>

                            <i class="bx bx-right-arrow-alt text-lg"></i>

                        </button>

                    </div>

                </div>

            </div>

        </div>


        <div
            x-show="TambahRole"
            x-cloak
            @keydown.escape.window="TambahRole = false"
            class="fixed inset-0 z-999 flex justify-center items-start sm:items-center w-full p-3 sm:p-4 overflow-y-auto"
        >

            <div
                x-show="TambahRole"
                x-transition
                class="fixed inset-0 bg-slate-950/60 backdrop-blur-[2px]"
                @click="TambahRole = false"
            ></div>


            <div
                x-show="TambahRole"
                x-transition
                class="relative w-full max-w-2xl z-10 my-auto"
            >

                <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-2xl p-5 md:p-7">

                    <div class="flex items-center justify-between gap-4 pb-5 border-b border-gray-200 dark:border-slate-800">

                        <div class="flex items-center gap-4">

                            <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center">

                                <i class="bx bx-shield text-2xl text-white"></i>

                            </div>

                            <div>

                                <h2 class="text-xl font-black text-slate-900 dark:text-white">

                                    Tambah Role

                                </h2>

                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">

                                    Buat role baru beserta hak aksesnya.

                                </p>

                            </div>

                        </div>


                        <button
                            type="button"
                            @click="TambahRole = false"
                            class="w-10 h-10 rounded-xl bg-primary text-white flex items-center justify-center hover:bg-blue-700 transition"
                        >

                            <i class="bx bx-x text-xl"></i>

                        </button>

                    </div>


                    <form class="mt-6">

                        <div class="flex flex-col gap-5">

                            <div>

                                <label class="text-xs font-black uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">

                                    Nama Role

                                </label>

                                <div class="relative mt-1.5">

                                    <i class="bx bx-shield absolute left-4 top-1/2 -translate-y-1/2 text-xl text-blue-600"></i>

                                    <input
                                        type="text"
                                        placeholder="Contoh: Supervisor"
                                        class="w-full pl-12 pr-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-xl border border-gray-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-primary transition-all"
                                    >

                                </div>

                            </div>


                            <div>

                                <label class="text-xs font-black uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">

                                    Deskripsi

                                </label>

                                <textarea
                                    rows="3"
                                    placeholder="Jelaskan fungsi role ini..."
                                    class="w-full mt-1.5 px-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-xl border border-gray-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-primary resize-none transition-all"
                                ></textarea>

                            </div>


                            <div>

                                <div class="flex items-center justify-between mb-3">

                                    <label class="text-xs font-black uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1">

                                        Hak Akses

                                    </label>

                                    <span class="text-xs font-bold text-blue-600">

                                        Pilih permission

                                    </span>

                                </div>


                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                                    <label class="flex items-center gap-3 p-4 rounded-xl border border-gray-200 dark:border-slate-700 cursor-pointer hover:ring-2 hover:ring-primary transition">

                                        <input type="checkbox" class="w-4 h-4 accent-primary">

                                        <span class="text-sm font-bold text-slate-700 dark:text-slate-200">

                                            Dashboard

                                        </span>

                                    </label>


                                    <label class="flex items-center gap-3 p-4 rounded-xl border border-gray-200 dark:border-slate-700 cursor-pointer hover:ring-2 hover:ring-primary transition">

                                        <input type="checkbox" class="w-4 h-4 accent-primary">

                                        <span class="text-sm font-bold text-slate-700 dark:text-slate-200">

                                            Kelola Menu

                                        </span>

                                    </label>


                                    <label class="flex items-center gap-3 p-4 rounded-xl border border-gray-200 dark:border-slate-700 cursor-pointer hover:ring-2 hover:ring-primary transition">

                                        <input type="checkbox" class="w-4 h-4 accent-primary">

                                        <span class="text-sm font-bold text-slate-700 dark:text-slate-200">

                                            Kasir

                                        </span>

                                    </label>


                                    <label class="flex items-center gap-3 p-4 rounded-xl border border-gray-200 dark:border-slate-700 cursor-pointer hover:ring-2 hover:ring-primary transition">

                                        <input type="checkbox" class="w-4 h-4 accent-primary">

                                        <span class="text-sm font-bold text-slate-700 dark:text-slate-200">

                                            Laporan

                                        </span>

                                    </label>

                                </div>

                            </div>

                        </div>


                        <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 mt-6 pt-5 border-t border-gray-200 dark:border-slate-800">

                            <button
                                type="button"
                                @click="TambahRole = false"
                                class="w-full sm:w-auto px-6 py-3 rounded-xl border border-gray-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 font-bold hover:bg-gray-50 dark:hover:bg-slate-800 transition"
                            >

                                Batal

                            </button>

                            <button
                                type="submit"
                                class="w-full sm:w-auto px-6 py-3 rounded-xl bg-primary text-white font-black hover:bg-blue-700 active:scale-95 transition"
                            >

                                <i class="bx bx-save mr-1"></i>

                                Simpan Role

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>


        <div
            x-show="DetailRole"
            x-cloak
            @keydown.escape.window="DetailRole = false"
            class="fixed inset-0 z-999 flex justify-center items-start sm:items-center w-full p-3 sm:p-4 overflow-y-auto"
        >

            <div
                x-show="DetailRole"
                x-transition
                class="fixed inset-0 bg-slate-950/60 backdrop-blur-[2px]"
                @click="DetailRole = false"
            ></div>


            <div
                x-show="DetailRole"
                x-transition
                class="relative w-full max-w-xl z-10 my-auto"
            >

                <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-2xl p-6 md:p-7">

                    <div class="flex items-center justify-between gap-4 pb-5 border-b border-gray-200 dark:border-slate-800">

                        <div class="flex items-center gap-4">

                            <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center">

                                <i class="bx bx-shield-quarter text-2xl text-white"></i>

                            </div>

                            <div>

                                <p class="text-xs font-black uppercase tracking-wider text-blue-600">

                                    Detail Role

                                </p>

                                <h2
                                    class="text-xl font-black text-slate-900 dark:text-white mt-1"
                                    x-text="roleDetail"
                                ></h2>

                            </div>

                        </div>


                        <button
                            type="button"
                            @click="DetailRole = false"
                            class="w-10 h-10 rounded-xl bg-primary text-white flex items-center justify-center hover:bg-blue-700 transition"
                        >

                            <i class="bx bx-x text-xl"></i>

                        </button>

                    </div>


                    <div class="mt-6">

                        <p class="text-xs font-black uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-3">

                            Hak Akses Yang Dimiliki

                        </p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                            <div class="flex items-center gap-3 p-4 rounded-xl bg-blue-600 text-white">

                                <i class="bx bx-check-circle text-xl"></i>

                                <span class="font-bold">

                                    Dashboard

                                </span>

                            </div>


                            <div class="flex items-center gap-3 p-4 rounded-xl bg-blue-600 text-white">

                                <i class="bx bx-check-circle text-xl"></i>

                                <span class="font-bold">

                                    Kelola Menu

                                </span>

                            </div>


                            <div class="flex items-center gap-3 p-4 rounded-xl bg-blue-600 text-white">

                                <i class="bx bx-check-circle text-xl"></i>

                                <span class="font-bold">

                                    Kasir

                                </span>

                            </div>


                            <div class="flex items-center gap-3 p-4 rounded-xl bg-blue-600 text-white">

                                <i class="bx bx-check-circle text-xl"></i>

                                <span class="font-bold">

                                    Laporan

                                </span>

                            </div>

                        </div>

                    </div>


                    <div class="mt-6 pt-5 border-t border-gray-200 dark:border-slate-800">

                        <button
                            type="button"
                            @click="DetailRole = false"
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
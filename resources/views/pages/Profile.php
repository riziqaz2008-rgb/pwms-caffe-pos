
<section id="Pengaturan">
    <div>
        <div>
            <div class="flex gap-x-5 mt-3">
                <div class="hidden w-13 h-13 rounded-2xl bg-primary border border-gray-200 lg:flex items-center justify-center shrink-0">
                    <i class="bx bx-user text-2xl text-white"></i>
                </div>
                <div>
                    <div class="flex items-center gap-x-3">
                        <h1 class="text-black font-black text-2xl">
                            Profil Saya
                        </h1>
                    </div>
        
                    <p class="text-sm text-gray-500 font-medium mt-1.5">
                        Data Anda.
                    </p>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 mt-8">
            <div class="lg:col-span-full space-y-6">
                <div class="bg-white rounded-2xl p-6 lg:p-7">
                    <div class="flex items-start justify-between mb-7">
                        <div>
                            <h2 class="text-[20px] font-black text-[#12131a] tracking-tight">
                                Data Anda
                            </h2>
                            <p class="text-sm text-gray-500 font-medium mt-1">
                                Kelola data dan akun Anda.
                            </p>
                        </div>
                        <div class="w-11 h-11 bg-primary rounded-[14px] flex items-center justify-center text-white shrink-0">
                            <i class="bx bx-store text-lg"></i>
                        </div>
                    </div>
                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($dataAnggota['id_anggota']) ?>">
                        <h4 class="mb-3 text-sm font-bold uppercase tracking-wider text-slate-800 dark:text-gray-300">Data Diri</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-bold text-[#12131a] mb-2">
                                    Nama <span class="text-red-500" aria-hidden="true">*</span>
                                </label>
                                <input
                                    type="text"
                                    name="nama"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-white text-sm font-medium text-[#12131a] outline-none focus:ring-primary focus:ring-2 transition"
                                    value="<?= htmlspecialchars($dataAnggota['nama']) ?>"
                                    required>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-[#12131a] mb-2">
                                    Nomor Telepon
                                </label>
                                <input
                                    type="text"
                                    name="telepon"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-white text-sm font-medium text-[#12131a] outline-none focus:ring-primary focus:ring-2 transition"
                                    value="<?= htmlspecialchars($dataAnggota['telepon']) ?>"
                                    >
                            </div>
                        </div>

                        <h4 class="mt-5 mb-3 text-sm font-bold uppercase tracking-wider text-slate-800 dark:text-gray-300">Data Akun</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-bold text-[#12131a] mb-2">
                                    Username
                                </label>
                                <input
                                    type="text"
                                    name="username"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-white text-sm font-medium text-[#12131a] outline-none focus:ring-primary focus:ring-2 transition"
                                    value="<?= htmlspecialchars($dataUser['username']) ?>"
                                    >
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-[#12131a] mb-2">
                                    Password
                                </label>
                                <input
                                    type="password"
                                    name="password"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-white text-sm font-medium text-[#12131a] outline-none focus:ring-primary focus:ring-2 transition"
                                    value="<?= htmlspecialchars($dataUser['password']) ?>"
                                    >
                            </div>
                        </div>
                        <div class="flex justify-end mt-7 pt-6 border-t border-gray-100">
                            <button
                                type="submit"
                                class="flex items-center gap-2 bg-primary hover:bg-blue-700 text-white font-bold text-sm px-5 py-3 rounded-lg transition cursor-pointer">
                                <i class="bx bx-save text-lg"></i>
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
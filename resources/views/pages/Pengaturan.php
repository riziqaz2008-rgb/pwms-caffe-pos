<section id="Pengaturan">
    <div>
        <div>
            <div class="flex gap-x-5 mt-3">
                <div class="hidden w-13 h-13 rounded-2xl bg-primary border border-gray-200 lg:flex items-center justify-center shrink-0">
                    <i class="bx bx-hexagon text-2xl text-white"></i>
                </div>
                <div>
                    <div class="flex items-center gap-x-3">
                        <h1 class="text-black font-black text-2xl">
                            Pengaturan
                        </h1>
                    </div>
        
                    <p class="text-sm text-gray-500 font-medium mt-1.5">
                        Kelola pengaturan aplikasi, branding, dan preferensi usaha Anda.
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
                                Informasi Usaha
                            </h2>
                            <p class="text-sm text-gray-500 font-medium mt-1">
                                Informasi dasar yang digunakan pada sistem usaha.
                            </p>
                        </div>
                        <div class="w-11 h-11 bg-primary rounded-[14px] flex items-center justify-center text-white shrink-0">
                            <i class="bx bx-store text-lg"></i>
                        </div>
                    </div>
                    <form action="" method="POST">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-bold text-[#12131a] mb-2">
                                    Nama Usaha <span class="text-red-500" aria-hidden="true">*</span>
                                </label>
                                <input
                                    type="text"
                                    name="nama"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-white text-sm font-medium text-[#12131a] outline-none focus:ring-primary focus:ring-2 transition"
                                    value="<?= htmlspecialchars($p['nama_usaha']) ?>"
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
                                    value="<?= htmlspecialchars($p['telepon']) ?>"
                                    >
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-[#12131a] mb-2">
                                    Alamat Usaha <span class="text-red-500" aria-hidden="true">*</span>
                                </label>
                                <textarea
                                    rows="3"
                                    name="alamat"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-white text-sm font-medium text-[#12131a] outline-none focus:ring-primary focus:ring-2 transition resize-none"
                                    required
                                    ><?= htmlspecialchars($p['alamat']) ?></textarea>
                            </div>
                        </div>
                        <div class="flex justify-end mt-7 pt-6 border-t border-gray-100">
                            <button
                                type="submit"
                                class="flex items-center gap-2 bg-primary hover:bg-blue-700 text-white font-bold text-sm px-5 py-3 rounded-lg transition cursor-pointer">
                                <i class="bx bx-save text-lg"></i>
                                Simpan Informasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
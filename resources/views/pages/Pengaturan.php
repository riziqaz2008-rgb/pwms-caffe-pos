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
                        Kelola pengaturan aplikasi, branding, dan preferensi cafe Anda.
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
                                Informasi Cafe
                            </h2>
                            <p class="text-sm text-gray-500 font-medium mt-1">
                                Informasi dasar yang digunakan pada sistem KedaiKu.
                            </p>
                        </div>
                        <div class="w-11 h-11 bg-primary rounded-[14px] flex items-center justify-center text-white shrink-0">
                            <i class="bx bx-store text-lg"></i>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-bold text-[#12131a] mb-2">
                                Nama Cafe
                            </label>
                            <input
                                type="text"
                                value="KedaiKu Cafe"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-sm font-medium text-[#12131a] outline-none focus:ring-primary focus:ring-2 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-[#12131a] mb-2">
                                Nomor Telepon
                            </label>
                            <input
                                type="text"
                                value="0812 3456 7890"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-sm font-medium text-[#12131a] outline-none focus:ring-primary focus:ring-2 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-[#12131a] mb-2">
                                Email
                            </label>
                            <input
                                type="email"
                                value="kedai@example.com"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-sm font-medium text-[#12131a] outline-none focus:ring-primary focus:ring-2 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-[#12131a] mb-2">
                                Jam Operasional
                            </label>
                            <input
                                type="text"
                                value="08:00 - 22:00"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-sm font-medium text-[#12131a] outline-none focus:ring-primary focus:ring-2 transition">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-[#12131a] mb-2">
                                Alamat Cafe
                            </label>
                            <textarea
                                rows="3"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-sm font-medium text-[#12131a] outline-none focus:ring-primary focus:ring-2 transition resize-none">Jl. Pandan Wangi, Samarinda</textarea>
                        </div>
                    </div>
                    <div class="flex justify-end mt-7 pt-6 border-t border-gray-100">
                        <button
                            class="flex items-center gap-2 bg-primary hover:bg-blue-700 text-white font-bold text-sm px-5 py-3 rounded-xl transition cursor-pointer">
                            <i class="bx bx-save text-lg"></i>
                            Simpan Informasi
                        </button>
                    </div>
                </div>
                <div class="bg-white rounded-2xl  p-6 lg:p-7">
                    <div class="flex items-start justify-between mb-7">
                        <div>
                            <h2 class="text-[20px] font-black text-[#12131a] tracking-tight">
                                Tampilan & Branding
                            </h2>
                            <p class="text-sm text-gray-500 font-medium mt-1">
                                Sesuaikan identitas visual dan warna tema utama website Anda.
                            </p>
                        </div>
                        <div class="w-11 h-11 bg-primary rounded-[14px] flex items-center justify-center text-white shrink-0">
                            <i class="bx bx-palette text-lg"></i>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-[#12131a] mb-3">
                                Logo Website / Cafe
                            </label>
                            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5 p-4 rounded-xl border border-gray-100 bg-gray-50/50">
                                <div class="w-20 h-20 rounded-2xl bg-white border border-gray-200 p-2 flex items-center justify-center shrink-0 relative group">
                                    <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center text-white font-black text-xl">
                                        <i class="bx bx-hexagon"></i>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center gap-3">
                                        <label class="px-4 py-2.5 rounded-xl bg-primary hover:bg-blue-700 text-white text-sm font-bold cursor-pointer transition flex items-center gap-2">
                                            <i class="bx bx-upload text-base"></i>
                                            Unggah Logo Baru
                                            <input type="file" class="hidden" accept="image/png, image/jpeg, image/svg+xml">
                                        </label>

                                        <button type="button" class="px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm font-bold text-red-600 hover:bg-red-50 transition">
                                            Hapus
                                        </button>
                                    </div>
                                    <p class="text-xs text-gray-400 font-medium mt-2.5">
                                        Format yang direkomendasikan: PNG, SVG, atau JPG. Maksimal 2MB (Rasio 1:1).
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr class="border-gray-100">
                        <div>
                            <label class="block text-sm font-bold text-[#12131a] mb-1">
                                Warna Utama (Primary Color)
                            </label>
                            <p class="text-xs text-gray-400 font-medium mb-4">
                                Pilih warna aksen utama yang akan digunakan di tombol, badge, dan elemen aktif.
                            </p>
                            <div class="flex flex-wrap items-center gap-4">
                                <label class="cursor-pointer relative">
                                    <input type="radio" name="theme_color" value="#4F46E5" checked class="sr-only peer">
                                    <div class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white ring-2 ring-offset-2 ring-transparent peer-checked:ring-indigo-600 transition">
                                        <i class="bx bx-check text-lg opacity-0 peer-checked:opacity-100"></i>
                                    </div>
                                </label>
                                <label class="cursor-pointer relative">
                                    <input type="radio" name="theme_color" value="#059669" class="sr-only peer">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-600 flex items-center justify-center text-white ring-2 ring-offset-2 ring-transparent peer-checked:ring-emerald-600 transition">
                                        <i class="bx bx-check text-lg opacity-0 peer-checked:opacity-100"></i>
                                    </div>
                                </label>
                                <label class="cursor-pointer relative">
                                    <input type="radio" name="theme_color" value="#7C3AED" class="sr-only peer">
                                    <div class="w-10 h-10 rounded-xl bg-violet-600 flex items-center justify-center text-white ring-2 ring-offset-2 ring-transparent peer-checked:ring-violet-600 transition">
                                        <i class="bx bx-check text-lg opacity-0 peer-checked:opacity-100"></i>
                                    </div>
                                </label>
                                <label class="cursor-pointer relative">
                                    <input type="radio" name="theme_color" value="#E11D48" class="sr-only peer">
                                    <div class="w-10 h-10 rounded-xl bg-rose-600 flex items-center justify-center text-white ring-2 ring-offset-2 ring-transparent peer-checked:ring-rose-600 transition">
                                        <i class="bx bx-check text-lg opacity-0 peer-checked:opacity-100"></i>
                                    </div>
                                </label>
                                <label class="cursor-pointer relative">
                                    <input type="radio" name="theme_color" value="#D97706" class="sr-only peer">
                                    <div class="w-10 h-10 rounded-xl bg-amber-600 flex items-center justify-center text-white ring-2 ring-offset-2 ring-transparent peer-checked:ring-amber-600 transition">
                                        <i class="bx bx-check text-lg opacity-0 peer-checked:opacity-100"></i>
                                    </div>
                                </label>
                                <div class="h-10 border-l border-gray-200 pl-4 flex items-center gap-3">
                                    <span class="text-xs font-bold text-gray-500">Kustom:</span>
                                    <div class="relative flex items-center">
                                        <input type="color" id="customColor" value="#4F46E5" class="w-9 h-9 rounded-xl border border-gray-200 cursor-pointer p-0.5 bg-white">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-7 pt-6 border-t border-gray-100">
                        <button
                            class="flex items-center gap-2 bg-primary hover:bg-blue-700 text-white font-bold text-sm px-5 py-3 rounded-xl transition cursor-pointer">
                            <i class="bx bx-save text-lg"></i>
                            Simpan Branding
                        </button>
                    </div>
                </div>
                <div class="bg-white rounded-2xl p-6 lg:p-7">
                    <div class="flex items-start justify-between mb-7">
                        <div>
                            <h2 class="text-[20px] font-black text-[#12131a] tracking-tight">
                                Preferensi
                            </h2>

                            <p class="text-sm text-gray-500 font-medium mt-1">
                                Atur bagaimana sistem bekerja untuk Anda.
                            </p>
                        </div>
                        <div class="w-11 h-11 bg-primary rounded-[14px] flex items-center justify-center text-white shrink-0">
                            <i class="bx bx-sliders text-lg"></i>
                        </div>
                    </div>
                    <div class="divide-y divide-gray-100">
                        <div class="flex items-center justify-between gap-5 py-5">
                            <div>
                                <h3 class="text-sm font-bold text-[#12131a]">
                                    Notifikasi Transaksi
                                </h3>
                                <p class="text-xs text-gray-400 font-medium mt-1">
                                    Tampilkan notifikasi ketika transaksi berhasil.
                                </p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">

                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-primary transition-all
                                    after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                    after:bg-white after:rounded-full after:h-5 after:w-5
                                    after:transition-all peer-checked:after:translate-x-5">
                                </div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between gap-5 py-5">
                            <div>
                                <h3 class="text-sm font-bold text-[#12131a]">
                                    Konfirmasi Pembayaran
                                </h3>

                                <p class="text-xs text-gray-400 font-medium mt-1">
                                    Minta konfirmasi sebelum menyelesaikan pembayaran.
                                </p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">

                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-primary transition-all
                                    after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                    after:bg-white after:rounded-full after:h-5 after:w-5
                                    after:transition-all peer-checked:after:translate-x-5">
                                </div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between gap-5 py-5 last:pb-0">
                            <div>
                                <h3 class="text-sm font-bold text-[#12131a]">
                                    Mode Gelap
                                </h3>

                                <p class="text-xs text-gray-400 font-medium mt-1">
                                    Gunakan tampilan gelap untuk aplikasi.
                                </p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer">

                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-primary transition-all
                                    after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                    after:bg-white after:rounded-full after:h-5 after:w-5
                                    after:transition-all peer-checked:after:translate-x-5">
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl p-6 lg:p-7">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <h2 class="text-[20px] font-black text-[#12131a] tracking-tight">
                                Keamanan
                            </h2>
                            <p class="text-sm text-gray-500 font-medium mt-1">
                                Kelola keamanan akun Anda.
                            </p>
                        </div>
                        <div class="w-11 h-11 bg-primary rounded-[14px] flex items-center justify-center text-white shrink-0">
                            <i class="bx bx-shield-quarter text-lg"></i>
                        </div>
                    </div>
                    <div class="flex items-center justify-between gap-5 p-4 rounded-xl border border-gray-100 bg-gray-50/50">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-white border border-gray-200 flex items-center justify-center text-gray-600">
                                <i class="bx bx-lock text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-[#12131a]">
                                    Password
                                </h3>

                                <p class="text-xs text-gray-400 font-medium mt-1">
                                    Terakhir diperbarui beberapa waktu lalu.
                                </p>
                            </div>
                        </div>
                        <button
                            class="px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm font-bold text-[#12131a] hover:bg-gray-50 transition cursor-pointer">
                            Ubah Password
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
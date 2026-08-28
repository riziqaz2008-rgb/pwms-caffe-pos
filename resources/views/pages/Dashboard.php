<section id="Dashboard">
    <div class="w-full">

        <div class="flex flex-col sm:flex-row md:items-start justify-between gap-5">
            <div class="flex items-center gap-4 min-w-0">
                <div
                    class="w-13 h-13 rounded-lg bg-primary flex items-center justify-center shrink-0 border border-gray-200/80">
                    <i class="bx bxs-grid text-2xl text-white"></i>
                </div>
                <div class="min-w-0">
                    <h1 class="text-black dark:text-white font-black text-2xl">
                        Dashboard
                    </h1>
                    <p class="text-sm text-gray-500 font-medium mt-1">
                        Pantau aktivitas dan perkembangan bisnis Anda hari ini.
                    </p>
                </div>
            </div>
            <div class=" mt-1">
                <a href="?route=laporan"
                    class="flex items-center justify-center gap-2 bg-primary text-white font-bold px-6 py-3 rounded-lg hover:hover-primary transition-all duration-200">
                    <i class="bx bxs-file-report text-lg"></i>
                    <span>Laporan</span>
                </a>
            </div>
        </div>

        <div class="mt-8">
            <div class="w-full bg-white rounded-lg border border-gray-200/80 overflow-hidden relative">
                <div class="px-7 py-8 md:px-10 md:py-10 flex flex-col lg:flex-row items-center justify-between gap-8">
                    <div class="order-2 lg:order-1 flex-1">
                        <p class="text-sm font-bold text-primary mb-2">
                            Selamat Datang 👋
                        </p>
                        <h2 class="text-3xl md:text-4xl font-black text-gray-900 leading-tight">
                            Selamat datang,
                            <span class="text-primary">
                                Super Admin!
                            </span>
                        </h2>
                        <p class="text-sm md:text-base text-gray-500 mt-3 max-w-2xl leading-relaxed">
                            Kelola menu, pantau transaksi, dan lihat perkembangan
                            penjualan melalui dashboard PWMS-POS.
                        </p>
                        <div class="flex flex-wrap items-center gap-3 mt-6">
                            <a href="?route=kasir"
                                class="inline-flex items-center gap-2 bg-primary text-white px-5 py-3 rounded-lg text-sm font-bold hover:hover-primary active:scale-95 transition-all duration-200">
                                <i class="bx bxs-cart-alt text-lg"></i>
                                <span>Buka Kasir</span>
                            </a>
                            <a href="?route=menu"
                                class="inline-flex items-center gap-2 bg-gray-50 text-gray-700 border border-gray-200 px-5 py-3 rounded-lg text-sm font-bold hover:bg-gray-100 active:scale-95 transition-all duration-200">
                                <i class="bx bxs-bowl-hot text-lg"></i>
                                <span>Kelola Menu</span>
                            </a>
                        </div>
                    </div>
                    <div class="order-1 lg:order-2 w-full lg:w-80 xl:w-96 flex justify-center lg:justify-end">
                        <div id="welcomeChart" class="w-full"></div>
                    </div>
                </div>
            </div> 
        </div>

        <div class="mt-8">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                <div class="bg-white p-6 rounded-lg border border-gray-200/80 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-700 mb-2">
                            Total Pendapatan
                        </p>
                        <h2 class="text-3xl font-black text-gray-900">
                            Rp1.280.320
                        </h2>
                        <div class="flex items-center gap-1.5 mt-3">
                            <i class="bx bxs-trending-up text-lg text-primary"></i>
                            <p class="text-xs font-semibold text-primary">
                                Pendapatan hari ini
                            </p>
                        </div>
                    </div>
                    <div
                        class="w-14 h-14 bg-primary rounded-lg flex items-center justify-center text-white shrink-0">
                        <i class="bx bxs-chart-sine text-2xl"></i>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg border border-gray-200/80 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-700 mb-2">
                            Transaksi Hari Ini
                        </p>
                        <h2 class="text-3xl font-black text-gray-900">
                            42
                        </h2>
                        <p class="text-xs font-medium text-gray-400 mt-3">
                            Transaksi berhasil dicatat
                        </p>
                    </div>
                    <div
                        class="w-14 h-14 bg-primary rounded-lg flex items-center justify-center text-white shrink-0">
                        <i class="bx bxs-receipt text-2xl"></i>
                    </div>
                </div>  

                <div class="bg-white p-6 rounded-lg border border-gray-200/80 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-700 mb-2">
                            Total Menu
                        </p>
                        <h2 class="text-3xl font-black text-gray-900">
                            18
                        </h2>
                        <p class="text-xs font-medium text-gray-400 mt-3">
                            Menu aktif tersedia
                        </p>
                    </div>
                    <div
                        class="w-14 h-14 bg-primary rounded-lg flex items-center justify-center text-white shrink-0">
                        <i class="bx bxs-bowl-hot text-2xl"></i>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>
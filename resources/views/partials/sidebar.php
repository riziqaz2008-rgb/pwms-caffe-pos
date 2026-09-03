<section id="SideBar">
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black/50 transition-opacity lg:hidden" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>
    <aside id="MainBodySideBar" class="fixed inset-y-0 left-0 z-50 bg-white border-e border-gray-200/50 h-screen overflow-hidden transition-all duration-500 ease-[cubic-bezier(.22,1,.36,1)] lg:sticky lg:top-0" :class="sidebarOpen ? 'translate-x-0 w-full sm:w-72' : '-translate-x-full w-72 lg:translate-x-0 lg:w-24'">
        <div class="flex flex-col h-full overflow-y-auto border-e border-gray-200/50 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
            <div @click="sidebarOpen = !sidebarOpen; if (!sidebarOpen) { dashboardOpen = false; }" class="sticky top-0 w-full bg-white group px-6.5 py-6 relative flex justify-start items-center cursor-pointer transition-all duration-300 z-[999]">
                <div class="group-hover:hidden p-3 rounded-lg bg-primary flex items-center justify-center">
                    <i class="bx bxs-store text-xl text-white"></i>
                </div>
                <div class="hidden group-hover:flex items-center">
                    <i class="bx bxs-dock-left text-xl"></i>
                </div>    
                <div x-show="sidebarOpen" class="font-black ms-3">Caffe<span class="text-primary">PW</span></div>
            </div>
            <ul class="flex flex-col items-start h-screen my-5 px-5 mb-4">
                <div class="w-full">
                    <div x-show="sidebarOpen" x-transition class="px-2 mb-4 text-[11px] font-bold uppercase tracking-wider text-gray-400">
                        Menu Utama
                    </div>
                    <li>
                        <a href="?route=kasir" class="relative flex justify-start items-center px-4 py-4 rounded-lg gap-4 mb-8 <?= $route === "kasir" ? 'bg-primary text-white font-bold' : 'bg-primary text-white hover:bg-blue-700 duration-300 transition-all ease-in-out' ?>">
                            <i class="bx bxs-cart text-xl"></i>
                            <span x-show="sidebarOpen" x-transition class="font-semibold whitespace-nowrap">
                               Kasir | POS
                           </span>
                        </a>
                    </li>
                    <div x-show="sidebarOpen" x-transition class="px-2 mb-4 text-[11px] font-bold uppercase tracking-wider text-gray-400">
                        Operasional
                    </div>
                    <li>
                        <a href="?route=dashboard" class="relative flex justify-start items-center px-4 py-4 rounded-lg gap-4 <?= $route === 'dashboard' ? 'bg-gray-50 text-primary font-bold' : 'text-gray-400/80 hover:bg-black/5 transition-all duration-300' ?>">
                            <?php if ($route === 'dashboard'): ?>
                                <span class="absolute left-0 w-1.5 h-7 bg-primary rounded-r-full"></span>
                            <?php endif; ?>
                            <i class="bx bxs-grid text-xl"></i>
                            <span x-show="sidebarOpen" x-transition class="font-semibold whitespace-nowrap">
                                Dashboard
                            </span>
                        </a>
                    </li>
                    <li>
                        <button type="button" @click="if (!sidebarOpen) { sidebarOpen = true; Menu = true; } else { Menu = !Menu; }" class="relative w-full justify-between flex items-center px-4 py-4 rounded-lg cursor-pointer <?= $route === "menu" || $route === "menu/kategori" ? 'bg-gray-50 text-primary font-bold' : 'text-gray-400/80 hover:bg-black/5 duration-300 transition-all ease-in-out' ?>">
                            <div class="flex items-center gap-4">
                                <?php if ($route === 'menu' || $route === 'menu/kategori'): ?>
                                    <span class="absolute left-0 w-1.5 h-7 bg-primary rounded-r-full"></span>
                                <?php endif; ?>
                                <i class="bx bxs-dish text-xl shrink-0"></i>
                                <span x-show="sidebarOpen" x-transition class="font-semibold whitespace-nowrap">
                                    Kelola Menu
                                </span>
                            </div>
                            <i x-show="sidebarOpen" x-transition class="bx bxs-chevron-down text-xl transition-transform duration-300" :class="Menu ? 'rotate-180' : ''"></i>
                        </button>
                        <div class="grid transition-all duration-300 ease-out" :class="Menu && sidebarOpen ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
                            <div class="overflow-hidden">
                                <div class="ml-5 mt-2 pl-4 border-l-2 border-gray-100 space-y-1">
                                    <a href="?route=menu" class="font-medium <?= $route === "menu" ? 'flex items-center gap-x-3 text-primary px-4 py-4 rounded-lg' : 'flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400/80 hover:bg-black/5 transition-all' ?>">
                                        <i class="bx bxs-bowl-noodles text-lg shrink-0"></i>
                                        <span x-show="sidebarOpen" x-transition class="whitespace-nowrap">
                                            Menu
                                        </span>
                                    </a>
                                    <a href="?route=menu/kategori" class="font-medium <?= $route === "menu/kategori" ? 'flex items-center gap-x-3 text-primary px-4 py-4 rounded-lg' : 'flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400/80 hover:bg-black/5 transition-all' ?>">
                                        <i class="bx bxs-book-bookmark text-lg shrink-0"></i>
                                        <span x-show="sidebarOpen" x-transition class="whitespace-nowrap">
                                            Kategori
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="?route=metode" class="relative flex justify-start items-center px-4 py-4 rounded-lg gap-4 <?= $route === "metode" ? 'bg-gray-50 text-primary font-bold' : 'text-gray-400/80 hover:bg-black/5 duration-300 transition-all ease-in-out' ?>">
                            <?php if ($route === 'metode'): ?>
                                <span class="absolute left-0 w-1.5 h-7 bg-primary rounded-r-full"></span>
                            <?php endif; ?>
                            <i class="bx bxs-credit-card text-xl"></i>
                            <span x-show="sidebarOpen" x-transition class="font-semibold whitespace-nowrap">
                               Metode
                           </span>
                        </a>
                    </li>    
                    <li>
                        <a href="?route=hutang" class="relative flex justify-start items-center px-4 py-4 rounded-lg gap-4 mb-8 <?= $route === "hutang" ? 'bg-gray-50 text-primary font-bold' : 'text-gray-400/80 hover:bg-black/5 duration-300 transition-all ease-in-out' ?>">
                            <?php if ($route === 'hutang'): ?>
                                <span class="absolute left-0 w-1.5 h-7 bg-primary rounded-r-full"></span>
                            <?php endif; ?>
                            <i class="bx bxs-note text-xl"></i>
                            <span x-show="sidebarOpen" x-transition class="font-semibold whitespace-nowrap">
                               Hutang
                           </span>
                        </a>
                    </li>             
                <div x-show="sidebarOpen" x-transition class="px-2 mb-4 text-[11px] font-bold uppercase tracking-wider text-gray-400">
                    System
                </div>
                <div class="w-full">
                    <li>
                        <button type="button" @click="if (!sidebarOpen) { sidebarOpen = true; Pengguna = true; } else { Pengguna = !Pengguna; }" class="relative w-full justify-between flex items-center px-4 py-4 rounded-lg cursor-pointer <?= $route === "pelanggan" || $route === "anggota" ? 'bg-gray-50 text-primary font-bold' : 'text-gray-400/80 hover:bg-black/5 duration-300 transition-all ease-in-out' ?>">
                            <div class="flex items-center gap-4">
                                <?php if ($route === "pelanggan" || $route === "anggota"): ?>
                                    <span class="absolute left-0 w-1.5 h-7 bg-primary rounded-r-full"></span>
                                <?php endif; ?>
                                <i class="bx bxs-group text-xl shrink-0"></i>
                                <span x-show="sidebarOpen" x-transition class="font-semibold whitespace-nowrap">
                                    Data Pengguna
                                </span>
                            </div>
                            <i x-show="sidebarOpen" x-transition class="bx bxs-chevron-down text-xl transition-transform duration-300" :class="Pengguna ? 'rotate-180' : ''"></i>
                        </button>
                        <div class="grid transition-all duration-300 ease-out" :class="Pengguna && sidebarOpen ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
                            <div class="overflow-hidden">
                                <div class="ml-5 mt-2 pl-4 border-l-2 border-gray-100 space-y-1">
                                    <a href="?route=anggota" class="<?= $route === "anggota" ? 'flex items-center gap-x-3 font-medium text-primary px-4 py-4 rounded-lg' : 'flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400/80 hover:bg-black/5 transition-all' ?>">
                                        <i class="bx bxs-user-id-card text-lg shrink-0"></i>
                                        <span x-show="sidebarOpen" x-transition class="whitespace-nowrap">
                                            Anggota
                                        </span>
                                    </a>
                                    <a href="?route=pelanggan" class="<?= $route === "pelanggan" ? 'flex items-center gap-x-3 font-medium text-primary px-4 py-4 rounded-lg' : 'flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400/80 hover:bg-black/5 transition-all' ?>">
                                        <i class="bx bxs-user text-lg shrink-0"></i>
                                        <span x-show="sidebarOpen" x-transition class="whitespace-nowrap">
                                            Pelanggan
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="?route=laporan" class="relative flex justify-start items-center px-4 py-4 rounded-lg gap-4 <?= $route === "laporan" ? 'bg-gray-50 text-primary font-bold' : 'text-gray-400/80 hover:bg-black/5 duration-300 transition-all ease-in-out' ?>">
                            <?php if ($route === 'laporan'): ?>
                                <span class="absolute left-0 w-1.5 h-7 bg-primary rounded-r-full"></span>
                            <?php endif; ?>
                            <i class="bx bxs-archive text-xl"></i>
                            <span x-show="sidebarOpen" x-transition class="font-semibold whitespace-nowrap">
                                Laporan
                            </span>
                        </a>
                    </li>
                </div>            
                <div>
                    <li>
                        <a href="?route=pengaturan" class="relative flex justify-start items-center px-4 py-4 rounded-lg gap-4 <?= $route === "pengaturan" ? 'bg-gray-50 text-primary font-bold' : 'text-gray-400/80 hover:bg-black/5 duration-300 transition-all ease-in-out' ?>">
                            <?php if ($route === 'pengaturan'): ?>
                                <span class="absolute left-0 w-1.5 h-7 bg-primary rounded-r-full"></span>
                            <?php endif; ?>
                            <i class="bx bxs-hexagon text-xl"></i>
                            <span x-show="sidebarOpen" x-transition class="font-semibold whitespace-nowrap">
                                Pengaturan
                            </span>
                        </a>
                    </li>
                </div>
            </ul>  
            <div class="w-full bg-white sticky bottom-0 py-6 ps-3.5">
                <div class="hidden xl:flex items-center">
                    <span class="inline-block h-3.5 bg-gray-300 ml-3 align-middle"></span>
                    <button type="button" class="w-11 h-11 rounded-full overflow-hidden ring-2 ring-primary bg-primary flex items-center justify-center cursor-pointer transition-all duration-200 active:scale-95 hover:border-blue-600 focus:outline-none">
                       <span class="font-black text-white">AR</span>
                    </button> 
                    <div class="flex flex-col text-left ms-4">
                        <span x-show="sidebarOpen" class="text-[10px] font-black text-primary uppercase tracking-widest leading-none">Super Admin</span>
                        <span x-show="sidebarOpen" class="text-sm font-black text-slate-700 mt-1.5 leading-none">Achmad Riziq Al Azzim</span>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</section>
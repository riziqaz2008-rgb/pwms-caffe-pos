<?php
require_once __DIR__ . '/../../../routes/web.php';
ob_start();
include $page;
$content = ob_get_clean();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kedaiku | PW</title>   
        <link rel="icon" type="image/png" href="/assets/svg/cursor.svg">
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <!-- <link rel="stylesheet" href="/resources/css/app.css"> -->

        <link rel="stylesheet" href="http://localhost:5174/resources/css/app.css">
        <link href="https://cdn.boxicons.com/3.0.7/fonts/basic/boxicons.min.css"rel="stylesheet"/>

        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3" defer></script>

        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <script type="module" src="http://localhost:5174/resources/js/app.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist/dist/cdn.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs/dist/cdn.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/gsap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/css/tom-select.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/js/tom-select.complete.min.js"></script>
        
    </head>
    <body>
        <main>
            <section id="MainContent">
                <div class="flex flex-row">
                    <?php include ('../partials/sidebar.php') ?>
                    <div class="w-full flex flex-col">
                        <?php include ('../partials/navbar.php') ?>
                            <main id="mainContent" class="px-4 md:px-8 lg:px-10 xl:px-20 my-12">
                                <?= $content ?>
                            </main>
                        <a href="?route=kasir" data-drawer-target="drawer-bottom-example3" data-drawer-show="drawer-bottom-example3" data-drawer-placement="bottom" aria-controls="drawer-bottom-example3" class="flex items-center fixed bottom-8 right-8 bg-primary w-fit p-5.5 rounded-full cursor-pointer">
                            <i class="bx bx-cart text-white text-2xl"></i>
                        </a>
                    </div>
                </div>
                <div id="drawer-bottom-example2" class="fixed inset-x-0 bottom-0 z-50 w-full max-w-5xl mx-auto px-6 lg:px-12 py-4 bg-white rounded-t-4xl shadow-lg transform translate-y-full transition-transform duration-300 ease-in-out h-[90vh] md:h-auto max-h-[90vh] overflow-y-auto [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]" tabindex="-1" aria-labelledby="drawer-bottom-label">
                    <div class="my-8 flex justify-between items-center">
                            <div>
                            <div class="flex items-center tracking-tight gap-x-3">
                                    <i class="bx bx-hexagon text-2xl"></i> <h1 class="text-2xl text-black font-black dark:text-slate-200">Settings</h1>
                            </div>
                                <p class="text-gray-400 text-sm">Upload Excel lalu preview tabel</p>
                            </div>                
                            <div
                                id="closeOffCanvas" data-drawer-hide="drawer-bottom-example2" aria-controls="drawer-bottom-example2"
                                class="flex items-center justify-center w-11 h-11 rounded-full bg-primary text-white font-black cursor-pointer hover:bg-blue-700 transition">
                                <span>X</span>
                            </div>
                        </div>
                        <div class="space-y-6 my-8">
                            <div class="space-y-4">
                                <h2 class="text-xs font-bold uppercase tracking-wider text-gray-400">Umum & Tampilan</h2>
                                
                                <div class="dark:bg-slate-800/50 rounded-2xl p-4 space-y-4 border border-gray-100 dark:border-slate-800">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-semibold text-slate-800 dark:text-slate-200">Switch (Layout Mode)</p>
                                            <p class="text-xs text-gray-400">Ubah tampilan antarmuka pencarian tabel atau grid</p>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" x-model="layoutModeToggle" x-transition checked>
                                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                        </label>
                                    </div>

                                    <hr class="border-gray-200/60 dark:border-slate-700/60">

                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-semibold text-slate-800 dark:text-slate-200">Filter-Toggle</p>
                                            <p class="text-xs text-gray-400">Filter data memilah data secara otomatis</p>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" x-model="filterToggle" checked>
                                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </main>
    </body>
</html>
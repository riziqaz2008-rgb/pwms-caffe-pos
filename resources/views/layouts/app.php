<?php
    require_once __DIR__ . '/../../../routes/web.php';
    ob_start();
    include $page;
    $content = ob_get_clean();
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kedaiku | PW</title>   

        <!-- STYLE ICON -->
        <link rel="icon" type="image/png" href="/assets/svg/cursor.svg">        
        <link rel="stylesheet" href="http://localhost:5174/resources/css/app.css">
        <link href="https://cdn.boxicons.com/3.0.7/fonts/basic/boxicons.min.css"rel="stylesheet"/>
        
        <!-- STYLE -->
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        
        <!-- JQUERY -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- SELECT 2 -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- JAVASCRIPT -->
        <script type="module" src="http://localhost:5174/resources/js/app.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist/dist/cdn.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs/dist/cdn.min.js"></script>

        <!-- DATA TABLES -->
        <script defer src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>

        <!-- GSAP  -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/gsap.min.js"></script>
    </head>
    <body x-data="{
            sidebarOpen: $persist(false),
            Menu: $persist(false),
            Pengguna: $persist(false),
            
            showToast: false,
            showConfirmDelete: false,

            showConfirm: false,
            confirmTitle: '',
            confirmMessage: '',
            confirmButton: '',
            confirmIcon: 'alert-triangle',
            confirmColor: 'rose',
            confirmAction: null,

            modalKonfirmasi(data) {
                this.confirmTitle = data.judul;
                this.confirmMessage = data.pesan;
                this.confirmButton = data.btn;
                this.confirmIcon = data.icon ?? 'alert-triangle';
                this.confirmColor = data.warnaBtn ?? 'rose';
                this.confirmAction = data.callback ?? null;

                this.showConfirm = true;
            },

            jalankanKonfirmasi() {
                if (this.confirmAction) {
                    this.confirmAction();
                }

                this.showConfirm = false;
            }
        }"  >
        <main>
            <section id="MainContent">
                <div class="flex flex-row">
                    <?php include ('../partials/sidebar.php') ?>
                    <div class="w-full flex flex-col">
                        <?php include ('../partials/navbar.php') ?>
                        <main id="mainContent" class="px-4 md:px-8 lg:px-10 xl:px-20 my-12">
                            <?= $content ?>
                        </main>
                    </div>
                </div>
                   <div> 
                    <!-- INI TOAST -->
                        <div 
                            x-show="showToast"
                            x-transition
                            id="toast-default" 
                            class="fixed top-26 right-5 z-50te flex items-center w-full max-w-xs p-4 text-body bg-emerald-600 rounded-lg shadow-xs" 
                            role="alert"
                        >
                            <i class="bx bxs-check-circle text-xl text-white"></i>

                            <div class="ms-2.5 text-white text-sm font-bold border-s border-default ps-3.5">
                                Pesanan Berhasil Di Simpan.
                            </div>

                            <button 
                                type="button"
                                @click="showToast = false"
                                class="ms-auto flex items-center justify-center text-white text-body hover:text-heading bg-transparent border border-transparent hover:bg-neutral-secondary-medium focus:ring-4 focus:ring-neutral-tertiary font-medium rounded text-sm h-8 w-8 focus:outline-none"
                                aria-label="Close"
                            >
                                <span class="sr-only">Close</span>

                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                                </svg>
                            </button>
                        </div>

                    <div>
                        <div
                            x-show="showConfirm"
                            x-cloak
                            x-transition.opacity
                            @keydown.escape.window="showConfirm = false"
                            class="fixed inset-0 z-[9999] flex items-center justify-center p-4 sm:p-6 bg-slate-900/60 backdrop-blur-sm"
                        >

                            <div
                                @click="showConfirm = false"
                                class="fixed inset-0"
                            ></div>

                            <div
                                x-show="showConfirm"
                                x-transition:enter="transition ease-out duration-200 transform"
                                x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150 transform"
                                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                                class="relative w-full max-w-md p-6 sm:p-8 bg-white dark:bg-slate-900 rounded-3xl shadow-2xl text-center border border-slate-100 dark:border-slate-800 z-10"
                            >

                                <div class="w-16 h-16 rounded-2xl bg-rose-50 dark:bg-rose-950/50 text-rose-500 flex items-center justify-center mx-auto mb-5 shadow-inner">
                                    <i
                                        class="bx text-4xl"
                                        :class="'bx-' + confirmIcon"
                                    ></i>
                                </div>

                                <h3
                                    x-text="confirmTitle"
                                    class="text-xl font-bold text-slate-900 dark:text-white tracking-tight"
                                ></h3>

                                <p
                                    x-html="confirmMessage"
                                    class="text-sm text-slate-500 dark:text-slate-400 mt-2 mb-8 leading-relaxed"
                                ></p>

                                <div class="flex items-center gap-3">

                                    <button
                                        type="button"
                                        @click="showConfirm = false"
                                        class="flex-1 py-3 px-4 rounded-lg bg-gray-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-sm font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors cursor-pointer"
                                    >
                                        Batal
                                    </button>

                                    <button
                                        type="button"
                                        @click="jalankanKonfirmasi()"
                                        x-text="confirmButton"
                                        class="flex-1 py-3 px-4 rounded-lg bg-rose-600 hover:bg-rose-700 text-white text-sm font-semibold shadow-md shadow-rose-600/20 transition-colors cursor-pointer"
                                    ></button>

                                </div>

                            </div>

                        </div>
            </section>
        </main>      
    </body>
</html>
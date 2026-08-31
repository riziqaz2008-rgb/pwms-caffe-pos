<?php
    require_once __DIR__ . '/../../../routes/web.php';
    require_once __DIR__ . '/../../../app/Global.Controller.php';
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
                    <!-- INI TOAST JIR -->
                     <div 
                        id="liveToast" 
                        class="fixed top-28 right-5 z-50 flex items-center w-full max-w-xs p-4 rounded-lg shadow-lg text-white hidden opacity-0 transition-all duration-300 transform translate-y-2 bg-emerald-600"
                        role="alert"
                        >
                            <i id="toastIcon" class="bx bxs-check-circle text-xl text-white"></i>

                            <div id="pesanToast" class="ms-2.5 text-white text-sm font-bold border-s border-white/30 ps-3.5"></div>

                            <button 
                                type="button"
                                id="toastCloseBtn"
                                class="ms-auto flex items-center justify-center text-white hover:bg-white/20 font-medium rounded text-sm h-8 w-8 focus:outline-none transition"
                                aria-label="Close"
                            >
                                <span class="sr-only">Close</span>
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                                </svg>
                            </button>
                        </div>

                    <div>

                    <!-- INI MODAL TANPA FORM -->

                    <div 
                        id="confirmModal" 
                        class="fixed inset-0 z-[9999] hidden items-center justify-center p-4 sm:p-6 bg-slate-900/60 backdrop-blur-sm opacity-0 transition-opacity duration-200"
                    >
                        <div id="confirmOverlay" class="fixed inset-0"></div>

                        <div 
                            id="confirmBox"
                            class="relative w-full max-w-md p-6 sm:p-8 bg-white dark:bg-slate-900 rounded-3xl shadow-2xl text-center border border-slate-100 dark:border-slate-800 z-10 scale-95 translate-y-2 transition-all duration-200"
                        >
                            <div 
                                id="confirmIconContainer"
                                class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-inner"
                            >
                                <i id="confirmIcon" class="bx text-4xl"></i>
                            </div>

                            <h3 id="confirmTitle" class="text-xl font-bold text-slate-900 dark:text-white tracking-tight"></h3>
                            <p id="confirmMessage" class="text-sm text-slate-500 dark:text-slate-400 mt-2 mb-8 leading-relaxed"></p>

                            <div class="flex items-center gap-3">
                                <button 
                                    type="button" 
                                    id="confirmCancelBtn"
                                    class="flex-1 py-3 px-4 rounded-lg bg-gray-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-sm font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors cursor-pointer"
                                ></button>

                                <button 
                                    type="button" 
                                    id="confirmActionBtn"
                                    class="flex-1 py-3 px-4 rounded-lg text-white text-sm font-semibold shadow-md transition-colors cursor-pointer"
                                ></button>
                            </div>
                        </div>
                    </div>

                    <!-- INI MODAL DENGAN FORM -->

                    <div 
                        id="globalFormModal" 
                        class="fixed inset-0 z-[9999] hidden items-center justify-center p-4 sm:p-6 bg-slate-900/60 backdrop-blur-sm opacity-0 transition-opacity duration-200"
                    >
                        <div id="globalFormOverlay" class="fixed inset-0"></div>

                        <div 
                            id="globalFormBox"
                            class="relative w-full max-w-md p-6 sm:p-8 bg-white dark:bg-slate-900 rounded-3xl shadow-2xl text-center border border-slate-100 dark:border-slate-800 z-10 scale-95 translate-y-2 transition-all duration-200"
                        >
                            <div 
                                id="globalFormIconContainer"
                                class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-inner"
                            >
                                <i id="globalFormIcon" class="bx text-4xl"></i>
                            </div>

                            <h3 id="globalFormTitle" class="text-xl font-bold text-slate-900 dark:text-white tracking-tight"></h3>
                            <p id="globalFormMessage" class="text-sm text-slate-500 dark:text-slate-400 mt-2 mb-6 leading-relaxed"></p>

                            <form id="globalFormElement" action="#" method="POST" class="text-left space-y-4">
                                <div id="globalFormInputsContainer" class="space-y-4"></div>

                                <div class="flex items-center gap-3 pt-4 w-full">
                                    <button 
                                        type="button" 
                                        id="globalFormCancelBtn"
                                        class="flex-1 py-3 px-4 rounded-lg bg-gray-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-sm font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors cursor-pointer text-center"
                                    ></button>

                                    <button 
                                        type="submit" 
                                        id="globalFormSubmitBtn"
                                        class="flex-1 py-3 px-4 rounded-lg text-white text-sm font-semibold shadow-md transition-colors cursor-pointer text-center"
                                    ></button>
                                </div>
                            </form>
                        </div>
                    </div>
                  
            </section>
        </main>      
    </body>
</html>
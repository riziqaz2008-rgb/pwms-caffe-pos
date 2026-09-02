<?php
    require_once __DIR__ . '/../../../app/Global.Controller.php';
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
        <acriptk src="http://localhost:5174/resources/css/app.js">
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
        
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

                    <div
                        id="confirmModal"
                        tabindex="-1"
                        aria-hidden="true"
                        class="hidden fixed inset-0 z-[9999] items-center justify-center p-4 overflow-y-auto"
                    >
                        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

                        <div
                            id="confirmBox"
                            class="relative w-full max-w-md p-6 sm:p-8 bg-white dark:bg-slate-900 rounded-3xl shadow-2xl text-center z-10"
                        >
                            <div
                                id="confirmIconContainer"
                                class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-5">
                                <i id="confirmIcon" class="bx text-4xl"></i>
                            </div>

                            <h3 id="confirmTitle" class="text-xl font-bold text-slate-900 dark:text-white tracking-tight"></h3>
                            <p id="confirmMessage" class="text-sm text-slate-500 dark:text-slate-400 mt-2 mb-8 leading-relaxed"></p>
                      
                            <div class="flex items-center gap-3">
                                <button
                                    type="button"
                                    id="confirmCancelBtn"
                                    data-modal-hide="confirmModal"
                                    class="flex-1 py-3 px-4 rounded-lg bg-gray-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-sm font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors"
                                >
                                    Batal
                                </button>

                                <button
                                    type="button"
                                    id="confirmActionBtn"
                                    class="flex-1 py-3 px-4 rounded-lg text-white text-sm font-semibold shadow-md transition-colors"
                                >
                                    Hapus
                                </button>

                            </div>

                    </div>

                    
                </div>

            </section>
        </main>     
    
        <?php if(isset($hasil)): ?>
          <script>
            document.addEventListener('DOMContentLoaded', function (){
              showToast(<?= json_encode($hasil) ?>);
            });
          </script>
        <?php endif; ?>

        <script>

            // INI GLOBAL TOAST JS YE..

            function showToast(message, type = 'success') {
                const toast = document.getElementById('liveToast');
                const pesan = document.getElementById('pesanToast');
                const icon = document.getElementById('toastIcon');

                pesan.textContent = message;

                toast.classList.remove(
                    'bg-emerald-600',
                    'bg-red-600',
                    'bg-amber-500',
                    'bg-blue-600'
                );

                if (type === 'success') {
                    toast.classList.add('bg-emerald-600');
                    icon.className = 'bx bxs-check-circle text-xl text-white';
                } else if (type === 'error') {
                    toast.classList.add('bg-red-600');
                    icon.className = 'bx bxs-x-circle text-xl text-white';
                } else if (type === 'warning') {
                    toast.classList.add('bg-amber-500');
                    icon.className = 'bx bxs-error text-xl text-white';
                } else if (type === 'info') {
                    toast.classList.add('bg-blue-600');
                    icon.className = 'bx bxs-info-circle text-xl text-white';
                }

                toast.classList.remove('hidden');

                requestAnimationFrame(() => {
                    toast.classList.remove('opacity-0', 'translate-y-2');
                    toast.classList.add('opacity-100', 'translate-y-0');
                });

                setTimeout(() => {
                    toast.classList.remove('opacity-100', 'translate-y-0');
                    toast.classList.add('opacity-0', 'translate-y-2');

                    setTimeout(() => {
                        toast.classList.add('hidden');
                    }, 300);
                }, 3000);
            }

        // INI ANU ADALAH POKOKNYA INI MODAL KONFIRMASI GLOBAL

            const confirmModal = document.getElementById('confirmModal');

            function showConfirm(
                title = 'Hapus Data?',
                message = 'Data yang dihapus tidak dapat dikembalikan.',
                actionText = 'Hapus',
                type = 'danger'
            ) {
                const titleElement = document.getElementById('confirmTitle');
                const messageElement = document.getElementById('confirmMessage');
                const actionButton = document.getElementById('confirmActionBtn');
                const iconContainer = document.getElementById('confirmIconContainer');
                const icon = document.getElementById('confirmIcon');

                titleElement.textContent = title;
                messageElement.textContent = message;
                actionButton.textContent = actionText;

                actionButton.classList.remove(
                    'bg-red-600',
                    'hover:bg-red-700',
                    'bg-emerald-600',
                    'hover:bg-emerald-700',
                    'bg-amber-500',
                    'hover:bg-amber-600',
                    'bg-blue-600',
                    'hover:bg-blue-700'
                );

                iconContainer.classList.remove(
                    'bg-red-100',
                    'text-red-600',
                    'bg-emerald-100',
                    'text-emerald-600',
                    'bg-amber-100',
                    'text-amber-600',
                    'bg-blue-100',
                    'text-blue-600'
                );

                if (type === 'danger') {
                    actionButton.classList.add('bg-red-600', 'hover:bg-red-700');
                    iconContainer.classList.add('bg-red-100', 'text-red-600');
                    icon.className = 'bx bx-trash text-4xl';
                }

                if (type === 'success') {
                    actionButton.classList.add('bg-emerald-600', 'hover:bg-emerald-700');
                    iconContainer.classList.add('bg-emerald-100', 'text-emerald-600');
                    icon.className = 'bx bx-check-circle text-4xl';
                }

                if (type === 'warning') {
                    actionButton.classList.add('bg-amber-500', 'hover:bg-amber-600');
                    iconContainer.classList.add('bg-amber-100', 'text-amber-600');
                    icon.className = 'bx bx-error text-4xl';
                }

                if (type === 'info') {
                    actionButton.classList.add('bg-blue-600', 'hover:bg-blue-700');
                    iconContainer.classList.add('bg-blue-100', 'text-blue-600');
                    icon.className = 'bx bx-info-circle text-4xl';
                }

                confirmModal.classList.remove('hidden');
                confirmModal.classList.add('flex');
            }

            document.getElementById('confirmCancelBtn').addEventListener('click', function () {
                confirmModal.classList.add('hidden');
                confirmModal.classList.remove('flex');
            });

            confirmModal.querySelector('.fixed.inset-0').addEventListener('click', function () {
                confirmModal.classList.add('hidden');
                confirmModal.classList.remove('flex');
            });

            // INI MODAL UTAMA GLOBAL YANG ADA FORM NYA

            function showGlobalModal(data){
                const modal=document.getElementById('global-modal');
                const title=document.getElementById('globalModalTitle');
                const subtitle=document.getElementById('globalModalSubtitle');
                const iconContainer=document.querySelectorAll('.globalModalIconContainer');
                const icon=document.getElementById('globalModalIcon');
                const form=document.getElementById('globalModalForm');
                const submit=document.getElementById('globalModalSubmit');
                const submitIcon=document.getElementById('globalModalSubmitIcon');
                const submitText=document.getElementById('globalModalSubmitText');

                title.textContent=data.title??'';
                subtitle.textContent=data.subtitle??'';
                
                iconContainer.forEach(iconContainer => {
                    iconContainer.className = `globalModalIconContainer flex w-12 h-12 rounded-lg items-center justify-center shrink-0 ${data.iconBg ?? 'bg-primary'}`;
                });


                icon.className = `bx ${data.icon ?? 'bx-plus'} text-2xl text-white`;
                
                form.action=data.action??'#';

                form.method=data.method??'POST';

                
                submit.value = data.value ?? '';
                submit.name = data.nameBtn ?? '';

                submit.className=`w-full sm:w-auto flex items-center justify-center text-white font-black px-6 py-3 gap-2 rounded-lg text-sm transition-all ${data.buttonColor??'bg-primary hover:bg-blue-700'}`;
                submitIcon.className=`bx ${data.buttonIcon??'bxs-save'} text-lg`;
                
                submitText.textContent=data.buttonText??'Simpan';
                modal.classList.remove('hidden');
                modal.classList.add('flex');                
            }

            function closeGlobalModal(){
                const modal=document.getElementById('global-modal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
            document.getElementById('global-modal').addEventListener('click',function(event){
                if(event.target===this)closeGlobalModal();
            });
            document.addEventListener('keydown',function(event){
                if(event.key==='Escape')closeGlobalModal();
            });

            const globalModalForm = document.getElementById('globalModalForm');
            const namaKategori = document.getElementById('namaKategori');
            const namaKategoriError = document.getElementById('namaKategoriError');

            globalModalForm.addEventListener('submit', function(event) {

                if (namaKategori.value.trim() === '') {
                    event.preventDefault();

                    namaKategori.classList.remove('border-gray-200/80');
                    namaKategori.classList.add('border-red-500', 'bg-red-50');

                    namaKategoriError.classList.remove('hidden');

                    return;
                }

                namaKategori.classList.remove(
                    'border-red-500',
                    'bg-red-50'
                );

                namaKategori.classList.add('border-gray-200/80');

                namaKategoriError.classList.add('hidden');
            });
            
        </script>
    </body>
</html>
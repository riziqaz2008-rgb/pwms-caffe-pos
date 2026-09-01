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
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> afd1f2a (pengguna - Sltn)
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
                                    class="flex-1 py-3 px-4 rounded-lg bg-gray-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-sm font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors cursor-pointer"
                                ></button>

                                <button 
                                    type="button" 
                                    id="confirmActionBtn"
                                    class="flex-1 py-3 px-4 rounded-lg text-white text-sm font-semibold shadow-md transition-colors cursor-pointer"
                                ></button>

                            <h3
                                id="confirmTitle"
                                class="text-xl font-bold text-slate-900 dark:text-white tracking-tight"
                            ></h3>

                            <p
                                id="confirmMessage"
                                class="text-sm text-slate-500 dark:text-slate-400 mt-2 mb-8 leading-relaxed"
                            ></p>

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

                    
                </div>

            </section>
        </main> 
    
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

            setTimeout(() => {
                toast.classList.add('hidden');
            }, 3000);
        }

        // INI ANU ADALAH POKOKNYA INI MODAL GLOBAL

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



            function showGlobalModal(data){
                const modal=document.getElementById('global-modal');
                const title=document.getElementById('globalModalTitle');
                const subtitle=document.getElementById('globalModalSubtitle');
                const iconContainer=document.getElementById('globalModalIconContainer');
                const icon=document.getElementById('globalModalIcon');
                const form=document.getElementById('globalModalForm');
                const input=document.getElementById('globalModalInput');
                const submit=document.getElementById('globalModalSubmit');
                const submitIcon=document.getElementById('globalModalSubmitIcon');
                const submitText=document.getElementById('globalModalSubmitText');

                title.textContent=data.title??'';
                subtitle.textContent=data.subtitle??'';
                
                iconContainer.className=`flex w-12 h-12 rounded-lg items-center justify-center shrink-0 ${data.iconBg??'bg-primary'}`;
                icon.className=`bx ${data.icon??'bx-plus'} text-2xl text-white`;

                form.action=data.action??'#';
                form.method=data.method??'POST';

                input.value=data.value??'';
                submit.className=`w-full sm:w-auto flex items-center justify-center text-white font-black px-6 py-3 gap-2 rounded-lg text-sm transition-all ${data.buttonColor??'bg-primary hover:bg-blue-700'}`;
                submitIcon.className=`bx ${data.buttonIcon??'bxs-save'} text-lg`;
                
                submitText.textContent=data.buttonText??'Simpan';
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                input.focus();
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
=======
            </section>
        </main>      

        <script>
            let toastTimeout;

            window.showToast = function(d) {
              if (!d) return;

              const $toast = $('#liveToast');
              const $pesan = $('#pesanToast');
              const $icon = $('#toastIcon');

              if (!$toast.length) return;

              const message = d.pesan || d.message || '';
              let type = d.bg || d.type || 'success';
              if (type === 'danger') type = 'error';

              $pesan.text(message);

              // Reset class warna & ikon
              $toast.removeClass('bg-emerald-600 bg-rose-600 bg-amber-500 bg-sky-600');
              $icon.removeClass('bxs-check-circle bxs-x-circle bxs-error bxs-info-circle');

              // Mapping class sesuai Alpine.js sebelumnya
              const config = {
                success: { bg: 'bg-emerald-600', icon: 'bxs-check-circle' },
                error: { bg: 'bg-rose-600', icon: 'bxs-x-circle' },
                warning: { bg: 'bg-amber-500', icon: 'bxs-error' },
                info: { bg: 'bg-sky-600', icon: 'bxs-info-circle' }
              };

              const currentConfig = config[type] || config.success;
              $toast.addClass(currentConfig.bg);
              $icon.addClass(currentConfig.icon);

              // Animasi muncul
              $toast.removeClass('hidden');
              setTimeout(() => {
                $toast.removeClass('opacity-0 translate-y-2').addClass('opacity-100 translate-y-0');
              }, 10);

              // Auto-hide
              clearTimeout(toastTimeout);
              toastTimeout = setTimeout(() => {
                hideToast();
              }, 4000);
            };

            window.hideToast = function() {
              const $toast = $('#liveToast');
              if (!$toast.length) return;

              $toast.removeClass('opacity-100 translate-y-0').addClass('opacity-0 translate-y-2');

              setTimeout(() => {
                $toast.addClass('hidden');
              }, 300);
            };

            $(document).on('click', '#toastCloseBtn', function() {
              hideToast();
            });

            let confirmCallback = null;

            window.showConfirm = function(options) {
              const config = {
                title: options.title || 'Konfirmasi',
                message: options.message || 'Apakah Anda yakin?',
                icon: options.icon || 'help-circle',
                type: options.type || 'info',
                buttonText: options.buttonText || 'Ya, Lanjutkan',
                cancelText: options.cancelText || 'Batal',
                onConfirm: options.onConfirm || null
              };

              confirmCallback = config.onConfirm;

              $('#confirmTitle').text(config.title);
              $('#confirmMessage').html(config.message);
              $('#confirmCancelBtn').text(config.cancelText);
              $('#confirmActionBtn').text(config.buttonText);

              $('#confirmIcon').attr('class', `bx bx-${config.icon} text-4xl`);

              const styles = {
                danger: {
                  iconBg: 'bg-rose-50 dark:bg-rose-950/50 text-rose-500',
                  btnBg: 'bg-rose-600 hover:bg-rose-700 shadow-rose-600/20'
                },
                warning: {
                  iconBg: 'bg-amber-50 dark:bg-amber-950/50 text-amber-500',
                  btnBg: 'bg-amber-600 hover:bg-amber-700 shadow-amber-600/20'
                },
                success: {
                  iconBg: 'bg-emerald-50 dark:bg-emerald-950/50 text-emerald-500',
                  btnBg: 'bg-emerald-600 hover:bg-emerald-700 shadow-emerald-600/20'
                },
                info: {
                  iconBg: 'bg-sky-50 dark:bg-sky-950/50 text-sky-500',
                  btnBg: 'bg-sky-600 hover:bg-sky-700 shadow-sky-600/20'
                }
              };

              const selectedStyle = styles[config.type] || styles.info;

              $('#confirmIconContainer')
                .removeClass('bg-rose-50 dark:bg-rose-950/50 text-rose-500 bg-amber-50 dark:bg-amber-950/50 text-amber-500 bg-emerald-50 dark:bg-emerald-950/50 text-emerald-500 bg-sky-50 dark:bg-sky-950/50 text-sky-500')
                .addClass(selectedStyle.iconBg);

              $('#confirmActionBtn')
                .removeClass('bg-rose-600 hover:bg-rose-700 shadow-rose-600/20 bg-amber-600 hover:bg-amber-700 shadow-amber-600/20 bg-emerald-600 hover:bg-emerald-700 shadow-emerald-600/20 bg-sky-600 hover:bg-sky-700 shadow-sky-600/20')
                .addClass(selectedStyle.btnBg);

              const $modal = $('#confirmModal');
              const $box = $('#confirmBox');

              $modal.removeClass('hidden').addClass('flex');

              setTimeout(() => {
                $modal.removeClass('opacity-0').addClass('opacity-100');
                $box.removeClass('scale-95 translate-y-2').addClass('scale-100 translate-y-0');
              }, 10);
            };

            window.hideConfirm = function() {
              const $modal = $('#confirmModal');
              const $box = $('#confirmBox');

              $modal.removeClass('opacity-100').addClass('opacity-0');
              $box.removeClass('scale-100 translate-y-0').addClass('scale-95 translate-y-2');

              setTimeout(() => {
                $modal.removeClass('flex').addClass('hidden');
                confirmCallback = null;
              }, 200);
            };

            $(document).ready(function() {
              $('#confirmCancelBtn, #confirmOverlay').on('click', function() {
                hideConfirm();
              });

              $('#confirmActionBtn').on('click', function() {
                if (typeof confirmCallback === 'function') {
                  confirmCallback();
                }
                hideConfirm();
              });

              $(document).on('keydown', function(e) {
                if (e.key === 'Escape' && !$('#confirmModal').hasClass('hidden')) {
                  hideConfirm();
                }
              });
            });


            // INI MODAK TANPA FORM

            window.showGlobalForm = function(options) {
              const config = {
                title: options.title || 'Konfirmasi',
                message: options.message || '',
                type: options.type || 'danger',
                icon: options.icon || 'error-circle',
                buttonText: options.buttonText || 'Lanjutkan',
                cancelText: options.cancelText || 'Batal',
                actionUrl: options.actionUrl || '#',
                method: options.method || 'POST',
                inputs: options.inputs || []
              };

              $('#globalFormTitle').text(config.title);
              $('#globalFormMessage').html(config.message);
              $('#globalFormCancelBtn').text(config.cancelText);
              $('#globalFormSubmitBtn').text(config.buttonText);
              $('#globalFormElement').attr('action', config.actionUrl).attr('method', config.method);

              $('#globalFormIcon').attr('class', `bx bx-${config.icon} text-4xl`);

              const styles = {
                danger: {
                  iconBg: 'bg-rose-600 dark:bg-rose-950/50 text-white',
                  btnBg: 'bg-rose-600 hover:bg-rose-700 shadow-rose-600/20'
                },
                warning: {
                  iconBg: 'bg-amber-50 dark:bg-amber-950/50 text-amber-500',
                  btnBg: 'bg-amber-600 hover:bg-amber-700 shadow-amber-600/20'
                },
                success: {
                  iconBg: 'bg-emerald-50 dark:bg-emerald-950/50 text-emerald-500',
                  btnBg: 'bg-emerald-600 hover:bg-emerald-700 shadow-emerald-600/20'
                },
                info: {
                  iconBg: 'bg-primary dark:bg-sky-950/50 text-white',
                  btnBg: 'bg-primary hover:bg-sky-700 shadow-primary/20'
                }
              };

              const selectedStyle = styles[config.type] || styles.info;

              $('#globalFormIconContainer')
                .removeClass('bg-rose-50 dark:bg-rose-950/50 text-rose-500 bg-amber-50 dark:bg-amber-950/50 text-amber-500 bg-emerald-50 dark:bg-emerald-950/50 text-emerald-500 bg-sky-50 dark:bg-sky-950/50 text-sky-500')
                .addClass(selectedStyle.iconBg);

              $('#globalFormSubmitBtn')
                .removeClass('bg-rose-600 hover:bg-rose-700 shadow-rose-600/20 bg-amber-600 hover:bg-amber-700 shadow-amber-600/20 bg-emerald-600 hover:bg-emerald-700 shadow-emerald-600/20 bg-sky-600 hover:bg-sky-700 shadow-sky-600/20')
                .addClass(selectedStyle.btnBg);

              const $inputsContainer = $('#globalFormInputsContainer');
              $inputsContainer.empty();

              config.inputs.forEach(item => {
                let inputHtml = '<div>';
                if (item.label) {
                  inputHtml += `<label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">${item.label}</label>`;
                }
                inputHtml += `<input 
                  type="${item.type || 'text'}" 
                  name="${item.name || ''}" 
                  value="${item.value || ''}" 
                  placeholder="${item.placeholder || ''}"
                  class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 transition"
                /></div>`;
                $inputsContainer.append(inputHtml);
              });

              const $modal = $('#globalFormModal');
              const $box = $('#globalFormBox');

              $modal.removeClass('hidden').addClass('flex');

              setTimeout(() => {
                $modal.removeClass('opacity-0').addClass('opacity-100');
                $box.removeClass('scale-95 translate-y-2').addClass('scale-100 translate-y-0');
              }, 10);
            };

        window.hideGlobalForm = function() {
          const $modal = $('#globalFormModal');
          const $box = $('#globalFormBox');

          $modal.removeClass('opacity-100').addClass('opacity-0');
          $box.removeClass('scale-100 translate-y-0').addClass('scale-95 translate-y-2');

          setTimeout(() => {
            $modal.removeClass('flex').addClass('hidden');
          }, 200);
        };

        $(document).ready(function() {
          $('#globalFormCancelBtn, #globalFormOverlay').on('click', function() {
            hideGlobalForm();
          });
        
          $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && !$('#globalFormModal').hasClass('hidden')) {
              hideGlobalForm();
            }
          });
        });
>>>>>>> afd1f2a (pengguna - Sltn)
        </script>
    </body>
</html>
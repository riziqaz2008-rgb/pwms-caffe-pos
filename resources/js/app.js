var welcomeChartOptions = {
        series: [{
            name: 'Data Gelap',
            data: [15, 25, 30, 35, 40, 8, 18, 52, 30] 
        }, {
            name: 'Data Hijau',
            data: [45, 30, 28, 25, 20, 52, 42, 8, 30] 
        }],
        chart: {
            type: 'bar',
            height: 160,
            stacked: true,
            sparkline: { 
                enabled: true // Fitur sakti untuk menghilangkan semua axis, grid, dan padding
            }
        },
        colors: ['#0a1612', '#3B82F6'],
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                borderRadius: 8, // Radius disesuaikan karena ukuran chart lebih kecil
                borderRadiusApplication: 'around',
                borderRadiusWhenStacked: 'all'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            width: 3, // Jarak putih tumpukan sedikit ditipiskan
            colors: ['#fff']
        },
        tooltip: {
            enabled: false // Dimatikan agar tidak ada tulisan/pop-up apapun saat di-hover
        }
    };


    

    var welcomeChart = new ApexCharts(document.querySelector("#welcomeChart"), welcomeChartOptions);
    welcomeChart.render();

        var habitOptions = {
        series: [{
            name: 'Streak',
            data: [15, 28, 10, 33, 31, 25, 14] // Data Biru Tua
        }, {
            name: 'Missed',
            data: [15, 12, 20, 12, 14, 15, 18] // Data Abu-abu Sedang
        }, {
            name: 'Goal',
            data: [0, 12, 0, 12, 10, 12, 10] // Data Abu-abu Muda
        }],
        chart: {
            type: 'bar',
            height: 280,
            stacked: true,
            toolbar: { show: false }, // Sembunyikan menu bawaan
            fontFamily: 'inherit'
        },
        colors: ['#3B82F6', '#d9dee5', '#e8ecf1'],
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '75%', // Ketebalan bar sesuai gambar
                borderRadius: 8, // Ujung bar membulat
                borderRadiusApplication: 'around',
                borderRadiusWhenStacked: 'all'
            },
        },
        dataLabels: {
            enabled: false // Sembunyikan angka di dalam bar
        },
        stroke: {
            width: 4,
            colors: ['#f4f6f8'] // Warna garis disamakan dengan background agar terlihat ada jarak putih/bolong antar bar
        },
        xaxis: {
            categories: ['03 Oct', '04 Oct', '05 Oct', '06 Oct', '07 Oct', '08 Oct', '09 Oct'],
            axisBorder: { show: false },
            axisTicks: { show: false },
            labels: {
                style: {
                    colors: '#9ca3af',
                    fontSize: '11px',
                    fontWeight: 600
                }
            }
        },
        yaxis: {
            max: 50, // Maksimal sumbu Y seperti di gambar (50K)
            tickAmount: 5, // Rentang kelipatan 10
            labels: {
                formatter: function (val) {
                    return val + "K"; // Tambahkan "K" di belakang angka
                },
                style: {
                    colors: '#9ca3af',
                    fontSize: '11px',
                    fontWeight: 600
                }
            }
        },
        grid: {
            show: false, // Menghilangkan garis background agar bersih
            padding: { top: 0, right: 0, bottom: 0, left: 10 }
        },
        legend: {
            show: false // Dimatikan karena kita pakai legend HTML kustom di atas
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            theme: 'light',
            y: {
                formatter: function (val) {
                    return val + "K"
                }
            }
        }
    };

    var habitChart = new ApexCharts(document.querySelector("#habitChart"), habitOptions);
    habitChart.render();


        document.addEventListener("DOMContentLoaded", function () {

    const table = document.getElementById("selection-table");

    if (!table) return;

    new DataTable(table, {

        searchable: true,

        sortable: true,

        perPage: 10,

        perPageSelect: [5, 10, 15, 20],

        labels: {
            placeholder: "Cari menu...",
            perPage: "menu per halaman",
            noRows: "Belum ada menu",
            info: "Menampilkan {start} sampai {end} dari {rows} menu"
        }

    });

});

$(document).ready(function () {
  $(".select2, .select2-multiple").select2({
    // placeholder: "Cari guru...",
    // allowClear: true
    width: "100%",
    language: {
      noResults: function (){return "Data tidak ditemukan";}, 
      searching: function (){return "Mencari...";}
    }
  });
});

<<<<<<< HEAD
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
=======

>>>>>>> 7e57b615230b0ad1a82366af887a8a867a742bf4

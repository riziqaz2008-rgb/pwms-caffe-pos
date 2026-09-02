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


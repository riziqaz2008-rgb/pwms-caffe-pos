<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Table</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Simple DataTables -->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
</head>

<body class="bg-gray-50 p-8">

    <div class="max-w-6xl mx-auto">

        <div class="bg-white rounded-2xl p-6">

            <table
                id="default-table"
                class="w-full text-sm text-left text-gray-500"
            >

                <thead class="bg-gray-50 text-xs uppercase text-gray-700">

                    <tr>

                        <!-- Nama -->
                        <th>
                            Nama
                        </th>

                        <!-- Harga -->
                        <th>
                            Harga
                        </th>

                        <!-- Kategori -->
                        <th>
                            Kategori
                        </th>

                        <!-- Status -->
                        <th>
                            Status
                        </th>

                        <!-- Aksi -->
                        <th>
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <!-- DATA 1 -->
                    <tr>

                        <td>
                            Nasi Goreng Spesial
                        </td>

                        <td>
                            Rp 25.000
                        </td>

                        <td>
                            Makanan
                        </td>

                        <td>
                            Aktif
                        </td>

                        <td>
                            <div class="flex gap-2">

                                <button
                                    type="button"
                                    class="edit-btn w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition"
                                >
                                    ✎
                                </button>

                                <button
                                    type="button"
                                    class="delete-btn w-9 h-9 rounded-xl bg-red-500 text-white flex items-center justify-center hover:bg-red-600 transition"
                                >
                                    ×
                                </button>

                            </div>
                        </td>

                    </tr>


                    <!-- DATA 2 -->
                    <tr>

                        <td>
                            Es Teh Manis
                        </td>

                        <td>
                            Rp 8.000
                        </td>

                        <td>
                            Minuman
                        </td>

                        <td>
                            Aktif
                        </td>

                        <td>
                            <div class="flex gap-2">

                                <button
                                    type="button"
                                    class="edit-btn w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition"
                                >
                                    ✎
                                </button>

                                <button
                                    type="button"
                                    class="delete-btn w-9 h-9 rounded-xl bg-red-500 text-white flex items-center justify-center hover:bg-red-600 transition"
                                >
                                    ×
                                </button>

                            </div>
                        </td>

                    </tr>


                    <!-- DATA 3 -->
                    <tr>

                        <td>
                            Kentang Goreng
                        </td>

                        <td>
                            Rp 15.000
                        </td>

                        <td>
                            Camilan
                        </td>

                        <td>
                            Aktif
                        </td>

                        <td>
                            <div class="flex gap-2">

                                <button
                                    type="button"
                                    class="edit-btn w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition"
                                >
                                    ✎
                                </button>

                                <button
                                    type="button"
                                    class="delete-btn w-9 h-9 rounded-xl bg-red-500 text-white flex items-center justify-center hover:bg-red-600 transition"
                                >
                                    ×
                                </button>

                            </div>
                        </td>

                    </tr>


                    <!-- DATA 4 -->
                    <tr>

                        <td>
                            Mie Goreng Spesial
                        </td>

                        <td>
                            Rp 20.000
                        </td>

                        <td>
                            Makanan
                        </td>

                        <td>
                            Aktif
                        </td>

                        <td>
                            <div class="flex gap-2">

                                <button
                                    type="button"
                                    class="edit-btn w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition"
                                >
                                    ✎
                                </button>

                                <button
                                    type="button"
                                    class="delete-btn w-9 h-9 rounded-xl bg-red-500 text-white flex items-center justify-center hover:bg-red-600 transition"
                                >
                                    ×
                                </button>

                            </div>
                        </td>

                    </tr>


                    <!-- DATA 5 -->
                    <tr>

                        <td>
                            Kopi Susu
                        </td>

                        <td>
                            Rp 18.000
                        </td>

                        <td>
                            Minuman
                        </td>

                        <td>
                            Aktif
                        </td>

                        <td>
                            <div class="flex gap-2">

                                <button
                                    type="button"
                                    class="edit-btn w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition"
                                >
                                    ✎
                                </button>

                                <button
                                    type="button"
                                    class="delete-btn w-9 h-9 rounded-xl bg-red-500 text-white flex items-center justify-center hover:bg-red-600 transition"
                                >
                                    ×
                                </button>

                            </div>
                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>


    <script>

        document.addEventListener("DOMContentLoaded", function () {

            const table = document.getElementById("default-table");

            if (!table) return;


            /*
            |--------------------------------------------------------------------------
            | INIT DATATABLE
            |--------------------------------------------------------------------------
            */

            const dataTable = new simpleDatatables.DataTable(
                table,
                {
                    searchable: true,
                    sortable: true,

                    perPage: 5,

                    perPageSelect: [5, 10, 15, 20],

                    labels: {
                        placeholder: "Cari menu...",

                        perPage: "{select} menu per halaman",

                        noRows: "Belum ada menu",

                        noResults: "Menu tidak ditemukan",

                        info: "Menampilkan {start} sampai {end} dari {rows} menu"
                    }
                }
            );


            /*
            |--------------------------------------------------------------------------
            | STYLE DATATABLE DENGAN TAILWIND
            |--------------------------------------------------------------------------
            */

            function styleDataTable() {

                /*
                |--------------------------------------------------------------------------
                | WRAPPER
                |--------------------------------------------------------------------------
                */

                const wrapper =
                    document.querySelector(".datatable-wrapper");

                if (wrapper) {

                    wrapper.classList.add(
                        "w-full"
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | TOP
                |--------------------------------------------------------------------------
                */

                const top =
                    document.querySelector(".datatable-top");

                if (top) {

                    top.classList.add(
                        "flex",
                        "items-center",
                        "justify-between",
                        "gap-4",
                        "pb-5"
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | SEARCH
                |--------------------------------------------------------------------------
                */

                const search =
                    document.querySelector(".datatable-search");

                if (search) {

                    search.classList.add(
                        "m-0"
                    );

                }


                const input =
                    document.querySelector(".datatable-input");

                if (input) {

                    input.classList.add(
                        "w-64",
                        "h-11",
                        "px-4",
                        "rounded-xl",
                        "border",
                        "border-gray-200",
                        "bg-white",
                        "text-sm",
                        "text-slate-700",
                        "placeholder:text-slate-400",
                        "outline-none",
                        "focus:border-blue-600",
                        "focus:ring-2",
                        "focus:ring-blue-100"
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | DROPDOWN
                |--------------------------------------------------------------------------
                */

                const dropdown =
                    document.querySelector(".datatable-dropdown");

                if (dropdown) {

                    dropdown.classList.add(
                        "m-0"
                    );

                }


                const selector =
                    document.querySelector(".datatable-selector");

                if (selector) {

                    selector.classList.add(
                        "h-10",
                        "px-3",
                        "pr-8",
                        "rounded-xl",
                        "border",
                        "border-gray-200",
                        "bg-white",
                        "text-sm",
                        "text-slate-600",
                        "outline-none",
                        "focus:border-blue-600"
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | TABLE
                |--------------------------------------------------------------------------
                */

                const dataTableElement =
                    document.querySelector(".datatable-table");

                if (dataTableElement) {

                    dataTableElement.classList.add(
                        "w-full",
                        "border-collapse"
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | HEADER
                |--------------------------------------------------------------------------
                */

                const headers =
                    document.querySelectorAll(
                        ".datatable-table thead th"
                    );

                headers.forEach(function (th) {

                    th.classList.add(
                        "px-6",
                        "py-4",
                        "bg-gray-50",
                        "text-xs",
                        "font-bold",
                        "uppercase",
                        "text-gray-700",
                        "whitespace-nowrap"
                    );

                });


                /*
                |--------------------------------------------------------------------------
                | BODY
                |--------------------------------------------------------------------------
                */

                const rows =
                    document.querySelectorAll(
                        ".datatable-table tbody tr"
                    );

                rows.forEach(function (row) {

                    row.classList.add(
                        "bg-white",
                        "hover:bg-gray-50",
                        "transition"
                    );


                    const cells =
                        row.querySelectorAll("td");

                    cells.forEach(function (td, index) {

                        td.classList.add(
                            "px-6",
                            "py-4",
                            "border-b",
                            "border-gray-100",
                            "align-middle"
                        );


                        /*
                        | Nama
                        */

                        if (index === 0) {

                            td.classList.add(
                                "font-bold",
                                "text-slate-800"
                            );

                        }


                        /*
                        | Harga
                        */

                        if (index === 1) {

                            td.classList.add(
                                "font-bold",
                                "text-blue-600"
                            );

                        }


                        /*
                        | Kategori
                        */

                        if (index === 2) {

                            td.classList.add(
                                "font-semibold",
                                "text-slate-600"
                            );

                        }


                        /*
                        | Status
                        */

                        if (index === 3) {

                            td.classList.add(
                                "font-bold",
                                "text-blue-600"
                            );

                        }


                        /*
                        | Aksi
                        */

                        if (index === 4) {

                            td.classList.add(
                                "text-center"
                            );

                        }

                    });

                });


                /*
                |--------------------------------------------------------------------------
                | BOTTOM
                |--------------------------------------------------------------------------
                */

                const bottom =
                    document.querySelector(".datatable-bottom");

                if (bottom) {

                    bottom.classList.add(
                        "flex",
                        "items-center",
                        "justify-between",
                        "gap-4",
                        "pt-5"
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | INFO
                |--------------------------------------------------------------------------
                */

                const info =
                    document.querySelector(".datatable-info");

                if (info) {

                    info.classList.add(
                        "text-sm",
                        "text-slate-500"
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | PAGINATION
                |--------------------------------------------------------------------------
                */

                const pagination =
                    document.querySelector(
                        ".datatable-pagination"
                    );

                if (pagination) {

                    pagination.classList.add(
                        "m-0"
                    );

                }


                const paginationList =
                    document.querySelector(
                        ".datatable-pagination-list"
                    );

                if (paginationList) {

                    paginationList.classList.add(
                        "flex",
                        "items-center",
                        "gap-1.5"
                    );

                }


                const paginationItems =
                    document.querySelectorAll(
                        ".datatable-pagination-list-item"
                    );

                paginationItems.forEach(function (item) {

                    item.classList.add(
                        "m-0"
                    );

                });


                const paginationLinks =
                    document.querySelectorAll(
                        ".datatable-pagination-list-item-link"
                    );

                paginationLinks.forEach(function (link) {

                    link.classList.add(
                        "flex",
                        "items-center",
                        "justify-center",
                        "min-w-9",
                        "h-9",
                        "px-2.5",
                        "rounded-xl",
                        "text-sm",
                        "font-semibold",
                        "text-slate-500",
                        "hover:bg-gray-100",
                        "hover:text-blue-600",
                        "transition"
                    );

                });


                /*
                |--------------------------------------------------------------------------
                | ACTIVE PAGINATION
                |--------------------------------------------------------------------------
                */

                const active =
                    document.querySelector(
                        ".datatable-pagination-list-item.datatable-active"
                    );

                if (active) {

                    const link =
                        active.querySelector(
                            ".datatable-pagination-list-item-link"
                        );

                    if (link) {

                        link.classList.add(
                            "bg-blue-600",
                            "text-white",
                            "hover:bg-blue-600",
                            "hover:text-white"
                        );

                    }

                }


                /*
                |--------------------------------------------------------------------------
                | DISABLED PAGINATION
                |--------------------------------------------------------------------------
                */

                const disabled =
                    document.querySelectorAll(
                        ".datatable-pagination-list-item.datatable-disabled"
                    );

                disabled.forEach(function (item) {

                    const link =
                        item.querySelector(
                            ".datatable-pagination-list-item-link"
                        );

                    if (link) {

                        link.classList.add(
                            "opacity-40",
                            "cursor-not-allowed"
                        );

                    }

                });

            }


            /*
            |--------------------------------------------------------------------------
            | APPLY STYLE
            |--------------------------------------------------------------------------
            */

            setTimeout(function () {

                styleDataTable();

            }, 50);


        });

    </script>

</body>

</html>
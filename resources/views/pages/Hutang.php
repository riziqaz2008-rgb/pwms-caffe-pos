<section id="Metodepembayaran">
    <div>
        <div class="bg-white dark:bg-slate-900 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 dark:border-slate-800 gap-4">
                <div class="flex items-center gap-4 min-w-0">
                    <div class="flex w-13 h-13 rounded-lg bg-primary border border-indigo-100/80 items-center justify-center shrink-0 border border-gray-200/80">
                        <i class="bx bxs-note text-2xl text-white"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="flex items-center gap-3 flex-wrap">
                            <h1 class="text-black dark:text-white font-black text-2xl">
                                Data Hutang
                            </h1>
                        </div>
                        <p class="text-sm text-gray-500 font-medium mt-1">
                            Melihat hutang yang tersedia pada pembayaran.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-7">

            <div class="relative bg-white dark:bg-slate-900 border-e border-gray-200/80 dark:border-slate-700 rounded-lg p-3 flex items-center justify-between overflow-hidden group transition-all duration-300">
                <div>
                    <p class="text-[10px] uppercase tracking-wider font-black text-gray-400">Total Piutang</p>
                    <div class="flex items-end gap-2 mt-1">
                        <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white leading-none">Rp <?= number_format($totalNominalPiutang, 0, ",", ".") ?></h2>
                        <span class="text-xs font-bold text-gray-400">piutang</span>
                    </div>
                </div>
                <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-primary text-white transition-transform duration-300 shrink-0">
                    <i class="bx bxs-wallet-note text-2xl"></i>
                </div>
            </div>

            <div class="relative bg-white dark:bg-slate-900  dark:border-slate-700 rounded-lg p-3 flex items-center justify-between overflow-hidden group transition-all duration-300 col-span-full lg:col-span-1">
                <div>
                    <p class="text-[10px] uppercase tracking-wider font-black text-gray-400">Belum Lunas</p>
                    <div class="flex items-end gap-2 mt-1">
                        <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white leading-none"><?= $totalPiutang ?></h2>
                        <span class="text-xs font-bold text-gray-400">Belum</span>
                    </div>
                </div>
                <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-primary text-white dark:text-amber-400 transition-transform duration-300 shrink-0">
                    <i class="bx bxs-alert-triangle text-2xl"></i>
                </div>
            </div>

        </div>

       <div class="rounded-lg sm:p-5 my-6 bg-white dark:bg-slate-950">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-5">
                <div class="min-w-0">
                    <div class="flex items-center gap-2">
                        <div class="w-1.5 h-5 rounded-full bg-primary"></div>
                        <h2 class="text-xl font-black text-slate-800 dark:text-white">
                            Daftar Hutang
                        </h2>
                    </div>
                </div>
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <form action="" method="GET" class="flex-1 sm:w-[280px]" autocomplete="off">
                        <input type="hidden" name="route" value="<?= htmlspecialchars($_GET['route'] ?? '')?>">
                        <div class="relative flex items-center gap-2 p-1.5 rounded-lg border-2 border-gray-200/80 dark:border-slate-700 bg-white dark:bg-slate-800 focus-within:ring-2 focus-within:ring-primary transition-all min-h-[48px]">
                            <div class="flex items-center text-gray-400 pl-2 shrink-0">
                                <i class="bx bx-search text-lg"></i>
                            </div>

                            <input
                                name="cari"
                                type="search"
                                oninput=""
                                class="input-delay flex-1 px-1 py-1 bg-transparent text-slate-900 dark:text-slate-100 text-sm placeholder:text-gray-400 focus:outline-none font-medium min-w-0"
                                value="<?= $cari ?>"
                                placeholder="Cari hutang...">
                        </div>
                    </form>
                </div>
            </div>

            <div class="overflow-x-auto overflow-y-auto max-h-[700px] p-1">
                <table id="selection-table" class="w-full min-w-[600px] text-sm">
                    <thead class="sticky top-0 bg-slate-50 dark:bg-slate-900 z-10">
                        <tr class="text-gray-400">
                            <th class="text-left font-bold px-5 py-4">#</th>
                            <th class="text-left font-bold px-5 py-4">Kode Transaksi</th>
                            <th class="text-left font-bold px-5 py-4">Tanggal</th>
                            <th class="text-left font-bold px-5 py-4">Pelanggan</th>
                            <th class="text-left font-bold px-5 py-4">Total</th>
                            <th class="text-left font-bold px-5 py-4">Kasir</th>
                            <th class="text-left font-bold px-5 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="">
                    <?php if(mysqli_num_rows($data)): ?>
                        <?php while($d = mysqli_fetch_assoc($data)): ?>
                        <tr>
                            <td class="px-5 py-4 font-bold text-gray-500 w-12"><?= $no++ ?></td>
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center gap-2 px-6 py-2 rounded-lg bg-primary text-xs font-bold text-white">
                                    <?= htmlspecialchars($d['kode_transaksi']) ?>
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <span class="font-bold text-slate-800"><?= kalenderInd($d['tanggal'], 'd F Y') ?></span>
                            </td>
                            <td class="px-5 py-4">
                                <span class="font-bold text-slate-800"><?= $d['nama_pelanggan'] ?></span>
                            </td>
                            <td class="px-5 py-4">
                                <span class="font-bold text-slate-800">Rp <?= number_format($d['total_transaksi'], 0, ",", ".") ?></span>
                            </td>
                            <td class="px-5 py-4">
                                <span class="font-bold text-slate-800"><?= $d['nama_user'] ?></span>
                            </td>
                            <td class="px-5 py-4">
                                <button
                                    type="button"
                                    onclick="showConfirmForm({
                                        title: 'Lunasi Transaksi',
                                        message: 'Apakah Anda yakin ingin melunasi transaksi <?= htmlspecialchars($d['kode_transaksi']) ?> ?',
                                        actionText: 'Ya, lunasi',
                                        type: 'success',
                                        nameAksi: 'bayar_hutang',
                                        inputs: [
                                            {
                                                name: 'aksi',
                                                type: 'hidden',
                                                value: 'bayar_hutang'
                                            },
                                            {
                                                name: 'id',
                                                type: 'hidden',
                                                value: <?= (int)$d['id_transaksi'] ?>
                                            }
                                        ]
                                    });"
                                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-green-500 text-white text-sm font-bold cursor-pointer hover:bg-green-600 active:scale-95 transition"
                                >
                                    <i class="bx bx-check-circle text-lg"></i>
                                    Lunasi
                                </button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="6">
                                <div class="flex flex-col items-center justify-center py-12 px-4 text-center bg-gray-50">
                                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-gray-200/80">
                                        <i class="bx bx-credit-card text-4xl text-gray-300"></i>
                                    </div>
                                    <h3 class="text-base font-black text-slate-800 mb-1">Hutang Belum Ada</h3>
                                    <p class="text-xs text-gray-400 max-w-sm mb-5">
                                        Belum ada hutang atau hasil pencarian tidak cocok.
                                    </p>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="w-full flex justify-center mt-6">
                <nav aria-label="Pagination">
                    <ul class="inline-flex items-center gap-1.5 p-1.5 rounded-lg border-2 border-gray-200/80 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm font-medium">

                       <li>
                           <?php if($currentPage > 1): ?>
                           <a href="?<?= http_build_query(array_merge($_GET, ['page' => $currentPage - 1])) ?>"
                               class="flex items-center justify-center px-3.5 h-9 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                               Previous
                           </a>
                           <?php else: ?>
                           <span
                               class="flex items-center justify-center px-3.5 h-9 rounded-lg text-slate-400 dark:text-slate-500 opacity-50 cursor-not-allowed pointer-events-none">
                               Previous
                           </span>
                           <?php endif; ?>
                       </li>
                        
                        <?php for($i = 1; $i <= $totalPage; $i++): ?>
                        <li>
                            <a href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>"
                                class="flex items-center justify-center w-9 h-9 rounded-lg <?= $i == $currentPage ? 'bg-primary text-white font-bold shadow-sm' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors' ?>">
                                <?= $i  ?>
                            </a>
                        </li>
                        <?php endfor; ?>
                        
                        <li>
                            <?php if($currentPage < $totalPage): ?>
                            <a href="?<?= http_build_query(array_merge($_GET, ['page' => $currentPage + 1])) ?>"
                                class="flex items-center justify-center px-3.5 h-9 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                                Next
                            </a>
                            <?php else: ?>
                            <span
                                class="flex items-center justify-center px-3.5 h-9 rounded-lg text-slate-400 dark:text-slate-500 opacity-50 cursor-not-allowed pointer-events-none">
                                Next
                            </span>
                            <?php endif; ?>
                        </li>
                            
                    </ul>
                </nav>
            </div>
        </div>

    </div>
</section>


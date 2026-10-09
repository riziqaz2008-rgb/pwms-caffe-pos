<?php

function formatRupiahStruk($nominal): string
{
    return 'Rp ' . number_format((int) $nominal, 0, ',', '.');
}

function formatWaktuStruk($tanggal): string
{
    if (empty($tanggal)) {
        return '-';
    }

    $timestamp = strtotime($tanggal);

    if ($timestamp === false) {
        return '-';
    }

    return date('d-m-Y H:i', $timestamp);
}

?>

<section
    id="strukPrint"
    class="struk"
>

    <div class="text-center">

        <h1 class="font-bold text-lg">
            <?= htmlspecialchars($p['nama_usaha'] ?? 'Nama Usaha') ?>
        </h1>

        <p>
            <?= htmlspecialchars($p['alamat'] ?? '') ?>
        </p>

        <p>
            <?= htmlspecialchars($p['telepon'] ?? '') ?>
        </p>

    </div>


    <div class="border-t border-dashed border-black my-3"></div>


    <div class="text-sm">

        <div class="flex justify-between">
            <span>Transaksi</span>

            <span>
                <?= htmlspecialchars($data['kode_transaksi']) ?>
            </span>
        </div>


        <div class="flex justify-between">
            <span>Tanggal</span>

            <span>
                <?= formatWaktuStruk($data['tanggal']) ?>
            </span>
        </div>

        <div class="flex justify-between">
            <span>Tanggal</span>

            <span>
                <?= htmlspecialchars(($data['nama_user'])) ?>
            </span>
        </div>


        <div class="flex justify-between">
            <span>Pelanggan</span>

            <span>
                <?= htmlspecialchars($data['pelanggan'] ?: '-') ?>
            </span>
        </div>


        <div class="flex justify-between">
            <span>Tipe</span>

            <span>
                <?= (int) $data['tipe_pesanan'] === 1
                    ? 'Dine In'
                    : 'Take Away'
                ?>
            </span>
        </div>

    </div>


    <div class="border-t border-dashed border-black my-3"></div>


    <!-- ITEM -->

    <div class="space-y-2">

        <?php if (empty($detail)): ?>

            <div class="text-center text-xs">
                Detail menu tidak tersedia.
            </div>

        <?php else: ?>

            <?php foreach ($detail as $item): ?>

                <div>

                    <div class="flex justify-between gap-2">

                        <span class="font-medium">
                            <?= htmlspecialchars($item['nama']) ?>
                        </span>

                        <span>
                            <?= formatRupiahStruk($item['total']) ?>
                        </span>

                    </div>


                    <div class="text-xs">

                        <?= formatRupiahStruk($item['harga']) ?>

                        x

                        <?= (int) $item['qty'] ?>

                    </div>


                    <?php if ((int) $item['diskon'] > 0): ?>

                        <div class="text-xs">

                            Diskon -

                            <?= formatRupiahStruk($item['diskon']) ?>

                        </div>

                    <?php endif; ?>


                    <?php if (!empty($item['catatan'])): ?>

                        <div class="text-xs">

                            Catatan:

                            <?= htmlspecialchars($item['catatan']) ?>

                        </div>

                    <?php endif; ?>

                </div>

            <?php endforeach; ?>

        <?php endif; ?>

    </div>


    <div class="border-t border-dashed border-black my-3"></div>


    <!-- TOTAL -->

    <div class="text-sm">

        <div class="flex justify-between">

            <span>Subtotal</span>

            <span>
                <?= formatRupiahStruk($data['subtotal']) ?>
            </span>

        </div>


        <div class="flex justify-between">

            <span>Diskon</span>

            <span>
                -<?= formatRupiahStruk($data['total_diskon']) ?>
            </span>

        </div>


        <div class="flex justify-between font-bold text-base mt-1">

            <span>Total</span>

            <span>
                <?= formatRupiahStruk($data['total']) ?>
            </span>

        </div>


        <div class="flex justify-between mt-2">

            <span>Pembayaran</span>

            <span>
                <?= htmlspecialchars($data['pembayaran']) ?>
            </span>

        </div>


        <?php if ($data['status_pembayaran'] == 2): ?>

            <div class="flex justify-between">

                <span>Dibayar</span>

                <span>
                    <?= formatRupiahStruk($data['uang_diterima']) ?>
                </span>

            </div>


            <?php if ((int) $data['kembalian'] > 0): ?>

                <div class="flex justify-between">

                    <span>Kembalian</span>

                    <span>
                        <?= formatRupiahStruk($data['kembalian']) ?>
                    </span>

                </div>

            <?php endif; ?>

        <?php endif; ?>

    </div>


    <div class="border-t border-dashed border-black my-3"></div>


    <div class="text-center text-xs">

        <p>
            Terima kasih atas kunjungan Anda.
        </p>

    </div>

</section>


<script>

window.addEventListener('load', () => {

    window.print();

});

window.addEventListener('afterprint', () => {

    window.close();

});

</script>
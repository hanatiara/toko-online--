<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>
<div class="h-100">
<div class="container w-25">
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="">Checkout Berhasil</h5>
                <p class="card-text">No Transaksi: <?= $penjualan['no_penjualan']; ?></p>
                <p class="card-text">Tanggal <?= $penjualan['tanggal']; ?></p>
                <p class="card-text">Total: <?= $penjualan['total']; ?></p>
        </div>
    </div>
</div>
</div>
<?= $this->endSection() ?>
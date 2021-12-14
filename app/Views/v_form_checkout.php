<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>
<div class="h-100">
<div class="container w-25">
        <form method="post" action="<?= base_url('c_barang/checkout'); ?>">
            <h1 class="h3 mb-2 mt-4 fw-normal">Checkout</h1>
            <input type="text" name="nama" id="nama" placeholder="Nama" class="mb-2 form-control" required>
            <input type="text" name="no_hp" id="no_hp" placeholder="No telepon" class="mb-2 form-control" required>
            <input type="text" name="alamat" id="alamat" placeholder="Alamat" class="mb-2 form-control" required>
            <input type="text" name="kota" id="kota" placeholder="Kota" class="mb-2 form-control" required>
            <select class="form-select" name="kecamatan" id="kecamatan" aria-label="kode_pos">
                <option selected>Kode Pos</option>
                <option value="Aceh">Aceh</option>
                <option value="Bali">Bali</option>
                <option value="Bandung">Bandung</option>
            </select>
            <select class="form-select" name="kode_pos" id="kode_pos" aria-label="kode_pos">
                <option selected>Kode Pos</option>
                <option value="23156">23156</option>
                <option value="80127">80127</option>
                <option value="41557">41557</option>
            </select>
            <button type="submit" class="w-100 btn btn-lg btn-primary">Checkout</button>
        </form>
</div>
</div>
<?= $this->endSection() ?>
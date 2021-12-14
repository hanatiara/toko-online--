<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>
<div class="h-100">
<div class="container">
    <div class="my-2"><h3>Daftar Barang</h3></div>
    <table border="1" class="table table-striped">
        <tr>
            <th>Id Barang</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Sub Total</th>
            <th>Berat</th>
            <th>Aksi</th>
        </tr>
        <?php
            $total = 0;
            $total_berat = 0;
            $cart = $cart->contents();
            foreach ($cart as $key => $row) : 
            $total = $total + $row['subtotal'];
            $total_berat = $total_berat + $row['options']['berat']* $row['qty'];?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['qty'] ?></td>
            <td><?= $row['price'] ?></td>
            <td><?= $row['subtotal'] ?></td>
            <td><?= $row['options']['berat'] * $row['qty'] ?></td>
            <td><a href="/c_barang/delete/<?= $row['rowid'] ?>"><button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button></a></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <div class="row">
        <div class="d-flex justify-content-between">
            <div><a href="/c_barang/clear"><button class="btn btn-danger">Clear Cart</button></a></div>
            <div class="my-2"><h5>Total Berat:<?= $total_berat; ?> </h5></div>
            <div class="my-2"><h5>Total:<?= $total; ?> </h5></div>
        </div>
        <div class="d-flex flex-row-reverse"><a href="/c_barang/viewCheckout"><button class="btn btn-primary">Checkout</button></a></div>
    </div>
</div>
</div>
<?= $this->endSection() ?>
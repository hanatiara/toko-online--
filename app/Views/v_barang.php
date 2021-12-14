<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>
    <div class="container">
   
        <?php
            if(session()->getFlashData('message')){ ?>
                <div class="alert alert-success" role="alert">
                <?php echo session()->getFlashData('message'); ?>
                </div>
                <?php
            }
        ?>
    
        <div class="my-2"><h3>Daftar Barang</h3></div>
        <div class="row">
        <?php foreach ($barang as $key => $row) : ?>    
            <div class="col-4">
                <?php 
                echo form_open('c_barang/addCart'); 
                echo form_hidden('id', $row['id_barang']);
                echo form_hidden('name', $row['nama_barang']);
                echo form_hidden('price', $row['harga']);
                echo form_hidden('berat', $row['berat']);
                ?>
                <div class="card" style="width: 18rem;">
                <img src="/img/<?= $row['gambar']; ?>" width="200" height="200" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title"><?= $row['nama_barang']; ?></h5>
                    <p class="card-text">Stok: <?= $row['stok']; ?></p>
                    <p class="card-text">Harga: <?= $row['harga']; ?></p>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-cart-arrow-down me-2"></i>Add to Cart</button>
                </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        <?php endforeach; ?>
        </div>
        </div>
    </div>

<?= $this->endSection() ?>
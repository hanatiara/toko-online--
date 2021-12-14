<?php

namespace App\Models;

use CodeIgniter\Model;

class m_jual extends Model
{
    protected $table      = 'jual';
 
    protected $allowedFields = ['id_barang','harga','no_penjualan','jumlah_jual'];

    
    
}


<?php

namespace App\Models;

use CodeIgniter\Model;

class m_penjualan extends Model
{
    protected $table      = 'penjualan';
    protected $primaryKey = 'no_penjualan';

    protected $allowedFields = ['no_penjualan', 'tanggal','nama','no_hp','alamat','kota','kecamatan','total','total_berat'];

    // public function getDataBarang()
    // {
    //    return $this->findAll();
    // }

    public function getDataPenjualan($id)
    {
       return $this->find($id);
    }

    
}


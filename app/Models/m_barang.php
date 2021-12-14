<?php

namespace App\Models;

use CodeIgniter\Model;

class m_barang extends Model
{
    protected $table      = 'barang';
    protected $primaryKey = 'id_barang';

    protected $allowedFields = ['stok'];


    public function getDataBarang()
    {
       return $this->findAll();
    }

    public function getDataStok($id) {
        $sql = "SELECT stok FROM barang WHERE id_barang = $id";
        return $this->db->query($sql)->getResult();
    }


    
}


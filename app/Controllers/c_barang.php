<?php

namespace App\Controllers;

use App\Models\m_barang;
use App\Models\m_penjualan;
use App\Models\m_jual;
use App\Models\m_ongkir;

class c_barang extends BaseController
{
    public function __construct() {
        $this->m_barang = new m_barang();
        $this->m_penjualan = new m_penjualan();
        $this->m_jual = new m_jual();
        $this->m_ongkir = new m_ongkir();
        helper('form');
        helper('number');
    }

    public function index()
    {
        $data = [
            'barang' => $this->m_barang->getDataBarang(),
        ];
        
        return view('v_barang', $data);

    }

    public function viewCart(){
        $data = [
            'cart' => \Config\Services::cart()
        ];
        return view('v_cart', $data);
    }

    public function addCart(){
        $cart = \Config\Services::cart();
        $data = array(
            'id'      => $this->request->getPost('id'),
            'qty'     => 1,
            'price'   => $this->request->getPost('price'),
            'name'    => $this->request->getPost('name'),
            'options' => array('berat' => $this->request->getPost('berat'))
        );
        $cart->insert($data);
        session()->setflashdata('message','Barang berhasil dimasukkan ke keranjang.');
        return redirect()->to(base_url('c_barang/index'));
    }

    public function cek() {
        $cart = \Config\Services::cart();
        $response = $cart->contents();
        $data = json_encode($response);
        echo '<pre>'; 
        print_r($data);
        echo '</pre>';
    }

    public function clear() {
        $cart = \Config\Services::cart();
        $cart->destroy();
        return redirect()->to(base_url('c_barang/viewCart'));
    }

    public function viewCheckout() {
        return view('v_form_checkout');
    }

    public function delete($id) {
        $cart = \Config\Services::cart();
        $cart->remove($id);
        return redirect()->to(base_url('c_barang/viewCart'));
    }

    public function checkout() {
        $cart = \Config\Services::cart();

        $total = $cart->total();
            
        // Hitung Ongkir
        $total_berat = 0;
    
        foreach ($cart->contents() as $value => $key) {
            $total_berat = $total_berat + $key['options']['berat'];
        }
        $kode_pos = $this->request->getpost('kode_pos');
        // dd($total_berat);




        // Input Tabel Penjualan
        $data_penjualan = [
            'nama' => $this->request->getpost('nama'),
            'tanggal'=> date('y-m-d'),
            'no_hp' => $this->request->getpost('no_hp'),
            'alamat' => $this->request->getpost('alamat'),
            'kota' => $this->request->getpost('kota'),
            'kecamatan' => $this->request->getpost('kecamatan'),
            'total' => $total,
        ];
        // dd($data_penjualan);
        $this->m_penjualan->save($data_penjualan);
        $no_penjualan = $this->m_penjualan->getInsertID();
        
        // Input Tabel Jual
        foreach ($cart->contents() as $value => $key) {
            $this->m_jual->insert([
                'id_barang' => $key['id'],
                'harga' => $key['price'],
                'no_penjualan' => $no_penjualan,
                'jumlah_jual' => $key['qty'],
            ]);
        }
        
        // Pengurangan stok
        foreach ($cart->contents() as $value => $key){
            $temp_stok = $this->m_barang->getDataStok($key['id']);
            $temp_stok = (int)$temp_stok[0]->stok;
            $stok = $temp_stok - $key['qty'];
            $this->m_barang->save([
                'id_barang' => $key['id'],
                'stok' => $stok,
            ]);
        }
        $cart->destroy();
        
        $url = (string) $no_penjualan;
        // dd($stok);
        return redirect()->to(base_url('c_barang/viewInvoice/'.$url));
        
    }

    function viewInvoice($no_penjualan){
        // dd($this->m_penjualan->find($no_penjualan));
        $data = [
            'penjualan' => $this->m_penjualan->getDataPenjualan($no_penjualan),
        ];
        return view('v_invoice', $data);
    }

}
<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class TransaksiController extends BaseController
{
    protected $cart;
    protected $url = "https://api.rajaongkir.com/starter/";
    protected $apiKey = "ae4b0421f38dd6cd9ae8bc74a55b76e1";
    protected $transaction;
    protected $transaction_detail;

    public function __construct()
    {
        helper(['number', 'form']);
        $this->cart = \Config\Services::cart();
        $this->transaction = new TransactionModel();
        $this->transaction_detail = new TransactionDetailModel();
    }

    public function index()
    {
        $data['items'] = $this->cart->contents();
        $data['total'] = $this->cart->total();
        return view('v_keranjang', $data);
    }

    public function cart_add()
    {
        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');
        $harga = $this->request->getPost('harga');
        $foto = $this->request->getPost('foto');

        $this->cart->insert([
            'id' => $id,
            'qty' => 1,
            'price' => $harga,
            'name' => $nama,
            'options' => ['foto' => $foto]
        ]);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => "$nama berhasil ditambahkan ke keranjang!",
                'nama' => $nama,
                'total_items' => count($this->cart->contents())
            ]);
        }

        session()->setFlashdata('success', 'Produk berhasil ditambahkan ke keranjang. (<a href="' . base_url('keranjang') . '">Lihat</a>)');
        return redirect()->to(base_url('/'));
    }

    public function cart_clear()
    {
        $this->cart->destroy();
        session()->setFlashdata('success', 'Keranjang berhasil dikosongkan');
        return redirect()->to(base_url('keranjang'));
    }

    public function cart_edit()
    {
        $i = 1;
        foreach ($this->cart->contents() as $item) {
            $this->cart->update([
                'rowid' => $item['rowid'],
                'qty' => $this->request->getPost('qty' . $i++)
            ]);
        }

        session()->setFlashdata('success', 'Keranjang berhasil diedit');
        return redirect()->to(base_url('keranjang'));
    }

    public function cart_delete($rowid)
    {
        $this->cart->remove($rowid);
        session()->setFlashdata('success', 'Produk di keranjang berhasil dihapus');
        return redirect()->to(base_url('keranjang'));
    }

    public function checkout()
    {
        $data['items'] = $this->cart->contents();
        $data['total'] = $this->cart->total();

        $provinsi = $this->rajaongkir('province');
        $response = json_decode($provinsi);

        if ($response && isset($response->rajaongkir->results)) {
            $data['provinsi'] = $response->rajaongkir->results;
        } else {
            $data['provinsi'] = [];
            log_message('error', 'Gagal mengambil data provinsi dari RajaOngkir: ' . $provinsi);
        }

        return view('v_checkout', $data);
    }

    public function getCity()
    {
        if ($this->request->isAJAX()) {
            $id_province = $this->request->getGet('id_province');
            $data = $this->rajaongkir('city', $id_province);
            return $this->response->setJSON($data);
        }
    }

    public function getCost()
    {
        if ($this->request->isAJAX()) {
            $origin = $this->request->getGet('origin');
            $destination = $this->request->getGet('destination');
            $weight = $this->request->getGet('weight');
            $courier = $this->request->getGet('courier');
            $data = $this->rajaongkircost($origin, $destination, $weight, $courier);
            return $this->response->setJSON($data);
        }
    }

    private function rajaongkircost($origin, $destination, $weight, $courier)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query([
                'origin' => $origin,
                'destination' => $destination,
                'weight' => $weight,
                'courier' => $courier
            ]),
            CURLOPT_HTTPHEADER => [
                "content-type: application/x-www-form-urlencoded",
                "key: " . $this->apiKey,
            ],
        ]);

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            log_message('error', 'RajaOngkir CURL Error (cost): ' . curl_error($curl));
        }

        curl_close($curl);
        return $response;
    }

    private function rajaongkir($method, $id_province = null)
    {
        $url = $this->url . $method;
        if ($id_province) {
            $url .= "?province=" . $id_province;
        }

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "key: " . $this->apiKey,
            ],
        ]);

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            log_message('error', 'RajaOngkir CURL Error (province): ' . curl_error($curl));
        }

        curl_close($curl);
        return $response;
    }

    public function buy()
    {
        date_default_timezone_set('Asia/Jakarta');

        if ($this->request->getPost()) {
            $dataForm = [
                'username' => $this->request->getPost('username'),
                'total_harga' => $this->request->getPost('total_harga'),
                'alamat' => $this->request->getPost('alamat'),
                'ongkir' => $this->request->getPost('ongkir'),
                'status' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];

            $this->transaction->insert($dataForm);
            $transaction_id = $this->transaction->getInsertID();

            foreach ($this->cart->contents() as $item) {
                $this->transaction_detail->insert([
                    'transaction_id' => $transaction_id,
                    'product_id' => $item['id'],
                    'jumlah' => $item['qty'],
                    'diskon' => 0,
                    'subtotal_harga' => $item['qty'] * $item['price'],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
            }

            $this->cart->destroy();
            return redirect()->to(base_url('profile'))->with('success', 'Transaksi berhasil!');
        }
    }

    public function cetak($id_transaksi)
    {
        // Cek jika transaksi ada
        $transaksi = $this->transaction->find($id_transaksi);
        if (!$transaksi) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Transaksi dengan ID ' . $id_transaksi . ' tidak ditemukan.');
        }

        // KOREKSI: Nama tabel diubah menjadi 'product' sesuai gambar Anda
        $namaTabelProduk = 'product';

        $items = $this->transaction_detail
            ->select("transaction_detail.*, {$namaTabelProduk}.nama, {$namaTabelProduk}.foto")
            ->join($namaTabelProduk, "{$namaTabelProduk}.id = transaction_detail.product_id")
            ->where('transaction_detail.transaction_id', $id_transaksi)
            ->findAll();

        $data = [
            'transaksi' => $transaksi,
            'items' => $items,
        ];

        return view('v_cetak_struk', $data);
    }
}

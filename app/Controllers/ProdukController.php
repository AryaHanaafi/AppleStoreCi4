<?php

namespace App\Controllers;

use App\Models\ProductModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class ProdukController extends BaseController
{
    protected $product;

    function __construct()
    {
        $this->product = new ProductModel();
    }

    public function index()
    {
        $product = $this->product->findAll();

        $kategori = [
            'iPhone' => [],
            'MacBook' => [],
            'iPad' => []
        ];

        foreach ($product as $item) {
            if (isset($kategori[$item['kategori']])) {
                $kategori[$item['kategori']][] = $item;
            }
        }

        return view('v_produk', ['kategori' => $kategori]);
    }

    public function create()
    {
        $validKategori = ['iPhone', 'MacBook', 'iPad'];
        $kategori = $this->request->getPost('kategori');

        if (!in_array($kategori, $validKategori)) {
            return redirect()->back()->with('failed', 'Kategori tidak valid')->withInput();
        }

        $dataFoto = $this->request->getFile('foto');

        $dataForm = [
            'nama' => $this->request->getPost('nama'),
            'harga' => $this->request->getPost('harga'),
            'jumlah' => $this->request->getPost('jumlah'),
            'kategori' => $kategori,
            'created_at' => date("Y-m-d H:i:s")
        ];

        if ($dataFoto && $dataFoto->isValid() && !$dataFoto->hasMoved()) {
            $fileName = $dataFoto->getRandomName();
            $dataFoto->move('img/', $fileName);
            $dataForm['foto'] = $fileName;
        }

        $this->product->insert($dataForm);
        return redirect()->to(base_url('produk'))->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $validKategori = ['iPhone', 'MacBook', 'iPad'];
        $kategori = $this->request->getPost('kategori');

        if (!in_array($kategori, $validKategori)) {
            return redirect()->back()->with('failed', 'Kategori tidak valid')->withInput();
        }

        $dataProduk = $this->product->find($id);
        if (!$dataProduk) {
            return redirect()->to(base_url('produk'))->with('failed', 'Produk tidak ditemukan.');
        }

        $dataForm = [
            'nama' => $this->request->getPost('nama'),
            'harga' => $this->request->getPost('harga'),
            'jumlah' => $this->request->getPost('jumlah'),
            'kategori' => $kategori,
            'updated_at' => date("Y-m-d H:i:s")
        ];

        if ($this->request->getPost('check') == 1) {
            if (!empty($dataProduk['foto']) && file_exists('img/' . $dataProduk['foto'])) {
                unlink('img/' . $dataProduk['foto']);
            }

            $dataFoto = $this->request->getFile('foto');
            if ($dataFoto && $dataFoto->isValid() && !$dataFoto->hasMoved()) {
                $fileName = $dataFoto->getRandomName();
                $dataFoto->move('img/', $fileName);
                $dataForm['foto'] = $fileName;
            }
        }

        $this->product->update($id, $dataForm);
        return redirect()->to(base_url('produk'))->with('success', 'Produk berhasil diubah.');
    }


    public function delete($id)
    {
        $dataProduk = $this->product->find($id);

        if ($dataProduk && !empty($dataProduk['foto']) && file_exists('img/' . $dataProduk['foto'])) {
            unlink('img/' . $dataProduk['foto']);
        }

        $this->product->delete($id);
        return redirect()->to(base_url('produk'))->with('success', 'Produk berhasil dihapus.');
    }

    public function download()
    {
        $product = $this->product->findAll();
        $html = view('v_produkPDF', ['product' => $product]);

        $filename = date('y-m-d-H-i-s') . '-produk';

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream($filename);
    }
}

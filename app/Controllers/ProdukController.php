<?php

namespace App\Controllers;

use App\Models\ProductModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class ProdukController extends BaseController
{


    public function index()
    {

        return view('v_produk');
    }


}

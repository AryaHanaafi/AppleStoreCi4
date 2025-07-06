<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class TransaksiController extends BaseController
{


    public function index()
    {

        return view('v_keranjang');
    }


}

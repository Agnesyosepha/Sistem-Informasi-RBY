<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ITController extends Controller
{
    public function formPeminjaman()
    {
        return view('IT.formpeminjaman');
    }
}

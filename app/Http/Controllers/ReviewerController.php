<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewerController extends Controller
{
    public function index()
    {
        return view('reviewer.index');
    }

    public function tim()
    {
        $timReviewer = [
            ['nama' => 'Mega Br Ginting', 'jabatan' => 'Koordinator Reviewer', 'email' => 'mega@edp.com', 'status' => 'Aktif'],
        ];

        return view('reviewer.timReviewer', compact('timReviewer'));
    }
}

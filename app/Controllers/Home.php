<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('v_home');
    }

    public function berita()
    {
        return view('v_berita');
    }
}

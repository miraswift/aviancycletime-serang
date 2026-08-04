<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['menuGroup'] = '';
        $data['menu'] = 'Dashboard';

        return view('Dashboard/Index', $data);
    }
}

<?php
// app/Controllers/Home.php
namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('user_form');
    }

    public function submit()
    {
        // Grab the raw POST data
        $data['username'] = $this->request->getPost('username');
        return view('user_form', $data);
    }
}
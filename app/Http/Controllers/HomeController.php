<?php

namespace App\Http\Controllers;

class HomeController {
    public function getHomePage()
    {
        return view('pages.home.home');
    }
}
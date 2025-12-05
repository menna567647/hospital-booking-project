<?php
namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;


class PageController extends Controller
{

    public function index()
    {
        return view('website.home');
    }
}
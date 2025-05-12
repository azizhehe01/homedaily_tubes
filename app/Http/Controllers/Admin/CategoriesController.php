<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        return view('admin.pages.categories');
    }

    public function create()
    {
        return view('admin.pages.input-categories');
    }
}

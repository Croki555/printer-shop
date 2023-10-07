<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Product $product):View
    {
        $products = $product->limit(3)->orderBy('created_at', 'desc')->get();

        return view('welcome', [
            'products'=> $products,
        ]);
    }
}

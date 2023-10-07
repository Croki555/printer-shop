<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index($id): View
    {
        $product = Product::find($id);

        return view('catalog.product', [
            'id' => $id,
            'product'=> $product
        ]);
    }
}

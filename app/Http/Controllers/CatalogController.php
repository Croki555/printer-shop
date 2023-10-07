<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function index(Product $product, Request $request): View
    {
        $categories = Category::all();

        $sort = 'desc';
        $field = 'updated_at';

        switch ($request->query('sort')) {
            case 'old':
                $sort = 'asc';
                $field = 'updated_at';
                break;
            case 'new':
                $sort = 'desc';
                $field = 'updated_at';
                break;
            case 'priceUp':
                $sort = 'asc';
                $field = 'price';
                break;
            case 'priceDown':
                $sort = 'desc';
                $field = 'price';
                break;
        }
        if($request->query('category') == 0) {
            $products = $product->orderBy($field, $sort)->paginate(4)->withQueryString();
        }else {
            $products = $product->where('category_id', $request->category ?? 0)
                ->orderBy($field, $sort)
                ->paginate(4)->withQueryString();
        }

        return view('catalog.index', [
            'products' => $products,
            'categories' => $categories,
            'category' => $request->query('category') ?? 0 ,
            'sort' => $request->query('sort') ?? 'new',
        ]);
    }
}

<?php

namespace App\Http\Controllers\Basket;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class BasketController extends Controller
{
    public function index(Request $request): View
    {
        $products = Basket::where('session_id', $request->session()->getId())->get();

        return view('basket.index', [
            'products' => $products
        ]);
    }

    public static function add(Request $request, $product_id)
    {
        $product = Product::findOrFail($product_id);

        if ($basket = Basket::where(['session_id' => session()->getId(), 'product_id' => $product->id])->first()) {
            if ($basket->quantity < $product->amount) {
                $basket->quantity++;
                $basket->save();
            } else {
                return redirect()->back()->withErrors(
                    ["basket_$product->id" => "Нельзя добавить в корзину больше товаров, чем есть в наличии ($product->amount), у вас $basket->quantity"]
                );
            }
        } else {
            $basket = new Basket();
            $basket->session_id = session()->getId();
            $basket->product_id = $product->id;
            $basket->quantity = 1;
            $basket->price = $product->price;
            $basket->save();
            return redirect()->intended(route('catalog'));
        }
        return redirect()->intended(route('catalog'));
    }

    public function edit(Request $request, $product_id)
    {
        $product = Product::findOrFail($product_id);
        $amount = $product->amount;

        $validator = Validator::make($request->all(), [
            'edit_' . $product_id => ['integer', 'min:1', 'max:' . $amount]
        ], [
            "edit_$product_id.min" => 'Минимальное количество 1',
            "edit_$product_id.max" => "В наличии только $amount",
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors([
                "edit_$product_id" => $validator->errors()
            ]);
        }

        $basket = Basket::where('session_id', $request->session()->getId())->where('product_id', $product_id)
            ->update(['quantity' => $request->input("edit_$product_id")]);
        return redirect(route('basket'));
    }

    public function delete(Request $request, $product_id)
    {
        $product = Basket::where(['session_id' => $request->session()->getId(), 'product_id' => $product_id])->first();
        $product->delete();

        return redirect()->route('basket');
    }

    public function checkout(Request $request)
    {
        $products = Basket::where('session_id', $request->session()->getId())->get();

        return view('basket.checkout', [
            'products' => $products
        ]);
    }

    public function booking(Request $request)
    {
        $id_ses = $request->session()->getId();
        $basket = Basket::select('product_id as id', 'quantity')->where('session_id', $id_ses)->get();
        $total_price = Basket::select(DB::raw('SUM(price * quantity) as count'))->where(['session_id' => $id_ses])->first();

        $password = $request->validate([
            'password' => ['required', 'string']
        ], [
            'password.required' => 'Введите пароль, для оформления заказа',
            'password.string' => 'Поле пароль должно быть строкой',
        ]);

        if (!Hash::check($password['password'], auth('web')->user()->password)) {
            return redirect()->back()->withErrors(['password' => 'Не правильный пароль']);
        }
        $order = new Order();
        $order->user_id = auth('web')->user()->id;
        $order->products = json_encode($basket);
        $order->total_price = $total_price->count;
        $order->save();

        DB::table('baskets')->where('session_id', $id_ses)->delete();

        $request->session()->regenerate();

        $request->session()->regenerateToken();

        return redirect(route('catalog'));
    }
}

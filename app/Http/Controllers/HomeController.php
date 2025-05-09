<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function home()
    {
        $product = Product::all();
        $count = '';

        if (Auth::check()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        }

        return view('home.index', compact('product', 'count'));
    }

    public function login_home()
    {
        $product = Product::all();
        $count = '';

        if (Auth::check()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        }

        return view('home.index', compact('product', 'count'));
    }

    public function product_details($id)
    {
        $data = Product::find($id);
        $count = '';

        if (Auth::check()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        }

        return view('product_details', compact('data', 'count'));
    }

    public function add_cart($id)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user_id = $user->id;

            $data = new Cart;
            $data->user_id = $user_id;
            $data->product_id = $id;
            $data->save();

            toastr()->timeOut(1000)->closeButton()->addSuccess('Product added to cart successfully');
        }

        return redirect()->back();
    }

    public function mycart()
    {
        $count = '';
        $cart = [];

        if (Auth::check()) {
            $user = Auth::user();
            $userid = $user->id;

            $count = Cart::where('user_id', $userid)->count();
            $cart = Cart::where('user_id', $userid)->get();
        }

        return view('home.mycart', compact('count', 'cart'));
    }

    public function delete_cart($id)
    {
        if (Auth::check()) {
            $data = Cart::find($id);
            $data->delete();

            toastr()->timeOut(10000)->closeButton()->addSuccess('Product removed from the cart successfully');
        }

        return redirect()->back();
    }

    public function confirm_order(Request $request)
    {
        if (Auth::check()) {
            $userid = Auth::user()->id;

            $cart = Cart::where('user_id', $userid)->get();

            foreach ($cart as $carts) {
                $order = new Order;
                $order->product_id = $carts->product_id;
                $order->name = $request->name;
                $order->rec_address = $request->address;
                $order->phone = $request->phone;
                $order->user_id = $userid;
                $order->save();
            }

            Cart::where('user_id', $userid)->delete();

            toastr()->timeOut(10000)->closeButton()->addSuccess('Order confirmed successfully');
        }

        return redirect()->back();
    }
}

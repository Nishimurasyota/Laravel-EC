<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
    $itemInCart = Cart::where('user_id', Auth::id())
    ->where('product_id', $request->product_id)->first(); //カートに商品があるか確認
    
    if($itemInCart){
    $itemInCart->quantity += $request->quantity; //あれば数量を追加
    $itemInCart->save();
    } else {
    Cart::create([ // なければ新規作成
    'user_id' => Auth::id(),
    'product_id' => $request->product_id,
    'quantity' => $request->quantity
    ]);
    }
    return redirect()->route('user.cart.index');
    }

    public function index(){
        $user = User::findOrFail(Auth::id());
        $products = $user->products;
        $totalPrice = 0;

        foreach($products as $product){
            $totalPrice += $product->price * $product->pivot->quantity;
        }

        // dd($products,$totalPrice);

        return view("user.cart", compact("products","totalPrice"));

    }

    public function delete($id){
        Cart::where('product_id', $id)
        ->where('user_id', Auth::id())->delete();

        return redirect()->route('user.cart.index');
    }
}

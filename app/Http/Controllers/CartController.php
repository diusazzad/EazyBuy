<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $mightLike = Product::mightAlsoLike()->get();
    //     return view('cart')->with('mightLike', $mightLike);
    // }

    public function index()
    {
        try {
            $mightLike = Product::mightAlsoLike()->get();
            return view('cart')->with('mightLike', $mightLike);
        } catch (Exception $e) {
            // Log the error or handle it appropriately
            report($e);
            return view('error', ['message' => 'Something went wrong.']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        session()->forget('coupon');
        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) {
            return $cartItem->id == request()->id;
        });
        $duplicatesLater = Cart::instance('saveForLater')->search(function ($cartItem, $rowId) {
            return $cartItem->id == request()->id;
        });
        if ($duplicates->isNotEmpty()) {
            session()->flash('success', 'Item is already in your cart');
            return redirect()->route('cart.index');
        } else if ($duplicatesLater->isNotEmpty()) {
            Cart::instance('saveForLater')->remove($duplicatesLater->first()->rowId);
        }
        Cart::instance('default')->add(request()->id, request()->name, 1, request()->price)->associate('App\Product');
        session()->flash('success', 'product added to the cart');
        return redirect()->route('cart.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        session()->forget('coupon');
        // dd(request()->all());
        if (request()->productQuantity >= request()->quantity) {
            Cart::instance('default')->update($id, request()->quantity);
            session()->flash('success', 'quantity updated successfully!');
            return response()->json(['success' => ''], 200);
        }
        session()->flash('error', 'not enough products');
        return response()->json(['error' => ''], 405);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,$cart)
    {
        if ($cart == 'default') {
            Cart::instance('default')->remove($id);
        } else if ($cart = 'saveForLater') {
            Cart::instance('saveForLater')->remove($id);
        }

        session()->flash('success', 'item has been removed');
        return back();
    }
    public function saveLater($id)
    {
        session()->forget('coupon');
        $item = Cart::get($id);
        Cart::remove($id);
        $duplicates = Cart::instance('saveForLater')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId == $id;
        });
        if ($duplicates->isNotEmpty()) {
            session()->flash('success', 'Item is already saved for later');
            return redirect()->route('cart.index');
        }
        Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)->associate('App\Product');
        session()->flash('success', 'Item has been saved for later');
        return redirect()->route('cart.index');
    }

    public function addToCart($id)
    {
        session()->forget('coupon');
        $item = Cart::instance('saveForLater')->get($id);
        Cart::instance('saveForLater')->remove($id);
        $exist = Cart::instance('default')->search(function ($cartItem, $rowId) use ($item) {
            return $cartItem->id == $item->id;
        });
        if ($exist->isNotEmpty()) {
            session()->flash('success', 'Item is already in the cart');
            return redirect()->route('cart.index');
        }
        Cart::instance('default')->add($item->id, $item->name, 1, $item->price)->associate('App\Product');
        session()->flash('success', 'item added to the cart');
        return redirect()->route('cart.index');
    }
}

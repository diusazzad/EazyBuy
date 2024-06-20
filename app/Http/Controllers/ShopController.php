<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagination = 12;
        if (request()->category) {
            $category = Category::where('slug', request()->category)->get()->first();
            $products = Product::where('category_id', $category->id);
            $categoryName = $category->name;
        } else if (request()->tag) {
            $tag = Tag::where('slug', request()->tag)->get()->first();
            $products = $tag->products();
            $tagName = $tag->name;
        } else {
            $products = Product::where('featured', true);
            $categoryName = 'Featured';
        }
        if (request()->sort == 'low_high') {
            $products = $products->orderBy('price')->paginate($pagination);
        } else if (request()->sort == 'high_low') {
            $products = $products->orderBy('price', 'desc')->paginate($pagination);
        } else {
            $products = $products->inRandomOrder()->paginate($pagination);
        }
        $categories = Category::all();
        $tags = Tag::all();
        return view('shop')->with([
            'products' => $products,
            'categories' => $categories,
            'tags' => $tags,
            'categoryName' => $categoryName ?? null,
            'tagName' => $tagName ?? null,
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $images = json_decode($product->images);
        $mightLike = Product::where('slug', '!=', $product->slug)->mightAlsoLike()->get();
        $stockLevel = getStockLevel($product->quantity);
        return view('product')->with([
            'product' => $product,
            'mightLike' => $mightLike,
            'images' => $images,
            'stockLevel' => $stockLevel,
        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search($query) {
        if(strlen($query) < 3) return back()->with('error', 'minimum query length is 3');
        $products = Product::search($query)->paginate(10);
        return view('search')->with(['products' => $products, 'query' => $query]);
    }

}

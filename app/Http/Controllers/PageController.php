<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    public function index()
    {
        return view('landing');
    }

    // public function index()
    // {
    //     try {
    //         $trendingProducts = Product::query()
    //             ->orderByDesc('views')
    //             ->limit(5)
    //             ->get();
    //     } catch (\Exception $e) {
    //         Log::error('Error fetching trending products: ' . $e->getMessage());

    //         return redirect()->route('home.index')
    //             ->with('error', 'An error occurred while fetching trending products. Please try again later.');
    //     }

    //     return view('landing', compact('trendingProducts'));
    // }
}

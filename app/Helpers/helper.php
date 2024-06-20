<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

function productImage($path)
{
    /*
     * Handle Heroku demo app scenario (replace with your logic)
     */
    if (App::environment('production') && env('APP_URL') === 'https://your-heroku-app.herokuapp.com') {
        return asset('images/' . $path);
    }

    // Check for image in storage path
    if (Storage::disk('public')->exists($path)) {
        return asset('storage/' . $path);
    }

    // Return default image if not found
    return asset('images/not-found.jpg');
}

function format($price)
{
    return number_format($price, 2);
}

function str_limit($string, $limit)
{
    return strlen($string) > $limit ? substr($string, 0, $limit) . ' ...' : $string;
}

function getStockLevel($quantity)
{
    $stockThreshold = setting('site.stock_threshold'); // Replace with your logic to retrieve threshold
    if ($quantity > $stockThreshold) {
        return 'In Stock';
    } else if ($quantity <= $stockThreshold && $quantity > 0) {
        return 'Low Stock';
    } else {
        return 'Out Of Stock';
    }
}

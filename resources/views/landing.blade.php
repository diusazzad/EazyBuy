@extends('layouts.main')
@section('title', 'Welcome')
@section('content')

    <!-- Hero Section -->
    <div class="relative bg-cover bg-center h-[400px] md:h-[600px] lg:h-[800px]"
        style="background-image: url('/path/to/your/image.jpg');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 space-y-8 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl text-white font-bold">Welcome to Our Site</h1>
            <p class="text-xl md:text-2xl lg:text-3xl text-white">Discover the latest in fashion, technology, and more.</p>
            <div class="space-x-4">
                <a href="#"
                    class="px-6 py-2 text-white bg-blue-500 rounded hover:bg-blue-600 transition duration-150 ease-in-out">Shop
                    Now</a>
                <a href="#"
                    class="px-6 py-2 text-white bg-transparent border border-white rounded hover:bg-white hover:text-blue-500 transition duration-150 ease-in-out">Learn
                    More</a>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold text-center mb-4">Featured Products</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Repeat this structure for each product -->
            <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white">
                <img class="w-full" src="/path/to/product/image.jpg" alt="Product Image">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">Product Name</div>
                    <p class="text-gray-700 text-base">$99.00</p>
                </div>
                <div class="px-6 pt-4 pb-2">
                    <span
                        class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">New</span>
                    <button
                        class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-150 ease-in-out">Add
                        to Cart</button>
                </div>
            </div>
            <!-- End Product Structure -->
        </div>
        <div class="mt-8 text-center">
            <a href="#"
                class="px-6 py-2 text-white bg-blue-500 rounded hover:bg-blue-600 transition duration-150 ease-in-out">Show
                More</a>
        </div>
        <hr class="my-8">
        <h2 class="text-2xl font-semibold text-center mb-4">Hot Sales</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Repeat this structure for each hot sale product -->
            <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white">
                <img class="w-full" src="/path/to/hot-sale-product/image.jpg" alt="Hot Sale Product Image">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">Hot Sale Product Name</div>
                    <p class="text-gray-700 text-base">$79.00</p>
                </div>
                <div class="px-6 pt-4 pb-2">
                    <span
                        class="inline-block bg-yellow-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Sale</span>
                    <button
                        class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition duration-150 ease-in-out">Buy
                        Now</button>
                </div>
            </div>
            <!-- End Hot Sale Product Structure -->
        </div>
    </div>

@endsection

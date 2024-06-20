@extends('layouts.main')
@section('title', 'Shop')
@section('content')

    <!-- Start Page Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-wrap">
            <!-- Start Filter Section -->
            <aside class="w-full md:w-1/4 p-4">
                <h4 class="text-lg font-semibold mb-4">By Category</h4>
                <ul class="list-none">
                    @foreach ($categories as $category)
                        <li class="mb-2">
                            <a href="{{ route('shop.index', ['category' => $category->slug]) }}"
                                class="block py-2 px-4 bg-white rounded hover:bg-gray-100">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
                <h4 class="text-lg font-semibold mt-4 mb-4">By Tag</h4>
                <ul class="list-none">
                    @foreach ($tags as $tag)
                        <li class="mb-2">
                            <a href="{{ route('shop.index', ['tag' => $tag->slug]) }}"
                                class="block py-2 px-4 bg-white rounded hover:bg-gray-100">{{ $tag->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </aside>
            <!-- End Filter Section -->

            <!-- Start Products Section -->
            <main class="w-full md:w-3/4 p-4">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold">{{ $categoryName }}</h2>
                    <div class="flex space-x-4">
                        <a href="{{ route('shop.index', ['category' => request()->category, 'tag' => request()->tag, 'sort' => 'low_high']) }}"
                            class="text-blue-500 hover:text-blue-700">Low to High</a>
                        <a href="{{ route('shop.index', ['category' => request()->category, 'tag' => request()->tag, 'sort' => 'high_low']) }}"
                            class="text-blue-500 hover:text-blue-700">High to Low</a>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($products as $product)
                        <div class="rounded overflow-hidden shadow-lg bg-white">
                            <a href="{{ route('shop.show', $product->slug) }}" class="block">
                                <img src="{{ productImage($product->image) }}" class="w-full" alt="Product Image">
                                <div class="p-6">
                                    <h5 class="font-bold text-xl mb-2">{{ $product->name }}</h5>
                                    <p class="text-gray-700 text-base float-right">$ {{ format($product->price) }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-8">
                    {{ $products->appends(request()->input())->links() }}
                </div>
            </main>
        </div>
    </div>
    <!-- End Page Content -->

@endsection

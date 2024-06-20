@extends('layouts.main')
@section('title', $product->name)
@section('content')

    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-wrap -mx-4">
            <!-- Product Image Section -->
            <div class="w-full md:w-1/3 p-4">
                <div class="relative">
                    <img src="{{ productImage($product->image) }}" class="w-full h-auto object-cover" id="current-image">
                    <div class="absolute bottom-0 right-0 p-4">
                        <div class="image-thumbnails">
                            @if ($images)
                                <img src="{{ productImage($product->image) }}" class="image-thumbnail active">
                                @foreach ($images as $image)
                                    <div class="cursor-pointer">
                                        <img src="{{ productImage($image) }}" class="image-thumbnail">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product Details Section -->
            <div class="w-full md:w-2/3 p-4">
                <h2 class="text-2xl font-bold mb-4">{{ $product->name }}</h2>
                <span class="inline-block bg-green-500 text-white text-sm px-2 rounded-full">{{ $stockLevel }}</span>
                <p class="mt-2 text-gray-600">{{ $product->details }}</p>
                <h3 class="text-xl font-semibold mt-4">$ {{ format($product->price) }}</h3>
                <p class="mt-2 text-gray-600">{!! $product->description !!}</p>
                @if ($product->quantity > 0)
                    <form action="{{ route('cart.store') }}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="name" value="{{ $product->name }}">
                        <input type="hidden" name="price" value="{{ $product->price }}">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-150 ease-in-out">Add
                            to Cart</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    @include('partials.product.might-like')
    <!-- End Page Content -->

@endsection

@section('scripts')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const currentImage = document.getElementById('current-image');
            const thumbnails = document.querySelectorAll('.image-thumbnail');

            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener('click', function(e) {
                    thumbnails.forEach(th => th.classList.remove('active'));
                    e.target.classList.add('active');
                    if (e.target.src !== currentImage.src) {
                        currentImage.style.opacity = 0;
                        setTimeout(() => {
                            currentImage.src = e.target.src;
                            currentImage.style.opacity = 1;
                        }, 300);
                    }
                });
            });
        });
    </script>

@endsection

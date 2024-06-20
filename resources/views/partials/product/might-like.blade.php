<div class="suggestions">
    <div class="container mx-auto px-4 py-8">
        <h3 class="text-2xl font-semibold mb-8">You might also like</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($mightLike as $product)
                <div class="bg-white rounded overflow-hidden shadow-lg">
                    <a href="{{ route('shop.show', $product->slug) }}" class="block">
                        <img src="{{ productImage($product->image) }}" class="w-full" alt="...">
                        <div class="p-6">
                            <h5 class="font-bold text-xl mb-2">{{ $product->name }}</h5>
                            <p class="text-gray-700 text-base float-right">$ {{ format($product->price) }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

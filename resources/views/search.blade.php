@extends('layouts.main')
@section('title', 'Search')
@section('content')

    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold mb-8">Showing {{ $products->count() }} results for "{{ $query }}" out of
            {{ $products->total() }}</h2>
        @if ($products->total() == 0)
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 mb-4" role="alert">
                <p class="font-bold">No products found for your search</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-max w-full table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Details</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($products as $product)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <a href="{{ route('shop.show', $product->slug) }}"
                                        class="text-indigo-600 hover:text-indigo-900">{{ $product->name }}</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${{ format($product->price) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->details }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ str_limit($product->description, 70) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <img src="{{ productImage($product->image) }}" class="w-16 h-16 object-cover rounded"
                                        alt="">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>

@endsection

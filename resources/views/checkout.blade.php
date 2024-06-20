@extends('layouts.main')
@section('title', 'Checkout')
@section('content')
    <div class="max-w-7xl mx-auto p-4">
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2">
                <div class="mb-4">
                    <h1 class="text-2xl font-bold mb-2">Checkout</h1>
                    <hr class="my-2">
                    <h3 class="text-xl font-semibold mb-8">Billing details</h3>
                    <form action="{{ route('checkout.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            @guest
                                <input type="text" name="email" id="email"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    required>
                            @else
                                <input type="text" name="email" id="email"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    value="{{ auth()->user()->email }}" readonly required>
                            @endguest
                        </div>
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                        </div>
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                            <input type="text" name="address" id="address"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                        </div>
                        <div class="sm:flex sm:items-start">
                            <div class="sm:w-1/2">
                                <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                <input type="text" name="city" id="city"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    required>
                            </div>
                            <div class="sm:w-1/2">
                                <label for="province" class="block text-sm font-medium text-gray-700">Province</label>
                                <input type="text" name="province" id="province"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    required>
                            </div>
                        </div>
                        <div class="sm:flex sm:items-start">
                            <div class="sm:w-1/2">
                                <label for="postal_code" class="block text-sm font-medium text-gray-700">Postal Code</label>
                                <input type="text" name="postal_code" id="postal_code"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    required>
                            </div>
                            <div class="sm:w-1/2">
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                <input type="text" name="phone" id="phone"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    required>
                            </div>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Payment details</h2>
                        <div>
                            <label for="name_on_card" class="block text-sm font-medium text-gray-700">Name on card</label>
                            <input type="text" name="name_on_card" id="name_on_card"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                        </div>
                        <div>
                            <label for="credit_card" class="block text-sm font-medium text-gray-700">Credit Card</label>
                            <input type="text" name="credit_card" id="credit_card"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                        </div>
                        <button type="submit"
                            class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Complete
                            Order</button>
                    </form>

                </div>
            </div>
            <div class="w-full md:w-1/2">
                <div class="mb-4">
                    <h3>Your Order</h3>
                    <hr class="my-2">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Product</th>
                                <th class="px-4 py-2">Details</th>
                                <th class="px-4 py-2">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Cart::instance('default')->content() as $item)
                                <tr>
                                    <td class="px-4 py-2"><img src="{{ productImage($item->model->image) }}" alt=""
                                            class="h-16 w-16 object-cover"></td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('shop.show', $item->model->slug) }}"
                                            class="text-blue-600 hover:underline">
                                            <h3 class="font-semibold">{{ $item->model->name }}</h3>
                                            <p>{{ $item->model->details }}</p>
                                            <h3 class="text-sm">${{ $item->model->price }}</h3>
                                        </a>
                                    </td>
                                    <td class="px-4 py-2">{{ $item->qty }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Table summary and coupon application logic follows -->
                    <table class="w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Product Image</th>
                                <th class="px-4 py-2">Product Details</th>
                                <th class="px-4 py-2">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Cart::instance('default')->content() as $item)
                                <tr>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('shop.show', $item->model->slug) }}">
                                            <img src="{{ productImage($item->model->image) }}" alt=""
                                                class="h-24 w-24 object-cover">
                                        </a>
                                    </td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('shop.show', $item->model->slug) }}"
                                            class="text-blue-600 hover:underline">
                                            <h3 class="font-semibold">{{ $item->model->name }}</h3>
                                            <p>{{ $item->model->details }}</p>
                                            <h3 class="text-sm">${{ $item->model->price }}</h3>
                                        </a>
                                    </td>
                                    <td class="px-4 py-2">{{ $item->qty }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
